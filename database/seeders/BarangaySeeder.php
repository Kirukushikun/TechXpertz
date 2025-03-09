<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barangay;
use Illuminate\Support\Facades\DB;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        if (DB::table('barangays')->count() == 0) {

            // Path to the JSON file
            $filePath = database_path('seeders/data/Barangay.json'); // Adjust path if needed

            // Decode JSON data
            $barangays = json_decode(file_get_contents($filePath), true);

            // Insert each barangay into the database
            foreach ($barangays as $barangay) {
                Barangay::create([
                    'name' => $barangay['name'],
                    'code' => $barangay['code'],
                    'city_code' => $barangay['cityCode'] ?: null, // Link to cities (nullable)
                    'municipality_code' => $barangay['municipalityCode'], // Link to municipalities
                    'province_code' => $barangay['provinceCode'], // Optional but useful for queries
                ]);
            }

        }
    }
}
