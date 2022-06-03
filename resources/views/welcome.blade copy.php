

@extends('welcome.layouts.welcomeMaster')

@section('content')

<div class="container">
  @include('layouts.submenu')
    <div class="row">
        <div class="col-md-11">
            <div class="row">
                <div class="col-md-4" >
                    <div class="container" style="border:1px solid gray">

                        <div class="row">
                            <div class="col-md-12 text-center">


                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Agri-food Product
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @foreach ($agriFoodCat as $cat )
                                        <a class="dropdown-item" href="#">{{ $cat->title }}</a>

                                        @endforeach

                                    </div>
                                  </div>


                            </div>
                        </div>
                        <div class="row">
                            @foreach ($agriFoodAds as $ad )
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="{{ route('adDetails', $ad) }}">  <img src="{{asset('storage/subject/file/'.$ad->image)}}" class="img-fluid" style="height: 60px; width:60px" alt="{{ $ad->image }}">
                                        </a>


                                    </div>
                                </div>
                            </div>
                            @endforeach


                        </div>
                    </div>


                </div>
                
                
                
                
                
                
                
                
                <div class="col-md-4" >
                    <div class="container" style="border:1px solid gray">

                        <div class="row">
                            <div class="col-md-12 text-center">


                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Agri-food Product
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @foreach ($agriFoodCat as $cat )
                                        <a class="dropdown-item" href="#">{{ $cat->title }}</a>

                                        @endforeach

                                    </div>
                                  </div>


                            </div>
                        </div>
                        <div class="row">
                            @foreach ($agriFoodAds as $ad )
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="{{ route('adDetails', $ad) }}">  <img src="{{asset('storage/subject/file/'.$ad->image)}}" class="img-fluid" style="height: 60px; width:60px" alt="{{ $ad->image }}">
                                        </a>


                                    </div>
                                </div>
                            </div>
                            @endforeach


                        </div>
                    </div>


                </div>
                
                
                
                
                
                
                
                
                
                
                

                <div class="col-md-4" >
                   <div class="container" style="border:1px solid gray">
                    <div class="row">
                        <div class="col-md-12 text-center">

                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Agriculture
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach ($agriCat as $cat )
                                    <a class="dropdown-item" href="{{ route('homeCat', [$cat, 2]) }}">{{ $cat->title }}</a>

                                    @endforeach
                                </div>
                              </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($agriAds as $ad )
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{ route('adDetails', $ad) }}" > <img src="{{asset('storage/subject/file/'.$ad->image)}}" class="img-fluid" style="height: 60px; width:60px" alt="{{ $ad->image }}">
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach


                    </div>
                   </div>


                </div>

                <div class="col-md-4" >
                   <div class="container" style="border:1px solid gray">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Pet And Animal
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach ($petCat as $cat )
                                    <a class="dropdown-item" href="{{ route('homeCat', [$cat, 3]) }}">{{ $cat->title }}</a>
                                    @endforeach
                                </div>
                              </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($petAds as $ad )
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{ route('adDetails', $ad) }}"> <img src="{{asset('storage/subject/file/'.$ad->image)}}" class="img-fluid" style="height: 60px; width:60px" alt="{{ $ad->image }}">
                                    </a>
                                 </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                   </div>


                </div>
            </div>

        </div>
        <div class="col-md-1 bg-primary">
          <a href="https://bdkrishibazar.com/blogs"><h5>BLOG</h5></a>
            
            <br> <hr>
            <h6>Agriculture Job</h6>
            <br> <hr>
            <a href="https://bdkrishibazar.com/term"><h6>Terms And Conditions</h6></a>
        </div>
    </div>

</div>
@endsection
