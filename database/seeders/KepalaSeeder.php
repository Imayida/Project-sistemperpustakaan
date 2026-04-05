<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KepalaSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Kepala Perpustakaan',
            'email' => 'kepala@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'kepala'
        ]);
    }
}
