<!--begin::Modal - Add task-->
<div class="modal fade" id="modal_add_daerah" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="modal_add_daerah_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Tambah Daerah</h2>
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
                <form id="modal_add_daerah_form" class="form form-loading" action="{{ route('superadmin.daerah.store') }}"
                    method="POST">
                    @csrf
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="modal_add_daerah_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modal_add_daerah_header"
                        data-kt-scroll-wrappers="#modal_add_daerah_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Nama Daerah</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="nama_daerah"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nama Daerah" value="{{ old('nama_daerah') }}" />
                            <!--end::Input-->
                            @if (old('form_source') == 'add_daerah')
                                @error('nama_daerah')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif

                        </div>
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
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
@if ($errors->any() && old('form_source') === 'add_daerah')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('modal_add_daerah'));
            myModal.show();
        });

        
    </script>
@endif
