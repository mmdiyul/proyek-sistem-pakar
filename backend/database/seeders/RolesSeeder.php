<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        $roles = [
            [
                'id'        => 1,
                'code'      => 'superadmin',
                'name'      => 'Super Admin',
                'priority'  => 0
            ],
            [
                'id'        => 2,
                'code'      => 'user',
                'name'      => 'User',
                'priority'  => 1
            ]
        ];

        DB::table('roles')->insert($roles);
    }
}
