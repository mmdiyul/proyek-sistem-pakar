<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiseasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('diseases')->delete();

        $diseases = [
            ['id' => 1, 'code' => 'P1', 'name' => 'Scabies', 'solution' => 'Salep scabies'],
            ['id' => 2, 'code' => 'P2', 'name' => 'Gastritis', 'solution' => 'Makan lunak/halus, obat penetral asam lambung, antibiotik, obat pengurang asam lambung'],
            ['id' => 3, 'code' => 'P3', 'name' => 'Helminthiasis', 'solution' => 'Pemberian obat cacing tiap 3 bulan sekali'],
            ['id' => 4, 'code' => 'P4', 'name' => 'Rhintis', 'solution' => 'identifikasi penyebab alergi, obat anti alergi, obat anti radang, antibiotic'],
            ['id' => 5, 'code' => 'P5', 'name' => 'Dermatophytosis', 'solution' => 'Mandi dengan shampoo jamur 2x seminggu, salep anti jamur, obat anti jamur'],
            ['id' => 6, 'code' => 'P6', 'name' => 'Dermatitis', 'solution' => 'Identifikasi penyebab alergi jika ada, antibiotik mandi dengan shampoo anti bakteri/jamur 2x seminggu'],
            ['id' => 7, 'code' => 'P7', 'name' => 'Enteritis', 'solution' => 'Makanan halus/lunak, makanan khusus pencernaan, antibiotik, anti diare, obat cacing'],
            ['id' => 8, 'code' => 'P8', 'name' => 'Otitis', 'solution' => 'Bersihkan telinga dengan pembersih telinga, obat tetes telinga dan anti radang'],
            ['id' => 9, 'code' => 'P9', 'name' => 'Sehat', 'solution' => 'Mandi 1 – 2 minggu sekali tergantung tingkat kekotoran, vaksinasi rutin, cek dokter tiap 3 bulan'],
        ];

        DB::table('diseases')->insert($diseases);
    }
}
