{{-- Modal Edit Raport --}}
<div class="modal fade" id="modal_edit_raport_{{ $raport->id }}"
    data-selected-sekolah="{{ old('sekolahs_id', $raport->sekolah_id ?? ($raport->sekolahs_id ?? '')) }}"
    data-selected-anak="{{ old('anaks_id', $raport->anak_id ?? ($raport->anaks_id ?? '')) }}"
    data-selected-guru="{{ old('gurus_id', $raport->guru_id ?? ($raport->gurus_id ?? '')) }}" tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            {{-- Header --}}
            <div class="modal-header" id="modal_edit_raport_header_{{ $raport->id }}">
                <h2 class="fw-bold">Edit Raport</h2>

                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>

            {{-- Body --}}
            <div class="modal-body px-5 my-7">
                <form enctype="multipart/form-data" id="modal_edit_raport_form_{{ $raport->id }}"
                    class="form form-loading" action="{{ route($routeNameUpdate, $raport->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="d-flex flex-column scroll-y px-5 px-lg-10"
                        id="modal_edit_raport_scroll_{{ $raport->id }}" data-kt-scroll="true"
                        data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modal_edit_raport_header_{{ $raport->id }}"
                        data-kt-scroll-wrappers="#modal_edit_raport_scroll_{{ $raport->id }}"
                        data-kt-scroll-offset="300px">

                        {{-- Sekolah --}}
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">
                                Sekolah <span class="text-danger ms-1">*</span>
                            </label>

                            <select id="sekolah_select_{{ $raport->id }}" class="form-select form-select-solid"
                                data-control="select2" data-placeholder="Pilih Sekolah..." name="sekolahs_id">

                                <option value=""></option>
                                @foreach ($dataSekolah as $sekolah)
                                    <option value="{{ $sekolah->id }}"
                                        {{ old('sekolahs_id', $raport->sekolah_id ?? ($raport->sekolahs_id ?? null)) == $sekolah->id ? 'selected' : '' }}>
                                        {{ $sekolah->nama_sekolah }}
                                    </option>
                                @endforeach
                            </select>

                            @error('sekolahs_id')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Anak --}}
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">
                                Nama Anak <span class="text-danger ms-1">*</span>
                            </label>

                            <select id="anak_select_{{ $raport->id }}" class="form-select form-select-solid"
                                data-control="select2" data-placeholder="Pilih Anak..." name="anaks_id">
                                <option value=""></option>
                            </select>


                            @error('anaks_id')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Guru --}}
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">
                                Nama Guru <span class="text-danger ms-1">*</span>
                            </label>

                            <select id="guru_select_{{ $raport->id }}" class="form-select form-select-solid"
                                data-control="select2" data-placeholder="Pilih Guru..." name="gurus_id">
                                <option value=""></option>
                            </select>


                            @error('gurus_id')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>


                        {{-- Semester --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">
                                Semester <span class="text-danger ms-1">*</span>
                            </label>
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                                data-placeholder="Pilih Semester..." name="semester">
                                <option value="">Pilih Semester...</option>
                                <option value="1"
                                    {{ old('semester', $raport->semester) == '1' ? 'selected' : '' }}>1</option>
                                <option value="2"
                                    {{ old('semester', $raport->semester) == '2' ? 'selected' : '' }}>2</option>
                            </select>
                            @error('semester')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tahun Ajaran --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">
                                Tahun Ajaran <span class="text-danger ms-1">*</span>
                            </label>
                            <input type="text" name="tahun_ajaran"
                                class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Tahun Ajaran"
                                value="{{ old('tahun_ajaran', $raport->tahun_ajaran) }}" />
                            @error('tahun_ajaran')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Nilai Agama --}}
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Nilai Agama</label>
                            <textarea class="form-control form-control-solid" rows="3" name="nilai_agama" placeholder="Type Nilai Agama">{{ old('nilai_agama', $raport->nilai_agama) }}</textarea>
                        </div>

                        {{-- Foto Nilai Agama --}}
                        {{-- Foto Nilai Agama --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Foto Kegiatan Nilai Agama</label>

                            {{-- Foto lama + tombol silang --}}
                            {{-- Foto lama + tombol silang --}}
                            <div class="mb-3 d-flex flex-wrap gap-3">
                                @php
                                    $fotosAgama = $raport->fotos->where('komponen', 'agama');
                                @endphp

                                @forelse ($fotosAgama as $foto)
                                    <div class="position-relative me-2 mb-2" id="existing_foto_{{ $foto->id }}">
                                        <img src="{{ asset('storage/' . $foto->foto) }}" alt="Foto Agama"
                                            class="rounded" style="width:80px; height:80px; object-fit:cover;">

                                        {{-- checkbox hidden yang akan dikirim kalau foto dihapus --}}
                                        <input type="checkbox" name="delete_foto_ids[]" value="{{ $foto->id }}"
                                            class="d-none" data-delete-checkbox>

                                        <button type="button"
                                            class="btn btn-icon btn-xs btn-danger position-absolute top-0 end-0 translate-middle"
                                            onclick="removeExistingFoto(this)">
                                            <i class="ki-duotone ki-cross fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </button>
                                    </div>
                                @empty
                                    <span class="text-muted">Belum ada foto kegiatan agama.</span>
                                @endforelse
                            </div>


                            {{-- Upload baru dengan preview + silang (seperti tambah) --}}
                            <div id="wrapper_foto_agama_edit_{{ $raport->id }}">
                                <input type="file" id="input_foto_agama_edit_{{ $raport->id }}"
                                    class="form-control form-control-solid mb-3" multiple
                                    onchange="handleMultiImage(this, 'foto_agama_edit_{{ $raport->id }}')">

                                {{-- input hidden yang berisi semua file baru --}}
                                <input type="file" id="store_foto_agama_edit_{{ $raport->id }}"
                                    name="foto_agama[]" multiple style="display:none;">
                            </div>

                            <small class="text-muted d-block">
                                Bisa upload lebih dari satu foto dan bisa upload lagi beberapa kali.
                            </small>

                            <div id="preview_foto_agama_edit_{{ $raport->id }}"
                                class="mt-3 d-flex flex-wrap gap-3"></div>
                        </div>


                        {{-- Nilai Jati Diri --}}
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Nilai Jati Diri</label>
                            <textarea class="form-control form-control-solid" rows="3" name="nilai_jati_diri"
                                placeholder="Type Nilai Jati Diri">{{ old('nilai_jati_diri', $raport->nilai_jati_diri) }}</textarea>
                        </div>

                        {{-- Foto Jati Diri --}}
                        {{-- Foto Jati Diri --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Foto Kegiatan Jati Diri</label>

                            <div class="mb-3 d-flex flex-wrap gap-3">
                                @php
                                    $fotosJatiDiri = $raport->fotos->where('komponen', 'jati_diri');
                                @endphp

                                @forelse ($fotosJatiDiri as $foto)
                                    <div class="position-relative me-2 mb-2" id="existing_foto_{{ $foto->id }}">
                                        <img src="{{ asset('storage/' . $foto->foto) }}" alt="Foto Jati Diri"
                                            class="rounded" style="width:80px; height:80px; object-fit:cover;">

                                        <input type="checkbox" name="delete_foto_ids[]" value="{{ $foto->id }}"
                                            class="d-none" data-delete-checkbox>

                                        <button type="button"
                                            class="btn btn-icon btn-xs btn-danger position-absolute top-0 end-0 translate-middle"
                                            onclick="removeExistingFoto(this)">
                                            <i class="ki-duotone ki-cross fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </button>
                                    </div>
                                @empty
                                    <span class="text-muted">Belum ada foto kegiatan jati diri.</span>
                                @endforelse
                            </div>


                            <div id="wrapper_foto_jati_diri_edit_{{ $raport->id }}">
                                <input type="file" id="input_foto_jati_diri_edit_{{ $raport->id }}"
                                    class="form-control form-control-solid mb-3" multiple
                                    onchange="handleMultiImage(this, 'foto_jati_diri_edit_{{ $raport->id }}')">

                                <input type="file" id="store_foto_jati_diri_edit_{{ $raport->id }}"
                                    name="foto_jati_diri[]" multiple style="display:none;">
                            </div>

                            <small class="text-muted d-block">
                                Bisa upload lebih dari satu foto dan bisa upload lagi beberapa kali.
                            </small>

                            <div id="preview_foto_jati_diri_edit_{{ $raport->id }}"
                                class="mt-3 d-flex flex-wrap gap-3"></div>
                        </div>


                        {{-- Nilai Literasi Sains --}}
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Nilai Literasi Sains</label>
                            <textarea class="form-control form-control-solid" rows="3" name="nilai_literasi_sains"
                                placeholder="Type Nilai Literasi Sains">{{ old('nilai_literasi_sains', $raport->nilai_literasi_sains) }}</textarea>
                        </div>

                        {{-- Foto Literasi & Sains --}}
                        {{-- Foto Literasi & Sains --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Foto Kegiatan Literasi &amp; Sains</label>

                            <div class="mb-3 d-flex flex-wrap gap-3">
                                @php
                                    $fotosLiterasiSains = $raport->fotos->where('komponen', 'literasi_sains');
                                @endphp

                                @forelse ($fotosLiterasiSains as $foto)
                                    <div class="position-relative me-2 mb-2" id="existing_foto_{{ $foto->id }}">
                                        <img src="{{ asset('storage/' . $foto->foto) }}" alt="Foto Literasi & Sains"
                                            class="rounded" style="width:80px; height:80px; object-fit:cover;">

                                        <input type="checkbox" name="delete_foto_ids[]" value="{{ $foto->id }}"
                                            class="d-none" data-delete-checkbox>

                                        <button type="button"
                                            class="btn btn-icon btn-xs btn-danger position-absolute top-0 end-0 translate-middle"
                                            onclick="removeExistingFoto(this)">
                                            <i class="ki-duotone ki-cross fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </button>
                                    </div>
                                @empty
                                    <span class="text-muted">Belum ada foto kegiatan literasi &amp; sains.</span>
                                @endforelse
                            </div>


                            <div id="wrapper_foto_literasi_sains_edit_{{ $raport->id }}">
                                <input type="file" id="input_foto_literasi_sains_edit_{{ $raport->id }}"
                                    class="form-control form-control-solid mb-3" multiple
                                    onchange="handleMultiImage(this, 'foto_literasi_sains_edit_{{ $raport->id }}')">

                                <input type="file" id="store_foto_literasi_sains_edit_{{ $raport->id }}"
                                    name="foto_literasi_sains[]" multiple style="display:none;">
                            </div>

                            <small class="text-muted d-block">
                                Bisa upload lebih dari satu foto dan bisa upload lagi beberapa kali.
                            </small>

                            <div id="preview_foto_literasi_sains_edit_{{ $raport->id }}"
                                class="mt-3 d-flex flex-wrap gap-3"></div>
                        </div>


                        {{-- Nilai P5 --}}
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Nilai P5</label>
                            <textarea class="form-control form-control-solid" rows="3" name="nilai_p5" placeholder="Type Nilai P5">{{ old('nilai_p5', $raport->nilai_p5) }}</textarea>
                        </div>

                        {{-- Foto P5 --}}
                        {{-- Foto P5 --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">
                                Foto Kegiatan P5 (Profil Pelajar Pancasila)
                            </label>

                            <div class="mb-3 d-flex flex-wrap gap-3">
                                @php
                                    $fotosP5 = $raport->fotos->where('komponen', 'p5');
                                @endphp

                                @forelse ($fotosP5 as $foto)
                                    <div class="position-relative me-2 mb-2" id="existing_foto_{{ $foto->id }}">
                                        <img src="{{ asset('storage/' . $foto->foto) }}" alt="Foto P5"
                                            class="rounded" style="width:80px; height:80px; object-fit:cover;">

                                        <input type="checkbox" name="delete_foto_ids[]" value="{{ $foto->id }}"
                                            class="d-none" data-delete-checkbox>

                                        <button type="button"
                                            class="btn btn-icon btn-xs btn-danger position-absolute top-0 end-0 translate-middle"
                                            onclick="removeExistingFoto(this)">
                                            <i class="ki-duotone ki-cross fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </button>
                                    </div>
                                @empty
                                    <span class="text-muted">Belum ada foto kegiatan P5.</span>
                                @endforelse
                            </div>


                            <div id="wrapper_foto_p5_edit_{{ $raport->id }}">
                                <input type="file" id="input_foto_p5_edit_{{ $raport->id }}"
                                    class="form-control form-control-solid mb-3" multiple
                                    onchange="handleMultiImage(this, 'foto_p5_edit_{{ $raport->id }}')">

                                <input type="file" id="store_foto_p5_edit_{{ $raport->id }}" name="foto_p5[]"
                                    multiple style="display:none;">
                            </div>

                            <small class="text-muted d-block">
                                Bisa upload lebih dari satu foto dan bisa upload lagi beberapa kali.
                            </small>

                            <div id="preview_foto_p5_edit_{{ $raport->id }}" class="mt-3 d-flex flex-wrap gap-3">
                            </div>
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Refleksi Guru</label>
                            <textarea class="form-control form-control-solid" rows="3" name="refleksi_guru"
                                placeholder="Type Refleksi Guru">{{ old('refleksi_guru', $raport->refleksi_guru) }}</textarea>
                        </div>

                        {{-- Kehadiran --}}
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Kehadiran</label>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Sakit</label>
                                    <input type="number" min="0" name="sakit"
                                        class="form-control form-control-solid" placeholder="Sakit"
                                        value="{{ old('sakit', $raport->sakit ?? 0) }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Izin</label>
                                    <input type="number" min="0" name="izin"
                                        class="form-control form-control-solid" placeholder="Izin"
                                        value="{{ old('izin', $raport->izin ?? 0) }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Tanpa Keterangan</label>
                                    <input type="number" min="0" name="tanpa_keterangan"
                                        class="form-control form-control-solid" placeholder="Tanpa Keterangan"
                                        value="{{ old('tanpa_keterangan', $raport->tanpa_keterangan ?? 0) }}">
                                </div>
                            </div>
                        </div>


                    </div>
                    {{-- <div id="delete_fotos_container_{{ $raport->id }}"></div> --}}

                    {{-- Actions --}}
                    <div class="text-center pt-10">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">Simpan Perubahan</span>
                            <span class="indicator-progress">
                                Mohon tunggu...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
            {{-- End Body --}}
        </div>
    </div>
</div>

@if ($errors->any() && old('form_source') === 'edit_raport')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('modal_edit_raport'));
            myModal.show();
        });
    </script>
@endif
<script>
    // state khusus untuk EDIT (supaya tidak tabrakan dengan script tambah)
    const editMultiImageState = {};
    let editMultiImageCounter = 0;

    function ensureEditState(key) {
        if (!editMultiImageState[key]) {
            editMultiImageState[key] = {
                files: [] // array of {id, file}
            };
        }
        return editMultiImageState[key];
    }

    function handleMultiImage(input, key) {
        const state = ensureEditState(key);
        const preview = document.getElementById('preview_' + key);
        if (!preview || !input.files.length) return;

        Array.from(input.files).forEach(file => {
            if (!file.type.startsWith('image/')) return;

            const id = key + '_' + (editMultiImageCounter++);
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
        const state = ensureEditState(key);

        if (!hidden) return;

        const dt = new DataTransfer();
        state.files.forEach(item => dt.items.add(item.file));
        hidden.files = dt.files;
    }

    function removeImage(key, id) {
        const state = ensureEditState(key);

        // hapus dari state
        state.files = state.files.filter(item => item.id !== id);

        // hapus dari preview DOM
        const preview = document.getElementById('preview_' + key);
        if (preview) {
            const el = preview.querySelector('[data-file-id="' + id + "']");
            if (el) el.remove();
        }

        // update input hidden
        syncHiddenInput(key);
    }

    function removeExistingFoto(btn) {
        const wrapper = btn.closest('.position-relative');
        if (!wrapper) return;

        // Temukan checkbox hidden di dalam wrapper
        const checkbox = wrapper.querySelector('[data-delete-checkbox]');
        if (checkbox) {
            checkbox.checked = true; // tandai akan dihapus
        }

        // Sembunyikan dari tampilan, tapi JANGAN di-remove dari DOM,
        // supaya checkbox tetap ikut terkirim saat submit.
        wrapper.classList.add('d-none');
    }
    // function markDeleteExistingFoto(fotoId, raportId, btn) {
    //     // Hapus dari tampilan: ambil wrapper terdekat (div posisi relatif)
    //     const wrapper = btn.closest('.position-relative');
    //     if (wrapper) {
    //         wrapper.remove();
    //     }

    //     // Tambahkan hidden input supaya controller tahu foto mana yang dihapus
    //     const container = document.getElementById('delete_fotos_container_' + raportId);
    //     if (!container) return;

    //     const input = document.createElement('input');
    //     input.type = 'hidden';
    //     input.name = 'delete_foto_ids[]';
    //     input.value = fotoId;
    //     container.appendChild(input);
    // }
</script>

<script>
    (function() {
        const cache = {};

        function initSelect2($modal) {
            $modal.find('select[data-control="select2"]').each(function() {
                if ($(this).hasClass('select2-hidden-accessible')) $(this).select2('destroy');
                $(this).select2({
                    dropdownParent: $modal,
                    width: '100%',
                    placeholder: $(this).data('placeholder') || 'Pilih...',
                    minimumResultsForSearch: 0
                });
            });
        }

        function resetOptions($el) {
            $el.find('option').not(':first').remove();
            $el.val(null).trigger('change.select2');
        }

        async function fetchAnakGuru(sekolahId) {
            if (cache[sekolahId]) return cache[sekolahId];

            const url = `{{ route($routeAnakGuru, ['sekolah' => '__ID__']) }}`.replace('__ID__', sekolahId);
            const res = await fetch(url, {
                headers: {
                    Accept: 'application/json'
                }
            });
            const data = await res.json();
            cache[sekolahId] = data;
            return data;
        }

        function fillOptionsNoDouble($select, items) {
            const exists = new Set();
            $select.find('option').each(function() {
                exists.add(String(this.value));
            });

            items.forEach(it => {
                const id = String(it.id);
                if (exists.has(id)) return;
                $select.append(new Option(it.text, id, false, false));
                exists.add(id);
            });
        }

        async function loadAndSet($modal, raportId, sekolahId) {
            const $anak = $modal.find('#anak_select_' + raportId);
            const $guru = $modal.find('#guru_select_' + raportId);

            resetOptions($anak);
            resetOptions($guru);
            if (!sekolahId) return;

            const data = await fetchAnakGuru(String(sekolahId));
            fillOptionsNoDouble($anak, data.anak);
            fillOptionsNoDouble($guru, data.guru);

            // ✅ set OLD setelah option ada
            const selectedAnak = String($modal.data('selected-anak') || '');
            const selectedGuru = String($modal.data('selected-guru') || '');

            if (selectedAnak) $anak.val(selectedAnak).trigger('change.select2');
            if (selectedGuru) $guru.val(selectedGuru).trigger('change.select2');
        }

        document.addEventListener('shown.bs.modal', function(e) {
            const modalEl = e.target;
            if (!modalEl.id.startsWith('modal_edit_raport_')) return;

            const raportId = modalEl.id.replace('modal_edit_raport_', '');
            const $modal = $('#' + modalEl.id);

            initSelect2($modal);

            const $sekolah = $modal.find('#sekolah_select_' + raportId);

            // ✅ pastikan sekolah ikut old juga
            const selectedSekolah = String($modal.data('selected-sekolah') || '');
            if (selectedSekolah) $sekolah.val(selectedSekolah).trigger('change.select2');

            // bind change (hapus dulu biar ga numpuk)
            $sekolah.off('change.dependent').on('change.dependent', function() {
                // kalau user ganti sekolah manual, reset pilihan anak/guru lama
                $modal.data('selected-anak', '');
                $modal.data('selected-guru', '');
                loadAndSet($modal, raportId, this.value);
            });

            // load pertama kali
            loadAndSet($modal, raportId, $sekolah.val());
        });
    })();
</script>
