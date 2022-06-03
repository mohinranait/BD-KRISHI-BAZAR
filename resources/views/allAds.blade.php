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
                .product-height{
                    height: 200px
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
                @isset($category)
                <div class="dropdown pb-2">
                    <button class="btn dropdown-toggle btn btn-secondary w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       {{ $category->title }}
                    </button>
                    {{-- <a class="btn btn-secondary btn-block" href="">{{ $cat->title }}</a> --}}

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('catAds', $category->id) }}">All {{ $category->title }}</a>

                        @foreach ( App\SubCategory::where('cat_id' , $category->id )->get() as $s_cat )
                        <a class="dropdown-item" href="{{ route('homeCat2', $s_cat) }}">{{ $s_cat->title }}</a>

                        @endforeach

                    </div>
                  </div>

                  @else


                  <div class="dropdown pb-2">
                    <button class="btn dropdown-toggle btn btn-secondary w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       All Categories
                    </button>
                    {{-- <a class="btn btn-secondary btn-block" href="">{{ $cat->title }}</a> --}}

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                        @foreach ($p_cat as $category)
                        <a class="dropdown-item" href="{{ route('catAds', $category->id) }}">{{ $category->title }}</a>

                        @endforeach
                        @foreach ($cat as $category)
                        <a class="dropdown-item" href="{{ route('catAds', $category->id) }}">{{ $category->title }}</a>

                        @endforeach

                    </div>
                  </div>




                @endisset
                </div>





            </div>
        </div>

        <div class="col-md-10">
            <div class="row">
               @isset($p_ads)
               @foreach ($p_ads as $ad )
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

               @endisset
                @foreach ($ads as $ad )
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
            </div>
            {{ $ads->render() }}

        </div>

    </div>

</div>
@endsection
