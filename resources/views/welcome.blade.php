<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azzamil School - Pendidikan Berkualitas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-amber-50 to-yellow-100 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <img src="/assets/media/logo/logo-azzamil.png" alt="Logo Azzamil School" class="w-10 h-10 object-contain">

                    <h1 class="text-2xl font-bold text-gray-800">Azzamil School</h1>
                </div>
                <a href="/login"
                    class="bg-gradient-to-r from-yellow-400 to-amber-500 hover:from-yellow-500 hover:to-amber-600 text-white font-semibold px-6 py-2 rounded-lg transition duration-300 transform hover:scale-105 shadow-md inline-block">
                    Login
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="container mx-auto px-4 py-12 lg:py-20">
        <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
            <!-- Content Kiri -->
            <div class="order-2 lg:order-1 space-y-6">
                <div class="inline-block bg-yellow-200 text-amber-800 px-4 py-2 rounded-full text-sm font-semibold">
                    🌟 Sekolah Terbaik
                </div>

                <h2 class="text-4xl lg:text-5xl xl:text-6xl font-bold text-gray-800 leading-tight">
                    Membentuk Generasi
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-500 to-amber-600">
                        Cerdas & Berakhlak
                    </span>
                </h2>

                <p class="text-lg text-gray-600 leading-relaxed">
                    Azzamil School memberikan pendidikan berkualitas dengan menggabungkan kurikulum nasional dan
                    nilai-nilai karakter. Kami berkomitmen untuk mengembangkan potensi setiap siswa menjadi pribadi yang
                    unggul.
                </p>

                <!-- <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <button class="bg-gradient-to-r from-yellow-400 to-amber-500 hover:from-yellow-500 hover:to-amber-600 text-white font-bold px-8 py-4 rounded-xl transition duration-300 transform hover:scale-105 shadow-lg">
                        Daftar Sekarang
                    </button>
                    <button class="border-2 border-yellow-500 text-yellow-600 hover:bg-yellow-50 font-bold px-8 py-4 rounded-xl transition duration-300">
                        Pelajari Lebih Lanjut
                    </button>
                </div> -->


            </div>

            <!-- Gambar Kanan -->
            <div class="order-1 lg:order-2">
                <div class="relative">
                    <!-- Decorative Elements -->
                    <div class="absolute -top-4 -left-4 w-24 h-24 bg-yellow-300 rounded-full opacity-50 blur-xl"></div>
                    <div class="absolute -bottom-4 -right-4 w-32 h-32 bg-amber-400 rounded-full opacity-50 blur-xl">
                    </div>

                    <!-- Main Image Container -->
                    <div
                        class="relative bg-gradient-to-br from-yellow-400 to-amber-500 rounded-3xl p-2 shadow-2xl transform hover:scale-105 transition duration-500">
                        <div class="bg-white rounded-2xl overflow-hidden">
                            <img src="/assets/media/logo/logo-azzamil.png"
                                alt="Siswa Azzamil School" class="w-full h-auto object-cover" />
                        </div>
                    </div>

                    <!-- Floating Card -->
                    <div class="absolute -bottom-6 -left-6 bg-white rounded-xl shadow-xl p-4 hidden lg:block">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-amber-500 rounded-full flex items-center justify-center">
                                <span class="text-white text-xl">✓</span>
                            </div>
                            <div>
                                <div class="font-bold text-gray-800">Sekolah Unggulan</div>
                                <div class="text-sm text-gray-600">azzamil school</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Features Section -->
    <section class="container mx-auto px-4 py-12">
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition duration-300">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-amber-500 rounded-lg flex items-center justify-center mb-4">
                    <span class="text-white text-2xl">📚</span>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Kurikulum Modern</h3>
                <p class="text-gray-600">Pembelajaran berbasis teknologi dan karakter</p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition duration-300">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-amber-500 rounded-lg flex items-center justify-center mb-4">
                    <span class="text-white text-2xl">👨‍🏫</span>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Guru Berpengalaman</h3>
                <p class="text-gray-600">Tenaga pendidik profesional dan bersertifikat</p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition duration-300">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-amber-500 rounded-lg flex items-center justify-center mb-4">
                    <span class="text-white text-2xl">🏆</span>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Prestasi Membanggakan</h3>
                <p class="text-gray-600">Juara berbagai kompetisi tingkat nasional</p>
            </div>
        </div>
    </section>
</body>

</html>
