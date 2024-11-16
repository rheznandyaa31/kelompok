<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmissionComments extends Model
{
    protected $fillable = ['id_submission', 'id_user', 'comment', 'time'];
}
