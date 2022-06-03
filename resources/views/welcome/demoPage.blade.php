@extends('welcome.layouts.welcomeMaster')

@push('css')
@endpush

@section('content')

<div class="container mt-3">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                @foreach($demos as $demo)
                <div class="col-md-4 py-3">
                    <div>
                        @if($demo->link!=null)
                        <a href="{{$demo->link}}"><img height="50" width="100%" src="{{asset('storage/subject/file/'.$demo->img)}}" ></a>
                        <h5 class="w3-center">{{ ucfirst($demo->name) }}</h5>

                        @else
                        <a href="{{asset('storage/subject/file/demo/'.$demo->demo_file)}}"><img height="50" width="100%" src="{{asset('storage/subject/file/'.$demo->img)}}" ></a>
                        <h5 class="w3-center">{{ ucfirst($demo->name) }}</h5>

                        @endif

                    </div>
                </div>

                @endforeach
            </div>

        </div>

        <div class="col-md-3" >
            <div class="w3-card">
                <div class="w3-card-body">

                    <div class="container pt-3">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="w3-card">
                                    <div class="w3-card-body">
                                       <a href="/register"> <img src="{{asset('img/w1.png')}}" alt="" class="img-fluid"></a>
                                    </div>
                                </div>
                                <hr>
                            </div>

                            <div class="col-md-12">
                                <div class="w3-card">
                                    <div class="w3-card-body">
                                       <a href="/register"> <img src="{{asset('img/g1.png')}}" alt="" class="img-fluid"></a>
                                    </div>
                                </div>
                                <hr>
                            </div>

                            <div class="col-md-12">
                                <div class="w3-card">
                                    <div class="w3-card-body">
                                       <a href="https://webseobd.com/"> <img src="{{asset('img/wd1.png')}}" alt="" class="img-fluid"></a>
                                    </div>
                                </div>
                                <hr>
                            </div>

                            <div class="col-md-12">
                                <div class="w3-card">
                                    <div class="w3-card-body">
                                       <a href="https://webseobd.com/"> <img src="{{asset('img/d1.png')}}" alt="" class="img-fluid"></a>
                                    </div>
                                </div>
                                <hr>
                            </div>

                            <div class="col-md-12">
                                <div class="w3-card">
                                    <div class="w3-card-body">
                                       <a href="https://youtu.be/lu7CuNjIDR4"> <img src="{{asset('img/l1.png')}}" alt="" class="img-fluid"></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



{{-- @include('welcome.parts.demoVideos') --}}

@endsection

@push('js')
<script type="text/javascript">
</script>
@endpush
