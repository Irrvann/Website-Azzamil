<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Antropometri;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AntropometriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function getTumbuhKembangIndexRouteName(): string
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
    public function index()
    {
        //
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            $routeNameStore = 'admin.data-tumbuh-kembang.store';
            $routeDdstCreate = 'admin.ddst.create_from_antropometri';
            $routeDdstCetak = 'admin.ddst.cetak_laporan';
            $routeAjaxAnakBySekolah = 'admin.ajax.sekolah.anak';
            $routeAntropometriDestroy = 'admin.antropometri.destroy';
        } elseif ($user->hasRole('guru')) {
            $routeNameStore = 'guru.data-tumbuh-kembang.store';
            $routeDdstCreate = 'guru.ddst.create_from_antropometri';
            $routeDdstCetak = 'guru.ddst.cetak_laporan';
            $routeAjaxAnakBySekolah = 'guru.ajax.sekolah.anak';
            $routeAntropometriDestroy = 'guru.antropometri.destroy';
        } elseif ($user->hasRole('super_admin')) {
            $routeNameStore = 'superadmin.data-tumbuh-kembang.store';
            $routeDdstCreate = 'superadmin.ddst.create_from_antropometri';
            $routeDdstCetak = 'superadmin.ddst.cetak_laporan';
            $routeAjaxAnakBySekolah = 'superadmin.ajax.sekolah.anak';
            $routeAntropometriDestroy = 'superadmin.antropometri.destroy';
        } else {
            abort(403, 'Role tidak dikenali');
        }

        $guruSekolahId = $user->hasRole('guru') ? $user->guru?->sekolahs_id : null;

        // kalau guru belum punya sekolah, tampilkan kosong
        if ($user->hasRole('guru') && !$guruSekolahId) {
            $dataAntropometri = Antropometri::whereRaw('1=0')->paginate(10);
            $dataAnak = collect();
            $dataSekolah = collect();

            return view('shared.tumbuh_kembang.index', compact(
                'dataAntropometri',
                'dataAnak',
                'routeNameStore',
                'routeDdstCreate',
                'routeDdstCetak',
                'dataSekolah',
                'routeAjaxAnakBySekolah',
                'routeAntropometriDestroy'
            ));
        }

        $dataAntropometri = Antropometri::with(['anak.sekolah', 'ddstTests'])
            ->when($user->hasRole('guru'), function ($q) use ($guruSekolahId) {
                $q->whereHas('anak', fn($qa) => $qa->where('sekolahs_id', $guruSekolahId));
            })
            ->latest('tanggal_ukur')
            ->paginate(10);

        // dropdown & list anak untuk modal tambah
        $dataAnak = Anak::when($user->hasRole('guru'), fn($q) => $q->where('sekolahs_id', $guruSekolahId))
            ->orderBy('nama_anak')
            ->get();

        $dataSekolah = Sekolah::when($user->hasRole('guru'), fn($q) => $q->where('id', $guruSekolahId))
            ->orderBy('nama_sekolah')
            ->get();



        return view('shared.tumbuh_kembang.index', compact('dataAntropometri', 'dataAnak', 'routeNameStore', 'routeDdstCreate', 'routeDdstCetak', 'dataSekolah', 'routeAjaxAnakBySekolah', 'routeAntropometriDestroy'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //


        $request->validate([
            'anaks_id' => 'required|exists:anaks,id',
            'tanggal_ukur' => 'required|date',
            'tinggi_badan' => 'nullable|numeric',
            'berat_badan' => 'nullable|numeric',
            'lingkar_kepala' => 'nullable|numeric',
            'lingkar_lengan' => 'nullable|numeric',
            'status_gizi' => 'nullable|in:normal,gizi_kurang,gizi_berlebih',
            'status_bb' => 'nullable|in:normal,resiko',
            'status_tb' => 'nullable|in:normal,pendek',
        ]);

        $user = Auth::user();

        if ($user->hasRole('guru')) {
            $guruSekolahId = $user->guru?->sekolahs_id;
            if (!$guruSekolahId)
                abort(403, 'Akun guru belum memiliki sekolah');

            $anak = Anak::findOrFail($request->anaks_id);
            if ((int) $anak->sekolahs_id !== (int) $guruSekolahId) {
                abort(403, 'Tidak boleh menambah antropometri untuk anak dari sekolah lain');
            }
        }

        Antropometri::create($request->only([
            'anaks_id',
            'tanggal_ukur',
            'tinggi_badan',
            'berat_badan',
            'lingkar_kepala',
            'lingkar_lengan',
            'status_gizi',
            'status_bb',
            'status_tb',
        ]));

        return redirect()->route($this->getTumbuhKembangIndexRouteName())
            ->with('success', 'Data tumbuh kembang berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Antropometri $antropometri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Antropometri $antropometri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Antropometri $antropometri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */


    public function ajaxAnakBySekolah($sekolahId)
    {
        $user = Auth::user();
        if ($user->hasRole('guru')) {
            $guruSekolahId = $user->guru?->sekolahs_id;
            if (!$guruSekolahId || (int) $sekolahId !== (int) $guruSekolahId) {
                abort(403);
            }
        }
        $anak = Anak::where('sekolahs_id', $sekolahId) // kalau kolomnya sekolah_id, ganti di sini
            ->orderBy('nama_anak')
            ->get()
            ->map(fn($a) => [
                'id' => $a->id,
                'text' => $a->nama_anak,
            ]);

        return response()->json(['anak' => $anak]);
    }

    public function destroy(Antropometri $antropometri)
    {
        if (auth()->user()->hasRole('guru')) {
            abort(403, 'Guru tidak memiliki izin menghapus data.');
        }
        DB::beginTransaction();

        try {
            // Load relasi DDST (tests -> items + fotos)
            $antropometri->load(['ddstTests.items', 'ddstTests.fotos']);

            foreach ($antropometri->ddstTests as $test) {
                // 1) hapus file foto + record foto
                foreach ($test->fotos as $foto) {
                    if (!empty($foto->foto)) {
                        Storage::disk('public')->delete($foto->foto);
                    }
                    $foto->delete();
                }

                // 2) hapus items ddst_test_items
                $test->items()->delete();

                // 3) hapus ddst_tests
                $test->delete();
            }

            // 4) hapus antropometri
            $antropometri->delete();

            DB::commit();
            return back()->with('success', 'Data antropometri berhasil dihapus.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal hapus: ' . $e->getMessage());
        }
    }

}
