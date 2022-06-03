@extends('welcome.layouts.welcomeMaster')

@push('css')

@endpush
@php
    use Carbon\Carbon;
@endphp

@section('content')

@auth
@php

  $now = Carbon::now();
     $end_date = auth()->user()->expired_at;
     $cDate = Carbon::parse($end_date);
     $active_time = $now->diff($cDate );
     $me=auth()->user();
@endphp
@endauth



    <!-- 3 column start -->
    <!-- <div class="thumbnail">
                  <div class="image-wrapp">
                    <img src="{{ asset('sf/assets/img/dummies/work1.jpg') }}" alt="Portfolio name" title="" />
                    <article class="da-animate da-slideFromRight" style="display: block;">
                      <a class="link_post" href="portfolio-detail.html"><img src="assets/img/icons/link_post_icon.png" alt="" /></a>
                      <span><a class="zoom" data-pretty="prettyPhoto" href="assets/img/dummies/big1.jpg"><img src="{{ asset('sf/assets/img/icons/zoom_icon.png') }}" alt="Portfolio name" title="Portfolio name" /></a></span>
                    </article>
                  </div>
                  <div class="caption">
                    <h5>Portfolio name</h5>
                  </div>

                </div> -->



    <section id="maincontent">
        <div class="container">
            @guest
            <div class="container">
                <div class="row d-flex justify-content-center">

                    {{-- <div class="col-md-3 ws-side">
                        <div class="card">
                            <div class="card-body" style="min-height: 300px">
                                Left Sidebar
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-md-6">
                        <div class="card">
                            <div style="background-color: white; text-align: center; font-size: 20px;" class="card-header">{{ __('Login') }} (আপনার ইমেইল ও পাসওয়ার্ড দিয়ে লগিন করুন)</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- <div class="form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input form-control" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button style="font-size: 20px; text-align: center;" type="submit" class="btn btn-primary">
                                                {{ __('Login') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-md-3 ws-side">
                        <div class="card">
                            <div class="card-body" style="min-height: 300px">
                                Right Sidebar
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
           @else

            {{-- @if (Auth::user()->active) --}}
                <div class="row-fluid">
                    <!-- <div class="span4">

                  <div class="image-wrapp">
                    <img src="{{ asset('sf/assets/img/dummies/work1.jpg') }}" alt="Portfolio name" title="" />
                  </div>

                  <br>

                  {{-- @foreach ($auth->user()->userSubject as $subject) --}}


                    <div class="span4">
                  <div class="image-wrapp">
                    <img src="{{ asset('sf/assets/img/dummies/work1.jpg') }}" alt="Portfolio name" title="" />
                  </div>
                </div>


                    {{-- @endforeach --}}
                </div> -->


                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="w3-card">
                                    <div class="w3-card-body py-3 px-2">
                                        @if($me->active==true)
                                        Your are Active now
                                       @else
                                        Your are Inactive now
                                        @endif

                                        <h5>My Email: {{ auth()->user()->email }} <br>

                                            @if ($me->userPackage())
                                            Your Current Package:  {{$me->userPackage()->package_title}}     <br>
                                            Your Active time left: {{ $active_time->format('%Y years %m months %d days %H hours %i minutes %s seconds') }}  <a href="{{ url('/packeges')}}" class="btn btn-warning">Update your time</a>
                                            @elseif($me->pendingPackage())
                                            @foreach ($me->pendingPackage() as $payment)
                                            Package: {{ $payment->package_title }} <small>({{ $payment->status }})</small>

                                            @endforeach
                                            @else
                                            <h2>You have no permission to see any File <a href="{{ url('/packeges') }}" class="btn btn-success">Buy Package</a></h2>
                                            <h2>Please wait up to 1 hour maximum</h2>
                                            <h3>আপনি পেমেন্ট করার ১ঘন্টা পরেও ফাইল না পেয়ে থাকলে Contact করুন <a class="btn btn-primary" href="https://www.facebook.com/techheronfile">Contact here</a></h3>


                                        @endif
                                        @if($me->userPackage())
                                        @else
                                        Buy a new package for download the files <a href="{{ url('/packeges') }}" class="btn btn-success">Buy Now</a> <br>
                                        @endif
                                     </div>
                                </div>

                            </div>

                        </div>

                        {{-- @foreach ($subjects->chunk(2) as $subject2) --}}

                        {{-- @endforeach --}}





                </div>

            @endguest

        </div>



        <!-- 3 column end -->

    </section>

    @include('welcome.layouts.loginFooter')
@endsection


@push('js')

@endpush
