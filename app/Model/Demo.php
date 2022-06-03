<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Demo extends Model
{
    protected $fillable = [
        'name', 'img', 'link', 'demo_file', 'category'
    ];
}
