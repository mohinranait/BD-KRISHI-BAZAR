<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAd extends Model
{
    public function pdistrict(){
		return $this->belongsTo('App\Model\District', 'district');
	}

    public function pthana(){
		return $this->belongsTo('App\Model\Upazila', 'thana');
	}
    public function addedBy(){
		return $this->belongsTo('App\Model\User', 'addedby_id');
	}

    public function images(){
		return $this->hasMany('App\ProductImage', 'product_id');
	}

    public function cat(){
		return $this->belongsTo('App\Model\Category', 'category');
	}

    public function subCat(){
		return $this->belongsTo('App\SubCategory', 'sub_category');
	}


}
