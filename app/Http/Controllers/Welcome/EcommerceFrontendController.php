<?php

namespace App\Http\Controllers\Welcome;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Model\Product;
use App\Model\District;
use App\Model\Card;
use App\Model\Order;
use File;
use Image; 
use Auth;
use DB;

use App\Model\ShopInformation;

class EcommerceFrontendController extends Controller
{

    // Shop page / shop wish product
    public function ShopByProduct($slug)
    {
        $shop = ShopInformation::where('slug', $slug)->first();
        if( !empty( $shop)){
            $products = Product::orderby('id','desc')->where('shop_id', $shop->id)->get();
            return view('welcome.ecommerce.shop-by-product',compact('shop','products'));
        }
    }

    // All user product show in table  
    public function userProduct(){
    
        $shop = ShopInformation::where('shop_user_id', Auth::user()->id)->first();
        return view("user.user-product",compact('shop'));
    }

    // Create user Product
    public function userProductAdd( $id ){
        $shop = ShopInformation::find($id);
        if( !empty($shop)){
            return view('user.user-product-add', compact('shop'));
        }
    }
    

    // Store user products
    public function userProductStore(Request $request){

        $this->validate($request,[
            'product_name'          =>'required',
            'price'                 =>'required',
            'weight'                =>'required',
            'product_image'         =>'required',
            'quintity'         =>'required',
        ],[
            'product_name.required'         => 'Name is required',
            'price.required'                => 'The price is required',
            'weight.required'               => 'The Weight is required',
            'quintity.required'               => 'Quintity is required',
            'product_image.required'        => 'Image is required',
        ]);

        $product = new Product();
        $product->product_name  = $request->product_name;
        $product->slug          = Str::slug($request->product_name);
        $product->price         = $request->price;
        $product->weight        = $request->weight;
        $product->quintity      = $request->quintity;
        $product->shop_id       = $request->shop_id;
        $product->description   = $request->description;
        $product->meta_title    = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keyword  = $request->meta_keyword;

        if( $request->product_image ){
            $cashImage = $request->file('product_image');
            $imageName = time() . ".". $cashImage->getClientOriginalName();
            $location = public_path('img/product/' . $imageName);
            Image::make($cashImage)->save($location);
            $product->product_image = $imageName;
        }

        $product->save();
        return redirect()->back()->with('success', "Create Successfull");

    }

    // Edit user Product
    public function userProductEdit( $slug ){
        $shop = ShopInformation::where('shop_user_id', Auth::user()->id)->first();
        $product = Product::where('shop_id', $shop->id)->where('slug',$slug)->first();
        if(!empty($product)){
            return view("user.product-edit",compact('product'));
        }else{
            return redirect()->back();
        }
    }

    // Update user products
    public function userProductUpdate(Request $request , $id){
        $product =  Product::find($id);
        $product->product_name  = $request->product_name;
        $product->slug          = Str::slug($request->product_name);
        $product->price         = $request->price;
        $product->weight        = $request->weight;
        $product->quintity      = $request->quintity;
        $product->description   = $request->description;
        $product->meta_title    = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keyword  = $request->meta_keyword;

        if( $request->product_image ){

            if( File::exists('img/product/' . $product->product_image)){
                File::delete('img/product/' . $product->product_image);
            }

            $cashImage = $request->file('product_image');
            $imageName = time() . ".". $cashImage->getClientOriginalName();
            $location = public_path('img/product/' . $imageName);
            Image::make($cashImage)->save($location);
            $product->product_image = $imageName;
        }

        $product->save();
        return redirect()->back()->with('success', "Update Successfull");
    }

    // Delete user products
    public function userProductDelete($id){
        $product = Product::find($id);
        if( $product){

            if( File::exists('img/product/' . $product->product_image)){
                File::delete('img/product/' . $product->product_image);
            }

            $product->delete();

        }
        return redirect()->back()->with('success', "Delete Successfull");
    }

