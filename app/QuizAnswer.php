<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    protected $table = "quiz_answer";
    protected $fillable = ['answer'];
}
