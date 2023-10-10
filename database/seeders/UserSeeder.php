<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::reguard();
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@yoprint.com',
                'password' => bcrypt('admin123'),
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate([
                'email' => $user['email'],
            ], [
                'name' => $user['name'],
                'password' => $user['password'],
            ]);
        }
    }
}
