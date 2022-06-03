<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>BD Krishi Bazar</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('cp/plugins/fontawesome-free/css/all.min.css') }}">
    <!--Bootstrap cdn-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('cp/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/w3.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <style>
        footer.footer {
            background: #fff;
        }


  .submenymobile {
   display: none; /* The width is 100%, when the viewport is 800px or smaller */
  }


        @media screen and (max-width: 800px) {
  .submenymobile {
   display: block; /* The width is 100%, when the viewport is 800px or smaller */
  }

  .submenymobile1 {
   display: none !important; /* The width is 100%, when the viewport is 800px or smaller */
  }
}



    </style>

<style type="text/css">
    /*Setting Basic Dimensions to give
    gallery view */
    .container{
        margin: 0 auto;
        width: 90%;
    }
    .main_view{
        width: 80%;
        height: 10rem;
    }
    .main_view img{
        /* width: 100%; */
        height: 200px;
        object-fit: cover;
        text-align: center !important
    }
    .side_view{
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
    }
    .side_view img{
        width: 9rem;
        height: 7rem;
        object-fit: cover;
        cursor: pointer;
        margin:0.5rem;
    }

    nav.navbar.navbar-expand-lg.navbar-light {

   margin-top: 0px !important;
}
</style>

<style>
    .mob-head-d{
        display:none;
    }

    .mob-head-h{
        display:inline;
    }

    nav.navbar.navbar-expand-lg.navbar-light {
    margin-top: 0px !important;
}

.banner-content .banner-paragrap {
    text-align: center;
    font-weight: 500;
    margin-bottom: 0px;
}

.footer-mobile{
    display: none !important;
}


    @media screen and (max-width: 992px) {
    .mob-head-d{
        display:inline;
    }

    .mob-head-h{
        display:none;
    }


  }


  @media screen and (max-width: 768px) {


    .footer-mobile{
    display: block !important;
}

.footer-mobile-h{
    display: none !important;
}


  }
</style>
    @stack('css')
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        @php
            use Carbon\Carbon;
        @endphp

        @section('content')


            <!-- Navbar -->
            @include('welcome.layouts.welcomeHeader')
            <!-- /.navbar -->
            <div class="container" style="min-height: 540px">
                @yield('content')
            </div>



            <!-- Main Footer -->
            @include('welcome.layouts.loginFooter')
        </div>
        <!-- ./wrapper -->



        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        <script src="{{ asset('cp/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('cp/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('cp/dist/js/adminlte.min.js') }}"></script>
        <script type="text/javascript">
            const change = src => {
                document.getElementById('main').src = src
            }
        </script>
        @stack('js')
    </body>

    </html>
