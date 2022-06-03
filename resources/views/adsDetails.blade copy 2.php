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
    @include('layouts.submenu')

    <div class="row">
           <div class="col-md-2">
            <div class="">


                <div  style="padding-left: 2px ; margin-bottom:4px">
                 <div class="dropdown">
                     <button class="btn dropdown-toggle btn btn-secondary w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ $ad->cat->title }}
                     </button>
                     {{-- <a class="btn btn-secondary btn-block" href="">{{ $cat->title }}</a> --}}

                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                         <a class="dropdown-item" href="{{ route('catAds', $ad->category) }}">All {{ $ad->cat->title }}</a>

                         @foreach ( App\SubCategory::where('cat_id' , $ad->category )->get() as $s_cat )
                         <a class="dropdown-item" href="{{ route('homeCat2', $s_cat) }}">{{ $s_cat->title }}</a>

                         @endforeach

                     </div>
                   </div>
                </div>





            </div>
         </div>

        <div class="col-md-10">
            <div class="row d-flex justify-content-center">
                    <div class="col-md-12 text-center">
                            <img src="{{asset('storage/subject/file/'.$ad->image)}}" class="img-fluid" style="max-width: 350px;" alt="{{ $ad->image }}">
                            <div class="row">
                                {{-- {{ dd($ad->images)}} --}}


                                @foreach ($ad->images as $img)
                                {{-- {{ dd($img) }} --}}
                                    <div class="col-md-2">
                                        <img src="{{ asset('storage/subject/file/extra/'.$img->image) }}" class="img-fluid" style="height: 100px" alt="">
                                    </div>
                                @endforeach

                            </div>
                            <h3>{{ $ad->title }}</h3>
                            <h5>Added By: {{ $ad->addedBy->name }}</h5>
                            <h5>Price: <small>{{ $ad->price }} BDT</small>, Phone: <small>{{ $ad->phone }}</small></h5>
                            <h5>Loctaion: <small>     <td>{{ $ad->district!=null? $ad->pdistrict->name:"" }}, {{ $ad->thana!=null? $ad->pthana->name:"" }}</td>
                            </small></h5>
                    </div>

                    <div class="col-md-12">
                        <div class="container">
                            <p>Description: <br>{!! $ad->description !!}</p>
                        </div>
                    </div>


            </div>


        </div>
        {{-- <div class="col-md-2">
           @include('layouts.rightsidebar')
        </div> --}}
    </div>

</div>
@endsection
