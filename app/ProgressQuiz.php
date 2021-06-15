<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgressQuiz extends Model
{
    protected $table='progress_quiz';
    protected $fillable = [
        'student_id','quiz_id', 'answers', 'point'
    ];
}
