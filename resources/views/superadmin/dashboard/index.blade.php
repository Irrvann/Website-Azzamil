@extends('layouts.app')

@section('content')
    <!--begin::Main-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Dashboard Superadmin
                    </h1>
                </div>

                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <form method="GET" action="{{ route('superadmin.dashboard') }}"
                        class="d-flex align-items-center gap-2">
                        <input type="month" name="periode" class="form-control form-control-sm"
                            value="{{ $periode ?? now()->format('Y-m') }}" style="width: 160px;" />
                        <button class="btn btn-sm fw-bold btn-secondary">Terapkan</button>
                    </form>
                </div>
            </div>
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">

                <div class="row gy-5 gx-xl-10 mb-5 mb-xl-10">
                    <div class="col-sm-6 col-xl-3">
                        <div class="card h-lg-100">
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                <div class="m-0">
                                    <i class="ki-duotone ki-map fs-2hx text-gray-600">
                                        <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                                    </i>
                                </div>
                                <div class="d-flex flex-column my-7">
                                    <span class="fw-semibold fs-3x text-gray-800">{{ $totalDaerah }}</span>
                                    <span class="fw-semibold fs-6 text-gray-500">Daerah</span>
                                </div>
                                <a href="/superadmin/data-daerah" class="badge badge-light-primary">Kelola</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card h-lg-100">
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                <div class="m-0">
                                    <i class="ki-duotone ki-user fs-2hx text-gray-600">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </div>
                                <div class="d-flex flex-column my-7">
                                    <span class="fw-semibold fs-3x text-gray-800">{{ $totalAdmin }}</span>
                                    <span class="fw-semibold fs-6 text-gray-500">Admin</span>
                                </div>
                                <a href="/superadmin/data-admin" class="badge badge-light-primary">Kelola</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card h-lg-100">
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                <div class="m-0">
                                    <i class="ki-duotone ki-verify fs-2hx text-gray-600">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </div>
                                <div class="d-flex flex-column my-7">
                                    <span class="fw-semibold fs-3x text-gray-800">{{ $totalReviewer }}</span>
                                    <span class="fw-semibold fs-6 text-gray-500">Reviewer</span>
                                </div>
                                <a href="/superadmin/data-reviewer" class="badge badge-light-primary">Kelola</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card h-lg-100">
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                <div class="m-0">
                                    <i class="ki-duotone ki-home fs-2hx text-gray-600"></i>
                                </div>
                                <div class="d-flex flex-column my-7">
                                    <span class="fw-semibold fs-3x text-gray-800">{{ $totalSekolah }}</span>
                                    <span class="fw-semibold fs-6 text-gray-500">Sekolah</span>
                                </div>
                                <a href="/superadmin/data-sekolah" class="badge badge-light-primary">Kelola</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row gy-5 gx-xl-10 mb-5 mb-xl-10">
                    <div class="col-sm-6 col-xl-4">
                        <div class="card h-lg-100">
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                <div class="m-0">
                                    <i class="ki-duotone ki-teacher fs-2hx text-gray-600">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </div>
                                <div class="d-flex flex-column my-7">
                                    <span class="fw-semibold fs-3x text-gray-800">{{ $totalGuru }}</span>
                                    <span class="fw-semibold fs-6 text-gray-500">Guru</span>
                                </div>
                                <a href="/superadmin/data-guru" class="badge badge-light-primary">Kelola</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-4">
                        <div class="card h-lg-100">
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                <div class="m-0">
                                    <i class="ki-duotone ki-people fs-2hx text-gray-600">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </div>
                                <div class="d-flex flex-column my-7">
                                    <span class="fw-semibold fs-3x text-gray-800">{{ $totalOrangTua }}</span>
                                    <span class="fw-semibold fs-6 text-gray-500">Orang Tua</span>
                                </div>
                                <a href="/superadmin/data-orang-tua" class="badge badge-light-primary">Kelola</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-4">
                        <div class="card h-lg-100">
                            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                                <div class="m-0">
                                    <i class="ki-duotone ki-emoji-happy fs-2hx text-gray-600">
                                        <span class="path1"></span><span class="path2"></span><span
                                            class="path3"></span>
                                    </i>
                                </div>
                                <div class="d-flex flex-column my-7">
                                    <span class="fw-semibold fs-3x text-gray-800">{{ $totalAnak }}</span>
                                    <span class="fw-semibold fs-6 text-gray-500">Anak</span>
                                </div>
                                <a href="/superadmin/data-anak" class="badge badge-light-primary">Kelola</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                    <div class="col-xl-6">
                        <div class="card h-100">
                            <div class="card-body p-6">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="symbol symbol-40px symbol-circle bg-light-info">
                                            <i class="ki-duotone ki-chart-line-up fs-2 text-info">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-gray-900">Progress Tumbuh Kembang (Global)</span>
                                            <span class="text-muted fs-8">Periode {{ $periodeLabel }}</span>
                                        </div>
                                    </div>
                                    <span class="badge badge-light-info">{{ $tkProgress }}%</span>
                                </div>

                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge badge-light-success">Selesai: {{ $tkSelesai }}</span>
                                    <span class="badge badge-light-warning">Belum: {{ $tkBelum }}</span>
                                    <span class="badge badge-light">Total: {{ $totalAnak }}</span>
                                </div>

                                <div class="progress h-6px bg-light mb-4">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $tkProgress }}%"
                                        aria-valuenow="{{ $tkProgress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                                <a href="/superadmin/data-tumbuh-kembang" class="btn btn-sm btn-light-info w-100">
                                    Ke Data Tumbuh Kembang
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card h-100">
                            <div class="card-body p-6">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="symbol symbol-40px symbol-circle bg-light-danger">
                                            <i class="ki-duotone ki-document fs-2 text-danger">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-gray-900">Progress Raport (Global)</span>
                                            <span class="text-muted fs-8">Periode {{ $periodeLabel }}</span>
                                        </div>
                                    </div>
                                    <span class="badge badge-light-danger">{{ $raportProgress }}%</span>
                                </div>

                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge badge-light-success">Selesai: {{ $raportSelesai }}</span>
                                    <span class="badge badge-light-warning">Belum: {{ $raportBelum }}</span>
                                    <span class="badge badge-light">Total: {{ $totalAnak }}</span>
                                </div>

                                <div class="progress h-6px bg-light mb-4">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width: {{ $raportProgress }}%" aria-valuenow="{{ $raportProgress }}"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                                <a href="/superadmin/data-raport" class="btn btn-sm btn-light-danger w-100">
                                    Ke Data Raport
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                    <div class="col-xl-6">
                        <div class="card h-100">
                            <div class="card-body p-6">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="symbol symbol-40px symbol-circle bg-light-warning">
                                            <i class="ki-duotone ki-shield-tick fs-2 text-warning">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-gray-900">DDST Perlu Evaluasi</span>
                                            <span class="text-muted fs-8">Global alert</span>
                                        </div>
                                    </div>
                                    <span class="badge badge-light-warning">Prioritas</span>
                                </div>

                                <div class="fs-2hx fw-bold text-gray-900 lh-1">{{ $ddstPerluEvaluasi }}</div>
                                <div class="text-gray-500 fs-8 mt-1">Anak perlu tindak lanjut</div>

                                <div class="separator separator-dashed my-4"></div>

                                <a href="/superadmin/data-tumbuh-kembang" class="btn btn-sm btn-light-warning w-100">
                                    Lihat Detail DDST
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card h-100">
                            <div class="card-body p-6">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="symbol symbol-40px symbol-circle bg-light-success">
                                            <i class="ki-duotone ki-heart fs-2 text-success">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-gray-900">Status Gizi Tidak Normal</span>
                                            <span class="text-muted fs-8">Global alert</span>
                                        </div>
                                    </div>
                                    <span class="badge badge-light-success">Monitoring</span>
                                </div>

                                <div class="fs-2hx fw-bold text-gray-900 lh-1">{{ $giziTidakNormal }}</div>
                                <div class="text-gray-500 fs-8 mt-1">Anak butuh perhatian</div>

                                <div class="separator separator-dashed my-4"></div>

                                <a href="/superadmin/data-tumbuh-kembang" class="btn btn-sm btn-light-success w-100">
                                    Lihat Antropometri
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                    <div class="col-xl-6">
                        <div class="card card-flush h-100">
                            <div class="card-header pt-7">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-900">Jumlah Anak per Daerah</span>
                                    <span class="text-gray-500 pt-2 fw-semibold fs-6">Top daerah berdasarkan jumlah
                                        anak</span>
                                </h3>
                                <div class="card-toolbar">
                                    <span class="badge badge-light-primary">Periode: {{ $periodeLabel }}</span>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div id="kt_chart_anak_per_daerah" class="w-100 h-350px"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card card-flush h-100">
                            <div class="card-header pt-7">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-900">Distribusi Status Gizi (Global)</span>
                                    <span class="text-gray-500 pt-2 fw-semibold fs-6">Ringkasan antropometri</span>
                                </h3>
                                <div class="card-toolbar">
                                    <span class="badge badge-light-success">Total: {{ $totalAnak }} anak</span>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div id="kt_chart_gizi_global" class="w-100 h-350px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">

                    <div class="col-xl-12">
                        <div class="card card-flush h-100">
                            <div class="card-header pt-7">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-900">Tren Pertumbuhan Sistem</span>
                                    <span class="text-gray-500 pt-2 fw-semibold fs-6">Anak & sekolah per bulan</span>
                                </h3>
                                <div class="card-toolbar">
                                    <span class="badge badge-light-dark">6 bulan terakhir</span>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div id="kt_chart_tren_sistem" class="w-100 h-350px"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-5 g-xl-10">
                    <div class="col-12">
                        <div class="card card-flush">
                            <div class="card-header pt-7">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-900">Monitoring Performa Daerah</span>
                                    <span class="text-gray-500 pt-2 fw-semibold fs-6">
                                        TK = Tumbuh Kembang, Raport = kelengkapan raport
                                    </span>
                                </h3>
                                <div class="card-toolbar">
                                    <a href="/superadmin/data-daerah" class="btn btn-sm btn-light-primary">
                                        Kelola Daerah
                                    </a>
                                </div>
                            </div>

                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <thead>
                                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                <th>Daerah</th>
                                                <th class="text-end">Sekolah</th>
                                                <th class="text-end">Anak</th>
                                                <th class="text-end">Tumbuh Kembang (%)</th>
                                                <th class="text-end">Raport (%)</th>
                                                <th class="text-end">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 fw-semibold">
                                            @forelse ($monitorDaerah as $row)
                                                @php $st = $badgeStatus((int) $row['tk'], (int) $row['raport']); @endphp
                                                <tr>
                                                    <td class="text-gray-800 fw-bold">{{ $row['daerah'] }}</td>
                                                    <td class="text-end">{{ $row['sekolah'] }}</td>
                                                    <td class="text-end">{{ $row['anak'] }}</td>
                                                    <td class="text-end">
                                                        <span class="badge badge-light-info">{{ $row['tk'] }}%</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <span
                                                            class="badge badge-light-danger">{{ $row['raport'] }}%</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <span
                                                            class="badge {{ $st['class'] }}">{{ $st['label'] }}</span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center text-gray-500 py-10">
                                                        Belum ada data daerah.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--end::Content-->
    </div>
    <!--end::Main-->

    @push('scripts')
        <script>
            (function() {
                if (typeof ApexCharts === "undefined") {
                    console.warn("ApexCharts belum ter-load.");
                    return;
                }

                const anakPerDaerahLabels = @json(array_column($anakPerDaerah, 'label'));
                const anakPerDaerahSeries = @json(array_column($anakPerDaerah, 'value'));

                const giziLabels = @json(array_column($giziChart, 'label'));
                const giziSeries = @json(array_column($giziChart, 'value'));

                const trenBulan = @json($trenBulan);
                const trenAnak = @json($trenAnak);
                const trenSekolah = @json($trenSekolah);

                const elAnak = document.querySelector('#kt_chart_anak_per_daerah');
                if (elAnak) {
                    const chartAnak = new ApexCharts(elAnak, {
                        chart: {
                            type: 'bar',
                            height: 350,
                            toolbar: {
                                show: false
                            }
                        },
                        series: [{
                            name: 'Jumlah Anak',
                            data: anakPerDaerahSeries
                        }],
                        xaxis: {
                            categories: anakPerDaerahLabels
                        },
                        plotOptions: {
                            bar: {
                                borderRadius: 8,
                                columnWidth: '55%'
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        tooltip: {
                            y: {
                                formatter: (v) => `${v} anak`
                            }
                        }
                    });
                    chartAnak.render();
                }

                const elGizi = document.querySelector('#kt_chart_gizi_global');
                if (elGizi) {
                    const chartGizi = new ApexCharts(elGizi, {
                        chart: {
                            type: 'donut',
                            height: 350,
                            toolbar: {
                                show: false
                            }
                        },
                        series: giziSeries,
                        labels: giziLabels,
                        legend: {
                            position: 'bottom'
                        },
                        dataLabels: {
                            enabled: true
                        },
                        tooltip: {
                            y: {
                                formatter: (v) => `${v} anak`
                            }
                        }
                    });
                    chartGizi.render();
                }


                const elTren = document.querySelector('#kt_chart_tren_sistem');
                if (elTren) {
                    const chartTren = new ApexCharts(elTren, {
                        chart: {
                            type: 'line',
                            height: 350,
                            toolbar: {
                                show: false
                            }
                        },
                        series: [{
                            name: 'Total Anak',
                            data: trenAnak
                        }, {
                            name: 'Total Sekolah',
                            data: trenSekolah
                        }],
                        xaxis: {
                            categories: trenBulan
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
                    chartTren.render();
                }
            })();
        </script>
    @endpush
@endsection
