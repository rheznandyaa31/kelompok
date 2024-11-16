<?php

namespace Database\Seeders;



use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = User::all();

        foreach ($users as $user) {
            Notification::create([
                'id_user' => $user->id,
                'title' => $faker->randomElement([
                    'Tugas kamu sudah dikumpulkan',
                    'Kompensasi kamu sudah di ACC oleh Dosen A',
                    'Kompensasi kamu sudah di ACC oleh Kaprodi',
                    'Kompensasi kamu ditolak oleh Dosen A',
                ]),
            ]);
        }
    }
}