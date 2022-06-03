<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Hash;
use Validator;
use Carbon\Carbon;
use App\Model\User;
use GuzzleHttp\Client;
use App\Mail\UserMail;
use App\Model\Product;
use App\Model\Company;
use App\Model\Category;
use App\Model\Demo;
use App\Model\UserSubject;
use App\Model\Subject;
use App\Model\MembershipPackage;
use Illuminate\Support\Facades\Mail;

use App\Model\Post;
use App\Model\PostClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Model\UserPayment;

use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Notification;
use App\Notification as Alert;
use App\Slider;
use App\SubCategory;
use App\UserAd;

use Image;

class AdminController extends Controller
{
    public function dashboard()
    {
        menuSubmenu('dashboard','dashboard');

        $userCount = User::count();

    	return  view('admin.dashboard',['userCount' =>$userCount]);
    }

    public function companiesAll()
    {
    	menuSubmenu('dashboard', 'companiesAll');

    	$companiesAll = Company::orderBy('title')->where('status', '<>', 'temp')->paginate(50);

    	return view('admin.companiesAll', ['companiesAll'=>$companiesAll]);
    }

    public function companyEdit(Company $company)
    {
    	return view('admin.companyEdit', ['company'=>$company]);
    }

    public function usersAll()
    {
    	menuSubmenu('dashboard', 'usersAll');

    	$usersAll = User::latest()->paginate(50);
        $membershipPackage=MembershipPackage::get();

    	return view('admin.usersAll', ['usersAll'=> $usersAll, 'packages' => $membershipPackage]);
    }

    public function companyOwnerAdd(Company $company, Request $request)
    {
    	$user = User::where('active', true)->where('id', $request->user)->first();

            if($user)
            {
                $company->user_id = $user->id;
                $company->save();

                if($request->ajax())
                {
                  return Response()->json([

                    'success' => true

                  ]);
                }
            }

            if($request->ajax())
            {
              return Response()->json([

                'success' => false

              ]);
            }

            return back();
    }

// learn with sajib
    public function newCatagoryCreate()
    {
    	menuSubmenu('dashboard','newCatagoryCreate');

    	return  view('admin.newCatagoryCreate');
    }

    public function newCatagoryCreatePost(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(),
        [
            'title' => ['required', 'string', 'max:255','min:3'],
            'image'=> ['required'],
            'active'=> ['nullable'],


        ]);


        $user = new Category;
        $user->title = $request->name;
        $user->active = $request->active ? true : false;

        if( $request->image ){

            $cashImage = $request->file('image');
            $imageName = time() . ".". $cashImage->getClientOriginalExtension();
            $location = public_path('img/category/' . $imageName);
            Image::make($cashImage)->resize(200 , 200)->save($location);
            $user->image = $imageName;
        }


        $user->addedby_id = Auth::id();

        $user->save();

