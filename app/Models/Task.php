<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['id_dosen', 'title', 'description', 'pengumpulan', 'deadline'];
   
    public function TaskSubmissions()
    {
        return $this->hasMany(TaskSubmissions::class, 'id_tugas');
    }
}
