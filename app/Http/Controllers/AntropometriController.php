<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Antropometri;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        } elseif ($user->hasRole('guru')) {
            $routeNameStore = 'guru.data-tumbuh-kembang.store';
            $routeDdstCreate = 'guru.ddst.create_from_antropometri';
            $routeDdstCetak = 'guru.ddst.cetak_laporan';
            $routeAjaxAnakBySekolah = 'guru.ajax.sekolah.anak';
        } elseif ($user->hasRole('super_admin')) {
            $routeNameStore = 'superadmin.data-tumbuh-kembang.store';
            $routeDdstCreate = 'superadmin.ddst.create_from_antropometri';
            $routeDdstCetak = 'superadmin.ddst.cetak_laporan';
            $routeAjaxAnakBySekolah = 'superadmin.ajax.sekolah.anak';
        } else {
            abort(403, 'Role tidak dikenali');
        }
        // tampilkan semua data antropometri (atau filter per sekolah/guru)
        $dataAntropometri = Antropometri::with('anak', 'anak.sekolah', 'ddstTests')
            ->latest('tanggal_ukur')->paginate(10);

        $dataAnak = Anak::orderBy('nama_anak')->get();
        $dataSekolah = Sekolah::orderBy('nama_sekolah')->get();


        return view('shared.tumbuh_kembang.index', compact('dataAntropometri', 'dataAnak', 'routeNameStore', 'routeDdstCreate', 'routeDdstCetak', 'dataSekolah', 'routeAjaxAnakBySekolah'));
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
    public function destroy(Antropometri $antropometri)
    {
        //
    }

    public function ajaxAnakBySekolah($sekolahId)
    {
        $anak = Anak::where('sekolahs_id', $sekolahId) // kalau kolomnya sekolah_id, ganti di sini
            ->orderBy('nama_anak')
            ->get()
            ->map(fn($a) => [
                'id' => $a->id,
                'text' => $a->nama_anak,
            ]);

        return response()->json(['anak' => $anak]);
    }

}
