<!--begin::Modal - Add task-->
<div class="modal fade" id="modal_add_anak" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="modal_add_anak_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Tambah Anak</h2>
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
                <form enctype="multipart/form-data" id="modal_add_anak_form" class="form form-loading"
                    action="{{ route($routeNameStore) }}" method="POST">
                    @csrf
                    <input type="hidden" name="form_source" value="add_anak">

                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="modal_add_anak_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modal_add_anak_header"
                        data-kt-scroll-wrappers="#modal_add_anak_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <label class="d-block fw-semibold fs-6 mb-5">Foto</label>

                            <div class="image-input image-input-outline" data-kt-image-input="true"
                                style="background-image: url('{{ asset('assets/media/svg/files/blank-image.svg') }}')">

                                <!-- Preview Image -->
                                <div class="image-input-wrapper w-125px h-125px"
                                    style="background-image: url('{{ isset($anak) && $anak->foto ? asset('storage/foto/' . $anak->foto) : asset('assets/media/foto/blank.png') }}');">
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
                            @if (old('form_source') == 'add_anak')
                                @error('foto')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">NIK</label>
                            <input type="text" name="nik" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="NIK anak" value="{{ old('nik') }}" />

                            @if (old('form_source') == 'add_anak')
                                @error('nik')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">NISN</label>
                            <input type="text" name="nisn" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="NISN anak" value="{{ old('nisn') }}" />

                            @if (old('form_source') == 'add_anak')
                                @error('nisn')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">NIPD</label>
                            <input type="text" name="nipd" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="NIPD anak" value="{{ old('nipd') }}" />

                            @if (old('form_source') == 'add_anak')
                                @error('nipd')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">NO KK</label>
                            <input type="text" name="no_kk" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="NO KK anak" value="{{ old('no_kk') }}" />

                            @if (old('form_source') == 'add_anak')
                                @error('no_kk')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">No Registrasi KK</label>
                            <input type="text" name="no_registrasi_kk"
                                class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="No Registrasi KK anak" value="{{ old('no_registrasi_kk') }}" />

                            @if (old('form_source') == 'add_anak')
                                @error('no_registrasi_kk')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Nama<span class="text-danger ms-1">*</span></label>
                            <input type="text" name="nama_anak"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nama anak"
                                value="{{ old('nama_anak') }}" />
                            @if (old('form_source') == 'add_anak')
                                @error('nama_anak')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Tempat Lahir<span
                                    class="text-danger ms-1">*</span></label>
                            <input type="text" name="tempat_lahir"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Tempat Lahir anak"
                                value="{{ old('tempat_lahir') }}" />
                            @if (old('form_source') == 'add_anak')
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
                                <input class="form-control form-control-solid ps-12" placeholder="Tanggal Lahir anak"
                                    type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" />
                                <!--end::Datepicker-->
                            </div>
                            <!--end::Input-->
                            @if (old('form_source') == 'add_anak')
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
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                            @if (old('form_source') == 'add_anak')
                                @error('jenis_kelamin')
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
                                <input class="form-control form-control-solid ps-12" placeholder="Tanggal Masuk anak"
                                    type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" />
                                <!--end::Datepicker-->
                            </div>
                            <!--end::Input-->
                            @if (old('form_source') == 'add_anak')
                                @error('tanggal_masuk')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Orang Tua<span
                                    class="text-danger ms-1">*</span></label>
                            <select class="form-select form-select-solid" data-control="select2"
                                data-placeholder="Pilih Orang Tua..." name="orang_tuas_id">
                                <option value=""></option>
                                @foreach ($dataOrangTua as $orangTua)
                                    <option value="{{ $orangTua->id }}"
                                        {{ old('orang_tuas_id') == $orangTua->id ? 'selected' : '' }}>
                                        {{ $orangTua->nama_ayah }} & {{ $orangTua->nama_ibu }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Sekolah<span
                                    class="text-danger ms-1">*</span></label>

                            @role('guru')
                                @php
                                    $sekolahGuru = $dataSekolah->first(); // harusnya 1 sekolah (hasil filter dari controller)
                                @endphp

                                {{-- tampil (terkunci) --}}
                                <select class="form-select form-select-solid" disabled>
                                    <option value="{{ $sekolahGuru?->id }}">
                                        {{ $sekolahGuru?->nama_sekolah ?? 'Sekolah belum di-set' }}
                                    </option>
                                </select>

                                {{-- yang dikirim ke backend --}}
                                <input type="hidden" name="sekolahs_id"
                                    value="{{ old('sekolahs_id', $sekolahGuru?->id) }}">
                            @else
                                <select class="form-select form-select-solid" data-control="select2"
                                    data-placeholder="Pilih Sekolah..." name="sekolahs_id">
                                    <option value=""></option>
                                    @foreach ($dataSekolah as $sekolah)
                                        <option value="{{ $sekolah->id }}"
                                            {{ old('sekolahs_id') == $sekolah->id ? 'selected' : '' }}>
                                            {{ $sekolah->nama_sekolah }}
                                        </option>
                                    @endforeach
                                </select>
                            @endrole

                            @if (old('form_source') == 'add_anak')
                                @error('sekolahs_id')
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
@if ($errors->any() && old('form_source') === 'add_anak')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('modal_add_anak'));
            myModal.show();
        });
    </script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalId = '#modal_add_anak';
        const modalEl = document.querySelector(modalId);

        // 1) FIX focus lock bootstrap modal (biar bisa ngetik di search select2)
        // Bootstrap 4/5 beda, tapi ini aman
        if (window.bootstrap && bootstrap.Modal) {
            // Bootstrap 5 biasanya aman, tapi Metronic kadang masih lock focus -> kita paksa fokus saja saat open
        } else if ($.fn.modal && $.fn.modal.Constructor) {
            // Bootstrap 4 fallback
            $.fn.modal.Constructor.prototype._enforceFocus = function() {};
        }

        // 2) Init select2 khusus dalam modal (destroy dulu kalau sudah ada)
        modalEl.addEventListener('shown.bs.modal', function() {
            $(modalEl).find('select[data-control="select2"]').each(function() {
                // destroy jika sudah ter-init (Metronic sering init dari awal)
                if ($(this).hasClass('select2-hidden-accessible')) {
                    $(this).select2('destroy');
                }

                $(this).select2({
                    dropdownParent: $(modalId),
                    width: '100%',
                    placeholder: $(this).data('placeholder') || 'Pilih...',
                    minimumResultsForSearch: 0 // paksa search selalu muncul
                });
            });
        });

        // 3) Paksa fokus ke input search tiap dropdown dibuka
        $(document).on('select2:open', function() {
            setTimeout(function() {
                const el = document.querySelector(
                    '.select2-container--open .select2-search__field');
                if (el) el.focus();
            }, 0);
        });
    });
</script>
