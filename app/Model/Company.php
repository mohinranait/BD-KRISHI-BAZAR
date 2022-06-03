<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function logo()
    {
    	return $this->logo_name ? 'storage/company/logo/'. $this->logo_name : 'img/cl.png';
    }

    public function products()
    {
    	return $this->hasMany('App\Model\Product', 'company_id');
    }

    public function activeProducts()
    {
    	return $this->products()->where('status', 'active')->orderBy('title')->paginate(100);
    }

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    
    
}