    // Products page / products Details page
    public function products($slug)
    {
        $product = Product::where('slug',$slug)->first();
        if( !empty($product)){
            return view('welcome.ecommerce.products',compact('product'));
        }
        
    }
   


    // User Shop Create
    public function frontendShopCreate(){

        if(Auth::check()){
            $ShopInformation = ShopInformation::where('shop_user_id', Auth::id())->get();
            if( $ShopInformation->count() == 1 ){
                return redirect()->route("user.dashboard")->with("message" , "Shop already exists");
            }else{
                $districts = District::orderby('name','asc')->get();
                return view('user.shop-create',compact('districts'));
            }
        }else{
            return redirect('/login')->with("message" , "login First");
        } 
    }

    // User Shop Store
    public function frontendShopStore(Request $request){
         $this->validate($request,[
            'shop_name'         =>'required',
            'shop_email'        =>'required',
            'shop_phone'        =>'required',
            'shop_district_id'  =>'required',
            'shop_upzila_id'    =>'required',
            'shop_user_profile' =>'required',
            'shop_cover_photo'  =>'required',
            'shop_logo'         =>'required',
        ],[
            'shop_name.required'        => 'Shop Name is required',
            'shop_email.required'       => 'The email is required',
            'shop_phone.required'       => 'The phone is required',
            'shop_district_id.required' => 'required',
            'shop_upzila_id.required'   => 'required',
            'shop_user_profile.required'=> 'required',
            'shop_cover_photo.required' => 'required',
            'shop_logo.required'        => 'required',
        ]);
        
        
        $newShop = new ShopInformation();
        $newShop->shop_name         = $request->shop_name;
        $newShop->slug              = Str::slug($request->shop_name);
        $newShop->shop_email        = $request->shop_email;
        $newShop->shop_phone        = $request->shop_phone;
        $newShop->shop_district_id  = $request->shop_district_id;
        $newShop->shop_upzila_id    = $request->shop_upzila_id;
        $newShop->shop_user_id      = $request->shop_user_id;


        if( $request->shop_user_profile ){
            $cashImage = $request->file('shop_user_profile');
            $imageName = time() . ".". $cashImage->getClientOriginalName();
            $location = public_path('img/shop/' . $imageName);
            Image::make($cashImage)->save($location);
            $newShop->shop_user_profile = $imageName;
        }

        if( $request->shop_cover_photo ){
            $cashImage = $request->file('shop_cover_photo');
            $imageName = time() . ".". $cashImage->getClientOriginalName();
            $location = public_path('img/shop/' . $imageName);
            Image::make($cashImage)->save($location);
            $newShop->shop_cover_photo = $imageName;
        }

        if( $request->shop_logo ){
            $cashImage = $request->file('shop_logo');
            $imageName = time() . ".". $cashImage->getClientOriginalName();
            $location = public_path('img/shop/' . $imageName);
            Image::make($cashImage)->resize(300,200)->save($location);
            $newShop->shop_logo = $imageName;
        }
        $newShop->save();
        return redirect()->route('user.dashboard')->with("message" , "Create Successfull");
    }


    // User shop Edit
    public function frontendShopEdit($slug){
        $shop = ShopInformation::where('shop_user_id', Auth::id())->where('slug', $slug)->first();
        if( !empty( $shop) ){
            $districts = District::orderby('name','asc')->get();
            return view('user.edit-shop',compact('shop','districts'));
        }else{
            return redirect()->back();
        }
    }

