<div class="modal fade" id="modal_edit_refleksi_ortu_{{ $raport->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">

            <div class="modal-header">
                <h2 class="fw-bold">Edit Refleksi Orang Tua</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>

            <div class="modal-body px-5 my-7">
                <form method="POST" action="{{ route('orang_tua.raport.update-refleksi-ortu', $raport->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="edit_refleksi_id" value="{{ $raport->id }}">

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Refleksi Orang Tua</label>

                        <textarea class="form-control form-control-solid js-limit-text" rows="5" name="refleksi_orang_tua" maxlength="880"
                            data-max="880" placeholder="Tulis refleksi orang tua...">{{ old('refleksi_orang_tua', $raport->refleksi_orang_tua) }}</textarea>

                        <div class="d-flex justify-content-end mt-1">
                            <small class="text-muted js-counter">0/880</small>
                        </div>

                        @error('refleksi_orang_tua')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-center pt-5">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@if ($errors->any() && old('edit_refleksi_id'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const id = @json(old('edit_refleksi_id'));
            const el = document.getElementById('modal_edit_refleksi_ortu_' + id);
            if (el) new bootstrap.Modal(el).show();
        });
    </script>
@endif
