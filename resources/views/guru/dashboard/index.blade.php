@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">

        <!-- Toolbar -->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">

                <div class="page-title d-flex flex-column justify-content-start me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Dashboard Guru
                    </h1>
                </div>

                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!-- Filter Periode (REAL) -->
                    <form class="d-flex align-items-center gap-3" method="GET" action="{{ url('/guru/dashboard') }}">
                        <div class="d-flex align-items-center">
                            <label class="fs-7 fw-semibold text-gray-600 me-3 d-none d-md-inline">Periode</label>

                            {{-- input month mengirim format YYYY-MM --}}
                            <input type="month" name="periode" value="{{ $periode ?? now()->format('Y-m') }}"
                                class="form-control form-control-sm w-250px" onchange="this.form.submit()">
                        </div>

                        {{-- jaga query semester/tahun_ajaran agar tidak hilang --}}
                        @if (!empty($semester))
                            <input type="hidden" name="semester" value="{{ $semester }}">
                        @endif
                        @if (!empty($tahunAjaran))
                            <input type="hidden" name="tahun_ajaran" value="{{ $tahunAjaran }}">
                        @endif
                    </form>
                </div>

            </div>
        </div>

        <!-- Content -->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">

                <!-- Summary Cards -->
                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">

                    <!-- 1: Total Anak -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column p-6">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="symbol symbol-40px symbol-circle bg-light-primary">
                                            <i class="ki-duotone ki-people fs-2 text-primary">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-gray-900">Total Anak</span>
                                            <span class="text-muted fs-8">Di scope guru</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-end justify-content-between mb-4">
                                    <div>
                                        <div class="fs-2hx fw-bold text-gray-900 lh-1">{{ $totalAnak ?? 0 }}</div>
                                        <div class="text-gray-500 fs-8 mt-1">Total siswa terdata</div>
                                    </div>
                                    <span class="badge badge-light-primary">Aktif</span>
                                </div>

                                <div class="separator separator-dashed my-4"></div>

                                <a href="/guru/data-anak" class="btn btn-sm btn-light-primary w-100 mt-auto">
                                    Lihat Data Anak
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- 2: Tumbuh kembang belum selesai -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column p-6">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="symbol symbol-40px symbol-circle bg-light-info">
                                            <i class="ki-duotone ki-chart-line-up fs-2 text-info">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-gray-900">Tumbuh Kembang</span>
                                            <span class="text-muted fs-8">{{ $bulanLabel ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-end justify-content-between mb-3">
                                    <div>
                                        <div class="fs-2hx fw-bold text-gray-900 lh-1">{{ $tkBelumSelesai ?? 0 }}</div>
                                        <div class="text-gray-500 fs-8 mt-1">Anak belum diinput</div>
                                    </div>
                                    <span
                                        class="badge {{ isset($badgeClass) ? $badgeClass($tkBelumSelesai ?? 0) : 'badge-light' }}">
                                        Progress {{ $tkProgress ?? 0 }}%
                                    </span>
                                </div>

                                <div class="progress h-6px bg-light mb-4">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $tkProgress ?? 0 }}%"
                                        aria-valuenow="{{ $tkProgress ?? 0 }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>

                                <div class="separator separator-dashed my-4"></div>

                                <a href="/guru/data-tumbuh-kembang" class="btn btn-sm btn-light-info w-100 mt-auto">
                                    Ke Tumbuh Kembang
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- 3: Status gizi tidak normal -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column p-6">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="symbol symbol-40px symbol-circle bg-light-success">
                                            <i class="ki-duotone ki-heart fs-2 text-success">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-gray-900">Status Gizi</span>
                                            <span class="text-muted fs-8">Tidak normal</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-end justify-content-between mb-4">
                                    <div>
                                        <div class="fs-2hx fw-bold text-gray-900 lh-1">{{ $giziTidakNormal ?? 0 }}</div>
                                        <div class="text-gray-500 fs-8 mt-1">Butuh perhatian</div>
                                    </div>
                                    <span
                                        class="badge {{ isset($badgeClass) ? $badgeClass($giziTidakNormal ?? 0) : 'badge-light' }}">
                                        Monitoring
                                    </span>
                                </div>

                                <div class="separator separator-dashed my-4"></div>

                                <a href="/guru/data-tumbuh-kembang" class="btn btn-sm btn-light-success w-100 mt-auto">
                                    Lihat Antropometri
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- 4: DDST Perlu evaluasi -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column p-6">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="symbol symbol-40px symbol-circle bg-light-warning">
                                            <i class="ki-duotone ki-shield-tick fs-2 text-warning">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-gray-900">DDST</span>
                                            <span class="text-muted fs-8">Perlu evaluasi</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-end justify-content-between mb-4">
                                    <div>
                                        <div class="fs-2hx fw-bold text-gray-900 lh-1">{{ $ddstPerluEvaluasi ?? 0 }}</div>
                                        <div class="text-gray-500 fs-8 mt-1">Perlu tindak lanjut</div>
                                    </div>
                                    <span
                                        class="badge {{ isset($badgeClass) ? $badgeClass($ddstPerluEvaluasi ?? 0) : 'badge-light' }}">
                                        Prioritas
                                    </span>
                                </div>

                                <div class="separator separator-dashed my-4"></div>

                                <a href="/guru/data-tumbuh-kembang" class="btn btn-sm btn-light-warning w-100 mt-auto">
                                    Lihat DDST
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Row 2: Raport + Deadline -->
                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">

                    <!-- 5: Raport belum selesai -->
                    <div class="col-xl-6">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column p-6">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="symbol symbol-40px symbol-circle bg-light-danger">
                                            <i class="ki-duotone ki-document fs-2 text-danger">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-gray-900">Raport Belum Selesai</span>
                                            <span class="text-muted fs-8">
                                                {{ $semester ?? '-' }} • {{ $tahunAjaran ?? '-' }}
                                            </span>
                                        </div>
                                    </div>
                                    <span
                                        class="badge {{ isset($badgeClass) ? $badgeClass($raportBelumSelesai ?? 0) : 'badge-light' }}">
                                        To-do
                                    </span>
                                </div>

                                <div class="d-flex align-items-end justify-content-between mb-3">
                                    <div>
                                        <div class="fs-2hx fw-bold text-gray-900 lh-1">{{ $raportBelumSelesai ?? 0 }}
                                        </div>
                                        <div class="text-gray-500 fs-8 mt-1">Raport perlu dilengkapi</div>
                                    </div>
                                </div>

                                <div class="text-gray-600 fs-8 mb-4">
                                    Tips: selesaikan yang paling dekat deadline terlebih dulu.
                                </div>

                                <div class="separator separator-dashed my-4"></div>

                                <a href="/guru/data-raport" class="btn btn-sm btn-light-danger w-100 mt-auto">
                                    Ke Halaman Raport
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- 6: Deadline terdekat -->
                    <!-- 6: Catatan Admin -->
                    <div class="col-xl-6">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column p-6">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="symbol symbol-40px symbol-circle bg-light-dark">
                                            <i class="ki-duotone ki-notification-status fs-2 text-gray-700">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-gray-900">Catatan Admin</span>
                                            <span class="text-muted fs-8">Update: {{ $catatanTanggal ?? '-' }}</span>
                                        </div>
                                    </div>
                                    <span class="badge badge-light-dark">Info</span>
                                </div>

                                <div class="mb-2">
                                    <div class="text-gray-500 fs-8 mb-1">Judul</div>
                                    <div class="text-gray-900 fw-bold fs-4">{{ $catatanJudul ?? '-' }}</div>
                                </div>

                                <div class="text-gray-700 fs-7">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($catatanIsi ?? ''), 180) }}
                                </div>

                                <div class="separator separator-dashed my-4"></div>

                                <!-- Optional: tombol untuk lihat detail via modal -->
                                <button type="button" class="btn btn-sm btn-primary w-100 mt-auto"
                                    data-bs-toggle="modal" data-bs-target="#modalCatatanAdmin">
                                    Lihat Selengkapnya
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal detail catatan -->
                    <div class="modal fade" id="modalCatatanAdmin" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">{{ $catatanJudul ?? 'Catatan Admin' }}</h3>
                                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary"
                                        data-bs-dismiss="modal">
                                        <i class="ki-duotone ki-cross fs-2">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-muted fs-8 mb-3">Update: {{ $catatanTanggal ?? '-' }}</div>
                                    <div class="text-gray-800 fs-6" style="white-space: pre-wrap;">
                                        {!! nl2br(e($catatanIsi ?? '')) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Charts -->
                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">

                    <!-- Chart 1: Status Gizi -->
                    <div class="col-xl-6">
                        <div class="card card-flush h-100">
                            <div class="card-header pt-7">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-900">Ringkasan Status Gizi</span>
                                    <span class="text-gray-500 pt-2 fw-semibold fs-6">Distribusi antropometri</span>
                                </h3>
                                <div class="card-toolbar">
                                    <span class="badge badge-light-success">Total: {{ $totalAnak ?? 0 }} anak</span>
                                </div>
                            </div>
                            <div class="card-body pt-0">

                                <div id="kt_chart_gizi_kelas" class="w-100 h-350px"></div>

                                <div class="separator separator-dashed my-4"></div>
                                <div class="d-flex flex-wrap gap-2">
                                    @forelse (($giziChart ?? []) as $g)
                                        <span class="badge badge-light">
                                            {{ $g['label'] }}: <span class="fw-bold">{{ $g['value'] }}</span>
                                        </span>
                                    @empty
                                        <span class="text-muted fs-8">Belum ada data pada periode ini.</span>
                                    @endforelse
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Chart 2: DDST -->
                    <div class="col-xl-6">
                        <div class="card card-flush h-100">
                            <div class="card-header pt-7">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-900">Ringkasan Hasil DDST</span>
                                    <span class="text-gray-500 pt-2 fw-semibold fs-6">Distribusi hasil screening</span>
                                </h3>
                                <div class="card-toolbar">
                                    <span class="badge badge-light-warning">Periode: {{ $bulanLabel ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="card-body pt-0">

                                <div id="kt_chart_ddst_kelas" class="w-100 h-350px"></div>

                                <div class="separator separator-dashed my-4"></div>
                                <div class="d-flex flex-wrap gap-2">
                                    @forelse (($ddstChart ?? []) as $d)
                                        <span class="badge badge-light">
                                            {{ $d['label'] }}: <span class="fw-bold">{{ $d['value'] }}</span>
                                        </span>
                                    @empty
                                        <span class="text-muted fs-8">Belum ada data pada periode ini.</span>
                                    @endforelse
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function() {
            if (typeof ApexCharts === "undefined") {
                console.warn("ApexCharts belum ter-load.");
                return;
            }

            const giziSeries = @json(array_column($giziChart ?? [], 'value'));
            const giziLabels = @json(array_column($giziChart ?? [], 'label'));

            const ddstSeries = @json(array_column($ddstChart ?? [], 'value'));
            const ddstLabels = @json(array_column($ddstChart ?? [], 'label'));

            // Gizi (Donut)
            const giziEl = document.querySelector('#kt_chart_gizi_kelas');
            if (giziEl) {
                if (!giziSeries.length) {
                    giziEl.innerHTML =
                        `<div class="text-muted fs-8 d-flex align-items-center justify-content-center h-350px">Belum ada data untuk periode ini.</div>`;
                } else {
                    new ApexCharts(giziEl, {
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
                    }).render();
                }
            }

            // DDST (Bar)
            const ddstEl = document.querySelector('#kt_chart_ddst_kelas');
            if (ddstEl) {
                if (!ddstSeries.length) {
                    ddstEl.innerHTML =
                        `<div class="text-muted fs-8 d-flex align-items-center justify-content-center h-350px">Belum ada data untuk periode ini.</div>`;
                } else {
                    new ApexCharts(ddstEl, {
                        chart: {
                            type: 'bar',
                            height: 350,
                            toolbar: {
                                show: false
                            }
                        },
                        series: [{
                            name: 'Jumlah Anak',
                            data: ddstSeries
                        }],
                        xaxis: {
                            categories: ddstLabels
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
                    }).render();
                }
            }
        })();
    </script>
@endpush
