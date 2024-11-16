<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    public function run()
    {
        // Cari user dengan role super_admin
        $dosen = User::whereIn('role', ['super_admin', 'mahasiswa', 'kaprodi', 'admin', 'dosen'])->first();

        if ($dosen) {
            Task::create([
                'id_dosen' => $dosen->id,  // Pastikan id_dosen mengacu pada id SuperAdmin
                'title' => 'Tugas 1',
                'description' => 'Tugas 1 silahkan dikerjakan',
                'pengumpulan' => 'file',
                'deadline' => Carbon::createFromFormat('d-m-Y H:i', '17-10-2024 09:00')
            ]);

            Task::create([
                'id_dosen' => $dosen->id,
                'title' => 'Tugas 2',
                'description' => 'Tugas 2 berupa URL',
                'pengumpulan' => 'url',  // Ubah ke 'url' untuk jenis pengumpulan URL
                'deadline' => Carbon::createFromFormat('d-m-Y H:i', '25-11-2024 17:00')
            ]);
        }
    }
}