    // User Shop update
    public function frontendShopUpdate( Request $request, $id ){
        $this->validate($request,[
            'shop_name'         =>'required',
            'shop_email'        =>'required',
            'shop_phone'        =>'required',
            'shop_district_id'  =>'required',
            'shop_upzila_id'    =>'required',
        ],[
            'shop_name.required'        => 'Shop Name is required',
            'shop_email.required'       => 'The email is required',
            'shop_phone.required'       => 'The phone is required',
            'shop_district_id.required' => 'required',
            'shop_upzila_id.required'   => 'required',
        ]);
        
    
        $newShop =  ShopInformation::find($id);
        $newShop->shop_name         = $request->shop_name;
        $newShop->slug              = Str::slug($request->shop_name);
        $newShop->shop_email        = $request->shop_email;
        $newShop->shop_phone        = $request->shop_phone;
        $newShop->shop_district_id  = $request->shop_district_id;
        $newShop->shop_upzila_id    = $request->shop_upzila_id;
        $newShop->shop_user_id      = $request->shop_user_id;


        if( $request->shop_user_profile ){
            if( File::exists('img/shop/'. $newShop->shop_user_profile)){
                File::delete('img/shop/'. $newShop->shop_user_profile);
            }
            $cashImage = $request->file('shop_user_profile');
            $imageName = time() . ".". $cashImage->getClientOriginalName();
            $location = public_path('img/shop/' . $imageName);
            Image::make($cashImage)->save($location);
            $newShop->shop_user_profile = $imageName;
        }

        if( $request->shop_cover_photo ){
            if( File::exists('img/shop/'. $newShop->shop_cover_photo)){
                File::delete('img/shop/'. $newShop->shop_cover_photo);
            }

            $cashImage = $request->file('shop_cover_photo');
            $imageName = time() . ".". $cashImage->getClientOriginalName();
            $location = public_path('img/shop/' . $imageName);
            Image::make($cashImage)->save($location);
            $newShop->shop_cover_photo = $imageName;
        }

        if( $request->shop_logo ){
            if( File::exists('img/shop/'. $newShop->shop_logo)){
                File::delete('img/shop/'. $newShop->shop_logo);
            }

            $cashImage = $request->file('shop_logo');
            $imageName = time() . ".". $cashImage->getClientOriginalName();
            $location = public_path('img/shop/' . $imageName);
            Image::make($cashImage)->resize(300,200)->save($location);
            $newShop->shop_logo = $imageName;
        }
        $newShop->save();
        return redirect()->route('user.dashboard')->with("message" , "Create Successfull");
    }

    public function productIncremen(Request $request){
        if( Auth::check() ){
            $cards = Card::where('user_id', Auth::id())->where('product_id', $request->product_id)->where('order_id',NULL)->first();  
        }
        $cards = Card::where('ip_address', request()->ip())->where('product_id', $request->product_id)->where('order_id',NULL)->first();  
        

        if( !empty($cards) ){
            $cards->increment('product_qty');
            return redirect()->back();
        }else{

            $card = new Card();
            $card->product_id = $request->product_id;
            $card->user_id = $request->user_id;
            $card->ip_address =request()->ip();
            $card->unite_price = $request->unite_price;
            $card->product_qty = $request->product_qty;
            $card->weight = $request->weight;
            $card->shop_id = $request->shop_id;

            $card->save();
            return redirect()->back();

        }
    }

    
    public function productDecremen(Request $request){

        if( Auth::check() ){
            $cards = Card::where('user_id', Auth::id())->where('product_id', $request->product_id)->where('order_id',NULL)->first();
            if( !empty($cards) ){
                $card = Card::where('user_id', Auth::id())->where('product_qty',0)->where('product_id', $request->product_id)->first();
                if( $card == true ){
                    return redirect()->back();
                }else{
                    $cards->decrement('product_qty');
                    return redirect()->back();
                }
            }
            return redirect()->back();
        }else{
            $cards = Card::where('ip_address', request()->ip())->where('product_id', $request->product_id)->where('order_id',NULL)->first();
            if( !empty($cards) ){
                $card = Card::where('user_id', Auth::id())->where('product_qty',0)->where('product_id', $request->product_id)->first();
                if( $card == true ){
                    return redirect()->back();
                }else{
                    $cards->decrement('product_qty');
                    return redirect()->back();
                }
            }
            return redirect()->back();
        }
    }

