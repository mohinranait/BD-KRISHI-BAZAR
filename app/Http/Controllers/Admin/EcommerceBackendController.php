<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Model\User;
use App\Model\Upazila;
use App\Model\District;
use App\Model\Product;
use App\Model\ShopInformation;
use File;
use Image;
use DB;

class EcommerceBackendController extends Controller
{
    // All  Product page 
    public function productIndex()
    {
        $products = Product::orderby('id','desc')->get();
        return view("admin.ecommerce.product.manage" , compact('products'));
    }

    // Real time Product Search 
    public function realtimeProduct(Request $request){
        $products = Product::orWhere('product_name', "LIKE" , "%".$request->search_string."%")
                                    ->orWhere('price' , "LIKE" , "%".$request->search_string."%")
                                    ->orWhere('weight', "LIKE" , "%". $request->search_string."%")
                                    ->orderby('product_name','asc')->get();

        if( $products->count() >= 1){
            return view("admin.ecommerce.product.table" , compact('products'));
        }else{
            return response()->json([
                "status" => "nothing",
            ]);
        }
    }

    // Create a new Product    
    public function ProductCreate()
    {
        $adminShops = ShopInformation::orderby('shop_name','asc')->where('status',1)->where('admin_shop',1)->get();
        return view('admin.ecommerce.product.create',compact('adminShops'));
    }

   // Product store in database
    public function productStore(Request $request)
    {
        $this->validate($request,[
            'product_name'          =>'required',
            'shop_id'          =>'required',
            'price'                 =>'required',
            'weight'                =>'required',
            'product_image'         =>'required',
        ],[
            'product_name.required'         => 'Name is required',
            'price.required'                => 'The price is required',
            'weight.required'               => 'The Weight is required',
            'product_image.required'        => 'The Image is required',
            'shop_id.required'           => 'Shop required',
            
        ]);

        $products = new Product();
        $products->product_name         = $request->product_name;
        $products->slug                 = Str::slug($request->product_name);
        $products->price                = $request->price;
        $products->weight               = $request->weight;
        $products->quintity             = $request->quintity;
        $products->description          = $request->description;
        $products->meta_title           = $request->meta_title;
        $products->meta_description     = $request->meta_description;
        $products->meta_keyword         = $request->meta_keyword;
        $products->shop_id               = $request->shop_id;
        $products->status               = $request->status;

        if( $request->product_image ){
            $imgFind = $request->file("product_image");
            $imgName = time().'_'. $imgFind->getClientOriginalName();
            $location = public_path("img/product/" . $imgName);
            Image::make($imgFind)->save($location);
            $products->product_image = $imgName;

        }

        $products->save();
        return redirect()->back()->with('success', 'Create Successfull');

    }

   
    public function show($id)
    {
        //
    }

   // Product Edit
    public function productEdit($id)
    {
        $product = Product::find($id);
        if( !empty($product)){
            return view('admin.ecommerce.product.edit', compact('product'));
        }
    }

   // Product Update
    public function productUpdate(Request $request, $id)
    {
        
        $this->validate($request,[
            'product_name'          =>'required',
            'price'                 =>'required',
            'weight'                =>'required',
        ],[
            'product_name.required'         => 'Name is required',
            'price.required'                => 'The price is required',
            'weight.required'               => 'The Weight is required',
        ]);

        $products =  Product::find($id);
        $products->product_name         = $request->product_name;
        $products->slug                 = Str::slug($request->product_name);
        $products->price                = $request->price;
        $products->weight               = $request->weight;
        $products->quintity             = $request->quintity;
        $products->description          = $request->description;
        $products->meta_title           = $request->meta_title;
        $products->meta_description     = $request->meta_description;
        $products->meta_keyword         = $request->meta_keyword;
        $products->status               = $request->status;

        if( $request->product_image ){
            if( File::exists('img/product/' . $products->product_image)){
                File::delete('img/product/' . $products->product_image);
            }
            $imgFind = $request->file("product_image");
            $imgName = time().'_'. $imgFind->getClientOriginalName();
            $location = public_path("img/product/" . $imgName);
            Image::make($imgFind)->save($location);
            $products->product_image = $imgName;

        }

        $products->save();
        return redirect()->back()->with('success', 'Update Successfull');
    }

    // Product Delete
    public function productDelete($id)
    {
        $product = Product::find($id);
        if( $product){
            if( File::exists("img/product/" . $product->product_image)){
                File::delete("img/product/" . $product->product_image);
            }
            $product->delete();
        }

        return redirect()->back()->with("success" , "Delete Successfull");
    }



    // Shop Create 
    public function shopIndex(){
        $shopInformations = ShopInformation::all();
        return view('admin.ecommerce.shop.manage' , compact('shopInformations'));
    } 

    // Create a new Shop
    public function shopCreate(){
        $upzilas = Upazila::orderby('name','asc')->get();
        $districts = District::orderby('name','asc')->get();
        return view('admin.ecommerce.shop.create' , compact('upzilas','districts'));
    } 