        return back()->with('success', 'New Category successfully created');

    }

    public function newSubCatagoryCreate()
    {

        $categories=Category::all();
    	menuSubmenu('dashboard','newSubCatagoryCreate');

    	return  view('admin.newSubCatagoryCreate', compact('categories'));
    }

    public function newSubCatagoryCreatePost(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(),
        [
            'title' => ['required', 'string', 'max:255','min:3'],


        ]);

        $user = new SubCategory;
        $user->title = $request->name;
        $user->cat_id = $request->category;
        $user->save();

        return back()->with('success', 'New Sub-Category successfully created');

    }

    public function catagorydelete(Category $cat)
    {
        // dd($cat->id);
        Post::where('category_id', $cat->id)->update(['category_id' => null]);
        $cat->delete();
        return back()->with('success','Category successfully deleted');
    }

    public function subcatagorydelete(SubCategory $cat)
    {
        // dd($cat->id);
        // Post::where('category_id', $cat->id)->update(['category_id' => null]);
        $cat->delete();
        return back()->with('success','SubCategory successfully deleted');
    }

    public function classdelete(PostClass $class)
    {
        Post::where('class_id', $class->id)->update(['class_id' => null]);
        $class->delete();
        return back()->with('success','Class successfully deleted');
    }

    public function subjectdelete(Subject $subject)
    {
        Post::where('subject_id', $subject->id)->update(['subject_id'=> null]);
        $subject->delete();
        return back()->with('success','Class successfully deleted');
    }

    public function demoEdit(Demo $demo)
    {
        $subjects = Subject::all();

        return view('admin.demoEdit', [
            'subjects'=>$subjects,
            'demo'=> $demo]);

    }

    public function demoUpdate(Request $request, Demo $demo)
    {
         // dd($request->all());
         $validation = Validator::make($request->all(),
         [
             // 'name' => ['required', 'string', 'max:255','min:3'],


         ]);

        //  $demo = new Demo;
         // dd($class);

         $demo->name = $request->name;
         $demo->link = $request->link;
         $demo->category = $request->category;
         // $demo->addedby_id = Auth::id();
         $demo->save();

         if($request->hasFile('file'))
         {
             $file = $request->file('file');
             // dd($file)

             $extension = strtolower($file->getClientOriginalExtension());
             $randomFileName = $demo->id.'_file_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

             #delete old rows of profilepic
             Storage::disk('upload')->put('subject/file/'.$randomFileName, File::get($file));

             if($demo->img)
             {
                 $f = 'subject/file/'.$demo->img;
                 if(Storage::disk('upload')->exists($f))
                 {
                     Storage::disk('upload')->delete($f);
                 }
             }

             $demo->img = $randomFileName;
             $demo->save();
         }


         if($request->hasFile('demo_file'))
         {
             $file = $request->file('demo_file');
             // dd($file)

             $extension = strtolower($file->getClientOriginalExtension());
             $randomFileName = $demo->id.'_file_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

             #delete old rows of profilepic
             Storage::disk('upload')->put('subject/file/demo/'.$randomFileName, File::get($file));

             if($demo->img)
             {
                 $f = 'subject/file/demo/'.$demo->img;
                 if(Storage::disk('upload')->exists($f))
                 {
                     Storage::disk('upload')->delete($f);
                 }
             }

             $demo->demo_file = $randomFileName;
             $demo->save();
         }

        return back()->with('success','Demo successfully updated.');
    }

    public function demodelete(Demo $demo)
    {
        // dd($demo);
        // Post::where('subject_id', $subject->id)->update(['subject_id'=> null]);
        $demo->delete();
        return back()->with('success','Demo successfully deleted');
    }

    public function postdelete(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.postsAll')->with('success','Post successfully deleted');
    }

    // newClassCreatePost
    // public function usersAll()
    // {
    //     menuSubmenu('dashboard', 'usersAll');

    //     $usersAll = User::latest()->paginate(50);

    //     return view('admin.usersAll', ['usersAll'=> $usersAll]);
    // }

    public function catagoriesAll()
    {
        menuSubmenu('dashboard', 'catagoriesAll');

        $catagoriesAll = Category::latest()->paginate(50);

        return view('admin.catagoriesAll', ['catagoriesAll'=> $catagoriesAll]);
    }

    public function subcatagoriesAll()
    {
        menuSubmenu('dashboard', 'subcatagoriesAll');

        $catagoriesAll = SubCategory::latest()->paginate(50);

        return view('admin.subcatagoriesAll', ['catagoriesAll'=> $catagoriesAll]);
    }

    public function classesAll()
    {
        menuSubmenu('dashboard', 'classesAll');

        $classesAll = PostClass::latest()->paginate(50);

        return view('admin.classesAll', ['classesAll'=> $classesAll]);
    }

    public function subjectsAll()
    {
        menuSubmenu('dashboard', 'subjectsAll');

        $subjectsAll = Subject::latest()->paginate(50);

        return view('admin.subjectsAll', ['subjectsAll'=> $subjectsAll]);
    }

    public function demoAll()
    {
        menuSubmenu('dashboard', 'demoAll');

        $demoAll = Demo::latest()->paginate(50);

        return view('admin.demoAll', ['demoAll'=> $demoAll]);
    }

    public function postsAll()
    {
        menuSubmenu('dashboard', 'postsAll');

        $postsAll = Post::latest()->paginate(40);

        return view('admin.postsAll', ['postsAll'=> $postsAll]);
    }

    // postsAll

    public function newClassCreate()
    {
        menuSubmenu('dashboard','newClassCreate');

        return  view('admin.newClassCreate');
    }

    public function newClassCreatePost(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(),
        [
            'name' => ['required', 'string', 'max:255','min:3'],

        ]);

        $class = new PostClass;
        // dd($class);
        $class->title = $request->name;

        $class->addedby_id = Auth::id();

        $class->save();
        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            // dd($file)

            $extension = strtolower($file->getClientOriginalExtension());
            $randomFileName = $class->id.'_file_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            #delete old rows of profilepic
            Storage::disk('upload')->put('class/file/'.$randomFileName, File::get($file));

            if($class->feature_img_name)
            {
                $f = 'class/file/'.$class->feature_img_name;
                if(Storage::disk('upload')->exists($f))
                {
                    Storage::disk('upload')->delete($f);
                }
            }

            $class->feature_img_name = $randomFileName;
            $class->save();
        }


        return back()->with('success','Subject added Susscessfully');

    }

    public function newSubjectCreate()
    {
        menuSubmenu('dashboard','newSubjectCreate');

        return  view('admin.newSubjectCreate');
    }


    public function newDemoCreate()
    {
        menuSubmenu('dashboard','newDemoCreate');
        $subject=Subject::all();
        // dd($subject);

        return  view('admin.newDemoCreate', compact('subject'));
    }


    public function newSubjectCreatePost(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(),
        [
            'name' => ['required', 'string', 'max:255','min:3'],


        ]);

        $Subject = new Subject;
        // dd($class);

        $Subject->title = $request->name;
        $Subject->addedby_id = Auth::id();
        $Subject->save();

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            // dd($file)

            $extension = strtolower($file->getClientOriginalExtension());
            $randomFileName = $Subject->id.'_file_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            #delete old rows of profilepic
            Storage::disk('upload')->put('subject/file/'.$randomFileName, File::get($file));

            if($Subject->feature_img_name)
            {
                $f = 'subject/file/'.$Subject->feature_img_name;
                if(Storage::disk('upload')->exists($f))
                {
                    Storage::disk('upload')->delete($f);
                }
            }

            $Subject->feature_img_name = $randomFileName;
            $Subject->save();
        }
        return back()->with('success','Subject added Susscessfully');

    }




    public function newDemoCreatePost(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(),
        [
            // 'name' => ['required', 'string', 'max:255','min:3'],


        ]);

        $demo = new Demo;
        // dd($class);

        $demo->name = $request->name;
        $demo->link = $request->link;
        $demo->category = $request->category;
        // $demo->addedby_id = Auth::id();
        $demo->save();

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            // dd($file)

            $extension = strtolower($file->getClientOriginalExtension());
            $randomFileName = $demo->id.'_file_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            #delete old rows of profilepic
            Storage::disk('upload')->put('subject/file/'.$randomFileName, File::get($file));

            if($demo->imh)
            {
                $f = 'subject/file/'.$demo->img;
                if(Storage::disk('upload')->exists($f))
                {
                    Storage::disk('upload')->delete($f);
                }
            }

            $demo->img = $randomFileName;
            $demo->save();
        }


        if($request->hasFile('demo_file'))
        {
            $file = $request->file('demo_file');
            // dd($file)

            $extension = strtolower($file->getClientOriginalExtension());
            $randomFileName = $demo->id.'_file_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            #delete old rows of profilepic
            Storage::disk('upload')->put('subject/file/demo/'.$randomFileName, File::get($file));

            if($demo->imh)
            {
                $f = 'subject/file/demo/'.$demo->img;
                if(Storage::disk('upload')->exists($f))
                {
                    Storage::disk('upload')->delete($f);
                }
            }

            $demo->demo_file = $randomFileName;
            $demo->save();
        }


        return back()->with('success','Demo added Susscessfully');

    }
