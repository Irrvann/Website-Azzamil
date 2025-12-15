<!--begin::Modal - Add task-->
<div class="modal fade" id="modal_edit_sekolah_{{ $sekolah->id }}" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="modal_edit_sekolah_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Edit Sekolah</h2>
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
                <form id="modal_edit_sekolah_form" class="form form-loading"
                    action="{{ route($routeNameUpdate, $sekolah->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="form_source" value="edit_sekolah">
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="modal_edit_sekolah_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modal_edit_sekolah_header"
                        data-kt-scroll-wrappers="#modal_edit_sekolah_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->


                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Nama Sekolah<span
                                    class="text-danger ms-1">*</span></label>
                            <input type="text" name="nama_sekolah"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nama Sekolah" value="{{ old('nama_sekolah', $sekolah->nama_sekolah) }}" />
                            @if (old('form_source') == 'edit_sekolah')
                                @error('nama_sekolah')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Jenis Sekolah<span
                                    class="text-danger ms-1">*</span></label>
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                                data-placeholder="Pilih Jenis Sekolah..." name="jenis_sekolah">
                                <option value="">Pilih Jenis Sekolah...</option>
                                <option value="tpa" {{ old('jenis_sekolah', $sekolah->jenis_sekolah) == 'tpa' ? 'selected' : '' }}>TPA</option>
                                <option value="kb" {{ old('jenis_sekolah', $sekolah->jenis_sekolah) == 'kb' ? 'selected' : '' }}>KB</option>
                                <option value="tpa_kb_tk" {{ old('jenis_sekolah', $sekolah->jenis_sekolah) == 'tpa_kb_tk' ? 'selected' : '' }}>TPA KB TK</option>
                            </select>
                            @if (old('form_source') == 'edit_sekolah')
                                @error('jenis_sekolah')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Kelas<span
                                    class="text-danger ms-1">*</span></label>
                            <input type="text" name="kelas"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Kelas" value="{{ old('kelas', $sekolah->kelas) }}" />
                            @if (old('form_source') == 'edit_sekolah')
                                @error('kelas')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Daerah<span class="text-danger ms-1">*</span></label>
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                                data-placeholder="Pilih Daerah..." name="daerahs_id">
                                <option value="">Pilih Daerah...</option>
                                @foreach ($dataDaerah as $daerah)
                                    <option value="{{ $daerah->id }}"
                                        {{ old('daerahs_id', $sekolah->daerahs_id) == $daerah->id ? 'selected' : '' }}>
                                        {{ $daerah->nama_daerah }}
                                    </option>
                                @endforeach
                            </select>
                            @if (old('form_source') == 'edit_sekolah')
                                @error('daerahs_id')
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
@if ($errors->any() && old('form_source') === 'edit_sekolah')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('modal_edit_sekolah'));
            myModal.show();
        });
    </script>
@endif
