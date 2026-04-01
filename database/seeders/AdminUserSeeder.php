<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Kramer Admin',
            'email' => 'admin@rubye.com', // coloque seu e-mail aqui
            'password' => Hash::make('12345678'), // coloque sua senha aqui
            'role' => 'admin',
        ]);
    }
}
