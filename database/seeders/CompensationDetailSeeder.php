<?php

namespace Database\Seeders;

use App\Models\Compensations;
use App\Models\CompensationDetails;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CompensationDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        $compensations = Compensations::all();

        foreach ($compensations as $compensation) {
            CompensationDetails::create([
                'id_compensation' => $compensation->id,
                'kelas' => '3C',
                'semester' => $faker->numberBetween(1, 8),
                'jumlah_jam' => $faker->numberBetween(1, 10),
                'waktu' => $faker->dateTimeThisYear(),
            ]);
        }
    }
}