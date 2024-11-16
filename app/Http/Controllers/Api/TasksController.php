<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskSubmissions;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TasksController
{
    // get data task
    public function index()
    {
        try {
            // Ambil data tasks dari database
            $tasks = Task::select('id', 'title', 'description', 'pengumpulan', 'deadline')->get(); // Pastikan field 'due_date' ada di tabel

            // Format data tasks
            $formattedTasks = $tasks->map(function ($task) {
                return [
                    'id' => $task->id,
                    'title' => $task->title,
                    'description' => $task->description,
                    'type_of_assignment' => $task->pengumpulan,
                    'deadline' => Carbon::parse($task->deadline)->format('Y-m-d'),
                ];
            });

            Log::info('Get data tasks successfully', ['tasks' => $formattedTasks]);

            // Kembalikan respons JSON
            return response()->json([
                'status' => 200,
                'message' => 'Get data tasks successfully',
                'data' => $formattedTasks
            ], 200);
        } catch (\Exception $e) {

            Log::error('An error occurred while fetching tasks', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while fetching tasks',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Post data submit task
    public function submitTask(Request $request)
    {
        \Log::info('Submitting task', ['input' => $request->all()]);
    
        try {
            // Validasi untuk id_task
            $validator = Validator::make($request->all(), [
                'id_task' => 'required|exists:tasks,id',
            ]);
    
            if ($validator->fails()) {
                \Log::error('Validation failed for id_task', ['errors' => $validator->errors()->all()]);
                return response()->json(['errors' => $validator->errors()->all()], 422);
            }
    
            // Mendapatkan tugas berdasarkan id_task
            $tasks = Task::find($request->id_task);
            if (!$tasks) {
                \Log::warning('Task not found', ['id_task' => $request->id_task]);
                return response()->json([
                    'status' => 404,
                    'message' => 'Task not found',
                ], 404);
            }
    
            \Log::info('Task submission type', ['type' => $tasks->pengumpulan]);
    
            // Memastikan pengguna sudah login
            $mahasiswaId = Auth::id();
            if (is_null($mahasiswaId)) {
                \Log::error('User not logged in');
                return response()->json([
                    'status' => 403,
                    'message' => 'Unauthorized: Please log in.',
                ], 403);
            }
    
            if ($tasks->pengumpulan == 'file') {
                // Validasi file jika tipe pengumpulan adalah file
                \Log::info('Submission type is file');
                if (!$request->hasFile('assignment')) {
                    \Log::error('File submission missing file');
                    return response()->json([
                        'status' => 400,
                        'message' => 'No file provided for submission',
                    ], 400);
                }
    
                $filePath = $request->file('assignment')->store('submissions', 'public');
                \Log::info('File stored', ['path' => $filePath]);
    
                TaskSubmissions::create([
                    'id_tugas' => $tasks->id,
                    'id_mahasiswa' => $mahasiswaId,
                    'file' => $filePath,
                    'url' => null,
                ]);
    
                return response()->json([
                    'status' => 200,
                    'message' => 'File submitted successfully',
                ], 200);
    
            } elseif ($tasks->pengumpulan == 'url') {
                // Validasi untuk URL jika tipe pengumpulan adalah URL
                \Log::info('Submission type is URL');
                $urlValidator = Validator::make($request->all(), [
                    'assignment' => 'required|url',
                ]);
    
                if ($urlValidator->fails()) {
                    \Log::error('URL validation failed', ['errors' => $urlValidator->errors()->all()]);
                    return response()->json(['errors' => $urlValidator->errors()->all()], 422);
                }
    
                TaskSubmissions::create([
                    'id_tugas' => $tasks->id,
                    'id_mahasiswa' => $mahasiswaId,
                    'url' => $request->assignment,
                    'file' => null,
                ]);
    
                return response()->json([
                    'status' => 200,
                    'message' => 'URL submitted successfully',
                ], 200);
            }
    
            return response()->json([
                'status' => 400,
                'message' => 'Invalid submission type',
            ], 400);
    
        } catch (\Exception $e) {
            \Log::error('Task submission error', ['exception' => $e->getMessage()]);
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred during task submission',
                'error' => $e->getMessage(),
            ], 500);
        }
    }    
}