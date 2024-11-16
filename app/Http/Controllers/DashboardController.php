<?php

namespace App\Http\Controllers;

use App\Models\Compensations;
use App\Models\Task;
use App\Models\TaskSubmissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $tasks = Task::all();
        $requests = TaskSubmissions::where('id_mahasiswa', $user->id)->get();
        $requests_approved = Compensations::where('id_mahasiswa', $user->id)->where('acc_kaprodi', null)->get();
        $requests_decline = Compensations::where('id_mahasiswa', $user->id)->where('acc_kaprodi', '!=', null)->get();

        return view('dashboard.index', compact('tasks', 'requests', 'requests_approved', 'requests_decline'));
    }
}
