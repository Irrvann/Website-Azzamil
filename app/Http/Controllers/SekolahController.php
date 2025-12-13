<?php

namespace App\Http\Controllers;

use App\Models\Daerah;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function getSekolahIndexRouteName(): string
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return 'admin.sekolah.index';
        }

        if ($user->hasRole('super_admin')) {
            return 'superadmin.sekolah.index';
        }

        abort(403, 'Role tidak dikenali');
    }
    public function index()
    {
        //
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            $routeNameStore = 'admin.sekolah.store';
            $routeNameUpdate = 'admin.sekolah.update';
            $routeNameDelete = 'admin.sekolah.destroy';
        } elseif ($user->hasRole('super_admin')) {
            $routeNameStore = 'superadmin.sekolah.store';
            $routeNameUpdate = 'superadmin.sekolah.update';
            $routeNameDelete = 'superadmin.sekolah.destroy';
        } else {
            abort(403, 'Role tidak dikenali');
        }

        $search = request('search');
        $daerahId = request('daerahs_id');

        $dataSekolah = Sekolah::with('daerah')
            ->when($search, fn($q) => $q->where('nama_sekolah', 'like', "%{$search}%"))
            ->when($daerahId, fn($q) => $q->where('daerahs_id', $daerahId))
            ->orderBy('nama_sekolah', 'asc')
            ->paginate(10)
            ->appends(request()->query());

        $dataDaerah = Daerah::orderBy('nama_daerah', 'asc')->get();


        return view('shared.sekolah.index', compact('dataSekolah', 'dataDaerah', 'routeNameStore', 'routeNameUpdate', 'routeNameDelete'));
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
        $request->validate(
            [
                'daerahs_id' => 'required|exists:daerahs,id',
                'nama_sekolah' => 'required|string|max:255',
                'jenis_sekolah' => 'required|in:baby,toddler,pra_kb,kb_kecil,kb_besar,tk',
                'kelas' => 'required|string|max:100',
            ],
            [
                'daerahs_id.required' => 'Daerah wajib dipilih.',
                'daerahs_id.exists' => 'Daerah yang dipilih tidak valid.',
                'nama_sekolah.required' => 'Nama sekolah wajib diisi.',
                'nama_sekolah.string' => 'Nama sekolah harus berupa teks.',
                'nama_sekolah.max' => 'Nama sekolah maksimal 255 karakter.',
                'jenis_sekolah.required' => 'Jenis sekolah wajib diisi.',
                'jenis_sekolah.in' => 'Jenis sekolah harus berupa Negeri atau Swasta.',
                'kelas.required' => 'Kelas wajib diisi.',
                'kelas.string' => 'Kelas harus berupa teks.',
                'kelas.max' => 'Kelas maksimal 100 karakter.',
            ]
        );

        Sekolah::create([
            'daerahs_id' => $request->daerahs_id,
            'nama_sekolah' => $request->nama_sekolah,
            'jenis_sekolah' => $request->jenis_sekolah,
            'kelas' => $request->kelas,
        ]);

        return redirect()->route($this->getSekolahIndexRouteName())->with('success', 'Sekolah berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sekolah $sekolah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sekolah $sekolah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate(
            [
                'daerahs_id' => 'required|exists:daerahs,id',
                'nama_sekolah' => 'required|string|max:255',
                'jenis_sekolah' => 'required|in:baby,toddler,pra_kb,kb_kecil,kb_besar,tk',
                'kelas' => 'required|string|max:100',
            ],
            [
                'daerahs_id.required' => 'Daerah wajib dipilih.',
                'daerahs_id.exists' => 'Daerah yang dipilih tidak valid.',
                'nama_sekolah.required' => 'Nama sekolah wajib diisi.',
                'nama_sekolah.string' => 'Nama sekolah harus berupa teks.',
                'nama_sekolah.max' => 'Nama sekolah maksimal 255 karakter.',
                'jenis_sekolah.required' => 'Jenis sekolah wajib diisi.',
                'jenis_sekolah.in' => 'Jenis sekolah harus berupa Negeri atau Swasta.',
                'kelas.required' => 'Kelas wajib diisi.',
                'kelas.string' => 'Kelas harus berupa teks.',
                'kelas.max' => 'Kelas maksimal 100 karakter.',
            ]
        );

        $sekolah = Sekolah::findOrFail($id);

        $sekolah->update([
            'daerahs_id' => $request->daerahs_id,
            'nama_sekolah' => $request->nama_sekolah,
            'jenis_sekolah' => $request->jenis_sekolah,
            'kelas' => $request->kelas,
        ]);

        return redirect()->route($this->getSekolahIndexRouteName())->with('success', 'Sekolah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            // Ambil sekolah + semua guru + user-nya
            $sekolah = Sekolah::with(['gurus.user'])->findOrFail($id);

            // Loop semua guru di sekolah ini
            foreach ($sekolah->gurus as $guru) {
                // Kalau guru punya user
                if ($guru->user) {
                    // Hapus user (Spatie otomatis hapus model_has_roles untuk user ini)
                    $guru->user->delete();
                }

                // Hapus data guru
                $guru->delete();
            }

            // Terakhir hapus sekolah
            $sekolah->delete();

            DB::commit();

            return redirect()
                ->route($this->getSekolahIndexRouteName())
                ->with('success', 'Sekolah beserta semua guru & user terkait berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()
                ->route($this->getSekolahIndexRouteName())
                ->with('error', 'Gagal menghapus sekolah: ' . $th->getMessage());
        }
    }

}
