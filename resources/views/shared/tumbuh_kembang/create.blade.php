<!--begin::Modal - Add Antropometri-->
<div class="modal fade" id="modal_add_antropometri" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="modal_add_antropometri_header">
                <h2 class="fw-bold">Tambah Data Antropometri</h2>

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
                <form id="modal_add_antropometri_form" class="form form-loading" action="{{ route($routeNameStore) }}"
                    method="POST">
                    @csrf

                    <input type="hidden" name="form_source" value="add_antropometri">

                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="modal_add_antropometri_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modal_add_antropometri_header"
                        data-kt-scroll-wrappers="#modal_add_antropometri_scroll" data-kt-scroll-offset="300px">

                        <!-- ANAK -->
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Nama Anak
                                <span class="text-danger ms-1">*</span>
                            </label>
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                                data-placeholder="Pilih Anak..." name="anaks_id">
                                <option value="">Pilih Anak...</option>
                                @foreach ($dataAnak as $anak)
                                    <option value="{{ $anak->id }}"
                                        {{ old('anaks_id') == $anak->id ? 'selected' : '' }}>
                                        {{ $anak->nama_anak }}
                                    </option>
                                @endforeach
                            </select>
                            @if (old('form_source') == 'add_antropometri')
                                @error('anaks_id')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <!-- TANGGAL UKUR -->
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Tanggal Ukur
                                <span class="text-danger ms-1">*</span>
                            </label>
                            <input type="date" name="tanggal_ukur" class="form-control form-control-solid"
                                value="{{ old('tanggal_ukur') }}">

                            @if (old('form_source') == 'add_antropometri')
                                @error('tanggal_ukur')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <!-- BERAT -->
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Berat Badan (kg)</label>
                            <input type="number" step="0.01" name="berat_badan"
                                class="form-control form-control-solid" placeholder="Contoh: 15.2"
                                value="{{ old('berat_badan') }}">

                            @if (old('form_source') == 'add_antropometri')
                                @error('berat_badan')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <!-- STATUS BB -->
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Status Berat Badan</label>
                            <select name="status_bb" class="form-select form-select-solid">
                                <option value="">Pilih Status Berat Badan...</option>
                                <option value="normal" {{ old('status_bb') == 'normal' ? 'selected' : '' }}>
                                    Normal
                                </option>
                                <option value="resiko"
                                    {{ old('status_bb') == 'resiko' ? 'selected' : '' }}>
                                    Resiko
                                </option>
                            </select>

                            @if (old('form_source') == 'add_antropometri')
                                @error('status_bb')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <!-- TINGGI -->
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Tinggi Badan (cm)</label>
                            <input type="number" step="0.01" name="tinggi_badan"
                                class="form-control form-control-solid" placeholder="Contoh: 95.6"
                                value="{{ old('tinggi_badan') }}">

                            @if (old('form_source') == 'add_antropometri')
                                @error('tinggi_badan')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <!-- STATUS TB -->
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Status Tinggi Badan</label>
                            <select name="status_tb" class="form-select form-select-solid">
                                <option value="">Pilih Status Tinggi Badan...</option>
                                <option value="normal" {{ old('status_tb') == 'normal' ? 'selected' : '' }}>
                                    Normal
                                </option>
                                <option value="pendek"
                                    {{ old('status_tb') == 'pendek' ? 'selected' : '' }}>
                                    Pendek
                                </option>
                            </select>

                            @if (old('form_source') == 'add_antropometri')
                                @error('status_tb')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <!-- LINGKAR KEPALA -->
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Lingkar Kepala (cm)</label>
                            <input type="number" step="0.01" name="lingkar_kepala"
                                class="form-control form-control-solid" placeholder="Contoh: 46.3"
                                value="{{ old('lingkar_kepala') }}">

                            @if (old('form_source') == 'add_antropometri')
                                @error('lingkar_kepala')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <!-- LINGKAR LENGAN -->
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Lingkar Lengan (cm)</label>
                            <input type="number" step="0.01" name="lingkar_lengan"
                                class="form-control form-control-solid" placeholder="Contoh: 13.5"
                                value="{{ old('lingkar_lengan') }}">

                            @if (old('form_source') == 'add_antropometri')
                                @error('lingkar_lengan')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <!-- STATUS GIZI -->
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Status Gizi</label>
                            <select name="status_gizi" class="form-select form-select-solid">
                                <option value="">Pilih Status Gizi...</option>
                                <option value="normal" {{ old('status_gizi') == 'normal' ? 'selected' : '' }}>
                                    Normal
                                </option>
                                <option value="gizi_kurang"
                                    {{ old('status_gizi') == 'gizi_kurang' ? 'selected' : '' }}>
                                    Gizi Kurang
                                </option>
                                <option value="gizi_berlebih"
                                    {{ old('status_gizi') == 'gizi_berlebih' ? 'selected' : '' }}>
                                    Gizi Berlebih
                                </option>
                            </select>

                            @if (old('form_source') == 'add_antropometri')
                                @error('status_gizi')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                    </div>

                    <!--begin::Actions-->
                    <div class="text-center pt-10">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Simpan</span>
                            <span class="indicator-progress">Mohon tunggu...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Add Antropometri-->

@if ($errors->any() && old('form_source') === 'add_antropometri')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('modal_add_antropometri'));
            myModal.show();
        });
    </script>
@endif
