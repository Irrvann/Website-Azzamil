<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Daerah;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // mengambil data admin dengan relasi, dan paginate
        $dataAdmin = Admin::with(['daerah', 'user'])->paginate(10);

        // Data daerah untuk form tambah/edit
        $dataDaerah = Daerah::orderBy('nama_daerah', 'asc')->get();

        return view('superadmin.admin.index', compact('dataAdmin', 'dataDaerah'));
    }

    public function dashboardAdmin()
    {
        //
        return view('admin.dashboard.index');
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
                'nik' => 'nullable|string|max:20|unique:admins,nik',
                'nipa' => 'nullable|string|max:50',
                'nama' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:L,P',
                'alamat' => 'nullable|string|max:500',
                'email' => 'nullable|email|max:255',
                'no_hp' => 'nullable|string|max:20',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'username' => 'required|string|max:50|unique:users,username',
                'password' => 'required|string|min:8',
            ],
            [
                'nik.unique' => 'NIK sudah terdaftar.',
                'username.required' => 'Username wajib diisi.',
                'username.unique' => 'Username sudah digunakan, silakan pilih yang lain.',

                'daerahs_id.required' => 'Daerah wajib dipilih.',
                'daerahs_id.exists' => 'Daerah tidak valid.',
                'nama.required' => 'Nama wajib diisi.',
                'foto.image' => 'Foto harus berupa gambar.',
                'foto.mimes' => 'Foto harus berformat jpeg, png, atau jpg.',
                'foto.max' => 'Ukuran foto maksimal 2MB.',
            ]
        );


        // membuat user
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'status' => 'aktif',
        ]);

        // Assign role
        $user->assignRole('admin');

        $fotoPath = null;

        // path default (sesuaikan dengan lokasi file-mu)
        $defaultFotoPath = 'assets/media/foto/blank.png';

        // LOGIKA FOTO
        if ($request->input('foto_remove') == '1') {
            // User klik hapus → pakai default
            $fotoPath = $defaultFotoPath;
        } elseif ($request->hasFile('foto')) {
            // User upload foto → simpan ke storage
            $fotoPath = $request->file('foto')->store('foto_admin', 'public');
        } else {
            // Tidak upload & tidak hapus → pakai default
            $fotoPath = $defaultFotoPath;
        }


        Admin::create([
            'users_id' => $user->id,
            'daerahs_id' => $request->daerahs_id,
            'nik' => $request->nik,
            'nipa' => $request->nipa,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'foto' => $fotoPath,
        ]);
        return redirect()->route('superadmin.admin.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Cari admin + relasi user
        $admin = Admin::with('user')->findOrFail($id);
        $user = $admin->user;

        // Validasi
        $request->validate(
            [
                'username' => [
                    'required',
                    'string',
                    'max:50',
                    Rule::unique('users', 'username')->ignore($user->id),
                ],
                'status' => [
                    'required',
                    'in:aktif,non_aktif', // sesuaikan dengan enum status di tabel users kamu
                ],
                'password' => [
                    'nullable',
                    'string',
                    'min:8',

                ],
                'daerahs_id' => ['required', 'exists:daerahs,id'],
                'nik' => [
                    'nullable',
                    'string',
                    'max:20',
                    Rule::unique('admins', 'nik')->ignore($admin->id),
                ],
                'nipa' => 'nullable|string|max:50',
                'nama' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:L,P',
                'alamat' => 'nullable|string|max:500',
                'email' => 'nullable|email|max:255',
                'no_hp' => 'nullable|string|max:20',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'username.required' => 'Username wajib diisi.',
                'username.unique' => 'Username sudah digunakan, silakan pilih yang lain.',

                'daerahs_id.required' => 'Daerah wajib dipilih.',
                'daerahs_id.exists' => 'Daerah tidak valid.',

                'nama.required' => 'Nama wajib diisi.',

                'nik.unique' => 'NIK sudah terdaftar.',

                'foto.image' => 'Foto harus berupa gambar.',
                'foto.mimes' => 'Foto harus berformat jpeg, png, atau jpg.',
                'foto.max' => 'Ukuran foto maksimal 2MB.',
            ]
        );


        $userData = [
            'username' => $request->username,
            'status' => $request->status,
        ];
        // Kalau password diisi, update password
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);


        $defaultFotoPath = 'assets/media/foto/blank.png';
        $fotoPath = $admin->foto ?: $defaultFotoPath;

        // Kalau user klik "hapus foto"
        if ($request->input('foto_remove') == '1') {

            // kalau foto lama adalah file upload di storage, boleh dihapus
            if ($admin->foto && \Illuminate\Support\Str::startsWith($admin->foto, 'foto_admin/')) {
                Storage::disk('public')->delete($admin->foto);
            }

            $fotoPath = $defaultFotoPath;
        }
        // Kalau user upload foto baru
        elseif ($request->hasFile('foto')) {

            // hapus foto lama kalau dari storage
            if ($admin->foto && \Illuminate\Support\Str::startsWith($admin->foto, 'foto_admin/')) {
                Storage::disk('public')->delete($admin->foto);
            }

            $fotoPath = $request->file('foto')->store('foto_admin', 'public');
        }

        $admin->update([
            'daerahs_id' => $request->daerahs_id,
            'nik' => $request->nik,
            'nipa' => $request->nipa,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'foto' => $fotoPath,
        ]);

        return redirect()
            ->route('superadmin.admin.index')
            ->with('success', 'Data admin berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $admin = Admin::with('user')->findOrFail($id);

        // Hapus foto kalau ada
        if ($admin->foto && \Illuminate\Support\Str::startsWith($admin->foto, 'foto_admin/')) {
            Storage::disk('public')->delete($admin->foto);
        }

        // Hapus user → karena FK cascade, record admins juga ikut kehapus
        if ($admin->user) {
            // opsional, tapi bagus → bersihkan role dulu
            $admin->user->syncRoles([]);
            $admin->user->delete();
        }

        return redirect()
            ->route('superadmin.admin.index')
            ->with('success', 'Data admin & user berhasil dihapus.');
    }

}
