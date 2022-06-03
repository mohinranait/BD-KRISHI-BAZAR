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

<section id="maincontent">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <a href=""> <img src="{{asset('storage/post/file/feature/'.$post->feature_image)}}" alt="" class="img-fluid"></a> <br>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 style="color: black">{{ $post->title }}</h3>
                                        <h6 style="color: black">Price: {{ $post->price }} BDT</h6>
                                    </div>
                                    <div class="card-body">
                                        <p>{!! $post->description !!}</p>
                                        @auth
                                        @if(auth()->user()->isValidate())
                                        @if($post->document_file_name==null)
                                        <a href="{{ $post->link }}" class="btn btn-success">Download</a>
                                        @else
                                        <a  href="storage/post/file/{{ $post->document_file_name }}"
                                            download="{{ $post->document_file_name }}" class="btn btn-success">Download</a>
                                            @endif

                                      @else
                                      <a  href="{{ url('/packeges')}}"
                                          class="btn btn-success">Download</a>
                                          @endif

                                        @else
                                        <a href="{{ url('/') }}" class="btn btn-success">Download</a>
                                       @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection
@push('js')
@endpush
