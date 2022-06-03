<?php

namespace App\Http\Controllers\Welcome;

use Auth;
use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;
use App\Model\Demo;
use App\Model\Subject;
use App\Model\Post;
use App\Model\MembershipPackage;
use App\Model\Upazila;
use App\Slider;
use App\SubCategory;
use App\UserAd;
use App\Model\PostComment;

class WelcomeController extends Controller
{

    public function home1()
    {

        $blogs=Post::latest()->get();
        $petAds=UserAd::where('category',20)->where('active', true)->latest()->paginate(9);
        $agriAds=UserAd::where('category',21)->where('active', true)->latest()->paginate(9);
        $agriFoodAds =UserAd::where('category',22)->where('active', true)->latest()->paginate(9);
        $dairyProducts =UserAd::where('category',23)->where('active', true)->latest()->paginate(9);
        $aquaculturee =UserAd::where('category',24)->where('active', true)->latest()->paginate(9);
        $agricultureJobs =UserAd::where('category',25)->where('active', true)->latest()->paginate(9);
        $categorys = Category::where('active', true)->get();
        $sliders=Slider::where('status',true)->latest()->get();
        
        return view('welcome', compact('blogs', 'petAds','agriAds','agriFoodAds','agricultureJobs','aquaculturee','dairyProducts', 'categorys','sliders'));
    }

    public function homeCat(SubCategory $cat, $sl)
    {
       if($sl==3)
       {
        $petAds=UserAd::where('sub_category',$cat->id)->where('active', true)->latest()->paginate(9);
        $agriAds=UserAd::where('category',21)->where('active', true)->latest()->paginate(9);
        $agriFoodAds =UserAd::where('category',22)->where('active', true)->latest()->paginate(9);
       }
       elseif($sl==2)
       {
        $petAds=UserAd::where('category',20)->where('active', true)->latest()->paginate(9);
        $agriAds=UserAd::where('sub_category',$cat->id)->where('active', true)->latest()->paginate(9);
        $agriFoodAds =UserAd::where('category',22)->where('active', true)->latest()->paginate(9);
       }
       else
       {
        $petAds=UserAd::where('category',20)->where('active', true)->latest()->paginate(9);
        $agriAds=UserAd::where('category',21)->where('active', true)->latest()->paginate(9);
        $agriFoodAds =UserAd::where('sub_category',$cat->id)->where('active', true)->latest()->paginate(9);
       }
        $blogs=Post::latest()->get();

        return view('welcome', compact('blogs', 'petAds','agriAds','agriFoodAds'));
    }

    public function allAds()
    {
        $p_ads=UserAd::where('position','!=', null)->where('active', true)->orderBy('position','ASC')->get();
        $ads=UserAd::where('position', null)->where('active', true)->latest()->paginate(18);
        view()->share('categories', Category::orderBy('position','ASC')->get());


        return view('allAds', compact( 'ads','p_ads'));
    }

    // Primary Category wish product
    public function primaryCategoryWishProduct(  $id ){

        $categorys = Category::find($id);

        return view('primaryCatWishAds' , compact('categorys'));

    }

    public function addSearch(Request $request)
    {
        $ads=UserAd::where('active', true)->where('title','like', "%{$request->title}%")->latest()->paginate(18);

        return view('allAds', compact( 'ads'));
    }

    public function catAds(Category $cat)
    {

        $category=$cat;


        $ads=UserAd::where('category', $cat->id)->where('active', true)->latest()->paginate(18);
        return view('allAds', compact( 'ads','category'));
    }


    public function homeCat2(SubCategory $cat)
    {

        $category=Category::where('id',$cat->cat_id)->first();

        $ads=UserAd::where('sub_category',$cat->id)->where('active', true)->latest()->paginate(18);
        return view('allAds', compact( 'ads', 'category'));
    }
    public function welcome()
    {
    	if(Auth::check())
    	{
			return redirect()->route('home');

    	}

    	return view('welcome.welcome');
    }

