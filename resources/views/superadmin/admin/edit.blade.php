@php
    $foto = $admin->foto;
    if (\Illuminate\Support\Str::startsWith($foto, 'foto_admin/')) {
        $fotoUrl = asset('storage/' . $foto);
    } else {
        $fotoUrl = asset($foto);
    }
@endphp

<div class="modal fade" id="modal_edit_admin_{{ $admin->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            {{-- Header --}}
            <div class="modal-header" id="modal_edit_admin_header_{{ $admin->id }}">
                <h2 class="fw-bold">Edit Admin</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span><span class="path2"></span>
                    </i>
                </div>
            </div>

            {{-- Body --}}
            <div class="modal-body px-5 my-7">
                <form enctype="multipart/form-data" id="modal_edit_admin_form_{{ $admin->id }}"
                    class="form form-loading" action="{{ route('superadmin.admin.update', $admin->id) }}"
                    method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Penanda form untuk reopen modal kalau validasi error (opsional) --}}
                    <input type="hidden" name="form_source" value="edit_admin_{{ $admin->id }}">

                    <div class="d-flex flex-column scroll-y px-5 px-lg-10"
                        id="modal_edit_admin_scroll_{{ $admin->id }}" data-kt-scroll="true"
                        data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modal_edit_admin_header_{{ $admin->id }}"
                        data-kt-scroll-wrappers="#modal_edit_admin_scroll_{{ $admin->id }}"
                        data-kt-scroll-offset="300px">

                        {{-- FOTO --}}
                        <div class="fv-row mb-7">
                            <label class="d-block fw-semibold fs-6 mb-5">Foto</label>

                            <div class="image-input image-input-outline" data-kt-image-input="true"
                                style="background-image: url('{{ asset('assets/media/svg/files/blank-image.svg') }}')">

                                {{-- Preview --}}
                                <div class="image-input-wrapper w-125px h-125px"
                                    style="background-image: url('{{ $fotoUrl }}');">
                                </div>

                                {{-- Upload --}}
                                <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Ganti foto">
                                    <i class="ki-duotone ki-pencil fs-7">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    <input type="file" name="foto" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="foto_remove" />
                                </label>

                                {{-- Cancel --}}
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Batal foto">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </span>

                                {{-- Remove --}}
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus foto">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </span>
                            </div>

                            <div class="form-text">Tipe file : png, jpg, jpeg.</div>
                            @error('foto')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- NIK --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">NIK</label>
                            <input type="text" name="nik" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="NIK admin" value="{{ old('nik', $admin->nik) }}" />
                            @error('nik')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- NIPA --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">NIPA</label>
                            <input type="text" name="nipa" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="NIPA admin" value="{{ old('nipa', $admin->nipa) }}" />
                            @error('nipa')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Nama --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">
                                Nama <span class="text-danger ms-1">*</span>
                            </label>
                            <input type="text" name="nama" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Nama admin" value="{{ old('nama', $admin->nama) }}" />
                            @error('nama')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tempat Lahir --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">
                                Tempat Lahir <span class="text-danger ms-1">*</span>
                            </label>
                            <input type="text" name="tempat_lahir"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Tempat Lahir admin"
                                value="{{ old('tempat_lahir', $admin->tempat_lahir) }}" />
                            @error('tempat_lahir')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">
                                Tanggal Lahir <span class="text-danger ms-1">*</span>
                            </label>
                            <div class="position-relative d-flex align-items-center">
                                <i class="ki-duotone ki-calendar-8 fs-2 position-absolute mx-4">
                                    <span class="path1"></span><span class="path2"></span>
                                    <span class="path3"></span><span class="path4"></span>
                                    <span class="path5"></span><span class="path6"></span>
                                </i>
                                @php
                                    $tanggalLahirValue = old(
                                        'tanggal_lahir',
                                        optional($admin->tanggal_lahir)->format('Y-m-d'),
                                    );
                                @endphp

                                <input class="form-control form-control-solid ps-12" placeholder="Tanggal Lahir Admin"
                                    type="date" name="tanggal_lahir" value="{{ $tanggalLahirValue }}" />

                            </div>
                            @error('tanggal_lahir')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">
                                Jenis Kelamin <span class="text-danger ms-1">*</span>
                            </label>
                            <select class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true" data-placeholder="Pilih Jenis Kelamin..."
                                name="jenis_kelamin">
                                <option value="">Pilih Jenis Kelamin...</option>
                                <option value="L"
                                    {{ old('jenis_kelamin', $admin->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="P"
                                    {{ old('jenis_kelamin', $admin->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Alamat --}}
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Alamat</label>
                            <textarea class="form-control form-control-solid" rows="3" name="alamat" placeholder="Type Alamat">{{ old('alamat', $admin->alamat) }}</textarea>
                            @error('alamat')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Email</label>
                            <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Email admin" value="{{ old('email', $admin->email) }}" />
                            @error('email')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- No HP --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">No HP</label>
                            <input type="text" name="no_hp" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="No HP admin" value="{{ old('no_hp', $admin->no_hp) }}" />
                            @error('no_hp')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Daerah --}}
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">
                                Daerah <span class="text-danger ms-1">*</span>
                            </label>
                            <select class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true" data-placeholder="Pilih Daerah..." name="daerahs_id">
                                <option value="">Pilih Daerah...</option>
                                @foreach ($dataDaerah as $daerah)
                                    <option value="{{ $daerah->id }}"
                                        {{ old('daerahs_id', $admin->daerahs_id) == $daerah->id ? 'selected' : '' }}>
                                        {{ $daerah->nama_daerah }}
                                    </option>
                                @endforeach
                            </select>
                            @error('daerahs_id')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Username (dari tabel users) --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">
                                Username <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="username"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Username admin"
                                value="{{ old('username', $admin->user->username ?? '') }}" />
                            @error('username')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Password (opsional)</label>
                            <input type="password" name="password"
                                class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Isi jika ingin mengganti password" />
                            @error('password')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true" data-placeholder="Pilih status...">
                                <option value="">Pilih status...</option>
                                <option value="aktif"
                                    {{ old('status', $admin->user->status ?? '') == 'aktif' ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="non_aktif"
                                    {{ old('status', $admin->user->status ?? '') == 'non_aktif' ? 'selected' : '' }}>
                                    Tidak Aktif</option>
                            </select>
                            @error('status')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>


                    </div>

                    <div class="text-center pt-10">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">Simpan Perubahan</span>
                            <span class="indicator-progress">Mohon tunggu...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
            {{-- end body --}}
        </div>
    </div>
</div>
