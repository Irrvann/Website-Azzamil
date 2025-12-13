<?php

namespace App\Http\Controllers;

use App\Models\OrangTua;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class OrangTuaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function getOrangTuaIndexRouteName(): string
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return 'admin.orang_tua.index';
        }

        if ($user->hasRole('super_admin')) {
            return 'superadmin.orang_tua.index';
        }

        abort(403, 'Role tidak dikenali');
    }
    public function index()
    {
        //
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            $routeNameStore = 'admin.orang_tua.store';
            $routeNameUpdate = 'admin.orang_tua.update';
            $routeNameDelete = 'admin.orang_tua.destroy';
        } elseif ($user->hasRole('super_admin')) {
            $routeNameStore = 'superadmin.orang_tua.store';
            $routeNameUpdate = 'superadmin.orang_tua.update';
            $routeNameDelete = 'superadmin.orang_tua.destroy';
        } else {
            abort(403, 'Role tidak dikenali');
        }
        $dataOrangtua = OrangTua::with('user')->paginate(10);

        return view('shared.orangtua.index', compact('dataOrangtua', 'routeNameStore', 'routeNameUpdate', 'routeNameDelete'));
    }

    public function dashboardOrangTua()
    {
        return view('orang_tua.dashboard.index');
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
                'nama_ayah' => 'nullable|string|max:255',
                'nama_ibu' => 'nullable|string|max:255',
                'no_hp_ayah' => 'nullable|string|max:20',
                'no_hp_ibu' => 'nullable|string|max:20',
                'alamat' => 'nullable|string|max:500',
                'username' => 'required|string|max:50|unique:users,username',
                'password' => 'required|string|min:8',
            ],
            [
                'username.required' => 'Username wajib diisi.',
                'username.unique' => 'Username sudah digunakan, silakan pilih yang lain.',
                'nama_ayah.string' => 'Nama ayah harus berupa teks.',
                'nama_ayah.max' => 'Nama ayah maksimal 255 karakter.',
                'nama_ibu.string' => 'Nama ibu harus berupa teks.',
                'nama_ibu.max' => 'Nama ibu maksimal 255 karakter.',
                'no_hp_ayah.string' => 'Nomor HP ayah harus berupa teks.',
                'no_hp_ayah.max' => 'Nomor HP ayah maksimal 20 karakter.',
                'no_hp_ibu.string' => 'Nomor HP ibu harus berupa teks.',
                'no_hp_ibu.max' => 'Nomor HP ibu maksimal 20 karakter.',
                'alamat.string' => 'Alamat harus berupa teks.',
                'alamat.max' => 'Alamat maksimal 500 karakter.',
            ]
        );

        // membuat user
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'status' => 'aktif',
        ]);

        // Assign role
        $user->assignRole('orang_tua');

        OrangTua::create([
            'users_id' => $user->id,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'no_hp_ayah' => $request->no_hp_ayah,
            'no_hp_ibu' => $request->no_hp_ibu,
            'alamat' => $request->alamat,
        ]);
        return redirect()->route($this->getOrangTuaIndexRouteName())->with('success', 'Data orang tua berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OrangTua $orangTua)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrangTua $orangTua)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $orangTua = OrangTua::with('user')->findOrFail($id);
        $user = $orangTua->user;

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

                'nama_ayah' => 'nullable|string|max:255',
                'nama_ibu' => 'nullable|string|max:255',
                'no_hp_ayah' => 'nullable|string|max:20',
                'no_hp_ibu' => 'nullable|string|max:20',
                'alamat' => 'nullable|string|max:500',
                'status' => [
                    'required',
                    'in:aktif,non_aktif',
                ],
            ],
            [
                'username.required' => 'Username wajib diisi.',
                'username.unique' => 'Username sudah digunakan, silakan pilih yang lain.',
                'nama_ayah.string' => 'Nama ayah harus berupa teks.',
                'nama_ayah.max' => 'Nama ayah maksimal 255 karakter.',
                'nama_ibu.string' => 'Nama ibu harus berupa teks.',
                'nama_ibu.max' => 'Nama ibu maksimal 255 karakter.',
                'no_hp_ayah.string' => 'Nomor HP ayah harus berupa teks.',
                'no_hp_ayah.max' => 'Nomor HP ayah maksimal 20 karakter.',
                'no_hp_ibu.string' => 'Nomor HP ibu harus berupa teks.',
                'no_hp_ibu.max' => 'Nomor HP ibu maksimal 20 karakter.',
                'alamat.string' => 'Alamat harus berupa teks.',
                'alamat.max' => 'Alamat maksimal 500 karakter.',
                'status.required' => 'Status wajib diisi.',
                'status.in' => 'Status harus berupa Aktif atau Non Aktif.',
            ]
        );

        // Data user (tabel users)
        $userData = [
            'username' => $request->username,
            // kalau kamu nanti punya field status di form edit guru, bisa tambahkan di sini
            'status'   => $request->status,
        ];

        // Kalau password diisi, update password
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        if ($user) {
            $user->update($userData);
        }
        
        // Update data orang tua (tabel orang_tuas)
        $orangTua->update([
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'no_hp_ayah' => $request->no_hp_ayah,
            'no_hp_ibu' => $request->no_hp_ibu,
            'alamat' => $request->alamat,
        ]);

        return redirect()
            ->route($this->getOrangTuaIndexRouteName())
            ->with('success', 'Data orang tua berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $orangTua = OrangTua::with('user')->findOrFail($id);

        // Hapus user → karena FK cascade, record admins juga ikut kehapus
        if ($orangTua->user) {
            // opsional, tapi bagus → bersihkan role dulu
            $orangTua->user->syncRoles([]);
            $orangTua->user->delete();
        }

        return redirect()
            ->route($this->getOrangTuaIndexRouteName())
            ->with('success', 'Data orang tua & user berhasil dihapus.');
    }
}
