@hasanyrole('admin|super_admin')
    <!--begin::Modal - Delete Antropometri-->
    <div class="modal fade" id="modal_delete_antropometri_{{ $antropometri->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-500px">
            <div class="modal-content">

                <div class="modal-header">
                    <h2 class="fw-bold">Hapus Antropometri</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"></i>
                    </div>
                </div>

                <div class="modal-body px-5 my-7 text-center">
                    <i class="ki-duotone ki-information-5 fs-3x text-danger mb-3"></i>

                    <h3 class="fw-bold mb-2">Yakin ingin menghapus?</h3>

                    <div class="text-muted fw-semibold fs-6">
                        Data antropometri anak
                        <span class="fw-bold">
                            {{ $antropometri->anak->nama_anak ?? '-' }}
                        </span>
                        tanggal
                        <span class="fw-bold">
                            {{ \Carbon\Carbon::parse($antropometri->tanggal_ukur)->format('d-m-Y') }}
                        </span>
                        <br>
                        <span class="text-danger fw-bold">
                            Semua data DDST & foto terkait juga akan terhapus permanen.
                        </span>
                    </div>

                    <div class="pt-5">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">
                            Batal
                        </button>

                        <form action="{{ route($routeAntropometriDestroy, $antropometri->id) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Ya, hapus
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--end::Modal - Delete Antropometri-->
@endhasanyrole