    // Shop Store in database
    public function shopStore(Request $request){

        $this->validate($request,[
            'shop_name'         =>'required',
            'shop_email'        =>'required',
            'shop_phone'        =>'required',
            'shop_district_id'  =>'required',
            'shop_user_id'      =>'required',
            'shop_upzila_id'    =>'required',
            'shop_user_profile' =>'required',
            'shop_cover_photo'  =>'required',
            'shop_logo'         =>'required',
         ],[
            'shop_name.required'        => 'Shop Name is required',
            'shop_email.required'       => 'The email is required',
            'shop_phone.required'       => 'The phone is required',
            'shop_district_id.required' => 'The District is required',
            'shop_user_id.required'     => 'The user is required',
            'shop_upzila_id.required'   => 'The Upzila is required',
            'shop_user_profile.required'=> 'The user photo is required',
            'shop_cover_photo.required' => 'The Cover photo is required',
            'shop_logo.required'        => 'The shop logo is required',
        ]);
       
        $newShop = new ShopInformation();
        $newShop->shop_name         = $request->shop_name;
        $newShop->slug              = Str::slug($request->shop_name);
        $newShop->shop_email        = $request->shop_email;
        $newShop->shop_phone        = $request->shop_phone;
        $newShop->shop_district_id  = $request->shop_district_id;
        $newShop->shop_upzila_id    = $request->shop_upzila_id;
        $newShop->shop_user_id      = $request->shop_user_id;
        $newShop->status            = $request->status;
        $newShop->admin_shop        = $request->admin_shop;


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
        return redirect()->back()->with("message" , "Create Successfull");
        
    } 


    // Edit shop
    public function shopEdit( Request $request , $id){

        $shop = ShopInformation::find($id);
        if( $shop ){
            $users = User::orderby('name','asc')->get();
            $upzilas = Upazila::orderby('name','asc')->get();
            $districts = District::orderby('name','asc')->get();
            return view('admin.ecommerce.shop.edit' , compact('users','upzilas','districts','shop'));
        }else{
            return redirect()->back();
        }
        
    } 

    // Shop Update
    public function shopUpdate( Request $request , $id){

        $this->validate($request,[
            'shop_name'         =>'required',
            'shop_email'        =>'required',
            'shop_phone'        =>'required',
            'shop_district_id'  =>'required',
            'shop_user_id'      =>'required',
            'shop_upzila_id'    =>'required',
         ],[
            'shop_name.required'        => 'Shop Name is required',
            'shop_email.required'       => 'The email is required',
            'shop_phone.required'       => 'The phone is required',
            'shop_district_id.required' => 'The District is required',
            'shop_user_id.required'     => 'The user is required',
            'shop_upzila_id.required'   => 'The Upzila is required',
         ]);

         $newShop = ShopInformation::find($id);
         $newShop->shop_name         = $request->shop_name;
         $newShop->slug              = Str::slug($request->shop_name);
         $newShop->shop_email        = $request->shop_email;
         $newShop->shop_phone        = $request->shop_phone;
         $newShop->shop_district_id  = $request->shop_district_id;
         $newShop->shop_upzila_id    = $request->shop_upzila_id;
         $newShop->shop_user_id      = $request->shop_user_id;
         $newShop->status            = $request->status;
 

        if( $request->shop_user_profile ){
            if( File::exists("img/shop/" . $newShop->shop_user_profile)){
                File::delete("img/shop/" . $newShop->shop_user_profile);
            }
            $cashImage = $request->file('shop_user_profile');
            $imageName = time() . ".". $cashImage->getClientOriginalName();
            $location = public_path('img/shop/' . $imageName);
            Image::make($cashImage)->save($location);
            $newShop->shop_user_profile = $imageName;
        }
 
        if( $request->shop_cover_photo ){
            if( File::exists("img/shop/" . $newShop->shop_cover_photo)){
                File::delete("img/shop/" . $newShop->shop_cover_photo);
            }
            $cashImage = $request->file('shop_cover_photo');
            $imageName = time() . ".". $cashImage->getClientOriginalName();
            $location = public_path('img/shop/' . $imageName);
            Image::make($cashImage)->save($location);
            $newShop->shop_cover_photo = $imageName;
        }
 
        if( $request->shop_logo ){
            if( File::exists("img/shop/" . $newShop->shop_logo)){
                File::delete("img/shop/" . $newShop->shop_logo);
            }
            $cashImage = $request->file('shop_logo');
            $imageName = time() . ".". $cashImage->getClientOriginalName();
            $location = public_path('img/shop/' . $imageName);
            Image::make($cashImage)->resize(300,200)->save($location);
            $newShop->shop_logo = $imageName;
        }
 
         $newShop->save();
         return redirect()->back()->with("message" , "Update Successfull");
    } 

    public function shopDelete($id){
        $newShop = ShopInformation::find($id);
        if( $newShop){
            if( File::exists("img/shop/" . $newShop->shop_logo)){
                File::delete("img/shop/" . $newShop->shop_logo);
            }

            if( File::exists("img/shop/" . $newShop->shop_cover_photo)){
                File::delete("img/shop/" . $newShop->shop_cover_photo);
            }

            if( File::exists("img/shop/" . $newShop->shop_user_profile)){
                File::delete("img/shop/" . $newShop->shop_user_profile);
            }

            $newShop->delete();
        }

        return redirect()->back()->with("message" , "Delete Successfull");
    }

    // Realtime shop serch
    public function realShopSearch(Request $request){
        
        $shopInformations = ShopInformation::orWhere('shop_name' , 'LIKE' , '%'. $request->search_string .'%')
                                ->orWhere("shop_phone", 'LIKE', '%'.$request->search_string.'%')
                                ->orWhere("shop_email", 'LIKE', '%'.$request->search_string.'%')
                                ->orderby("shop_name",'asc')->paginate(5);

        if( $shopInformations->count() >= 1 ){
            return view('admin.ecommerce.shop.live-search' , compact('shopInformations'));
        }else{
            return response()->json([
                'status' => "nothing",
            ]);
        }
    }

    // dynamic dependency select box in zila / upzila
    public function upZila( $id){
        $upZila = DB::table('upazilas')->where('district_id', $id)->get();
        return response()->json($upZila);
    }
}
