<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SymptomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('symptoms')->delete();

        $symptoms = [
            ['id' => 1, 'code' => 'G1', 'name' => 'Keratinisasi'],
            ['id' => 2, 'code' => 'G2', 'name' => 'Gatal-gatal'],
            ['id' => 3, 'code' => 'G3', 'name' => 'Keropeng'],
            ['id' => 4, 'code' => 'G4', 'name' => 'Ketombe'],
            ['id' => 5, 'code' => 'G5', 'name' => 'Kutuan'],
            ['id' => 6, 'code' => 'G6', 'name' => 'Kurus'],
            ['id' => 7, 'code' => 'G7', 'name' => 'Bulu rontok'],
            ['id' => 8, 'code' => 'G8', 'name' => 'Anoreksia'],
            ['id' => 9, 'code' => 'G9', 'name' => 'Abdomen keras'],
            ['id' => 10, 'code' => 'G10', 'name' => 'Muntah'],
            ['id' => 11, 'code' => 'G11', 'name' => 'Diare'],
            ['id' => 12, 'code' => 'G12', 'name' => 'Perut buncit'],
            ['id' => 13, 'code' => 'G13', 'name' => 'Hilang nafsu makan'],
            ['id' => 14, 'code' => 'G14', 'name' => 'Ada cacing di fases'],
            ['id' => 15, 'code' => 'G15', 'name' => 'Pilek'],
            ['id' => 16, 'code' => 'G16', 'name' => 'Bersin-bersin'],
            ['id' => 17, 'code' => 'G17', 'name' => 'Hidung tersumbat'],
            ['id' => 18, 'code' => 'G18', 'name' => 'Badan lemas'],
            ['id' => 19, 'code' => 'G19', 'name' => 'Mata berair'],
            ['id' => 20, 'code' => 'G20', 'name' => 'Hidung berair'],
            ['id' => 21, 'code' => 'G21', 'name' => 'Ringwarm pada kulit'],
            ['id' => 22, 'code' => 'G22', 'name' => 'Kulit kemerahan sampai lecet'],
            ['id' => 23, 'code' => 'G23', 'name' => 'Jamuran'],
            ['id' => 24, 'code' => 'G24', 'name' => 'Lesi berminyak pengganti'],
            ['id' => 25, 'code' => 'G25', 'name' => 'Guratan parah pada telinga'],
            ['id' => 26, 'code' => 'G26', 'name' => 'Adanya cairan hitam keluar telinga'],
            ['id' => 27, 'code' => 'G27', 'name' => 'Telinga terdapat lilin dan bau'],
            ['id' => 28, 'code' => 'G28', 'name' => 'Diare campur darah'],
            ['id' => 29, 'code' => 'G29', 'name' => 'Feses lembek'],
            ['id' => 30, 'code' => 'G30', 'name' => 'Minum banyak'],
            ['id' => 31, 'code' => 'G31', 'name' => 'Abdomen sakit'],
            ['id' => 32, 'code' => 'G32', 'name' => 'Vaksinasi'],
        ];

        DB::table('symptoms')->insert($symptoms);
    }
}
