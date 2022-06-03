
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Easy Way Automation</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- styles -->
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
  <link href="assets/css/docs.css" rel="stylesheet">
  <link href="assets/css/prettyPhoto.css" rel="stylesheet">
  <link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet">
  <link href="assets/css/camera.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300|Open+Sans:400,300,300italic,400italic" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/color/success.css" rel="stylesheet">


  <!-- fav and touch icons -->
  <link rel="shortcut icon" href="assets/ico/favicon.ico">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Atma">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

  <!-- =======================================================

  ======================================================= -->

  <style>
    p {
      font-family: "Atma";
      font-size: 19px;
    }

    td {
      font-family: "Atma";
      font-size: 19px;
    }

    h2{
    font-family: "Atma";
    font-size: 28px;
    }


    </style>




@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

    <div style="background-color: #7cbb00;" class="shadow p-3 mb-5 rounded">



            <h1 class="display-4"></h1>



                <p class="lead"><span class="badge badge-danger"></span><span class="badge badge-primary"></span>

                  Selenium WebDriver With Java in Bangla একদম জিরো থেকে, কোন প্রকার পূর্ব অভিজ্ঞতা ছাড়াই হাতে কলমে প্রফেশনাল সেলেনিয়াম ডেভলপার শিখার জন্যে Login করি। মিশন শুরু করে দাও।
তোমার লাইফের নতুন মিশন। হার্ডওয়ার্ক করবে তুমি।
গাইডলাইন আর সাপোর্ট দিবো আমরা।

                </p>

    <div class="row justify-content-md-center text-center ">
                <!--<div class="col col-md-4 d-block bg-info text-white p-4 mb-2" onclick="window.location.replace('https://goo.gl/xkL6py');" onmouseover="this.addClass('bg-warning')">Watch Free Selenium Tutorials</div>    -->
                 <!--<a class="col col-md-4 d-block bg-success text-black p-4 mb-2" href="" style="text-decoration:none">Selenium Web Automation</a>    -->
                 <!--<a class="col col-md-4 d-block bg-danger text-white p-4 mb-2" href="" style="text-decoration:none">Watch Free Java Tutorials</a>    -->
                 <!--<a class="col col-md-4 d-block bg-success text-white p-4 mb-2" href="" style="text-decoration:none">Demo page for Selenium live class</a>             -->
            </div>


</div>

        <div class="col-md-8">
            <h1 style="text-align: center;" class="badge badge-success" >Course Details</h1>



               <table class="table table-striped table-bordered text-left">
                <tbody><tr>
                    <td><h1>কোর্সের নাম</h1></td>
                    <td><h1>Selenium WebDriver With Java</h1></td>
                </tr>
                <tr>
                    <td>সময় </td>
                  <td>২ ঘন্টা করে সপ্তাহে ২ দিন, মোট ৪ মাস</td>
                </tr>


                 <tr>
                    <td>সার্পোট এর ব্যবস্থা</td>
              <td>সপ্তাহে ৩ দিন ২ ঘন্টা করে সার্পোট এর ব্যবস্থা।</td>
                    </td>
                </tr>



                 <tr>
                   <td>ইন্টারভিউ, রিজিউম তৈরী</td>
                   <td>ইন্টারভিউ প্রিপারেশান, ক্লাস শেষে রিজিউম তৈরী করে দেওয়া হবে।</td>
                    <br><span class="small text-primary"></span>
                    <br></td>
                </tr>

                 <tr>
                    <td>কোর্সের বিষয়বস্তু</td>
                    <td>
                      <a href="https://7b960d55-442d-4a55-a255-7a6013665986.filesusr.com/ugd/7b7251_dae6d08edf964ba6a3d6cea9b4925a8c.pdf">সিলেবাস এখান থেকে দেখে নিন।</a>
                      <a href="https://www.freeconferencecall.com/wall/recorded_audio?audioRecordingUrl=https%3A%2F%2Frs0000.freeconferencecall.com%2Fstorage%2FsgetFCC2%2FOzE0P%2FICEip&subscriptionId=14149341"> Demo ভিডিও দেখুন এখান থেকে</a>

                    </td>
                </tr>



            </tbody>
        </table>
        </div>

        <div class="col col-md-4">
            <br>
            <br>


<div class="card">

                <div style="background-color: #f8b601;" class="card-header">{{ __('Login') }}</div>

                <div style="background-color: #f8b601;" class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">

                            <div class="col-md-12 col-sm-1">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"  placeholder="Your Email (required)" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <div class="col-md-12 col-sm-1">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password (required)">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                        </div>

                        <!-- <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a style="margin-left: -44px;" class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
</div>
    </div>
</div>

@endsection

