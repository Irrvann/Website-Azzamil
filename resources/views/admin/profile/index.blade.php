@extends('layouts.app')

@section('content')
    <style>
        .profile-cover {
            height: 140px;
            background: linear-gradient(135deg, #0d6efd 0%, #00d4ff 100%);
            border-radius: .75rem;
            position: relative;
            overflow: hidden;
        }

        .profile-cover:after {
            content: "";
            position: absolute;
            inset: -80px -120px auto auto;
            width: 240px;
            height: 240px;
            background: rgba(255, 255, 255, .18);
            border-radius: 999px;
            transform: rotate(25deg);
        }

        .profile-avatar {
            margin-top: -42px;
        }

        .w-md-250px {
            width: 100%;
        }

        @media (min-width: 768px) {
            .w-md-250px {
                width: 260px !important;
            }
        }
    </style>

    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Profile Admin
                    </h1>
                </div>
            </div>
        </div>

        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="row g-7">
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="profile-cover p-6">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="badge badge-light fw-semibold">Admin</span>
                                        <a href="#" class="btn btn-icon btn-light btn-sm" data-bs-toggle="tooltip"
                                            title="Edit cover">
                                            <i class="ki-duotone ki-pencil fs-2"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="px-6 pb-6">
                                    <div class="d-flex flex-column align-items-center text-center profile-avatar">
                                        <div class="symbol symbol-100px symbol-circle mb-3">
                                            @php
                                                $fotoAdmin = $admin->foto ?? null;

                                                if (
                                                    $fotoAdmin &&
                                                    \Illuminate\Support\Str::startsWith(
                                                        str_replace('\\', '/', $fotoAdmin),
                                                        'foto_admin/',
                                                    )
                                                ) {
                                                    $srcFotoAdmin = asset(
                                                        'storage/' . str_replace('\\', '/', $fotoAdmin),
                                                    );
                                                } else {
                                                    $srcFotoAdmin = asset($fotoAdmin ?: 'assets/media/foto/blank.png');
                                                }
                                            @endphp

                                            <div class="symbol-label overflow-hidden">
                                                <img src="{{ $srcFotoAdmin }}?v={{ $admin->updated_at?->timestamp ?? time() }}"
                                                    alt="Foto Admin" class="w-100 h-100" style="object-fit: cover;">
                                            </div>
                                        </div>

                                        <div class="fw-bold fs-5 text-gray-900">
                                            {{ $admin->nama ?? '-' }}
                                        </div>
                                        <div class="text-muted">
                                            Username: {{ $user->username ?? '-' }}
                                        </div>

                                        <div class="d-flex gap-2 mt-4 flex-wrap justify-content-center">
                                            <span class="badge badge-light-success">{{ $user->status ?? 'aktif' }}</span>
                                            <span class="badge badge-light-primary">admin</span>
                                        </div>

                                        <div class="separator my-5"></div>

                                        <div class="nav flex-column nav-pills w-100" id="profile_tabs" role="tablist">
                                            <button class="nav-link active text-start" data-bs-toggle="pill"
                                                data-bs-target="#tab_overview" type="button">
                                                <i class="ki-duotone ki-user fs-2 me-2"></i> Detail
                                            </button>
                                            <button class="nav-link text-start" data-bs-toggle="pill"
                                                data-bs-target="#tab_edit" type="button">
                                                <i class="ki-duotone ki-profile-circle fs-2 me-2"></i> Edit Profile
                                            </button>
                                            <button class="nav-link text-start" data-bs-toggle="pill"
                                                data-bs-target="#tab_security" type="button">
                                                <i class="ki-duotone ki-shield fs-2 me-2"></i> Security
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-8 col-lg-9">
                        <div class="tab-content">

                            <div class="tab-pane fade show active" id="tab_overview">
                                <div class="card mb-7">
                                    <div class="card-header border-0">
                                        <div class="card-title m-0">
                                            <h3 class="fw-bold m-0">Detail Admin</h3>
                                        </div>
                                    </div>

                                    <div class="card-body pt-0">
                                        <div class="row mb-6">
                                            <label class="col-lg-4 fw-semibold text-muted">NIK</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-900">{{ $admin->nik ?? '-' }}</span>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 fw-semibold text-muted">NIPA</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-900">{{ $admin->nipa ?? '-' }}</span>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 fw-semibold text-muted">Nama</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-900">{{ $admin->nama ?? '-' }}</span>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 fw-semibold text-muted">Tempat Lahir</label>
                                            <div class="col-lg-8">
                                                <span
                                                    class="fw-bold fs-6 text-gray-900">{{ $admin->tempat_lahir ?? '-' }}</span>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 fw-semibold text-muted">Tanggal Lahir</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-900">
                                                    {{ $admin->tanggal_lahir ? \Carbon\Carbon::parse($admin->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 fw-semibold text-muted">Jenis Kelamin</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-900">
                                                    @php
                                                        $jk = $admin->jenis_kelamin ?? null;
                                                        $jkLabel =
                                                            $jk === 'L'
                                                                ? 'Laki-laki'
                                                                : ($jk === 'P'
                                                                    ? 'Perempuan'
                                                                    : $jk ?? '-');
                                                    @endphp
                                                    {{ $jkLabel }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 fw-semibold text-muted">Alamat</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-900">{{ $admin->alamat ?? '-' }}</span>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 fw-semibold text-muted">Email</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-900">{{ $admin->email ?? '-' }}</span>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 fw-semibold text-muted">No HP</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-900">{{ $admin->no_hp ?? '-' }}</span>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 fw-semibold text-muted">Username</label>
                                            <div class="col-lg-8">
                                                <span
                                                    class="fw-bold fs-6 text-gray-900">{{ $user->username ?? '-' }}</span>
                                            </div>
                                        </div>

                                        <div
                                            class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
                                            <i class="ki-duotone ki-information-5 fs-2x text-primary me-4">
                                                <span class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span>
                                            </i>
                                            <div class="fw-semibold text-gray-700">
                                                Pastikan data admin selalu benar agar administrasi sistem berjalan lancar.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="tab_edit">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <div class="card-title m-0">
                                            <h3 class="fw-bold m-0">Edit Data Admin</h3>
                                        </div>
                                    </div>

                                    <div class="card-body pt-0">
                                        <form id="profile_form" method="POST"
                                            action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="row mb-6">
                                                <label
                                                    class="col-lg-4 col-form-label fw-semibold text-muted">Username</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="username"
                                                        class="form-control form-control-solid"
                                                        value="{{ old('username', $user->username) }}"
                                                        placeholder="Username">
                                                </div>
                                            </div>

                                            <div class="separator my-7"></div>

                                            <div class="row mb-6">
                                                <label class="col-lg-4 col-form-label fw-semibold text-muted">NIK</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="nik"
                                                        class="form-control form-control-solid"
                                                        value="{{ old('nik', $admin->nik) }}" placeholder="NIK">
                                                </div>
                                            </div>

                                            <div class="row mb-6">
                                                <label class="col-lg-4 col-form-label fw-semibold text-muted">NIPA</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="nipa"
                                                        class="form-control form-control-solid"
                                                        value="{{ old('nipa', $admin->nipa) }}" placeholder="NIPA">
                                                </div>
                                            </div>

                                            <div class="row mb-6">
                                                <label class="col-lg-4 col-form-label fw-semibold text-muted">Nama</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="nama"
                                                        class="form-control form-control-solid"
                                                        value="{{ old('nama', $admin->nama) }}" placeholder="Nama">
                                                </div>
                                            </div>

                                            <div class="row mb-6">
                                                <label class="col-lg-4 col-form-label fw-semibold text-muted">Tempat
                                                    Lahir</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="tempat_lahir"
                                                        class="form-control form-control-solid"
                                                        value="{{ old('tempat_lahir', $admin->tempat_lahir) }}"
                                                        placeholder="Tempat Lahir">
                                                </div>
                                            </div>

                                            <div class="row mb-6">
                                                <label class="col-lg-4 col-form-label fw-semibold text-muted">Tanggal
                                                    Lahir</label>
                                                <div class="col-lg-8">
                                                    <input type="date" name="tanggal_lahir"
                                                        class="form-control form-control-solid"
                                                        value="{{ old('tanggal_lahir', $admin->tanggal_lahir ? \Carbon\Carbon::parse($admin->tanggal_lahir)->format('Y-m-d') : null) }}">
                                                </div>
                                            </div>

                                            <div class="row mb-6">
                                                <label class="col-lg-4 col-form-label fw-semibold text-muted">Jenis
                                                    Kelamin</label>
                                                <div class="col-lg-8">
                                                    <select name="jenis_kelamin" class="form-select form-select-solid"
                                                        data-control="select2" data-hide-search="true">
                                                        @php $jkOld = old('jenis_kelamin', $admin->jenis_kelamin); @endphp
                                                        <option value="" {{ $jkOld ? '' : 'selected' }}>Pilih
                                                        </option>
                                                        <option value="L" {{ $jkOld === 'L' ? 'selected' : '' }}>
                                                            Laki-laki</option>
                                                        <option value="P" {{ $jkOld === 'P' ? 'selected' : '' }}>
                                                            Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-6">
                                                <label
                                                    class="col-lg-4 col-form-label fw-semibold text-muted">Alamat</label>
                                                <div class="col-lg-8">
                                                    <textarea name="alamat" rows="3" class="form-control form-control-solid" placeholder="Alamat lengkap">{{ old('alamat', $admin->alamat) }}</textarea>
                                                </div>
                                            </div>

                                            <div class="row mb-6">
                                                <label class="col-lg-4 col-form-label fw-semibold text-muted">Email</label>
                                                <div class="col-lg-8">
                                                    <input type="email" name="email"
                                                        class="form-control form-control-solid"
                                                        value="{{ old('email', $admin->email) }}" placeholder="Email">
                                                </div>
                                            </div>

                                            <div class="row mb-6">
                                                <label class="col-lg-4 col-form-label fw-semibold text-muted">No HP</label>
                                                <div class="col-lg-8">
                                                    <input type="text" name="no_hp"
                                                        class="form-control form-control-solid"
                                                        value="{{ old('no_hp', $admin->no_hp) }}"
                                                        placeholder="08xxxxxxxxxx">
                                                </div>
                                            </div>

                                            @php
                                                $foto = $admin->foto ?? 'assets/media/foto/blank.png';

                                                if (\Illuminate\Support\Str::startsWith($foto, 'http')) {
                                                    $fotoUrl = $foto;
                                                } elseif (
                                                    \Illuminate\Support\Str::startsWith(
                                                        str_replace('\\', '/', $foto),
                                                        'foto_admin/',
                                                    )
                                                ) {
                                                    $fotoUrl = asset('storage/' . str_replace('\\', '/', $foto));
                                                } else {
                                                    $fotoUrl = asset($foto);
                                                }

                                                $blankUrl = asset('assets/media/foto/blank.png');
                                            @endphp

                                            <input type="hidden" name="foto_remove" id="foto_remove" value="0">

                                            <div class="row mb-6">
                                                <label class="col-lg-4 col-form-label fw-semibold text-muted">Foto</label>
                                                <div class="col-lg-8">
                                                    <input type="file" name="foto" id="foto"
                                                        class="form-control form-control-solid" accept="image/*">

                                                    <div class="d-flex align-items-center gap-3 mt-4">
                                                        <div class="symbol symbol-80px symbol-circle">
                                                            <div id="foto_preview" class="symbol-label"
                                                                data-blank="{{ $blankUrl }}"
                                                                style="background-image:url('{{ $fotoUrl }}'); background-size:cover; background-position:center;">
                                                            </div>
                                                        </div>

                                                        <button type="button" class="btn btn-light-danger"
                                                            id="btn-remove-foto">
                                                            Hapus Foto
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    const input = document.getElementById('foto');
                                                    const preview = document.getElementById('foto_preview');
                                                    const remove = document.getElementById('foto_remove');
                                                    const btnRemove = document.getElementById('btn-remove-foto');
                                                    const blankUrl = preview?.dataset?.blank;

                                                    let objectUrl = null;

                                                    if (input) {
                                                        input.addEventListener('change', function() {
                                                            if (!this.files || !this.files[0]) return;

                                                            remove.value = '0';

                                                            if (objectUrl) URL.revokeObjectURL(objectUrl);
                                                            objectUrl = URL.createObjectURL(this.files[0]);

                                                            preview.style.backgroundImage = `url('${objectUrl}')`;
                                                        });
                                                    }

                                                    if (btnRemove) {
                                                        btnRemove.addEventListener('click', function() {
                                                            remove.value = '1';
                                                            if (input) input.value = '';
                                                            if (objectUrl) URL.revokeObjectURL(objectUrl);
                                                            objectUrl = null;
                                                            if (blankUrl) preview.style.backgroundImage = `url('${blankUrl}')`;
                                                        });
                                                    }
                                                });
                                            </script>

                                            <div class="d-flex justify-content-end gap-2">
                                                <button type="reset" class="btn btn-light">Reset</button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="ki-duotone ki-check fs-2"></i> Simpan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="tab_security">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <div class="card-title m-0">
                                            <h3 class="fw-bold m-0">Security</h3>
                                        </div>
                                    </div>

                                    <div class="card-body pt-0">
                                        <form method="POST" action="{{ route('admin.profile.password') }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="row mb-6">
                                                <label class="col-lg-4 col-form-label fw-semibold text-muted">Password
                                                    Lama</label>
                                                <div class="col-lg-8">
                                                    <div class="position-relative">
                                                        <input type="password" name="current_password"
                                                            class="form-control form-control-solid pe-12 password-field
                                                            {{ session('error_field') === 'current_password' ? 'is-invalid' : '' }}"
                                                            placeholder="••••••••">

                                                        @if (session('error_field') === 'current_password')
                                                            <div class="invalid-feedback d-block">{{ session('error') }}
                                                            </div>
                                                        @endif

                                                        <span
                                                            class="btn btn-sm btn-icon position-absolute top-50 end-0 translate-middle-y me-3 toggle-password">
                                                            <i class="ki-duotone ki-eye fs-2">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                                <span class="path3"></span>
                                                            </i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-6">
                                                <label class="col-lg-4 col-form-label fw-semibold text-muted">Password
                                                    Baru</label>
                                                <div class="col-lg-8">
                                                    <div class="position-relative">
                                                        <input type="password" name="password"
                                                            class="form-control form-control-solid pe-12 password-field
                                                            {{ session('error_field') === 'password' ? 'is-invalid' : '' }}"
                                                            placeholder="••••••••">

                                                        @if (session('error_field') === 'password')
                                                            <div class="invalid-feedback d-block">{{ session('error') }}
                                                            </div>
                                                        @endif

                                                        <span
                                                            class="btn btn-sm btn-icon position-absolute top-50 end-0 translate-middle-y me-3 toggle-password">
                                                            <i class="ki-duotone ki-eye fs-2">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                                <span class="path3"></span>
                                                            </i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-6">
                                                <label class="col-lg-4 col-form-label fw-semibold text-muted">Konfirmasi
                                                    Password</label>
                                                <div class="col-lg-8">
                                                    <div class="position-relative">
                                                        <input type="password" name="password_confirmation"
                                                            class="form-control form-control-solid pe-12 password-field
                                                            {{ session('error_field') === 'password_confirmation' ? 'is-invalid' : '' }}"
                                                            placeholder="••••••••">

                                                        @if (session('error_field') === 'password_confirmation')
                                                            <div class="invalid-feedback d-block">{{ session('error') }}
                                                            </div>
                                                        @endif

                                                        <span
                                                            class="btn btn-sm btn-icon position-absolute top-50 end-0 translate-middle-y me-3 toggle-password">
                                                            <i class="ki-duotone ki-eye fs-2">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                                <span class="path3"></span>
                                                            </i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="ki-duotone ki-lock-2 fs-2"></i> Update Password
                                                </button>
                                            </div>
                                        </form>

                                        <div class="separator my-7"></div>

                                        <div
                                            class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                                            <i class="ki-duotone ki-shield-tick fs-2x text-warning me-4">
                                                <span class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span>
                                            </i>
                                            <div class="fw-semibold text-gray-700">
                                                Tips: gunakan password minimal 8 karakter, kombinasi huruf besar-kecil,
                                                angka, dan simbol.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-password').forEach(btn => {
                btn.addEventListener('click', function() {
                    const input = this.closest('.position-relative').querySelector(
                        '.password-field');
                    const icon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('ki-eye');
                        icon.classList.add('ki-eye-slash');
                        icon.innerHTML = `
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                        `;
                    } else {
                        input.type = 'password';
                        icon.classList.remove('ki-eye-slash');
                        icon.classList.add('ki-eye');
                        icon.innerHTML = `
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        `;
                    }
                });
            });
        });
    </script>
@endsection
