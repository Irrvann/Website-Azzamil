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
                        Data Anak</h1>
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
                        <form method="GET" action="{{ url()->current() }}">
                            <div class="card-title d-flex align-items-center gap-3">
                                <!-- Search -->
                                <div class="d-flex align-items-center position-relative my-1">
                                    <!--begin::Search-->
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <input type="text" name="search" value="{{ request('search') }}"
                                            data-anak-table-filter="search"
                                            class="form-control form-control-solid w-250px ps-13" placeholder="Cari Anak" />

                                    </div>
                                    <!--end::Search-->
                                </div>

                                <!-- Filter Sekolah -->
                                <select name="sekolahs_id" class="form-select form-select-solid w-200px">
                                    <option value="">Semua Sekolah</option>
                                    @foreach ($dataSekolah as $sekolah)
                                        <option value="{{ $sekolah->id }}" @selected(request('sekolahs_id') == $sekolah->id)>
                                            {{ $sekolah->nama_sekolah }}
                                        </option>
                                    @endforeach
                                </select>

                                <button class="btn btn-primary">Filter</button>
                                <a href="{{ url()->current() }}" class="btn btn-light">Reset</a>
                            </div>
                        </form>

                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modal_add_anak">
                                    <i class="ki-duotone ki-plus fs-2"></i>Tambah Anak</button>
                                <!--end::Add user-->
                            </div>
                            <!--begin::Modal - Add task-->
                            @include('shared.anak.create')
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
                                id="tabel_anak">
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
                                        <th class="min-w-125px">NIK</th>
                                        <th class="min-w-125px">NISN</th>
                                        <th class="min-w-125px">NIPD</th>
                                        <th class="min-w-125px">Nama</th>
                                        {{-- <th class="min-w-125px">NO KK</th>
                                        <th class="min-w-125px">NO Registrasi AKTA</th> --}}
                                        {{-- <th class="min-w-125px">Tempat Lahir</th>
                                        <th class="min-w-125px">Tanggal Lahir</th>
                                        <th class="min-w-125px">Jenis Kelamin</th> --}}
                                        {{-- <th class="min-w-125px">Jabatan</th> --}}
                                        {{-- <th class="min-w-125px">Alamat</th>
                                        <th class="min-w-125px">Email</th>
                                        <th class="min-w-125px">No HP</th>
                                        <th class="min-w-125px">Pendidikan Terakhir</th>
                                        <th class="min-w-125px">Jurusan</th>
                                        <th class="min-w-125px">Tanggal Masuk</th> --}}
                                        {{-- <th class="min-w-125px">Foto</th>
                                        <th class="min-w-125px">Tanggal Masuk</th> --}}
                                        <th class="min-w-125px">Orang Tua</th>
                                        <th class="min-w-125px">Sekolah</th>
                                        <th class="text-end min-w-100px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold">
                                    @foreach ($dataAnak as $index => $anak)
                                        <tr>
                                            {{-- <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                </div>
                                            </td> --}}
                                            <td>{{ $dataAnak->firstItem() + $index }}</td>
                                            <td>{{ $anak->nik ?? '-' }}</td>
                                            <td>{{ $anak->nisn ?? '-' }}</td>
                                            <td>{{ $anak->nipd ?? '-' }}</td>
                                            <td>{{ $anak->nama_anak ?? '-' }}</td>
                                            {{-- <td>{{ $anak->no_kk ?? '-' }}</td>
                                            <td>{{ $anak->no_registrasi_akta ?? '-' }}</td> --}}
                                            {{-- <td>{{ $anak->tempat_lahir ?? '-' }}</td>
                                            <td>{{ $anak->tanggal_lahir ? \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d-m-Y') : '-' }}
                                            </td>
                                            <td>{{ $anak->jenis_kelamin ?? '-' }}</td> --}}
                                            {{-- <td>{{ $guru->jabatan ?? '-' }}</td> --}}
                                            {{-- <td>{{ $guru->alamat ?? '-' }}</td>
                                            <td>{{ $guru->email ?? '-' }}</td>
                                            <td>{{ $guru->no_hp ?? '-' }}</td>
                                            <td>{{ $guru->pend_terakhir ?? '-' }}</td>
                                            <td>{{ $guru->jurusan ?? '-' }}</td>
                                            <td>{{ $guru->tanggal_masuk ? \Carbon\Carbon::parse($guru->tanggal_masuk)->format('d-m-Y') : '-' }}  
                                            </td> --}}
                                            {{-- <td>
                                                @php
                                                    $foto = $anak->foto;
                                                    // Jika file berasal dari storage (upload)
                                                    if (Str::startsWith($foto, 'foto_anak/')) {
                                                        $src = asset('storage/' . $foto);
                                                    } else {
                                                        // Jika file adalah asset default
                                                        $src = asset($foto);
                                                    }
                                                @endphp

                                                <img src="{{ $src }}" alt="Foto Anak"
                                                    style="width: 50px; height: 50px; object-fit: cover; border-radius: 999px;">


                                            </td> 
                                            <td>{{ $anak->tanggal_masuk ? \Carbon\Carbon::parse($anak->tanggal_masuk)->format('d-m-Y') : '-' }}  
                                            </td> --}}
                                            <td>{{ $anak->orangTua->nama_ayah ?? '-' }}
                                                {{ $anak->orangTua->nama_ibu ?? '-' }}</td>
                                            <td>{{ $anak->sekolah->nama_sekolah ?? '-' }}</td>
                                            {{-- <td>
                                                @php
                                                    $status = $guru->user->status ?? null;
                                                @endphp

                                                @if ($status === 'aktif')
                                                    <span class="badge badge-light-success">Aktif</span>
                                                @elseif ($status === 'non_aktif')
                                                    <span class="badge badge-light-danger">Tidak Aktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $guru->user->username ?? '-' }}
                                            </td> --}}



                                            <td class="text-end">

                                                <a href="#"
                                                    class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                                <!--begin::Menu-->
                                                <div class="menu fmenu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">

                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#modal_detail_anak_{{ $anak->id }}"
                                                            class="menu-link px-3">Detail</a>
                                                    </div>

                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#modal_edit_anak_{{ $anak->id }}"
                                                            class="menu-link px-3">Edit</a>
                                                    </div>

                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                            data-bs-target="#modal_delete_anak_{{ $anak->id }}">
                                                            Delete
                                                        </a>

                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->

                                            </td>
                                        </tr>
                                        <!--begin::Modal - Detail task-->
                                        @include('shared.anak.detail')
                                        <!--end::Modal - Detail task-->
                                        <!--begin::Modal - Edit task-->
                                        @include('shared.anak.edit')
                                        <!--end::Modal - Edit task-->
                                        <!--begin::Modal - Delete task-->
                                        @include('shared.anak.delete')
                                        <!--end::Modal - Delete task-->
                                    @endforeach
                                    {{-- Baris "Tidak ada data" --}}
                                    <tr id="row-no-data" @if (count($dataAnak)) style="display: none" @endif>
                                        <td colspan="100%" class="text-center">Tidak ada data</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end mt-4">
                                {{ $dataAnak->withQueryString()->links() }}

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
            const searchInput = document.querySelector('[data-anak-table-filter="search"]');
            const table = document.getElementById('tabel_anak');
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('form[method="GET"]');
            if (!form) return;

            const sekolah = form.querySelector('select[name="sekolahs_id"]');
            const search = form.querySelector('input[name="search"]');

            if (sekolah) sekolah.addEventListener('change', () => form.submit());

            if (search) {
                let t;
                search.addEventListener('input', () => {
                    clearTimeout(t);
                    t = setTimeout(() => form.submit(), 500);
                });
            }
        });
    </script>
@endsection
