<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Antropometri;
use App\Models\DdstTest;
use App\Models\DdstTestItem;
use App\Models\Guru;
use App\Models\Raport;
use App\Models\Sekolah;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

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

    public function dashboardGuru(Request $request)
    {
        $guru = Guru::where('users_id', auth()->id())->firstOrFail();
        $sekolahId = $guru->sekolahs_id;

        $anakIds = Anak::where('sekolahs_id', $sekolahId)->pluck('id');
        $totalAnak = $anakIds->count();

        $periode = $request->get('periode', now()->format('Y-m'));
        try {
            $start = Carbon::createFromFormat('Y-m', $periode)->startOfMonth();
        } catch (\Throwable $e) {
            $start = now()->startOfMonth();
            $periode = $start->format('Y-m');
        }
        $end = (clone $start)->endOfMonth();
        $bulanLabel = $start->translatedFormat('F Y');

        $semester = $request->get('semester');
        $tahunAjaran = $request->get('tahun_ajaran');

        if (!$semester || !$tahunAjaran) {
            $latestRaport = Raport::where('guru_id', $guru->id)->orderByDesc('id')->first();
            $semester = $semester ?: ($latestRaport->semester ?? 'Genap');
            $tahunAjaran = $tahunAjaran ?: ($latestRaport->tahun_ajaran ?? now()->year . '/' . (now()->year + 1));
        }

        $anakSudahInputAntro = Antropometri::whereIn('anaks_id', $anakIds)
            ->whereBetween('tanggal_ukur', [$start->toDateString(), $end->toDateString()])
            ->distinct('anaks_id')
            ->count('anaks_id');

        $tkBelumSelesai = max($totalAnak - $anakSudahInputAntro, 0);
        $tkProgress = $totalAnak > 0 ? round((($totalAnak - $tkBelumSelesai) / $totalAnak) * 100) : 0;

        $giziGrouped = Antropometri::selectRaw("COALESCE(NULLIF(status_gizi,''),'Tidak diisi') AS label, COUNT(*) AS jumlah")
            ->whereIn('anaks_id', $anakIds)
            ->whereBetween('tanggal_ukur', [$start->toDateString(), $end->toDateString()])
            ->groupBy('label')
            ->orderByDesc('jumlah')
            ->get();

        $giziChart = $giziGrouped->map(fn($r) => ['label' => $r->label, 'value' => (int)$r->jumlah])->values()->all();

        $giziTidakNormal = Antropometri::whereIn('anaks_id', $anakIds)
            ->whereBetween('tanggal_ukur', [$start->toDateString(), $end->toDateString()])
            ->whereNotNull('status_gizi')
            ->where('status_gizi', '!=', '')
            ->where('status_gizi', '!=', 'Normal')
            ->count();

        $ddstGrouped = DdstTestItem::selectRaw("status AS label, COUNT(*) AS jumlah")
            ->whereIn('status', ['tercapai', 'ragu_ragu', 'belum_tercapai'])
            ->whereHas('ddstTest', function ($q) use ($guru, $start, $end) {
                $q->where('gurus_id', $guru->id)
                    ->whereBetween('tanggal_test', [$start->toDateString(), $end->toDateString()]);
            })
            ->groupBy('label')
            ->orderByDesc('jumlah')
            ->get();

        $latestTestIds = DdstTest::query()
            ->selectRaw('MAX(id) as id')
            ->where('gurus_id', $guru->id)
            ->whereBetween('tanggal_test', [$start->toDateString(), $end->toDateString()])
            ->groupBy('anaks_id');


        $perTestAgg = DdstTestItem::query()
            ->selectRaw("
        ddst_tests_id,
        MAX(CASE WHEN status = 'belum_tercapai' THEN 1 ELSE 0 END) as has_belum,
        MAX(CASE WHEN status = 'ragu_ragu' THEN 1 ELSE 0 END) as has_ragu
    ")
            ->whereIn('ddst_tests_id', $latestTestIds)
            ->groupBy('ddst_tests_id')
            ->get();

        $jumlahBelum = 0;
        $jumlahRagu  = 0;
        $jumlahTercapai = 0;

        foreach ($perTestAgg as $row) {
            if ((int)$row->has_belum === 1) {
                $jumlahBelum++;
            } elseif ((int)$row->has_ragu === 1) {
                $jumlahRagu++;
            } else {
                $jumlahTercapai++;
            }
        }

        $ddstChart = [
            ['label' => 'Tercapai', 'value' => $jumlahTercapai],
            ['label' => 'Ragu-ragu', 'value' => $jumlahRagu],
            ['label' => 'Belum tercapai', 'value' => $jumlahBelum],
        ];

        $ddstPerluEvaluasi = DdstTest::where('gurus_id', $guru->id)
            ->whereBetween('tanggal_test', [$start->toDateString(), $end->toDateString()])
            ->whereHas('items', function ($q) {
                $q->whereIn('status', ['belum_tercapai', 'ragu_ragu']);
            })
            ->distinct('anaks_id')
            ->count('anaks_id');

        $anakSudahAdaRaport = Raport::where('guru_id', $guru->id)
            ->where('sekolah_id', $sekolahId)
            ->where('semester', $semester)
            ->where('tahun_ajaran', $tahunAjaran)
            ->distinct('anak_id')
            ->count('anak_id');

        $raportBelumSelesai = max($totalAnak - $anakSudahAdaRaport, 0);

        // =========================
        // CATATAN ADMIN (ganti deadline)
        // =========================
        // $catatan = CatatanAdmin::query()
        //     ->where('sekolahs_id', $sekolahId)
        //     ->where('is_active', true)
        //     ->where(function ($q) use ($guru) {
        //         $q->whereNull('gurus_id')
        //             ->orWhere('gurus_id', $guru->id);
        //     })
        //     ->where(function ($q) {
        //         $q->whereNull('publish_at')
        //             ->orWhere('publish_at', '<=', now());
        //     })
        //     ->orderByDesc('publish_at')
        //     ->orderByDesc('id')
        //     ->first();

        // $catatanJudul = $catatan?->judul ?? 'Tidak ada catatan';
        // $catatanIsi = $catatan?->isi ?? 'Belum ada informasi dari admin.';
        // $catatanTanggal = $catatan?->publish_at
        //     ? $catatan->publish_at->translatedFormat('d M Y H:i')
        //     : ($catatan?->created_at?->translatedFormat('d M Y H:i') ?? '-');

        $badgeClass = function ($v) {
            if ($v >= 10) return 'badge-light-danger';
            if ($v >= 5) return 'badge-light-warning';
            return 'badge-light-success';
        };

        return view('guru.dashboard.index', compact(
            'bulanLabel',
            'periode',
            'totalAnak',
            'tkBelumSelesai',
            'tkProgress',
            'giziTidakNormal',
            'ddstPerluEvaluasi',
            'raportBelumSelesai',
            'giziChart',
            'ddstChart',
            'badgeClass',
            'semester',
            'tahunAjaran',
            // 'catatanJudul',
            // 'catatanIsi',
            // 'catatanTanggal'
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

    public function profileGuru()
    {
        $user = auth()->user()->load(['guru.sekolah']);
        $guru = $user->guru;

        return view('guru.profile.index', compact('user', 'guru'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user()->load('guru');
        $guru = $user->guru;
        $guruId = $guru?->id;

        $validated = $request->validate([
            'username' => ['required', 'string', 'max:50', Rule::unique('users', 'username')->ignore($user->id)],
            'email' => ['nullable', 'email', 'max:100', Rule::unique('gurus', 'email')->ignore($guruId)],

            'nik' => ['nullable', 'string', 'max:30'],
            'nipa' => ['nullable', 'string', 'max:30'],
            'nama_guru' => ['nullable', 'string', 'max:100'],
            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['nullable', Rule::in(['L', 'P'])],
            'alamat' => ['nullable', 'string', 'max:255'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'pend_terakhir' => ['nullable', Rule::in(['smp', 'smk', 'sma', 'd3', 's1', 's2', 's3'])],
            'jurusan' => ['nullable', 'string', 'max:100'],
            'tanggal_masuk' => ['nullable', 'date'],

            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'foto_remove' => ['nullable', 'in:0,1'],
        ]);

        $user->update([
            'username' => $validated['username'],
        ]);

        $defaultFotoPath = 'assets/media/foto/blank.png';
        $currentFoto = $guru?->foto;
        $fotoPath = $currentFoto ?: $defaultFotoPath;

        if (($request->input('foto_remove') ?? '0') === '1') {
            if ($currentFoto && Str::startsWith($currentFoto, 'foto_guru/')) {
                Storage::disk('public')->delete($currentFoto);
            }
            $fotoPath = $defaultFotoPath;
        } elseif ($request->hasFile('foto')) {
            if ($currentFoto && Str::startsWith($currentFoto, 'foto_guru/')) {
                Storage::disk('public')->delete($currentFoto);
            }
            $fotoPath = $request->file('foto')->store('foto_guru', 'public');
        }

        $user->guru()->updateOrCreate(
            ['users_id' => $user->id],
            [
                'nik' => $validated['nik'] ?? null,
                'nipa' => $validated['nipa'] ?? null,
                'nama_guru' => $validated['nama_guru'] ?? null,
                'tempat_lahir' => $validated['tempat_lahir'] ?? null,
                'tanggal_lahir' => $validated['tanggal_lahir'] ?? null,
                'jenis_kelamin' => $validated['jenis_kelamin'] ?? null,
                'alamat' => $validated['alamat'] ?? null,
                'email' => $validated['email'] ?? null,
                'no_hp' => $validated['no_hp'] ?? null,
                'pend_terakhir' => $validated['pend_terakhir'] ?? null,
                'jurusan' => $validated['jurusan'] ?? null,
                'tanggal_masuk' => $validated['tanggal_masuk'] ?? null,
                'foto' => $fotoPath,
            ]
        );

        return redirect()->route('guru.profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        if (!$request->filled('current_password')) {
            return redirect()->route('guru.profile')
                ->with('error', 'Password lama wajib diisi.')
                ->with('error_field', 'current_password');
        }

        if (!$request->filled('password')) {
            return redirect()->route('guru.profile')
                ->with('error', 'Password baru wajib diisi.')
                ->with('error_field', 'password');
        }

        if (strlen($request->password) < 8) {
            return redirect()->route('guru.profile')
                ->with('error', 'Password baru minimal 8 karakter.')
                ->with('error_field', 'password');
        }

        if (!$request->filled('password_confirmation')) {
            return redirect()->route('guru.profile')
                ->with('error', 'Konfirmasi password wajib diisi.')
                ->with('error_field', 'password_confirmation');
        }

        if ($request->password !== $request->password_confirmation) {
            return redirect()->route('guru.profile')
                ->with('error', 'Konfirmasi password tidak sama.')
                ->with('error_field', 'password_confirmation');
        }

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('guru.profile')
                ->with('error', 'Password lama tidak sesuai.')
                ->with('error_field', 'current_password');
        }

        $user->forceFill([
            'password' => $request->password,
        ])->save();

        return redirect()->route('guru.profile')
            ->with('success', 'Password berhasil diperbarui.');
    }
}
