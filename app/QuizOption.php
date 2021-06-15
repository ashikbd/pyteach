<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizOption extends Model
{
    protected $table = "quiz_option";
    protected $fillable = ['option'];
}
