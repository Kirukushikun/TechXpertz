<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Admin_ReportManagement;
use App\Models\Province;
use App\Models\City;
use App\Models\Barangay;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;
use Illuminate\Support\Arr;


class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {   
        $faker = Faker::create();

        function generateUniqueCustomerEmail() {
            $faker = Faker::create();
            do {
                $email = $faker->unique()->safeEmail; // Generate a new email
                $existsInCustomers = DB::table('customers')->where('email', $email)->exists();
                $existsInTechnicians = DB::table('technicians')->where('email', $email)->exists();
            } while ($existsInCustomers || $existsInTechnicians); // Repeat if email exists in either table
            return $email;
        }

        foreach (range(1, 200) as $index) {
            // Randomly pick a province, city, and barangay
            $province = Province::inRandomOrder()->first();
            $city = City::where('province_code', $province->code)->inRandomOrder()->first();
            $barangay = Barangay::where(function ($query) use ($city) {
                $query->where('city_code', $city->code)
                        ->orWhere('municipality_code', $city->code);
            })->inRandomOrder()->first();

            $customer = Customer::create([ // Add the leading backslash here
                'profile_status' => 'verified',
                'image_profile' => null,
                'image_status' => 'active',
                'firstname' => $faker->firstName, // Change name to firstName for better accuracy
                'lastname' => $faker->lastName,
                'email' => generateUniqueCustomerEmail(),
                'contact' => $faker->phoneNumber,
                'province' => $province->name,   // Province name
                'city' => $city->name,           // City/Municipality name
                'barangay' => $barangay->name,   // Barangay name
                'password' => bcrypt('password'),
            ]);

            foreach(range(1, 10) as $report){
                Admin_ReportManagement::create([
                    'user_id' => $customer->id,
                    'user_role' => 'Customer',
                    'user_name' => $customer->firstname . ' ' . $customer->lastname,
                    'user_email' => $customer->email,
                    'report_status' => Arr::random(['Pending', 'Resolved', 'Escalated']),
                    'category' => Arr::random(['Category 1', 'Category 2', 'Category 3', 'Category 4']),
                    'sub_category' => Arr::random(['Sub category 1', 'Sub category 2', 'Sub category 3', 'Sub category 4']),
                    'description' => $faker->sentence(30)
                ]);
            }
        }
    }
}
