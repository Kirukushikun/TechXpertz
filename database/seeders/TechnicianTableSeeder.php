<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Technician;
use App\Models\RepairShop_Schedules;
use App\Models\RepairShop_Images;
use App\Models\RepairShop_Credentials;

use App\Models\Admin_ReportManagement;

use App\Models\Province;
use App\Models\City;
use App\Models\Barangay;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;
use Illuminate\Support\Arr;

class TechnicianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $profileStatus = ['incomplete', 'pending', 'complete', 'restricted'];

        function generateUniqueTechnicianEmail() {
            $faker = Faker::create();
            do {
                $email = $faker->unique()->safeEmail; // Generate a new email
                $existsInCustomers = DB::table('customers')->where('email', $email)->exists();
                $existsInTechnicians = DB::table('technicians')->where('email', $email)->exists();
            } while ($existsInCustomers || $existsInTechnicians); // Repeat if email exists in either table
            return $email;
        }
        
        foreach (range(1, 100) as $index) {
            // Randomly pick a province, city, and barangay
            $province = Province::inRandomOrder()->first();
            $city = City::where('province_code', $province->code)->inRandomOrder()->first();
            $barangay = Barangay::where(function ($query) use ($city) {
                $query->where('city_code', $city->code)
                        ->orWhere('municipality_code', $city->code);
            })->inRandomOrder()->first();

            $technician = Technician::create([ // Add the leading backslash here
                'role' => 'Technician',
                'profile_status' => 'complete',
                'firstname' => $faker->firstName,
                'middlename' => $faker->lastName,
                'lastname' => $faker->lastName,
                'email' => generateUniqueTechnicianEmail(),
                'contact_no' => $faker->phoneNumber,
                'educational_background' => $faker->jobTitle,
                'province' => $province->name,   // Province name
                'city' => $city->name,           // City/Municipality name
                'barangay' => $barangay->name,   // Barangay name
                'zip_code' => $faker->postcode,
                'date_of_birth' => $faker->date,
                'password' => bcrypt('password'),
            ]);

            RepairShop_Credentials::create([
                'technician_id' => $technician->id,
                'shop_name' => $faker->company . '' . 'Repair Shop',
                'shop_email' => generateUniqueTechnicianEmail(),
                'shop_contact' => $faker->phoneNumber,
                'shop_address' => $faker->address,
                'shop_province' => $technician->province,
                'shop_city' => $technician->city,
                'shop_barangay' => $technician->barangay,
                'shop_zip_code' => $faker->postcode,
            ]);

            foreach([1, 2, 3, 4, 5, 6, 7] as $days){
                RepairShop_Schedules::create([
                    'technician_id' => $technician->id,
                    'day' => $days,
                ]);                
            }

            foreach(range(1, 10) as $report){
                Admin_ReportManagement::create([
                    'user_id' => $technician->id,
                    'user_role' => 'Technician',
                    'user_name' => $technician->firstname . ' ' . $technician->lastname,
                    'user_email' => $technician->email,
                    'report_status' => Arr::random(['Pending', 'Resolved', 'Escalated']),
                    'category' => Arr::random(['Category 1', 'Category 2', 'Category 3', 'Category 4']),
                    'sub_category' => Arr::random(['Sub category 1', 'Sub category 2', 'Sub category 3', 'Sub category 4']),
                    'description' => $faker->sentence(30)
                ]);
            }
        }
    }
}
