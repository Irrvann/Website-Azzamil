@php
    $fotoAnak = $anak->foto ?? null;

    if ($fotoAnak && \Illuminate\Support\Str::startsWith($fotoAnak, 'foto_anak/')) {
        $previewFoto = asset('storage/' . $fotoAnak);
    } elseif ($fotoAnak) {
        $previewFoto = asset($fotoAnak);
    } else {
        $previewFoto = asset('assets/media/foto/blank.png');
    }
@endphp

<!--begin::Modal - Edit Anak-->
<div class="modal fade" id="modal_edit_anak_{{ $anak->id }}" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="modal_edit_anak_header_{{ $anak->id }}">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Edit Anak</h2>
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
                <form enctype="multipart/form-data" id="modal_edit_anak_form_{{ $anak->id }}"
                    class="form form-loading" action="{{ route($routeNameUpdate, $anak->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- penanda untuk buka modal edit kalau validasi gagal --}}
                    <input type="hidden" name="form_source" value="edit_anak">
                    <input type="hidden" name="anak_id" value="{{ $anak->id }}">

                    <div class="d-flex flex-column scroll-y px-5 px-lg-10"
                        id="modal_edit_anak_scroll_{{ $anak->id }}" data-kt-scroll="true"
                        data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modal_edit_anak_header_{{ $anak->id }}"
                        data-kt-scroll-wrappers="#modal_edit_anak_scroll_{{ $anak->id }}"
                        data-kt-scroll-offset="300px">

                        {{-- FOTO --}}
                        <div class="fv-row mb-7">
                            <label class="d-block fw-semibold fs-6 mb-5">Foto</label>

                            <div class="image-input image-input-outline" data-kt-image-input="true"
                                style="background-image: url('{{ asset('assets/media/svg/files/blank-image.svg') }}')">

                                <!-- Preview Image -->
                                <div class="image-input-wrapper w-125px h-125px"
                                    style="background-image: url('{{ $previewFoto }}');">
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
                            @if (old('form_source') == 'edit_anak' && old('anak_id') == $anak->id)
                                @error('foto')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- NIK --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">NIK</label>
                            <input type="text" name="nik" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="NIK anak" value="{{ old('nik', $anak->nik) }}" />

                            @if (old('form_source') == 'edit_anak' && old('anak_id') == $anak->id)
                                @error('nik')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- NISN --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">NISN</label>
                            <input type="text" name="nisn" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="NISN anak" value="{{ old('nisn', $anak->nisn) }}" />

                            @if (old('form_source') == 'edit_anak' && old('anak_id') == $anak->id)
                                @error('nisn')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- NIPD --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">NIPD<span class="text-danger ms-1">*</span></label>
                            <input type="text" name="nipd" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="NIPD anak" value="{{ old('nipd', $anak->nipd) }}" />

                            @if (old('form_source') == 'edit_anak' && old('anak_id') == $anak->id)
                                @error('nipd')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- NO KK --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">NO KK</label>
                            <input type="text" name="no_kk" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="NO KK anak" value="{{ old('no_kk', $anak->no_kk) }}" />

                            @if (old('form_source') == 'edit_anak' && old('anak_id') == $anak->id)
                                @error('no_kk')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- No Registrasi Akta --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">No Registrasi Akta</label>
                            <input type="text" name="no_registrasi_akta"
                                class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="No Registrasi Akta anak"
                                value="{{ old('no_registrasi_akta', $anak->no_registrasi_akta) }}" />

                            @if (old('form_source') == 'edit_anak' && old('anak_id') == $anak->id)
                                @error('no_registrasi_akta')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- Nama --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Nama<span class="text-danger ms-1">*</span></label>
                            <input type="text" name="nama_anak"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nama anak"
                                value="{{ old('nama_anak', $anak->nama_anak) }}" />
                            @if (old('form_source') == 'edit_anak' && old('anak_id') == $anak->id)
                                @error('nama_anak')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- Tempat Lahir --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Tempat Lahir<span
                                    class="text-danger ms-1">*</span></label>
                            <input type="text" name="tempat_lahir"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Tempat Lahir anak"
                                value="{{ old('tempat_lahir', $anak->tempat_lahir) }}" />
                            @if (old('form_source') == 'edit_anak' && old('anak_id') == $anak->id)
                                @error('tempat_lahir')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
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
                                        optional($anak->tanggal_lahir)->format('Y-m-d'),
                                    );
                                @endphp

                                <input class="form-control form-control-solid ps-12" placeholder="Tanggal Lahir Anak"
                                    type="date" name="tanggal_lahir" value="{{ $tanggalLahirValue }}" />

                            </div>
                            @if (old('form_source') == 'edit_anak' && old('anak_id') == $anak->id)
                                @error('tanggal_lahir')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Jenis Kelamin<span
                                    class="text-danger ms-1">*</span></label>
                            <select class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true" data-placeholder="Pilih Jenis Kelamin..."
                                name="jenis_kelamin">
                                <option value="">Pilih Jenis Kelamin...</option>
                                <option value="L"
                                    {{ old('jenis_kelamin', $anak->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>
                                <option value="P"
                                    {{ old('jenis_kelamin', $anak->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                            @if (old('form_source') == 'edit_anak' && old('anak_id') == $anak->id)
                                @error('jenis_kelamin')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- Tanggal Masuk --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">
                                Tanggal Masuk
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
                                        optional($anak->tanggal_masuk)->format('Y-m-d'),
                                    );
                                @endphp

                                <input class="form-control form-control-solid ps-12" placeholder="Tanggal Masuk Anak"
                                    type="date" name="tanggal_masuk" value="{{ $tanggalLahirValue }}" />

                            </div>
                            @if (old('form_source') == 'edit_anak' && old('anak_id') == $anak->id)
                                @error('tanggal_masuk')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        {{-- ORANG TUA --}}
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Orang Tua<span
                                    class="text-danger ms-1">*</span></label>
                            <select class="form-select form-select-solid" data-control="select2"
                                data-placeholder="Pilih Orang Tua..." name="orang_tuas_id">
                                <option value=""></option>
                                @foreach ($dataOrangTua as $orangTua)
                                    <option value="{{ $orangTua->id }}"
                                        {{ old('orang_tuas_id', $anak->orang_tuas_id) == $orangTua->id ? 'selected' : '' }}>
                                        {{ $orangTua->nama_ayah }} & {{ $orangTua->nama_ibu }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- SEKOLAH --}}
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Sekolah<span
                                    class="text-danger ms-1">*</span></label>

                            @role('guru')
                                @php
                                    // karena di controller guru, $dataSekolah biasanya cuma 1 (sekolahnya dia)
                                    $sekolahGuru = $dataSekolah->first();
                                @endphp

                                {{-- tampil tapi terkunci --}}
                                <select class="form-select form-select-solid" disabled>
                                    <option value="{{ $sekolahGuru?->id }}">
                                        {{ $sekolahGuru?->nama_sekolah ?? 'Sekolah belum di-set' }}
                                    </option>
                                </select>

                                {{-- tetap kirim value --}}
                                <input type="hidden" name="sekolahs_id"
                                    value="{{ old('sekolahs_id', $anak->sekolahs_id) }}">
                            @else
                                <select class="form-select form-select-solid" data-control="select2"
                                    data-placeholder="Pilih Sekolah..." name="sekolahs_id">
                                    <option value=""></option>
                                    @foreach ($dataSekolah as $sekolah)
                                        <option value="{{ $sekolah->id }}"
                                            {{ old('sekolahs_id', $anak->sekolahs_id) == $sekolah->id ? 'selected' : '' }}>
                                            {{ $sekolah->nama_sekolah }}
                                        </option>
                                    @endforeach
                                </select>
                            @endrole

                            {{-- kalau kamu mau tampilkan error edit sekolah --}}
                            @error('sekolahs_id')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>



                    </div>

                    <!--begin::Actions-->
                    <div class="text-center pt-10">
                        <button type="button" class="btn btn-light me-3" data-kt-users-modal-action="cancel"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">Simpan</span>
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
<!--end::Modal - Edit Anak-->

{{-- Auto-buka modal edit kalau validasi error untuk anak ini --}}
@if ($errors->any() && old('form_source') === 'edit_anak' && old('anak_id') == $anak->id)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('modal_edit_anak_{{ $anak->id }}'));
            myModal.show();
        });
    </script>
@endif


<script>
    document.addEventListener('DOMContentLoaded', function() {

        // paksa focus ke input search saat select2 kebuka
        $(document).on('select2:open', function() {
            setTimeout(function() {
                const el = document.querySelector(
                    '.select2-container--open .select2-search__field');
                if (el) el.focus();
            }, 0);
        });

        // init ulang select2 setiap modal dibuka (add & edit)
        document.querySelectorAll('.modal').forEach(function(modalEl) {
            modalEl.addEventListener('shown.bs.modal', function() {

                $(modalEl).find('select[data-control="select2"]').each(function() {
                    // kalau sudah ter-init (Metronic suka init duluan), destroy biar gak bug focus
                    if ($(this).hasClass('select2-hidden-accessible')) {
                        $(this).select2('destroy');
                    }

                    $(this).select2({
                        dropdownParent: $(modalEl),
                        width: '100%',
                        placeholder: $(this).data('placeholder') || 'Pilih...',
                        minimumResultsForSearch: 0 // paksa search selalu ada
                    });
                });

            });
        });

    });
</script>
