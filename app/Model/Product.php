<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_name','slug','price','weight','quintity','shop_id','status','description','product_image','meta_title','meta_description','meta_keyword'];

    public function cardss()
    {
        return $this->hasMany(Card::class);
    }
}
