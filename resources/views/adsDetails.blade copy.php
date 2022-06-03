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

@push('css')
    <style type="text/css">
        /*Setting Basic Dimensions to give
        gallery view */
        .container {
            margin: 0 auto;
            width: 90%;
        }

        .main_view {
            width: 80%;
            height: 25rem;
        }

        .main_view img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .side_view {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .side_view img {
            width: 9rem;
            height: 7rem;
            object-fit: cover;
            cursor: pointer;
            margin: 0.5rem;
        }

    </style>
@endpush

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
                            {{-- <a class="btn btn-secondary btn-block" href="">{{ $cat->title }}</a> --}}

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
                    <div class="col-md-12 text-center">


                        <!-- Container for our gallery -->
                        <div class="container">
                            <!-- Main view of our gallery -->
                            <div class="main_view">
                                <img src="{{ asset('storage/subject/file/' . $ad->image) }}" id="main" alt="IMAGE">
                            </div>

                            <!-- All images with side view -->
                            <div class="side_view">
                                @foreach ($ad->images as $img)
                                <img src="{{ asset('storage/subject/file/extra/' . $img->image) }}" onclick="change(this.src)">
                                @endforeach
                            </div>
                        </div>


                        {{-- <img src="{{ asset('storage/subject/file/' . $ad->image) }}" class="img-fluid"
                            style="max-width: 350px;" alt="{{ $ad->image }}">
                        <div class="row">


                            @foreach ($ad->images as $img)
                                <div class="col-md-2">
                                    <img src="{{ asset('storage/subject/file/extra/' . $img->image) }}"
                                        class="img-fluid" style="height: 100px" alt="">
                                </div>
                            @endforeach

                        </div> --}}
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
            {{-- <div class="col-md-2">
           @include('layouts.rightsidebar')
        </div> --}}
        </div>

    </div>
@endsection
@push('js')
<script>

            const change = src => {
                document.getElementById('main').src = src
            }


@endpush
