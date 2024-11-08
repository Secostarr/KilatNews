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
                'username' => 'admin1',
                'password' => bcrypt('12345678'),
                'email' => 'admin1@gmail.com',
                'nama' => 'Admin1',
                'role' => 'admin',
                'foto' => null,
            ],

            [
                'username' => 'pengguna1',
                'password' => bcrypt('12345678'),
                'email' => 'pengguna1@gmail.com',
                'nama' => 'Pengguna1',
                'role' => 'user',
                'foto' => null,
            ],

            [
                'username' => 'contributor1',
                'password' => bcrypt('12345678'),
                'email' => 'contributor1@gmail.com',
                'nama' => 'Contributor1',
                'role' => 'contributor',
                'foto' => null,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
