@php
    $fotoGuru = $guru->foto ?? null;

    if ($fotoGuru) {
        if (\Illuminate\Support\Str::startsWith($fotoGuru, 'foto_guru/')) {
            $srcFotoGuru = asset('storage/' . $fotoGuru);
        } else {
            $srcFotoGuru = asset($fotoGuru);
        }
    } else {
        $srcFotoGuru = asset('assets/media/foto/blank.png');
    }
@endphp

<!--begin::Modal - Edit Guru-->
<div class="modal fade" id="modal_edit_guru_{{ $guru->id }}" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="modal_edit_guru_header_{{ $guru->id }}">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Edit Guru</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal"
                    data-kt-users-modal-action="close">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body px-5 my-7">
                <!--begin::Form-->
                <form enctype="multipart/form-data" id="modal_edit_guru_form_{{ $guru->id }}"
                    class="form form-loading" action="{{ route('admin.guru.update', $guru->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Penanda form untuk validasi --}}
                    <input type="hidden" name="form_source" value="edit_guru">
                    <input type="hidden" name="guru_id" value="{{ $guru->id }}">

                    <div class="d-flex flex-column scroll-y px-5 px-lg-10"
                        id="modal_edit_guru_scroll_{{ $guru->id }}" data-kt-scroll="true"
                        data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modal_edit_guru_header_{{ $guru->id }}"
                        data-kt-scroll-wrappers="#modal_edit_guru_scroll_{{ $guru->id }}"
                        data-kt-scroll-offset="300px">

                        {{-- FOTO --}}
                        <div class="fv-row mb-7">
                            <label class="d-block fw-semibold fs-6 mb-5">Foto</label>

                            <div class="image-input image-input-outline" data-kt-image-input="true"
                                style="background-image: url('{{ asset('assets/media/svg/files/blank-image.svg') }}')">

                                <!-- Preview Image -->
                                <div class="image-input-wrapper w-125px h-125px"
                                    style="background-image: url('{{ $srcFotoGuru }}');">
                                </div>

                                <!-- Upload -->
                                <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Ganti foto">
                                    <i class="ki-duotone ki-pencil fs-7">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                    <input type="file" name="foto" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="foto_remove" />
                                </label>

                                <!-- Cancel -->
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                    title="Batal ganti foto">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </span>

                                <!-- Remove -->
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus foto">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </span>
                            </div>

                            <div class="form-text">Tipe file : png, jpg, jpeg.</div>
                            @if (old('form_source') == 'edit_guru' && old('guru_id') == $guru->id)
                                @error('foto')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- NIK --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">NIK</label>
                            <input type="text" name="nik" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="NIK guru"
                                value="{{ old('form_source') == 'edit_guru' && old('guru_id') == $guru->id ? old('nik') : $guru->nik }}" />
                            @if (old('form_source') == 'edit_guru' && old('guru_id') == $guru->id)
                                @error('nik')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- NIPA --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">NIPA</label>
                            <input type="text" name="nipa" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="NIPA guru"
                                value="{{ old('form_source') == 'edit_guru' && old('guru_id') == $guru->id ? old('nipa') : $guru->nipa }}" />
                            @if (old('form_source') == 'edit_guru' && old('guru_id') == $guru->id)
                                @error('nipa')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- NAMA --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Nama<span class="text-danger ms-1">*</span></label>
                            <input type="text" name="nama_guru" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Nama guru"
                                value="{{ old('form_source') == 'edit_guru' && old('guru_id') == $guru->id ? old('nama_guru') : $guru->nama_guru }}" />
                            @if (old('form_source') == 'edit_guru' && old('guru_id') == $guru->id)
                                @error('nama_guru')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- TEMPAT LAHIR --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Tempat Lahir<span
                                    class="text-danger ms-1">*</span></label>
                            <input type="text" name="tempat_lahir"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Tempat Lahir guru"
                                value="{{ old('form_source') == 'edit_guru' && old('guru_id') == $guru->id ? old('tempat_lahir') : $guru->tempat_lahir }}" />
                            @if (old('form_source') == 'edit_guru' && old('guru_id') == $guru->id)
                                @error('tempat_lahir')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- TANGGAL LAHIR --}}
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
                                        optional($guru->tanggal_lahir)->format('Y-m-d'),
                                    );
                                @endphp

                                <input class="form-control form-control-solid ps-12" placeholder="Tanggal Lahir Guru"
                                    type="date" name="tanggal_lahir" value="{{ $tanggalLahirValue }}" />

                            </div>
                            @error('tanggal_lahir')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- JENIS KELAMIN --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Jenis Kelamin<span
                                    class="text-danger ms-1">*</span></label>
                            @php
                                $jkValue =
                                    old('form_source') == 'edit_guru' && old('guru_id') == $guru->id
                                        ? old('jenis_kelamin')
                                        : $guru->jenis_kelamin;
                            @endphp
                            <select class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true" data-placeholder="Pilih Jenis Kelamin..."
                                name="jenis_kelamin">
                                <option value="">Pilih Jenis Kelamin...</option>
                                <option value="L" {{ $jkValue == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ $jkValue == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @if (old('form_source') == 'edit_guru' && old('guru_id') == $guru->id)
                                @error('jenis_kelamin')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- JABATAN --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Jabatan<span
                                    class="text-danger ms-1">*</span></label>
                            @php
                                $jabatanValue =
                                    old('form_source') == 'edit_guru' && old('guru_id') == $guru->id
                                        ? old('jabatan')
                                        : $guru->jabatan;
                            @endphp
                            <select class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true" data-placeholder="Pilih Jabatan..." name="jabatan">
                                <option value="">Pilih Jabatan...</option>
                                <option value="kepala_sekolah"
                                    {{ $jabatanValue == 'kepala_sekolah' ? 'selected' : '' }}>
                                    Kepala Sekolah</option>
                                <option value="operator" {{ $jabatanValue == 'operator' ? 'selected' : '' }}>Operator
                                </option>
                                <option value="guru" {{ $jabatanValue == 'guru' ? 'selected' : '' }}>Guru</option>
                            </select>
                            @if (old('form_source') == 'edit_guru' && old('guru_id') == $guru->id)
                                @error('jabatan')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- ALAMAT --}}
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Alamat</label>
                            <textarea class="form-control form-control-solid" rows="3" name="alamat" placeholder="Type Alamat">{{ old('form_source') == 'edit_guru' && old('guru_id') == $guru->id ? old('alamat') : $guru->alamat }}</textarea>
                        </div>

                        {{-- EMAIL --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Email</label>
                            <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Email guru"
                                value="{{ old('form_source') == 'edit_guru' && old('guru_id') == $guru->id ? old('email') : $guru->email }}" />
                            @if (old('form_source') == 'edit_guru' && old('guru_id') == $guru->id)
                                @error('email')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- NO HP --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">No HP</label>
                            <input type="text" name="no_hp" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="No HP guru"
                                value="{{ old('form_source') == 'edit_guru' && old('guru_id') == $guru->id ? old('no_hp') : $guru->no_hp }}" />
                            @if (old('form_source') == 'edit_guru' && old('guru_id') == $guru->id)
                                @error('no_hp')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- PENDIDIKAN TERAKHIR --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Pendidikan Terakhir<span
                                    class="text-danger ms-1">*</span></label>
                            @php
                                $pendValue =
                                    old('form_source') == 'edit_guru' && old('guru_id') == $guru->id
                                        ? old('pend_terakhir')
                                        : $guru->pend_terakhir;
                            @endphp
                            <select class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true" data-placeholder="Pilih Pendidikan Terakhir..."
                                name="pend_terakhir">
                                <option value="">Pilih Pendidikan Terakhir...</option>
                                <option value="smp" {{ $pendValue == 'smp' ? 'selected' : '' }}>SMP</option>
                                <option value="sma" {{ $pendValue == 'sma' ? 'selected' : '' }}>SMA</option>
                                <option value="smk" {{ $pendValue == 'smk' ? 'selected' : '' }}>SMK</option>
                                <option value="d3" {{ $pendValue == 'd3' ? 'selected' : '' }}>D3</option>
                                <option value="s1" {{ $pendValue == 's1' ? 'selected' : '' }}>S1</option>
                                <option value="s2" {{ $pendValue == 's2' ? 'selected' : '' }}>S2</option>
                                <option value="s3" {{ $pendValue == 's3' ? 'selected' : '' }}>S3</option>
                            </select>
                            @if (old('form_source') == 'edit_guru' && old('guru_id') == $guru->id)
                                @error('pend_terakhir')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- JURUSAN --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Jurusan<span
                                    class="text-danger ms-1">*</span></label>
                            <input type="text" name="jurusan" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Jurusan guru"
                                value="{{ old('form_source') == 'edit_guru' && old('guru_id') == $guru->id ? old('jurusan') : $guru->jurusan }}" />
                            @if (old('form_source') == 'edit_guru' && old('guru_id') == $guru->id)
                                @error('jurusan')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- TANGGAL MASUK --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">
                                Tanggal Masuk <span class="text-danger ms-1">*</span>
                            </label>
                            <div class="position-relative d-flex align-items-center">
                                <i class="ki-duotone ki-calendar-8 fs-2 position-absolute mx-4">
                                    <span class="path1"></span><span class="path2"></span>
                                    <span class="path3"></span><span class="path4"></span>
                                    <span class="path5"></span><span class="path6"></span>
                                </i>
                                @php
                                    $tanggalLahirValue = old(
                                        'tanggal_masuk',
                                        optional($guru->tanggal_masuk)->format('Y-m-d'),
                                    );
                                @endphp

                                <input class="form-control form-control-solid ps-12" placeholder="Tanggal Masuk Guru"
                                    type="date" name="tanggal_masuk" value="{{ $tanggalLahirValue }}" />

                            </div>
                            @error('tanggal_masuk')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>


                        {{-- SEKOLAH --}}
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Sekolah<span
                                    class="text-danger ms-1">*</span></label>
                            @php
                                $sekolahValue =
                                    old('form_source') == 'edit_guru' && old('guru_id') == $guru->id
                                        ? old('sekolahs_id')
                                        : $guru->sekolahs_id;
                            @endphp
                            <select class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true" data-placeholder="Pilih Sekolah..." name="sekolahs_id">
                                <option value="">Pilih Sekolah...</option>
                                @foreach ($dataSekolah as $sekolah)
                                    <option value="{{ $sekolah->id }}"
                                        {{ $sekolahValue == $sekolah->id ? 'selected' : '' }}>
                                        {{ $sekolah->nama_sekolah }}
                                    </option>
                                @endforeach
                            </select>
                            @if (old('form_source') == 'edit_guru' && old('guru_id') == $guru->id)
                                @error('sekolahs_id')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true" data-placeholder="Pilih status...">
                                <option value="">Pilih status...</option>
                                <option value="aktif"
                                    {{ old('status', $guru->user->status ?? '') == 'aktif' ? 'selected' : '' }}>
                                    Aktif
                                </option>
                                <option value="non_aktif"
                                    {{ old('status', $guru->user->status ?? '') == 'non_aktif' ? 'selected' : '' }}>
                                    Tidak Aktif</option>
                            </select>
                            @error('status')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- USERNAME --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Username guru"
                                value="{{ old('form_source') == 'edit_guru' && old('guru_id') == $guru->id ? old('username') : $guru->user->username ?? '' }}" />
                            @if (old('form_source') == 'edit_guru' && old('guru_id') == $guru->id)
                                @error('username')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- PASSWORD (optional: kalau kosong jangan diubah di controller) --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Password (kosongkan jika tidak diubah)</label>
                            <input type="password" name="password"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Password guru" />
                            @if (old('form_source') == 'edit_guru' && old('guru_id') == $guru->id)
                                @error('password')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                    </div>

                    <div class="text-center pt-10">
                        <button type="button" class="btn btn-light me-3" data-kt-users-modal-action="cancel"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">Simpan Perubahan</span>
                            <span class="indicator-progress">Mohon tunggu...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Edit Guru-->

{{-- Kalau ada error validasi, buka modal guru yang sesuai --}}
@if ($errors->any() && old('form_source') === 'edit_guru' && old('guru_id') == $guru->id)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modalEl = document.getElementById('modal_edit_guru_{{ $guru->id }}');
            if (modalEl) {
                var myModal = new bootstrap.Modal(modalEl);
                myModal.show();
            }
        });
    </script>
@endif
