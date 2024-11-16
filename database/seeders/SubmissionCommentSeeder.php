<?php

namespace Database\Seeders;

use App\Models\SubmissionComments;
use App\Models\TaskSubmissions;
use App\Models\User;
use Illuminate\Database\Seeder;

class SubmissionCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = [
            'Tugas kamu sudah dikumpulkan dengan baik.',
            'Tugas ini masih kurang lengkap, coba perbaiki.',
            'Pengumpulan tugas kamu sudah diterima.',
            'Tugas kamu sudah dikoreksi, ada beberapa perbaikan yang perlu dilakukan.',
        ];

        $taskSubmissions = TaskSubmissions::all();

        foreach ($taskSubmissions as $submission) {
            $user = User::whereIn('role', ['dosen', 'kaprodi'])->inRandomOrder()->first();
            
            SubmissionComments::create([
                'id_submission' => $submission->id,
                'id_user' => $user->id,
                'comment' => $comments[array_rand($comments)],
                'time' => now(),
            ]);
        }
    }
}
