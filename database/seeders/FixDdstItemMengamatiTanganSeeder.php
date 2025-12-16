<?php

namespace Database\Seeders;

use App\Models\DdstItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FixDdstItemMengamatiTanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         DdstItem::where('kategori_perkembangan', 'personal_sosial')
            ->where('nama_item', ' tangan')
            ->where('min_bulan', 1)
            ->where('max_bulan', 4)
            ->update([
                'nama_item' => 'Mengamati tangannya',
            ]);
    }
}
