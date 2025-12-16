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
                        Data Tumbuh Kembang (Antropometri)
                    </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    {{-- kalau mau breadcrumb, tambahkan di sini --}}
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->

                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input type="text" data-antropometri-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-13"
                                    placeholder="Cari Anak / Tanggal" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->

                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modal_add_antropometri">
                                    <i class="ki-duotone ki-plus fs-2"></i>Tambah Antropometri</button>
                                <!--end::Add user-->
                            </div>
                            <!--begin::Modal - Add task-->
                            @include('shared.tumbuh_kembang.create')
                            <!--end::Modal - Add task-->

                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed table-field-colored fs-6 gy-5"
                                id="tabel_antropometri">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-50px">No</th>
                                        <th class="min-w-150px">Nama Anak</th>
                                        <th class="min-w-150px">Sekolah</th>
                                        <th class="min-w-125px">Tanggal Ukur</th>
                                        <th class="min-w-100px">Berat Badan (kg)</th>
                                        <th class="min-w-100px">Status Berat Badan</th>
                                        <th class="min-w-100px">Tinggi Badan (cm)</th>
                                        <th class="min-w-100px">Status Tinggi Badan</th>
                                        <th class="min-w-100px">Lingkar Kepala (cm)</th>
                                        {{-- kalau mau, bisa tambah kolom sekolah/kelas --}}
                                        <th class="text-end min-w-150px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold">
                                    @foreach ($dataAntropometri as $index => $antropometri)
                                        <tr>
                                            <td>{{ $dataAntropometri->firstItem() + $index }}</td>
                                            <td>{{ $antropometri->anak->nama_anak ?? '-' }}</td>
                                            <td>{{ $antropometri->anak->sekolah->nama_sekolah ?? '-' }}</td>
                                            <td>
                                                {{ $antropometri->tanggal_ukur ? \Carbon\Carbon::parse($antropometri->tanggal_ukur)->format('d-m-Y') : '-' }}
                                            </td>
                                            <td>{{ $antropometri->berat_badan ?? '-' }}</td>
                                            <td>{{ ucfirst($antropometri->status_bb) ?? '-' }}</td>
                                            <td>{{ $antropometri->tinggi_badan ?? '-' }}</td>
                                            <td>{{ ucfirst($antropometri->status_tb) ?? '-' }}</td>
                                            <td>{{ $antropometri->lingkar_kepala ?? '-' }}</td>

                                            <td class="text-end">
                                                <div class="btn-group">
                                                    <a href="{{ route($routeDdstCreate, $antropometri->id) }}"
                                                        class="btn btn-sm btn-light-primary">
                                                        DDST
                                                    </a>

                                                    @if ($antropometri->ddstTests->isNotEmpty())
                                                        <a href="{{ route($routeDdstCetak, $antropometri->id) }}"
                                                            class="btn btn-sm btn-light-success" target="_blank">
                                                            Cetak
                                                        </a>
                                                    @endif

                                                    {{-- ❌ Guru tidak boleh hapus --}}
                                                    @hasanyrole('admin|super_admin')
                                                        <button type="button" class="btn btn-sm btn-light-danger"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal_delete_antropometri_{{ $antropometri->id }}">
                                                            Hapus
                                                        </button>
                                                    @endhasanyrole
                                                </div>
                                            </td>





                                        </tr>

                                        {{-- kalau kamu pakai modal delete, letakkan include di sini --}}
                                        @include('shared.tumbuh_kembang.delete')
                                    @endforeach

                                    {{-- Baris "Tidak ada data" --}}
                                    <tr id="row-no-data" @if (count($dataAntropometri)) style="display: none" @endif>
                                        <td colspan="100%" class="text-center">Tidak ada data</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end mt-4">
                                {{ $dataAntropometri->links() }}
                            </div>
                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->

    <!--end:::Main-->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('[data-antropometri-table-filter="search"]');
            const table = document.getElementById('tabel_antropometri');
            if (!searchInput || !table) return;

            const tableBody = table.querySelector('tbody');
            const noDataRow = document.getElementById('row-no-data');

            function getDataRows() {
                return Array.from(tableBody.querySelectorAll('tr'))
                    .filter(row => row.id !== 'row-no-data');
            }

            searchInput.addEventListener('keyup', function() {
                const keyword = this.value.toLowerCase().trim();
                const rows = getDataRows();
                let visibleCount = 0;

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    const match = text.includes(keyword);

                    row.style.display = match ? '' : 'none';
                    if (match) visibleCount++;
                });

                if (noDataRow) {
                    noDataRow.style.display = (visibleCount === 0) ? '' : 'none';
                }
            });
        });
    </script>
@endsection
