<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompensationDetails extends Model
{
    protected $fillable = ['id_compensation', 'kelas', 'semester', 'jumlah_jam', 'waktu'];
}
