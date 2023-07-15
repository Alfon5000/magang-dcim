<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'role_id' => 1,
                'image' => '',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Operator',
                'role_id' => 2,
                'image' => '',
                'email' => 'operator@gmail.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
