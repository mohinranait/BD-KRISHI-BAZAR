@extends('welcome.layouts.welcomeMaster')

@push('css')

@endpush


@section('content')






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


            @if (Auth::user()->active)
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

                    <div class="span8">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="w3-card">
                                    <div class="w3-card-body py-3 px-2">
                                        <h5>My Email: {{ auth()->user()->email }} <br> My Subject:
                                            {{ auth()->user()->subject }}</h5>
                                    </div>
                                </div>

                            </div>

                        </div>

                        {{-- @foreach ($subjects->chunk(2) as $subject2) --}}
                        <div class="row">

                            @foreach (auth()->user()->userSubject as $subject)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <a href="{{ route('subjectClasses', $subject->subject_id) }}">
                                                <i class="fas fa-folder fa-9x text-warning"></i> <br>
                                            </a>

                                            <h5 style="margin-top: -10px;">{{ $subject->subject_id }} </h5>

                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        {{-- @endforeach --}}
                    </div>



                    <div class="span4">
                        <aside>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="w3-card">
                                            <div class="w3-card-body">
                                                <img src="{{ asset('img/r1.png') }}" alt=""
                                                    class="img-fluid">
                                            </div>
                                        </div>
                                        <hr>
                                    </div>

                                    <div class="col-md-12 ">
                                        <div class="w3-card">
                                            <div class="w3-card-body">
                                                <img src="{{ asset('img/details-hero.png') }}" alt=""
                                                    class="img-fluid">
                                            </div>
                                        </div>
                                        <hr>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="w3-card">
                                            <div class="w3-card-body">
                                                <img src="{{ asset('img/th1.jpg') }}" alt=""
                                                    class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </aside>
                    </div>
                </div>
            @else

                <h2>You have no permission to watch any File</h2>
                <h3>আপনি পেমেন্ট করে থাকলে Contact করুন</h3>
                <h3 style="color: blue;"><a href="https://www.facebook.com/messages/t/100666375829930">Contact here</a></h3>

            @endif

        </div>
        <!-- 3 column end -->

    </section>


@endsection


@push('js')

@endpush