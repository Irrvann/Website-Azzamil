<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Anak;
use App\Models\Antropometri;
use App\Models\Daerah;
use App\Models\DdstTest;
use App\Models\Guru;
use App\Models\OrangTua;
use App\Models\Raport;
use App\Models\Sekolah;
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
        $dataAdmin = Admin::with(['user'])->paginate(10);

        return view('superadmin.admin.index', compact('dataAdmin',));
    }


    public function dashboardAdmin(Request $request)
    {
        $periode = $request->get('periode', now()->format('Y-m'));
        try {
            $start = Carbon::createFromFormat('Y-m', $periode)->startOfMonth();
        } catch (\Throwable $e) {
            $start = now()->startOfMonth();
            $periode = $start->format('Y-m');
        }
        $end = (clone $start)->endOfMonth();
        $periodeLabel = $start->translatedFormat('F Y');


        $totalSekolah = Sekolah::count();
        $totalGuru = Guru::count();
        $totalOrangTua = OrangTua::count();
        $totalAnak = Anak::count();

        $anakSudahAntro = Antropometri::query()
            ->whereBetween('tanggal_ukur', [$start->toDateString(), $end->toDateString()])
            ->distinct('anaks_id')
            ->count('anaks_id');

        $anakSudahDdst = DdstTest::query()
            ->whereBetween('tanggal_test', [$start->toDateString(), $end->toDateString()])
            ->distinct('anaks_id')
            ->count('anaks_id');

        $anakSelesaiTk = Anak::query()
            ->whereIn('id', function ($q) use ($start, $end) {
                $q->select('anaks_id')
                    ->from('antropometris')
                    ->whereBetween('tanggal_ukur', [$start->toDateString(), $end->toDateString()]);
            })
            ->whereIn('id', function ($q) use ($start, $end) {
                $q->select('anaks_id')
                    ->from('ddst_tests')
                    ->whereBetween('tanggal_test', [$start->toDateString(), $end->toDateString()]);
            })
            ->distinct('id')
            ->count('id');

        $tkBelumSelesai = max($totalAnak - $anakSelesaiTk, 0);
        $tkSelesai = $anakSelesaiTk;
        $tkProgress = $totalAnak > 0 ? round(($tkSelesai / $totalAnak) * 100) : 0;

        $latestAntroIds = Antropometri::query()
            ->selectRaw('MAX(id) as id')
            ->whereBetween('tanggal_ukur', [$start->toDateString(), $end->toDateString()])
            ->groupBy('anaks_id');

        $giziGrouped = Antropometri::query()
            ->selectRaw("COALESCE(NULLIF(status_gizi,''),'Tidak diisi') AS label, COUNT(*) AS jumlah")
            ->whereIn('id', $latestAntroIds)
            ->groupBy('label')
            ->orderByDesc('jumlah')
            ->get();

        $giziChart = $giziGrouped
            ->map(fn($r) => ['label' => $r->label, 'value' => (int) $r->jumlah])
            ->values()
            ->all();

        $giziTidakNormal = Antropometri::query()
            ->whereIn('id', $latestAntroIds)
            ->whereNotNull('status_gizi')
            ->where('status_gizi', '!=', '')
            ->where('status_gizi', '!=', 'Normal')
            ->count();


        $ddstPerluEvaluasi = DdstTest::query()
            ->whereBetween('tanggal_test', [$start->toDateString(), $end->toDateString()])
            ->where(function ($q) {
                $q->whereIn('hasil_akhir', ['Meragukan', 'Penyimpangan'])
                    ->orWhereHas('items', function ($qq) {
                        $qq->whereIn('status', ['belum_tercapai', 'ragu_ragu']);
                    });
            })
            ->distinct('anaks_id')
            ->count('anaks_id');

        $anakSudahAdaRaport = Raport::query()
            ->whereBetween('created_at', [$start->toDateTimeString(), $end->toDateTimeString()])
            ->distinct('anak_id')
            ->count('anak_id');

        $raportBelumSelesai = max($totalAnak - $anakSudahAdaRaport, 0);

        $anakPerSekolah = Sekolah::query()
            ->withCount('anaks')
            ->orderByDesc('anaks_count')
            ->get()
            ->map(fn($s) => ['sekolah' => $s->nama_sekolah, 'total' => (int) $s->anaks_count])
            ->values()
            ->all();

        $monitorSekolah = [];
        $sekolahs = Sekolah::select('id', 'nama_sekolah')->get();

        foreach ($sekolahs as $s) {
            $anakIdsSekolah = Anak::where('sekolahs_id', $s->id)->pluck('id');
            $total = $anakIdsSekolah->count();

            if ($total === 0) {
                $monitorSekolah[] = ['nama' => $s->nama_sekolah, 'anak' => 0, 'tk' => 0, 'raport' => 0];
                continue;
            }

            $selesaiTkSekolah = Anak::query()
                ->whereIn('id', $anakIdsSekolah)
                ->whereIn('id', function ($q) use ($start, $end) {
                    $q->select('anaks_id')
                        ->from('antropometris')
                        ->whereBetween('tanggal_ukur', [$start->toDateString(), $end->toDateString()]);
                })
                ->whereIn('id', function ($q) use ($start, $end) {
                    $q->select('anaks_id')
                        ->from('ddst_tests')
                        ->whereBetween('tanggal_test', [$start->toDateString(), $end->toDateString()]);
                })
                ->distinct('id')
                ->count('id');

            $raportSekolah = Raport::query()
                ->where('sekolah_id', $s->id)
                ->whereBetween('created_at', [$start->toDateTimeString(), $end->toDateTimeString()])
                ->distinct('anak_id')
                ->count('anak_id');

            $tkPct = (int) round(($selesaiTkSekolah / $total) * 100);
            $raportPct = (int) round(($raportSekolah / $total) * 100);

            $monitorSekolah[] = [
                'nama' => $s->nama_sekolah,
                'anak' => $total,
                'tk' => $tkPct,
                'raport' => $raportPct,
            ];
        }

        $statusSekolah = function (int $tk, int $raport) {
            if ($tk >= 80 && $raport >= 60) return ['label' => 'Aktif', 'class' => 'badge-light-success'];
            if ($tk >= 60 || $raport >= 40) return ['label' => 'Perlu Monitoring', 'class' => 'badge-light-warning'];
            return ['label' => 'Tertinggal', 'class' => 'badge-light-danger'];
        };

        $badgeClass = function ($v) {
            if ($v >= 150) return 'badge-light-danger';
            if ($v >= 80) return 'badge-light-warning';
            return 'badge-light-success';
        };

        return view('admin.dashboard.index', compact(
            'periodeLabel',
            'periode',
            'totalSekolah',
            'totalGuru',
            'totalOrangTua',
            'totalAnak',
            'tkBelumSelesai',
            'tkSelesai',
            'tkProgress',
            'ddstPerluEvaluasi',
            'giziTidakNormal',
            'raportBelumSelesai',
            'giziChart',
            'anakPerSekolah',
            'monitorSekolah',
            'statusSekolah',
            'badgeClass'
        ));
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
