<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@example.com',
                'password' => '12345678',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'user_level' => 1
            ]
        ];
        foreach ($users as $key => $value) {
            User::firstOrCreate(
                ['email' => $value['email']],
                [
                    'name' => $value['name'],
                    'password' => $value['password'],
                    'email_verified_at' => $value['email_verified_at'],
                    'user_level' => $value['user_level']
                ]
            );
        }
    }
}