// post create
    public function newPostCreate()
    {
        menuSubmenu('dashboard','newPostCreate');

        $category=Category::all();
        $class=PostClass::all();
        $subject=Subject::all();

        $post = Post::where('publish_status', 'temp')->where('addedby_id', Auth::id())->latest()->first();
        if(!$post)
        {
            $post = new Post;
            $post->addedby_id = Auth::id();
            $post->save();
        }

        return  view('admin.newPostCreate',[
            'category' => $category,
            'class' => $class,
            'subject' => $subject,
            'post' =>$post
        ]);
    }

    public function newPostCreatePost(Request $request)
    {

        $validation = Validator::make($request->all(),
        [
            'title' => ['required', 'string', 'max:255','min:3'],

        ]);
        $post=new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->addedby_id = Auth::id();
        $post->author_name = $request->author_name;

        

        if($request->hasFile('feature_image'))
        {
            $file = $request->file('feature_image');
            $extension = strtolower($file->getClientOriginalExtension());
            $randomFileName = $post->id.'_file_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            #delete old rows of profilepic
            Storage::disk('upload')->put('post/file/feature/'.$randomFileName, File::get($file));
            $post->feature_image = $randomFileName;
        }

        // Author image code
        if($request->hasFile('author_image'))
        {
            $file = $request->file('author_image');
            $extension = strtolower($file->getClientOriginalExtension());
            $randomFileName = $post->id.'_file_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            #delete old rows of profilepic
            Storage::disk('upload')->put('post/file/feature/'.$randomFileName, File::get($file));
            $post->author_image = $randomFileName;
        }

        
        $post->save();

        return back()->with('success', 'New Post successfully created');

    }

    public function newUserCreate()
    {
        menuSubmenu('dashboard','newUserCreate');
        $membershipPackage=MembershipPackage::get();
        return  view('admin.newUserCreate', compact('membershipPackage'));
    }

    public function companyUpdate(Company $company, Request $request)
    {
    	$validation = Validator::make($request->all(),
        [
            'title' => ['required', 'string', 'max:255','min:3'],
            'description' => ['required', 'string', 'max:255'],
            'login_code' => ['required', 'string'],
            'login_password' => ['required','string'],
            'login_type' => ['required'],
            'mobile' => ['nullable'],
            'email' => ['nullable'],
            'address' => ['nullable'],
            'zip_code' => ['nullable'],
            'city' => ['nullable'],
            'status' => ['nullable'],
            'country' => ['required'],

        ]);

        if($validation->fails())
        {

            return back()
            ->withInput()
            ->withErrors($validation);
        }

$company->title = $request->title ?: $company->title;
$company->description = $request->description ?: null;
$company->login_code = $request->login_code ?: $company->login_code;
$company->login_password = $request->login_password ?: $company->login_password;
$company->login_type = $request->login_type ?: $company->login_type;
$company->mobile = $request->mobile ?: $company->mobile;
$company->email = $request->email ?: $company->email;
$company->address = $request->address ?: $company->address;
$company->zip_code = $request->zip_code ?: $company->zip_code;
$company->city = $request->city ?: $company->city;
$company->country = $request->country ?: $company->country;
$company->status = $request->status ? 'active' : 'inactive';
$company->editedby_id = Auth::id();




		if($request->hasFile('logo'))
        {
            $cp = $request->file('logo');
            $extension = strtolower($cp->getClientOriginalExtension());
            $randomFileName = $company->id.'_logo_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            #delete old rows of profilepic
            Storage::disk('upload')->put('company/logo/'.$randomFileName, File::get($cp));

            if($company->logo_name)
            {
                $f = 'company/logo/'.$company->logo_name;
                if(Storage::disk('upload')->exists($f))
                {
                    Storage::disk('upload')->delete($f);
                }
            }

            $company->logo_name = $randomFileName;
      	}

		$company->save();

        return redirect()->route('admin.companyEdit', $company)->with('success', 'Company successfully updated.');
    }

    public function companyAddNew(Request $request)
    {
    	menuSubmenu('dashboard','companyAddNew');
    	$company = Company::where('status', 'temp')->where('addedby_id', Auth::id())->latest()->first();
    	if(!$company)
    	{
    		$company = new Company;
    		$company->status = 'temp';
    		$company->addedby_id = Auth::id();
    		$company->save();
    	}

    	return view('admin.companyAddNew',['company'=>$company]);
    }

    public function newUserCreatePost(Request $request)
    {



    	$validation = Validator::make($request->all(),
        [
            // 'name' => ['required', 'string', 'max:255','min:3'],
            'email' => ['required', 'string','email', 'unique:users', 'max:255'],
            // 'mobile' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'active'=> ['nullable']

        ]);

        if($validation->fails())
        {

            return back()
            ->withInput()
            ->withErrors($validation);
        }


$package=null;

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->active = $request->active ? true : false;
        $user->mobile = $request->mobile;
        $user->addedby_id = Auth::id();

        if ($request->package!=null)
        {
            $package = MembershipPackage::where('id', $request->package)
        ->first();

        $user->package = $package->id;

        $expired_at = $user->expired_at;
        if ($expired_at > Carbon::now()) {

            $user->expired_at = Carbon::parse($expired_at)->addDays($package->package_duration);
        } else {
            $now = Carbon::now();
            $user->expired_at = Carbon::parse($now)->addDays($package->package_duration);
        }

        }
        $user->save();
        // foreach($request->subject as $subject)
        // {
        //     UserSubject::create([
        //         'user_id' => $user->id,
        //         'subject_id' => $subject,
        //     ]);
        // }



        // dd($package);

        if ($package!=null) {
            $payment = UserPayment::where('user_id', $user->id)
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

            $payment->status = 'paid';
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
            $payment->user_id = $user->id;
            $payment->addedby_id = Auth::id();
            $payment->save();
        }


       	return back()->with('success', 'New user successfully created');



    }
