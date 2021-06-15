<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = "topic";

    public function learning()
    {
        return $this->hasMany(Learning::class);
    }

    public function practice()
    {
        return $this->hasMany(Practice::class);
    }

    public function quiz()
    {
        return $this->hasMany(Quiz::class);
    }

    public function progress($id){
        return self::find($id)->point;
    }
}
