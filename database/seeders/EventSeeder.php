<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;
use Carbon\Carbon;



class EventSeeder extends Seeder
{
    public function run(): void
    {
        // Make sure organisers exist
        $organiser1 = User::firstOrCreate(
            ['email' => 'organiser1@gmail.com'],
            ['name' => 'Organiser One', 'password' => bcrypt('password'), 'type' => User::TYPE_ORGANISER]
        );

        $organiser2 = User::firstOrCreate(
            ['email' => 'organiser2@gmail.com'],
            ['name' => 'Organiser Two', 'password' => bcrypt('password'), 'type' => User::TYPE_ORGANISER]
        );

        // Clear existing events
        Event::query()->delete();

        $events = [
            [
                'organiser_id' => $organiser1->id,
                'title'        => 'Tech Innovators Conference 2025',
                'description'  => 'A conference bringing together tech leaders and innovators.',
                'starts_at'    => Carbon::parse('2025-09-15 09:00:00'),
                'location'     => 'Brisbane Convention Centre',
                'capacity'     => 150,
            ],
            [
                'organiser_id' => $organiser1->id,
                'title'        => 'AI & Machine Learning Bootcamp',
                'description'  => 'Hands-on workshops and talks about AI advancements.',
                'starts_at'    => Carbon::parse('2025-09-18 10:30:00'),
                'location'     => 'Griffith University, Nathan Campus',
                'capacity'     => 50,
            ],
            [
                'organiser_id' => $organiser2->id,
                'title'        => 'Cybersecurity Essentials Workshop',
                'description'  => 'Learn about modern cybersecurity practices.',
                'starts_at'    => Carbon::parse('2025-09-20 14:00:00'),
                'location'     => 'Gold Coast Tech Hub',
                'capacity'     => 40,
            ],
            [
                'organiser_id' => $organiser2->id,
                'title'        => 'Women in Tech Networking Night',
                'description'  => 'An evening dedicated to empowering women in technology.',
                'starts_at'    => Carbon::parse('2025-09-25 18:00:00'),
                'location'     => 'South Bank, Brisbane',
                'capacity'     => 80,
            ],
            [
                'organiser_id' => $organiser1->id,
                'title'        => 'Cloud Computing Symposium',
                'description'  => 'Discussions and presentations on cloud technologies.',
                'starts_at'    => Carbon::parse('2025-10-05 09:30:00'),
                'location'     => 'Queensland University of Technology (QUT)',
                'capacity'     => 120,
            ],
            [
                'organiser_id' => $organiser2->id,
                'title'        => 'Startup Pitch Night',
                'description'  => 'Local startups pitch their ideas to investors and the community.',
                'starts_at'    => Carbon::parse('2025-10-10 17:00:00'),
                'location'     => 'Brisbane City Hall',
                'capacity'     => 100,
            ],
            [
                'organiser_id' => $organiser1->id,
                'title'        => 'Data Science & Analytics Forum',
                'description'  => 'Exploring the latest trends in data science and analytics.',
                'starts_at'    => Carbon::parse('2025-10-15 11:00:00'),
                'location'     => 'University of Queensland (UQ)',
                'capacity'     => 70,
            ],
            [
                'organiser_id' => $organiser2->id,
                'title'        => 'Blockchain & Cryptocurrency Seminar',
                'description'  => 'Understanding blockchain technology and its applications.',
                'starts_at'    => Carbon::parse('2025-10-20 13:00:00'),
                'location'     => 'Griffith University, South Bank Campus',
                'capacity'     => 60,
            ],
            [
                'organiser_id' => $organiser1->id,
                'title'        => 'Virtual Reality (VR) Expo',
                'description'  => 'Experience the latest in VR technology and applications.',
                'starts_at'    => Carbon::parse('2025-10-25 10:00:00'),
                'location'     => 'Brisbane Exhibition Centre',
                'capacity'     => 90,
            ],
            [
                'organiser_id' => $organiser2->id,
                'title'        => 'Mobile App Development Workshop',
                'description'  => 'Learn how to create mobile applications from scratch.',
                'starts_at'    => Carbon::parse('2025-11-01 09:00:00'),
                'location'     => 'Gold Coast Tech Hub',
                'capacity'     => 30,
            ],
        ];

        foreach ($events as $data) {
            Event::create($data);
        }
    }
}