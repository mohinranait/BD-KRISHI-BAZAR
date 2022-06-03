<!DOCTYPE html>
<html lang="en">
 
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Tech heron file</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- styles -->
   <!-- <link rel="stylesheet" href="{{asset('uit/bootstrap/css/bootstrap.min.css')}}"> -->

  <link href="{{asset('sf/assets/css/bootstrap.css')}}" rel="stylesheet">
  <link href="{{asset('sf/assets/css/bootstrap-responsive.css')}}" rel="stylesheet">
  <link href="{{asset('sf/assets/css/docs.css')}}" rel="stylesheet">
  <link href="{{asset('sf/assets/css/prettyPhoto.css')}}" rel="stylesheet">
  <link href="{{asset('sf/assets/js/google-code-prettify/prettify.css')}}" rel="stylesheet">
  <link href="{{asset('sf/assets/css/camera.css')}}" rel="stylesheet">
  <link href="{{asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300|Open+Sans:400,300,300italic,400italic')}}" rel="stylesheet">
  <link href="{{asset('sf/assets/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('sf/assets/color/success.css')}}" rel="stylesheet">

  <!-- fav and touch icons -->
  <link rel="shortcut icon" href="{{asset('sf/assets/ico/favicon.ico')}}">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('sf/assets/ico/apple-touch-icon-144-precomposed.png')}}">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('sf/assets/ico/apple-touch-icon-114-precomposed.png')}}">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('sf/assets/ico/apple-touch-icon-72-precomposed.png')}}">
  <link rel="apple-touch-icon-precomposed" href="{{asset('sf/assets/ico/apple-touch-icon-57-precomposed.png')}}">
  <link rel="stylesheet" href="{{asset('https://fonts.googleapis.com/css?family=Atma')}}">

   <style>
    p {
      font-family: "Atma";
      font-size: 19px;
    }
    section {
      font-family: " Acme";
      font-size: 16px;
    }
    h2 {
      font-family: " Acme";
      font-size: 32px;
    }
    h4 {
      font-family: " Acme";
      font-size: 28px;
    }

    h5 {
      font-family: " Acme";
      font-size: 20px;
      color:darkmagenta;
    }
    </style>

  <!-- =======================================================
    Theme Name: Scaffold
    Theme URL: https://bootstrapmade.com/scaffold-bootstrap-metro-style-template/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
  ======================================================= -->
</head>

<body>

@include('welcome.layouts.welcomeHeader')

<!-- @include('welcome.studentHome') -->
 @yield('content')

@include('welcome.layouts.welcomeFooter')
  <!-- Footer
 ================================================== -->
  

  <script src="{{asset('sf/assets/js/jquery-1.8.2.min.js')}}"></script>
  <script src="{{asset('sf/assets/js/jquery.easing.1.3.js')}}"></script>
  <script src="{{asset('sf/assets/js/google-code-prettify/prettify.js')}}"></script>
  <script src="{{asset('sf/assets/js/modernizr.js')}}"></script>
  <script src="{{asset('sf/assets/js/bootstrap.js')}}"></script>
  <script src="{{asset('sf/assets/js/jquery.elastislide.js')}}"></script>
  <script src="{{asset('sf/assets/js/jquery.flexslider.js')}}"></script>
  <script src="{{asset('sf/assets/js/jquery.prettyPhoto.js')}}"></script>
  <script src="{{asset('sf/assets/js/application.js')}}"></script>
  <script src="{{asset('sf/assets/js/hover/jquery-hover-effect.js')}}"></script>
  <script src="{{asset('sf/assets/js/hover/setting.js')}}"></script>
  <script src="{{asset('sf/assets/js/camera/camera.min.js')}}"></script>
  <script src="{{asset('sf/assets/js/camera/setting.js')}}"></script>

  <!-- Template Custom JavaScript File -->
  <script src="{{asset('sf/assets/js/custom.js')}}"></script>

</body>

</html>
