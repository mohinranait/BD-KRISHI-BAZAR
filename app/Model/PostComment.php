<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    protected $fillable = ["user_id", 'post_id', 'comment', 'status'];

    public function userInfo()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

}
