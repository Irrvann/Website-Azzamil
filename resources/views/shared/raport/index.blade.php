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
                        Data Raport Anak
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
                                <input type="text" data-raport-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-13"
                                    placeholder="Cari Anak / Sekolah / Guru / Tahun" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->

                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            @hasanyrole('admin|super_admin|guru')
                                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modal_add_raport">
                                        <i class="ki-duotone ki-plus fs-2"></i>Tambah Raport
                                    </button>
                                </div>

                                {{-- Modal Tambah Raport --}}
                                {{-- Kalau modalnya kamu simpan di partial, pakai: --}}
                                @include('shared.raport.create')
                                {{-- Karena kamu tadi kirim HTML modal lengkap di chat, di sini tinggal tempel modal itu --}}
                            @endhasanyrole
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed table-field-colored fs-6 gy-5"
                                id="tabel_raport">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-50px">No</th>
                                        <th class="min-w-150px">Nama Anak</th>
                                        <th class="min-w-150px">Sekolah</th>
                                        <th class="min-w-150px">Guru</th>
                                        <th class="min-w-75px">Semester</th>
                                        <th class="min-w-100px">Tahun Ajaran</th>
                                        <th class="min-w-100px">Jumlah Foto</th>
                                        <th class="text-end min-w-150px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold">
                                    @foreach ($dataRaports as $index => $raport)
                                        <tr>
                                            <td>{{ $dataRaports->firstItem() + $index }}</td>
                                            <td>{{ $raport->anak->nama_anak ?? '-' }}</td>
                                            <td>{{ $raport->anak->sekolah->nama_sekolah ?? '-' }}</td>
                                            <td>{{ $raport->guru->nama_guru ?? '-' }}</td>
                                            <td>
                                                {{ $raport->semester }}
                                            </td>
                                            <td>{{ $raport->tahun_ajaran }}</td>
                                            <td>{{ $raport->fotos->count() }} foto</td>

                                            <td class="text-end">

                                                <a href="#"
                                                    class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">

                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#modal_detail_raport_{{ $raport->id }}"
                                                            class="menu-link px-3">Detail</a>
                                                    </div>

                                                    @role('orang_tua')
                                                        <div class="menu-item px-3">
                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#modal_edit_refleksi_ortu_{{ $raport->id }}"
                                                                class="menu-link px-3">Edit Refleksi</a>
                                                        </div>
                                                    @endrole

                                                    @hasanyrole('admin|super_admin|guru')
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#modal_edit_raport_{{ $raport->id }}"
                                                                class="menu-link px-3">Edit</a>
                                                        </div>
                                                    @endhasanyrole

                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    {{-- DELETE hanya admin & super_admin --}}
                                                    @hasanyrole('admin|super_admin')
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                                data-bs-target="#modal_delete_raport_{{ $raport->id }}">
                                                                Delete
                                                            </a>
                                                        </div>
                                                    @endhasanyrole

                                                    <!--end::Menu item-->

                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route($routeCetakPdf, $raport->id) }}" target="_blank"
                                                            class="menu-link px-3">
                                                            Cetak PDF
                                                        </a>
                                                    </div>

                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->

                                            </td>
                                            <!--begin::Modal - Detail task-->
                                            @include('shared.raport.detail')
                                            <!--end::Modal - Detail task-->
                                            <!--begin::Modal - Edit task-->
                                            @role('orang_tua')
                                                @include('shared.raport.edit_refleksi_ortu')
                                            @endrole

                                            @hasanyrole('admin|super_admin|guru')
                                                @include('shared.raport.edit')
                                            @endhasanyrole
                                            <!--end::Modal - Edit task-->
                                            <!--begin::Modal - Delete task-->
                                            @hasanyrole('admin|super_admin')
                                                @include('shared.raport.delete')
                                            @endhasanyrole
                                            <!--end::Modal - Delete task-->

                                        </tr>
                                    @endforeach

                                    {{-- Baris "Tidak ada data" --}}
                                    <tr id="row-no-data-raport"
                                        @if (count($dataRaports)) style="display: none" @endif>
                                        <td colspan="100%" class="text-center">Tidak ada data</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end mt-4">
                                {{ $dataRaports->links() }}
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
            const searchInput = document.querySelector('[data-raport-table-filter="search"]');
            const table = document.getElementById('tabel_raport');
            if (!searchInput || !table) return;

            const tableBody = table.querySelector('tbody');
            const noDataRow = document.getElementById('row-no-data-raport');

            function getDataRows() {
                return Array.from(tableBody.querySelectorAll('tr'))
                    .filter(row => row.id !== 'row-no-data-raport');
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
