<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Membuat akun pustakawan pengujian sesuai modul praktikum Week 6.
     * Menggunakan updateOrCreate agar idempoten dan tidak menimbulkan duplikat.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'pustakawan@del.ac.id'],
            [
                'name'              => 'Pustakawan IT Del',
                'password'          => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
    }
}
