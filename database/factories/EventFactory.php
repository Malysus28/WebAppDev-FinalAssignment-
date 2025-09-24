<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */


// for generating realistic fake event data for testing and seeding db. it creates an event with rnadom organisers, dates,location and capacities so i dont have to manually enter date while testing 
class EventFactory extends Factory
{
 public function definition(): array
    {
        // start or current date 
        $startsAt=now()
        // add btwn 1 to 30 days to today 
        ->addDays($this->faker->numberBetween(1,30))
        // set a specific hour and min 
        ->setTime(fake()->numberBetween(9, 20), [0,15,30,45][fake()->numberBetween(0,3)]);
        return [
            'organiser_id'=>User::where('type',User::TYPE_ORGANISER)->inRandomOrder()->first()->id,
            'title'=>fake()->words(3, true),
            'description'=>fake()->paragraph(),
            'starts_at'=>$startsAt,
            'location'=>fake()->city(),
            'capacity'=>fake()->numberBetween(10,100),
        ];

        
    }
}
