<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

use Faker\Factory as Faker;
use Illuminate\Support\Arr;


class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        if(Customer::count() <= 1){
            $faker = Faker::create();
            foreach (range(1, 100) as $index) {
                Customer::create([ // Add the leading backslash here
                    'profile_status' => 'verified',
                    'image_profile' => null,
                    'image_status' => 'active',
                    'firstname' => $faker->firstName, // Change name to firstName for better accuracy
                    'lastname' => $faker->lastName,
                    'email' => $faker->unique()->safeEmail,
                    'password' => bcrypt('password'),
                ]);
            }
        }
    }
}
