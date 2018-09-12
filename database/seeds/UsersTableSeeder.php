<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@summertimesadness.com',
                'password' => bcrypt('1234567'),
                'is_admin' => 1
            ],
            [
                'name' => 'Mardolina',
                'email' => 'mardolina@summertimesadness.com',
                'password' => bcrypt('lazy123'),
                'is_admin' => 0
            ]
        ];

        DB::table('users')->insert($users);
    }
}
