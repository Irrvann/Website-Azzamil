<div class="modal fade" id="modal_edit_ddst_ortu_{{ $ddstTest->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Edit Profil & Karakter (Orang Tua)</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>

            <form action="{{ route('orang_tua.ddst_tests.update_profile', $ddstTest->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Profile dan Karakter yang Dikenali Ortu</label>
                        <textarea name="profile_dan_karakter_yang_dikenali_ortu"
                            class="form-control form-control-solid"
                            rows="6"
                            placeholder="Tulis profil/karakter anak yang orang tua kenali...">{{ old('profile_dan_karakter_yang_dikenali_ortu', $ddstTest->profile_dan_karakter_yang_dikenali_ortu ?? '') }}</textarea>

                        @error('profile_dan_karakter_yang_dikenali_ortu')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
