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
                @if (!empty($routeNameStore))

                    <form id="modal_add_antropometri_form" class="form form-loading"
                        action="{{ route($routeNameStore) }}" method="POST">
                        @csrf

                        <input type="hidden" name="form_source" value="add_antropometri">

                        <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="modal_add_antropometri_scroll"
                            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#modal_add_antropometri_header"
                            data-kt-scroll-wrappers="#modal_add_antropometri_scroll" data-kt-scroll-offset="300px">

                            <!-- SEKOLAH -->
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">
                                    Sekolah <span class="text-danger ms-1">*</span>
                                </label>

                                @role('guru')
                                    @php
                                        $sekolahGuru = $dataSekolah->first(); // harusnya 1 sekolah
                                    @endphp

                                    {{-- tampil terkunci --}}
                                    <select id="sekolah_select_antropometri" class="form-select form-select-solid" disabled>
                                        <option value="{{ $sekolahGuru?->id }}">
                                            {{ $sekolahGuru?->nama_sekolah ?? 'Sekolah belum di-set' }}
                                        </option>
                                    </select>

                                    {{-- yang benar-benar dikirim ke backend --}}
                                    <input type="hidden" name="sekolahs_id"
                                        value="{{ old('sekolahs_id', $sekolahGuru?->id) }}">
                                @else
                                    <select id="sekolah_select_antropometri" class="form-select form-select-solid"
                                        data-control="select2" data-placeholder="Pilih Sekolah..." name="sekolahs_id">
                                        <option value=""></option>
                                        @foreach ($dataSekolah as $s)
                                            <option value="{{ $s->id }}"
                                                {{ old('sekolahs_id') == $s->id ? 'selected' : '' }}>
                                                {{ $s->nama_sekolah }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endrole

                                @if (old('form_source') == 'add_antropometri')
                                    @error('sekolahs_id')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>


                            <!-- ANAK -->
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">
                                    Nama Anak <span class="text-danger ms-1">*</span>
                                </label>

                                <select id="anak_select_antropometri" class="form-select form-select-solid"
                                    data-control="select2" data-placeholder="Pilih Anak..." name="anaks_id">
                                    <option value=""></option>
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
                                    <option value="resiko" {{ old('status_bb') == 'resiko' ? 'selected' : '' }}>
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
                                    <option value="pendek" {{ old('status_tb') == 'pendek' ? 'selected' : '' }}>
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
                @endif
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


<script>
    document.addEventListener('DOMContentLoaded', function() {

        $(document).on('select2:open', function() {
            setTimeout(function() {
                const el = document.querySelector(
                    '.select2-container--open .select2-search__field');
                if (el) el.focus();
            }, 0);
        });

        document.querySelectorAll('.modal').forEach(function(modalEl) {
            modalEl.addEventListener('shown.bs.modal', function() {

                $(modalEl).find('select[data-control="select2"]').each(function() {
                    if ($(this).hasClass('select2-hidden-accessible')) {
                        $(this).select2('destroy');
                    }

                    $(this).select2({
                        dropdownParent: $(modalEl),
                        width: '100%',
                        placeholder: $(this).data('placeholder') || 'Pilih...',
                        minimumResultsForSearch: 0
                    });
                });

            });
        });

    });
</script>

@if(!empty($routeAjaxAnakBySekolah))
<script>
    (function() {
        const modalId = 'modal_add_antropometri';
        const modalEl = document.getElementById(modalId);
        if (!modalEl) return;

        function initSelect2($modal) {
            $modal.find('select[data-control="select2"]').each(function() {
                if ($(this).hasClass('select2-hidden-accessible')) {
                    $(this).select2('destroy');
                }

                $(this).select2({
                    dropdownParent: $modal,
                    width: '100%',
                    placeholder: $(this).data('placeholder') || 'Pilih...',
                    minimumResultsForSearch: 0,
                    minimumInputLength: 0 // ✅ INI PENTING BIAR LIST LANGSUNG KELUAR
                });
            });
        }

        function resetOptions($el) {
            $el.find('option').not(':first').remove();
            $el.val(null).trigger('change');
        }

        async function loadAnak($anak, sekolahId) {
            resetOptions($anak);
            if (!sekolahId) return;

            const url = "{{ route($routeAjaxAnakBySekolah, ['sekolah' => '__ID__']) }}"
                .replace('__ID__', sekolahId);

            const res = await fetch(url, {
                headers: {
                    Accept: 'application/json'
                }
            });

            const data = await res.json();

            (data.anak || []).forEach(a => {
                $anak.append(new Option(a.text, a.id, false, false));
            });

            // 🔥 FORCE REFRESH SELECT2 BIAR OPTION LANGSUNG KEDETEKSI
            $anak.select2('destroy');
            $anak.select2({
                dropdownParent: $anak.closest('.modal'),
                width: '100%',
                placeholder: $anak.data('placeholder') || 'Pilih Anak...',
                minimumResultsForSearch: 0,
                minimumInputLength: 0
            });

            $anak.trigger('change');
        }

        modalEl.addEventListener('shown.bs.modal', async function() {
            const $modal = $('#' + modalId);
            const $sekolah = $modal.find('#sekolah_select_antropometri');
            const $anak = $modal.find('#anak_select_antropometri');

            initSelect2($modal);
            resetOptions($anak);

            // ambil sekolahId:
            // - admin/superadmin: dari select sekolah
            // - guru: dari hidden input name="sekolahs_id"
            const hiddenSekolah = $modal.find('input[name="sekolahs_id"]').val();
            const sekolahId = hiddenSekolah || $sekolah.val();

            // bind change untuk admin/superadmin
            $sekolah.off('change.dependent').on('change.dependent', function() {
                loadAnak($anak, this.value);
            });

            // ✅ AUTO LOAD: guru (langsung), atau balik dari validasi
            const oldSekolah = @json(old('sekolahs_id'));
            const oldAnak = @json(old('anaks_id'));

            const finalSekolah = oldSekolah || sekolahId;

            if (finalSekolah) {
                // untuk admin/superadmin set value select sekolahnya
                if ($sekolah.length && !$sekolah.prop('disabled')) {
                    $sekolah.val(String(finalSekolah)).trigger('change');
                }

                await loadAnak($anak, String(finalSekolah));

                if (oldAnak) {
                    $anak.val(String(oldAnak)).trigger('change');
                }
            }
        });

    })();
</script>
@endif
