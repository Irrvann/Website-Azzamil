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
                            <!--begin::Filters-->
                            <form method="GET" action="{{ url()->current() }}"
                                class="d-flex gap-3 align-items-end flex-wrap">
                                <!-- Search -->
                                <div class="d-flex align-items-center position-relative">
                                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="form-control form-control-solid w-200px ps-10"
                                        placeholder="Cari Anak / Guru" />
                                </div>

                                <!-- Filter Sekolah -->
                                @hasanyrole('admin|super_admin')
                                    <div>
                                        <label class="form-label fw-bold mb-2">Sekolah</label>
                                        <select name="sekolahs_id" class="form-select form-select-sm" data-control="select2"
                                            data-placeholder="Semua Sekolah">
                                            <option></option>
                                            @foreach ($dataSekolah as $sekolah)
                                                <option value="{{ $sekolah->id }}"
                                                    {{ request('sekolahs_id') == $sekolah->id ? 'selected' : '' }}>
                                                    {{ $sekolah->nama_sekolah }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endhasanyrole

                                <!-- Filter Anak -->
                                <div>
                                    <label class="form-label fw-bold mb-2">Anak</label>
                                    <select name="anaks_id" class="form-select form-select-sm" data-control="select2"
                                        data-placeholder="Semua Anak">
                                        <option></option>
                                        @foreach ($dataAnak as $anak)
                                            <option value="{{ $anak->id }}"
                                                {{ request('anaks_id') == $anak->id ? 'selected' : '' }}>
                                                {{ $anak->nama_anak }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Filter Guru -->
                                @hasanyrole('admin|super_admin|guru')
                                    <div>
                                        <label class="form-label fw-bold mb-2">Guru</label>
                                        <select name="gurus_id" class="form-select form-select-sm" data-control="select2"
                                            data-placeholder="Semua Guru">
                                            <option></option>
                                            @foreach ($dataGuru as $guru)
                                                <option value="{{ $guru->id }}"
                                                    {{ request('gurus_id') == $guru->id ? 'selected' : '' }}>
                                                    {{ $guru->nama_guru }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endhasanyrole

                                <!-- Filter Semester -->
                                <div>
                                    <label class="form-label fw-bold mb-2">Semester</label>
                                    <select name="semester" class="form-select form-select-sm" data-control="select2"
                                        data-placeholder="Semua Semester">
                                        <option></option>
                                        <option value="1" {{ request('semester') == '1' ? 'selected' : '' }}>Semester
                                            1</option>
                                        <option value="2" {{ request('semester') == '2' ? 'selected' : '' }}>Semester
                                            2</option>
                                    </select>
                                </div>

                                <!-- Filter Tahun Ajaran -->
                                <div>
                                    <label class="form-label fw-bold mb-2">Tahun Ajaran</label>
                                    <select name="tahun_ajaran" class="form-select form-select-sm" data-control="select2"
                                        data-placeholder="Semua Tahun">
                                        <option></option>
                                        @foreach ($dataTahunAjaran as $tahun)
                                            <option value="{{ $tahun }}"
                                                {{ request('tahun_ajaran') == $tahun ? 'selected' : '' }}>
                                                {{ $tahun }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Submit Button -->
                                <div>
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="ki-duotone ki-magnifier fs-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        Filter
                                    </button>
                                    <a href="{{ url()->current() }}" class="btn btn-sm btn-secondary">
                                        Reset
                                    </a>
                                </div>
                            </form>
                            <!--end::Filters-->
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
                                                <div class="btn-group gap-2" role="group">
                                                    <a href="#" class="btn btn-sm btn-light-info"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal_detail_raport_{{ $raport->id }}">
                                                        Detail
                                                    </a>

                                                    @role('orang_tua')
                                                        <a href="#" class="btn btn-sm btn-light-warning"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal_edit_refleksi_ortu_{{ $raport->id }}">
                                                            Edit Refleksi
                                                        </a>
                                                    @endrole

                                                    @hasanyrole('admin|super_admin|guru')
                                                        <a href="#" class="btn btn-sm btn-light-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal_edit_raport_{{ $raport->id }}">
                                                            Edit
                                                        </a>
                                                    @endhasanyrole

                                                    @hasanyrole('admin|super_admin')
                                                        <a href="#" class="btn btn-sm btn-light-danger"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal_delete_raport_{{ $raport->id }}">
                                                            Hapus
                                                        </a>
                                                    @endhasanyrole

                                                    <a href="{{ route($routeCetakPdf, $raport->id) }}" target="_blank"
                                                        class="btn btn-sm btn-light-success">
                                                        Cetak
                                                    </a>
                                                </div>
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
@endsection
