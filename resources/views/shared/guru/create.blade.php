<!--begin::Modal - Add task-->
<div class="modal fade" id="modal_add_guru" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="modal_add_guru_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Tambah guru</h2>
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
                <form enctype="multipart/form-data" id="modal_add_guru_form" class="form form-loading"
                    action="{{ route('admin.guru.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="form_source" value="add_guru">

                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="modal_add_guru_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modal_add_guru_header"
                        data-kt-scroll-wrappers="#modal_add_guru_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <label class="d-block fw-semibold fs-6 mb-5">Foto</label>

                            <div class="image-input image-input-outline" data-kt-image-input="true"
                                style="background-image: url('{{ asset('assets/media/svg/files/blank-image.svg') }}')">

                                <!-- Preview Image -->
                                <div class="image-input-wrapper w-125px h-125px"
                                    style="background-image: url('{{ isset($guru) && $guru->foto ? asset('storage/foto/' . $guru->foto) : asset('assets/media/foto/blank.png') }}');">
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
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Batal foto">
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
                            @if (old('form_source') == 'add_guru')
                                @error('foto')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">NIK</label>
                            <input type="text" name="nik" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="NIK guru" value="{{ old('nik') }}" />

                            @if (old('form_source') == 'add_guru')
                                @error('nik')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">NIPA</label>
                            <input type="text" name="nipa" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="NIPA guru" value="{{ old('nipa') }}" />

                            @if (old('form_source') == 'add_guru')
                                @error('nipa')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Nama<span class="text-danger ms-1">*</span></label>
                            <input type="text" name="nama_guru" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Nama guru" value="{{ old('nama_guru') }}" />
                            @if (old('form_source') == 'add_guru')
                                @error('nama_guru')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Tempat Lahir<span
                                    class="text-danger ms-1">*</span></label>
                            <input type="text" name="tempat_lahir"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Tempat Lahir guru" value="{{ old('tempat_lahir') }}" />
                            @if (old('form_source') == 'add_guru')
                                @error('tempat_lahir')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Tanggal Lahir<span
                                    class="text-danger ms-1">*</span></label>
                            <!--begin::Input-->
                            <div class="position-relative d-flex align-items-center">
                                <!--begin::Icon-->
                                <i class="ki-duotone ki-calendar-8 fs-2 position-absolute mx-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                                <!--end::Icon-->
                                <!--begin::Datepicker-->
                                <input class="form-control form-control-solid ps-12" placeholder="Tanggal Lahir guru"
                                    type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" />
                                <!--end::Datepicker-->
                            </div>
                            <!--end::Input-->
                            @if (old('form_source') == 'add_guru')
                                @error('tanggal_lahir')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>


                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Jenis Kelamin<span
                                    class="text-danger ms-1">*</span></label>
                            <select class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true" data-placeholder="Pilih Jenis Kelamin..."
                                name="jenis_kelamin">
                                <option value="">Pilih Jenis Kelamin...</option>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @if (old('form_source') == 'add_guru')
                                @error('jenis_kelamin')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Jabatan<span
                                    class="text-danger ms-1">*</span></label>
                            <select class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true" data-placeholder="Pilih Jabatan..." name="jabatan">
                                <option value="">Pilih Jabatan...</option>
                                <option value="kepala_sekolah" {{ old('jabatan') == 'kepala_sekolah' ? 'selected' : '' }}>Kepala Sekolah</option>
                                <option value="operator" {{ old('jabatan') == 'operator' ? 'selected' : '' }}>Operator</option>
                                <option value="guru" {{ old('jabatan') == 'guru' ? 'selected' : '' }}>Guru</option>
                            </select>
                            @if (old('form_source') == 'add_guru')
                                @error('jabatan')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Alamat</label>
                            <textarea class="form-control form-control-solid" rows="3" name="alamat" placeholder="Type Alamat">{{ old('alamat') }}</textarea>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Email</label>
                            <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Email guru" value="{{ old('email') }}" />
                            @if (old('form_source') == 'add_guru')
                                @error('email')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">No HP</label>
                            <input type="text" name="no_hp" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="No HP guru" value="{{ old('no_hp') }}" />
                            @if (old('form_source') == 'add_guru')
                                @error('no_hp')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Pendidikan Terakhir<span
                                    class="text-danger ms-1">*</span></label>
                            <select class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true" data-placeholder="Pilih Pendidikan Terakhir..."
                                name="pend_terakhir">
                                <option value="">Pilih Pendidikan Terakhir...</option>
                                <option value="smp" {{ old('pend_terakhir') == 'smp' ? 'selected' : '' }}>SMP</option>
                                <option value="sma" {{ old('pend_terakhir') == 'sma' ? 'selected' : '' }}>SMA</option>
                                <option value="smk" {{ old('pend_terakhir') == 'smk' ? 'selected' : '' }}>SMK</option>
                                <option value="d3" {{ old('pend_terakhir') == 'd3' ? 'selected' : '' }}>D3</option>
                                <option value="s1" {{ old('pend_terakhir') == 's1' ? 'selected' : '' }}>S1</option>
                                <option value="s2" {{ old('pend_terakhir') == 's2' ? 'selected' : '' }}>S2</option>
                                <option value="s3" {{ old('pend_terakhir') == 's3' ? 'selected' : '' }}>S3</option>
                            </select>
                            @if (old('form_source') == 'add_guru')
                                @error('pend_terakhir')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Jurusan<span
                                    class="text-danger ms-1">*</span></label>
                            <input type="text" name="jurusan" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Jurusan guru" value="{{ old('jurusan') }}" />
                            @if (old('form_source') == 'add_guru')
                                @error('jurusan')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Tanggal Masuk<span
                                    class="text-danger ms-1">*</span></label>
                            <!--begin::Input-->
                            <div class="position-relative d-flex align-items-center">
                                <!--begin::Icon-->
                                <i class="ki-duotone ki-calendar-8 fs-2 position-absolute mx-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                                <!--end::Icon-->
                                <!--begin::Datepicker-->
                                <input class="form-control form-control-solid ps-12" placeholder="Tanggal Masuk guru"
                                    type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" />
                                <!--end::Datepicker-->
                            </div>
                            <!--end::Input-->
                            @if (old('form_source') == 'add_guru')
                                @error('tanggal_masuk')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Sekolah<span
                                    class="text-danger ms-1">*</span></label>
                            <select class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true" data-placeholder="Pilih Sekolah..." name="sekolahs_id">
                                <option value="">Pilih Sekolah...</option>
                                @foreach ($dataSekolah as $sekolah)
                                    <option value="{{ $sekolah->id }}"
                                        {{ old('sekolahs_id') == $sekolah->id ? 'selected' : '' }}>
                                        {{ $sekolah->nama_sekolah }}
                                    </option>
                                @endforeach
                            </select>
                            @if (old('form_source') == 'add_guru')
                                @error('sekolahs_id')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Username guru"
                                value="{{ old('username') }}" />

                            @if (old('form_source') == 'add_guru')
                                @error('username')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Password guru" />

                            @if (old('form_source') == 'add_guru')
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
                            <span class="indicator-label">Kirim</span>
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
<!--end::Modal - Add task-->
@if ($errors->any() && old('form_source') === 'add_guru')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('modal_add_guru'));
            myModal.show();
        });
    </script>
@endif
