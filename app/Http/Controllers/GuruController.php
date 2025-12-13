<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private function getGuruIndexRouteName(): string
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return 'admin.guru.index';
        }

        if ($user->hasRole('super_admin')) {
            return 'superadmin.guru.index';
        }

        abort(403, 'Role tidak dikenali');
    }

    public function index()
    {
        //
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            $routeNameStore = 'admin.guru.store';
            $routeNameUpdate = 'admin.guru.update';
            $routeNameDelete = 'admin.guru.destroy';
        } elseif ($user->hasRole('super_admin')) {
            $routeNameStore = 'superadmin.guru.store';
            $routeNameUpdate = 'superadmin.guru.update';
            $routeNameDelete = 'superadmin.guru.destroy';
        } else {
            abort(403, 'Role tidak dikenali');
        }
        $dataGuru = Guru::with(['sekolah', 'user'])->paginate(10);

        // Data daerah untuk form tambah/edit
        $dataSekolah = Sekolah::orderBy('nama_sekolah', 'asc')->get();

        return view('shared.guru.index', compact('dataGuru', 'dataSekolah', 'routeNameStore', 'routeNameUpdate', 'routeNameDelete'));
    }

    public function dashboardGuru()
    {
        //
        return view('guru.dashboard.index');
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
                'sekolahs_id' => 'required|exists:sekolahs,id',
                'nik' => 'nullable|string|max:20|unique:gurus,nik',
                'nipa' => 'nullable|string|max:50',
                'nama_guru' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:L,P',
                'jabatan' => 'nullable|in:kepala_sekolah,guru,operator',
                'alamat' => 'nullable|string|max:500',
                'email' => 'nullable|email|max:255',
                'no_hp' => 'nullable|string|max:20',
                'pend_terakhir' => 'nullable|in:smp,sma,smk,d3,s1,s2,s3',
                'jurusan' => 'nullable|string|max:100',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'tanggal_masuk' => 'nullable|date',
                'username' => 'required|string|max:50|unique:users,username',
                'password' => 'required|string|min:8',
            ],
            [
                'nik.unique' => 'NIK sudah terdaftar.',
                'username.required' => 'Username wajib diisi.',
                'username.unique' => 'Username sudah digunakan, silakan pilih yang lain.',

                'sekolahs_id.required' => 'Sekolah wajib dipilih.',
                'sekolahs_id.exists' => 'Sekolah tidak valid.',
                'nama_guru.required' => 'Nama wajib diisi.',
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
        $user->assignRole('guru');

        $fotoPath = null;

        // path default (sesuaikan dengan lokasi file-mu)
        $defaultFotoPath = 'assets/media/foto/blank.png';

        // LOGIKA FOTO
        if ($request->input('foto_remove') == '1') {
            // User klik hapus → pakai default
            $fotoPath = $defaultFotoPath;
        } elseif ($request->hasFile('foto')) {
            // User upload foto → simpan ke storage
            $fotoPath = $request->file('foto')->store('foto_guru', 'public');
        } else {
            // Tidak upload & tidak hapus → pakai default
            $fotoPath = $defaultFotoPath;
        }

        Guru::create([
            'users_id' => $user->id,
            'sekolahs_id' => $request->sekolahs_id,
            'nik' => $request->nik,
            'nipa' => $request->nipa,
            'nama_guru' => $request->nama_guru,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'pend_terakhir' => $request->pend_terakhir,
            'jurusan' => $request->jurusan,
            'foto' => $fotoPath,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);
        return redirect()->route($this->getGuruIndexRouteName())->with('success', 'Guru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guru $guru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $guru = Guru::with('user')->findOrFail($id);
        $user = $guru->user;

        // Validasi
        $request->validate(
            [
                'username' => [
                    'required',
                    'string',
                    'max:50',
                    Rule::unique('users', 'username')->ignore($user->id),
                ],
                'password' => [
                    'nullable',
                    'string',
                    'min:8',
                ],

                'sekolahs_id' => ['required', 'exists:sekolahs,id'],

                'nik' => [
                    'nullable',
                    'string',
                    'max:20',
                    Rule::unique('gurus', 'nik')->ignore($guru->id),
                ],
                'nipa' => 'nullable|string|max:50',
                'nama_guru' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:L,P',
                'jabatan' => 'required|string|in:kepala_sekolah,guru,operator',
                'alamat' => 'nullable|string|max:500',
                'email' => 'nullable|email|max:255',
                'no_hp' => 'nullable|string|max:20',

                'pend_terakhir' => [
                    'required',
                    'in:smp,sma,smk,d3,s1,s2,s3',
                ],
                'jurusan' => 'required|string|max:255',
                'tanggal_masuk' => 'required|date',

                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'status' => [
                    'required',
                    'in:aktif,non_aktif',
                ],
            ],
            [
                'username.required' => 'Username wajib diisi.',
                'username.unique' => 'Username sudah digunakan, silakan pilih yang lain.',

                'sekolahs_id.required' => 'Sekolah wajib dipilih.',
                'sekolahs_id.exists' => 'Sekolah tidak valid.',

                'nama_guru.required' => 'Nama guru wajib diisi.',

                'nik.unique' => 'NIK sudah terdaftar.',

                'pend_terakhir.required' => 'Pendidikan terakhir wajib dipilih.',
                'pend_terakhir.in' => 'Pendidikan terakhir tidak valid.',

                'jurusan.required' => 'Jurusan wajib diisi.',
                'tanggal_masuk.required' => 'Tanggal masuk wajib diisi.',

                'foto.image' => 'Foto harus berupa gambar.',
                'foto.mimes' => 'Foto harus berformat jpeg, png, atau jpg.',
                'foto.max' => 'Ukuran foto maksimal 2MB.',
                'status.required' => 'Status wajib diisi.',
                'status.in' => 'Status harus berupa Aktif atau Non Aktif.',
            ]
        );

        // Data user (tabel users)
        $userData = [
            'username' => $request->username,
            // kalau kamu nanti punya field status di form edit guru, bisa tambahkan di sini
            'status' => $request->status,
        ];

        // Kalau password diisi, update password
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        if ($user) {
            $user->update($userData);
        }

        // Handle foto
        $defaultFotoPath = 'assets/media/foto/blank.png';
        $fotoPath = $guru->foto ?: $defaultFotoPath;

        // Kalau user klik "hapus foto"
        if ($request->input('foto_remove') == '1') {

            // kalau foto lama adalah file upload di storage, boleh dihapus
            if ($guru->foto && \Illuminate\Support\Str::startsWith($guru->foto, 'foto_guru/')) {
                Storage::disk('public')->delete($guru->foto);
            }

            $fotoPath = $defaultFotoPath;
        }
        // Kalau user upload foto baru
        elseif ($request->hasFile('foto')) {

            // hapus foto lama kalau dari storage
            if ($guru->foto && \Illuminate\Support\Str::startsWith($guru->foto, 'foto_guru/')) {
                Storage::disk('public')->delete($guru->foto);
            }

            $fotoPath = $request->file('foto')->store('foto_guru', 'public');
        }

        // Update data guru (tabel gurus)
        $guru->update([
            'sekolahs_id' => $request->sekolahs_id,
            'nik' => $request->nik,
            'nipa' => $request->nipa,
            'nama_guru' => $request->nama_guru,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'pend_terakhir' => $request->pend_terakhir,
            'jurusan' => $request->jurusan,
            'tanggal_masuk' => $request->tanggal_masuk,
            'foto' => $fotoPath,
        ]);

        return redirect()
            ->route($this->getGuruIndexRouteName())
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $guru = Guru::with('user')->findOrFail($id);

        // Hapus foto kalau ada
        if ($guru->foto && \Illuminate\Support\Str::startsWith($guru->foto, 'foto_guru/')) {
            Storage::disk('public')->delete($guru->foto);
        }

        // Hapus user → karena FK cascade, record admins juga ikut kehapus
        if ($guru->user) {
            // opsional, tapi bagus → bersihkan role dulu
            $guru->user->syncRoles([]);
            $guru->user->delete();
        }

        return redirect()
            ->route($this->getGuruIndexRouteName())
            ->with('success', 'Data guru & user berhasil dihapus.');
    }
}
