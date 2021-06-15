<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentParent extends Model
{
    protected $table = "student_parent";

    public function parent()
    {
        return $this->belongsTo(Parents::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
