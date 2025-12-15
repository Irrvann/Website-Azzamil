<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Raport {{ $raport->anak->nama_anak ?? '' }}</title>

    <style>
        @page {
            margin: 0;
        }

        * {
            font-family: DejaVu Sans, sans-serif;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-size: 11px;
        }

        /* --- COVER PAGE --- */
        .cover-page {
            position: relative;
            width: 100%;
            height: 100vh;
        }

        .cover-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .cover-nama-bar {
            position: absolute;
            left: 120px;
            right: 120px;
            height: 38px;
            border-radius: 999px;
            border: 2px solid #b1c2ec;
            background-color: #fff9ec;
            overflow: hidden;
        }

        .cover-nama-bar-nama {
            bottom: 275px;
        }

        .cover-nama-bar-nisn {
            bottom: 230px;
        }

        .cover-nama-label {
            position: absolute;
            left: 0;
            top: 0;
            width: 120px;
            height: 100%;
            background-color: #3f5fa8;
            border-top-left-radius: 999px;
            border-bottom-left-radius: 999px;
        }

        .cover-nama-label span {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-weight: bold;
            font-size: 13px;
            color: #ffffff;
            letter-spacing: 1px;
        }

        .cover-nama-value {
            position: absolute;
            left: 135px;
            right: 30px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 13px;
            font-weight: bold;
            color: #355190;
            text-transform: uppercase;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .page-break {
            page-break-after: always;
        }

        /* ================== PAGE WRAPPER (UNTUK SETIAP HALAMAN KONTEN) ================== */
        .page {
            position: relative;
        }

        .page .page-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .page-content {
            position: relative;
            padding: 40px 45px 30px 45px;
        }

        /* ================== HEADER / BIODATA ================== */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .header-table th,
        .header-table td {
            border: 1px solid #000;
            padding: 6px 10px;
            font-size: 11px;
        }

        .table-title {
            background-color: #d7f2c8;
            font-weight: bold;
            text-align: center;
            font-size: 13px;
            padding: 6px 0;
        }

        .bio-label {
            width: 28%;
            background-color: #e8f3ff;
            font-weight: bold;
        }

        .bio-value {
            background-color: #f9fcff;
        }

        .foto-wrapper {
            width: 32%;
            text-align: center;
            background-color: #f1faff;
            border: 1px solid #000;
            padding: 8px;
        }

        .foto-anak {
            width: 150px;
            height: auto;
            max-height: 200px;
            object-fit: contain;
            background: #fff;
            border-radius: 8px;
            border: 1px solid #666;
            padding: 4px;
        }

        /* ================== TABEL PENILAIAN ================== */
        .penilaian-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .penilaian-table th {
            background-color: #d7f2c8;
            text-align: center;
            font-weight: bold;
            padding: 8px;
            border: 1px solid #888;
            font-size: 13px;
        }

        .penilaian-table td {
            border: 1px solid #888;
            padding: 10px;
            background-color: #ffffff;
            line-height: 1.55;
            text-align: left;
        }

        /* ================== FOTO KEGIATAN ================== */
        .foto-kegiatan-wrapper {
            padding: 10px;
            border-top: none;
        }

        .foto-kegiatan-title {
            display: block;
            margin-bottom: 2px;
            font-size: 11px;
            font-weight: bold;
        }

        .foto-grid {
            margin-top: 20px;
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .foto-grid img {
            width: 85px;
            height: 85px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #555;
            max-width: 100%;
        }

        /* ================== KEHADIRAN ================== */
        .kehadiran-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 25px;
            table-layout: fixed;
        }

        .kehadiran-table td {
            border: 1px solid #000;
            text-align: center;
            font-size: 11px;
            padding: 4px 0;
        }

        .kehadiran-row-value td {
            background-color: #ffffff;
            font-weight: bold;
            font-size: 12px;
        }

        .kehadiran-row-label td {
            font-weight: bold;
        }

        .kh-sakit {
            background-color: #f8d1b0;
        }

        .kh-izin {
            background-color: #cbd8f5;
        }

        .kh-tk {
            background-color: #d8eec8;
        }

        .refleksi-orangtua td {
            padding-top: 40px !important;
            padding-bottom: 40px !important;
        }

        /* ================== ANTI NEMBUS KANAN (DOMPDF) ================== */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td,
        .header-table th,
        .penilaian-table td,
        .penilaian-table th {
            white-space: normal !important;
            word-wrap: break-word !important;
            overflow-wrap: break-word !important;
            word-break: break-word !important;
        }

        .penilaian-table td,
        .bio-value {
            max-width: 0;
        }

        .penilaian-table td a {
            word-break: break-all;
        }

        /* BIAR BLOK GA KEPECAH DI TENGAH */
        .no-split {
            page-break-inside: avoid;
        }

        .footer-review {
            background: #ffffff;
            padding: 12px 16px;
            border-radius: 6px;
            margin-top: 20px;
        }

        .footer-review table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        .footer-review th {
            background: #d7f2c8;
            /* hijau muda, sama seperti header tabel lain */
            color: #000;
            font-weight: bold;
            text-align: center;
            padding: 6px 4px;
            border: 1px solid #bbb;
        }

        .footer-review td {
            text-align: center;
            padding: 6px 4px;
            border: 1px solid #bbb;
        }
    </style>
</head>

<body>

    {{-- ================== COVER (HALAMAN 1) ================== --}}
    <div class="cover-page">
        <img src="{{ public_path('assets/media/background/bg-cover-raport-new.png') }}" alt="Cover Raport" class="cover-bg">

        <div class="cover-nama-bar cover-nama-bar-nama">
            <div class="cover-nama-label"><span>NAMA</span></div>
            <div class="cover-nama-value">{{ $raport->anak->nama_anak ?? '' }}</div>
        </div>

        <div class="cover-nama-bar cover-nama-bar-nisn">
            <div class="cover-nama-label"><span>NISN/NIPD</span></div>
            <div class="cover-nama-value">{{ $raport->anak->nisn ?? '' }} / {{ $raport->anak->nipd ?? '' }}</div>
        </div>
    </div>

    <div class="page-break"></div>

    @php
        $antrop = $raport->anak->antropometris->sortByDesc('created_at')->first();
        $fotosAgama = $raport->fotos->where('komponen', 'agama');
        $fotosJatiDiri = $raport->fotos->where('komponen', 'jati_diri');
        $fotosMotorik = $raport->fotos->where('komponen', 'motorik');
        $fotosLiterasi = $raport->fotos->where('komponen', 'literasi_sains');
        $fotosP5 = $raport->fotos->where('komponen', 'p5');
    @endphp

    {{-- ================== HALAMAN 2: HEADER + AGAMA + JATI DIRI (+ MOTORIK) ================== --}}
    <div class="page">
        <img src="{{ public_path('assets/media/background/bg-raport-halaman-new.png') }}" class="page-bg" alt="Background">

        <div class="page-content">

            <table class="header-table no-split">
                <tr>
                    <th class="table-title" colspan="3">LAPORAN PERKEMBANGAN ANAK DIDIK</th>
                </tr>

                <tr>
                    <td class="foto-wrapper" rowspan="8">
                        @if (optional($raport->anak)->foto)
                            <img src="{{ public_path('storage/' . $raport->anak->foto) }}"
                                alt="Foto {{ $raport->anak->nama_anak }}" class="foto-anak">
                        @else
                            <span style="font-size:10px;">(Tidak ada foto)</span>
                        @endif
                    </td>
                    <th class="bio-label">Nama Anak</th>
                    <td class="bio-value">{{ $raport->anak->nama_anak ?? '-' }}</td>
                </tr>
                <tr>
                    <th class="bio-label">NISN</th>
                    <td class="bio-value">{{ $raport->anak->nisn ?? '-' }}</td>
                </tr>

                <tr>
                    <th class="bio-label">NIPD</th>
                    <td class="bio-value">{{ $raport->anak->nipd ?? '-' }}</td>
                </tr>


                <tr>
                    <th class="bio-label">Sekolah</th>
                    <td class="bio-value">{{ $raport->anak->sekolah->nama_sekolah ?? '-' }}</td>
                </tr>

                <tr>
                    <th class="bio-label">Guru Kelas</th>
                    <td class="bio-value">{{ $raport->guru->nama_guru ?? '-' }}</td>
                </tr>

                <tr>
                    <th class="bio-label">BB / TB</th>
                    <td class="bio-value">
                        {{ $antrop?->berat_badan ?? '-' }} kg, {{ $antrop?->tinggi_badan ?? '-' }} cm
                    </td>
                </tr>

                <tr>
                    <th class="bio-label">Semester</th>
                    <td class="bio-value">{{ $raport->semester ?? '-' }}</td>
                </tr>

                <tr>
                    <th class="bio-label">Tahun Ajaran</th>
                    <td class="bio-value">{{ $raport->tahun_ajaran ?? '-' }}</td>
                </tr>




            </table>

            <table class="penilaian-table">
                <tr>
                    <th>Nilai Agama dan Budi Pekerti</th>
                </tr>
                <tr>
                    <td>{!! nl2br(e($raport->nilai_agama ?? '')) !!}</td>
                </tr>

                @if ($fotosAgama->count())
                    <tr>
                        <td class="foto-kegiatan-wrapper">
                            <span class="foto-kegiatan-title">Dokumentasi Kegiatan:</span>
                            <div class="foto-grid">
                                @foreach ($fotosAgama as $foto)
                                    <img src="{{ public_path('storage/' . $foto->foto) }}" alt="Foto Kegiatan Agama">
                                @endforeach
                            </div>
                        </td>
                    </tr>
                @endif
            </table>

            <table class="penilaian-table">
                <tr>
                    <th>Nilai Jati Diri</th>
                </tr>
                <tr>
                    <td>{!! nl2br(e($raport->nilai_jati_diri ?? '')) !!}</td>
                </tr>

                @if ($fotosJatiDiri->count())
                    <tr>
                        <td class="foto-kegiatan-wrapper">
                            <span class="foto-kegiatan-title">Dokumentasi Kegiatan:</span>
                            <div class="foto-grid">
                                @foreach ($fotosJatiDiri as $foto)
                                    <img src="{{ public_path('storage/' . $foto->foto) }}"
                                        alt="Foto Kegiatan Jati Diri">
                                @endforeach
                            </div>
                        </td>
                    </tr>
                @endif
            </table>

            @if (!empty($raport->nilai_motorik_kesehatan) || $fotosMotorik->count())
                <table class="penilaian-table">
                    <tr>
                        <th>Nilai Motorik &amp; Kesehatan</th>
                    </tr>
                    <tr>
                        <td>{!! nl2br(e($raport->nilai_motorik_kesehatan ?? '')) !!}</td>
                    </tr>

                    @if ($fotosMotorik->count())
                        <tr>
                            <td class="foto-kegiatan-wrapper">
                                <span class="foto-kegiatan-title">Dokumentasi Kegiatan:</span>
                                <div class="foto-grid">
                                    @foreach ($fotosMotorik as $foto)
                                        <img src="{{ public_path('storage/' . $foto->foto) }}"
                                            alt="Foto Kegiatan Motorik">
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endif
                </table>
            @endif

        </div>
    </div>

    <div class="page-break"></div>

    {{-- ================== HALAMAN 3: LITERASI + P5 ================== --}}
    <div class="page">
        <img src="{{ public_path('assets/media/background/bg-raport-halaman-new.png') }}" class="page-bg" alt="Background">

        <div class="page-content">

            <table class="penilaian-table">
                <tr>
                    <th>Nilai Literasi Sains</th>
                </tr>
                <tr>
                    <td>{!! nl2br(e($raport->nilai_literasi_sains ?? '')) !!}</td>
                </tr>

                @if ($fotosLiterasi->count())
                    <tr>
                        <td class="foto-kegiatan-wrapper">
                            <span class="foto-kegiatan-title">Dokumentasi Kegiatan:</span>
                            <div class="foto-grid">
                                @foreach ($fotosLiterasi as $foto)
                                    <img src="{{ public_path('storage/' . $foto->foto) }}"
                                        alt="Foto Kegiatan Literasi">
                                @endforeach
                            </div>
                        </td>
                    </tr>
                @endif
            </table>

            <table class="penilaian-table">
                <tr>
                    <th>Nilai P5</th>
                </tr>
                <tr>
                    <td>{!! nl2br(e($raport->nilai_p5 ?? '')) !!}</td>
                </tr>

                @if ($fotosP5->count())
                    <tr>
                        <td class="foto-kegiatan-wrapper">
                            <span class="foto-kegiatan-title">Dokumentasi Kegiatan:</span>
                            <div class="foto-grid">
                                @foreach ($fotosP5 as $foto)
                                    <img src="{{ public_path('storage/' . $foto->foto) }}" alt="Foto Kegiatan P5">
                                @endforeach
                            </div>
                        </td>
                    </tr>
                @endif
            </table>

        </div>
    </div>

    <div class="page-break"></div>

    {{-- ================== HALAMAN 4: REFLEKSI + KEHADIRAN + TTD ================== --}}
    <div class="page">
        <img src="{{ public_path('assets/media/background/bg-raport-halaman-new.png') }}" class="page-bg" alt="Background">

        <div class="page-content">

            <table class="penilaian-table">
                <tr>
                    <th>Refleksi Guru</th>
                </tr>
                <tr>
                    <td>{!! nl2br(e($raport->refleksi_guru ?? '')) !!}</td>
                </tr>
            </table>

            <table class="penilaian-table refleksi-orangtua">
                <tr>
                    <th>Refleksi Orang Tua</th>
                </tr>
                <tr>
                    <td>{!! nl2br(e($raport->refleksi_orang_tua ?? '')) !!}</td>
                </tr>
            </table>

            <table class="kehadiran-table no-split">
                <tr class="kehadiran-row-value">
                    <td>{{ $raport->sakit ?? 0 }}</td>
                    <td>{{ $raport->izin ?? 0 }}</td>
                    <td>{{ $raport->tanpa_keterangan ?? 0 }}</td>
                </tr>
                <tr class="kehadiran-row-label">
                    <td class="kh-sakit">Sakit</td>
                    <td class="kh-izin">Izin</td>
                    <td class="kh-tk">Tanpa Keterangan</td>
                </tr>
            </table>

            <div class="footer-review no-split">
                <table>
                    <tr>
                        <th>Tanggal</th>
                        <th>Orang Tua</th>
                        <th>Guru Kelas</th>
                        <th>Kepala Sekolah</th>
                    </tr>
                    <tr>
                        <td>{{ now()->timezone('Asia/Jakarta')->format('d-m-Y') }}</td>
                        <td>
                            {{ optional($raport->anak->orangTua)->nama_ayah ?? '-' }}
                            @if (!empty(optional($raport->anak->orangTua)->nama_ibu))
                                &amp; {{ optional($raport->anak->orangTua)->nama_ibu }}
                            @endif
                        </td>

                        <td>{{ $raport->guru->nama_guru ?? '-' }}</td>
                        <td>{{ $kepala_sekolah->nama_guru ?? '-' }}</td>
                    </tr>
                </table>
            </div>



        </div>
    </div>

</body>

</html>
