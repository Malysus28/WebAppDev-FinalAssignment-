<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * content for event cards
     */
    public function run(): void
    {
                User::create([
            'name' => 'Malees',
            'email' => 'malees@gmail.com',
            'password' => Hash::make('password'),
            'type' => User::TYPE_ATTENDEE,
        ]);
    }
}   
