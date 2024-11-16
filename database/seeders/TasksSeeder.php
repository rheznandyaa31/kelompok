<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;


class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dosen = User::where('role', 'dosen')->first();

        Task::create([
            'id_dosen' => $dosen->id,
            'title' => 'Tugas 1 - Pemrograman Web',
            'description' => 'Tugas ini mencakup pembuatan website sederhana dengan menggunakan framework Laravel.',
            'pengumpulan' => 'file',
            'deadline' => now()->addDays(7),
        ]);

        Task::create([
            'id_dosen' => $dosen->id,
            'title' => 'Tugas 2 - Basis Data',
            'description' => 'Membuat skema database dan query SQL untuk aplikasi toko online.',
            'pengumpulan' => 'url',
            'deadline' => now()->addDays(10),
        ]);

        Task::create([
            'id_dosen' => $dosen->id,
            'title' => 'Tugas 3 - Jaringan Komputer',
            'description' => 'Tugas ini mencakup pembuatan jaringan sederhana menggunakan perangkat keras dan software.',
            'pengumpulan' => 'file',
            'deadline' => now()->addDays(5),
        ]);
    }
}