<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgressPractice extends Model
{
    protected $table='progress_practice';
    protected $fillable = [
        'student_id','practice_id'
    ];
}
