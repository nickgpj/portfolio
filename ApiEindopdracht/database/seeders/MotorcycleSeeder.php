<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Motorcycle;

class MotorcycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Motorcycle::create([
            'brand' => 'Yamaha',
            'model' => 'MT-07',
            'year' => 2022,
            'horsepower' => 176,
        ]);

        Motorcycle::create([
            'brand' => 'Honda',
            'model' => 'CBR600RR',
            'year' => 2021,
            'horsepower' => 124,
        ]);

        Motorcycle::create([
            'brand' => 'Kawasaki',
            'model' => 'Ninja ZX-10R',
            'year' => 2023,
            'horsepower' => 180,
        ]);
    }
}
