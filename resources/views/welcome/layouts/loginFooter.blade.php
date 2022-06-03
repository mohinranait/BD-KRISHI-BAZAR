
<footer class="main-footer footer-mobile-h">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2022 <a href="http://bdkrishibazar.com/">BDKrishiBazar</a>.</strong> All rights
    reserved.
</footer>


<div class="footer-mobile">
    <div class="row" style="height: 35px">

    </div>
    <div class="row d-flex justify-content-center  py-2 "
    style=" position: fixed;bottom: 0;right: 0;left:0;background-color:rgb(82, 80, 80)">
    <div class="col-3 text-center">
        <a href="{{ url('/') }}"><i style="color: #fff" class="icon fa fa-home fa-2x"></i></a>
    </div>


    <div class="col-3 text-center">
        <a href="{{ route('user.myPost') }}"><i style="color: #fff" class="icon fa fa-box fa-2x"></i></a>
    </div>
    <div class="col-3 text-center">
       <a href="{{route('allAds')}}"> <i style="color: #fff; font-size:34px" class="fab fa-product-hunt"></i></a>
    </div>
    <div class="col-3 text-center">
        <a href="{{route('user.dashboard')}}"><i style="color: #fff" class="icon fa fa-user fa-2x"></i></a>
    </div>
</div>
</div>


