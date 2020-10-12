<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $users = [
            [
                'id'        => 1,
                'role_id'   => 1,
                'fullname'  => 'Super Administrator',
                'username'  => 'superadmin',
                'email'     => 'admin@superadmin.com',
                'password'  => Hash::make('123456')
            ],
            [
                'id'        => 2,
                'role_id'   => 2,
                'fullname'  => 'Muhammad Aliyul Murtadlo',
                'username'  => 'mmdiyul',
                'email'     => 'mmdiyul@gmail.com',
                'password'  => Hash::make('123456')
            ],
            [
                'id'        => 3,
                'role_id'   => 2,
                'fullname'  => 'Ermi Pristiyaningrum',
                'username'  => 'ermi',
                'email'     => 'ermi@gmail.com',
                'password'  => Hash::make('123456')
            ],
            [
                'id'        => 4,
                'role_id'   => 2,
                'fullname'  => 'Nisa NH',
                'username'  => 'nisa',
                'email'     => 'nisa@gmail.com',
                'password'  => Hash::make('123456')
            ]
        ];

        DB::table('users')->insert($users);
    }
}
