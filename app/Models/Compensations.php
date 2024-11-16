<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compensations extends Model
{
    protected $fillable = ['id_tugas', 'id_mahasiswa', 'id_dosen', 'id_kaprodi', 'acc_dosen', 'acc_kaprodi'];
}
