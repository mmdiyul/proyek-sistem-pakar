<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(SymptomsSeeder::class);
        $this->call(DiseasesSeeder::class);
        $this->call(DiseaseRulesSeeder::class);
    }
}
