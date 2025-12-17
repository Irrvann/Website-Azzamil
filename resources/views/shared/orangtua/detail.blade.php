@php
    $statusUser = $orangTua->user->status ?? null;
@endphp

<div class="modal fade" id="modal_detail_orangtua_{{ $orangTua->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            {{-- Header --}}
            <div class="modal-header">
                <div class="d-flex flex-column">
                    <h2 class="fw-bold mb-1">Detail Orang Tua</h2>
                    <span class="text-muted fs-7">Informasi lengkap orang tua yang terdaftar di sistem</span>
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
                    {{-- <div class="symbol symbol-60px symbol-circle me-4">
                        <div class="symbol-label">
                            <i class="ki-duotone ki-user fs-1"></i>
                        </div>
                    </div> --}}

                    <div class="d-flex flex-column">
                        <span class="fw-bold fs-4">
                            {{ $orangTua->nama_ayah ?? '-' }} &amp; {{ $orangTua->nama_ibu ?? '-' }}
                        </span>
                        <span class="text-muted fs-7">
                            {{ $orangTua->alamat ?? '-' }}
                        </span>

                        <div class="d-flex align-items-center gap-2 mt-2">
                            {{-- Status User --}}
                            @if ($statusUser === 'aktif')
                                <span class="badge badge-light-success">Akun Aktif</span>
                            @elseif ($statusUser === 'non_aktif')
                                <span class="badge badge-light-danger">Akun Tidak Aktif</span>
                            @else
                                <span class="badge badge-light">Status tidak diketahui</span>
                            @endif

                            {{-- Username --}}
                            @if ($orangTua->user?->username)
                                <span class="badge badge-light-primary">
                                    Username: {{ $orangTua->user->username }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="separator my-5"></div>

                {{-- Detail fields --}}
                <div class="row g-5">
                    <div class="col-md-6">
                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">NIK Ayah</span>
                            <span class="fw-bold fs-6 text-gray-800">
                                {{ $orangTua->nik_ayah ?? '-' }}
                            </span>
                        </div>
                        {{-- Nama Ayah --}}
                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">Nama Ayah</span>
                            <span class="fw-bold fs-6 text-gray-800">
                                {{ $orangTua->nama_ayah ?? '-' }}
                            </span>
                        </div>

                        {{-- No HP Ayah --}}
                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">No HP Ayah</span>
                            <span class="fw-bold fs-6 text-gray-800">
                                {{ $orangTua->no_hp_ayah ?? '-' }}
                            </span>
                        </div>
                    </div>

                    <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">NIK Ibu</span>
                            <span class="fw-bold fs-6 text-gray-800">
                                {{ $orangTua->nik_ibu ?? '-' }}
                            </span>
                        </div>
                    <div class="col-md-6">
                        {{-- Nama Ibu --}}
                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">Nama Ibu</span>
                            <span class="fw-bold fs-6 text-gray-800">
                                {{ $orangTua->nama_ibu ?? '-' }}
                            </span>
                        </div>

                        {{-- No HP Ibu --}}
                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">No HP Ibu</span>
                            <span class="fw-bold fs-6 text-gray-800">
                                {{ $orangTua->no_hp_ibu ?? '-' }}
                            </span>
                        </div>
                    </div>

                    <div class="col-12">
                        {{-- Alamat --}}
                        <div class="d-flex flex-column mb-0">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">Alamat Lengkap</span>
                            <span class="fw-normal fs-6 text-gray-800">
                                {{ $orangTua->alamat ?? '-' }}
                            </span>
                        </div>
                    </div>
                </div>

            </div> {{-- end body --}}
        </div>
    </div>
</div>
