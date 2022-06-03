<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostClass extends Model
{
    public function posts()
    {
    	return $this->hasMany('App\Model\Post', 'class_id');
    }
}
