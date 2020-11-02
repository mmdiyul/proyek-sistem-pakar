<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiseaseRulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('disease_rules')->delete();

        $rules = [
            [ 'id' => 1, 'code' => 'R1', 'disease_id' => 1],
            [ 'id' => 2, 'code' => 'R2', 'disease_id' => 2],
            [ 'id' => 3, 'code' => 'R3', 'disease_id' => 3],
            [ 'id' => 4, 'code' => 'R4', 'disease_id' => 4],
            [ 'id' => 5, 'code' => 'R5', 'disease_id' => 5],
            [ 'id' => 6, 'code' => 'R6', 'disease_id' => 6],
            [ 'id' => 7, 'code' => 'R7', 'disease_id' => 7],
            [ 'id' => 8, 'code' => 'R8', 'disease_id' => 8],
            [ 'id' => 9, 'code' => 'R9', 'disease_id' => 9]
        ];

        DB::table('disease_rules')->insert($rules);
    }
}
