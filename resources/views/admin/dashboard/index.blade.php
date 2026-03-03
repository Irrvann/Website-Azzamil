@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Dashboard Admin
                    </h1>

                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Dashboard</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Periode: {{ $periodeLabel }}</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <form method="GET" action="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-2">
                        <input type="month" name="periode" class="form-control form-control-sm"
                            value="{{ $periode ?? now()->format('Y-m') }}" style="width: 160px;" />
                        <button class="btn btn-sm fw-bold btn-secondary">Terapkan</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">

                <div class="row gy-5 gx-xl-10 mb-5 mb-xl-10">
                    <div class="col-sm-6 col-xl-3">
                        <div class="card h-lg-100">
                            <div class="card-body d-flex justify-content-between align-items-start flex-column p-6">
                                <div class="m-0">
                                    <i class="ki-duotone ki-home-2 fs-2hx text-gray-600">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </div>

                                <div class="d-flex flex-column my-7">
                                    <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ $totalSekolah }}</span>
                                    <div class="m-0">
                                        <span class="fw-semibold fs-6 text-gray-500">Total Sekolah</span>
                                    </div>
                                </div>

                                <a href="/admin/data-sekolah" class="btn btn-sm btn-light w-100">Kelola Sekolah</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card h-lg-100">
                            <div class="card-body d-flex justify-content-between align-items-start flex-column p-6">
                                <div class="m-0">
                                    <i class="ki-duotone ki-teacher fs-2hx text-gray-600">
                                        <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                                    </i>
                                </div>

                                <div class="d-flex flex-column my-7">
                                    <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ $totalGuru }}</span>
                                    <div class="m-0">
                                        <span class="fw-semibold fs-6 text-gray-500">Total Guru</span>
                                    </div>
                                </div>

                                <a href="/admin/data-guru" class="btn btn-sm btn-light w-100">Kelola Guru</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card h-lg-100">
                            <div class="card-body d-flex justify-content-between align-items-start flex-column p-6">
                                <div class="m-0">
                                    <i class="ki-duotone ki-profile-user fs-2hx text-gray-600">
                                        <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                                    </i>
                                </div>

                                <div class="d-flex flex-column my-7">
                                    <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ $totalOrangTua }}</span>
                                    <div class="m-0">
                                        <span class="fw-semibold fs-6 text-gray-500">Total Orang Tua</span>
                                    </div>
                                </div>

                                <a href="/admin/data-orang-tua" class="btn btn-sm btn-light w-100">Kelola Orang Tua</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="card h-lg-100">
                            <div class="card-body d-flex justify-content-between align-items-start flex-column p-6">
                                <div class="m-0">
                                    <i class="ki-duotone ki-people fs-2hx text-gray-600">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </div>

                                <div class="d-flex flex-column my-7">
                                    <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ $totalAnak }}</span>
                                    <div class="m-0">
                                        <span class="fw-semibold fs-6 text-gray-500">Total Anak</span>
                                    </div>
                                </div>

                                <a href="/admin/data-anak" class="btn btn-sm btn-light w-100">Kelola Anak</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row gy-5 gx-xl-10 mb-5 mb-xl-10">
                    <div class="col-xl-4">
                        <div class="card h-100">
                            <div class="card-body p-6">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="symbol symbol-40px symbol-circle bg-light-info">
                                            <i class="ki-duotone ki-chart-line-up fs-2 text-info">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-gray-900">Tumbuh Kembang Bulan Ini</span>
                                            <span class="text-muted fs-8">Progress input DDST & Antropometri</span>
                                        </div>
                                    </div>
                                    <span class="badge {{ $badgeClass($tkBelumSelesai) }}">Belum: {{ $tkBelumSelesai }}</span>
                                </div>

                                <div class="d-flex align-items-end justify-content-between mb-2">
                                    <div>
                                        <div class="fs-2hx fw-bold text-gray-900 lh-1">{{ $tkProgress }}%</div>
                                        <div class="text-gray-500 fs-8 mt-1">Sudah: {{ $tkSelesai }} / {{ $totalAnak }}</div>
                                    </div>
                                </div>

                                <div class="progress h-6px bg-light mb-4">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $tkProgress }}%"
                                        aria-valuenow="{{ $tkProgress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                                <a href="/admin/data-tumbuh-kembang" class="btn btn-sm btn-light-info w-100">
                                    Lihat Data Tumbuh Kembang
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card h-100">
                            <div class="card-body p-6">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="symbol symbol-40px symbol-circle bg-light-warning">
                                            <i class="ki-duotone ki-shield-tick fs-2 text-warning">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-gray-900">DDST Perlu Evaluasi</span>
                                            <span class="text-muted fs-8">Meragukan / penyimpangan</span>
                                        </div>
                                    </div>
                                    <span class="badge {{ $badgeClass($ddstPerluEvaluasi) }}">Alert</span>
                                </div>

                                <div class="fs-2hx fw-bold text-gray-900 lh-1 mb-2">{{ $ddstPerluEvaluasi }}</div>
                                <div class="text-gray-500 fs-8 mb-4">Anak yang perlu tindak lanjut screening</div>

                                <a href="/admin/data-tumbuh-kembang" class="btn btn-sm btn-light-warning w-100">
                                    Cek Detail DDST
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card h-100">
                            <div class="card-body p-6">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="symbol symbol-40px symbol-circle bg-light-success">
                                            <i class="ki-duotone ki-heart fs-2 text-success">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-gray-900">Status Gizi Tidak Normal</span>
                                            <span class="text-muted fs-8">Gizi kurang / berlebih</span>
                                        </div>
                                    </div>
                                    <span class="badge {{ $badgeClass($giziTidakNormal) }}">Monitoring</span>
                                </div>

                                <div class="fs-2hx fw-bold text-gray-900 lh-1 mb-2">{{ $giziTidakNormal }}</div>
                                <div class="text-gray-500 fs-8 mb-4">Anak yang perlu perhatian status gizi</div>

                                <a href="/admin/data-tumbuh-kembang" class="btn btn-sm btn-light-success w-100">
                                    Cek Antropometri
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                    <div class="col-xl-4">
                        <div class="card h-100">
                            <div class="card-body p-6">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="symbol symbol-40px symbol-circle bg-light-danger">
                                            <i class="ki-duotone ki-document fs-2 text-danger">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </span>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-gray-900">Raport Belum Selesai</span>
                                            <span class="text-muted fs-8">Progress penilaian</span>
                                        </div>
                                    </div>
                                    <span class="badge {{ $badgeClass($raportBelumSelesai) }}">To-do</span>
                                </div>

                                <div class="fs-2hx fw-bold text-gray-900 lh-1 mb-2">{{ $raportBelumSelesai }}</div>
                                <div class="text-gray-500 fs-8 mb-4">Raport anak yang belum diselesaikan</div>

                                <a href="/admin/data-raport" class="btn btn-sm btn-light-danger w-100">
                                    Lihat Data Raport
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="card card-flush h-100">
                            <div class="card-header pt-7">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-900">Monitoring Sekolah</span>
                                    <span class="text-gray-500 pt-2 fw-semibold fs-6">Kelengkapan data bulan ini</span>
                                </h3>
                            </div>

                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-4">
                                        <thead>
                                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                <th>Sekolah</th>
                                                <th class="text-center">Anak</th>
                                                <th class="text-center">TK (%)</th>
                                                <th class="text-center">Raport (%)</th>
                                                <th class="text-end">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 fw-semibold">
                                            @foreach ($monitorSekolah as $s)
                                                @php $st = $statusSekolah($s['tk'], $s['raport']); @endphp
                                                <tr>
                                                    <td class="text-gray-800 fw-bold">{{ $s['nama'] }}</td>
                                                    <td class="text-center">{{ $s['anak'] }}</td>
                                                    <td class="text-center">
                                                        <span class="badge badge-light-info">{{ $s['tk'] }}%</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge badge-light-primary">{{ $s['raport'] }}%</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <span class="badge {{ $st['class'] }}">{{ $st['label'] }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="separator separator-dashed my-4"></div>

                                <div class="d-flex gap-3">
                                    <a href="/admin/data-sekolah" class="btn btn-sm btn-light w-50">Kelola Sekolah</a>
                                    <a href="/admin/data-tumbuh-kembang" class="btn btn-sm btn-primary w-50">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-5 g-xl-10">
                    <div class="col-xl-6">
                        <div class="card card-flush h-100">
                            <div class="card-header pt-7">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-900">Jumlah Anak per Sekolah</span>
                                    <span class="text-gray-500 pt-2 fw-semibold fs-6">Ringkasan sebaran siswa</span>
                                </h3>
                            </div>
                            <div class="card-body pt-0">
                                <div id="kt_chart_admin_anak_sekolah" class="w-100 h-350px"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card card-flush h-100">
                            <div class="card-header pt-7">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-900">Distribusi Status Gizi</span>
                                    <span class="text-gray-500 pt-2 fw-semibold fs-6">Seluruh sekolah</span>
                                </h3>
                            </div>
                            <div class="card-body pt-0">
                                <div id="kt_chart_admin_gizi" class="w-100 h-300px"></div>
                            </div>
                        </div>
                    </div>

                    
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            (function() {
                if (typeof ApexCharts === "undefined") return;

                const giziSeries = @json(array_column($giziChart ?? [], 'value'));
                const giziLabels = @json(array_column($giziChart ?? [], 'label'));

                

                const anakSekolahCats = @json(array_column($anakPerSekolah ?? [], 'sekolah'));
                const anakSekolahVals = @json(array_column($anakPerSekolah ?? [], 'total'));

                const elGizi = document.querySelector('#kt_chart_admin_gizi');
                if (elGizi) {
                    new ApexCharts(elGizi, {
                        chart: { type: 'donut', height: 300, toolbar: { show: false } },
                        series: giziSeries,
                        labels: giziLabels,
                        legend: { position: 'bottom' },
                        tooltip: { y: { formatter: (v) => `${v} anak` } }
                    }).render();
                }


                const elAnakSekolah = document.querySelector('#kt_chart_admin_anak_sekolah');
                if (elAnakSekolah) {
                    new ApexCharts(elAnakSekolah, {
                        chart: { type: 'bar', height: 350, toolbar: { show: false } },
                        series: [{ name: 'Total Anak', data: anakSekolahVals }],
                        xaxis: { categories: anakSekolahCats },
                        plotOptions: { bar: { horizontal: true, borderRadius: 6, barHeight: '65%' } },
                        dataLabels: { enabled: false },
                        tooltip: { y: { formatter: (v) => `${v} anak` } }
                    }).render();
                }
            })();
        </script>
    @endpush
@endsection