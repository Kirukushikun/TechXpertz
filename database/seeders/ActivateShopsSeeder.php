<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Customer;
use App\Models\Customer_RepairStatus;

use App\Models\Technician;
use App\Models\RepairShop_Mastery;
use App\Models\RepairShop_Profiles;
use App\Models\RepairShop_Reviews;
use App\Models\RepairShop_Schedules;
use App\Models\RepairShop_Services;
use App\Models\RepairShop_Socials;
use App\Models\RepairShop_Appointments;
use App\Models\RepairShop_RepairStatus;
use App\Models\RepairShop_Badges;
use App\Models\RepairShop_Images;

use Faker\Factory as Faker;
use Illuminate\Support\Arr;

class ActivateShopsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $faker = Faker::create();
        $customer = Customer::all();
        $technicians = Technician::where('profile_status', 'complete')->get();

        $masteries = ['Smartphone', 'Tablet', 'Desktop', 'Laptop', 'Smartwatch', 'Camera', 'Printer', 'Speaker', 'Drone', 'All-In-One'];
        $badges = [
            "24/7 Customer Support",
            "Advanced Diagnostic Tools",
            "Authorized Repair Center",
            "Certified Technicians On-Site",
            "Emergency Repair Service",
            "Exclusive Offers Available",
            "Experienced Staff",
            "Expert Troubleshooting",
            "Fastest Repair Times",
            "Free Diagnostic Service",
            "Loyalty Rewards Program",
            "No Hidden Charges",
            "Original Parts Used",
            "Pickup and Delivery Service",
            "Proven Repair Methods",
            "Same-Day Service",
            "Seamless Repair Process",
            "Secure Data Handling",
            "Specialized in All Brands",
            "Warranty on All Repairs"
        ];
        $services = [1, 2, 3, 4];

        foreach($technicians as $technician){
            RepairShop_Profiles::create([
                'technician_id' => $technician->id,
                'header' => $faker->sentence(5),
                'description' => $faker->sentence(20),
            ]);

            $repairshopMastery = RepairShop_Mastery::create([
                'technician_id' => $technician->id,
                'main_mastery' => Arr::random($masteries),
                'Smartphone' => Arr::random([1, 0]),
                'Tablet' => Arr::random([1, 0]),
                'Desktop' => Arr::random([1, 0]),
                'Laptop' => Arr::random([1, 0]),
                'Smartwatch' => Arr::random([1, 0]),
                'Camera' => Arr::random([1, 0]),
                'Printer' => Arr::random([1, 0]),
                'Speaker' => Arr::random([1, 0]),
                'Drone' => Arr::random([1, 0]),
                'All-In-One' => Arr::random([1, 0]),
            ]);

            $randomNumber = Arr::random([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
            $imagePath = 'ShopImageSample/' . $repairshopMastery->main_mastery . '-' . $randomNumber . '.png';

            RepairShop_Images::create([
                'technician_id' => $technician->id,
                'gallery_status' => 'Active',
                'image_profile' => $imagePath,
                'image_2' => null,
                'image_3' => null,
                'image_4' => null,
                'image_5' => null,
            ]);

            RepairShop_Badges::create([
                'technician_id' => $technician->id,
                'badge_1' => Arr::random($badges),
                'badge_2' => Arr::random($badges),
                'badge_3' => Arr::random($badges),
                'badge_4' => Arr::random($badges),
            ]);
            
            for($i = 0; $i < Arr::random($services); $i++){
                RepairShop_Services::create([
                    'technician_id' => $technician->id,
                    'service' => $faker->sentence(10),
                ]);                
            }

            $schedules = RepairShop_Schedules::where('technician_id', $technician->id)->get();
            foreach($schedules as $schedule){
                $schedule->update([
                    'status' => 'open',
                    'opening_time' => $faker->time(),
                    'closing_time' => $faker->time()
                ]);
            }

            foreach(range(1, 100) as $appointment){
                $selectedCustomer = Customer::find($customer->random()->id);
                $appointment = RepairShop_Appointments::create([
                    'technician_id' => $technician->id,
                    'customer_id' => $selectedCustomer->id,
                    'status' => 'requested',
                    'fullname' => $selectedCustomer->firstname . '' . $selectedCustomer->lastname,
                    'email' => $selectedCustomer->email,
                    'contact_no' => $faker->phoneNumber,

                    'device_type' => Arr::random($masteries),
                    'device_brand' => $faker->word,
                    'device_model' => $faker->word,
                    'device_serial' => $faker->word,

                    'issue_descriptions' => $faker->word,
                    'error_message' => $faker->word,
                    'repair_attempts' => $faker->word,
                    'recent_events' => $faker->word,
                    'prepared_parts' => $faker->word,

                    'appointment_date' => $faker->date,
                    'appointment_time' => $faker->time(),

                    'appointment_urgency' => 'Low',
                ]);
                $repairstatus = RepairShop_RepairStatus::create([
                    'technician_id' => $technician->id,
                    'customer_id' => $selectedCustomer->id,
                    'customer_fullname' => $selectedCustomer->firstname . '' . $selectedCustomer->lastname,
                    'appointment_id' => $appointment->id,
                    'status' => 'pending',
                    'paid_status' => 'unpaid',
                    'revenue' => $faker->randomFloat(2, 10, 10000),
                    'expenses' => $faker->randomFloat(2, 10, 10000),
                    'repairstatus' => 'Device Dropped Off',
                    'repairstatus_message' => $faker->sentence(20),
                ]);
                Customer_RepairStatus::create([
                    'technician_id' => $technician->id,
                    'repair_id' => $repairstatus->id,
                    'customer_id' => $selectedCustomer->id,
                    'repairstatus' => 'Appointment Requested',
                    'repairstatus_message' => $faker->sentence(20),
                ]);

                $ratings = [1, 2, 3, 4, 5];
                RepairShop_Reviews::create([
                    'technician_id' => $technician->id,
                    'customer_id' => $selectedCustomer->id,
                    'customer_fullname' => $selectedCustomer->firstname . '' . $selectedCustomer->lastname,
                    'rating' => Arr::random($ratings),
                    'review_comment' => $faker->sentence(30),
                    'status' => Arr::random([2, 1, 2]),
                ]);
            }



        }
    }
}
