<!--begin::Modal - Delete Daerah-->
<div class="modal fade" id="modal_delete_sekolah_{{ $sekolah->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-500px">
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <h2 class="fw-bold">Hapus Sekolah</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body px-5 my-7">
                <div class="text-center mb-5">
                    <i class="ki-duotone ki-information-5 fs-3x text-danger mb-3">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>

                    <h3 class="fw-bold mb-2">Yakin ingin menghapus?</h3>
                    <div class="text-muted fw-semibold fs-6">
                        Data sekolah <span class="fw-bold">{{ $sekolah->nama_sekolah }}</span> akan dihapus permanen.
                    </div>
                </div>

                <div class="text-center pt-5">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <form action="{{ route('admin.sekolah.destroy', $sekolah->id) }}" method="POST"
                        class="d-inline form-loading">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            Ya, hapus
                        </button>
                    </form>
                </div>
            </div>
            <!--end::Modal body-->
        </div>
    </div>
</div>
<!--end::Modal - Delete Sekolah-->