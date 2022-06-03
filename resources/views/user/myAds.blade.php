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

    <div class="row">
        <div class="col-12 text-left">
            <h1>Account</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            @include('user.parts.leftsidebar')
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Price</th>
                          <th>IMG</th>
                          <th>Category</th>
                          <th>Sub Category</th>

                          <th>Status</th>
                          <th>Location</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($ads as $post)
                      <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->price }}</td>

                        <td>
                          @if($post->image)
                          <a href="{{asset('storage/subject/file/'.$post->image)}}" download><img src="{{asset('storage/subject/file/'.$post->image)}}" class="img-fluid" alt=""></a>
                          @endif
                        </td>
                        <td>{{ $post->cat->title }}</td>
                        <td>{{$post->subCat? $post->subCat->title:"" }}</td>
                        <td>{{ $post->active }}</td>
                        <td>{{ $post->district!=null? $post->pdistrict->name:"" }}, {{ $post->thana!=null? $post->pthana->name:"" }}</td>
                        <td>



                        <div class="btn-group btn-group-xs">


            <a class="btn btn-primary btn-xs" href="{{ route('admin.approveUpdate', $post) }}">Edit</a>
            <a class="btn btn-primary btn-xs" href="{{ route('admin.adsdelete', $post) }}" onclick="return confirm('Confirm?')">Delete</a>


          </div>


                        </td>

                      </tr>


                      @endforeach


                      </tbody>

                    </table>


                  </div>
            </div>
        </div>
    </div>
</div>





@endsection
