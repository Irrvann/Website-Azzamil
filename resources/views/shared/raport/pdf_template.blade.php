<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Raport {{ $raport->anak->nama_anak ?? '' }}</title>

    <style>
        @page {
            margin: 0;
            /* supaya background full A4 */
        }

        * {
            font-family: DejaVu Sans, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            font-size: 11px;
        }

        /* --- COVER PAGE --- */
        /* --- COVER PAGE --- */
        .cover-page {
            position: relative;
            width: 100%;
            height: 100vh;
        }

        /* background cover */
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
            /* krem */
            overflow: hidden;
        }

        /* posisi khusus masing-masing bar */

        /* Bar NAMA → dinaikkan sedikit dari semula (dulu 90px) */
        .cover-nama-bar-nama {
            bottom: 185px;
            /* naik sekitar 25px dari posisi awal */
        }

        /* Bar NISN/NIPD → di bawah NAMA */
        .cover-nama-bar-nisn {
            bottom: 140px;
            /* agak di bawah bar nama */
        }

        /* bagian biru "NAMA" */
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

        /* teks di tengah benar-benar center */
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

        /* teks nama anak */
        .cover-nama-value {
            position: absolute;
            left: 135px;
            /* setelah label biru */
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

        .page-bg {
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
            /* hijau muda */
            font-weight: bold;
            text-align: center;
            font-size: 13px;
            padding: 6px 0;
        }

        .bio-label {
            width: 28%;
            background-color: #e8f3ff;
            /* biru muda lembut */
            font-weight: bold;
        }

        .bio-value {
            background-color: #f9fcff;
            /* putih kebiruan */
        }

        .foto-wrapper {
            width: 32%;
            text-align: center;
            background-color: #f1faff;
            /* biru sangat muda */
            border: 1px solid #000;
            padding: 8px;
        }

        .foto-anak {
            width: 150px;
            /* FOTO LEBIH BESAR */
            height: auto;
            /* proporsional */
            max-height: 200px;
            /* biar tidak terlalu tinggi */

            object-fit: contain;
            background: #fff;
            border-radius: 8px;
            border: 1px solid #666;
            padding: 4px;
            /* frame putih tipis */
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
            text-align: justify;
            line-height: 1.55;
        }

        /* ================== FOTO KEGIATAN ================== */

        .foto-kegiatan-wrapper {
            padding: 10px;
            border-top: none;
        }

        .foto-kegiatan-title {
            display: block;
            margin-bottom: 8px;
            font-size: 11px;
            font-weight: bold;
        }

        .foto-grid {
            margin-top: 30px;
            /* jarak aman untuk PDF */
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
        }

        .kehadiran-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 25px;
            table-layout: fixed;
            /* supaya 3 kolom sama lebar */
        }

        .kehadiran-table td {
            border: 1px solid #000;
            text-align: center;
            font-size: 11px;
            padding: 4px 0;
        }

        /* Baris angka (atas) */
        .kehadiran-row-value td {
            background-color: #ffffff;
            font-weight: bold;
            font-size: 12px;
        }

        /* Baris label (bawah) */
        .kehadiran-row-label td {
            font-weight: bold;
        }

        /* Warna label per kolom */
        .kh-sakit {
            background-color: #f8d1b0;
            /* peach */
        }

        .kh-izin {
            background-color: #cbd8f5;
            /* biru muda */
        }

        .kh-tk {
            background-color: #d8eec8;
            /* hijau muda */
        }

        .refleksi-orangtua td {
            padding-top: 40px !important;
            padding-bottom: 40px !important;
        }
    </style>
</head>

