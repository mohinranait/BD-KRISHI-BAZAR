<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public function cat()
    {
        return $this->belongsTo('App\Model\Category', 'cat_id');

    }
}
