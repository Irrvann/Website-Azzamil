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
                        Data Sekolah</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->

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
                                <input type="text" data-sekolah-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-13" placeholder="Cari Sekolah" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modal_add_sekolah">
                                    <i class="ki-duotone ki-plus fs-2"></i>Tambah Sekolah</button>
                                <!--end::Add user-->
                            </div>
                            <!--begin::Modal - Add task-->
                            @include('shared.sekolah.create')
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
                                id="tabel_sekolah">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        {{-- <th class="w-10px pe-2">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                    data-kt-check-target="#tabel_daerah .form-check-input"
                                                    value="1" />
                                            </div>
                                        </th> --}}
                                        <th class="min-w-125px">No</th>
                                        <th class="min-w-125px">Nama Sekolah</th>
                                        <th class="min-w-125px">Jenis Sekolah</th>
                                        <th class="min-w-125px">Kelas</th>
                                        <th class="min-w-125px">Daerah</th>
                                        <th class="text-end min-w-100px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold">
                                    @foreach ($dataSekolah as $index => $sekolah)
                                        <tr>
                                            {{-- <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                </div>
                                            </td> --}}
                                            <td>{{ $dataSekolah->firstItem() + $index }}</td>
                                            <td>{{ $sekolah->nama_sekolah ?? '-' }}</td>
                                            <td>{{ $sekolah->jenis_sekolah ?? '-' }}</td>
                                            <td>{{ $sekolah->kelas ?? '-' }}</td>
                                            <td>{{ $sekolah->daerah->nama_daerah ?? '-' }}</td>
                                            

                                            <td class="text-end">

                                                <a href="#"
                                                    class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">

                                                    <!--begin::Menu item-->
                                                    {{-- <div class="menu-item px-3">
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#modal_detail_admin_{{ $admin->id }}"
                                                            class="menu-link px-3">Detail</a>
                                                    </div> --}}

                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#modal_edit_sekolah_{{ $sekolah->id }}"
                                                            class="menu-link px-3">Edit</a>
                                                    </div>

                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                            data-bs-target="#modal_delete_sekolah_{{ $sekolah->id }}">
                                                            Delete
                                                        </a>

                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->

                                            </td>
                                        </tr>
                                        <!--begin::Modal - Detail task-->
                                        {{-- @include('shared.sekolah.detail') --}}
                                        <!--end::Modal - Detail task-->
                                        <!--begin::Modal - Edit task-->
                                        @include('shared.sekolah.edit')
                                        <!--end::Modal - Edit task-->
                                        <!--begin::Modal - Delete task-->
                                        @include('shared.sekolah.delete')
                                        <!--end::Modal - Delete task-->
                                    @endforeach
                                    {{-- Baris "Tidak ada data" --}}
                                    <tr id="row-no-data" @if (count($dataSekolah)) style="display: none" @endif>
                                        <td colspan="100%" class="text-center">Tidak ada data</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end mt-4">
                                {{ $dataSekolah->links() }}
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
            const searchInput = document.querySelector('[data-sekolah-table-filter="search"]');
            const table = document.getElementById('tabel_sekolah');
            if (!searchInput || !table) return; // biar nggak error di halaman lain

            const tableBody = table.querySelector('tbody');
            const noDataRow = document.getElementById('row-no-data');

            function getDataRows() {
                // ambil ulang setiap kali (kalau nanti kamu ada manipulasi DOM)
                return Array.from(tableBody.querySelectorAll('tr'))
                    .filter(row => row.id !== 'row-no-data');
            }

            searchInput.addEventListener('keyup', function() {
                const keyword = this.value.toLowerCase().trim();
                const rows = getDataRows();
                let visibleCount = 0;

                rows.forEach(row => {
                    // kalau mau cari cuma di kolom tertentu:
                    // const cellsText = Array.from(row.querySelectorAll('td:nth-child(2), td:nth-child(4)'))
                    //     .map(td => td.textContent.toLowerCase())
                    //     .join(' ');

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
