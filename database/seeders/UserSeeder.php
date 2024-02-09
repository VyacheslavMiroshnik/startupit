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
        ])->bonus()->create([
            'bonus'=>1000
        ]);
        User::factory()->create([
            'name'=>'user',
            'email'=>'user@user.ru',
            'password'=>Hash::make('password')
        ])->bonus()->create([
            'bonus'=>12000
        ]);
        User::factory()->create([
            'name'=>'startupit',
            'email'=>'startupit@startupit.ru',
            'password'=>Hash::make('startupit.ru')
        ])->bonus()->create([
            'bonus'=>22000
        ]);
    }
}
