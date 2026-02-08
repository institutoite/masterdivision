<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Seed default users for local testing.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@local.test',
                'password' => 'password',
                'is_admin' => true,
            ],
            [
                'name' => 'Profesor',
                'email' => 'profesor@local.test',
                'password' => 'password',
            ],
            [
                'name' => 'Docente',
                'email' => 'docente@local.test',
                'password' => 'password',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                    'is_admin' => $user['is_admin'] ?? false,
                ]
            );
        }
    }
}
