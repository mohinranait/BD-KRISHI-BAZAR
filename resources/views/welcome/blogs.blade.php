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
    <div class="row py-5">
       @foreach ($blogs as $blog )
       <div class="col-md-3">
           <div class="card">
               <div class="card-body text-center">
                   <a href="{{ route('blogDetails', $blog->id) }}"><img src="{{ asset('storage/post/file/feature/'. $blog->feature_image) }}" class="img-fluid" alt="{{ $blog->feature_image }}">
                   </a>
                   <a href="{{ route('blogDetails', $blog->id) }}" class="btn btn-info my-2">{{ $blog->title }}</a>
               </div>
           </div>

        </div>
       @endforeach
    </div>
</div>
@endsection
