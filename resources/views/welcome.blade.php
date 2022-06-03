

@extends('welcome.layouts.welcomeMaster')
@push('css')
<style>
    .banner-content {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-top: 0px !important;
}
</style>

@endpush

@section('content')

    <section class="banner-section">
        <div>
            <div class="container">
                <div>
                    <div class="row">
                        <div class="col-lg-3">

                        </div>
                        <br>
                        <div class="col-lg-6 w3-border">
                            <div class="banner-content">
                                <!--<h1 class="banner-title">BD Krishi Bazar</h1>-->
                                <!--<h2 class="banner-sub-title">Natural and Fresh alows</h2>-->
                                <p style="padding: 5px;" class="banner-paragrap"> কৃষি খাদ্য, কৃষি পণ্য ও গৃহপালিত পশু-পাখি কেনা-বেচার অনলাইন হাট।</p>
                            </div>
                        </div>
                        <div class="col-lg-3">

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>


<div class="container">
  @include('layouts.submenu')
    <div class="row">
        <div class="col-md-12">
            <div class="row">


                @foreach( $categorys as $category)
                <div class="col-lg-2 col-md-2 col-sm-4 col-6 mb-4">
                    <a href="{{route('primaryCategoryWishProduct' , $category->id)}}" class="text-dark">
                        <div style=" text-align:center">
                            <img src="{{asset('img/category/' .  $category->image)}}" style="width:70px" alt="">
                            <p class="text-center mt-2 mb-0" style="color:black"> {{ $category->title}} </p>
                            <p class="text-center " style="color:#999">  {{App\UserAd::where('category' , $category->id)->count()}} products  </p>
                        </div>
                    </a>
                </div>
                @endforeach


            </div>

        </div>




    </div>


    <div class="row">
        <div class="col-12 text-center">
<h3 style=" background-color:rgb(236, 158, 158); color:red">পাইকারী সব্জি ও ফলের আড়ত</h3 style=" background-color;red">
<h6>এখান থেকে পাইকারী কিনুন </h6>
<h3 class="btn btn-warning">মহাজন</h3>
<div class="row d-flex justify-content-center">
    <div class="col-md-6 py-3">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-3 col-sm-4 col-3 text-center">
                <a href="" class="btn btn-danger">ঢাকা</a>
            </div>

            <div class="col-lg-3 col-sm-4 col-3 text-center">
                <a href="" class="btn btn-info">চট্টগ্রাম</a>
            </div>
            <div class="col-lg-3 col-sm-4 col-3 text-center">
                <a href="" class="btn btn-warning">বরিশাল</a>

            </div>
            <div class="col-lg-3 col-sm-4 col-3 text-center">
                <a href="" class="btn btn-secondary">রাজশাহী</a>

            </div>
        </div>
    </div>

    <div class="col-md-6 py-3">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-3 col-sm-4 col-3 text-center">
                <a href="" class="btn btn-success">সিলেট</a>

            </div>
            <div class="col-lg-3 col-sm-4 col-3 text-center">
                <a href="" class="btn btn-primary">খুলনা</a>
            </div>

            <div class="col-lg-3 col-sm-4 col-3 text-center">
                <a href="" class="btn btn-danger">রংপুর</a>
            </div>
            <div class="col-lg-3 col-sm-4 col-3 text-center">
                <a href="" class="btn btn-success">ময়মনসিংহ</a>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>

    <div class="py-4">

        @php
            $s=0;
        @endphp

        <div class="row">
            <div class="col-12">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                      @foreach ($sliders as $item)
                      <div class="carousel-item {{ $s==0?"active":"" }}">
                        <img src="{{ asset('storage/slider/'.$item->file) }}" class="d-block w-100"  alt="...">
                      </div>

                      @php
                          $s=1;
                      @endphp

                      @endforeach

                    </div>
                   <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </button>
                  </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-lg-3 m-auto text-center py-4">
                <a href="{{ route('user.ads') }}" class="shop-btn">POST YOUR ADS</a>
            </div>
        </div>
    </div>

</div>
@endsection
