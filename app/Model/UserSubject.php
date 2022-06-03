<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserSubject extends Model
{
    protected $fillable = [
        'id', 'user_id', 'subject_id'
    ];



    public function subject()
    {
        return $this->hasOne('App\Model\UserSubject')->where('title', $this->subject_id);
    }
}
