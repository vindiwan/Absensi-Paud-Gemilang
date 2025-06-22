<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserGuruSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users_guru')->insert([
            [
                'username' => 'rizky123',
                'nama_lengkap' => 'Rizky Andi',
                'email' => 'andi@example.com',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1980-05-15',
                'alamat' => 'Jl. Merdeka No.1, Jakarta',
                'password' => Hash::make('rizky123'),
                'NIP' => '19800515-001',
                'Pendidikan' => 'S1 Pendidikan Matematika',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'aradita',
                'nama_lengkap' => 'Sari Aradita',
                'email' => 'sari@example.com',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1985-08-20',
                'alamat' => 'Jl. Kebangsaan No.10, Bandung',
                'password' => Hash::make('aradita123'),
                'NIP' => '19850820-002',
                'Pendidikan' => 'S2 Pendidikan Bahasa Inggris',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}