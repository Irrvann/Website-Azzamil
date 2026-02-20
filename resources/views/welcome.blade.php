<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Azzamil School - E-Raport</title>

    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

    <link rel="icon" href="assets/logo-azzamil.png" sizes="any" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/logo-azzamil.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/logo-azzamil.png" />
    <link rel="apple-touch-icon" href="assets/logo-azzamil.png" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cream: "#F6F2D4",
                        cream2: "#FBF8E3",
                        tealBtn: "#10B981",
                        tealBtnDark: "#059669",
                        skyTitle: "#20A6DD",
                        gold: "#F2B705",
                        softGrayWave: "#D8D8D8",
                        cardBorder: "#E9E9E9",
                        ink: "#2D2D2D",
                    },
                    boxShadow: {
                        soft: "0 10px 30px rgba(0,0,0,0.08)",
                        card: "0 8px 20px rgba(0,0,0,0.06)",
                    },
                    borderRadius: {
                        xl2: "1.25rem",
                    },
                },
            },
        };
    </script>

    <style>
        .doodle-bg {
            position: relative;
            background-color: #f6f2d4;
            background-image: url("assets/bg-home.png");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: 0;
        }

        .doodle-bg::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(246, 242, 212, 0.7);
            z-index: -1;
        }

        @keyframes wave1 {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        @keyframes wave2 {
            0% {
                transform: translateX(-50%);
            }

            100% {
                transform: translateX(0);
            }
        }

        @keyframes wave3 {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-wave1 {
            animation: wave1 12s linear infinite;
        }

        .animate-wave2 {
            animation: wave2 18s linear infinite;
        }

        .animate-wave3 {
            animation: wave3 22s linear infinite;
        }

        @keyframes floatUpDown {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .float-animation {
            animation: floatUpDown 4s ease-in-out infinite;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-up {
            animation: fadeUp 0.8s ease forwards;
        }

        .delay-1 {
            animation-delay: 0.1s;
        }

        .delay-2 {
            animation-delay: 0.3s;
        }

        .delay-3 {
            animation-delay: 0.5s;
        }

        @keyframes softPulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.8;
            }

            50% {
                transform: scale(1.15);
                opacity: 1;
            }
        }

        .pulse-soft {
            animation: softPulse 2.5s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-white text-ink">
    <header class="doodle-bg">
        <div class="mx-auto max-w-6xl px-5">
            <div class="flex items-center justify-between py-5">
                <a href="#" class="flex items-center gap-2">
                    <img src="assets/logo-azzamil.png" onerror="this.style.display = 'none'" alt="Azzamil School"
                        class="h-10 w-auto" />
                    <span class="text-xl font-bold">Azzamil School</span>
                </a>
                <div class="hidden md:flex items-center gap-8">
                    <nav class="flex items-center gap-3 text-md font-medium">
                        <a href="#home"
                            class="px-4 py-2 rounded-full transition-all duration-300 hover:bg-tealBtnDark hover:text-white">
                            Home
                        </a>
                        <a href="#about"
                            class="px-4 py-2 rounded-full transition-all duration-300 hover:bg-tealBtnDark hover:text-white">
                            About
                        </a>
                        <a href="#contact"
                            class="px-4 py-2 rounded-full transition-all duration-300 hover:bg-tealBtnDark hover:text-white">
                            Contact
                        </a>
                    </nav>

                    <a href="/login"
                        class="inline-flex items-center gap-2 rounded-full bg-tealBtn px-4 py-2 text-sm font-semibold text-white shadow-soft hover:bg-tealBtnDark transition">
                        <img src="assets/logo-pengguna.png" alt="Login Icon" class="w-4 h-4 object-contain" />
                        Login
                    </a>
                </div>

                <button id="menuBtn"
                    class="md:hidden inline-flex items-center justify-center rounded-full border border-cardBorder bg-white/80 p-2 shadow-soft backdrop-blur transition hover:bg-white"
                    aria-label="Open menu" aria-expanded="false">

                    <svg id="iconHamburger" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>

                    <svg id="iconClose" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div id="mobileMenu" class="md:hidden hidden pb-6">
                <div class="rounded-xl2 border border-cardBorder bg-white/90 shadow-card backdrop-blur p-3">
                    <nav class="grid gap-2 text-sm font-medium">
                        <a href="#home" class="rounded-xl px-4 py-3 transition hover:bg-green-50">Home</a>
                        <a href="#about" class="rounded-xl px-4 py-3 transition hover:bg-green-50">About</a>
                        <a href="#contact" class="rounded-xl px-4 py-3 transition hover:bg-green-50">Contact</a>
                    </nav>

                    <div class="mt-3 px-2">
                        <a href="/login"
                            class="w-full inline-flex items-center justify-center gap-2 rounded-full bg-tealBtn px-4 py-3 text-sm font-semibold text-white shadow-soft hover:bg-tealBtnDark transition">
                            <img src="assets/logo-pengguna.png" alt="Login Icon" class="w-4 h-4 object-contain" />
                            Login
                        </a>
                    </div>
                </div>
            </div>

            <div id="home" class="grid items-center gap-10 pb-10 pt-6 md:grid-cols-2">

                <div class="relative" data-aos="fade-right" data-aos-delay="100">

                    <div class="mb-6 flex items-center" data-aos="fade-down-right" data-aos-delay="400">
                        <img src="assets/bulat-1.png" alt="" class="h-10 w-10 object-contain" />
                        <img src="assets/segitiga.png" alt="" class="h-10 w-10 object-contain -ml-1" />
                        <img src="assets/kotak.png" alt="" class="h-10 w-10 object-contain -ml-1" />
                        <img src="assets/bulat-2.png" alt="" class="h-10 w-10 object-contain -ml-1" />
                    </div>

                    <p class="text-3xl font-extrabold text-skyTitle md:text-4xl">
                        Aplikasi E-Raport
                    </p>

                    <h1 class="mt-3 text-[25px] font-extrabold leading-[1.12] text-[#4A3F3A] md:text-[44px]">
                        Optimalkan Proses Penilaian Siswa Anda dengan Aplikasi
                        <span class="whitespace-nowrap">
                            E-Raport
                            <span class="relative inline-block text-gold">
                                AZZAMIL SCHOOL
                                <span class="absolute left-0 -bottom-1 h-[3px] w-full bg-green-500"></span>
                            </span>
                        </span>
                    </h1>

                    <p class="mt-5 max-w-xl text-lg leading-relaxed text-[#111]">
                        Azzamil School memberikan pendidikan berkualitas dengan
                        menggabungkan kurikulum nasional dan nilai-nilai karakter. Kami
                        berkomitmen untuk mengembangkan potensi setiap siswa menjadi
                        pribadi yang unggul dan berintegritas.
                    </p>

                    <div class="mt-3 flex justify-center md:justify-start">
                        <a href="/login"
                            class="inline-flex h-12 min-w-[160px] items-center justify-center rounded-full bg-tealBtn px-10 text-lg font-semibold text-black shadow-soft hover:bg-tealBtnDark hover:text-white transition">
                            Login
                        </a>
                    </div>
                </div>

                <div class="flex justify-center md:justify-end" data-aos="fade-left" data-aos-delay="200">
                    <img src="assets/hero1.png"
                        onerror="
                this.outerHTML = `<div class='h-[420px] w-[260px] rounded-[40px] border-4 border-black bg-white shadow-soft grid place-items-center text-center p-6'>
      <div class='text-xs text-gray-600'>Placeholder</div>
      <div class='mt-2 font-semibold'>Gambar HP / Screenshot Login</div>
    </div>`
              "
                        alt="Mockup E-Raport" class="h-[530px] w-auto drop-shadow-2xl float-animation" />
                </div>
            </div>
        </div>

        <div class="-mt-3 overflow-hidden leading-none">
            <div class="relative w-full overflow-hidden">
                <svg viewBox="0 0 2880 120" class="w-[200%] animate-wave1" preserveAspectRatio="none">
                    <path d="M0,40 C120,70 240,10 360,40 C480,70 600,110 720,80
           C840,50 960,10 1080,30 C1200,50 1320,90 1440,60
           C1560,30 1680,80 1800,60 C1920,40 2040,10 2160,40
           C2280,70 2400,110 2520,80 C2640,50 2760,10 2880,40
           L2880,120 L0,120 Z" fill="#D8D8D8" />
                </svg>
            </div>

            <div class="relative w-full overflow-hidden -mt-16">
                <svg viewBox="0 0 2880 120" class="w-[200%] animate-wave2" preserveAspectRatio="none">
                    <path d="M0,70 C160,40 320,90 480,70
           C640,50 800,20 960,45
           C1120,70 1280,100 1440,70
           C1600,40 1760,90 1920,70
           C2080,50 2240,20 2400,45
           C2560,70 2720,100 2880,70
           L2880,120 L0,120 Z" fill="#F6F2D4" />
                </svg>
            </div>

            <div class="relative w-full overflow-hidden -mt-16">
                <svg viewBox="0 0 2880 120" class="w-[200%] animate-wave3" preserveAspectRatio="none">
                    <path d="M0,85 C180,55 360,110 540,85
           C720,60 900,30 1080,55
           C1260,80 1440,110 1620,85
           C1800,60 1980,30 2160,55
           C2340,80 2520,110 2700,85
           C2790,72 2835,70 2880,75
           L2880,120 L0,120 Z" fill="#FFFFFF" />
                </svg>
            </div>
        </div>
    </header>

    <main class="bg-white">
        <section id="about" class="mx-auto max-w-6xl px-5 py-12">
            <div class="grid gap-10 md:grid-cols-2">
                <div class="flex flex-col justify-center h-full" data-aos="fade-up" data-aos-delay="300">
                    <h2 class="text-3xl font-extrabold leading-tight text-ink">
                        Apa itu <span class="text-gold">e-RAPORT?</span>
                    </h2>

                    <p class="mt-4 max-w-md text-sm leading-relaxed text-[#3b3b3b]">
                        E-raport adalah sistem informasi berbasis web yang digunakan untuk
                        mengelola, menyimpan, dan menampilkan nilai akademik siswa secara
                        digital, sehingga memudahkan guru dalam pengolahan data serta
                        orang tua memantau perkembangan belajar siswa.
                    </p>

                    <a href="#"
                        class="mt-6 w-fit inline-flex items-center gap-2 rounded-full bg-tealBtn px-6 py-2 text-sm font-semibold text-black shadow-soft hover:bg-tealBtnDark hover:text-white">
                        Read More
                        <span class="text-lg leading-none">→</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="group rounded-xl2 border border-cardBorder bg-white p-5 shadow-card transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:bg-green-50 hover:border-green-200"
                        data-aos="zoom-in" data-aos-delay="100">
                        <div class="flex items-start gap-3">
                            <div
                                class="mt-1 rounded-lg bg-green-100 p-3 flex items-center justify-center transition-all duration-300 group-hover:bg-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8 text-green-600 transition-all duration-300 group-hover:text-white group-hover:scale-110"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 5h6m-6 4h6m-7 10h8a2 2 0 002-2V7a2 2 0 00-2-2h-1a2 2 0 01-2-2H9a2 2 0 01-2 2H6a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3
                                    class="font-extrabold text-green-700 text-sm leading-snug transition-colors duration-300 group-hover:text-green-600">
                                    Monitoring Tumbuh<br />Kembang (DDST)
                                </h3>
                                <p class="mt-2 text-xs leading-relaxed text-[#4b4b4b]">
                                    Monitoring Tumbuh Kembang (DDST) membantu memantau
                                    perkembangan motorik kasar, motorik halus, bahasa, dan
                                    sosial anak secara berkala dan terstruktur.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="group rounded-xl2 border border-cardBorder bg-white p-5 shadow-card transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:bg-green-50 hover:border-green-200"
                        data-aos="zoom-in" data-aos-delay="200">
                        <div class="flex items-start gap-3">
                            <div
                                class="mt-1 rounded-lg bg-green-100 p-3 flex items-center justify-center transition-all duration-300 group-hover:bg-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8 text-green-600 transition-all duration-300 group-hover:text-white group-hover:scale-110"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 21s-7-4.35-9.5-8.5C.6 9.6 2.4 6.5 6 6.5c1.9 0 3.2.95 4 2 .8-1.05 2.1-2 4-2 3.6 0 5.4 3.1 3.5 6-2.5 4.15-9.5 8.5-9.5 8.5z" />
                                </svg>
                            </div>
                            <div>
                                <h3
                                    class="font-extrabold text-green-700 text-sm leading-snug transition-colors duration-300 group-hover:text-green-600">
                                    Status Gizi
                                </h3>
                                <p class="mt-2 text-xs leading-relaxed text-[#4b4b4b]">
                                    Status Gizi menampilkan ringkasan pertumbuhan siswa
                                    berdasarkan indikator berat badan dan tinggi badan sesuai
                                    standar usia.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="group rounded-xl2 border border-cardBorder bg-white p-5 shadow-card transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:bg-green-50 hover:border-green-200"
                        data-aos="zoom-in" data-aos-delay="300">
                        <div class="flex items-start gap-3">
                            <div
                                class="mt-1 rounded-lg bg-green-100 p-3 flex items-center justify-center transition-all duration-300 group-hover:bg-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8 text-green-600 transition-all duration-300 group-hover:text-white group-hover:scale-110"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3
                                    class="font-extrabold text-green-700 text-sm leading-snug transition-colors duration-300 group-hover:text-green-600">
                                    e-Presensi
                                </h3>
                                <p class="mt-2 text-xs leading-relaxed text-[#4b4b4b]">
                                    E-Presensi adalah fitur pencatatan kehadiran siswa secara
                                    digital yang terintegrasi langsung dengan sistem e-raport
                                    sekolah.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="group rounded-xl2 border border-cardBorder bg-white p-5 shadow-card transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:bg-green-50 hover:border-green-200"
                        data-aos="zoom-in" data-aos-delay="400">
                        <div class="flex items-start gap-3">
                            <div
                                class="mt-1 rounded-lg bg-green-100 p-3 flex items-center justify-center transition-all duration-300 group-hover:bg-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8 text-green-600 transition-all duration-300 group-hover:text-white group-hover:scale-110"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7 3h7l5 5v13a1 1 0 01-1 1H7a1 1 0 01-1-1V4a1 1 0 011-1z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14 3v6h6M9 13h6M9 17h6" />
                                </svg>
                            </div>
                            <div>
                                <h3
                                    class="font-extrabold text-green-700 text-sm leading-snug transition-colors duration-300 group-hover:text-green-600">
                                    e-Raport Akademik
                                </h3>
                                <p class="mt-2 text-xs leading-relaxed text-[#4b4b4b]">
                                    E-Raport Akademik memudahkan pengelolaan, rekapitulasi, dan
                                    pelaporan nilai siswa secara digital, terstruktur, dan
                                    transparan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="group rounded-xl2 border border-cardBorder bg-white p-5 shadow-card transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:bg-green-50 hover:border-green-200"
                        data-aos="zoom-in" data-aos-delay="500">
                        <div class="flex items-start gap-3">
                            <div
                                class="mt-1 rounded-lg bg-green-100 p-3 flex items-center justify-center transition-all duration-300 group-hover:bg-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8 text-green-600 transition-all duration-300 group-hover:text-white group-hover:scale-110"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 3.5l4 4L8 20H4v-4L16.5 3.5z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6.5l4 4" />
                                </svg>
                            </div>
                            <div>
                                <h3
                                    class="font-extrabold text-green-700 text-sm leading-snug transition-colors duration-300 group-hover:text-green-600">
                                    Refleksi Guru
                                </h3>
                                <p class="mt-2 text-xs leading-relaxed text-[#4b4b4b]">
                                    Refleksi Guru menampilkan catatan evaluasi dan umpan balik
                                    perkembangan siswa secara berkala dan terstruktur.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="group rounded-xl2 border border-cardBorder bg-white p-5 shadow-card transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:bg-green-50 hover:border-green-200"
                        data-aos="zoom-in" data-aos-delay="600">
                        <div class="flex items-start gap-3">
                            <div
                                class="mt-1 rounded-lg bg-green-100 p-3 flex items-center justify-center transition-all duration-300 group-hover:bg-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8 text-green-600 transition-all duration-300 group-hover:text-white group-hover:scale-110"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 3l8 4v6c0 5-3.5 9-8 9s-8-4-8-9V7l8-4z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
                                </svg>
                            </div>
                            <div>
                                <h3
                                    class="font-extrabold text-green-700 text-sm leading-snug transition-colors duration-300 group-hover:text-green-600">
                                    Sistem Aman &amp;<br />Terintegrasi
                                </h3>
                                <p class="mt-2 text-xs leading-relaxed text-[#4b4b4b]">
                                    Sistem terintegrasi dengan keamanan berlapis, memastikan
                                    data siswa terlindungi, tersinkronisasi, dan hanya diakses
                                    pengguna berwenang.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-cream2 overflow-hidden">
            <div class="mx-auto max-w-6xl px-5 py-14">
                <div class="grid gap-6 md:grid-cols-3">
                    <div class="relative rounded-xl2 bg-white px-6 py-8 shadow-card transition-all duration-300 hover:-translate-y-3 hover:shadow-xl"
                        data-aos="fade-up" data-aos-delay="0">
                        <span
                            class="pulse-soft absolute -top-4 inset-x-0 mx-auto h-8 w-8 rounded-full bg-[#D9D9D9]"></span>
                        <div class="text-center">
                            <div class="text-4xl font-extrabold text-green-600">500+</div>
                            <div class="mt-2 text-sm font-semibold text-[#5b5b5b]">
                                Total Murid
                            </div>
                        </div>
                    </div>

                    <div class="relative rounded-xl2 bg-white px-6 py-8 shadow-card transition-all duration-300 hover:-translate-y-3 hover:shadow-xl"
                        data-aos="fade-up" data-aos-delay="120">
                        <span
                            class="pulse-soft absolute -top-4 inset-x-0 mx-auto h-8 w-8 rounded-full bg-[#D9D9D9]"></span>
                        <div class="text-center">
                            <div class="text-4xl font-extrabold text-green-600">120+</div>
                            <div class="mt-2 text-sm font-semibold text-[#5b5b5b]">
                                Total Guru
                            </div>
                        </div>
                    </div>
                    <div class="relative rounded-xl2 bg-white px-6 py-8 shadow-card transition-all duration-300 hover:-translate-y-3 hover:shadow-xl"
                        data-aos="fade-up" data-aos-delay="240">
                        <span
                            class="pulse-soft absolute -top-4 inset-x-0 mx-auto h-8 w-8 rounded-full bg-[#D9D9D9]"></span>
                        <div class="text-center">
                            <div class="text-4xl font-extrabold text-green-600">450+</div>
                            <div class="mt-2 text-sm font-semibold text-[#5b5b5b]">
                                Total Orang Tua
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact" class="bg-white">
            <div class="mx-auto max-w-6xl px-5 py-10">
                <div class="grid gap-8 md:grid-cols-3">
                    <div class="text-center">
                        <div class="mx-auto grid h-14 w-14 place-items-center rounded-full bg-[#2F7EF6] shadow-soft">
                            <img src="assets/telp.png" alt="Telp" class="h-7 w-7 object-contain" />
                        </div>
                        <div class="mt-3 text-sm font-extrabold">Telp.</div>
                        <p class="mt-2 text-xs leading-relaxed text-[#333]">
                            Telp: +61 857-1390-3300 <br />
                            WhatsApp: +61 857-1390-3300
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="mx-auto grid h-14 w-14 place-items-center rounded-full bg-[#17C964] shadow-soft">
                            <img src="assets/alamat.png" alt="Alamat" class="h-7 w-7 object-contain" />
                        </div>
                        <div class="mt-3 text-sm font-extrabold">Alamat</div>
                        <p class="mt-2 text-xs leading-relaxed text-[#333]">
                            Perumahan RCS Garden (Rumah Citra Sejahtera), Desa Capgawen,
                            51173
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="mx-auto grid h-14 w-14 place-items-center rounded-full bg-[#FF4D4D] shadow-soft">
                            <img src="assets/sosmed.png" alt="Sosmed" class="h-7 w-7 object-contain" />
                        </div>
                        <div class="mt-3 text-sm font-extrabold">Sosmed</div>
                        <p class="mt-2 text-xs leading-relaxed text-[#333]">
                            Instagram / Facebook / Website
                        </p>
                    </div>
                </div>
            </div>

            <div class="border-t border-[#F0E7B7]">
                <div class="mx-auto max-w-6xl px-5 py-6 text-center text-[11px] text-[#555]">
                    © Copyright 2026 All Rights Reserved <br />
                    Created by Webku.id Distributed By e-Raport
                </div>
            </div>
        </section>
    </main>

    <script>
        const menuBtn = document.getElementById("menuBtn");
        const mobileMenu = document.getElementById("mobileMenu");
        const iconHamburger = document.getElementById("iconHamburger");
        const iconClose = document.getElementById("iconClose");

        const closeMenu = () => {
            mobileMenu.classList.add("hidden");
            iconHamburger.classList.remove("hidden");
            iconClose.classList.add("hidden");
            menuBtn.setAttribute("aria-expanded", "false");
        };

        const openMenu = () => {
            mobileMenu.classList.remove("hidden");
            iconHamburger.classList.add("hidden");
            iconClose.classList.remove("hidden");
            menuBtn.setAttribute("aria-expanded", "true");
        };

        menuBtn.addEventListener("click", () => {
            const isHidden = mobileMenu.classList.contains("hidden");
            isHidden ? openMenu() : closeMenu();
        });

        mobileMenu.querySelectorAll("a").forEach((a) => {
            a.addEventListener("click", closeMenu);
        });

        window.addEventListener("resize", () => {
            if (window.innerWidth >= 768) closeMenu();
        });
    </script>

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: "ease-out",
            once: true,
            offset: 80,
        });

        window.addEventListener("load", () => {
            AOS.refreshHard();
        });
    </script>
</body>

</html>
