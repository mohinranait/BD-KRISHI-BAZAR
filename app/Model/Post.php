<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'subject_id', 'class_id', 'category_id',
    ];

    public function category()
    {
    	return $this->belongsTo('App\Model\Category', 'category_id');
    }

    public function class()
    {
    	return $this->belongsTo('App\Model\PostClass', 'class_id');
    }

    public function subject()
    {
    	return $this->belongsTo('App\Model\Subject', 'subject_id');
    }

    

    
}
