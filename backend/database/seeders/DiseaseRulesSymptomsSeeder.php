<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DiseaseRulesSymptomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('disease_rules_symptoms')->delete();

        $data = [
            [ 'id' => 1, 'disease_rule_id' => 1, 'symptoms_id' => 1],
            [ 'id' => 2, 'disease_rule_id' => 1, 'symptoms_id' => 2],
            [ 'id' => 3, 'disease_rule_id' => 1, 'symptoms_id' => 3],
            [ 'id' => 4, 'disease_rule_id' => 1, 'symptoms_id' => 4],
            [ 'id' => 5, 'disease_rule_id' => 1, 'symptoms_id' => 5],
            [ 'id' => 6, 'disease_rule_id' => 1, 'symptoms_id' => 6],
            [ 'id' => 7, 'disease_rule_id' => 1, 'symptoms_id' => 7],
            [ 'id' => 8, 'disease_rule_id' => 1, 'symptoms_id' => 13],
            [ 'id' => 9, 'disease_rule_id' => 1, 'symptoms_id' => 23],
            [ 'id' => 10, 'disease_rule_id' => 1, 'symptoms_id' => 29],
            [ 'id' => 11, 'disease_rule_id' => 1, 'symptoms_id' => 32],
            [ 'id' => 11, 'disease_rule_id' => 2, 'symptoms_id' => 6],
            [ 'id' => 12, 'disease_rule_id' => 2, 'symptoms_id' => 8],
            [ 'id' => 13, 'disease_rule_id' => 2, 'symptoms_id' => 9],
            [ 'id' => 14, 'disease_rule_id' => 2, 'symptoms_id' => 10],
            [ 'id' => 15, 'disease_rule_id' => 2, 'symptoms_id' => 11],
            [ 'id' => 16, 'disease_rule_id' => 2, 'symptoms_id' => 13],
            [ 'id' => 17, 'disease_rule_id' => 2, 'symptoms_id' => 18],
            [ 'id' => 18, 'disease_rule_id' => 2, 'symptoms_id' => 19],
            [ 'id' => 19, 'disease_rule_id' => 2, 'symptoms_id' => 29],
            [ 'id' => 20, 'disease_rule_id' => 2, 'symptoms_id' => 32],
            [ 'id' => 21, 'disease_rule_id' => 3, 'symptoms_id' => 5],
            [ 'id' => 22, 'disease_rule_id' => 3, 'symptoms_id' => 6],
            [ 'id' => 23, 'disease_rule_id' => 3, 'symptoms_id' => 7],
            [ 'id' => 24, 'disease_rule_id' => 3, 'symptoms_id' => 8],
            [ 'id' => 25, 'disease_rule_id' => 3, 'symptoms_id' => 10],
            [ 'id' => 26, 'disease_rule_id' => 3, 'symptoms_id' => 11],
            [ 'id' => 27, 'disease_rule_id' => 3, 'symptoms_id' => 12],
            [ 'id' => 28, 'disease_rule_id' => 3, 'symptoms_id' => 13],
            [ 'id' => 29, 'disease_rule_id' => 3, 'symptoms_id' => 14],
            [ 'id' => 30, 'disease_rule_id' => 3, 'symptoms_id' => 18],
            [ 'id' => 31, 'disease_rule_id' => 3, 'symptoms_id' => 23],
            [ 'id' => 32, 'disease_rule_id' => 3, 'symptoms_id' => 29],
            [ 'id' => 33, 'disease_rule_id' => 3, 'symptoms_id' => 32],
            [ 'id' => 34, 'disease_rule_id' => 4, 'symptoms_id' => 5],
            [ 'id' => 35, 'disease_rule_id' => 4, 'symptoms_id' => 13],
            [ 'id' => 36, 'disease_rule_id' => 4, 'symptoms_id' => 15],
            [ 'id' => 37, 'disease_rule_id' => 4, 'symptoms_id' => 16],
            [ 'id' => 38, 'disease_rule_id' => 4, 'symptoms_id' => 17],
            [ 'id' => 39, 'disease_rule_id' => 4, 'symptoms_id' => 19],
            [ 'id' => 40, 'disease_rule_id' => 4, 'symptoms_id' => 20],
            [ 'id' => 41, 'disease_rule_id' => 4, 'symptoms_id' => 32],
            [ 'id' => 42, 'disease_rule_id' => 5, 'symptoms_id' => 2],
            [ 'id' => 43, 'disease_rule_id' => 5, 'symptoms_id' => 3],
            [ 'id' => 44, 'disease_rule_id' => 5, 'symptoms_id' => 4],
            [ 'id' => 45, 'disease_rule_id' => 5, 'symptoms_id' => 5],
            [ 'id' => 46, 'disease_rule_id' => 5, 'symptoms_id' => 7],
            [ 'id' => 47, 'disease_rule_id' => 5, 'symptoms_id' => 8],
            [ 'id' => 48, 'disease_rule_id' => 5, 'symptoms_id' => 11],
            [ 'id' => 49, 'disease_rule_id' => 5, 'symptoms_id' => 21],
            [ 'id' => 50, 'disease_rule_id' => 5, 'symptoms_id' => 22],
            [ 'id' => 51, 'disease_rule_id' => 5, 'symptoms_id' => 23],
            [ 'id' => 52, 'disease_rule_id' => 5, 'symptoms_id' => 32],
            [ 'id' => 53, 'disease_rule_id' => 6, 'symptoms_id' => 3],
            [ 'id' => 54, 'disease_rule_id' => 6, 'symptoms_id' => 4],
            [ 'id' => 55, 'disease_rule_id' => 6, 'symptoms_id' => 5],
            [ 'id' => 56, 'disease_rule_id' => 6, 'symptoms_id' => 6],
            [ 'id' => 57, 'disease_rule_id' => 6, 'symptoms_id' => 7],
            [ 'id' => 58, 'disease_rule_id' => 6, 'symptoms_id' => 21],
            [ 'id' => 59, 'disease_rule_id' => 6, 'symptoms_id' => 22],
            [ 'id' => 60, 'disease_rule_id' => 6, 'symptoms_id' => 23],
            [ 'id' => 61, 'disease_rule_id' => 6, 'symptoms_id' => 24],
            [ 'id' => 62, 'disease_rule_id' => 6, 'symptoms_id' => 32],
            [ 'id' => 63, 'disease_rule_id' => 7, 'symptoms_id' => 3],
            [ 'id' => 64, 'disease_rule_id' => 7, 'symptoms_id' => 7],
            [ 'id' => 65, 'disease_rule_id' => 7, 'symptoms_id' => 8],
            [ 'id' => 66, 'disease_rule_id' => 7, 'symptoms_id' => 10],
            [ 'id' => 67, 'disease_rule_id' => 7, 'symptoms_id' => 11],
            [ 'id' => 68, 'disease_rule_id' => 7, 'symptoms_id' => 13],
            [ 'id' => 69, 'disease_rule_id' => 7, 'symptoms_id' => 18],
            [ 'id' => 70, 'disease_rule_id' => 7, 'symptoms_id' => 28],
            [ 'id' => 71, 'disease_rule_id' => 7, 'symptoms_id' => 29],
            [ 'id' => 72, 'disease_rule_id' => 7, 'symptoms_id' => 30],
            [ 'id' => 73, 'disease_rule_id' => 7, 'symptoms_id' => 31],
            [ 'id' => 74, 'disease_rule_id' => 7, 'symptoms_id' => 32],
            [ 'id' => 75, 'disease_rule_id' => 8, 'symptoms_id' => 3],
            [ 'id' => 76, 'disease_rule_id' => 8, 'symptoms_id' => 5],
            [ 'id' => 77, 'disease_rule_id' => 8, 'symptoms_id' => 8],
            [ 'id' => 78, 'disease_rule_id' => 8, 'symptoms_id' => 10],
            [ 'id' => 79, 'disease_rule_id' => 8, 'symptoms_id' => 11],
            [ 'id' => 80, 'disease_rule_id' => 8, 'symptoms_id' => 12],
            [ 'id' => 81, 'disease_rule_id' => 8, 'symptoms_id' => 13],
            [ 'id' => 82, 'disease_rule_id' => 8, 'symptoms_id' => 18],
            [ 'id' => 83, 'disease_rule_id' => 8, 'symptoms_id' => 25],
            [ 'id' => 84, 'disease_rule_id' => 8, 'symptoms_id' => 26],
            [ 'id' => 85, 'disease_rule_id' => 8, 'symptoms_id' => 27],
            [ 'id' => 86, 'disease_rule_id' => 8, 'symptoms_id' => 32],
            [ 'id' => 87, 'disease_rule_id' => 9, 'symptoms_id' => 32],
        ];

        DB::table('disease_rules_symptoms')->insert($data);
    }
}
