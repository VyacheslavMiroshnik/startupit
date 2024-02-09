<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name'=>'admin',
            'email'=>'admin@admin.ru',
            'password'=>Hash::make('password')
        ]);
        User::factory()->create([
            'name'=>'user',
            'email'=>'user@user.ru',
            'password'=>Hash::make('password')
        ]);
        User::factory()->create([
            'name'=>'startupit',
            'email'=>'startupit@startupit.ru',
            'password'=>Hash::make('startupit.ru')
        ]);
    }
}
