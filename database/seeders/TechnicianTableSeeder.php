<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Technician;
use App\Models\RepairShop_Schedules;
use App\Models\RepairShop_Images;
use App\Models\RepairShop_Credentials;

use Faker\Factory as Faker;
use Illuminate\Support\Arr;

class TechnicianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(\App\Models\Technician::count() == 0){
            $faker = Faker::create();
            $profileStatus = ['incomplete', 'pending', 'complete', 'restricted'];
            
            foreach (range(1, 50) as $index) {
                $technician = Technician::create([ // Add the leading backslash here
                    'role' => 'Technician',
                    'profile_status' => 'complete',
                    'firstname' => $faker->firstName,
                    'middlename' => $faker->lastName,
                    'lastname' => $faker->lastName,
                    'email' => $faker->unique()->safeEmail,
                    'contact_no' => $faker->phoneNumber,
                    'educational_background' => $faker->jobTitle,
                    'province' => $faker->country,
                    'city' => $faker->city,
                    'barangay' => $faker->state,
                    'zip_code' => $faker->postcode,
                    'date_of_birth' => $faker->date,
                    'password' => bcrypt('password'),
                ]);

                RepairShop_Credentials::create([
                    'technician_id' => $technician->id,
                    'shop_name' => $faker->company,
                    'shop_email' => $faker->companyEmail,
                    'shop_contact' => $faker->phoneNumber,
                    'shop_address' => $faker->address,
                    'shop_province' => $faker->country,
                    'shop_city' => $faker->city,
                    'shop_barangay' => $faker->state,
                    'shop_zip_code' => $faker->postcode,
                ]);

                foreach([1, 2, 3, 4, 5, 6, 7] as $days){
                    RepairShop_Schedules::create([
                        'technician_id' => $technician->id,
                        'day' => $days,
                    ]);                
                }

                RepairShop_Images::create([
                    'technician_id' => $technician->id,
                    'gallery_status' => 'Active',
                    'image_profile' => null,
                    'image_2' => null,
                    'image_3' => null,
                    'image_4' => null,
                    'image_5' => null,
                ]);

            }
        }
    }
}
