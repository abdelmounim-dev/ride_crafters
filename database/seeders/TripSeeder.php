<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trip;
use App\Models\Location;
use App\Models\User;
use Faker\Factory as Faker;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            // Create fake locations
            $startLocation = Location::create([
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
                'address' => $faker->address,
            ]);

            $destination = Location::create([
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
                'address' => $faker->address,
            ]);

            // Create a fake driver user
            $driver = User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'phone_number' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'student_id' => $faker->uuid,
                'password' => bcrypt($faker->password),
                'is_admin' => false, // Adjust based on your needs
            ]);

            // Create a fake trip
            $trip = Trip::create([
                'start_location' => $startLocation->id,
                'destination' => $destination->id,
                'departure_time' => $faker->dateTimeBetween('now', '+1 month'),
                'driver_id' => $driver->id,
                'available_seats' => $faker->numberBetween(1, 5),
            ]);
            // Optionally, add passengers to the trip
            $passengersCount = $faker->numberBetween(0, 5);
            $passengers = User::inRandomOrder()->limit($passengersCount)->get();

            // Use the attach() method to associate passengers with the trip
            $trip->passengers()->attach($passengers->pluck('id')->toArray());
        }
    }
}
