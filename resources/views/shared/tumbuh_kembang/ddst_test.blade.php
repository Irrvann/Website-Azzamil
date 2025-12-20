@extends('layouts.app')

@section('content')
    <!--begin::Main-->

    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Tes DDST - {{ $anak->nama_anak ?? ($anak->nama ?? 'Anak') }}
                    </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    {{-- kalau mau breadcrumb, tambahkan di sini --}}
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->

                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ url()->previous() }}" class="btn btn-light btn-sm">
                        Kembali
                    </a>
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">

                {{-- FORM dibuka di sini supaya antropometri & DDST disimpan bareng --}}
                <form action="{{ route($routeNameStore, $antropometri->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="usia_bulan" value="{{ $usiaBulan }}">

                    <!--begin::Card: Info Anak & Antropometri-->
                    <div class="card mb-5">
                        <div class="card-header border-0 pt-6">
                            <div class="card-title">
                                <h3 class="fw-bold mb-0">Informasi Anak & Antropometri</h3>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row mb-4">
                                {{-- INFO ANAK (readonly) --}}
                                <div class="col-md-4">
                                    <div class="mb-2 fw-semibold text-gray-600">Nama Anak</div>
                                    <div class="fw-bold">
                                        {{ $anak->nama_anak ?? ($anak->nama ?? '-') }}
                                    </div>

                                    <div class="mb-2 mt-4 fw-semibold text-gray-600">Tanggal Lahir</div>
                                    <div class="fw-bold">
                                        @if (!empty($anak->tanggal_lahir))
                                            {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d-m-Y') }}
                                        @else
                                            -
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-2 fw-semibold text-gray-600">Sekolah</div>
                                    <div class="fw-bold">
                                        {{ $anak->sekolah->nama_sekolah ?? '-' }}
                                    </div>

                                    <div class="mb-2 mt-4 fw-semibold text-gray-600">Usia Saat Tes</div>
                                    <div class="fw-bold">
                                        {{ $usiaBulan }} bulan
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <div class="mb-2 fw-semibold text-gray-600">
                                        Guru Pemeriksa <span class="text-danger">*</span>
                                    </div>

                                    @role('guru')
                                        @php
                                            $guruLogin = auth()->user()->guru; // pastikan relasi user->guru ada
                                        @endphp

                                        {{-- tampil terkunci --}}
                                        <select class="form-select form-select-solid" disabled>
                                            <option value="{{ $guruLogin?->id }}">
                                                {{ $guruLogin?->nama_guru ?? 'Guru tidak ditemukan' }}
                                            </option>
                                        </select>

                                        {{-- value yang dikirim --}}
                                        <input type="hidden" name="gurus_id" value="{{ old('gurus_id', $guruLogin?->id) }}">
                                    @else
                                        <select name="gurus_id" class="form-select form-select-solid" data-control="select2"
                                            data-placeholder="Pilih Guru..." required>
                                            <option value=""></option>
                                            @foreach ($listGuru as $guru)
                                                <option value="{{ $guru->id }}"
                                                    {{ old('gurus_id', $ddstTest->gurus_id ?? '') == $guru->id ? 'selected' : '' }}>
                                                    {{ $guru->nama_guru }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endrole

                                    @error('gurus_id')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror


                                    <div class="mb-2 fw-semibold text-gray-600 mt-4">
                                        Reviewer <span class="text-danger">*</span>
                                    </div>

                                    <select name="reviewers_id" class="form-select form-select-solid" data-control="select2"
                                        data-placeholder="Pilih Reviewer..." required>
                                        <option value=""></option>
                                        @foreach ($listReviewer as $reviewer)
                                            <option value="{{ $reviewer->id }}"
                                                {{ old('reviewers_id', $ddstTest->reviewers_id ?? '') == $reviewer->id ? 'selected' : '' }}>
                                                {{ $reviewer->nama }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('reviewers_id')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror


                                    @error('reviewers_id')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror

                                    {{-- Tanggal ukur --}}
                                    <div class="mb-2 fw-semibold text-gray-600 mt-4">
                                        Tanggal Ukur <span class="text-danger">*</span>
                                    </div>

                                    <input type="date" class="form-control form-control-solid mb-2"
                                        value="{{ \Carbon\Carbon::parse($antropometri->tanggal_ukur)->format('Y-m-d') }}"
                                        readonly>

                                    <input type="hidden" name="tanggal_ukur"
                                        value="{{ \Carbon\Carbon::parse($antropometri->tanggal_ukur)->format('Y-m-d') }}">

                                    @error('tanggal_ukur')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror



                                    {{-- Berat badan --}}
                                    <div class="mb-2 fw-semibold text-gray-600">Berat Badan (kg)</div>
                                    <input type="number" step="0.01" name="berat_badan"
                                        class="form-control form-control-solid mb-3" placeholder="Contoh: 15.2"
                                        value="{{ old('berat_badan', $antropometri->berat_badan) }}">
                                    @error('berat_badan')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror

                                    {{-- Status BB --}}
                                    <div class="mb-2 fw-semibold text-gray-600">Status Berat Badan</div>
                                    <select name="status_bb" class="form-select form-select-solid mb-3">
                                        <option value="">Pilih Berat Badan...</option>
                                        <option value="normal"
                                            {{ old('status_bb', $antropometri->status_bb) == 'normal' ? 'selected' : '' }}>
                                            Normal
                                        </option>
                                        <option value="resiko"
                                            {{ old('status_bb', $antropometri->status_bb) == 'resiko' ? 'selected' : '' }}>
                                            Resiko
                                        </option>
                                    </select>
                                    @error('status_bb')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror

                                    {{-- Tinggi badan --}}
                                    <div class="mb-2 fw-semibold text-gray-600">Tinggi Badan (cm)</div>
                                    <input type="number" step="0.01" name="tinggi_badan"
                                        class="form-control form-control-solid mb-3" placeholder="Contoh: 95.6"
                                        value="{{ old('tinggi_badan', $antropometri->tinggi_badan) }}">
                                    @error('tinggi_badan')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror

                                    {{-- Status BB --}}
                                    <div class="mb-2 fw-semibold text-gray-600">Status Tinggi Badan</div>
                                    <select name="status_tb" class="form-select form-select-solid mb-3">
                                        <option value="">Pilih Tinggi Badan...</option>
                                        <option value="normal"
                                            {{ old('status_tb', $antropometri->status_tb) == 'normal' ? 'selected' : '' }}>
                                            Normal
                                        </option>
                                        <option value="pendek"
                                            {{ old('status_tb', $antropometri->status_tb) == 'pendek' ? 'selected' : '' }}>
                                            Pendek
                                        </option>
                                    </select>
                                    @error('status_tb')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror

                                    {{-- Lingkar kepala --}}
                                    <div class="mb-2 fw-semibold text-gray-600">Lingkar Kepala (cm)</div>
                                    <input type="number" step="0.01" name="lingkar_kepala"
                                        class="form-control form-control-solid" placeholder="Contoh: 46.3"
                                        value="{{ old('lingkar_kepala', $antropometri->lingkar_kepala) }}">
                                    @error('lingkar_kepala')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror

                                    {{-- Lingkar lengan --}}
                                    <div class="mb-2 fw-semibold text-gray-600">Lingkar Lengan (cm)</div>
                                    <input type="number" step="0.01" name="lingkar_lengan"
                                        class="form-control form-control-solid mb-3" placeholder="Contoh: 13.5"
                                        value="{{ old('lingkar_lengan', $antropometri->lingkar_lengan) }}">
                                    @error('lingkar_lengan')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror

                                    {{-- Status gizi --}}
                                    <div class="mb-2 fw-semibold text-gray-600">Status Gizi</div>
                                    <select name="status_gizi" class="form-select form-select-solid mb-3">
                                        <option value="">Pilih Status Gizi...</option>
                                        <option value="normal"
                                            {{ old('status_gizi', $antropometri->status_gizi) == 'normal' ? 'selected' : '' }}>
                                            Normal
                                        </option>
                                        <option value="gizi_kurang"
                                            {{ old('status_gizi', $antropometri->status_gizi) == 'gizi_kurang' ? 'selected' : '' }}>
                                            Gizi Kurang
                                        </option>
                                        <option value="gizi_berlebih"
                                            {{ old('status_gizi', $antropometri->status_gizi) == 'gizi_berlebih' ? 'selected' : '' }}>
                                            Gizi Berlebih
                                        </option>
                                    </select>
                                    @error('status_gizi')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Card: Info Anak & Antropometri-->

                    <!--begin::Card: Item DDST-->
                    <div class="card">
                        <!--begin::Card header-->
                        <div class="card-header border-0 pt-6">
                            <div class="card-title">
                                <h3 class="fw-bold mb-0">Item DDST Sesuai Usia</h3>
                            </div>
                        </div>
                        <!--end::Card header-->

                        <!--begin::Card body-->
                        <div class="card-body py-4">
                            @if ($errors->any())
                                <div class="alert alert-danger mb-5">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed table-field-colored fs-6 gy-5">
                                    <thead>
                                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                            <th class="min-w-50px">No</th>
                                            <th class="min-w-250px">Nama Item</th>
                                            <th class="min-w-150px">Kategori</th>
                                            <th class="min-w-250px text-center">Status</th>
                                            <th class="min-w-250px">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-600 fw-semibold">
                                        @forelse ($items as $index => $item)
                                            @php
                                                $existing = isset($existingItems)
                                                    ? $existingItems->get($item->id)
                                                    : null;

                                                $status = $existing->status ?? null;

                                                $currentStatus = old('items.' . $item->id . '.status', $status);

                                                $ket = old(
                                                    'items.' . $item->id . '.keterangan',
                                                    $existing->keterangan ?? '',
                                                );
                                                $isFuture = $item->min_bulan > $usiaBulan;
                                            @endphp
                                            <tr @if ($isFuture) class="table-warning" @endif>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    {{ $item->nama_item }}
                                                    @if ($isFuture)
                                                        <span class="badge badge-light-primary ms-2">Item ke depan</span>
                                                    @endif
                                                </td>
                                                <td>{{ ucfirst(str_replace('_', ' ', $item->kategori_perkembangan)) }}</td>

                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-3">
                                                        <label class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="items[{{ $item->id }}][status]"
                                                                value="tercapai"
                                                                {{ $currentStatus == 'tercapai' ? 'checked' : '' }}
                                                                required>
                                                            <span class="form-check-label">Tercapai</span>
                                                        </label>

                                                        <label class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="items[{{ $item->id }}][status]"
                                                                value="belum_tercapai"
                                                                {{ $currentStatus == 'belum_tercapai' ? 'checked' : '' }}
                                                                required>
                                                            <span class="form-check-label">Belum Tercapai</span>
                                                        </label>

                                                        <label class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="items[{{ $item->id }}][status]"
                                                                value="ragu_ragu"
                                                                {{ $currentStatus == 'ragu_ragu' ? 'checked' : '' }}
                                                                required>
                                                            <span class="form-check-label">Ragu-Ragu</span>
                                                        </label>
                                                    </div>
                                                </td>

                                                <td>
                                                    <input type="text" name="items[{{ $item->id }}][keterangan]"
                                                        class="form-control form-control-sm"
                                                        placeholder="Catatan (opsional)" value="{{ $ket }}">
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-10">
                                                    Tidak ada item DDST untuk usia {{ $usiaBulan }} bulan.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <!--end::Card body-->

                        <!--end::Card body-->
                        <div class="card-body border-top pt-6">
                            <h4 class="fw-bold mb-4">Ringkasan Hasil DDST</h4>

                            <div class="row mb-5">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="fw-semibold text-gray-700 mb-1">Semester</label>
                                        <select name="semester" class="form-select form-select-solid">
                                            <option value="">Pilih Semester...</option>
                                            <option value="1"
                                                {{ old('semester', $ddstTest->semester ?? '') == '1' ? 'selected' : '' }}>
                                                Satu
                                            </option>
                                            <option value="2"
                                                {{ old('semester', $ddstTest->semester ?? '') == '2' ? 'selected' : '' }}>
                                                Dua
                                            </option>
                                        </select>
                                        @error('semester')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="fw-semibold text-gray-700 mb-1">Tahun Ajaran</label>
                                        <input type="text" name="tahun_ajaran" class="form-control form-control-solid"
                                            placeholder="Contoh: 2024/2025"
                                            value="{{ old('tahun_ajaran', $ddstTest->tahun_ajaran ?? '') }}">
                                        @error('tahun_ajaran')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-5">
                                <label class="fw-semibold text-gray-700 mb-1">Interpretasi DDST</label>
                                <textarea name="interpretasi_ddst" rows="3" class="form-control form-control-solid"
                                    placeholder="Contoh: Perkembangan sesuai usia, perlu pemantauan pada aspek motorik halus...">{{ old('interpretasi_ddst', $ddstTest->interpretasi_ddst ?? '') }}</textarea>
                                @error('interpretasi_ddst')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label class="fw-semibold text-gray-700 mb-1">Profile dan Karakter Anak yang Dikenali
                                    Guru</label>
                                <textarea name="profile_dan_karakter_yang_dikenali_guru" rows="3" class="form-control form-control-solid"
                                    placeholder="Contoh: Anak aktif, mudah bergaul, suka bermain dengan teman sebaya...">{{ old('profile_dan_karakter_yang_dikenali_guru', $ddstTest->profile_dan_karakter_yang_dikenali_guru ?? '') }}</textarea>
                                @error('profile_dan_karakter_yang_dikenali_guru')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label class="fw-semibold text-gray-700 mb-1">Profile dan Karakter Anak yang Dikenali Orang
                                    Tua</label>
                                <textarea name="profile_dan_karakter_yang_dikenali_ortu" rows="3" class="form-control form-control-solid"
                                    placeholder="Contoh: Anak aktif, mudah bergaul, suka bermain dengan teman sebaya...">{{ old('profile_dan_karakter_yang_dikenali_ortu', $ddstTest->profile_dan_karakter_yang_dikenali_ortu ?? '') }}</textarea>
                                @error('profile_dan_karakter_yang_dikenali_ortu')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label class="fw-semibold text-gray-700 mb-1">Saran / Rujukan</label>
                                <textarea name="saran_rujukan" rows="3" class="form-control form-control-solid"
                                    placeholder="Contoh: Pantau ulang 3 bulan lagi, anjurkan stimulasi di rumah, rujuk ke spesialis bila...">{{ old('saran_rujukan', $ddstTest->saran_rujukan ?? '') }}</textarea>
                                @error('saran_rujukan')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label class="fw-semibold text-gray-700 mb-1">Foto DDST</label>

                                <input type="file" name="fotos[]" id="fotosInput"
                                    class="form-control form-control-solid" accept="image/*" multiple>

                                <div class="form-text">
                                    Format: JPG/PNG/WebP. Bisa pilih banyak foto sekaligus.
                                </div>

                                @error('fotos')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                                @error('fotos.*')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror

                                {{-- Preview foto BARU yang dipilih --}}
                                <div id="previewFotos" class="d-flex flex-wrap gap-3 mt-3"></div>

                                {{-- Foto SEBELUMNYA (kalau edit) --}}
                                @if (!empty($ddstTest) && $ddstTest->fotos && $ddstTest->fotos->count())
                                    <div class="mt-4">
                                        <div class="fw-semibold text-gray-600 mb-2">Foto sebelumnya:</div>

                                        <div id="existingFotos" class="d-flex flex-wrap gap-3">
                                            @foreach ($ddstTest->fotos as $foto)
                                                <div class="foto-card position-relative border rounded p-2"
                                                    data-existing-id="{{ $foto->id }}">
                                                    <button type="button"
                                                        class="btn btn-icon btn-sm btn-light-danger position-absolute"
                                                        style="top:-10px; right:-10px; width:28px; height:28px; border-radius:999px;"
                                                        data-action="remove-existing" data-id="{{ $foto->id }}">
                                                        ✕
                                                    </button>

                                                    <img src="{{ asset('storage/' . $foto->foto) }}" style="height:110px"
                                                        class="rounded" alt="Foto DDST">
                                                </div>
                                            @endforeach
                                        </div>

                                        {{-- tempat hidden input untuk id foto yang mau dihapus --}}
                                        <div id="deletedExistingInputs"></div>
                                    </div>
                                @endif
                            </div>



                        </div>
                        <!--end::Card body (ringkasan DDST)-->


                        <!--begin::Card footer-->
                        <div class="card-footer d-flex justify-content-end">
                            <a href="{{ url()->previous() }}" class="btn btn-light me-3">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Simpan Antropometri & Tes DDST</span>
                                <span class="indicator-progress">
                                    Mohon tunggu...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                        <!--end::Card footer-->
                    </div>
                    <!--end::Card: Item DDST-->

                </form>
                {{-- end form --}}

            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->

    <!--end:::Main-->

    <script>
        const input = document.getElementById('fotosInput');
        const preview = document.getElementById('previewFotos');

        // Simpan list file terpilih agar bisa dihapus 1-1
        let selectedFiles = [];

        function renderPreview() {
            preview.innerHTML = '';

            selectedFiles.forEach((file, idx) => {
                if (!file.type.startsWith('image/')) return;

                const reader = new FileReader();
                reader.onload = (e) => {
                    const card = document.createElement('div');
                    card.className = 'position-relative border rounded p-2';
                    card.style.width = 'fit-content';

                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'btn btn-icon btn-sm btn-light-danger position-absolute';
                    btn.style.cssText = 'top:-10px; right:-10px; width:28px; height:28px; border-radius:999px;';
                    btn.innerText = '✕';
                    btn.addEventListener('click', () => removeNewFile(idx));

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.height = '110px';
                    img.className = 'rounded';

                    card.appendChild(btn);
                    card.appendChild(img);
                    preview.appendChild(card);
                };
                reader.readAsDataURL(file);
            });

            syncInputFiles();
        }

        function syncInputFiles() {
            // Update input.files agar sesuai selectedFiles (biar yang dihapus beneran tidak ikut submit)
            const dt = new DataTransfer();
            selectedFiles.forEach(f => dt.items.add(f));
            input.files = dt.files;
        }

        function removeNewFile(index) {
            selectedFiles.splice(index, 1);
            renderPreview();
        }

        input.addEventListener('change', (e) => {
            // kalau user pilih lagi, kita replace list dengan pilihan terbaru
            selectedFiles = Array.from(e.target.files || []);
            renderPreview();
        });

        // Hapus foto lama: kita "tandai" untuk dihapus saat submit
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('[data-action="remove-existing"]');
            if (!btn) return;

            const id = btn.getAttribute('data-id');

            // hilangkan card dari UI
            const card = document.querySelector(`.foto-card[data-existing-id="${id}"]`);
            if (card) card.remove();

            // tambahkan hidden input delete ids
            const holder = document.getElementById('deletedExistingInputs');
            const inputHidden = document.createElement('input');
            inputHidden.type = 'hidden';
            inputHidden.name = 'delete_foto_ids[]';
            inputHidden.value = id;
            holder.appendChild(inputHidden);
        });
    </script>
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


@endsection
