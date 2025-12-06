@php
    $foto = $admin->foto;
    if (\Illuminate\Support\Str::startsWith($foto, 'foto_admin/')) {
        $srcFoto = asset('storage/' . $foto);
    } else {
        $srcFoto = asset($foto);
    }
@endphp

<div class="modal fade" id="modal_detail_admin_{{ $admin->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            {{-- Header --}}
            <div class="modal-header">
                <div class="d-flex flex-column">
                    <h2 class="fw-bold mb-1">Detail Admin</h2>
                    <span class="text-muted fs-7">Informasi lengkap admin yang terdaftar di sistem</span>
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
                        <img src="{{ $srcFoto }}" alt="Foto Admin" style="object-fit: cover;">
                    </div>
                    <div class="d-flex flex-column">
                        <span class="fw-bold fs-4">{{ $admin->nama }}</span>
                        <span class="text-muted fs-7 mb-1">{{ $admin->email ?? '-' }}</span>
                        <div class="d-flex align-items-center gap-2">
                            @if ($admin->jenis_kelamin === 'L')
                                <span class="badge badge-light-primary">Laki-laki</span>
                            @elseif ($admin->jenis_kelamin === 'P')
                                <span class="badge badge-light-danger">Perempuan</span>
                            @else
                                <span class="badge badge-light">-</span>
                            @endif

                            @if ($admin->daerah?->nama_daerah)
                                <span class="badge badge-light-success">{{ $admin->daerah->nama_daerah }}</span>
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
                            <span class="fw-bold fs-6 text-gray-800">{{ $admin->user->username ?? '-' }}</span>
                        </div>

                        {{-- Status --}}
                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">Status</span>

                            @php
                                $status = $admin->user->status ?? null;
                            @endphp

                            @if ($status === 'aktif')
                                <span class="badge badge-light-success">Aktif</span>
                            @elseif ($status === 'non_aktif')
                                <span class="badge badge-light-danger">Tidak Aktif</span>
                            @else
                                <span class="badge badge-light">-</span>
                            @endif
                        </div>
                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">NIK</span>
                            <span class="fw-bold fs-6 text-gray-800">{{ $admin->nik ?? '-' }}</span>
                        </div>

                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">NIPA</span>
                            <span class="fw-bold fs-6 text-gray-800">{{ $admin->nipa ?? '-' }}</span>
                        </div>

                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">No HP</span>
                            <span class="fw-bold fs-6 text-gray-800">{{ $admin->no_hp ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">Tempat, Tanggal
                                Lahir</span>
                            <span class="fw-bold fs-6 text-gray-800">
                                {{ $admin->tempat_lahir ?? '-' }},
                                {{ $admin->tanggal_lahir ? \Carbon\Carbon::parse($admin->tanggal_lahir)->format('d-m-Y') : '-' }}
                            </span>
                        </div>

                        <div class="d-flex flex-column mb-4">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">Daerah</span>
                            <span class="fw-bold fs-6 text-gray-800">
                                {{ $admin->daerah->nama_daerah ?? '-' }}
                            </span>
                        </div>

                        <div class="d-flex flex-column mb-0">
                            <span class="text-gray-600 fw-semibold fs-8 text-uppercase mb-1">Alamat</span>
                            <span class="fw-normal fs-6 text-gray-800">
                                {{ $admin->alamat ?? '-' }}
                            </span>
                        </div>
                    </div>
                </div>

            </div> {{-- end body --}}
        </div>
    </div>
</div>
