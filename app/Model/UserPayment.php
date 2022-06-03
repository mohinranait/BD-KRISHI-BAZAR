<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserPayment extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\Model\User')->withoutGlobalScopes();
    }

    public function addedBy()
    {
    	return $this->belongsTo('App\Model\User', 'addedby_id')->withoutGlobalScopes();
    }

    public function package()
    {
    	return $this->belongsTo('App\Model\MembershipPackage', 'membership_package_id');
    }

 
}
