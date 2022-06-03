<!-- {{ $categorys->id }}

@foreach( App\UserAd::where('category' , $categorys->id)->get() as $out)
<p>{{ $out->title }}</p>
@endforeach -->



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

            @push('css')
            <style>
                li{
                    list-style: none;
                }
                .subCatLi{
                    background: #6c757d;
                    border-radius: 3px;
                    list-style: none;
                }
                .subCatLi:hover{
                    background: #5a6268;
                }
                .subCatLi a{
                    color: white;
                    font-size: 16px;
                    width: 100%;
                    display: inline-block;
                    padding: 8px;
                }
                .product-height{
                    height: 200px
                }
                .primCategory{
                    padding: 10px;
                    color: white;
                    border-radius: 4px;
                    margin-bottom: 5px;
                    font-weight: bold;
                }


                @media (max-width: 1500px) {


                }
            </style>

            @endpush


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
                        {{ $categorys->title }}
                    </button>
                    {{-- <a class="btn btn-secondary btn-block" href="">{{ $cat->title }}</a> --}}

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('catAds', $categorys->id) }}">All {{ $categorys->title }}</a>

                        @foreach ( App\SubCategory::where('cat_id' , $categorys->id )->get() as $s_cat )
                        <a class="dropdown-item" href="{{ route('homeCat2', $s_cat) }}">{{ $s_cat->title }}</a>

                        @endforeach

                    </div>
                  </div>
               </div>
           </div>
        </div>

        <div class="col-md-10">
            <div class="row">
            @if( App\UserAd::where('category' , $categorys->id)->count() > 0 )
                @foreach ( App\UserAd::where('category' , $categorys->id)->get() as $ad )
                <div class="col-md-4 col-6">
                    <div class="card product-height" style="" >
                        <div class="card-body text-center">
                            <a href="{{ route('adDetails', $ad) }}"><img src="{{asset('storage/subject/file/'.$ad->image)}}" class="img-fluid" style="max-height: 100px" alt="{{ $ad->image }}">
                            </a>
                            <h3><a href="{{ route('adDetails', $ad) }}" class="btn btn-info">{{Str::words($ad->title,2) }}</a></h3>
                        </div>
                    </div>

                 </div>
                @endforeach
            @else
            <div class="alert alert-info text-center text-light w-100">
                আপনার এই "<b >{{ $categorys->title }}</b>" ক্যাটাগরিতে কোন প্রডাক্টস পাওয়া যায় নাই।
            </div>
            @endif
            </div>

        </div>

    </div>

</div>
@endsection
