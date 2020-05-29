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
        $sample_users = [
            [
                'name' => 'Jerry',
                'email' => 'jerry@gmail.com',
                'password' => 'password'
            ],
            [
                'name' => 'doctor1',
                'email' => 'doctor1@gmail.com',
                'password' => 'password'
            ],
            [
                'name' => 'doctor2',
                'email' => 'doctor2@gmail.com',
                'password' => 'password'
            ],
            [
                'name' => 'nurse1',
                'email' => 'nurse1@gmail.com',
                'password' => 'password'
            ],
            [
                'name' => 'nurse2',
                'email' => 'nurse2@gmail.com',
                'password' => 'password'
            ]
        ];

        foreach ($sample_users as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => bcrypt($user['password']),
            ]);
        }
    }
}
