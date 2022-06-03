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
    <div class="row">
        <div class="col-12 text-left">
            <h1>Account</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            @include('user.parts.leftsidebar')

        </div>
        <div class="col-md-9">

        </div>
    </div>
</div>




</div>
@endsection