    public function faq()
    {
    	return view('welcome.faq');
    }

    public function demoVideos()
    {
        return view('welcome.demoVideos');
    }


    public function demoPage(Subject $sub)
    {
        // dd($sub);
        $demos=Demo::where('category', $sub->title)->get();

        return view('welcome.demoPage', compact('demos'));
    }

    public function coursePage()
    {
        return view('welcome.coursePage');
    }

    public function javaPage()
    {
        return view('welcome.javaPage');
    }

    public function javaPost()
    {
        return view('welcome.javaPost');
    }

    public function ridoy()
    {
        return view('welcome.ridoy');
    }




    public function selenium()
    {
        return view('welcome.selenium');
    }

     public function contactPage()
    {
        return view('welcome.contactPage');
    }

     public function click()
    {
        return view('welcome.click');
    }

    public function getText()
    {
        return view('welcome.getText');
    }

    public function getAttribute()
    {
        return view('welcome.getAttribute');
    }


     public function type()
    {
        return view('welcome.type');
    }



    public function basicAuth()
    {
        return view('welcome.basicAuth');
    }

    //Java Page
     public function java_001()
    {
        return view('welcome.java_001');
    }

     public function java_002()
    {
        return view('welcome.java_002');
    }

     public function java_003()
    {
        return view('welcome.java_003');
    }

     public function java_004()
    {
        return view('welcome.java_004');
    }

     public function java_005()
    {
        return view('welcome.java_005');
    }

     public function java_006()
    {
        return view('welcome.java_006');
    }

     public function java_007()
    {
        return view('welcome.java_007');
    }

     public function java_008()
    {
        return view('welcome.java_008');
    }

     public function java_009()
    {
        return view('welcome.java_009');
    }

     public function java_010()
    {
        return view('welcome.java_010');
    }




    public function packages()
    {
        $packages = MembershipPackage::orderBy('package_amount', 'DESC')->get();

        return view('welcome.packages', compact('packages'));
    }

    public function postDetails(Post $post)
    {
        $post->increment('views');
        return view('postDetails', compact('post'));
    }

    public function blogs()
    {
        $blogs=Post::latest()->get();
        return view('welcome.blogs', compact('blogs'));
    }

    public function blogDetails( $id )
    {
        $blog = Post::find($id);
        $blog->increment('views');
        return view('welcome.blogDetails', compact('blog'));

    }


    function load_thanaFetch(Request $request)
    {
        // dd($request->all());
        // return 1;

        $data = Upazila::where('district_id', $request->value)->get();

        // return $data;
        //   $dd($data);

        if ($request->ajax()) {
            return Response()->json([
                'success' => true,
                'datas' => $data
            ]);
        }

        return back();
    }


    function subCatFetch(Request $request)
    {
        // dd($request->all());
        // return $request->value;

        $data = SubCategory::where('cat_id', $request->value)->get();

        // return $data;
        //   $dd($data);

        if ($request->ajax()) {
            return Response()->json([
                'success' => true,
                'datas' => $data
            ]);
        }

        return back();
    }

    public function adDetails(UserAd $ad)
    {
        return view('adsDetails', compact('ad'));
    }



    public function areaSearch(Request $request)
    {
        $ads=UserAd::where('thana', $request->thana)->latest()->paginate(18);

        return view('allAds', compact( 'ads'));

    }

    public function terms()
    {
        return view('terms');
    }



    // post Comment Store
    public function postCommentStore( Request $request ){

        if( Auth::check() ){
            $postComment = new Postcomment();

            $postComment->post_id = $request->post_id; 
            $postComment->user_id = $request->user_id; 
            $postComment->comment = $request->comment; 

            $postComment->save();
            return redirect()->back()->with("success" , "Your Comment Successfull");
        }else{
            return redirect()->back()->with("warning" , "Login First, then comment here");
        }

    }


}
