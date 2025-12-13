<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\OrangTua;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnakController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private function getAnakIndexRouteName(): string
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return 'admin.anak.index';
        }

        if ($user->hasRole('guru')) {
            return 'guru.anak.index';
        }

        if ($user->hasRole('super_admin')) {
            return 'superadmin.anak.index';
        }

        abort(403, 'Role tidak dikenali');
    }

    public function index()
    {
        //
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $routeNameStore = 'admin.anak.store';
            $routeNameUpdate = 'admin.anak.update';
            $routeNameDelete = 'admin.anak.destroy';
        } elseif ($user->hasRole('guru')) {
            $routeNameStore = 'guru.anak.store';
            $routeNameUpdate = 'guru.anak.update';
            $routeNameDelete = 'guru.anak.destroy';
        } elseif ($user->hasRole('super_admin')) {
            $routeNameStore = 'superadmin.anak.store';
            $routeNameUpdate = 'superadmin.anak.update';
            $routeNameDelete = 'superadmin.anak.destroy';
        } else {
            abort(403, 'Role tidak dikenali');
        }
        $dataAnak = Anak::with(['orangTua', 'sekolah'])->paginate(10);
        $dataOrangTua = OrangTua::orderBy('nama_ayah', 'asc')->orderBy('nama_ibu', 'asc')->get();
        $dataSekolah = Sekolah::orderBy('nama_sekolah', 'asc')->get();

        return view('shared.anak.index', compact('dataAnak', 'dataOrangTua', 'dataSekolah', 'routeNameStore', 'routeNameUpdate', 'routeNameDelete'));
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
                'orang_tuas_id' => 'required|exists:orang_tuas,id',
                'sekolahs_id' => 'required|exists:sekolahs,id',
                'nik' => 'required|string|max:20',
                'nisn' => 'required|string|max:20',
                'nipd' => 'required|string|max:20',
                'no_kk' => 'required|string|max:20',
                'no_registrasi_kk' => 'required|string|max:20',
                'nama_anak' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:L,P',
                'tanggal_masuk' => 'nullable|date',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'orang_tuas_id.required' => 'Orang tua wajib dipilih.',
                'orang_tuas_id.exists' => 'Orang tua yang dipilih tidak valid.',
                'sekolahs_id.required' => 'Sekolah wajib dipilih.',
                'sekolahs_id.exists' => 'Sekolah yang dipilih tidak valid.',
                'nik.required' => 'NIK wajib diisi.',
                'nik.string' => 'NIK harus berupa teks.',
                'nik.max' => 'NIK maksimal 20 karakter.',
                'nisn.required' => 'NISN wajib diisi.',
                'nisn.string' => 'NISN harus berupa teks.',
                'nisn.max' => 'NISN maksimal 20 karakter.',
                'nipd.required' => 'NIPD wajib diisi.',
                'nipd.string' => 'NIPD harus berupa teks.',
                'nipd.max' => 'NIPD maksimal 20 karakter.',
                'no_kk.required' => 'No KK wajib diisi.',
                'no_kk.string' => 'No KK harus berupa teks.',
                'no_kk.max' => 'No KK maksimal 20 karakter.',
                'no_registrasi_kk.required' => 'No Registrasi KK wajib diisi.',
                'no_registrasi_kk.string' => 'No Registrasi KK harus berupa teks.',
                'no_registrasi_kk.max' => 'No Registrasi KK maksimal 20 karakter.',
                'nama_anak.required' => 'Nama anak wajib diisi.',
                'nama_anak.string' => 'Nama anak harus berupa teks.',
                'nama_anak.max' => 'Nama anak maksimal 255 karakter.',
                'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
                'tempat_lahir.string' => 'Tempat lahir harus berupa teks.',
                'tempat_lahir.max' => 'Tempat lahir maksimal 255 karakter.',
                'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
                'tanggal_lahir.date' => 'Tanggal lahir tidak valid.',
                'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
                'jenis_kelamin.in' => 'Jenis kelamin harus berupa L atau P.',
                'tanggal_masuk.date' => 'Tanggal masuk tidak valid.',
                'foto.image' => 'Foto harus berupa file gambar.',
                'foto.mimes' => 'Foto harus berformat jpeg, png, jpg, atau gif.',
                'foto.max' => 'Ukuran foto maksimal 2MB.',
            ]
        );

        $fotoPath = null;

        // path default (sesuaikan dengan lokasi file-mu)
        $defaultFotoPath = 'assets/media/foto/blank.png';

        // LOGIKA FOTO
        if ($request->input('foto_remove') == '1') {
            // User klik hapus → pakai default
            $fotoPath = $defaultFotoPath;
        } elseif ($request->hasFile('foto')) {
            // User upload foto → simpan ke storage
            $fotoPath = $request->file('foto')->store('foto_anak', 'public');
        } else {
            // Tidak upload & tidak hapus → pakai default
            $fotoPath = $defaultFotoPath;
        }


        Anak::create([
            'sekolahs_id' => $request->sekolahs_id,
            'orang_tuas_id' => $request->orang_tuas_id,
            'nik' => $request->nik,
            'nisn' => $request->nisn,
            'nipd' => $request->nipd,
            'no_kk' => $request->no_kk,
            'no_registrasi_kk' => $request->no_registrasi_kk,
            'nama_anak' => $request->nama_anak,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_masuk' => $request->tanggal_masuk,
            'foto' => $fotoPath,
        ]);

        return redirect()->route($this->getAnakIndexRouteName())->with('success', 'Anak berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Anak $anak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anak $anak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $anak = Anak::findOrFail($id);

        $request->validate(
            [
                'orang_tuas_id' => 'required|exists:orang_tuas,id',
                'sekolahs_id' => 'required|exists:sekolahs,id',
                'nik' => 'required|string|max:20',
                'nisn' => 'required|string|max:20',
                'nipd' => 'required|string|max:20',
                'no_kk' => 'required|string|max:20',
                'no_registrasi_kk' => 'required|string|max:20',
                'nama_anak' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:L,P',
                'tanggal_masuk' => 'nullable|date',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'orang_tuas_id.required' => 'Orang tua wajib dipilih.',
                'orang_tuas_id.exists' => 'Orang tua yang dipilih tidak valid.',
                'sekolahs_id.required' => 'Sekolah wajib dipilih.',
                'sekolahs_id.exists' => 'Sekolah yang dipilih tidak valid.',
                'nik.required' => 'NIK wajib diisi.',
                'nik.string' => 'NIK harus berupa teks.',
                'nik.max' => 'NIK maksimal 20 karakter.',
                'nisn.required' => 'NISN wajib diisi.',
                'nisn.string' => 'NISN harus berupa teks.',
                'nisn.max' => 'NISN maksimal 20 karakter.',
                'nipd.required' => 'NIPD wajib diisi.',
                'nipd.string' => 'NIPD harus berupa teks.',
                'nipd.max' => 'NIPD maksimal 20 karakter.',
                'no_kk.required' => 'No KK wajib diisi.',
                'no_kk.string' => 'No KK harus berupa teks.',
                'no_kk.max' => 'No KK maksimal 20 karakter.',
                'no_registrasi_kk.required' => 'No Registrasi KK wajib diisi.',
                'no_registrasi_kk.string' => 'No Registrasi KK harus berupa teks.',
                'no_registrasi_kk.max' => 'No Registrasi KK maksimal 20 karakter.',
                'nama_anak.required' => 'Nama anak wajib diisi.',
                'nama_anak.string' => 'Nama anak harus berupa teks.',
                'nama_anak.max' => 'Nama anak maksimal 255 karakter.',
                'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
                'tempat_lahir.string' => 'Tempat lahir harus berupa teks.',
                'tempat_lahir.max' => 'Tempat lahir maksimal 255 karakter.',
                'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
                'tanggal_lahir.date' => 'Tanggal lahir tidak valid.',
                'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
                'jenis_kelamin.in' => 'Jenis kelamin harus berupa L atau P.',
                'tanggal_masuk.date' => 'Tanggal masuk tidak valid.',
                'foto.image' => 'Foto harus berupa file gambar.',
                'foto.mimes' => 'Foto harus berformat jpeg, png, jpg, atau gif.',
                'foto.max' => 'Ukuran foto maksimal 2MB.',
            ]
        );

        $defaultFotoPath = 'assets/media/foto/blank.png';
        $fotoPath = $anak->foto ?: $defaultFotoPath;

        // Kalau user klik "hapus foto"
        if ($request->input('foto_remove') == '1') {

            // kalau foto lama adalah file upload di storage, boleh dihapus
            if ($anak->foto && \Illuminate\Support\Str::startsWith($anak->foto, 'foto_anak/')) {
                Storage::disk('public')->delete($anak->foto);
            }

            $fotoPath = $defaultFotoPath;
        }
        // Kalau user upload foto baru
        elseif ($request->hasFile('foto')) {

            // hapus foto lama kalau dari storage
            if ($anak->foto && \Illuminate\Support\Str::startsWith($anak->foto, 'foto_anak/')) {
                Storage::disk('public')->delete($anak->foto);
            }

            $fotoPath = $request->file('foto')->store('foto_anak', 'public');
        }

        $anak->update([
            'sekolahs_id' => $request->sekolahs_id,
            'orang_tuas_id' => $request->orang_tuas_id,
            'nik' => $request->nik,
            'nisn' => $request->nisn,
            'nipd' => $request->nipd,
            'no_kk' => $request->no_kk,
            'no_registrasi_kk' => $request->no_registrasi_kk,
            'nama_anak' => $request->nama_anak,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_masuk' => $request->tanggal_masuk,
            'foto' => $fotoPath,
        ]);


        return redirect()
            ->route($this->getAnakIndexRouteName())
            ->with('success', 'Data admin berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $anak = Anak::findOrFail($id);
        if ($anak->foto && \Illuminate\Support\Str::startsWith($anak->foto, 'foto_anak/')) {
            Storage::disk('public')->delete($anak->foto);
        }
        $anak->delete();

        return redirect()
            ->route($this->getAnakIndexRouteName())
            ->with('success', 'Data anak berhasil dihapus.');
    }
}
