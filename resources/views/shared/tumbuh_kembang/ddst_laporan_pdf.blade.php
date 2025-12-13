<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Tumbuh Kembang Anak</title>

    <style>
        @page {
            size: A4 portrait;
            margin: 0;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        * {
            box-sizing: border-box;
        }

        /* ✅ BG harus di luar .page supaya repeat tiap halaman */
        .page-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 210mm;
            height: 297mm;
            z-index: -1;
            /* ✅ penting: di belakang semua konten */
        }

        .page-bg img {
            width: 210mm;
            height: 297mm;
            object-fit: cover;
            display: block;
        }

        .page {
            position: relative;
            width: 210mm;
            min-height: 297mm;
        }

        .content {
            position: relative;
            z-index: 2;
        }

        /* === OFFSET GLOBAL (SEMUA TURUN) === */
        :root {
            --shiftY: 12mm;
            /* <-- NAHK INI: tambah kalau mau makin turun */
        }

        /* 1) UMUR */
        .umur {
            position: absolute;
            top: calc(40mm + var(--shiftY));
            right: 18mm;
            background: #fde7ef;
            padding: 6px 14px;
            border-radius: 999px;
            font-weight: 700;
        }

        /* 2) FOTO */
        .foto-wrapper {
            position: absolute;
            top: calc(50mm + var(--shiftY));
            left: 18mm;
            width: 50mm;
            height: 63mm;
            background: #ffd6e8;
            border-radius: 8mm;
            padding: 3mm;
        }

        .foto-inner {
            width: 100%;
            height: 100%;
            background: #fff;
            border-radius: 6mm;
            overflow: hidden;
        }

        .foto-inner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* BIODATA kanan — DIGESER & DIPERSEMPIT */
        /* BIODATA */
        .biodata {
            position: absolute;
            top: calc(50mm + var(--shiftY));
            left: 85mm;
            width: 107mm;
        }

        /* ITEM biodata */
        .bio-item {
            background: #fde5d6;
            padding: 3mm 5mm;
            border-radius: 999px;
            margin-bottom: 4mm;
            /* 🔥 jarak antar baris lebih lega */
            font-size: 11px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .bio-item-smt {
            background: #fde5d6;
            padding: 3mm 5mm;
            border-radius: 999px;
            margin-bottom: 4mm;
            /* 🔥 jarak antar baris lebih lega */
            font-size: 11px;
            white-space: nowrap;
        }

        /* Baris semester & tahun */
        .bio-row {
            display: flex;
            gap: 6mm;
            /* 🔥 jarak tengah diperlebar */
        }

        .bio-row .bio-item {
            width: calc(50% - 3mm);
            margin-bottom: 0;
        }

        /* 4) STATUS GIZI */
        .status-gizi {
            position: absolute;
            top: calc(126mm + var(--shiftY));
            left: 65mm;
            width: 70mm;
            text-align: center;
            background: #fde5d6;
            padding: 2.5mm 4mm;
            border-radius: 999px;
            font-weight: 700;
        }

        /* 5) METRIC KIRI */
        .left-metric {
            position: absolute;
            top: calc(142mm + var(--shiftY));
            left: 38mm;
            width: 60mm;
        }

        /* 6) METRIC KANAN */
        .right-metric {
            position: absolute;
            top: calc(142mm + var(--shiftY));
            right: 38mm;
            width: 60mm;
        }

        .metric {
            background: #fde5d6;
            padding: 2.2mm 4mm;
            border-radius: 999px;
            margin-bottom: 3mm;
        }


        .ddst-section {
            position: relative;
            margin-top: calc(175mm + var(--shiftY));
            /* mulai bawah area header halaman 1 */
            padding: 0 15mm 15mm 15mm;
            padding-bottom: 45mm;
            /* bisa 40–55mm */
            z-index: 2;
        }

        .ddst-box {
            background: #fff;
            border-radius: 7mm;
            padding: 6mm 8mm;

            max-width: 100%;
            overflow: hidden;

            page-break-inside: auto;
        }


        .ddst-title {
            font-weight: 700;
            margin-bottom: 3mm;
        }

        .ddst-content {
            margin-bottom: 6mm;
            line-height: 1.6;

            /* PENTING UNTUK PDF */
            white-space: pre-wrap;
            /* ganti dari pre-line */
            word-wrap: break-word;
            overflow-wrap: break-word;
            word-break: break-word;

            max-width: 100%;
        }



        /* paksa break jika perlu */
        .page-break {
            page-break-before: always;
        }

        /* wrapper khusus untuk halaman baru */
        .page-continue {
            padding-top: 30mm;
            /* 🔥 jarak dari atas halaman */
        }

        /* TTD ada di bawah setelah ddst-section */
        .ttd-bottom {
            margin: 10mm 15mm 0 15mm;
            /* sejajar padding ddst-section */
            text-align: right;
            page-break-inside: avoid;
            /* jangan kepotong */
        }

        .ttd-bottom .box {
            display: inline-block;
            width: 70mm;
            text-align: center;
            font-size: 11px;
        }

        .ttd-bottom .jabatan {
            margin-top: 3mm;
            margin-bottom: 18mm;
            /* ruang tanda tangan */
        }

        .ttd-bottom .nama {
            text-decoration: underline;
            font-weight: 700;
        }

        .items-page {
            padding-top: 40mm;
            /* 🔥 jarak dari atas halaman */
            padding-left: 15mm;
            padding-right: 15mm;
            padding-bottom: 15mm;
            z-index: 2;
        }


        /* box PER KATEGORI */
        .kategori-box {
            background: #fff;
            border-radius: 7mm;
            padding: 6mm 8mm;
            margin-bottom: 8mm;
            page-break-inside: avoid;
            /* jangan potong di tengah box */
        }

        .kategori-title {
            font-weight: 700;
            margin-bottom: 4mm;
        }

        /* jangan rely ke flex gap (dompdf suka aneh) */
        .pills {
            /* boleh flex, tapi gap jangan dipakai */
            display: block;
            /* paling aman */
        }

        /* pill jadi inline-block + margin bawah & kanan */
        .pill {
            display: inline-block;
            padding: 2mm 4mm;
            border-radius: 999px;
            font-weight: 600;
            font-size: 11px;

            margin-right: 3mm;
            /* jarak samping */
            margin-bottom: 3mm;
            /* jarak bawah (antar baris) */

            white-space: nowrap;
            /* biar tidak pecah 2 baris dalam 1 pill */
            line-height: 1.2;
            /* tinggi pill konsisten */
        }


        /* status */
        .pill-tercapai {
            background: #6cc04a;
            color: #0b2b06;
        }

        .pill-belum {
            background: #f7d547;
            color: #2b2400;
        }
    </style>
</head>

<body>
    <!-- ✅ BG di luar .page (repeat tiap halaman) -->
    <div class="page-bg">
        <img src="{{ public_path('assets/media/background/bg-laporan.png') }}" alt="BG">
    </div>

    <div class="page">


        <div class="content">
            <div class="umur">
                Umur ({{ $usiaFormatted ?? '-' }})
            </div>

            {{-- FOTO --}}
            <div class="foto-wrapper">
                <div class="foto-inner">
                    <img src="{{ public_path('storage/' . $anak->foto) }}" alt="Foto Anak">
                </div>
            </div>

            <div class="biodata">
                <div class="bio-item">Nama : {{ $anak->nama_anak ?? '-' }}</div>
                <div class="bio-item">
                    Tanggal lahir :
                    @if (!empty($anak->tanggal_lahir))
                        {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d-m-Y') }}
                    @else
                        -
                    @endif
                </div>
                <div class="bio-item">NISN : {{ $anak->nisn ?? '-' }}</div>
                <div class="bio-item">NIPD : {{ $anak->nipd ?? '-' }}</div>

                <div class="bio-row">
                    <div class="bio-item-smt">
                        Semester : {{ $ddstTest->semester ?? '-' }} &nbsp; | &nbsp;
                        Tahun Ajaran : {{ $ddstTest->tahun_ajaran ?? '-' }}
                    </div>

                </div>
            </div>

            <div class="status-gizi">
                Status Gizi :
                @php
                    $status = $antropometri->status_gizi ?? '';
                @endphp

                @if ($status === 'gizi_berlebih')
                    Gizi Berlebih
                @elseif ($status === 'gizi_kurang')
                    Gizi Kurang
                @elseif ($status === 'normal')
                    Normal
                @else
                    -
                @endif
            </div>


            <div class="left-metric">
                <div class="metric">Tinggi Badan : {{ $antropometri->tinggi_badan ?? '-' }} cm
                    ({{ ucfirst($antropometri->status_tb) ?? '-' }})</div>
                <div class="metric">Berat Badan : {{ $antropometri->berat_badan ?? '-' }} kg (
                    {{ ucfirst($antropometri->status_bb) ?? '-' }})</div>
            </div>

            <div class="right-metric">
                <div class="metric">Lingkar Kepala : {{ $antropometri->lingkar_kepala ?? '-' }} cm</div>
                <div class="metric">Lingkar Lengan : {{ $antropometri->lingkar_lengan ?? '-' }} cm</div>
            </div>

            <div class="ddst-section">
                <div class="ddst-box">
                    <div class="ddst-title">Interpretasi DDST :</div>
                    <div class="ddst-content">{{ $ddstTest->interpretasi_ddst ?? '' }}</div>

                    <div class="ddst-title">Tugas perkembangan yang belum tercapai :</div>
                    <div class="ddst-content">{{ $ddstTest->tugas_belum_tercapai ?? '' }}</div>

                    <div class="ddst-title">Tugas perkembangan yang perlu ditingkatkan :</div>
                    <div class="ddst-content">{{ $ddstTest->tugas_perlu_ditingkatkan ?? '' }}</div>

                    <div class="ddst-title">Saran / Rujukan :</div>
                    <div class="ddst-content">{{ $ddstTest->saran_rujukan ?? '' }}</div>
                </div>
            </div>
            <!-- TTD (DI LUAR INTERPRETASI/DDST BOX, setelah ddst-section) -->
            <div class="ttd-bottom">
                <div class="box">
                    <div>Pekalongan, .............................................</div>
                    <div class="jabatan">Pemeriksa,</div>
                    <!-- NAMA DI ATAS GARIS -->
                    <div class="ttd-nama">
                        {{ $guru->nama_guru ?? ($guru->nama ?? '') }}
                    </div>

                    <div class="ttd-garis">
                        .............................................
                    </div>
                </div>
            </div>


            {{-- ================== HALAMAN BARU: ITEM DDST ================== --}}
            <div class="page-break"></div>

            @php
                $grouped = ($ddstTest->items ?? collect())->groupBy(function ($row) {
                    return $row->item->kategori_perkembangan ?? 'lainnya';
                });

                $kategoriLabel = [
                    'personal_sosial' => 'Personal Sosial',
                    'motorik_halus' => 'Motorik Halus',
                    'bahasa' => 'Bahasa',
                    'motorik_kasar' => 'Motorik Kasar',
                    'lainnya' => 'Lainnya',
                ];
            @endphp

            <div class="items-page">
                @foreach ($grouped as $kategori => $rows)
                    <div class="kategori-box">
                        <div class="kategori-title">
                            {{ $kategoriLabel[$kategori] ?? ucwords(str_replace('_', ' ', $kategori)) }}
                        </div>

                        <div class="pills">
                            @foreach ($rows as $row)
                                <span class="pill {{ $row->status === 'tercapai' ? 'pill-tercapai' : 'pill-belum' }}">
                                    {{ $row->item->nama_item ?? '-' }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>
