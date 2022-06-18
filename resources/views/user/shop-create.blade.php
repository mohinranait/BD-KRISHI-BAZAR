
@extends('welcome.layouts.welcomeMaster')

@push('css')

<link rel="stylesheet" href="{{asset('assets/dropify/dropify.css')}}">
<style>
    tr td img{
        width:60px;
    }
    .action{
        width:89px;
    }
    
</style>

@endpush

@section('content')

   
    <div class="row">
       <div class="col-lg-12">
            <form action="{{route('frontend.shop.store')}}" method="POST" enctype="multipart/form-data">
                @csrf 
                <div class=" ">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="">Shop Name</label>
                                    <input type="text" name="shop_name" class="form-control" placeholder="Shop nmae">
                                    @error('shop_name')
                                        <span class="text-danger">{{ $message }}<spanp>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Shop Phone</label>
                                            <input type="text" name="shop_phone" class="form-control" placeholder="Shop phone">
                                            @error('shop_phone')
                                                <span class="text-danger">{{ $message }}<spanp>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Shop Email</label>
                                            <input type="text" name="shop_email" class="form-control" placeholder="Shop email">
                                            @error('shop_email')
                                                <span class="text-danger">{{ $message }}<spanp>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Zila</label>
                                            <select name="shop_district_id" class="form-control" id="sopCreateZila">
                                                <option value="">Select Zila</option>
                                                @foreach( $districts as $item)
                                                <option value="{{ $item->id}}">{{ $item->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('shop_district_id')
                                                <span class="text-danger">{{ $message }}<spanp>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Shop Upzila</label>
                                            <select name="shop_upzila_id" class="form-control" id="shipCreateUpzila">
                                                <option value="">Select UpZila</option>
                                                
                                            </select>
                                            @error('shop_upzila_id')
                                                <span class="text-danger">{{ $message }}<spanp>
                                            @enderror
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
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Shop Cover Photo<sup class="text-danger">*</sup></label>
                                            <input type="file" name="shop_cover_photo" id="input-file-now" class="dropify">
                                            <span>Size : 1170px / 360px</span>
                                            @error('shop_cover_photo')
                                                <p class="text-danger">{{ $message }}<p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Shop Logo<sup class="text-danger">*</sup></label>
                                            <input type="file" name="shop_logo" id="input-file-now" class="dropify">
                                            <span>Size : 200px / 200px</span>
                                            @error('shop_logo')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center mb-5">
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            @if( Auth::check())
                                            <input type="hidden" name="shop_user_id" value="{{ Auth::user()->id }}">
                                            @endif
                                            <input type="submit" class="btn btn-success" value="Save Shop Information">
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
        $('#sopCreateZila').on('change', function(){
            var zilaId = $(this).val();
            if(zilaId){
                $.ajax({
                    type:'GET',
                    url:'/user-zila/'+ zilaId,
                    dataType:"json",
                    success:function(data){
                        $("#shipCreateUpzila").empty();
                        $('#shipCreateUpzila').html('<option value="">Select your Upzila</option>');
                        $.each(data, function(key,value){
 
                            $("#shipCreateUpzila").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                    }
                });
            }else{
                $('#shipCreateUpzila').html('<option value="">Select country first</option>');
            }
        });
    });

</script>

@endpush