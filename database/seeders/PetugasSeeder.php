<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Petugas 1',
            'email' => 'petugas@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'petugas'
        ]);
    }
}
