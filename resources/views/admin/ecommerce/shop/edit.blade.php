@extends('admin.layouts.adminMaster')

@push('css')

<link rel="stylesheet" href="{{asset('assets/dropify/dropify.css')}}">

<style>
    .bootstrap-tagsinput .badge {
        margin: 2px 2px 2px 0px;
        padding:  5px;
    }
    .badge-info {
        font-size: 13px;
        font-weight: normal;
    }
    .bootstrap-tagsinput .badge [data-role="remove"]:after {
        content: "×";
        padding: 2px;
        font-size: 9px;
        background: #12839d;
    }
    .bootstrap-tagsinput .badge [data-role="remove"] {
        margin-left: 4px;
    }
</style>

@endpush

@section('content')
<section class="content">
  	<br>
  	<div class="row">

        <div class="col-sm-12">
            @include('alerts.alerts')

                
            @if (\Session::has('message'))
                <div class="alert alert-success">
                   {!! \Session::get('message') !!}  
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form action="{{route('shop.update', $shop->id)}}" method="POST" enctype="multipart/form-data">
                @csrf 
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card ">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title">Add new Shop</h3>
                                    <a href="{{route('shop.index')}}" class="btn btn-dark btn-sm">All shopStore</a>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">Shop name<sup class="text-danger">*</sup></label>
                                            <input type="text" name="shop_name" class="form-control" value="{{$shop->shop_name}}" required placeholder="Shop name">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Shop Phone<sup class="text-danger">*</sup></label>
                                                    <input type="text" name="shop_phone" class="form-control" value="{{$shop->shop_phone}}" required placeholder="Phone">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Shop Email<sup class="text-danger">*</sup></label>
                                                    <input type="text" name="shop_email" class="form-control" value="{{$shop->shop_email}}" required placeholder="Email">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Zila<sup class="text-danger">*</sup></label>
                                                    <select name="shop_district_id" class="form-control" id="ezila">
                                                        <option value="everyday">Select Zila</option>
                                                        @foreach( $districts as $item)
                                                        <option value="{{$item->id}}" @if( $item->id == $shop->shop_district_id ) selected @endif>{{$item->name}}</option>
                                                        @endforeach
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Upzila<sup class="text-danger">*</sup></label>
                                                    <select name="shop_upzila_id" class="form-control" id="eupzila">
                                                        <option value="everyday">Upzila</option>
                                                        @foreach( $upzilas as $item)
                                                        <option value="{{$item->id}}" @if( $item->id == $shop->shop_upzila_id ) selected @endif>{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Select User<sup class="text-danger">*</sup></label>
                                                    <select name="shop_user_id" class="form-control" id="">
                                                        <option value="">Select user</option>
                                                        @foreach( $users as $user)
                                                        <option value="{{$user->id}}" @if( $user->id == $shop->shop_user_id ) selected @endif>{{$user->email}}</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Status<sup class="text-danger">*</sup></label>
                                                    <select name="status" class="form-control" id="">
                                                        <option value="1">Select Status</option>
                                                        <option value="1" @if($shop->status == 1) selected @endif>Active</option>
                                                        <option value="2" @if($shop->status == 2) selected @endif>In Active</option>
                                                    </select>

                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row mb-5">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="">User Image<sup class="text-danger">*</sup></label>
                                                    <input type="file" name="shop_user_profile" id="input-file-now" class="dropify" data-default-file>
                                                    <p>Size : 100px / 100px</p>
                                                    <img src="{{asset('img/shop/' . $shop->shop_user_profile)}}" width="100%" height="150px" alt="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Shop Cover Photo<sup class="text-danger">*</sup></label>
                                                    <input type="file" name="shop_cover_photo" id="input-file-now" class="dropify">
                                                    <p>Size : 1170px / 360px</p>
                                                    <img src="{{asset('img/shop/' . $shop->shop_cover_photo)}}" width="100%" height="150px" alt="">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="">Shop Logo<sup class="text-danger">*</sup></label>
                                                    <input type="file" name="shop_logo" id="input-file-now" class="dropify">
                                                    <p>Size : 200px / 200px</p>
                                                    <img src="{{asset('img/shop/' . $shop->shop_logo)}}" width="100%" height="150px" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                
                                            </div>
                                            <div class="col-lg-6">
                                               
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-success" value="save information">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</section>
@endsection


@push('js')

<script src="{{asset('assets/dropify/dropify.js')}}"></script>
<script>
    $(document).ready(function(){
        // Basic
        $('.dropify').dropify();
        // Used events
        var drEvent = $('.dropify-event').dropify();
        drEvent.on('dropify.beforeClear', function(event, element){
            return confirm("Do you really want to delete \"" + element.filename + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element){
            alert('File deleted');
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('#ezila').on('change', function(){
            var countryID = $(this).val();
            if(countryID){
                $.ajax({
                    type:'GET',
                    url:'/upazila/'+ countryID,
                    dataType:"json",
                    success:function(data){
                        $("#eupzila").empty();
                        $.each(data, function(key,value){

                            $("#eupzila").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                    }
                }); 
            }else{
                $('#eupzila').html('<option value="">Select country first</option>');
            }
        });
    });
</script>

@endpush

