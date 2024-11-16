<?php

namespace Database\Seeders;

use App\Models\TaskSubmissions;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswa = User::where('role', 'mahasiswa')->get();

        $tasks = Task::all();

        foreach ($tasks as $task) {
            foreach ($mahasiswa as $student) {
                TaskSubmissions::create([
                    'id_tugas' => $task->id,
                    'id_mahasiswa' => $student->id,
                    'file' => 'submission_' . $student->username . '_' . $task->title . '.pdf',
                    'url' => 'https://example.com/submission/' . $student->username . '/' . $task->title,
                ]);
            }
        }
    }
}
