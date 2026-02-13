@extends('layouts.app')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">

        <!-- Toolbar -->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Dashboard Orang Tua
                    </h1>
                    
                </div>

                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!-- Filter Anak (submit otomatis via GET) -->
                    <form method="GET" action="{{ route('orang_tua.dashboard') }}"
                        class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center">
                            <label class="fs-7 fw-semibold text-gray-600 me-3 d-none d-md-inline">Pilih Anak</label>
                            <select name="anak_id" class="form-select form-select-sm w-250px" data-control="select2"
                                data-placeholder="Pilih anak" onchange="this.form.submit()">
                                <option></option>
                                @foreach ($anakList as $a)
                                    <option value="{{ $a->id }}"
                                        {{ (string) $selectedAnakId === (string) $a->id ? 'selected' : '' }}>
                                        {{ $a->nama_anak }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">

                @if (!$anak)
                    <div class="alert alert-warning">
                        Tidak ada data anak untuk ditampilkan.
                    </div>
                @else
                    <!-- Summary Cards -->
                    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">

                        <!-- Card 1: DDST Belum Tercapai -->
                        <div class="col-sm-6 col-xl-3">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column p-6">

                                    <!-- header -->
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="symbol symbol-40px symbol-circle bg-light-primary">
                                                <i class="ki-duotone ki-badge fs-2 text-primary">
                                                    <span class="path1"></span><span class="path2"></span><span
                                                        class="path3"></span>
                                                </i>
                                            </span>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold text-gray-900">DDST</span>
                                                <span class="text-muted fs-8">Item belum tercapai</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- main -->
                                    <div class="d-flex align-items-end justify-content-between mb-4">
                                        <div>
                                            <div class="fs-2hx fw-bold text-gray-900 lh-1">{{ $ddstRaguTotal }}</div>
                                            <div class="text-gray-500 fs-8 mt-1">Total item belum tercapai</div>
                                        </div>

                                    </div>

                                    <div class="separator separator-dashed my-4"></div>

                                    <!-- detail -->
                                    <div class="d-flex flex-wrap gap-2 mb-6">
                                        @forelse($ddstRaguPerDomain as $d)
                                            <span class="badge badge-light-primary">
                                                {{ $d->kategori_perkembangan }}: {{ $d->total }}
                                            </span>
                                        @empty
                                            <span class="text-gray-500 fs-7">Belum ada data / tidak ada status belum
                                                tercapai.</span>
                                        @endforelse
                                    </div>

                                    <!-- action -->
                                    <a href="/orang_tua/data-tumbuh-kembang"
                                        class="btn btn-sm btn-light-primary w-100 mt-auto">
                                        Lihat Detail DDST
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Status fisik & gizi -->
                        <div class="col-sm-6 col-xl-3">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column p-6">

                                    @php
                                        $statusMap = [
                                            'normal' => 'Normal',
                                            'gizi_kurang' => 'Gizi Kurang',
                                            'gizi_berlebih' => 'Gizi Berlebih',
                                        ];
                                        $labelGizi = $statusMap[$antroTerbaru->status_gizi] ?? '-';
                                    @endphp

                                    <!-- header -->
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="symbol symbol-40px symbol-circle bg-light-success">
                                                <i class="ki-duotone ki-heart fs-2 text-success">
                                                    <span class="path1"></span><span class="path2"></span>
                                                </i>
                                            </span>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold text-gray-900">Status Gizi</span>
                                                <span class="text-muted fs-8">
                                                    Ukur terakhir:
                                                    {{ optional($antroTerbaru?->tanggal_ukur)->format('d-m-Y') ?? '-' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- main -->
                                    <div class="d-flex align-items-end justify-content-between mb-4">
                                        <div>
                                            <div class="fs-2 fw-bold text-gray-900 lh-1">{{ $labelGizi }}</div>
                                            <div class="text-gray-500 fs-8 mt-1">Ringkasan fisik & gizi</div>
                                        </div>

                                    </div>

                                    <div class="separator separator-dashed my-4"></div>

                                    <!-- detail (lebih rapih: 2 kolom) -->
                                    <div class="row g-3 mb-6">
                                        <div class="col-6">
                                            <div class="text-gray-500 fs-8">BB/U</div>
                                            <div class="fw-bold text-gray-900">{{ $antroTerbaru->status_bb ?? '-' }}</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-gray-500 fs-8">TB/U</div>
                                            <div class="fw-bold text-gray-900">{{ $antroTerbaru->status_tb ?? '-' }}</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-gray-500 fs-8">BB (kg)</div>
                                            <div class="fw-bold text-gray-900">{{ $antroTerbaru->berat_badan ?? '-' }}
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-gray-500 fs-8">TB (cm)</div>
                                            <div class="fw-bold text-gray-900">{{ $antroTerbaru->tinggi_badan ?? '-' }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- action -->
                                    <a href="/orang_tua/data-tumbuh-kembang"
                                        class="btn btn-sm btn-light-success w-100 mt-auto">
                                        Lihat Tumbuh Kembang
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: Kehadiran -->
                        @php
                            $totalTidakHadir =
                                ($kehadiran['sakit'] ?? 0) +
                                ($kehadiran['izin'] ?? 0) +
                                ($kehadiran['tanpa_keterangan'] ?? 0);
                        @endphp

                        <div class="col-sm-6 col-xl-3">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column p-6">

                                    <!-- header -->
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="symbol symbol-40px symbol-circle bg-light-info">
                                                <i class="ki-duotone ki-calendar fs-2 text-info">
                                                    <span class="path1"></span><span class="path2"></span><span
                                                        class="path3"></span>
                                                </i>
                                            </span>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold text-gray-900">Kehadiran</span>
                                                <span class="text-muted fs-8">Raport terbaru</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- main -->
                                    <div class="d-flex align-items-end justify-content-between mb-4">
                                        <div>
                                            <div class="fs-2hx fw-bold text-gray-900 lh-1">{{ $totalTidakHadir }}</div>
                                            <div class="text-gray-500 fs-8 mt-1">Total tidak hadir</div>
                                        </div>

                                    </div>

                                    <div class="separator separator-dashed my-4"></div>

                                    <!-- detail -->
                                    <div class="d-flex flex-wrap gap-2 mb-3">
                                        <span class="badge badge-light-warning">Sakit:
                                            {{ $kehadiran['sakit'] ?? 0 }}</span>
                                        <span class="badge badge-light-info">Izin: {{ $kehadiran['izin'] ?? 0 }}</span>
                                        <span class="badge badge-light-danger">Tanpa Ket.:
                                            {{ $kehadiran['tanpa_keterangan'] ?? 0 }}</span>
                                    </div>

                                    <div class="text-gray-500 fs-8 mb-6">
                                        Data diambil dari raport terakhir (semester & tahun ajaran terkait).
                                    </div>

                                    <!-- action -->
                                    <a href="/orang_tua/data-raport" class="btn btn-sm btn-light-info w-100 mt-auto">
                                        Lihat Detail Raport
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4: Refleksi guru -->
                        <div class="col-sm-6 col-xl-3">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column p-6">

                                    <!-- header -->
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="symbol symbol-40px symbol-circle bg-light-dark">
                                                <i class="ki-duotone ki-message-text-2 fs-2 text-gray-700">
                                                    <span class="path1"></span><span class="path2"></span><span
                                                        class="path3"></span>
                                                </i>
                                            </span>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold text-gray-900">Refleksi Guru</span>
                                                <span class="text-muted fs-8">Raport terbaru</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- content -->
                                    <div class="mb-4">
                                        <div class="text-gray-500 fs-8 mb-2">Catatan singkat</div>
                                        <div class="text-gray-800 fw-semibold">
                                            {{ $refleksiGuru ? \Illuminate\Support\Str::limit(strip_tags($refleksiGuru), 110) : 'Belum ada refleksi guru.' }}
                                        </div>
                                    </div>

                                    <div class="separator separator-dashed my-4"></div>

                                    <!-- action: trigger modal -->
                                    <button type="button" class="btn btn-sm btn-light-dark w-100 mt-auto"
                                        data-bs-toggle="modal" data-bs-target="#modalRefleksiGuru"
                                        @if (!$refleksiGuru) disabled @endif>
                                        Lihat Detail Refleksi
                                    </button>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal fade" id="modalRefleksiGuru" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="fw-bold mb-0">Refleksi Guru</h2>
                                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary"
                                        data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ki-duotone ki-cross fs-1">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div class="text-gray-700 fs-6"
                                        style="white-space: pre-wrap; overflow-wrap: anywhere; word-break: break-word;">
                                        {{ $refleksiGuru ? strip_tags($refleksiGuru) : 'Belum ada refleksi guru.' }}
                                    </div>
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                    <a href="/orang_tua/data-raport" class="btn btn-primary">Ke halaman raport</a>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Detail Anak + Info Sekolah -->
                    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">

                        <div class="col-xl-6">
                            <div class="card card-flush h-100">
                                <div class="card-header pt-7">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-gray-900">Detail Anak</span>
                                        <span class="text-gray-500 pt-2 fw-semibold fs-6">Data identitas siswa</span>
                                    </h3>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="d-flex flex-column gap-4">
                                        <div class="d-flex justify-content-between">
                                            <span class="text-gray-600 fw-semibold">Nama</span>
                                            <span class="text-gray-800 fw-bold">{{ $anak->nama_anak }}</span>
                                        </div>
                                        <div class="separator separator-dashed"></div>

                                        <div class="d-flex justify-content-between">
                                            <span class="text-gray-600 fw-semibold">NIK</span>
                                            <span class="text-gray-800 fw-bold">{{ $anak->nik ?? '-' }}</span>
                                        </div>
                                        <div class="separator separator-dashed"></div>

                                        <div class="d-flex justify-content-between">
                                            <span class="text-gray-600 fw-semibold">NIPD</span>
                                            <span class="text-gray-800 fw-bold">{{ $anak->nipd ?? '-' }}</span>
                                        </div>
                                        <div class="separator separator-dashed"></div>

                                        <div class="d-flex justify-content-between">
                                            <span class="text-gray-600 fw-semibold">TTL</span>
                                            <span class="text-gray-800 fw-bold">
                                                {{ $anak->tempat_lahir ?? '-' }},
                                                {{ optional($anak->tanggal_lahir)->format('d-m-Y') ?? '-' }}
                                            </span>
                                        </div>
                                        <div class="separator separator-dashed"></div>

                                        <div class="d-flex justify-content-between">
                                            <span class="text-gray-600 fw-semibold">Orang Tua</span>
                                            <span class="text-gray-800 fw-bold">
                                                {{ $anak->orangTua->nama_ayah ?? '-' }}
                                                &
                                                {{ $anak->orangTua->nama_ibu ?? '-' }}
                                            </span>
                                        </div>

                                        <div class="separator separator-dashed"></div>

                                        <div class="d-flex justify-content-between">
                                            <span class="text-gray-600 fw-semibold">Sekolah</span>
                                            <span
                                                class="text-gray-800 fw-bold">{{ $anak->sekolah->nama_sekolah ?? '-' }}</span>
                                        </div>
                                        <div class="separator separator-dashed"></div>

                                        <div class="d-flex justify-content-between">
                                            <span class="text-gray-600 fw-semibold">Jenis Kelamin</span>
                                            <span class="text-gray-800 fw-bold">
                                                @php
                                                    $statusMap = [
                                                        'L' => 'Laki-laki',
                                                        'P' => 'Perempuan',
                                                    ];
                                                @endphp

                                                {{ $statusMap[$anak->jenis_kelamin] ?? '-' }}
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="card card-flush h-100">
                                <div class="card-header pt-7">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-gray-900">Informasi Sekolah</span>
                                        <span class="text-gray-500 pt-2 fw-semibold fs-6">Penanggung jawab akademik</span>
                                    </h3>
                                </div>

                                <div class="card-body pt-0">
                                    <div class="row g-5">

                                        <div class="col-md-6">
                                            <div class="border border-gray-300 border-dashed rounded p-5 h-100">
                                                <div class="d-flex align-items-center mb-3">
                                                    <i class="ki-duotone ki-user-square fs-2 text-gray-600 me-3">
                                                        <span class="path1"></span><span class="path2"></span>
                                                    </i>
                                                    <span class="fw-bold text-gray-900">Kepala Sekolah</span>
                                                </div>
                                                <div class="d-flex flex-column gap-2">
                                                    <div class="d-flex justify-content-between">
                                                        <span class="text-gray-600 fw-semibold">Nama</span>
                                                        <span class="text-gray-800 fw-bold">-</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <span class="text-gray-600 fw-semibold">NIP</span>
                                                        <span class="text-gray-800 fw-bold">-</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="border border-gray-300 border-dashed rounded p-5 h-100">
                                                <div class="d-flex align-items-center mb-3">
                                                    <i class="ki-duotone ki-teacher fs-2 text-gray-600 me-3">
                                                        <span class="path1"></span><span class="path2"></span><span
                                                            class="path3"></span>
                                                    </i>
                                                    <span class="fw-bold text-gray-900">Guru / Wali Kelas</span>
                                                </div>
                                                <div class="d-flex flex-column gap-2">
                                                    <div class="d-flex justify-content-between">
                                                        <span class="text-gray-600 fw-semibold">Nama</span>
                                                        <span
                                                            class="text-gray-800 fw-bold">{{ $guruTerbaru->nama_guru ?? '-' }}</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <span class="text-gray-600 fw-semibold">NIP</span>
                                                        <span
                                                            class="text-gray-800 fw-bold">{{ $guruTerbaru->nipa ?? '-' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Charts -->
                    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                        <div class="col-xl-6">
                            <div class="card card-flush h-100">
                                <div class="card-header pt-7">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-gray-900">Berat Badan vs Usia</span>
                                        <span class="text-gray-500 pt-2 fw-semibold fs-6">Grafik antropometri</span>
                                    </h3>
                                    <div class="card-toolbar">
                                        <span class="badge badge-light-success">Status:
                                            {{ $antroTerbaru->status_bb ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div id="kt_chart_bb_vs_usia" class="w-100 h-350px"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="card card-flush h-100">
                                <div class="card-header pt-7">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-gray-900">Tinggi Badan vs Usia</span>
                                        <span class="text-gray-500 pt-2 fw-semibold fs-6">Grafik antropometri</span>
                                    </h3>
                                    <div class="card-toolbar">
                                        <span class="badge badge-light-success">Status:
                                            {{ $antroTerbaru->status_tb ?? '-' }}</span>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div id="kt_chart_tb_vs_usia" class="w-100 h-350px"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-5 g-xl-10">
                        <div class="col-12">
                            <div class="card card-flush overflow-hidden h-md-100">
                                <div class="card-header py-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-gray-900">Total Indikator Belum Tercapai per
                                            Bulan</span>
                                        <span class="text-gray-500 mt-1 fw-semibold fs-6">Trend DDST</span>
                                    </h3>
                                </div>
                                <div class="card-body pt-0">
                                    <div id="kt_chart_ddst_delay_bulanan" class="h-400px w-100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ApexCharts render --}}
    @push('scripts')
        <script>
            (function() {
                const antroSeries = @json($antroSeries);
                const delayBulanan = @json($delayBulanan);

                // BB vs Usia
                const bbData = antroSeries
                    .filter(x => x.usia_bulan !== null)
                    .map(x => ({
                        x: x.usia_bulan,
                        y: x.berat_badan
                    }));

                // TB vs Usia
                const tbData = antroSeries
                    .filter(x => x.usia_bulan !== null)
                    .map(x => ({
                        x: x.usia_bulan,
                        y: x.tinggi_badan
                    }));

                // Delay per bulan
                const delayCats = delayBulanan.map(x => x.ym);
                const delayVals = delayBulanan.map(x => x.total);

                // Guard: ApexCharts must exist
                if (typeof ApexCharts === "undefined") {
                    console.warn("ApexCharts belum ter-load.");
                    return;
                }

                // Chart BB
                const bbEl = document.querySelector('#kt_chart_bb_vs_usia');
                if (bbEl) {
                    const bbChart = new ApexCharts(bbEl, {
                        chart: {
                            type: 'line',
                            height: 350,
                            toolbar: {
                                show: false
                            }
                        },
                        series: [{
                            name: 'Berat Badan (kg)',
                            data: bbData
                        }],
                        xaxis: {
                            type: 'numeric',
                            title: {
                                text: 'Usia (bulan)'
                            }
                        },
                        yaxis: {
                            title: {
                                text: 'BB (kg)'
                            }
                        },
                        stroke: {
                            width: 3
                        },
                        markers: {
                            size: 4
                        },
                        tooltip: {
                            x: {
                                formatter: (v) => `${v} bln`
                            }
                        }
                    });
                    bbChart.render();
                }

                // Chart TB
                const tbEl = document.querySelector('#kt_chart_tb_vs_usia');
                if (tbEl) {
                    const tbChart = new ApexCharts(tbEl, {
                        chart: {
                            type: 'line',
                            height: 350,
                            toolbar: {
                                show: false
                            }
                        },
                        series: [{
                            name: 'Tinggi Badan (cm)',
                            data: tbData
                        }],
                        xaxis: {
                            type: 'numeric',
                            title: {
                                text: 'Usia (bulan)'
                            }
                        },
                        yaxis: {
                            title: {
                                text: 'TB (cm)'
                            }
                        },
                        stroke: {
                            width: 3
                        },
                        markers: {
                            size: 4
                        },
                        tooltip: {
                            x: {
                                formatter: (v) => `${v} bln`
                            }
                        }
                    });
                    tbChart.render();
                }

                // Chart Delay Bulanan
                const delayEl = document.querySelector('#kt_chart_ddst_delay_bulanan');
                if (delayEl) {
                    const delayChart = new ApexCharts(delayEl, {
                        chart: {
                            type: 'line',
                            height: 400,
                            toolbar: {
                                show: false
                            }
                        },
                        series: [{
                            name: 'Total Delay',
                            data: delayVals
                        }],
                        xaxis: {
                            categories: delayCats
                        },
                        stroke: {
                            width: 3
                        },
                        markers: {
                            size: 4
                        },
                        tooltip: {
                            y: {
                                formatter: (v) => `${v}`
                            }
                        }
                    });
                    delayChart.render();
                }
            })();
        </script>
    @endpush
@endsection
