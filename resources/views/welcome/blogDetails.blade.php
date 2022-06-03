@php
use Carbon\Carbon;
@endphp
@auth
                @php

                    $now = Carbon::now();
                    $end_date = auth()->user()->expired_at;
                    $cDate = Carbon::parse($end_date);
                    $active_time = $now->diff($cDate);
                    $me = auth()->user();
                @endphp
            @endauth

            @php
                use App\Model\Post;
                $posts = Post::latest()->paginate(18);
                //    dd(auth()->user()->pendingPackage());
            @endphp


@extends('welcome.layouts.welcomeMaster')

@section('content')
<div class="container">
    <div class="row py-5 d-flex justify-content-center">
      <div class="col-md-4">
        <img src="{{ asset('storage/post/file/feature/'. $blog->feature_image) }}" class="img-fluid" alt="{{ $blog->feature_image }}">
    </div>


    </div>
    <div class="row">
        <div class="col-12">
            <p>{!! $blog->description !!}</p>
        </div>
    </div>
    <hr>
    <div class="row my-4">
        
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="d-flex ">
                <div style="margin-right:20px">
                    <strong>Author</strong> : {{ $blog->author_name}}
                    <p style="font-size:13px"> <i class="fas fa-calendar"></i> {{ $blog->created_at->format('M d Y')}}</p>
                </div>
                <div>
                    <i class="fas fa-eye"></i> {{ $blog->views }} Views
                </div>
            </div>
           
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="d-flex  flex-wrap justify-content-end">
                <p>
                    <a href="#" target="_blank" class="share-social-icon" id="facebook-share">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </a>
                </p>
                
                <p>
                    <a href="#" target="_blank" class="share-social-icon" id="twitter-share">
                        <i class="fab fa-twitter"></i> Twitter
                    </a>
                </p>
                
                <p>
                    <a href="#" target="_blank" class="share-social-icon" id="google-share">
                        <i class="fab fa-google-plus-g"></i> Google+
                    </a>
                </p>
                
                <p>
                    <a href="#" target="_blank" class="share-social-icon" id="linkedin-share">
                        <i class="fab fa-linkedin"></i> Linkedin
                    </a>
                </p>
                
            </div>
        </div>
    </div>

    @if (\Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p style="margin-bottom:0px"> {!! \Session::get('success') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </p>
            
        </div>
    @endif
    @if (\Session::has('warning'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p style="margin-bottom:0px"> <strong>Please!</strong> {!! \Session::get('warning') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </p>
            
        </div>
    @endif
    <!-- Post reviews -->
    <div class="row">
        <div class="col-lg-10">

            <div class="card " >
                
                <div class="card-header " >
                    Leave a Comment

                    <div class="mt-2">
                        <form action="{{ route('postCommentStore')}}" method="POST">
                            @csrf 
                            <div class="form-group">
                                <textarea name="comment" class="form-control" id="" cols="30" rows="3" placeholder="Comment..." maxlength="160" minlength="10"></textarea>
                            </div>
                            <div class="form-group ">
                                <input type="hidden" name="post_id" value="{{ $blog->id }}">
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </form>
                    </div>

                    
                </div>


                
                
            </div>

        </div>
    </div>

    <!-- Comment display -->
    <div class="row">
        <div class="col-lg-10">

            <div class="card " >
                <div class="card-header " >
                    Reviews ({{ App\Model\PostComment::where('status', 1)->where('post_id' , $blog->id)->count() }})
                    <div class="mt-2">
                        @foreach( App\Model\PostComment::orderby('created_at','DESC')->where('status', 1)->where('post_id' , $blog->id)->get() as $item)
                        <div class="reviews-display">
                            <div class="row">
                                <div class="col-lg-2">
                                    <h4 class="review-user-name">{{$item->userInfo->name}}</h4>
                                </div>
                                <div class="col-lg-10">
                                    <div class="review-user-time">
                                        <i class="fas fa-clock"></i>
                                        <span>{{ $item->created_at->diffForHumans()}} </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">
                                    <!-- empty -->
                                </div>
                                <div class="col-lg-10">
                                    <div class="review-user-decription">
                                        <p>{{ $item->comment}}</p>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin:4px">
                        </div>
                        @endforeach
                        
                    </div>
                </div>
                
            </div>


        </div>
    </div>

    
</div>
@endsection


@push('js')
<script>

    const facebookBtn = document.getElementById("facebook-share");
    const googleBtn = document.getElementById("google-share");
    const twitterBtn = document.getElementById("twitter-share");
    const linkedinBtn = document.getElementById("linkedin-share");

    let postUrl = encodeURI(document.location.href);
    let postTitle = encodeURI("{{ $blog->title }}");
    let postTag = encodeURI("{{ $blog->author_name }}");
    let postImage = encodeURI("{{ $blog->feature_image }}");
    

    facebookBtn.setAttribute("href" , 'https://www.facebook.com/sharer.php?u='+ postUrl);
    linkedinBtn.setAttribute("href" , 'https://www.linkedin.com/shareArticle?url='+postUrl+'&title='+postTitle);
    twitterBtn.setAttribute("href" , 'https://twitter.com/share?url='+postUrl+'&text='+postTitle+'&hashtags='+postTag);
    googleBtn.setAttribute("href" , 'https://plus.google.com/share?url='+postUrl);



    



</script>
@endpush
