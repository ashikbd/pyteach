<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgressLearning extends Model
{
    protected $table='progress_learning';
    protected $fillable = [
        'student_id','learning_id'
    ];
}
