<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Raport {{ $raport->anak->nama_anak ?? '' }}</title>
    <style>
        * {
            font-family: DejaVu Sans, sans-serif;
        }

        body {
            font-size: 12px;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            margin: 0 0 6px 0;
        }

        .text-center {
            text-align: center;
        }

        .mb-1 {
            margin-bottom: 4px;
        }

        .mb-2 {
            margin-bottom: 8px;
        }

        .mb-3 {
            margin-bottom: 12px;
        }

        .mb-4 {
            margin-bottom: 16px;
        }

        .mb-5 {
            margin-bottom: 20px;
        }

        .border {
            border: 1px solid #000;
        }

        .p-2 {
            padding: 8px;
        }

        .p-3 {
            padding: 12px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 4px;
            margin-top: 12px;
        }

        .small {
            font-size: 10px;
        }

        .foto-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .foto-grid img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border: 1px solid #000;
        }
    </style>
</head>

<body>

    {{-- Header --}}
    <div class="text-center mb-4">
        <h2>RAPORT PAUD</h2>
        <div>{{ $raport->anak->sekolah->nama_sekolah ?? '-' }}</div>
        <div class="small">
            Semester {{ $raport->semester }} • Tahun Ajaran {{ $raport->tahun_ajaran }}
        </div>
    </div>

    {{-- Identitas Anak --}}
    <table class="table mb-3">
        <tr>
            {{-- Kolom foto anak --}}
            <td style="width: 30%; text-align: center;" rowspan="5">
                @if (optional($raport->anak)->foto)
                    <img src="{{ public_path('storage/' . $raport->anak->foto) }}"
                        alt="Foto {{ $raport->anak->nama_anak }}"
                        style="width: 90px; height: 110px; object-fit: cover; border: 1px solid #000;">
                @else
                    <div
                        style="width: 90px; height: 110px; border: 1px solid #000; display: flex; align-items: center; justify-content: center; font-size: 10px;">
                        Tidak ada foto
                    </div>
                @endif
            </td>

            <th style="width: 25%;">Nama Anak</th>
            <td>{{ $raport->anak->nama_anak ?? '-' }}</td>
        </tr>
        <tr>
            <th>Sekolah</th>
            <td>{{ $raport->anak->sekolah->nama_sekolah ?? '-' }}</td>
        </tr>
        <tr>
            <th>Guru</th>
            <td>{{ $raport->guru->nama_guru ?? '-' }}</td>
        </tr>
        <tr>
            <th>Semester</th>
            <td>{{ $raport->semester }}</td>
        </tr>
        <tr>
            <th>Tahun Ajaran</th>
            <td>{{ $raport->tahun_ajaran }}</td>
        </tr>
    </table>


    {{-- Kehadiran --}}
    <div class="section-title">Kehadiran</div>
    <table class="table mb-3">
        <tr>
            <th>Sakit</th>
            <th>Izin</th>
            <th>Tanpa Keterangan</th>
        </tr>
        <tr>
            <td>{{ $raport->sakit ?? 0 }} hari</td>
            <td>{{ $raport->izin ?? 0 }} hari</td>
            <td>{{ $raport->tanpa_keterangan ?? 0 }} hari</td>
        </tr>
    </table>

    {{-- Nilai Agama --}}
    <div class="section-title">Nilai Agama</div>
    <table class="table mb-2">
        <tr>
            <th style="width: 30%;">Deskripsi</th>
            <td>{{ $raport->nilai_agama ?? '-' }}</td>
        </tr>
    </table>
    @if ($fotosAgama->count())
        <div class="small mb-1">Foto Kegiatan:</div>
        <div class="foto-grid mb-3">
            @foreach ($fotosAgama as $foto)
                <img src="{{ public_path('storage/' . $foto->foto) }}" alt="Foto Agama">
            @endforeach
        </div>
    @endif

    {{-- Nilai Jati Diri --}}
    <div class="section-title">Nilai Jati Diri</div>
    <table class="table mb-2">
        <tr>
            <th style="width: 30%;">Deskripsi</th>
            <td>{{ $raport->nilai_jati_diri ?? '-' }}</td>
        </tr>
    </table>
    @if ($fotosJatiDiri->count())
        <div class="small mb-1">Foto Kegiatan:</div>
        <div class="foto-grid mb-3">
            @foreach ($fotosJatiDiri as $foto)
                <img src="{{ public_path('storage/' . $foto->foto) }}" alt="Foto Jati Diri">
            @endforeach
        </div>
    @endif

    {{-- Nilai Literasi & Sains --}}
    <div class="section-title">Nilai Literasi &amp; Sains</div>
    <table class="table mb-2">
        <tr>
            <th style="width: 30%;">Deskripsi</th>
            <td>{{ $raport->nilai_literasi_sains ?? '-' }}</td>
        </tr>
    </table>
    @if ($fotosLiterasiSains->count())
        <div class="small mb-1">Foto Kegiatan:</div>
        <div class="foto-grid mb-3">
            @foreach ($fotosLiterasiSains as $foto)
                <img src="{{ public_path('storage/' . $foto->foto) }}" alt="Foto Literasi &amp; Sains">
            @endforeach
        </div>
    @endif

    {{-- Nilai P5 --}}
    <div class="section-title">Nilai P5 (Profil Pelajar Pancasila)</div>
    <table class="table mb-2">
        <tr>
            <th style="width: 30%;">Deskripsi</th>
            <td>{{ $raport->nilai_p5 ?? '-' }}</td>
        </tr>
    </table>
    @if ($fotosP5->count())
        <div class="small mb-1">Foto Kegiatan:</div>
        <div class="foto-grid mb-3">
            @foreach ($fotosP5 as $foto)
                <img src="{{ public_path('storage/' . $foto->foto) }}" alt="Foto P5">
            @endforeach
        </div>
    @endif

    {{-- Tanda tangan (opsional) --}}
    <div style="margin-top: 40px;">
        <table style="width: 100%; text-align: center;">
            <tr>
                <td>
                    Orang Tua/Wali,<br><br><br><br>
                    (____________________)
                </td>
                <td>
                    Guru Kelas,<br><br><br><br>
                    ({{ $raport->guru->nama_guru ?? '........................' }})
                </td>
            </tr>
        </table>
    </div>

</body>

</html>
