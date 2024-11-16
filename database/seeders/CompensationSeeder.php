<?php

namespace Database\Seeders;


use App\Models\Compensations;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompensationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = Task::all();
        $mahasiswa = User::where('role', 'mahasiswa')->get();
        $dosen = User::where('role', 'dosen')->get();
        $kaprodi = User::where('role', 'kaprodi')->get();

        $approvalOptions = ['terima', 'tolak', null];

        foreach ($tasks as $task) {
            foreach ($mahasiswa as $student) {
                $accDosen = $approvalOptions[array_rand($approvalOptions)];
                $accKaprodi = $approvalOptions[array_rand($approvalOptions)];

                Compensations::create([
                    'id_tugas' => $task->id,
                    'id_mahasiswa' => $student->id,
                    'id_dosen' => $accDosen ? $dosen->random()->id : null,
                    'id_kaprodi' => $accKaprodi ? $kaprodi->random()->id : null,
                    'acc_dosen' => $accDosen,
                    'acc_kaprodi' => $accKaprodi,
                ]);
            }
        }
    }
}