// learn edit
    public function userEdit(User $user)
    {
        $membershipPackage=MembershipPackage::get();
    	return view('admin.userEdit',['user'=>$user, 'membershipPackage' => $membershipPackage]);
    }

    public function userDelete(User $user)
    {
        // dd(1);
        $user->delete();
        return back()->with('success', "User Deleted Successfully");
    }

    public function classEdit(PostClass $class)
    {
        return view('admin.classEdit', ['class'=>$class]);
    }

    public function classUpdate(PostClass $class, Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            'name' => ['required', 'string', 'max:255','min:3'],

        ]);

        $class->title = $request->title ?: $class->title;
        $class->active = $request->active ? true : false;

        $class->editedby_id = Auth::id();
        // dd($subject);
        $class->save();

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            // dd($file)

            $extension = strtolower($file->getClientOriginalExtension());
            $randomFileName = $class->id.'_file_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            #delete old rows of profilepic
            Storage::disk('upload')->put('class/file/'.$randomFileName, File::get($file));

            if($class->feature_img_name)
            {
                $f = 'class/file/'.$class->feature_img_name;
                if(Storage::disk('upload')->exists($f))
                {
                    Storage::disk('upload')->delete($f);
                }
            }

            $class->feature_img_name = $randomFileName;

            $class->save();
        }



        return back()->with('success', 'class successfully Updated');

    }

    // learn post edit

    public function postEdit(Post $post)
    {
        $category=Category::all();
        $class=PostClass::all();
        $subject=Subject::all();

        return view('admin.postEdit', ['post'=>$post,'category' => $category,
            'class' => $class,
            'subject' => $subject]);
    }

    public function postUpdate( Request $request , $id)
    {

        $validation = Validator::make($request->all(),
        [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255','min:3']

        ]);

        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->editedby_id = Auth::id();
        $post->author_name = $request->author_name;

       
        if($request->hasFile('feature_image'))
        {

            if( File::exists('storage/post/file/feature/' . $post->feature_image) ){
                File::delete('storage/post/file/feature/' . $post->feature_image);
            }

            $file = $request->file('feature_image');
            // dd($file)
            $extension = strtolower($file->getClientOriginalExtension());
            $randomFileName = $post->id.'_file_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;
            #delete old rows of profilepic
            Storage::disk('upload')->put('post/file/feature/'.$randomFileName, File::get($file));
            $post->feature_image = $randomFileName;
           
        }

        // Author image upload
        if($request->hasFile('author_image'))
        {
            if( File::exists('storage/post/file/feature/' . $post->author_image) ){
                File::delete('storage/post/file/feature/' . $post->author_image);
            }

            $file = $request->file('author_image');
           
            // dd($file)
            $extension = strtolower($file->getClientOriginalExtension());
            $randomFileName = $post->id.'_file_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;
            #delete old rows of profilepic
            Storage::disk('upload')->put('post/file/feature/'.$randomFileName, File::get($file));
            $post->author_image = $randomFileName;
            
        }

        
        $post->save();
        return back()->with('success', 'Post Updated Successfully');

    }

    public function catagoryEdit(Category $catagory)
    {
        return view('admin.catagoryEdit', ['catagory'=>$catagory]);
    }

    public function catagoryUpdate(Request $request, $id)
    {
        
        $validation = Validator::make($request->all(),
        [
            'name' => ['required', 'string', 'max:255','min:3'],

        ]);

        $catagory = Category::find($id);
        $catagory->title = $request->title ?: $catagory->title;
        $catagory->active = $request->active ? true : false;



        if( $request->image ){

            if( File::exists('img/category/' . $catagory->image) ){
                File::delete('img/category/' . $catagory->image);
            }

            $cashImage = $request->file('image');
            $imageName = time() . ".". $cashImage->getClientOriginalExtension();
            $location = public_path('img/category/' . $imageName);
            Image::make($cashImage)->resize(200 , 200)->save($location);
            $catagory->image = $imageName;
        }


        $catagory->editedby_id = Auth::id();
        // dd($subject);
        $catagory->save();

        return back()->with('success', 'catagory successfully Updated');

    }

    public function subjectEdit(Subject $subject)
    {
        return view('admin.subjectEdit', ['subject'=>$subject]);
    }

    public function subjectUpdate(Subject $subject, Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(),
        [
            'name' => ['required', 'string', 'max:255','min:3'],

        ]);

        $subject->title = $request->title ?: $subject->title;
        $subject->active = $request->active ? true : false;

        $subject->editedby_id = Auth::id();
        // dd($subject);
        $subject->save();

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            // dd($file)

            $extension = strtolower($file->getClientOriginalExtension());
            $randomFileName = $subject->id.'_file_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            #delete old rows of profilepic
            Storage::disk('upload')->put('subject/file/'.$randomFileName, File::get($file));

            if($subject->feature_img_name)
            {
                $f = 'subject/file/'.$subject->feature_img_name;
                if(Storage::disk('upload')->exists($f))
                {
                    Storage::disk('upload')->delete($f);
                }
            }

            $subject->feature_img_name = $randomFileName;
            $subject->save();
        }

        return back()->with('success', 'User successfully Updated');

    }

    public function userUpdate(User $user, Request $request)
    {

    	$validation = Validator::make($request->all(),
        [
            // 'name' => ['required', 'string', 'max:255','min:3'],
            'email' => ['required', 'string','email', 'unique:users,email,'.$user->id, 'max:255'],
            // 'mobile' => ['required', 'string'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'active'=> ['nullable'],
            'subject' => ['nullable']

        ]);

        if($validation->fails())
        {

            return back()
            ->withInput()
            ->withErrors($validation);
        }

        $package=null;

        $user->name = $request->name ?: $user->name;
        $user->email = $request->email ?: $user->email;
        $user->mobile = $request->mobile ?: $user->mobile;
        // $user->subject = $request->subject ?: null;
        if ($request->package!=null)
        {
            $package = MembershipPackage::where('id', $request->package)
        ->first();

        $user->package = $package->id;

        $expired_at = $user->expired_at;
        if ($expired_at > Carbon::now()) {

            $user->expired_at = Carbon::parse($expired_at)->addDays($package->package_duration);
        } else {
            $now = Carbon::now();
            $user->expired_at = Carbon::parse($now)->addDays($package->package_duration);
        }

        }
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->active = $request->active ? true : false;

        $user->editedby_id = Auth::id();
        $user->save();

        if ($package!=null) {
            $payment = UserPayment::where('user_id', $user->id)
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

            $payment->status = 'paid';
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
            $payment->user_id = $user->id;
            $payment->addedby_id = Auth::id();
            $payment->save();
        }




       	return back()->with('success', 'User successfully Updated');

    }

    public function userCompanies(User $user)
    {
    	$companiesAll = $user->companies()->where('status', '<>', 'temp')->orderBy('title')->paginate(100);
    	return view('admin.userCompanies', ['user'=>$user, 'companiesAll' =>$companiesAll]);
    }

    public function companyProducts(Company $company)
    {
    	$url = "http://fdapp.18gps.net//GetDateServices.asmx/GetDate?method=getDeviceList&mds={$company->mds}";

        // dd($url);
        $client = new Client();

        try {
                $r = $client->request('GET', $url);
                $result = $r->getBody()->getContents();

                $arr = json_decode($result, true);

                $object = (object)$arr;

                // dd($object);

                // return $arr['balance'];

                // dd($arr['rows']);



            } catch (\GuzzleHttp\Exception\ConnectException $e) {
                // This is will catch all connection timeouts
                // Handle accordinly
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                // This will catch all 400 level errors.
                // return $e->getResponse()->getStatusCode();
            }

            if($object->success == 'true')
            {

    	       return view('admin.servicesAll',['company'=>$company, 'items' => $object->rows]);
            }
            else
            {

                $url = "http://fdapp.18gps.net//GetDataService.aspx?method=loginSystem&LoginName={$company->login_code}&LoginPassword={$company->login_password}&LoginType={$company->login_type}&language=en&ISMD5=0&timeZone=+06&apply=APP&loginUrl=";
                // dd($url);
                $client = new Client();

                try {
                    $r = $client->request('GET', $url);
                    $result = $r->getBody()->getContents();

                    $arr = json_decode($result, true);

                    // dd($arr);
                    // return $arr['balance'];

                    if($arr['success'] == 'true')
                    {
                        $company->school_id = $arr['id'];
                        $company->mds = $arr['mds'];
                        // $company->loggedin_at = Carbon::now();
                        $company->save();
                    }

                } catch (\GuzzleHttp\Exception\ConnectException $e) {
                    // This is will catch all connection timeouts
                    // Handle accordinly
                } catch (\GuzzleHttp\Exception\ClientException $e) {
                    // This will catch all 400 level errors.
                    // return $e->getResponse()->getStatusCode();
                }



                $url = "http://fdapp.18gps.net//GetDateServices.asmx/GetDate?method=getDeviceList&mds={$company->mds}";

                // dd($url);
                $client = new Client();

                try {
                        $r = $client->request('GET', $url);
                        $result = $r->getBody()->getContents();

                        $arr = json_decode($result, true);

                        $object = (object)$arr;

                        // dd($object);

                        // return $arr['balance'];

                        // dd($arr['rows']);



                    } catch (\GuzzleHttp\Exception\ConnectException $e) {
                        // This is will catch all connection timeouts
                        // Handle accordinly
                    } catch (\GuzzleHttp\Exception\ClientException $e) {
                        // This will catch all 400 level errors.
                        // return $e->getResponse()->getStatusCode();
                    }

                    if($object->success == 'true')
                    {

                       return view('admin.servicesAll',['company'=>$company, 'items' => $object->rows]);
                    }
                    else
                    {
                        return view('admin.servicesAll',['company'=>$company, 'items' => []]);
                    }

            }
    }


        public function productStatus(Company $company, Request $request)
    {


        $url = "http://fdapp.18gps.net//GetDateServices.asmx/GetDate?method=BMSrealTimeState&mds={$company->mds}&macid={$request->macid}&_r={time()}";
        // dd($url);
        $client = new Client();

        try {
                $r = $client->request('GET', $url);
                $result = $r->getBody()->getContents();

                $arr = json_decode($result, true);

                if($arr['success'] == 'true')
                {
                    $data = $arr['data'][0];
                    $state = json_decode($data['State'], true);



                }else
                {
                    if($request->ajax())
                    {

                      return Response()->json([
                        'view'=>View('admin.includes.modals.productStatusModalLg', [
                        'company' => null,
                        'state' => null,
                        'macid' => $request->macid,
                        'platenumber' => $request->platenumber
                        ])->render(),
                        'success' => false,
                      ]);
                    }

                }

            } catch (\GuzzleHttp\Exception\ConnectException $e) {
                // This is will catch all connection timeouts
                // Handle accordinly
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                // This will catch all 400 level errors.
                // return $e->getResponse()->getStatusCode();
            }

            if($request->ajax())
            {


              return Response()->json([
                'view'=>View('admin.includes.modals.productStatusModalLg', [
                'company' => $company,
                'state' => $state,
                'macid' => $request->macid,
                'platenumber' => $request->platenumber
                ])->render(),

                'success' => $arr['success'] == 'true' ? true : false,
              ]);
            }

            return back();


    }

    public function productSettings(Company $company, Request $request)
    {


        $url = "http://fdapp.18gps.net//GetDateServices.asmx/GetDate?method=BMSrealTimeState&mds={$company->mds}&macid={$request->macid}&_r={time()}";
        // dd($url);
        $client = new Client();

        try {
                $r = $client->request('GET', $url);
                $result = $r->getBody()->getContents();

                $arr = json_decode($result, true);

                if($arr['success'] == 'true')
                {
                    $data = $arr['data'][0];

                    $setting = json_decode($data['Seting'], true);


                }else
                {
                    if($request->ajax())
                    {

                      return Response()->json([
                        'view'=>View('admin.includes.modals.productSettingsModalLg', [
                        'company' => null,
                        'setting' => null,
                        'macid' => $request->macid,
                        'platenumber' => $request->platenumber
                        ])->render(),
                        'success' => false,
                      ]);
                    }

                }

            } catch (\GuzzleHttp\Exception\ConnectException $e) {
                // This is will catch all connection timeouts
                // Handle accordinly
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                // This will catch all 400 level errors.
                // return $e->getResponse()->getStatusCode();
            }

            if($request->ajax())
            {


              return Response()->json([
                'view'=>View('admin.includes.modals.productSettingsModalLg', [
                'company' => $company,
                'setting' => $setting,
                'macid' => $request->macid,
                'platenumber' => $request->platenumber
                ])->render(),

                'success' => $arr['success'] == 'true' ? true : false,
              ]);
            }

            return back();


    }

    public function productVersion(Company $company, Request $request)
    {


        $url = "http://fdapp.18gps.net//GetDateServices.asmx/GetDate?method=GetBmsSNInfo&mds={$company->mds}&Macid={$request->macid}&Key=BMS_Version&_r={time()}";
        $client = new Client();

        try {
                $r = $client->request('GET', $url);
                $result = $r->getBody()->getContents();

                $arr = json_decode($result, true);


                if($arr['success'] == 'true')
                {
                    $data = json_decode($arr['data'][0], true);
                }else
                {
                    if($request->ajax())
                    {

                      return Response()->json([
                        'view'=>View('admin.includes.modals.productVersionModalLg', [
                        'company' => null,
                        'data' => null,
                        'macid' => $request->macid,
                        'platenumber' => $request->platenumber
                        ])->render(),
                        'success' => false,
                      ]);
                    }

                }

            } catch (\GuzzleHttp\Exception\ConnectException $e) {
                // This is will catch all connection timeouts
                // Handle accordinly
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                // This will catch all 400 level errors.
                // return $e->getResponse()->getStatusCode();
            }

            if($request->ajax())
            {


              return Response()->json([
                'view'=>View('admin.includes.modals.productVersionModalLg', [
                'company' => $company,
                'data' => $data,
                'macid' => $request->macid,
                'platenumber' => $request->platenumber
                ])->render(),

                'success' => $arr['success'] == 'true' ? true : false,
              ]);
            }

            return back();
    }



    public function companyDetails(Company $company)
    {
    	$url = "http://fdapp.18gps.net//GetDateServices.asmx/GetDate?method=getDeviceList&mds={$company->mds}";

        // dd($url);
        $client = new Client();

        try {
                $r = $client->request('GET', $url);
                $result = $r->getBody()->getContents();

                $arr = json_decode($result, true);

                $object = (object)$arr;

                // dd($object);

                // return $arr['balance'];

                // dd($arr['rows']);



            } catch (\GuzzleHttp\Exception\ConnectException $e) {
                // This is will catch all connection timeouts
                // Handle accordinly
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                // This will catch all 400 level errors.
                // return $e->getResponse()->getStatusCode();
            }

            if($object->success == 'true')
            {

    	       return view('admin.companyDetails',['company'=>$company, 'items' => $object->rows]);
            }
            else
            {

                $url = "http://fdapp.18gps.net//GetDataService.aspx?method=loginSystem&LoginName={$company->login_code}&LoginPassword={$company->login_password}&LoginType={$company->login_type}&language=en&ISMD5=0&timeZone=+06&apply=APP&loginUrl=";
                // dd($url);
                $client = new Client();

                try {
                    $r = $client->request('GET', $url);
                    $result = $r->getBody()->getContents();

                    $arr = json_decode($result, true);

                    // dd($arr);
                    // return $arr['balance'];

                    if($arr['success'] == 'true')
                    {
                        $company->school_id = $arr['id'];
                        $company->mds = $arr['mds'];
                        // $company->loggedin_at = Carbon::now();
                        $company->save();
                    }

                } catch (\GuzzleHttp\Exception\ConnectException $e) {
                    // This is will catch all connection timeouts
                    // Handle accordinly
                } catch (\GuzzleHttp\Exception\ClientException $e) {
                    // This will catch all 400 level errors.
                    // return $e->getResponse()->getStatusCode();
                }



                $url = "http://fdapp.18gps.net//GetDateServices.asmx/GetDate?method=getDeviceList&mds={$company->mds}";

                // dd($url);
                $client = new Client();

                try {
                        $r = $client->request('GET', $url);
                        $result = $r->getBody()->getContents();

                        $arr = json_decode($result, true);

                        $object = (object)$arr;

                        // dd($object);

                        // return $arr['balance'];

                        // dd($arr['rows']);



                    } catch (\GuzzleHttp\Exception\ConnectException $e) {
                        // This is will catch all connection timeouts
                        // Handle accordinly
                    } catch (\GuzzleHttp\Exception\ClientException $e) {
                        // This will catch all 400 level errors.
                        // return $e->getResponse()->getStatusCode();
                    }

                    if($object->success == 'true')
                    {

                       return view('admin.companyDetails',['company'=>$company, 'items' => $object->rows]);
                    }
                    else
                    {
                        return view('admin.companyDetails',['company'=>$company, 'items' => []]);
                    }

            }
    }

    public function companyDelete(Company $company)
    {
    	if($company->logo_name)
        {
            $f = 'company/logo/'.$company->logo_name;
            if(Storage::disk('upload')->exists($f))
            {
                Storage::disk('upload')->delete($f);
            }
        }

        $company->delete();

        return back()->with('success', 'Company successfully deleted');


    }


    public function packageCreate()
    {
        menuSubmenu('dashboard','packageCreate');

        return view('admin.package.newPackage');


    }


    public function membershipPackageAddNewPost(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [

                'title' => 'required|unique:membership_packages,package_title',
                // 'description' => 'required',
                'price' => 'required',
                'duration' => 'required'

            ]
        );

        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput()
                ->with('error', 'Something Went Worng!');
        }

        $package = new MembershipPackage;
        $package->package_title = $request->title;
        $package->package_description = $request->description;
        $package->package_amount = $request->price;
        $package->package_duration = $request->duration;
        $package->save();

        Cache::forget('mPackage1');
        Cache::forget('mPackage2');


        return back()
            ->with('success', 'New Package Successfully Created.');
    }



    public function allMembershipPackages(Request $request)
    {
        menuSubmenu('dashboard','AllPackage');




        $packages = MembershipPackage::paginate(10);

        return view('admin.package.allPackages', [
            'packages' => $packages
        ]);
    }

    public function allPendingPayments(Request $request)
    {
        menuSubmenu('dashboard','allPendingPayments');

        $payments = UserPayment::where('status', 'pending')->latest()->paginate(100);
        $packages = MembershipPackage::all();
        return view('admin.allPendingPayments', [
            'payments' => $payments,
            'packages' => $packages
        ]);
    }




    public function pendingPaymentUpdatePost(Request $request, UserPayment $payment)
    {
        $validation = Validator::make(
            $request->all(),
            [
                "package" => "required",
                "paid_amount" => "required|numeric",
                "payment_method" => "required",
                "payment_details" => "required",
                // 'admin_comment' => 'required'
            ]
        );
        if ($validation->fails()) {
            return redirect()->back()
                ->withErrors($validation)
                ->withInput()
                ->with('error', 'Something went wrong, please try again.');
        }

        $package = MembershipPackage::where('id', $request->package)
            ->first();
        if ($package) {
            if ($payment) {
                $payment->status = 'paid';
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
                $payment->admin_comment = $request->admin_comment;
                $payment->editedby_id = Auth::id();
                $payment->save();

                $user = $payment->user;
                $user->package = $payment->membership_package_id;
                $expired_at = $user->expired_at;
                if ($expired_at > Carbon::now()) {

                    $user->expired_at = Carbon::parse($expired_at)->addDays($payment->package_duration);
                } else {
                    $now = Carbon::now();
                    $user->expired_at = Carbon::parse($now)->addDays($payment->package_duration);
                }

                $user->save();



                return back()->with('success', 'Payment info successfully updated.');
            }
        }
    }


    public function allNotifications()
    {
        menuSubmenu('dashboard','allNotifications');
        $notifications=Alert::orderBy('id', 'DESC')->get();
        return view('admin.notifications', compact('notifications'));
    }

    public function notificationPost(Request $request)
    {
        $randomFileName=null;
        if($request->hasFile('image'))
         {
             $file = $request->file('image');
            //  dd($file);

             $extension = strtolower($file->getClientOriginalExtension());
             $randomFileName = '_file_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

             #delete old rows of profilepic
             Storage::disk('upload')->put('notification/'.$randomFileName, File::get($file));

    }

    $notification=new Alert;
    $notification->image=$randomFileName;
    $notification->text=$request->text;
    $notification->save();
    return back()->with('success','Added Successfully');

    }

    public function NotificationDelete(Alert $notification)
    {
        $notification->delete();
        return back()->with('success', "Deleted Successfully");
    }


    public function mail1(User $user)
    {

            $details = [
                'name' => $user->name,
                'body_message' => "Demo text 1"
            ];
            Mail::to($user->email)->send(new UserMail($details));

            return back()->with('success','Mail successfully send');

    }


    public function mail2(User $user)
    {

            $details = [
                'name' => $user->name,
                'body_message' => "Demo text 2"
            ];
            Mail::to($user->email)->send(new UserMail($details));

            return back()->with('success','Mail successfully send');

    }


    public function mail3(User $user)
    {

            $details = [
                'name' => $user->name,
                'body_message' => "Demo text 3"
            ];
            Mail::to($user->email)->send(new UserMail($details));

            return back()->with('success','Mail successfully send');

    }

    public function allpendingUserAds()
    {
        $ads=UserAd::where('active', false)->get();
        // dd($ads);
        return view('admin.userAds', compact('ads'));

    }

    public function allapproveUserAds()
    {
        $p_ads=UserAd::where('position','!=', null)->where('active', true)->orderBy('position','ASC')->get();
        $ads=UserAd::where('position','=', null)->where('active', true)->latest()->get();
        $aprv=1;
        return view('admin.userAds', compact('ads','aprv','p_ads'));

    }

    public function approveEdit(UserAd $post)
    {
        $post->active=true;
        $post->save();
        return back()->with('success','Approved');

    }

    public function adsdelete(UserAd $post)
    {

        $post->delete();
        return back()->with('success','Deleted Successfully');

    }

    public function postPpPosition(UserAd $post, Request $request)
    {

        $post->position = $request->position;

        $post->save();
        return back()->with('success', "Priority Updated Successfully");
    }



    public function catPpPosition(Category $cat, Request $request)
    {

        // dd($cat);

        $cat->position = $request->position;

        $cat->save();
        return back()->with('success', "Priority Updated Successfully");
    }

    public function allsliders()
    {
        $sliders=Slider::latest()->get();
        return view('admin.allSliders', compact('sliders'));
    }

    public function sliderPost(Request $request)
    {

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
           //  dd($file);

            $extension = strtolower($file->getClientOriginalExtension());
            $randomFileName = '_file_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            #delete old rows of profilepic
            Storage::disk('upload')->put('slider/'.$randomFileName, File::get($file));

   }

   $slider=new Slider;
   $slider->file=$randomFileName;
   $slider->save();
   return back()->with('success','Added Successfully');

    }

    public function sliderdelete(Slider $slide)
    {
        $slide->delete();
        return back()->with('success','Deleted Successfully');

    }

    public function updateStatus(Slider $slide)
    {
        $slide->status=$slide->status? false:true;
        $slide->save();
        return back()->with('success','Updated Successfully');

    }


}
