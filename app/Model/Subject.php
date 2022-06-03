<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function posts()
    {
    	return $this->hasMany('App\Model\Post', 'subject_id');
    }
}
