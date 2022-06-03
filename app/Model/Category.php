<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function posts()
    {
    	return $this->hasMany('App\Model\Post', 'category_id');
    }

    public function sub_cat()
    {
    	return $this->hasMany('App\SubCategory', 'cat_id');
    }

    public function catSubPosts($classId,$subId,$paginate)
    {

    	return $this->posts()
    		->where('class_id', $classId)
    		->where('subject_id', $subId)
    		->where('publish_status', 'published')
    		->orderBy('title')
    		->latest()
    		->paginate($paginate);
    }

}
