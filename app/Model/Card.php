<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Card extends Model
{


    protected $fillable = ['product_id','product_qty','unite_price','order_id','user_id','weight','shop_id','ip_address'];
    

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function shop(){
        return $this->belongsTo(ShopInformation::class);
    }




    public static function cardItemCount(){
        if( Auth::check() ){
            $cards = Card::where('user_id',Auth::id())->where('ip_address', request()->ip())->where('order_id',NULL)->get();
        }
        $cards = Card::where('ip_address', request()->ip())->where('order_id',NULL)->get();

        $totalAddToCard = 0;
        foreach( $cards as $card){
            $totalAddToCard += $card->product_qty;
        }
        return $totalAddToCard;
    }

    public static function totalItems(){
        if( Auth::check() ){
            $cards = Card::where('user_id',Auth::id())->where('ip_address', request()->ip())->where('order_id',NULL)->get();
        }
        $cards = Card::where('ip_address', request()->ip())->where('order_id',NULL)->get();

        return $cards;
    }


    public static function totalPrice(){
        if( Auth::check() ){
            $cards = Card::where('user_id',Auth::id())->where('ip_address', request()->ip())->where('order_id',NULL)->get();
        }
        $cards = Card::where('ip_address', request()->ip())->where('order_id',NULL)->get();

        $totalAddToCard = 0;
        foreach( $cards as $card){
            $totalAddToCard += $card->product_qty * $card->unite_price;
        }
        return $totalAddToCard;

    }

}
