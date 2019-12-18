<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$tw1fOVHtJGFSTt07XG2gkezvLegpQGoufRiIRLxPGa4.3uTY8grge',
                'remember_token' => null,
                'first_name'     => '',
                'last_name'      => '',
                'phone'          => '',
            ],
            [
                'name'           => 'Ira',
                'email'          => 'irazumovich@sqf.com',
                'password'       => '$2y$10$tw1fOVHtJGFSTt07XG2gkezvLegpQGoufRiIRLxPGa4.3uTY8grge',
                'remember_token' => null,
                'first_name'     => 'Ира',
                'last_name'      => 'Разумович',
                'phone'          => '+375291232323',
            ],
            [
                'name'           => 'Ivan',
                'email'          => 'ivanov@sqf.com',
                'password'       => '$2y$10$tw1fOVHtJGFSTt07XG2gkezvLegpQGoufRiIRLxPGa4.3uTY8grge',
                'remember_token' => null,
                'first_name'     => 'Иван',
                'last_name'      => 'Иванов',
                'phone'          => '+375291232323',
            ],
        ];

        User::insert($users);
    }
}
