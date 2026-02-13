<?php

namespace App\Http\Controllers;

use App\Models\OrangTua;
use App\Models\User;
use App\Models\Anak;
use App\Models\Raport;
use App\Models\Antropometri;
use App\Models\DdstTest;
use App\Models\DdstTestItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
    public function index(Request $request)
    {
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
        $search = $request->query('search');

        $dataOrangtua = OrangTua::with('user')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($qq) use ($search) {
                    $qq->where('nik_ayah', 'like', "%{$search}%")
                        ->orWhere('nama_ayah', 'like', "%{$search}%")
                        ->orWhere('nik_ibu', 'like', "%{$search}%")
                        ->orWhere('nama_ibu', 'like', "%{$search}%")
                        ->orWhere('no_hp_ayah', 'like', "%{$search}%")
                        ->orWhere('no_hp_ibu', 'like', "%{$search}%")
                        ->orWhere('alamat', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($u) use ($search) {
                            $u->where('username', 'like', "%{$search}%");
                        });
                });
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('shared.orangtua.index', compact('dataOrangtua', 'routeNameStore', 'routeNameUpdate', 'routeNameDelete'));
    }

    public function dashboardOrangTua(Request $request)
    {

        $orangTuaId = optional(Auth::user())->orang_tuas_id ?? optional(Auth::user())->orangTua->id ?? null;

        $anakList = Anak::query()
            ->with('sekolah')
            ->when($orangTuaId, fn($q) => $q->where('orang_tuas_id', $orangTuaId))
            ->orderBy('nama_anak')
            ->get();

        $selectedAnakId = $request->get('anak_id') ?? optional($anakList->first())->id;
        $anak = $selectedAnakId
            ? Anak::with(['sekolah', 'orangTua'])->find($selectedAnakId)
            : null;

        $raportTerbaru = $anak
            ? Raport::with(['guru', 'sekolah'])
                ->where('anak_id', $anak->id)
                ->orderByDesc('tahun_ajaran')
                ->orderByDesc('semester')
                ->latest('id')
                ->first()
            : null;

        $antroTerbaru = $anak
            ? Antropometri::where('anaks_id', $anak->id)->orderByDesc('tanggal_ukur')->first()
            : null;

       $ddstTestTerbaru = $anak
            ? DdstTest::where('anaks_id', $anak->id)->orderByDesc('tanggal_test')->first()
            : null;


        $ddstRaguTotal = 0;
        $ddstRaguPerDomain = collect();

        if ($ddstTestTerbaru) {

            $ddstRaguTotal = DdstTestItem::where('ddst_tests_id', $ddstTestTerbaru->id)
                ->where('status', 'belum_tercapai') // ✅ FIX
                ->count();

            $ddstRaguPerDomain = DdstTestItem::query()
                ->select('ddst_items.kategori_perkembangan', DB::raw('COUNT(*) as total'))
                ->join('ddst_items', 'ddst_items.id', '=', 'ddst_test_items.ddst_items_id')
                ->where('ddst_test_items.ddst_tests_id', $ddstTestTerbaru->id)
                ->where('ddst_test_items.status', 'belum_tercapai') // ✅ FIX
                ->groupBy('ddst_items.kategori_perkembangan')
                ->orderBy('ddst_items.kategori_perkembangan')
                ->get();
        }

        $kehadiran = [
            'sakit' => (int) optional($raportTerbaru)->sakit,
            'izin' => (int) optional($raportTerbaru)->izin,
            'tanpa_keterangan' => (int) optional($raportTerbaru)->tanpa_keterangan,

        ];

        $refleksiGuru = optional($raportTerbaru)->refleksi_guru;


        $antroSeries = collect();
        if ($anak) {
            $antroSeries = Antropometri::where('anaks_id', $anak->id)
                ->orderBy('tanggal_ukur')
                ->get()
                ->map(function ($a) use ($anak) {
                    $usiaBulan = null;
                    if ($anak->tanggal_lahir && $a->tanggal_ukur) {
                        $usiaBulan = (int) Carbon::parse($anak->tanggal_lahir)->diffInMonths(Carbon::parse($a->tanggal_ukur));
                    }

                    return [
                        'tanggal' => optional($a->tanggal_ukur)->format('Y-m-d'),
                        'usia_bulan' => $usiaBulan,
                        'berat_badan' => (float) $a->berat_badan,
                        'tinggi_badan' => (float) $a->tinggi_badan,
                        'status_gizi' => $a->status_gizi,
                        'status_bb' => $a->status_bb,
                        'status_tb' => $a->status_tb,
                    ];
                });
        }

        $delayBulanan = collect();
        if ($anak) {
            $delayBulanan = DdstTestItem::query()
                ->select(
                    DB::raw("DATE_FORMAT(ddst_tests.tanggal_test, '%Y-%m') as ym"),
                    DB::raw('COUNT(ddst_test_items.id) as total')
                )
                ->join('ddst_tests', 'ddst_tests.id', '=', 'ddst_test_items.ddst_tests_id')
                ->where('ddst_tests.anaks_id', $anak->id)
                ->where('ddst_test_items.status', 'belum_tercapai')
                ->groupBy('ym')
                ->orderBy('ym')
                ->get()
                ->map(fn($r) => ['ym' => $r->ym, 'total' => (int) $r->total]);
        }

        return view('orang_tua.dashboard.index', [
            'anakList' => $anakList,
            'anak' => $anak,
            'selectedAnakId' => $selectedAnakId,

            'raportTerbaru' => $raportTerbaru,
            'guruTerbaru' => optional($raportTerbaru)->guru,
            'sekolahTerbaru' => optional($raportTerbaru)->sekolah,

            'antroTerbaru' => $antroTerbaru,

            'ddstTerbaru' => $ddstTestTerbaru,
            'ddstRaguTotal' => $ddstRaguTotal,
            'ddstRaguPerDomain' => $ddstRaguPerDomain,

            'kehadiran' => $kehadiran,
            'refleksiGuru' => $refleksiGuru,

            'antroSeries' => $antroSeries,
            'delayBulanan' => $delayBulanan,
        ]);
        
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

        $request->validate(
            [
                'nik_ayah' => [
                    'nullable',
                    'digits:16',
                    Rule::unique('orang_tuas', 'nik_ayah'),
                ],
                'nik_ibu' => [
                    'nullable',
                    'digits:16',
                    Rule::unique('orang_tuas', 'nik_ibu'),
                ],
                'nama_ayah' => 'nullable|string|max:255',
                'nama_ibu' => 'nullable|string|max:255',
                'no_hp_ayah' => 'nullable|string|max:20',
                'no_hp_ibu' => 'nullable|string|max:20',
                'alamat' => 'required|string|max:500',
                'username' => 'required|string|max:50|unique:users,username',
                'password' => 'required|string|min:8',
            ],
            [
                'nik_ayah.unique' => 'NIK Ayah sudah terdaftar.',
                'nik_ibu.unique' => 'NIK Ibu sudah terdaftar.',
                'nik_ayah.digits' => 'NIK Ayah harus terdiri dari 16 digit.',
                'nik_ibu.digits' => 'NIK Ibu harus terdiri dari 16 digit.',
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
                'alamat.required' => 'Alamat wajib diisi.',
            ]
        );

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'status' => 'aktif',
        ]);

        $user->assignRole('orang_tua');

        OrangTua::create([
            'users_id' => $user->id,
            'nik_ayah' => $request->nik_ayah,
            'nama_ayah' => $request->nama_ayah,
            'nik_ibu' => $request->nik_ibu,
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

        $orangTua = OrangTua::with('user')->findOrFail($id);
        $user = $orangTua->user;

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

                'nik_ayah' => [
                    'nullable',
                    'digits:16',
                    Rule::unique('orang_tuas', 'nik_ayah')->ignore($orangTua->id),
                ],


                'nama_ayah' => 'nullable|string|max:255',
                'nik_ibu' => [
                    'nullable',
                    'digits:16',
                    Rule::unique('orang_tuas', 'nik_ibu')->ignore($orangTua->id),
                ],
                'nama_ibu' => 'nullable|string|max:255',
                'no_hp_ayah' => 'nullable|string|max:20',
                'no_hp_ibu' => 'nullable|string|max:20',
                'alamat' => 'required|string|max:500',
                'status' => [
                    'required',
                    'in:aktif,non_aktif',
                ],
            ],
            [
                'nik_ayah.unique' => 'NIK Ayah sudah terdaftar.',
                'nik_ibu.unique' => 'NIK Ibu sudah terdaftar.',

                'nik_ayah.digits' => 'NIK Ayah harus terdiri dari 16 digit.',
                'nik_ibu.digits' => 'NIK Ibu harus terdiri dari 16 digit.',
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
                'alamat.required' => 'Alamat wajib diisi.',
                'status.required' => 'Status wajib diisi.',
                'status.in' => 'Status harus berupa Aktif atau Non Aktif.',
            ]
        );

        $userData = [
            'username' => $request->username,
            'status' => $request->status,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        if ($user) {
            $user->update($userData);
        }

        $orangTua->update([
            'nik_ayah' => $request->nik_ayah,
            'nama_ayah' => $request->nama_ayah,
            'nik_ibu' => $request->nik_ibu,
            'nama_ibu' => $request->nama_ibu,
            'no_hp_ayah' => $request->no_hp_ayah,
            'no_hp_ibu' => $request->no_hp_ibu,
            'alamat' => $request->alamat,
        ]);

        return redirect()
            ->route($this->getOrangTuaIndexRouteName())
            ->with('success', 'Data orang tua berhasil diperbarui.');
    }

    public function destroy($id)
    {

        $orangTua = OrangTua::with('user')->findOrFail($id);

        if ($orangTua->user) {
            $orangTua->user->syncRoles([]);
            $orangTua->user->delete();
        }

        return redirect()
            ->route($this->getOrangTuaIndexRouteName())
            ->with('success', 'Data orang tua & user berhasil dihapus.');
    }


    public function profileOrangTua()
    {
        $user = auth()->user()->load('orangTua');
        $orangTua = $user->orangTua;
        return view('orang_tua.profile.index', compact('user', 'orangTua'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user()->load('orangTua');

        $validated = $request->validate([
            'username' => ['required', 'string', 'max:50', Rule::unique('users', 'username')->ignore($user->id)],

            'nik_ayah' => ['nullable', 'string', 'max:30'],
            'nama_ayah' => ['nullable', 'string', 'max:100'],
            'no_hp_ayah' => ['nullable', 'string', 'max:20'],

            'nik_ibu' => ['nullable', 'string', 'max:30'],
            'nama_ibu' => ['nullable', 'string', 'max:100'],
            'no_hp_ibu' => ['nullable', 'string', 'max:20'],

            'alamat' => ['nullable', 'string', 'max:255'],
        ]);

        $user->update([
            'username' => $validated['username'],
        ]);

        $user->orangTua()->updateOrCreate(
            ['users_id' => $user->id],
            [
                'nik_ayah' => $validated['nik_ayah'] ?? null,
                'nama_ayah' => $validated['nama_ayah'] ?? null,
                'no_hp_ayah' => $validated['no_hp_ayah'] ?? null,

                'nik_ibu' => $validated['nik_ibu'] ?? null,
                'nama_ibu' => $validated['nama_ibu'] ?? null,
                'no_hp_ibu' => $validated['no_hp_ibu'] ?? null,

                'alamat' => $validated['alamat'] ?? null,
            ]
        );

        return redirect()
            ->route('orang_tua.profile')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        // validasi manual supaya bisa redirect manual versi kamu
        if (!$request->filled('current_password')) {
            return redirect()->route('orang_tua.profile')
                ->with('error', 'Password lama wajib diisi.')
                ->with('error_field', 'current_password');
        }

        if (!$request->filled('password')) {
            return redirect()->route('orang_tua.profile')
                ->with('error', 'Password baru wajib diisi.')
                ->with('error_field', 'password');
        }

        if (strlen($request->password) < 8) {
            return redirect()->route('orang_tua.profile')
                ->with('error', 'Password baru minimal 8 karakter.')
                ->with('error_field', 'password');
        }

        if (!$request->filled('password_confirmation')) {
            return redirect()->route('orang_tua.profile')
                ->with('error', 'Konfirmasi password wajib diisi.')
                ->with('error_field', 'password_confirmation');
        }

        if ($request->password !== $request->password_confirmation) {
            return redirect()->route('orang_tua.profile')
                ->with('error', 'Konfirmasi password tidak sama.')
                ->with('error_field', 'password_confirmation');
        }

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('orang_tua.profile')
                ->with('error', 'Password lama tidak sesuai.')
                ->with('error_field', 'current_password');
        }

        $user->forceFill([
            'password' => $request->password, // auto hash via casts hashed
        ])->save();

        return redirect()->route('orang_tua.profile')
            ->with('success', 'Password berhasil diperbarui.');
    }



}
