<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CustomerTableSeeder; // Import if necessary
use Database\Seeders\TechnicianTableSeeder;
use Database\Seeders\ProvinceSeeder;
use Database\Seeders\CitySeeder;
use Database\Seeders\BarangaySeeder;
use Database\Seeders\ActivateShopsSeeder;

use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Disable foreign key checks (if needed)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Empty specific tables
        DB::table('admin_reportmanagement')->truncate();

        DB::table('technicians')->truncate();
        DB::table('repairshop_credentials')->truncate();
        DB::table('repairshop_profiles')->truncate();
        DB::table('repairshop_mastery')->truncate();
        DB::table('repairshop_services')->truncate();
        DB::table('repairshop_badges')->truncate();
        DB::table('repairshop_schedules')->truncate();
        DB::table('repairshop_images')->truncate();
        DB::table('repairshop_reviews')->truncate();

        DB::table('repairshop_appointments')->truncate();
        DB::table('repairshop_repairstatus')->truncate();

        DB::table('customers')->truncate();
        DB::table('customer_repairstatus')->truncate();

        $this->call([
            CustomerTableSeeder::class,
            TechnicianTableSeeder::class,
            ActivateShopsSeeder::class,
            ProvinceSeeder::class,
            CitySeeder::class,
            BarangaySeeder::class
        ]);
    }
}
