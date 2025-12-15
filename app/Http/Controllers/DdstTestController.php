<?php

namespace App\Http\Controllers;

use App\Models\Antropometri;
use App\Models\DdstItem;
use App\Models\DdstTest;
use App\Models\DdstTestFoto;
use App\Models\DdstTestItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DdstTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function getDdstIndexRouteName(): string
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return 'admin.data-tumbuh-kembang.index';
        }

        if ($user->hasRole('guru')) {
            return 'guru.data-tumbuh-kembang.index';
        }

        if ($user->hasRole('super_admin')) {
            return 'superadmin.data-tumbuh-kembang.index';
        }

        abort(403, 'Role tidak dikenali');
    }
    public function createFromAntropometri($antropometriId)
    {
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            $routeNameStore = 'admin.ddst.store_from_antropometri';
        } elseif ($user->hasRole('guru')) {
            $routeNameStore = 'guru.ddst.store_from_antropometri';
        } elseif ($user->hasRole('super_admin')) {
            $routeNameStore = 'superadmin.ddst.store_from_antropometri';
        } else {
            abort(403, 'Role tidak dikenali');
        }
        $antropometri = Antropometri::with('anak')->findOrFail($antropometriId);
        $anak = $antropometri->anak;

        // usia bulan (int)
        $usiaBulan = (int) Carbon::parse($anak->tanggal_lahir)
            ->diffInMonths(Carbon::parse($antropometri->tanggal_ukur));

        // 1) Item utama: semua yang SUDAH boleh dites (masa lalu + usia sekarang)
        $baseItems = DdstItem::where('min_bulan', '<=', $usiaBulan)
            ->orderBy('min_bulan')
            ->orderBy('kategori_perkembangan')
            ->get();

        // 2) Item "advanced": 3 item berikutnya di depan usia sekarang
        $futureItems = DdstItem::where('min_bulan', '>', $usiaBulan)
            ->orderBy('min_bulan')
            ->orderBy('kategori_perkembangan')
            ->limit(3)
            ->get();

        // 3) Gabungkan: items utama + 3 item ke depan
        $items = $baseItems->concat($futureItems);



        // 1) Cek apakah SUDAH ada tes untuk antropometri ini
        // $ddstTest = DdstTest::where('antropometris_id', $antropometri->id)
        //     ->where('anaks_id', $anak->id)
        //     ->first();
        $ddstTest = DdstTest::with('fotos')
            ->where('antropometris_id', $antropometri->id)
            ->where('anaks_id', $anak->id)
            ->first();


        $existingItems = collect();

        if ($ddstTest) {
            // Kalau SUDAH ada tes untuk antropometri ini → pakai item dari tes ini (EDIT)
            $existingItems = DdstTestItem::where('ddst_tests_id', $ddstTest->id)
                ->get()
                ->keyBy('ddst_items_id');
        } else {
            // 2) Kalau BELUM ada tes → cari tes DDST TERAKHIR anak ini SEBELUM tanggal ukur sekarang
            $previousTest = DdstTest::where('anaks_id', $anak->id)
                ->where('tanggal_test', '<', $antropometri->tanggal_ukur)
                ->orderBy('tanggal_test', 'desc')
                ->first();

            if ($previousTest) {
                $existingItems = DdstTestItem::where('ddst_tests_id', $previousTest->id)
                    ->get()
                    ->keyBy('ddst_items_id');
            }
        }

        // list guru untuk dropdown
        // ✅ list guru sesuai sekolah anak
        $sekolahId = $anak->sekolahs_id ?? $anak->sekolah_id ?? null;

        $listGuru = \App\Models\Guru::query()
            ->when($sekolahId, fn($q) => $q->where('sekolahs_id', $sekolahId)) // kalau kolomnya sekolah_id, ganti di sini
            ->orderBy('nama_guru')
            ->get();

        $listReviewer = \App\Models\Reviewer::orderBy('nama')->get();


        return view('shared.tumbuh_kembang.ddst_test', [
            'antropometri' => $antropometri,
            'anak' => $anak,
            'usiaBulan' => $usiaBulan,
            'items' => $items,
            'ddstTest' => $ddstTest,      // bisa null (tes baru)
            'existingItems' => $existingItems, // bisa dari tes ini / tes sebelumnya
            'listGuru' => $listGuru,
            'listReviewer' => $listReviewer,
            'routeNameStore' => $routeNameStore,
        ]);
    }





    public function storeFromAntropometri(Request $request, $antropometriId)
    {
        $antropometri = Antropometri::with('anak')->findOrFail($antropometriId);
        $anak = $antropometri->anak;

        $request->validate([
            'gurus_id' => 'required|exists:gurus,id',
            'reviewers_id' => 'required|exists:reviewers,id',
            'usia_bulan' => 'required|integer',
            'items' => 'required|array',
            'items.*.status' => 'required|in:tercapai,belum_tercapai,ragu_ragu',
            'items.*.keterangan' => 'nullable|string',

            'tanggal_ukur' => 'required|date',
            'berat_badan' => 'nullable|numeric',
            'tinggi_badan' => 'nullable|numeric',
            'lingkar_kepala' => 'nullable|numeric',
            'lingkar_lengan' => 'nullable|numeric',
            'status_gizi' => 'nullable|in:normal,gizi_kurang,gizi_berlebih',
            'status_bb' => 'nullable|in:normal,resiko',
            'status_tb' => 'nullable|in:normal,pendek',


            'semester' => 'nullable|string|max:20',
            'tahun_ajaran' => 'nullable|string|max:20',
            'interpretasi_ddst' => 'nullable|string',
            'profile_dan_karakter' => 'nullable|string',
            'saran_rujukan' => 'nullable|string',

            'fotos' => 'nullable|array',
            'fotos.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'delete_foto_ids' => 'nullable|array',
            'delete_foto_ids.*' => 'integer',


        ]);

        DB::beginTransaction();

        try {
            // 1. update data antropometri (bulan ini)
            $antropometri->update([
                'tanggal_ukur' => $request->tanggal_ukur,
                'berat_badan' => $request->berat_badan,
                'tinggi_badan' => $request->tinggi_badan,
                'lingkar_kepala' => $request->lingkar_kepala,
                'lingkar_lengan' => $request->lingkar_lengan,
                'status_gizi' => $request->status_gizi,
                'status_bb' => $request->status_bb,
                'status_tb' => $request->status_tb,
            ]);

            // 2. create / update header ddst_tests (1 per antropometri)
            $ddstTest = DdstTest::updateOrCreate(
                [
                    'antropometris_id' => $antropometri->id,
                    'anaks_id' => $anak->id,
                ],
                [
                    'gurus_id' => $request->gurus_id, // 🔥 ambil dari dropdown
                    'reviewers_id' => $request->reviewers_id,
                    'tanggal_test' => $antropometri->tanggal_ukur,
                    'usia_bulan' => $request->usia_bulan,
                    'semester' => $request->semester,
                    'tahun_ajaran' => $request->tahun_ajaran,
                    'interpretasi_ddst' => $request->interpretasi_ddst,
                    'profile_dan_karakter' => $request->profile_dan_karakter,
                    'saran_rujukan' => $request->saran_rujukan,
                ]
            );

            // hapus foto lama yang ditandai
            if ($request->filled('delete_foto_ids')) {
                $ids = $request->input('delete_foto_ids', []);

                $fotosToDelete = DdstTestFoto::where('ddst_tests_id', $ddstTest->id)
                    ->whereIn('id', $ids)
                    ->get();

                foreach ($fotosToDelete as $foto) {
                    // hapus file fisik
                    if (!empty($foto->foto)) {
                        Storage::disk('public')->delete($foto->foto);
                    }
                    // hapus record
                    $foto->delete();
                }
            }

            // 2.5 simpan foto (multiple)
            if ($request->hasFile('fotos')) {
                foreach ($request->file('fotos') as $file) {
                    $path = $file->store('ddst/foto-anak', 'public');

                    $ddstTest->fotos()->create([
                        'foto' => $path,
                        'caption' => null,
                    ]);
                }
            }



            // 3. simpan tiap item (updateOrCreate biar tidak dobel)
            foreach ($request->items as $ddstItemId => $data) {
                DdstTestItem::updateOrCreate(
                    [
                        'ddst_tests_id' => $ddstTest->id,
                        'ddst_items_id' => $ddstItemId,
                    ],
                    [
                        'status' => $data['status'],
                        'keterangan' => $data['keterangan'] ?? null,
                    ]
                );
            }

            DB::commit();

            return redirect()->route($this->getDdstIndexRouteName())
                ->with('success', 'Tes DDST berhasil disimpan.');
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withErrors(['general' => 'Gagal menyimpan DDST: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function cetakLaporan(Antropometri $antropometri)
    {
        // Eager load relasi yang benar
        $antropometri->load([
            'anak.sekolah',
            'ddstTests.guru',
            'ddstTests.reviewer',
            'ddstTests.fotos',
            'ddstTests.items.item', // Antropometri -> ddstTests -> items -> item (DdstItem)
        ]);

        $anak = $antropometri->anak;
        $ddstTests = $antropometri->ddstTests; // Collection

        // kalau belum ada satupun tes
        if ($ddstTests->isEmpty()) {
            return back()->with('error', 'Tes DDST untuk pengukuran ini belum diisi.');
        }

        // Ambil satu tes untuk dicetak (misal yang terbaru)
        $ddstTest = $ddstTests->sortByDesc('tanggal_test')->first();

        // hitung usia dalam format "X Th Y B Z H"
        $lahir = Carbon::parse($anak->tanggal_lahir);
        $tglTes = Carbon::parse($ddstTest->tanggal_test);
        $diff = $lahir->diff($tglTes);

        $usiaFormatted = sprintf('%d Th %d B %d H', $diff->y, $diff->m, $diff->d);

        $ddstTest = $ddstTests->sortByDesc('tanggal_test')->first();
        $guru = $ddstTest->guru; // ✅ ini pemeriksa

        // ✅ GALLERY: semua foto sampai ddst yang dicetak (bulan-bulan sebelumnya ikut)
        $galleryFotos = DdstTestFoto::query()
            ->with(['ddstTest:id,anaks_id,tanggal_test'])
            ->whereHas('ddstTest', function ($q) use ($anak, $tglTes) {
                $q->where('anaks_id', $anak->id)
                    ->whereDate('tanggal_test', '<=', $tglTes->toDateString());
            })
            // urut lama -> baru (biar enak dilihat)
            ->orderBy('id', 'asc')
            ->get();

        $pdf = Pdf::loadView('shared.tumbuh_kembang.ddst_laporan_pdf', [
            'antropometri' => $antropometri,
            'anak' => $anak,
            'ddstTest' => $ddstTest,      // kirim yang singular
            'usiaFormatted' => $usiaFormatted,
            'guru' => $guru,
            'galleryFotos' => $galleryFotos,
        ])->setPaper('A4', 'portrait');

        $filename = 'Laporan-DDST-' . ($anak->nama_anak ?? 'anak') . '-' .
            $tglTes->format('Ymd') . '.pdf';

        // tampilkan di tab baru (inline)
        return $pdf->stream($filename);
    }




    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DdstTest $ddstTest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DdstTest $ddstTest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DdstTest $ddstTest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DdstTest $ddstTest)
    {
        //
    }
}
