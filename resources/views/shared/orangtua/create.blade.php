<!--begin::Modal - Add task-->
<div class="modal fade" id="modal_add_orangtua" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="modal_add_orangtua_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Tambah Orang Tua</h2>
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
                <form id="modal_add_orangtua_form" class="form form-loading"
                    action="{{ route('admin.orang_tua.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="form_source" value="add_orangtua">
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="modal_add_orangtua_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modal_add_orangtua_header"
                        data-kt-scroll-wrappers="#modal_add_orangtua_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->


                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Nama Ayah<span
                                    class="text-danger ms-1">*</span></label>
                            <input type="text" name="nama_ayah" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Nama Ayah" value="{{ old('nama_ayah') }}" />
                            @if (old('form_source') == 'add_orangtua')
                                @error('nama_ayah')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Nama Ibu<span class="text-danger ms-1">*</span></label>
                            <input type="text" name="nama_ibu" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Nama Ibu" value="{{ old('nama_ibu') }}" />
                            @if (old('form_source') == 'add_orangtua')
                                @error('nama_ibu')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">No. HP Ayah<span
                                    class="text-danger ms-1">*</span></label>
                            <input type="text" name="no_hp_ayah" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="No. HP Ayah" value="{{ old('no_hp_ayah') }}" />
                            @if (old('form_source') == 'add_orangtua')
                                @error('no_hp_ayah')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif

                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">No. HP Ibu<span
                                    class="text-danger ms-1">*</span></label>
                            <input type="text" name="no_hp_ibu" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="No. HP Ibu" value="{{ old('no_hp_ibu') }}" />
                            @if (old('form_source') == 'add_orangtua')
                                @error('no_hp_ibu')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Alamat</label>
                            <textarea class="form-control form-control-solid" rows="3" name="alamat" placeholder="Type Alamat">{{ old('alamat') }}</textarea>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Username orang tua" value="{{ old('username') }}" />

                            @if (old('form_source') == 'add_orangtua')
                                @error('username')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Password orang tua" />

                            @if (old('form_source') == 'add_orangtua')
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
@if ($errors->any() && old('form_source') === 'add_orangtua')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('modal_add_orangtua'));
            myModal.show();
        });
    </script>
@endif
