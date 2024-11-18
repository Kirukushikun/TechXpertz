<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        if (DB::table('cities')->count() == 0) {
            // Path to the JSON file
            $filePath = database_path('seeders/data/City-Municipality.json'); // Adjust path if needed

            // Decode JSON data
            $cities = json_decode(file_get_contents($filePath), true);

            // Insert each city into the database
            foreach ($cities as $city) {
                City::create([
                    'name' => $city['name'],
                    'code' => $city['code'],
                    'province_code' => $city['provinceCode'], // Foreign key to the provinces table
                    'is_city' => $city['isCity'],
                    'is_municipality' => $city['isMunicipality'],
                ]);
            }
        }

    }
}
