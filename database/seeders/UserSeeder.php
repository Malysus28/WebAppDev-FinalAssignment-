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
            'name'=>'Australian Computer Society (ACS)',
            'email'=>'organiser1@example.com',
            'password'=>Hash::make('password'),
            'type'=>User::TYPE_ORGANISER,
        ]);
            User::create([
            'name' => 'Australian Signals Directorate (ASD)',
            'email' => 'organiser2@example.com',
            'password' => Hash::make('password'),
            'type' => User::TYPE_ORGANISER,
        ]);

                User::create([
            'name' => 'Attendee1',
            'email' => 'attendee1@example.com',
            'password' => Hash::make('password'),
            'type' => User::TYPE_ATTENDEE,
        ]);
    }
}   
