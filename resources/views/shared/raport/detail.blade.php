{{-- Modal Detail Raport --}}
<div class="modal fade" id="modal_detail_raport_{{ $raport->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            {{-- Header --}}
            <div class="modal-header">
                <h2 class="fw-bold mb-0">
                    Detail Raport
                    <span class="fs-6 text-muted d-block mt-1">
                        {{ $raport->anak->nama_anak ?? '-' }} •
                        {{ $raport->anak->sekolah->nama_sekolah ?? '-' }}
                    </span>
                </h2>

                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>

            {{-- Body --}}
            <div class="modal-body px-5 py-5">

                @php
                    $fotosAgama = $raport->fotos->where('komponen', 'agama');
                    $fotosJatiDiri = $raport->fotos->where('komponen', 'jati_diri');
                    $fotosLiterasiSains = $raport->fotos->where('komponen', 'literasi_sains');
                    $fotosP5 = $raport->fotos->where('komponen', 'p5');
                @endphp

                {{-- Info Utama --}}
                <div class="mb-8">
                    <h4 class="fw-bold text-gray-900 mb-4">Informasi Umum</h4>

                    <div class="row g-5">
                        <div class="col-md-6">
                            <div class="border rounded p-4 h-100">
                                {{-- FOTO ANAK --}}
                                @if (optional($raport->anak)->foto)
                                    <div class="mb-4 text-center">
                                        <img src="{{ asset('storage/' . $raport->anak->foto) }}"
                                            alt="Foto {{ $raport->anak->nama_anak }}" class="rounded-circle"
                                            style="width: 120px; height: 120px; object-fit: cover;">
                                    </div>
                                @else
                                    {{-- kalau nggak ada foto, boleh pakai placeholder/inisial --}}
                                    <div class="mb-4 text-center">
                                        <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center"
                                            style="width: 120px; height: 120px;">
                                            <span class="fw-bold fs-2 text-gray-500">
                                                {{ Str::upper(Str::substr($raport->anak->nama_anak ?? 'A', 0, 1)) }}
                                            </span>
                                        </div>
                                    </div>
                                @endif
                                <div class="mb-3">
                                    <div class="fw-semibold text-gray-600">Nama Anak</div>
                                    <div class="fs-6 fw-bold text-gray-900">
                                        {{ $raport->anak->nama_anak ?? '-' }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="fw-semibold text-gray-600">Sekolah</div>
                                    <div class="fs-6 fw-bold text-gray-900">
                                        {{ $raport->anak->sekolah->nama_sekolah ?? '-' }}
                                    </div>
                                </div>

                                <div class="mb-0">
                                    <div class="fw-semibold text-gray-600">Guru</div>
                                    <div class="fs-6 fw-bold text-gray-900">
                                        {{ $raport->guru->nama_guru ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded p-4 h-100">
                                <div class="mb-3">
                                    <div class="fw-semibold text-gray-600">Semester</div>
                                    <div class="fs-6 fw-bold text-gray-900">
                                        {{ $raport->semester }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="fw-semibold text-gray-600">Tahun Ajaran</div>
                                    <div class="fs-6 fw-bold text-gray-900">
                                        {{ $raport->tahun_ajaran }}
                                    </div>
                                </div>

                                <div class="mb-0">
                                    <div class="fw-semibold text-gray-600">Total Foto</div>
                                    <div class="fs-6 fw-bold text-gray-900">
                                        {{ $raport->fotos->count() }} foto
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kehadiran --}}
                <div class="mb-8">
                    <h4 class="fw-bold text-gray-900 mb-4">Kehadiran</h4>

                    <div class="row g-5">
                        <div class="col-md-4">
                            <div class="border rounded p-4 h-100">
                                <div class="fw-semibold text-gray-600 mb-1">Sakit</div>
                                <div class="fs-5 fw-bold text-gray-900">{{ $raport->sakit ?? 0 }} <span
                                        class="fs-7 text-muted">hari</span></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="border rounded p-4 h-100">
                                <div class="fw-semibold text-gray-600 mb-1">Izin</div>
                                <div class="fs-5 fw-bold text-gray-900">{{ $raport->izin ?? 0 }} <span
                                        class="fs-7 text-muted">hari</span></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="border rounded p-4 h-100">
                                <div class="fw-semibold text-gray-600 mb-1">Tanpa Keterangan</div>
                                <div class="fs-5 fw-bold text-gray-900">{{ $raport->tanpa_keterangan ?? 0 }} <span
                                        class="fs-7 text-muted">hari</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="separator my-8"></div>

                {{-- Bagian Nilai + Foto --}}
                <div class="mb-8">
                    <h4 class="fw-bold text-gray-900 mb-4">Nilai & Dokumentasi Kegiatan</h4>

                    {{-- Agama --}}
                    <div class="mb-6">
                        <div class="d-flex align-items-center mb-3">
                            <span class="bullet bullet-dot bg-primary me-2"></span>
                            <h5 class="fw-bold text-gray-900 mb-0">Nilai Agama</h5>
                        </div>

                        <div class="row g-5">
                            <div class="col-md-6">
                                <div class="border rounded p-4 h-100">
                                    <div class="fw-semibold text-gray-600 mb-2">Deskripsi Nilai</div>
                                    <p class="mb-0 text-gray-700">
                                        {{ $raport->nilai_agama ?? '-' }}
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded p-4 h-100">
                                    <div class="fw-semibold text-gray-600 mb-2">Foto Kegiatan</div>
                                    <div class="d-flex flex-wrap gap-3">
                                        @forelse ($fotosAgama as $foto)
                                            <div class="position-relative">
                                                <img src="{{ asset('storage/' . $foto->foto) }}" alt="Foto Agama"
                                                    class="rounded"
                                                    style="width: 110px; height: 110px; object-fit: cover;">
                                            </div>
                                        @empty
                                            <span class="text-muted">Belum ada foto kegiatan agama.</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Jati Diri --}}
                    <div class="mb-6">
                        <div class="d-flex align-items-center mb-3">
                            <span class="bullet bullet-dot bg-primary me-2"></span>
                            <h5 class="fw-bold text-gray-900 mb-0">Nilai Jati Diri</h5>
                        </div>

                        <div class="row g-5">
                            <div class="col-md-6">
                                <div class="border rounded p-4 h-100">
                                    <div class="fw-semibold text-gray-600 mb-2">Deskripsi Nilai</div>
                                    <p class="mb-0 text-gray-700">
                                        {{ $raport->nilai_jati_diri ?? '-' }}
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded p-4 h-100">
                                    <div class="fw-semibold text-gray-600 mb-2">Foto Kegiatan</div>
                                    <div class="d-flex flex-wrap gap-3">
                                        @forelse ($fotosJatiDiri as $foto)
                                            <div class="position-relative">
                                                <img src="{{ asset('storage/' . $foto->foto) }}" alt="Foto Jati Diri"
                                                    class="rounded"
                                                    style="width: 110px; height: 110px; object-fit: cover;">
                                            </div>
                                        @empty
                                            <span class="text-muted">Belum ada foto kegiatan jati diri.</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Literasi & Sains --}}
                    <div class="mb-6">
                        <div class="d-flex align-items-center mb-3">
                            <span class="bullet bullet-dot bg-primary me-2"></span>
                            <h5 class="fw-bold text-gray-900 mb-0">Nilai Literasi &amp; Sains</h5>
                        </div>

                        <div class="row g-5">
                            <div class="col-md-6">
                                <div class="border rounded p-4 h-100">
                                    <div class="fw-semibold text-gray-600 mb-2">Deskripsi Nilai</div>
                                    <p class="mb-0 text-gray-700">
                                        {{ $raport->nilai_literasi_sains ?? '-' }}
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded p-4 h-100">
                                    <div class="fw-semibold text-gray-600 mb-2">Foto Kegiatan</div>
                                    <div class="d-flex flex-wrap gap-3">
                                        @forelse ($fotosLiterasiSains as $foto)
                                            <div class="position-relative">
                                                <img src="{{ asset('storage/' . $foto->foto) }}"
                                                    alt="Foto Literasi & Sains" class="rounded"
                                                    style="width: 110px; height: 110px; object-fit: cover;">
                                            </div>
                                        @empty
                                            <span class="text-muted">Belum ada foto kegiatan literasi &amp;
                                                sains.</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- P5 --}}
                    <div class="mb-2">
                        <div class="d-flex align-items-center mb-3">
                            <span class="bullet bullet-dot bg-primary me-2"></span>
                            <h5 class="fw-bold text-gray-900 mb-0">Nilai P5 (Profil Pelajar Pancasila)</h5>
                        </div>

                        <div class="row g-5">
                            <div class="col-md-6">
                                <div class="border rounded p-4 h-100">
                                    <div class="fw-semibold text-gray-600 mb-2">Deskripsi Nilai</div>
                                    <p class="mb-0 text-gray-700">
                                        {{ $raport->nilai_p5 ?? '-' }}
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded p-4 h-100">
                                    <div class="fw-semibold text-gray-600 mb-2">Foto Kegiatan</div>
                                    <div class="d-flex flex-wrap gap-3">
                                        @forelse ($fotosP5 as $foto)
                                            <div class="position-relative">
                                                <img src="{{ asset('storage/' . $foto->foto) }}" alt="Foto P5"
                                                    class="rounded"
                                                    style="width: 110px; height: 110px; object-fit: cover;">
                                            </div>
                                        @empty
                                            <span class="text-muted">Belum ada foto kegiatan P5.</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-2">
                        <div class="d-flex align-items-center mb-3">
                            <span class="bullet bullet-dot bg-primary me-2"></span>
                            <h5 class="fw-bold text-gray-900 mb-0">Refleksi Guru</h5>
                        </div>

                        <div class="row g-5">
                            <div class="col-md-6">
                                <div class="border rounded p-4 h-100">
                                    <div class="fw-semibold text-gray-600 mb-2">Deskripsi</div>
                                    <p class="mb-0 text-gray-700">
                                        {{ $raport->refleksi_guru ?? '-' }}
                                    </p>
                                </div>
                            </div>

                            
                        </div>
                    </div>

                </div>

            </div>

            {{-- Footer --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
