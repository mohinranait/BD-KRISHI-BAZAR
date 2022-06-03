<?php

namespace App\Http\Controllers;

use Auth;
use App\Model\User;
use App\Model\Post;
use App\Model\Subject;
use App\Model\Category;
use App\Model\PostCategory;
use App\Model\PostClass;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $posts = Post::where('publish_status', 'published')->latest()->paginate(12);
        $popularPosts = Post::where('publish_status', 'published')->orderBy('read','desc')->paginate(8);
        // $class = PostClass:: all();
        $subjects = Subject::has('posts')->orderBy('title')->paginate(6);
        
        return view('home',['subjects'=>$subjects, 'popularPosts'=>$popularPosts,

    ]);
    }

    public function subjectClasses($subject_id)
    {
        // dd($subject_id);

        $subject=Subject::where('title', $subject_id)->first();
        
        $popularPosts = Post::where('publish_status', 'published')->orderBy('read','desc')->paginate(8);
        $posts = Post::where('subject_id', $subject->id)->where('class_id','<>',null)->groupBy('class_id')->get();
        
        $withoutClassPosts = Post::where('subject_id', $subject->id)->where('class_id',null)->get();
        // dd($withoutClassPosts);
        // dd($posts);
        


        // $classes = PostClass::whereHas('posts', function($q) use ($postIds){
        //     $q->whereIn('id', $postIds);
        // })
        // ->orderBy('title')
        // ->paginate(12);

        return view('subjectClasses',[
            'posts'=>$posts,
            'subject'=>$subject,
            'popularPosts'=>$popularPosts,
            'withoutClassPosts' => $withoutClassPosts
    ]);
    }


    public function subjectClasses2(PostClass $class)
    {
        // dd($class);

        // $subject=Subject::where('title', $subject_id)->first();

        $popularPosts = Post::where('publish_status', 'published')->orderBy('read','desc')->paginate(8);
        $posts = Post::where('class_id', $class->id)->where('category_id','<>',null)->groupBy('category_id')->get();

        $withoutCategoryPosts = Post::where('class_id', $class->id)->where('category_id',null)->get();
        
        // dd($postIds);


        // $classes = PostClass::whereHas('posts', function($q) use ($postIds){
        //     $q->whereIn('id', $postIds);
        // })
        // ->orderBy('title')
        // ->paginate(12);

        return view('subjectClasses2',[
            'posts'=>$posts,
            // 'subject'=>$subject,
            'popularPosts'=>$popularPosts,
            'withoutCategoryPosts'=>$withoutCategoryPosts

    ]);
    }


    public function subjectClasses3(Category $category)
    {
        // dd($category);

        // $subject=Subject::where('title', $subject_id)->first();

        $popularPosts = Post::where('publish_status', 'published')->orderBy('read','desc')->paginate(8);
        $posts = Post::where('category_id', $category->id)
        ->get();

        // dd($postIds);


        // $classes = PostClass::whereHas('posts', function($q) use ($postIds){
        //     $q->whereIn('id', $postIds);
        // })
        // ->orderBy('title')
        // ->paginate(12);

        return view('subjectClasses3',[
            'posts'=>$posts,
            // 'subject'=>$subject,
            'popularPosts'=>$popularPosts,

    ]);
    }

    public function classPosts(Subject $subject,PostClass $class)
    {
        $posts = Post::where('class_id', $class->id)
        ->where('subject_id',$subject->id)
        ->where('publish_status', 'published')
        ->orderBy('category_id')
        ->simplePaginate(12);

        $categories = Category::whereHas('posts', function($q) use ($subject,$class) {
                $q->where('subject_id', $subject->id);
                $q->where('class_id', $class->id);
            })
            ->orderBy('title')
            ->where('active', true)
            ->paginate(100);



        return view('classPosts', ['posts'=>$posts, 'class'=>$class,'subject'=>$subject, 'categories'=>$categories]);
    }



    public function watch(Post $post)
    {
        // dd($post);
        if($post->publish_status == 'published')
        {
            $post->increment('read');
            $posts = Post::with('category')->get();
            // dd($post->category_id);
            // $relatedPosts = Post::where('publish_status', 'published')
            // ->where('subject_id', $post->subject_id)
            // ->where('class_id', $post->class_id)
            // // ->where('subject_id', $post->subject_id)
            // ->where('id','<>',$post->id)
            // ->paginate(8);

            $categories = Category::whereHas('posts', function($q) use ($post) {
                $q->where('subject_id', $post->subject_id);
                $q->where('class_id', $post->class_id);
            })
            ->orderBy('title')
            ->where('active', true)
            ->paginate(100);



            return view('welcome.watch',['post'=>$post,'categories'=>$categories]);
        }
        else
        {
            abort(403);
        }

    }

    public function selectUser(Request $request)
    {
        $q = $request->q;
        $users = User::where(function($query) use ($q){

            $query->where('email', 'like', '%'.$q.'%');
            // $query->orWhere('mobile', 'like', '%'.$q.'%');

        })
        ->where('active', true)


        // ->orWhere('username', 'like', '%'.$request->q.'%')
        // ->orWhere('name', 'like', '%'.$request->q.'%')
        // ->orWhere('mobile', 'like', '%'.$request->q.'%')
        ->select(['id','email'])->take(30)->get();
        if($users->count())
        {
            if ($request->ajax())
            {
                // return Response()->json(['items'=>$users]);
                return $users;
            }
        }
        else
        {
            if ($request->ajax())
            {
                return $users;
            }
        }
    }


}
