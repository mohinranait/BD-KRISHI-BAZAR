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
                    <div style="padding-left: 2px ; margin-bottom:4px">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle btn btn-secondary w-100" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $ad->cat->title }}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('catAds', $ad->category) }}">All
                                    {{ $ad->cat->title }}</a>

                                @foreach (App\SubCategory::where('cat_id', $ad->category)->get() as $s_cat)
                                    <a class="dropdown-item"
                                        href="{{ route('homeCat2', $s_cat) }}">{{ $s_cat->title }}</a>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-10">

                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        <div class="container">

                            <div class="row d-flex justify-content-center">
                                <div class="col-md-6">
                                    <div class="w3-content" style="max-width:1200px;">
                                        <img class="mySlides" src="{{ asset('storage/subject/file/' . $ad->image) }}" style="height:220px" class="img-fluid">

                                        @foreach ($ad->images as $img)
                                        <img class="mySlides" src="{{ asset('storage/subject/file/extra/' . $img->image) }}"style="display:none;height:220px" class="img-fluid">
                                        @endforeach

                                        <div class="w3-row-padding w3-section">
                                          <div class="w3-col s4">
                                            <img class="demo w3-opacity w3-hover-opacity-off" src="{{ asset('storage/subject/file/' . $ad->image) }}" style="width:60%;cursor:pointer" onclick="currentDiv(1)">
                                          </div>
                                          @foreach ($ad->images as $img)
                                          <div class="w3-col s4">
                                            <img class="demo w3-opacity w3-hover-opacity-off" src="{{ asset('storage/subject/file/extra/' . $img->image) }}" style="width:60%;cursor:pointer" onclick="currentDiv(2)">
                                          </div>
                                          @endforeach

                                        </div>
                                      </div>
                                </div>
                            </div>

                            {{-- <div class="main_view">
                                <img src="{{ asset('storage/subject/file/' . $ad->image) }}" class="img-fluid text-center" id="main" alt="IMAGE">
                            </div>
                            <div class="side_view">
                                @foreach ($ad->images as $img)
                                    <img src="{{ asset('storage/subject/file/extra/' . $img->image) }}"
                                        onclick="change(this.src)">
                                @endforeach

                            </div> --}}
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <h3>{{ $ad->title }}</h3>
                        <h5>Added By: {{ $ad->addedBy->name }}</h5>
                        <h5>Price: <small>{{ $ad->price }} BDT</small>, Phone: <small>{{ $ad->phone }}</small></h5>
                        <h5>Loctaion: <small>
                                <td>{{ $ad->district != null ? $ad->pdistrict->name : '' }},
                                    {{ $ad->thana != null ? $ad->pthana->name : '' }}</td>
                            </small></h5>
                    </div>

                    <div class="col-md-12">
                        <div class="container">
                            <p>Description: <br>{!! $ad->description !!}</p>
                        </div>
                    </div>


                </div>


            </div>
        </div>

    </div>
@endsection
@push('js')
<script>
    function currentDiv(n) {
      showDivs(slideIndex = n);
    }

    function showDivs(n) {
      var i;
      var x = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("demo");
      if (n > x.length) {slideIndex = 1}
      if (n < 1) {slideIndex = x.length}
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
      }
      x[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " w3-opacity-off";
    }
    </script>

@endpush
