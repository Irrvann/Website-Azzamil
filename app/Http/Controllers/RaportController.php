<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Guru;
use App\Models\Raport;
use App\Models\RaportFoto;
use App\Models\Sekolah;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RaportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    private function getRaportIndexRouteName(): string
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return 'admin.raport.index';
        }

        if ($user->hasRole('super_admin')) {
            return 'superadmin.raport.index';
        }

        if ($user->hasRole('guru')) {
            return 'guru.raport.index';
        }

        abort(403, 'Role tidak dikenali');
    }

    public function index()
    {
        //
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            $routeNameStore = 'admin.raport.store';
            $routeNameUpdate = 'admin.raport.update';
            $routeNameDelete = 'admin.raport.destroy';
            $routeCetakPdf = 'admin.raport.cetak-pdf';
        } elseif ($user->hasRole('super_admin')) {
            $routeNameStore = 'superadmin.raport.store';
            $routeNameUpdate = 'superadmin.raport.update';
            $routeNameDelete = 'superadmin.raport.destroy';
            $routeCetakPdf = 'superadmin.raport.cetak-pdf';

        } elseif ($user->hasRole(roles: 'guru')) {
            $routeNameStore = 'guru.raport.store';
            $routeNameUpdate = 'guru.raport.update';
            $routeNameDelete = 'guru.raport.destroy';
            $routeCetakPdf = 'guru.raport.cetak-pdf';

        } else {
            abort(403, 'Role tidak dikenali');
        }
        $dataRaports = Raport::with(['anak', 'guru', 'sekolah', 'fotos'])
            ->latest()
            ->paginate(10);

        $dataSekolah = Sekolah::orderBy('nama_sekolah', 'asc')->get();
        $dataAnak = Anak::with([
            'antropometris' => function ($q) {
                $q->latest('tanggal_ukur')->limit(1);
            }
        ])->orderBy('nama_anak', 'asc')->get();

        $dataGuru = Guru::orderBy('nama_guru', 'asc')->get();


        return view('shared.raport.index', compact('dataRaports', 'dataSekolah', 'dataAnak', 'dataGuru', 'routeNameStore','routeNameUpdate', 'routeNameDelete', 'routeCetakPdf'));
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
        $validated = $request->validate([
            // pakai nama input dari form (anaks_id, sekolahs_id, gurus_id)
            'sekolahs_id' => 'required|exists:sekolahs,id',
            'anaks_id' => 'required|exists:anaks,id',
            'gurus_id' => 'required|exists:gurus,id',
            'semester' => 'required|in:1,2',
            'tahun_ajaran' => 'required|string|max:20',

            'nilai_agama' => 'nullable|string',
            'nilai_jati_diri' => 'nullable|string',
            'nilai_literasi_sains' => 'nullable|string',
            'nilai_p5' => 'nullable|string',

            'refleksi_guru' => 'nullable|string',

            'sakit' => 'nullable|integer|min:0',
            'izin' => 'nullable|integer|min:0',
            'tanpa_keterangan' => 'nullable|integer|min:0',

            'foto_agama.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_jati_diri.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_literasi_sains.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_p5.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // DI SINI KUNCI NYA: mapping ke NAMA KOLOM DI TABEL
            $raport = Raport::create([
                // sesuaikan dengan nama kolom di tabel `raports`
                'sekolah_id' => $validated['sekolahs_id'],  // kalau nama kolom di DB `sekolah_id`
                'anak_id' => $validated['anaks_id'],     // ini yang dikeluhkan di error
                'guru_id' => $validated['gurus_id'],     // sesuaikan juga

                'semester' => $validated['semester'],
                'tahun_ajaran' => $validated['tahun_ajaran'],
                'nilai_agama' => $request->nilai_agama,
                'nilai_jati_diri' => $request->nilai_jati_diri,
                'nilai_literasi_sains' => $request->nilai_literasi_sains,
                'nilai_p5' => $request->nilai_p5,
                'refleksi_guru' => $request->refleksi_guru,
                'sakit' => $request->sakit ?? 0,
                'izin' => $request->izin ?? 0,
                'tanpa_keterangan' => $request->tanpa_keterangan ?? 0,
            ]);

            $this->storeFotosByKomponen($raport, $request, 'foto_agama', 'agama');
            $this->storeFotosByKomponen($raport, $request, 'foto_jati_diri', 'jati_diri');
            $this->storeFotosByKomponen($raport, $request, 'foto_literasi_sains', 'literasi_sains');
            $this->storeFotosByKomponen($raport, $request, 'foto_p5', 'p5');

            DB::commit();

            return redirect()
                ->route($this->getRaportIndexRouteName())
                ->with('success', 'Raport berhasil disimpan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage()); // sementara biar kalau ada error lain kelihatan
        }
    }


    protected function storeFotosByKomponen(Raport $raport, Request $request, string $field, string $komponen)
    {
        if (!$request->hasFile($field)) {
            return;
        }

        foreach ($request->file($field) as $file) {
            if (!$file || !$file->isValid()) {
                continue;
            }

            // simpan ke storage/app/public/raport/<komponen>
            $path = $file->store("raport/{$komponen}", 'public');

            RaportFoto::create([
                'raport_id' => $raport->id,
                'komponen' => $komponen,
                'foto' => $path,
            ]);
        }
    }
    public function show(Request $request, Raport $raport)
    {
        //


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Raport $raport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Ambil data raport berdasarkan ID
        $raport = Raport::findOrFail($id);
        // dd($request->input('delete_foto_ids'));

        // Validasi
        $validated = $request->validate([
            'sekolahs_id' => 'required|exists:sekolahs,id',
            'anaks_id' => 'required|exists:anaks,id',
            'gurus_id' => 'required|exists:gurus,id',
            'semester' => 'required|in:1,2',
            'tahun_ajaran' => 'required|string|max:20',

            'nilai_agama' => 'nullable|string',
            'nilai_jati_diri' => 'nullable|string',
            'nilai_literasi_sains' => 'nullable|string',
            'nilai_p5' => 'nullable|string',

            'refleksi_guru' => 'nullable|string',

            'sakit' => 'nullable|integer|min:0',
            'izin' => 'nullable|integer|min:0',
            'tanpa_keterangan' => 'nullable|integer|min:0',

            'foto_agama.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_jati_diri.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_literasi_sains.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_p5.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // UPDATE DATA RAPORT
            $raport->update([
                'sekolah_id' => $validated['sekolahs_id'],
                'anak_id' => $validated['anaks_id'],
                'guru_id' => $validated['gurus_id'],
                'semester' => $validated['semester'],
                'tahun_ajaran' => $validated['tahun_ajaran'],
                'nilai_agama' => $request->nilai_agama,
                'nilai_jati_diri' => $request->nilai_jati_diri,
                'nilai_literasi_sains' => $request->nilai_literasi_sains,
                'nilai_p5' => $request->nilai_p5,
                'refleksi_guru' => $request->refleksi_guru,
                'sakit' => $request->sakit ?? 0,
                'izin' => $request->izin ?? 0,
                'tanpa_keterangan' => $request->tanpa_keterangan ?? 0,
            ]);

            // ================= HAPUS FOTO LAMA =================
            // ambil array id foto yang mau dihapus dari form
            $deleteIds = (array) $request->input('delete_foto_ids', []);

            if (!empty($deleteIds)) {
                $fotosToDelete = RaportFoto::whereIn('id', $deleteIds)->get();

                foreach ($fotosToDelete as $foto) {
                    // hapus file fisik kalau ada
                    if ($foto->foto && Storage::disk('public')->exists($foto->foto)) {
                        Storage::disk('public')->delete($foto->foto);
                    }

                    // hapus record di database
                    $foto->delete();
                }
            }

            // ================= TAMBAH FOTO BARU =================
            $this->storeFotosByKomponen($raport, $request, 'foto_agama', 'agama');
            $this->storeFotosByKomponen($raport, $request, 'foto_jati_diri', 'jati_diri');
            $this->storeFotosByKomponen($raport, $request, 'foto_literasi_sains', 'literasi_sains');
            $this->storeFotosByKomponen($raport, $request, 'foto_p5', 'p5');

            DB::commit();

            return redirect()
                ->route($this->getRaportIndexRouteName())
                ->with('success', 'Raport berhasil diperbarui.');

        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Ambil raport beserta fotonya
        $raport = Raport::with('fotos')->findOrFail($id);

        DB::beginTransaction();

        try {
            // 1. Hapus semua foto terkait (file + record)
            foreach ($raport->fotos as $foto) {
                if ($foto->foto && Storage::disk('public')->exists($foto->foto)) {
                    Storage::disk('public')->delete($foto->foto); // hapus file fisik
                }

                $foto->delete(); // hapus row di tabel raport_fotos
            }

            // 2. Hapus raport
            $raport->delete();

            DB::commit();

            return redirect()
                ->route($this->getRaportIndexRouteName())
                ->with('success', 'Raport dan semua fotonya berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // untuk debug:
            // dd($th->getMessage());
            return redirect()
                ->route($this->getRaportIndexRouteName())
                ->with('error', 'Gagal menghapus raport: ' . $th->getMessage());
        }
    }

    public function cetakPdf($id)
    {
        $raport = Raport::with([
            'anak.sekolah',
            'guru',
            'fotos',
            'anak.antropometris'
        ])->findOrFail($id);

        $kepala_sekolah = Guru::where('jabatan', 'kepala_sekolah')->first();

        $fotosAgama = $raport->fotos->where('komponen', 'agama');
        $fotosJatiDiri = $raport->fotos->where('komponen', 'jati_diri');
        $fotosLiterasiSains = $raport->fotos->where('komponen', 'literasi_sains');
        $fotosP5 = $raport->fotos->where('komponen', 'p5');

        $data = compact(
            'raport',
            'fotosAgama',
            'fotosJatiDiri',
            'fotosLiterasiSains',
            'fotosP5',
            'kepala_sekolah'
        );

        $pdf = Pdf::loadView('shared.raport.pdf_template', $data)
            ->setPaper('A4', 'portrait');

        // ----- SANITIZE NAMA FILE DI SINI -----
        $namaAnak = $raport->anak->nama_anak ?? 'raport';
        $semester = $raport->semester;
        $tahunAjaran = $raport->tahun_ajaran;

        // Hilangkan / dan \ dari tahun ajaran
        $tahunAjaranSafe = str_replace(['/', '\\'], '-', $tahunAjaran);

        // Boleh juga nama anak di-slug biar aman
        $namaAnakSafe = Str::slug($namaAnak, '_'); // contoh: "Satria Mahatir" -> "satria_mahatir"

        $fileName = 'Raport_' . $namaAnakSafe . '_S' . $semester . '_' . $tahunAjaranSafe . '.pdf';
        // --------------------------------------

        return $pdf->stream($fileName);
        // atau: return $pdf->download($fileName);
    }

}
