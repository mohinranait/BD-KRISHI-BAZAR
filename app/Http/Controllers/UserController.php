<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\MembershipPackage;
use App\Model\UserPayment;
use App\ProductImage;
use App\SubCategory;
use App\UserAd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    //

    public function files()
    {
    	return view('userFiles');
    }


    public function payNow()
    {
        $user = auth()->user();

        $packages = MembershipPackage::all();
        return view('user.payNow', compact('packages'));
    }



    public function payNowPost(Request $request)
    {
        $user = auth()->user();



        $package = MembershipPackage::where('id', $request->package)
            ->first();
        // dd($package);

        if ($package) {
            $payment = UserPayment::where('user_id', Auth::id())
                ->where('status', 'pending')->first();
            if ($payment) {

                // if($request->ajax())
                // {
                //     return Response()->json(array(
                //         'success' => false,
                //         'sessionMessage' => 'Your previous payment order is pending',
                //     ));
                // }

                // return back()
                // ->with('info', 'Your previous payment order is pending');


            } else {
                $payment = new UserPayment;
            }

            $payment->status = 'pending';
            $payment->membership_package_id = $package->id;
            $payment->package_title = $package->package_title;
            $payment->package_description = $package->package_description;
            $payment->package_amount = $package->package_amount;
            $payment->package_currency = $package->package_currency;
            $payment->package_duration = $package->package_duration;
            $payment->paid_amount = $request->paid_amount;
            $payment->paid_currency = $request->paid_currency;
            $payment->payment_method = $request->payment_method;
            $payment->payment_details = $request->payment_details;
            $payment->admin_comment = null;
            $payment->user_id = Auth::id();
            $payment->addedby_id = Auth::id();
            $payment->save();

            if ($request->payment_process == 'online') {


                $request->session()->forget(['amount', 'wmx_token']);
                $request->session()->put(['wmx_token' => 'hello', 'amount' => $payment->package_amount]);

                return redirect()->route('user.paytoPaymentGateway', $payment);
            } else {
                // if (env('APP_ENV') != 'local') {
                //     Mail::send('emails.newPendingPayment', ['payment' => $payment], function ($message) {
                //         $message->from('info@matchinglifebd.com', 'Matching Life Payment Section');
                //         $message->to('info@matchinglifebd.com',  '')
                //             ->subject('New Payment Order is submitted at ' . url('/'));
                //     });
                // }


            }
        }

        return back()->with('success', "Your Payment Submitted Successfully");
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function userAds()
    {
        $category=Category::all();
        $subcategory=SubCategory::all();
        return view('userAds', compact('category', 'subcategory'));
    }

    public function adsPost(Request $request)
    {


        $userAds=new UserAd;

        $userAds->title = $request->title;
        $userAds->description = $request->description;
        $userAds->price = $request->price;
        $userAds->phone = $request->phone;
        $userAds->category = $request->category;
        $userAds->sub_category = $request->sub_category;
        $userAds->district = $request->district;
        $userAds->thana = $request->thana;
        $userAds->addedby_id = Auth::id();
        $userAds->active = false;

        $userAds->save();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            // dd($file)

            $extension = strtolower($file->getClientOriginalExtension());
            $randomFileName = $userAds->id.'_file'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            #delete old rows of profilepic
            Storage::disk('upload')->put('subject/file/'.$randomFileName, File::get($file));

            if($userAds->image)
            {
                $f = 'subject/file/'.$userAds->image;
                if(Storage::disk('upload')->exists($f))
                {
                    Storage::disk('upload')->delete($f);
                }
            }

            $userAds->image = $randomFileName;

        }

        $userAds->save();

        if($request->addmore2!=null)
       {
        foreach($request->addmore2 as $key => $value)
        {
            $file = $request->addmore2[$key];
            // dd($file);


            if ($file) {

                $extension = strtolower($file->getClientOriginalExtension());

                $randomFileName = $userAds->id.'_file'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

                Storage::disk('upload')->put('subject/file/extra/'.$randomFileName, File::get($file));


                    $doc = new ProductImage();
                    $doc->product_id =  $userAds->id;

                    $doc->image = $randomFileName;

                    $doc->save();
                    //Document::create($value);

            }
        }
        }


        return redirect()->route('userAdsPost',$userAds)->with('success',"Ads Added Successfully");


    }


    public function userAdsPost(UserAd $userAds)
    {
        return view('user.adCatSelect', compact('userAds'));
    }


    public function myAds()
    {
        $ads=UserAd::where('addedby_id', Auth::id())->get();
        return view('user.myAds', compact('ads'));

    }

    public function myPost()
    {
            $myAds=UserAd::where('addedby_id', auth()->user()->id)->latest()->get();
            return view('myAds', compact('myAds'));
    }

    public function approveUpdate(UserAd $post)
    {
        $category=Category::all();
        $subcategory=SubCategory::all();
        return view('editPost', compact('post','category','subcategory'));
    }

    public function updatPost(UserAd $post, Request $request)
    {


        if(!$post)
        {
            dd(1);
        }


        $post->title = $request->title;
        $post->description = $request->description;
        $post->price = $request->price;
        $post->phone = $request->phone;
        $post->category = $request->category;
        $post->sub_category = $request->sub_category;
        $post->district = $request->district;
        $post->thana = $request->thana;
        $post->addedby_id = Auth::id();
        $post->active = false;

        $post->save();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            // dd($file)

            $extension = strtolower($file->getClientOriginalExtension());
            $randomFileName = $post->id.'_file'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            #delete old rows of profilepic
            Storage::disk('upload')->put('subject/file/'.$randomFileName, File::get($file));

            if($post->image)
            {
                $f = 'subject/file/'.$post->image;
                if(Storage::disk('upload')->exists($f))
                {
                    Storage::disk('upload')->delete($f);
                }
            }

            $post->image = $randomFileName;

        }

        $post->save();

        if($request->addmore2!=null)
       {
        foreach($request->addmore2 as $key => $value)
        {
            $file = $request->addmore2[$key];
            // dd($file);


            if ($file) {

                $extension = strtolower($file->getClientOriginalExtension());

                $randomFileName = $post->id.'_file'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

                Storage::disk('upload')->put('subject/file/extra/'.$randomFileName, File::get($file));


                    $doc = new ProductImage();
                    $doc->product_id =  $post->id;

                    $doc->image = $randomFileName;

                    $doc->save();
                    //Document::create($value);

            }
        }
        }
       return back()->with('success','successfully Updated.');

    }

    public function imgDelete(ProductImage $img)
    {
        $img->delete();
        return back()->with('success',"Deleted Succwssfully");

    }


    public function adsCatPay($id, $title)
    {
        $ads=UserAd::find($id);
        return view('user.pay', compact('ads','title'));
    }

    public function adsPay(Request $request,$ads,$title)
    {
        $adsp=UserAd::find($ads);
        $adsp->paid_for=$title;
        $adsp->payment_status=false;
        $adsp->payment_method=$request->payment_method;
        $adsp->payment_amount=$request->payment_amount;
        $adsp->trn_no=$request->trn_no;
        $adsp->save();


    }
}
