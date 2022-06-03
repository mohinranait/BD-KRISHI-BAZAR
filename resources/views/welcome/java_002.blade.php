@extends('welcome.layouts.welcomeMaster')

@push('css')

    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <style>
        h1:hover, label:hover, input:hover {
          background-color: fuchsia;
        }
        </style>

@endpush

@section('content')



@include('welcome.parts.java_002')

@endsection

@push('js')
<script type="text/javascript">  
</script>
@endpush
