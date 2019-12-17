<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$tw1fOVHtJGFSTt07XG2gkezvLegpQGoufRiIRLxPGa4.3uTY8grge',
                'remember_token' => null,
                'first_name'     => '',
                'last_name'      => '',
                'phone'          => '',
            ],
            [
                'id'             => 2,
                'name'           => 'Ira',
                'email'          => 'irazumovich@sqf.com',
                'password'       => '$2y$10$tw1fOVHtJGFSTt07XG2gkezvLegpQGoufRiIRLxPGa4.3uTY8grge',
                'remember_token' => null,
                'first_name'     => 'Ира',
                'last_name'      => 'Разумович',
                'phone'          => '+375291232323',
            ],
        ];

        User::insert($users);
    }
}
