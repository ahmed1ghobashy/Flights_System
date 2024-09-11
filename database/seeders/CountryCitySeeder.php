<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            'Egypt' => ['Cairo', 'Alexandria', 'Giza'],
            'Saudi Arabia' => ['Riyadh', 'Jeddah', 'Dammam'],
            'Emirates' => ['Dubai', 'Abu Dhabi', 'Sharjah'],
            'United States' => ['New York', 'Los Angeles', 'Chicago'],
            'Canada' => ['Toronto', 'Vancouver', 'Montreal'],
            'United Kingdom' => ['London', 'Manchester', 'Birmingham'],
            'Germany' => ['Berlin', 'Munich', 'Frankfurt'],
            'France' => ['Paris', 'Lyon', 'Marseille'],
            'Australia' => ['Sydney', 'Melbourne', 'Brisbane'],
            'India' => ['Mumbai', 'Delhi', 'Bangalore']
        ];

        // Loop through each country and insert into the database
        foreach ($countries as $countryName => $cities) {
            // Insert country and get the ID
            $countryId = DB::table('countries')->insertGetId([
                'name' => $countryName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert cities for the country
            foreach ($cities as $city) {
                DB::table('cities')->insert([
                    'name' => $city,
                    'country_id' => $countryId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