    public function productAddtoCard(Request $request){
        if(Auth::check()){

            $card = new Card();
            $card->product_id = $request->product_id;
            $card->user_id = Auth::id();
            $card->ip_address =request()->ip();
            $card->unite_price = $request->unite_price;
            $card->product_qty = $request->product_qty;
            $card->weight = $request->weight;
            $card->shop_id = $request->shop_id;
            $card->save();
            return redirect()->back();

        }else{
            $card = new Card();
            $card->product_id = $request->product_id;
            $card->ip_address =request()->ip();
            $card->unite_price = $request->unite_price;
            $card->product_qty = $request->product_qty;
            $card->weight = $request->weight;
            $card->shop_id = $request->shop_id;
            $card->save();
            return redirect()->back();
        }
    }


    // Card page
    public function CardPage(){

        $products = Card::orderby('id','desc')->where('ip_address', request()->ip() )->where("order_id", NULL)->get();
        return view('user.card-page',compact('products'));
    }

    // Checkout page
    public function checkout(){
        $products = Card::orderby('id','desc')->where('order_id',NULL)->get();
        $districts = District::orderby('name','asc')->get();
        return view('user.checkout',compact('products','districts'));
    }

    // Delete card item 
    public function cartItemDelete($id){
        $delete  = Card::find($id);
        if( !empty($delete)){
            $delete->delete();
            return redirect()->back();
        }
    }

    // Order place function
    public function order(Request $request){
        if(Auth::check()){

            $cards = DB::table('cards')->where('order_id', NULL)->where('ip_address', request()->ip())->select('ip_address','order_id')->first();
            if( !empty($cards)){
                    
                $orders = new Order();
                $orders->name           = $request->name;
                $orders->email          = $request->email;
                $orders->phone          = $request->phone;
                $orders->address        = $request->address;
                $orders->user_id        = Auth::id();
                $orders->ip_address     = request()->ip();
                $orders->is_paid        = $request->is_paid;
                $orders->amount         = $request->amount;
                $orders->payment_method = $request->payment_method;
                $orders->transaction_id = $request->transaction_id;
                $orders->save();

                if( $cards->order_id == NULL ){
                    $update_cards = DB::table('cards')
                    ->where('ip_address', request()->ip())
                    ->where('order_id', NULL)
                    ->update(['order_id' => $orders->id ]);
                    
                }
                return redirect()->route('user.dashboard')->with('massege','Order Place successfull');

            }else{
                return redirect()->back()->with('massage',"Product add to cart, Then checkout");
            }

        }else{
            return redirect('/login')->with('message',"Login First, Then checkout");
        }
    }

   

    // ajax reauest
    public function userZila($id){
        $upazilas = DB::table('upazilas')->where('district_id', $id)->get();
        return response()->json($upazilas);
    }

    // usre product search 
    public function userProductSearch(Request $request){
        $shop = ShopInformation::where('shop_user_id', Auth::user()->id)->first();

        $products = Product::where('shop_id', $shop->id)->where(function ($query) use ($request){
            $query->orWhere("product_name","LIKE", "%". $request->search_string ."%");
            $query->orWhere('price', "LIKE", "%". $request->search_string ."%" );
            $query->orWhere('quintity', "LIKE", "%". $request->search_string ."%" );
        })->orderby('product_name','asc')->get();

        if( $products->count() >= 1 ){
            return view('user.product-table', compact('products'));
        }else{
            return response()->json([
                'status' => "nothing",
            ]);
        }
    }

    // Realtime search inside shop
    public function realTimeSearchByShop(Request $request, $id){
        $shop = ShopInformation::find($id);
        $relId = $shop->id;

        $products = Product::where('shop_id',  $relId )->where(function ($query) use ($request) {
            $query->where('product_name', "LIKE", "%" . $request->search_value . "%");
            $query->orWhere('price', "LIKE", "%" . $request->search_value . "%");
        })->orderby('product_name','asc')->get();
        
       
        if( $products->count() >= 1 ){
            return view('welcome.ecommerce.product-card', compact('products'));
        }else{
            return response()->json([
                'status' => "nothing",
            ]);
        }
        
    }
}
