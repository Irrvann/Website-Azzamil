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
            /* ✅ biarkan memanjang */
            overflow: visible;
            /* ✅ jangan dipotong */
        }

        .content {
            position: relative;
            z-index: 2;
        }


        /* footer bawah halaman 1 */
        .footer-review {
            position: absolute;
            left: 18mm;
            right: 18mm;
            bottom: 14mm;
            z-index: 5;
        }

        /* pill footer */
        .footer-review .bio-item-smt {
            margin: 0;
            padding: 3mm 5mm;
            border-radius: 999px;
            background: #fde5d6;
            font-size: 11px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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
            width: 36mm;
            height: 48mm;
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
            left: 72mm;
            width: 120mm;
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
            top: calc(110mm + var(--shiftY));
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
            top: calc(125mm + var(--shiftY));
            left: 18mm;
            /* lebih lebar ke kiri */
            width: 80mm;
            /* ✅ tambah lebar */
        }

        .right-metric {
            position: absolute;
            top: calc(125mm + var(--shiftY));
            right: 18mm;
            /* lebih lebar ke kanan */
            width: 80mm;
            /* ✅ tambah lebar */
        }


        .metric {
            background: #fde5d6;
            padding: 2.2mm 4mm;
            border-radius: 999px;
            margin-bottom: 3mm;
        }


        .ddst-section {
            position: relative;
            margin-top: calc(140mm + var(--shiftY));
            /* mulai bawah area header halaman 1 */
            padding: 0 10mm 10mm 10mm;
            padding-bottom: 30mm;
            /* bisa 40–55mm */
            z-index: 2;
        }

        .ddst-section-karakter {
            position: relative;
            margin-top: calc(20mm + var(--shiftY));
            /* mulai bawah area header halaman 1 */
            padding: 0 10mm 10mm 10mm;
            padding-bottom: 30mm;
            /* bisa 40–55mm */
            z-index: 2;
        }

        .ddst-box {
            background: #fff;
            border-radius: 7mm;
            padding: 3mm 5mm;

            max-width: 100%;
            overflow: hidden;

            page-break-inside: auto;
        }


        .ddst-title {
            font-weight: 700;
            font-size: 13px;
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

        .ddst-content-karakter {
            margin-bottom: 6mm;
            line-height: 1.6;

            /* PENTING UNTUK PDF */
            /* white-space: pre-wrap; */
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


        .items-page {
            padding-top: 50mm;
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
            margin-bottom: 3mm;
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
            margin-bottom: 2mm;
            /* jarak bawah (antar baris) */

            white-space: nowrap;
            /* biar tidak pecah 2 baris dalam 1 pill */
            line-height: 1.2;
            /* tinggi pill konsisten */
        }


        /* status */
        /* status */
        .pill-tercapai {
            background: #6cc04a;
            color: #0b2b06;
        }

        .pill-ragu {
            background: #f7d547;
            /* kuning */
            color: #2b2400;
        }

        .pill-belum {
            background: #f05b5b;
            /* merah */
            color: #3a0000;
        }




        /* ======= HALAMAN GALLERY ======= */
        .gallery-page {
            padding-top: 50mm;
            padding-left: 15mm;
            padding-right: 15mm;
            padding-bottom: 15mm;
            z-index: 2;
        }

        .gallery-title {
            font-weight: 700;
            font-size: 14px;
            text-align: center;
            margin-bottom: 6mm;
        }

        .gallery-table {
            width: 100%;
            border-collapse: collapse;
        }

        .gallery-cell {
            width: 50%;
            padding: 4mm;
            vertical-align: top;
        }

        .gallery-card {
            background: #fff;
            border-radius: 7mm;
            padding: 4mm;
            overflow: hidden;
        }

        .gallery-img {
            width: 100%;
            height: 50mm;
            /* 🔽 dari 70mm */
            object-fit: cover;
            display: block;
            border-radius: 4mm;
        }


        .gallery-caption {
            margin-top: 3mm;
            font-size: 10.5px;
            line-height: 1.4;
        }


        /* ===== LEGENDA STATUS DDST (RAPI TENGAH) ===== */
        .legend-table {
            width: 100%;
            border-collapse: collapse;
        }

        .legend-table td {
            vertical-align: middle;
            white-space: nowrap;
        }

        /* wrapper item */
        .legend-item-wrap {
            display: inline-block;
            vertical-align: middle;
            margin-right: 10mm;
            line-height: 5mm;
            /* 🔥 kunci: sama dengan tinggi pill */
        }

        /* pill warna */
        .legend-pill {
            display: inline-block;
            width: 12mm;
            height: 5mm;
            border-radius: 999px;
            vertical-align: middle;
            margin-right: 2mm;
        }

        /* teks */
        .legend-text {
            display: inline-block;
            vertical-align: middle;
            line-height: 5mm;
            /* 🔥 SAMA */
            font-size: 11px;
        }

        .legend-title {
            margin-bottom: 4mm;
        }

        /* warna */
        .legend-pill.tercapai {
            background: #6cc04a;
        }

        .legend-pill.ragu {
            background: #f7d547;
        }

        .legend-pill.belum {
            background: #f05b5b;
        }

        .legend-box {
            background: #fff !important;
            border-radius: 7mm;
            padding: 3mm 5mm;
            margin-top: 4mm;
            page-break-inside: avoid;
            border: 1px solid #ffffff;
            /* opsional, bantu dompdf */
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
                <div class="bio-item">
                    Nama : {{ strtoupper(trim($anak->nama_anak ?? '-')) }}
                </div>

                <div class="bio-row">
                    <div class="bio-item-smt">
                        NISN : {{ $anak->nisn ?? '-' }} &nbsp; | &nbsp;
                        NIPD : {{ $anak->nipd ?? '-' }}
                    </div>

                </div>

                <div class="bio-row">
                    <div class="bio-item-smt">
                        Tanggal Lahir : @if (!empty($anak->tanggal_lahir))
                            {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d-m-Y') }}
                        @else
                            -
                        @endif &nbsp; | &nbsp;
                        Tanggal Pemeriksaan : @if (!empty($ddstTest->tanggal_test))
                            {{ \Carbon\Carbon::parse($ddstTest->tanggal_test)->format('d-m-Y') }}
                        @else
                            -
                        @endif
                    </div>

                </div>


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
                <div class="bio-row">
                    <div class="bio-item-smt">
                        BB : {{ $antropometri->berat_badan ?? '-' }} cm
                        ({{ ucfirst($antropometri->status_bb) ?? '-' }})&nbsp; | &nbsp;
                        TB : {{ $antropometri->tinggi_badan ?? '-' }} kg
                        ({{ ucfirst($antropometri->status_tb) ?? '-' }})
                    </div>

                </div>
            </div>

            <div class="right-metric">
                <div class="bio-row">
                    <div class="bio-item-smt">
                        LK : {{ $antropometri->lingkar_kepala ?? '-' }} &nbsp; | &nbsp;
                        LILA : {{ $antropometri->lingkar_lengan ?? '-' }}
                    </div>
                </div>
            </div>

            <div class="ddst-section">
                <div class="ddst-box">
                    <div class="ddst-title">Interpretasi DDST :</div>
                    <div class="ddst-content">{{ $ddstTest->interpretasi_ddst ?? '' }}</div>

                    <div class="ddst-title">Saran / Rujukan :</div>
                    <div class="ddst-content">{{ $ddstTest->saran_rujukan ?? '' }}</div>
                </div>
            </div>

            <div class="footer-review">
                <div class="bio-item-smt">
                    Tanggal : {{ now()->timezone('Asia/Jakarta')->format('d-m-Y') }}
                    &nbsp; | &nbsp;

                    Guru Pemeriksa : {{ $ddstTest->guru->nama_guru ?? '-' }}

                    &nbsp; | &nbsp;

                    Reviewer : {{ $ddstTest->reviewer->nama ?? '-' }}
                </div>
            </div>



            <div class="page-break"></div>
            {{-- ================== HALAMAN 2: PROFIL & KARAKTER ================== --}}
            <div class="page-continue">
                <div class="ddst-section-karakter">
                    <div class="ddst-box">
                        <div class="ddst-title">Profil & Karakter Anak yang dikenali Guru :</div>
                        <div class="ddst-content-karakter">
                            {{ $ddstTest->profile_dan_karakter_yang_dikenali_guru ?? '' }}
                        </div>
                    </div>
                </div>
                <div class="ddst-section-karakter">
                    <div class="ddst-box">
                        <div class="ddst-title">Profil & Karakter Anak yang dikenali Orang Tua :</div>
                        <div class="ddst-content-karakter">
                            {{ $ddstTest->profile_dan_karakter_yang_dikenali_ortu ?? '' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-break"></div>


            {{-- ================== HALAMAN BARU: ITEM DDST ================== --}}
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

                // ✅ paksa urutan kategori biar konsisten
                $order = ['personal_sosial', 'motorik_halus', 'bahasa', 'motorik_kasar', 'lainnya'];
                $grouped = $grouped->sortBy(function ($val, $key) use ($order) {
                    $idx = array_search($key, $order, true);
                    return $idx === false ? 999 : $idx;
                });

                // 🔥 2 kategori per halaman
                $kategoriChunks = $grouped->chunk(2);
            @endphp

            @foreach ($kategoriChunks as $pageIndex => $kategoriPerHalaman)
                <div class="items-page">
                    @foreach ($kategoriPerHalaman as $kategori => $rows)
                        <div class="kategori-box">
                            <div class="ddst-title">
                                {{ $kategoriLabel[$kategori] ?? ucwords(str_replace('_', ' ', $kategori)) }}
                            </div>

                            <div class="pills">
                                @foreach ($rows as $row)
                                    @php
                                        $pillClass = match ($row->status) {
                                            'tercapai' => 'pill-tercapai',
                                            'ragu_ragu' => 'pill-ragu',
                                            'belum_tercapai' => 'pill-belum',
                                            default => 'pill-belum',
                                        };
                                    @endphp

                                    <span class="pill {{ $pillClass }}">
                                        {{ $row->item->nama_item ?? '-' }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    {{-- ✅ LEGENDA muncul di halaman yang ADA motorik_kasar (jadi setelah kontennya) --}}
                    @if ($kategoriPerHalaman->keys()->contains('motorik_kasar'))
                        <div class="legend-box">
                            <div class="legend-title">Keterangan Status DDST :</div>

                            <table class="legend-table">
                                <tr>
                                    <td>
                                        <span class="legend-item-wrap">
                                            <span class="legend-pill tercapai"></span>
                                            <span class="legend-text">= Tercapai</span>
                                        </span>

                                        <span class="legend-item-wrap">
                                            <span class="legend-pill ragu"></span>
                                            <span class="legend-text">= Ragu-Ragu</span>
                                        </span>

                                        <span class="legend-item-wrap">
                                            <span class="legend-pill belum"></span>
                                            <span class="legend-text">= Belum Tercapai</span>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @endif
                </div>

                {{-- page break kecuali halaman terakhir --}}
                @if ($pageIndex < $kategoriChunks->count() - 1)
                    <div class="page-break"></div>
                @endif
            @endforeach





            <div class="page-break"></div>

            @php
                $fotos = $galleryFotos ?? collect();
                $chunks = $fotos->chunk(6); // ✅ 1 halaman = 6 foto
            @endphp

            @if ($fotos->isEmpty())
                <div class="gallery-page">
                    <div class="ddst-box">
                        <div class="ddst-title">Gallery Anak</div>
                        <div class="ddst-content">Belum ada foto.</div>
                    </div>
                </div>
            @else
                @foreach ($chunks as $chunkIndex => $chunk)
                    <div class="gallery-page">
                        <div class="ddst-box">
                            <div class="ddst-title">
                                Gallery Anak
                                @if ($chunks->count() > 1)
                                    ({{ $chunkIndex + 1 }}/{{ $chunks->count() }})
                                @endif
                            </div>

                            <table class="gallery-table">
                                <tr>
                                    @foreach ($chunk->values() as $i => $foto)
                                        <td class="gallery-cell">
                                            <div class="gallery-card">
                                                <img class="gallery-img"
                                                    src="{{ public_path('storage/' . $foto->foto) }}" alt="Foto Anak">

                                                @if (!empty($foto->keterangan))
                                                    <div class="gallery-caption">{{ $foto->keterangan }}</div>
                                                @endif
                                            </div>
                                        </td>

                                        @if ($i % 2 == 1 && $i != $chunk->count() - 1)
                                </tr>
                                <tr>
                @endif
            @endforeach

            {{-- kalau ganjil, tutup kolom kosong --}}
            @if ($chunk->count() % 2 == 1)
                <td class="gallery-cell"></td>
            @endif
            </tr>
            </table>
        </div>
    </div>

    {{-- page break antar halaman gallery --}}
    @if ($chunkIndex < $chunks->count() - 1)
        <div class="page-break"></div>
    @endif
    @endforeach
    @endif

    </div>


    </div>


    </div>
    </div>
</body>

</html>
