@php
    $fotoAnak = $anak->foto;

    if (\Illuminate\Support\Str::startsWith($fotoAnak, 'foto_anak/')) {
        $srcFotoAnak = asset('storage/' . $fotoAnak);
    } else {
        $srcFotoAnak = asset($fotoAnak);
    }

    // Jenis kelamin label
    $labelJenisKelamin = '-';
    $badgeJenisKelaminClass = 'badge-light';

    if ($anak->jenis_kelamin === 'L') {
        $labelJenisKelamin = 'Laki-laki';
        $badgeJenisKelaminClass = 'badge-light-primary';
    } elseif ($anak->jenis_kelamin === 'P') {
        $labelJenisKelamin = 'Perempuan';
        $badgeJenisKelaminClass = 'badge-light-danger';
    }
@endphp

<div class="modal fade" id="modal_detail_anak_{{ $anak->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            {{-- Header --}}
            <div class="modal-header">
                <div class="d-flex flex-column">
                    <h2 class="fw-bold mb-1">Detail Anak</h2>
                    <span class="text-muted fs-7">Informasi lengkap anak yang terdaftar di sistem</span>
                </div>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span><span class="path2"></span>
                    </i>
                </div>
            </div>

            {{-- Body --}}
            <div class="modal-body px-5 py-5">
                {{-- Profile header --}}
                <div class="d-flex align-items-center mb-7">
                    <div class="symbol symbol-60px symbol-circle me-4">
                        <img src="{{ $srcFotoAnak }}" alt="Foto Anak" style="object-fit: cover;">
                    </div>
                    <div class="d-flex flex-column">
                        <span class="fw-bold fs-4">{{ $anak->nama_anak ?? '-' }}</span>

                        <span class="text-muted fs-7 mb-1">
                            {{ $anak->orangTua->nama_ayah ?? '-' }} &amp; {{ $anak->orangTua->nama_ibu ?? '-' }}
                        </span>

                        <div class="d-flex align-items-center gap-2 mt-2">
                            {{-- Jenis Kelamin --}}
                            <span class="badge {{ $badgeJenisKelaminClass }}">{{ $labelJenisKelamin }}</span>

                            {{-- Sekolah --}}
                            @if ($anak->sekolah?->nama_sekolah)
                                <span class="badge badge-light-success">
                                    {{ $anak->sekolah->nama_sekolah }}
                                </span>
                            @endif

                            {{-- Tanggal Masuk (kalau ada) --}}
                            @if ($anak->tanggal_masuk)
                                <span class="badge badge-light-info">
                                    Masuk: {{ \Carbon\Carbon::parse($anak->tanggal_masuk)->format('d-m-Y') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="separator my-5"></div>

                {{-- Detail fields --}}
                <div class="row g-5">
                    <div class="col-md-6">
                        {{-- NIK --}}
                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">NIK</span>
                            <span class="fw-bold fs-6 text-gray-800">{{ $anak->nik ?? '-' }}</span>
                        </div>

                        {{-- NISN --}}
                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">NISN</span>
                            <span class="fw-bold fs-6 text-gray-800">{{ $anak->nisn ?? '-' }}</span>
                        </div>

                        {{-- NIPD --}}
                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">NIPD</span>
                            <span class="fw-bold fs-6 text-gray-800">{{ $anak->nipd ?? '-' }}</span>
                        </div>

                        {{-- No KK --}}
                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">No KK</span>
                            <span class="fw-bold fs-6 text-gray-800">{{ $anak->no_kk ?? '-' }}</span>
                        </div>

                        {{-- No Registrasi Akta --}}
                        <div class="d-flex flex-column mb-0">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">No Registrasi Akta</span>
                            <span class="fw-bold fs-6 text-gray-800">{{ $anak->no_registrasi_akta ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{-- Tempat, Tanggal Lahir --}}
                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">
                                Tempat, Tanggal Lahir
                            </span>
                            <span class="fw-bold fs-6 text-gray-800">
                                {{ $anak->tempat_lahir ?? '-' }},
                                {{ $anak->tanggal_lahir ? \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d-m-Y') : '-' }}
                            </span>
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">
                                Jenis Kelamin
                            </span>
                            <span class="fw-bold fs-6 text-gray-800">
                                {{ $labelJenisKelamin }}
                            </span>
                        </div>

                        {{-- Orang Tua --}}
                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">
                                Orang Tua
                            </span>
                            <span class="fw-bold fs-6 text-gray-800">
                                {{ $anak->orangTua->nama_ayah ?? '-' }} &amp; {{ $anak->orangTua->nama_ibu ?? '-' }}
                            </span>
                        </div>

                        {{-- Sekolah --}}
                        <div class="d-flex flex-column mb-0">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">
                                Sekolah
                            </span>
                            <span class="fw-bold fs-6 text-gray-800">
                                {{ $anak->sekolah->nama_sekolah ?? '-' }}
                            </span>
                        </div>
                    </div>
                </div>

            </div> {{-- end body --}}
        </div>
    </div>
</div>
