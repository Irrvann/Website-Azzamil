<!--begin::Modal - Add task-->
<div class="modal fade" id="modal_add_raport" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="modal_add_raport_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Tambah Raport</h2>
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
                <form enctype="multipart/form-data" id="modal_add_raport_form" class="form form-loading"
                    action="{{ route($routeNameStore) }}" method="POST">
                    @csrf
                    <input type="hidden" name="form_source" value="add_raport">
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="modal_add_raport_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modal_add_raport_header"
                        data-kt-scroll-wrappers="#modal_add_raport_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">
                                Sekolah <span class="text-danger ms-1">*</span>
                            </label>

                            @role('guru')
                                @php
                                    $sekolahGuru = $dataSekolah->first(); // harusnya cuma 1
                                @endphp

                                {{-- tampil terkunci --}}
                                <select id="sekolah_select" class="form-select form-select-solid" disabled>
                                    <option value="{{ $sekolahGuru?->id }}">
                                        {{ $sekolahGuru?->nama_sekolah ?? 'Sekolah belum di-set' }}
                                    </option>
                                </select>

                                {{-- nilai yang benar-benar dikirim --}}
                                <input type="hidden" name="sekolahs_id"
                                    value="{{ old('sekolahs_id', $sekolahGuru?->id) }}">
                            @else
                                <select id="sekolah_select" class="form-select form-select-solid" data-control="select2"
                                    data-placeholder="Pilih Sekolah..." name="sekolahs_id">
                                    <option value=""></option>
                                    @foreach ($dataSekolah as $sekolah)
                                        <option value="{{ $sekolah->id }}"
                                            {{ old('sekolahs_id') == $sekolah->id ? 'selected' : '' }}>
                                            {{ $sekolah->nama_sekolah }}
                                        </option>
                                    @endforeach
                                </select>
                            @endrole

                            @if (old('form_source') == 'add_raport')
                                @error('sekolahs_id')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>



                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">
                                Nama Anak <span class="text-danger ms-1">*</span>
                            </label>

                            <select id="anak_select" class="form-select form-select-solid" data-control="select2"
                                data-placeholder="Pilih Anak..." name="anaks_id">
                                <option value=""></option>
                            </select>

                            @if (old('form_source') == 'add_raport')
                                @error('anaks_id')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>


                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">
                                Nama Guru <span class="text-danger ms-1">*</span>
                            </label>

                            <select id="guru_select" class="form-select form-select-solid" data-control="select2"
                                data-placeholder="Pilih Guru..." name="gurus_id">
                                <option value=""></option>
                            </select>

                            @if (old('form_source') == 'add_raport')
                                @error('gurus_id')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>


                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Semester<span class="text-danger ms-1">*</span></label>
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                                data-placeholder="Pilih Semester..." name="semester">
                                <option value="">Pilih Jenis Sekolah...</option>
                                <option value="1" {{ old('semester') == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ old('semester') == '2' ? 'selected' : '' }}>2</option>
                            </select>
                            @if (old('form_source') == 'add_raport')
                                @error('semester')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Tahun Ajaran<span
                                    class="text-danger ms-1">*</span></label>
                            <input type="text" name="tahun_ajaran"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Tahun Ajaran"
                                value="{{ old('tahun_ajaran') }}" />
                            @if (old('form_source') == 'add_raport')
                                @error('tahun_ajaran')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Nilai Agama</label>
                            <textarea class="form-control form-control-solid" rows="3" name="nilai_agama" placeholder="Type Nilai Agama">{{ old('nilai_agama') }}</textarea>
                        </div>

                        {{-- FOTO NILAI AGAMA --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Foto Kegiatan Nilai Agama</label>

                            <div id="wrapper_foto_agama">
                                {{-- input untuk pilih file (tidak punya name) --}}
                                <input type="file" id="input_foto_agama"
                                    class="form-control form-control-solid mb-3" multiple
                                    onchange="handleMultiImage(this, 'foto_agama')">

                                {{-- input hidden yang akan benar-benar dikirim ke server --}}
                                <input type="file" id="store_foto_agama" name="foto_agama[]" multiple
                                    style="display:none;">
                            </div>

                            <small class="text-muted d-block">
                                Bisa upload lebih dari satu foto dan bisa upload lagi beberapa kali.
                            </small>

                            <div id="preview_foto_agama" class="mt-3 d-flex flex-wrap gap-3"></div>
                        </div>


                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Nilai Jati Diri</label>
                            <textarea class="form-control form-control-solid" rows="3" name="nilai_jati_diri"
                                placeholder="Type Nilai Jati Diri">{{ old('nilai_jati_diri') }}</textarea>
                        </div>

                        {{-- FOTO JATI DIRI --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Foto Kegiatan Jati Diri</label>

                            <div id="wrapper_foto_jati_diri">
                                <input type="file" id="input_foto_jati_diri"
                                    class="form-control form-control-solid mb-3" multiple
                                    onchange="handleMultiImage(this, 'foto_jati_diri')">

                                <input type="file" id="store_foto_jati_diri" name="foto_jati_diri[]" multiple
                                    style="display:none;">
                            </div>

                            <small class="text-muted d-block">
                                Bisa upload lebih dari satu foto dan bisa upload lagi beberapa kali.
                            </small>

                            <div id="preview_foto_jati_diri" class="mt-3 d-flex flex-wrap gap-3"></div>
                        </div>



                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Nilai Literasi Sains</label>
                            <textarea class="form-control form-control-solid" rows="3" name="nilai_literasi_sains"
                                placeholder="Type Nilai Literasi Sains">{{ old('nilai_literasi_sains') }}</textarea>
                        </div>


                        {{-- FOTO LITERASI & SAINS --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Foto Kegiatan Literasi &amp; Sains</label>

                            <div id="wrapper_foto_literasi_sains">
                                <input type="file" id="input_foto_literasi_sains"
                                    class="form-control form-control-solid mb-3" multiple
                                    onchange="handleMultiImage(this, 'foto_literasi_sains')">

                                <input type="file" id="store_foto_literasi_sains" name="foto_literasi_sains[]"
                                    multiple style="display:none;">
                            </div>

                            <small class="text-muted d-block">
                                Bisa upload lebih dari satu foto dan bisa upload lagi beberapa kali.
                            </small>

                            <div id="preview_foto_literasi_sains" class="mt-3 d-flex flex-wrap gap-3"></div>
                        </div>


                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Nilai P5</label>
                            <textarea class="form-control form-control-solid" rows="3" name="nilai_p5" placeholder="Type Nilai P5">{{ old('nilai_p5') }}</textarea>
                        </div>

                        {{-- FOTO P5 --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Foto Kegiatan P5 (Profil Pelajar Pancasila)</label>

                            <div id="wrapper_foto_p5">
                                <input type="file" id="input_foto_p5" class="form-control form-control-solid mb-3"
                                    multiple onchange="handleMultiImage(this, 'foto_p5')">

                                <input type="file" id="store_foto_p5" name="foto_p5[]" multiple
                                    style="display:none;">
                            </div>

                            <small class="text-muted d-block">
                                Bisa upload lebih dari satu foto dan bisa upload lagi beberapa kali.
                            </small>

                            <div id="preview_foto_p5" class="mt-3 d-flex flex-wrap gap-3"></div>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Refleksi Guru</label>
                            <textarea class="form-control form-control-solid" rows="3" name="refleksi_guru"
                                placeholder="Type Refleksi Guru">{{ old('refleksi_guru') }}</textarea>
                        </div>

                        {{-- Kehadiran --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Kehadiran</label>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Sakit</label>
                                    <input type="number" min="0" name="sakit"
                                        class="form-control form-control-solid" placeholder="Sakit"
                                        value="{{ old('sakit', 0) }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Izin</label>
                                    <input type="number" min="0" name="izin"
                                        class="form-control form-control-solid" placeholder="Izin"
                                        value="{{ old('izin', 0) }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Tanpa Keterangan</label>
                                    <input type="number" min="0" name="tanpa_keterangan"
                                        class="form-control form-control-solid" placeholder="Tanpa Keterangan"
                                        value="{{ old('tanpa_keterangan', 0) }}">
                                </div>
                            </div>
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
@if ($errors->any() && old('form_source') === 'add_raport')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('modal_add_raport'));
            myModal.show();
        });
    </script>
@endif

<script>
    // state untuk semua group foto
    const multiImageState = {};
    let multiImageCounter = 0;

    function ensureState(key) {
        if (!multiImageState[key]) {
            multiImageState[key] = {
                files: [] // array of {id, file}
            };
        }
        return multiImageState[key];
    }

    function handleMultiImage(input, key) {
        const state = ensureState(key);
        const preview = document.getElementById('preview_' + key);
        if (!preview || !input.files.length) return;

        Array.from(input.files).forEach(file => {
            if (!file.type.startsWith('image/')) return;

            const id = key + '_' + (multiImageCounter++);
            state.files.push({
                id,
                file
            });

            const reader = new FileReader();
            reader.onload = function(e) {
                const wrapper = document.createElement('div');
                wrapper.className = 'position-relative me-2 mb-2';
                wrapper.dataset.fileId = id;

                wrapper.innerHTML = `
                    <img src="${e.target.result}"
                         alt="preview"
                         class="img-thumbnail rounded"
                         style="width: 80px; height: 80px; object-fit: cover;">

                    <button type="button"
                            class="btn btn-icon btn-xs btn-danger position-absolute top-0 end-0 translate-middle"
                            onclick="removeImage('${key}', '${id}')">
                        <i class="ki-duotone ki-cross fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </button>
                `;

                preview.appendChild(wrapper);
            };

            reader.readAsDataURL(file);
        });

        // sync ke input hidden
        syncHiddenInput(key);

        // reset input visible supaya bisa pilih file yang sama lagi kalau mau
        input.value = '';
    }

    function syncHiddenInput(key) {
        const hidden = document.getElementById('store_' + key);
        const state = ensureState(key);

        if (!hidden) return;

        const dt = new DataTransfer();
        state.files.forEach(item => dt.items.add(item.file));
        hidden.files = dt.files;
    }

    function removeImage(key, id) {
        const state = ensureState(key);

        // hapus dari state
        state.files = state.files.filter(item => item.id !== id);

        // hapus dari preview DOM
        const preview = document.getElementById('preview_' + key);
        if (preview) {
            const el = preview.querySelector('[data-file-id="' + id + '"]');
            if (el) el.remove();
        }

        // update input hidden
        syncHiddenInput(key);
    }
</script>

<script>
    (function() {
        const modalId = 'modal_add_raport';
        const modalEl = document.getElementById(modalId);

        if (!modalEl) return;

        let lastSekolahId = null;
        let loading = false;

        function initSelect2($modal) {
            $modal.find('select[data-control="select2"]').each(function() {
                if ($(this).hasClass('select2-hidden-accessible')) {
                    $(this).select2('destroy');
                }
                $(this).select2({
                    dropdownParent: $modal,
                    width: '100%',
                    placeholder: $(this).data('placeholder') || 'Pilih...',
                    minimumResultsForSearch: 0
                });
            });
        }

        function resetOptions($el) {
            // buang semua option kecuali placeholder kosong
            $el.find('option').not(':first').remove();
            $el.val(null).trigger('change.select2');
        }

        async function loadAnakGuru($anak, $guru, sekolahId) {
            if (!sekolahId) return;

            // ✅ HAPUS OPTION LAMA TOTAL (kecuali placeholder)
            $anak.find('option').not(':first').remove();
            $guru.find('option').not(':first').remove();

            const url = "{{ route($routeAnakGuru, ['sekolah' => '__ID__']) }}"
                .replace('__ID__', sekolahId);

            const res = await fetch(url, {
                headers: {
                    Accept: 'application/json'
                }
            });
            const data = await res.json();

            // ✅ BUAT SET existing value biar gak pernah dobel
            const anakValues = new Set();
            $anak.find('option').each(function() {
                anakValues.add(String(this.value));
            });

            const guruValues = new Set();
            $guru.find('option').each(function() {
                guruValues.add(String(this.value));
            });

            data.anak.forEach(a => {
                const id = String(a.id);
                if (anakValues.has(id)) return;
                $anak.append(new Option(a.text, id, false, false));
                anakValues.add(id);
            });

            data.guru.forEach(g => {
                const id = String(g.id);
                if (guruValues.has(id)) return;
                $guru.append(new Option(g.text, id, false, false));
                guruValues.add(id);
            });

            $anak.trigger('change.select2');
            $guru.trigger('change.select2');
        }


        // ✅ SATU PINTU SAJA
        modalEl.addEventListener('shown.bs.modal', async function() {
            const $modal = $('#' + modalId);
            const $sekolah = $modal.find('#sekolah_select');
            const $anak = $modal.find('#anak_select');
            const $guru = $modal.find('#guru_select');

            initSelect2($modal);

            resetOptions($anak);
            resetOptions($guru);

            // ambil sekolahId:
            // - guru → dari hidden input
            // - admin → dari select
            const hiddenSekolah = $modal.find('input[name="sekolahs_id"]').val();
            const sekolahId = hiddenSekolah || $sekolah.val();

            // bind change hanya untuk admin/superadmin
            $sekolah.off('change.dependent').on('change.dependent', function() {
                loadAnakGuru($anak, $guru, this.value);
            });

            // auto load (guru atau balik validasi)
            const oldSekolah = @json(old('sekolahs_id'));
            const oldAnak = @json(old('anaks_id'));
            const oldGuru = @json(old('gurus_id'));

            const finalSekolah = oldSekolah || sekolahId;

            if (finalSekolah) {
                // admin: set select sekolah
                if ($sekolah.length && !$sekolah.prop('disabled')) {
                    $sekolah.val(String(finalSekolah)).trigger('change.select2');
                }

                await loadAnakGuru($anak, $guru, String(finalSekolah));

                if (oldAnak) $anak.val(String(oldAnak)).trigger('change.select2');
                if (oldGuru) $guru.val(String(oldGuru)).trigger('change.select2');
            }
        });


    })();
</script>
