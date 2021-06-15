<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = "quiz";

    protected static function boot()
    {
        parent::boot();

        // Order by name ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('position', 'asc');
        });
    }

    public function quiz_option()
    {
        return $this->hasMany(QuizOption::class);
    }

    public function quiz_answer()
    {
        return $this->hasMany(QuizAnswer::class);
    }
}
