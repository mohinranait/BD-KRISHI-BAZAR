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
            <form action="{{route('shop.store')}}" method="POST" enctype="multipart/form-data">
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
                                            <input type="text" name="shop_name" class="form-control" value="{{old('shop_name')}}" placeholder="Shop name">
                                            @error('shop_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Shop Phone<sup class="text-danger">*</sup></label>
                                                    <input type="text" name="shop_phone" class="form-control" value="{{old('shop_phone')}}" placeholder="Phone">
                                                    @error('shop_phone')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Shop Email<sup class="text-danger">*</sup></label>
                                                    <input type="email" name="shop_email" class="form-control" value="{{old('shop_email')}}"   placeholder="Email">
                                                    @error('shop_email')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Zila<sup class="text-danger">*</sup></label>
                                                    <select name="shop_district_id"  class="form-control" id="zila">
                                                        <option value="">Select Zila</option>
                                                        @foreach( $districts as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                        
                                                    </select>
                                                    @error('shop_district_id')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Upzila<sup class="text-danger">*</sup></label>
                                                    <select name="shop_upzila_id" class="form-control" id="upzila">
                                                        <option value="">select Upzila</option>
                                                        
                                                    </select>
                                                    @error('shop_upzila_id')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                        </div>
               
                                        <div class="row py-4">
                                            <div class="col-lg-6">

                                                <div class="form-group">
                                                    <strong>Active</strong>
                                                    <input type="radio" name="status" value="1" checked>
                                                    <span class="px-4"></span>
                                                    <strong >In-active</strong>
                                                    <input type="radio" name="status" value="2">
                                                </div>
                                                
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row mb-5">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="">User Image<sup class="text-danger">*</sup></label>
                                                    <input type="file" name="shop_user_profile" id="input-file-now" class="dropify" data-default-file>
                                                    <span>Size : 100px / 100px</span>
                                                    @error('shop_user_profile')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Shop Cover Photo<sup class="text-danger">*</sup></label>
                                                    <input type="file" name="shop_cover_photo" id="input-file-now" class="dropify">
                                                    <span>Size : 1170px / 360px</span>
                                                    @error('shop_cover_photo')
                                                        <span class="text-danger">{{ $message }}<spanp>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="">Shop Logo<sup class="text-danger">*</sup></label>
                                                    <input type="file" name="shop_logo" id="input-file-now" class="dropify">
                                                    <span>Size : 200px / 200px</span>
                                                    @error('shop_logo')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
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
                                                    <input type="hidden" name="admin_shop" value="1">
                                                    <input type="hidden" name="shop_user_id" value="{{ Auth::user()->id }}">
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
        $('#zila').on('change', function(){
            var zilaValue = $(this).val();
            if(zilaValue){
                $.ajax({
                    type:'GET',
                    url:'/upazila/'+ zilaValue,
                    dataType:"json",
                    success:function(data){
                        $("#upzila").empty();
                        $('#upzila').html('<option value="">Select your Upzila</option>');
                        $.each(data, function(key,value){
                            $("#upzila").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                    }
                }); 
            }else{
                $('#upzila').html('<option value="">Select country first</option>');
            }
        });
    });
</script>

@endpush

