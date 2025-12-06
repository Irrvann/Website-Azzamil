@php
    $fotoGuru = $guru->foto;

    if (\Illuminate\Support\Str::startsWith($fotoGuru, 'foto_guru/')) {
        $srcFotoGuru = asset('storage/' . $fotoGuru);
    } else {
        $srcFotoGuru = asset($fotoGuru);
    }

    $statusUser = $guru->user->status ?? null;
@endphp

<div class="modal fade" id="modal_detail_guru_{{ $guru->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            {{-- Header --}}
            <div class="modal-header">
                <div class="d-flex flex-column">
                    <h2 class="fw-bold mb-1">Detail Guru</h2>
                    <span class="text-muted fs-7">Informasi lengkap guru yang terdaftar di sistem</span>
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
                        <img src="{{ $srcFotoGuru }}" alt="Foto Guru" style="object-fit: cover;">
                    </div>
                    <div class="d-flex flex-column">
                        <span class="fw-bold fs-4">{{ $guru->nama_guru ?? '-' }}</span>
                        <span class="text-muted fs-7 mb-1">{{ $guru->email ?? '-' }}</span>

                        <div class="d-flex align-items-center gap-2">
                            {{-- Jenis Kelamin --}}
                            @if ($guru->jenis_kelamin === 'L')
                                <span class="badge badge-light-primary">Laki-laki</span>
                            @elseif ($guru->jenis_kelamin === 'P')
                                <span class="badge badge-light-danger">Perempuan</span>
                            @else
                                <span class="badge badge-light">-</span>
                            @endif

                            {{-- Sekolah --}}
                            @if ($guru->sekolah?->nama_sekolah)
                                <span class="badge badge-light-success">{{ $guru->sekolah->nama_sekolah }}</span>
                            @endif

                            {{-- Jabatan --}}
                            @if ($guru->jabatan)
                                <span class="badge badge-light-info">{{ $guru->jabatan }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="separator my-5"></div>

                {{-- Detail fields --}}
                <div class="row g-5">
                    <div class="col-md-6">
                        {{-- Username --}}
                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">Username</span>
                            <span class="fw-bold fs-6 text-gray-800">{{ $guru->user->username ?? '-' }}</span>
                        </div>

                        {{-- Status --}}
                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">Status</span>

                            @if ($statusUser === 'aktif')
                                <span class="badge badge-light-success">Aktif</span>
                            @elseif ($statusUser === 'non_aktif')
                                <span class="badge badge-light-danger">Tidak Aktif</span>
                            @else
                                <span class="badge badge-light">-</span>
                            @endif
                        </div>

                        {{-- NIK --}}
                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">NIK</span>
                            <span class="fw-bold fs-6 text-gray-800">{{ $guru->nik ?? '-' }}</span>
                        </div>

                        {{-- NIPA --}}
                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">NIPA</span>
                            <span class="fw-bold fs-6 text-gray-800">{{ $guru->nipa ?? '-' }}</span>
                        </div>

                        {{-- No HP --}}
                        <div class="d-flex flex-column mb-0">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">No HP</span>
                            <span class="fw-bold fs-6 text-gray-800">{{ $guru->no_hp ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{-- Tempat, Tanggal Lahir --}}
                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">
                                Tempat, Tanggal Lahir
                            </span>
                            <span class="fw-bold fs-6 text-gray-800">
                                {{ $guru->tempat_lahir ?? '-' }},
                                {{ $guru->tanggal_lahir ? \Carbon\Carbon::parse($guru->tanggal_lahir)->format('d-m-Y') : '-' }}
                            </span>
                        </div>

                        {{-- Pendidikan Terakhir --}}
                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">
                                Pendidikan Terakhir
                            </span>
                            <span class="fw-bold fs-6 text-gray-800">
                                {{ $guru->pend_terakhir ?? '-' }}
                            </span>
                        </div>

                        {{-- Jurusan --}}
                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">
                                Jurusan
                            </span>
                            <span class="fw-bold fs-6 text-gray-800">
                                {{ $guru->jurusan ?? '-' }}
                            </span>
                        </div>

                        {{-- Tanggal Masuk --}}
                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">
                                Tanggal Masuk
                            </span>
                            <span class="fw-bold fs-6 text-gray-800">
                                {{ $guru->tanggal_masuk ? \Carbon\Carbon::parse($guru->tanggal_masuk)->format('d-m-Y') : '-' }}
                            </span>
                        </div>

                        {{-- Alamat --}}
                        <div class="d-flex flex-column mb-0">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">Alamat</span>
                            <span class="fw-normal fs-6 text-gray-800">
                                {{ $guru->alamat ?? '-' }}
                            </span>
                        </div>
                    </div>
                </div>

            </div> {{-- end body --}}
        </div>
    </div>
</div>