<body>

    <div class="cover-page">
        {{-- background cover --}}
        <img src="{{ public_path('assets/media/background/bg-cover-raport-3.png') }}" alt="Cover Raport" class="cover-bg">

        {{-- kotak NAMA --}}
        <div class="cover-nama-bar cover-nama-bar-nama">
            <div class="cover-nama-label">
                <span>NAMA</span>
            </div>
            <div class="cover-nama-value">
                {{ $raport->anak->nama_anak ?? '' }}
            </div>
        </div>

        {{-- kotak NISN / NIPD --}}
        <div class="cover-nama-bar cover-nama-bar-nisn">
            <div class="cover-nama-label">
                <span>NISN/NIPD</span>
            </div>
            <div class="cover-nama-value">
                {{ $raport->anak->nisn ?? '' }} / {{ $raport->anak->nipd ?? '' }}
            </div>
        </div>
    </div>



    <div class="page-break"></div>

    {{-- BACKGROUND FULL PAGE --}}
    <img src="{{ public_path('assets/media/background/bg-raport-paud.png') }}" class="page-bg" alt="Background">

    <div class="page-content">
        @php
            $antrop = $raport->anak->antropometris->sortByDesc('created_at')->first();
            $fotosAgama = $raport->fotos->where('komponen', 'agama');
            $fotosJatiDiri = $raport->fotos->where('komponen', 'jati_diri');
            $fotosMotorik = $raport->fotos->where('komponen', 'motorik');
            $fotosLiterasi = $raport->fotos->where('komponen', 'literasi_sains');
            $fotosP5 = $raport->fotos->where('komponen', 'p5');
        @endphp

        {{-- ================== HEADER / BIODATA ================== --}}
        <table class="header-table">
            <tr>
                <th class="table-title" colspan="3">
                    LAPORAN PERKEMBANGAN ANAK DIDIK
                </th>
            </tr>

            {{-- Foto + Nama --}}
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

            {{-- Sekolah --}}
            <tr>
                <th class="bio-label">Sekolah</th>
                <td class="bio-value">{{ $raport->anak->sekolah->nama_sekolah ?? '-' }}</td>
            </tr>

            {{-- Guru --}}
            <tr>
                <th class="bio-label">Guru Kelas</th>
                <td class="bio-value">{{ $raport->guru->nama_guru ?? '-' }}</td>
            </tr>

            {{-- Semester --}}
            <tr>
                <th class="bio-label">Semester</th>
                <td class="bio-value">{{ $raport->semester ?? '-' }}</td>
            </tr>

            {{-- Tahun Ajaran --}}
            <tr>
                <th class="bio-label">Tahun Ajaran</th>
                <td class="bio-value">{{ $raport->tahun_ajaran ?? '-' }}</td>
            </tr>

            {{-- NIPD --}}
            <tr>
                <th class="bio-label">NIPD</th>
                <td class="bio-value">{{ $raport->anak->nipd ?? '-' }}</td>
            </tr>

            {{-- NISN --}}
            <tr>
                <th class="bio-label">NISN</th>
                <td class="bio-value">{{ $raport->anak->nisn ?? '-' }}</td>
            </tr>

            {{-- BB / TB --}}
            <tr>
                <th class="bio-label">BB / TB</th>
                <td class="bio-value">
                    {{ $antrop?->berat_badan ?? '-' }} kg,
                    {{ $antrop?->tinggi_badan ?? '-' }} cm
                </td>
            </tr>
        </table>

        {{-- ================== 1. NILAI AGAMA & BUDI PEKERTI ================== --}}
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

        {{-- ================== 2. NILAI JATI DIRI / SOSIAL EMOSIONAL ================== --}}
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
                                <img src="{{ public_path('storage/' . $foto->foto) }}" alt="Foto Kegiatan Jati Diri">
                            @endforeach
                        </div>
                    </td>
                </tr>
            @endif
        </table>

        {{-- ================== 3. MOTORIK & KESEHATAN (opsional) ================== --}}
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
                                    <img src="{{ public_path('storage/' . $foto->foto) }}" alt="Foto Kegiatan Motorik">
                                @endforeach
                            </div>
                        </td>
                    </tr>
                @endif
            </table>
        @endif

        {{-- ================== 4. BAHASA & LITERASI AWAL ================== --}}
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
                                <img src="{{ public_path('storage/' . $foto->foto) }}" alt="Foto Kegiatan Literasi">
                            @endforeach
                        </div>
                    </td>
                </tr>
            @endif
        </table>

        {{-- ================== 5. SENI, KREATIVITAS & EKSPRESI (P5) ================== --}}
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




        <table class="kehadiran-table">
            {{-- Baris angka --}}
            <tr class="kehadiran-row-value">
                <td>{{ $raport->sakit ?? 0 }}</td>
                <td>{{ $raport->izin ?? 0 }}</td>
                <td>{{ $raport->tanpa_keterangan ?? 0 }}</td>
            </tr>

            {{-- Baris label --}}
            <tr class="kehadiran-row-label">
                <td class="kh-sakit">Sakit</td>
                <td class="kh-izin">Izin</td>
                <td class="kh-tk">Tanpa Keterangan</td>
            </tr>
        </table>

        <br><br>

        {{-- ================== WRAPPER PUTIH ================== --}}
        <div style="
    background:#ffffff;
    padding:25px;
    margin-top:20px;
    border-radius:6px;
">

            {{-- ================== TANDA TANGAN ORANG TUA & GURU ================== --}}
            <table style="width:100%; font-size:12px;">
                <tr>
                    <td style="text-align:left; width:50%;">
                        Mengetahui,<br>
                        Orang Tua / Wali Murid
                    </td>
                    <td style="text-align:right; width:50%;">
                        Kudus, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
                        Guru Kelas
                    </td>
                </tr>

                {{-- Ruang tanda tangan --}}
                <tr>
                    <td style="height:70px;"></td>
                    <td></td>
                </tr>

                {{-- Nama penanda tangan --}}
                <tr>
                    <td style="text-align:left;">
                        <u>…………………………………….</u>
                    </td>
                    <td style="text-align:right;">
                        <u>{{ $raport->guru->nama_guru ?? '................................' }}</u>
                    </td>
                </tr>
            </table>

            <br><br>

            {{-- ================== TANDA TANGAN KEPALA SEKOLAH (TENGAH) ================== --}}
            <table style="width:100%; font-size:12px; margin-top:10px;">
                <tr>
                    <td style="text-align:center;">
                        Mengetahui,<br>
                        Kepala TK {{ $raport->anak->sekolah->nama_sekolah ?? '........................' }}
                    </td>
                </tr>

                {{-- Ruang tanda tangan --}}
                <tr>
                    <td style="height:70px;"></td>
                </tr>

                <tr>
                    <td style="text-align:center;">
                        <u>{{ $kepala_sekolah->nama_guru ?? '................................' }}</u>
                    </td>
                </tr>
            </table>

        </div>


    </div>

</body>

</html>
