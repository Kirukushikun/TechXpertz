<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Province;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (DB::table('provinces')->count() == 0) {
            // Path to the JSON file
            $filePath = database_path('seeders/data/Province.json');

            // Decode JSON data
            $provinces = json_decode(file_get_contents($filePath), true);

            // Insert each province into the database
            foreach ($provinces as $province) {
                Province::create([
                    'name' => $province['name'],
                    'code' => $province['code'],
                ]);
            }
        }        
    }
}
