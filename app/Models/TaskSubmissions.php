<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskSubmissions extends Model
{
    protected $fillable = ['id_tugas', 'id_mahasiswa', 'file', 'url'];

    public function task()
    {
        return $this->belongsTo(Task::class, 'id_tugas');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_mahasiswa');
    }
}
