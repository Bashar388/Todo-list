<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Bashar',
            'email' => 'Bashar@gmail.com',
            'password' => Hash::make('bah12343!@#'),
            'is_admin' => true,
        ]);
    }
}
