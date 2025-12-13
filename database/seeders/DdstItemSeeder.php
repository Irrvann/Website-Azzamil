<?php

namespace Database\Seeders;

use App\Models\DdstItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DdstItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            // ===============================
            // 1. PERSONAL–SOCIAL 
            // ===============================
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => 'Menatap Muka', 'min_bulan' => 0, 'max_bulan' => 1],
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => 'Membalas senyum pemeriksa', 'min_bulan' => 1, 'max_bulan' => 2],
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => 'Tersenyum spontan', 'min_bulan' => 0, 'max_bulan' => 2],
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => ' tangan', 'min_bulan' => 1, 'max_bulan' => 4],
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => 'Berusaha mencapai makanan', 'min_bulan' => 4, 'max_bulan' => 6],
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => 'makan sendiri', 'min_bulan' => 5, 'max_bulan' => 7],
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => 'Tepuk tangan', 'min_bulan' => 6, 'max_bulan' => 11],
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => 'Menyatakan keinginan', 'min_bulan' => 6, 'max_bulan' => 13],
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => 'daag-daag dengan tangan', 'min_bulan' => 6, 'max_bulan' => 11],
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => 'Main bola dengan pemeriksa', 'min_bulan' => 9, 'max_bulan' => 15],
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => 'Menirukan Kegiatan', 'min_bulan' => 10, 'max_bulan' => 16],
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => 'Minum dengan cangkir', 'min_bulan' => 9, 'max_bulan' => 17],
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => 'Membantu dirumah', 'min_bulan' => 12, 'max_bulan' => 17],
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => 'Menggunakan sendok/garpu', 'min_bulan' => 13, 'max_bulan' => 20],
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => 'Membuka pakaian', 'min_bulan' => 13, 'max_bulan' => 24],
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => 'menyuapi boneka', 'min_bulan' => 14, 'max_bulan' => 24],
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => 'Memakai baju', 'min_bulan' => 20, 'max_bulan' => 26],
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => 'Gosok gigi dengan bantuan', 'min_bulan' => 16, 'max_bulan' => 32],
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => 'Cuci & Mengeringkan tangan', 'min_bulan' => 19, 'max_bulan' => 36],
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => 'Menyebutkan nama teman', 'min_bulan' => 26, 'max_bulan' => 38],
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => 'Memakai T-Shirt', 'min_bulan' => 27, 'max_bulan' => 40],
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => 'Berpakaian tanpa bantuan', 'min_bulan' => 34, 'max_bulan' => 53],
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => 'Bermain ular tangga/kartu', 'min_bulan' => 32, 'max_bulan' => 58],
            ['kategori_perkembangan' => 'personal_sosial', 'nama_item' => 'Gosok gigi tanpa bantuan', 'min_bulan' => 29, 'max_bulan' => 61],



            // ===============================
            // 2. FINE MOTOR–ADAPTIVE
            // ===============================
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Mengikuti ke garis tengah', 'min_bulan' => 0, 'max_bulan' => 2],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Mengikuti lewat garis tengah', 'min_bulan' => 0, 'max_bulan' => 3],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Memegang icik-icik', 'min_bulan' => 2, 'max_bulan' => 4],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Tangan bersentuhan', 'min_bulan' => 2, 'max_bulan' => 4],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Mengikuti 180 derajat', 'min_bulan' => 2, 'max_bulan' => 5],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Mengamati manik-manik', 'min_bulan' => 3, 'max_bulan' => 6],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Meraih', 'min_bulan' => 4, 'max_bulan' => 6],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Mencari benang', 'min_bulan' => 5, 'max_bulan' => 7],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Menggaruk manik-manik', 'min_bulan' => 5, 'max_bulan' => 7],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Memindahkan kubus', 'min_bulan' => 5, 'max_bulan' => 8],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Mengambil 2 kubus', 'min_bulan' => 6, 'max_bulan' => 9],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Memegang ibu jari dan jari', 'min_bulan' => 7, 'max_bulan' => 10],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Membenturkan 2 kubus', 'min_bulan' => 7, 'max_bulan' => 11],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Menaruh kubus di cangkir', 'min_bulan' => 10, 'max_bulan' => 14],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Mencorat-coret', 'min_bulan' => 11, 'max_bulan' => 16],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Ambil manik-manik ditunjukan', 'min_bulan' => 12, 'max_bulan' => 19],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Menara dari 2 kubus', 'min_bulan' => 11, 'max_bulan' => 20],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Menara dari 6 kubus', 'min_bulan' => 16, 'max_bulan' => 24],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Menara dari 6 kubus', 'min_bulan' => 19, 'max_bulan' => 29],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Meniru garis vertikal', 'min_bulan' => 24, 'max_bulan' => 39],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Menara dari 8 kubus', 'min_bulan' => 24, 'max_bulan' => 41],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Menggoyangkan ibu jari', 'min_bulan' => 29, 'max_bulan' => 44],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Mencotoh O', 'min_bulan' => 36, 'max_bulan' => 48],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Menggambar orang 3 bagian', 'min_bulan' => 39, 'max_bulan' => 53],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Mencotoh +', 'min_bulan' => 39, 'max_bulan' => 56],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Memilih garis yang lebih panjang', 'min_bulan' => 36, 'max_bulan' => 63],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Mencontoh bentuk Kotak ditunjukan', 'min_bulan' => 48, 'max_bulan' => 65],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Menggambar orang 6 bagian', 'min_bulan' => 51, 'max_bulan' => 65],
            ['kategori_perkembangan' => 'motorik_halus', 'nama_item' => 'Mencontoh bentuk kotak', 'min_bulan' => 56, 'max_bulan' => 72],




            // ===============================
            // 3. LANGUAGE (39 ITEMS)
            // ===============================
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Bereaksi THD bel', 'min_bulan' => 0, 'max_bulan' => 1],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Bersuara', 'min_bulan' => 0, 'max_bulan' => 3],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'OOO/AAH', 'min_bulan' => 1, 'max_bulan' => 3],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Tertawa', 'min_bulan' => 1, 'max_bulan' => 3],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Berteriak', 'min_bulan' => 1, 'max_bulan' => 4],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Menoleh ke bunyi icik-icik', 'min_bulan' => 3, 'max_bulan' => 6],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Menoleh kearah suara', 'min_bulan' => 4, 'max_bulan' => 7],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'satu silabel', 'min_bulan' => 5, 'max_bulan' => 8],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Meniru bunyi kata-kata', 'min_bulan' => 4, 'max_bulan' => 9],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Papa/Mama tidak spesifik', 'min_bulan' => 6, 'max_bulan' => 9],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Kombinasi silabel', 'min_bulan' => 6, 'max_bulan' => 10],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Mengoceh', 'min_bulan' => 6, 'max_bulan' => 12],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Papa/Mama spesifik', 'min_bulan' => 7, 'max_bulan' => 13],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => '1 Kata', 'min_bulan' => 10, 'max_bulan' => 15],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => '2 Kata', 'min_bulan' => 11, 'max_bulan' => 17],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => '3 Kata', 'min_bulan' => 12, 'max_bulan' => 18],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => '6 Kata', 'min_bulan' => 14, 'max_bulan' => 22],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Menunjukan 2 gambar', 'min_bulan' => 17, 'max_bulan' => 24],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Kombinasi kata', 'min_bulan' => 17, 'max_bulan' => 27],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Menyebutkan 1 gambar', 'min_bulan' => 19, 'max_bulan' => 29],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Bagian badan 6', 'min_bulan' => 19, 'max_bulan' => 29],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Menunjukan 4 gambar', 'min_bulan' => 20, 'max_bulan' => 32],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Bicara Sebagian dimengerti', 'min_bulan' => 17, 'max_bulan' => 36],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Menyebutkan 4 gambar', 'min_bulan' => 23, 'max_bulan' => 36],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Mengetahui 2 kegiatan', 'min_bulan' => 24, 'max_bulan' => 39],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Mengerti 2 kata sifat', 'min_bulan' => 29, 'max_bulan' => 44],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Menyebut 1 warna', 'min_bulan' => 29, 'max_bulan' => 44],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Kegunaan 2 benda', 'min_bulan' => 29, 'max_bulan' => 44],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'menghitung 1 kubus', 'min_bulan' => 34, 'max_bulan' => 48],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Kegunaan 3 benda', 'min_bulan' => 34, 'max_bulan' => 51],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Mengetagui 4 kegiatan', 'min_bulan' => 34, 'max_bulan' => 51],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Bicara semua dimengerti', 'min_bulan' => 23, 'max_bulan' => 51],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Mengartikan 4 kata depan', 'min_bulan' => 34, 'max_bulan' => 56],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Menyebutkan 4 warna', 'min_bulan' => 36, 'max_bulan' => 56],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Mengartikan 5 kata', 'min_bulan' => 36, 'max_bulan' => 63],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Mengetahui 3 kata sifat', 'min_bulan' => 36, 'max_bulan' => 65],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Mengitung 5 kubus', 'min_bulan' => 51, 'max_bulan' => 60],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Berlawanan 2', 'min_bulan' => 46, 'max_bulan' => 68],
            ['kategori_perkembangan' => 'bahasa', 'nama_item' => 'Mengartikan 7 kata', 'min_bulan' => 48, 'max_bulan' => 72],





            // ===============================
            // 4. GROSS MOTOR (32 ITEMS)
            // ===============================
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'gerakan seimbang', 'min_bulan' => 0, 'max_bulan' => 1],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Mengangkat kepala', 'min_bulan' => 0, 'max_bulan' => 1],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Kepala terangkat 45 derajat', 'min_bulan' => 0, 'max_bulan' => 2],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'kepala terangkat 90 derajat', 'min_bulan' => 1, 'max_bulan' => 4],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Duduk kepala tegak', 'min_bulan' => 1, 'max_bulan' => 4],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Menumpu beban pada kaki', 'min_bulan' => 1, 'max_bulan' => 5],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Dada terangkat menumpu pada lengan', 'min_bulan' => 2, 'max_bulan' => 5],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Membalik', 'min_bulan' => 2, 'max_bulan' => 6],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Bangkit kepala tegak', 'min_bulan' => 3, 'max_bulan' => 6],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Duduk tanpa pegangan', 'min_bulan' => 5, 'max_bulan' => 7],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Berdiri dengan pegangan', 'min_bulan' => 6, 'max_bulan' => 9],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Bangkit untuk berdiri', 'min_bulan' => 8, 'max_bulan' => 10],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Berdiri 2 detik', 'min_bulan' => 12, 'max_bulan' => 12],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Membukuk kemudian berdiri', 'min_bulan' => 11, 'max_bulan' => 14],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Berjalan dengan baik', 'min_bulan' => 11, 'max_bulan' => 15],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Berjalan mundur', 'min_bulan' => 12, 'max_bulan' => 16],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Lari', 'min_bulan' => 13, 'max_bulan' => 20],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Berjalan naik tangga', 'min_bulan' => 14, 'max_bulan' => 22],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Menendang bola ke depan', 'min_bulan' => 16, 'max_bulan' => 24],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'melompat', 'min_bulan' => 21, 'max_bulan' => 29],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Melempar bola tangan ke atas', 'min_bulan' => 17, 'max_bulan' => 36],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Loncat jauh', 'min_bulan' => 27, 'max_bulan' => 39],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Berdiri 1 kaki 1 detik', 'min_bulan' => 27, 'max_bulan' => 41],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Berdiri 1 kaki 2 detik', 'min_bulan' => 32, 'max_bulan' => 48],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Melompat dengan 1 kaki', 'min_bulan' => 39, 'max_bulan' => 51],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Berdiri 1 kaki 3 detik', 'min_bulan' => 32, 'max_bulan' => 56],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Berdiri 1 kaki 4 detik', 'min_bulan' => 44, 'max_bulan' => 60],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'berdiri 1 kaki 5 detik', 'min_bulan' => 44, 'max_bulan' => 65],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Berjalan tumit ke jari kaki', 'min_bulan' => 48, 'max_bulan' => 68],
            ['kategori_perkembangan' => 'motorik_kasar', 'nama_item' => 'Berdiri 1 kaki 6 detik', 'min_bulan' => 48, 'max_bulan' => 72],

        ];

        foreach ($items as $item) {
            DdstItem::create($item);
        }
    }
}
