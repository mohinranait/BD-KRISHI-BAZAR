@extends('admin.layouts.adminMaster')

@push('css')

<link href="{{asset('assets/taginput/tagsinput.css')}}" rel="stylesheet" type="text/css">


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
            <form action="{{route('product.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf 
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card ">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title">Add new product</h3>
                                    <a href="{{route('product.index')}}" class="btn btn-dark btn-sm">All Products</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">Title<sup class="text-danger">*</sup></label>
                                            <input type="text" name="product_name" value="{{ $product->product_name}}" class="form-control" placeholder="Title">
                                            @error('product_name')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Description<sup class="text-danger">*</sup></label>
                                            <textarea name="description" id="editor" cols="30" rows="10" placeholder="Description">{!! $product->description !!}</textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Price<sup class="text-danger">*</sup></label>
                                                    <input type="text" name='price' value="{{$product->price}}" class="form-control" placeholder="Price">
                                                    @error('price')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Weight<sup class="text-danger">*</sup></label>
                                                    <input type="text" name="weight" value="{{$product->weight}}" class="form-control" placeholder="Weight">
                                                    @error('weight')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Product SEO</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Meta Title</label>
                                            <input type="text" name="meta_title" value="{{$product->meta_title}}"  class="form-control" placeholder="Meta Title">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        
                                        <div class="form-group">
                                            <label for="">Meta Keyword</label>
                                            <input type="text" name="meta_keyword" value="{{$product->meta_keyword}}" data-role="tagsinput" value="skj" class="form-control" placeholder="Meta Keyword">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="">Meta Description</label>
                                            <textarea name="meta_description" id=""  class="form-control" cols="30" rows="3" placeholder="Meta description">{{ $product->meta_description }}</textarea>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <!-- /.row -->
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Product SEO</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="">Select status</label>
                                    <select name="status" class="form-control" id="">
                                        <option value="1">Select Status</option>
                                        <option value="1" @if($product->status == 1 ) selected @endif>Active</option>
                                        <option value="2" @if($product->status == 2 ) selected @endif>In-Active</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Quintity</label>
                                    <input type="text" name="quintity"  value="{{$product->quintity}}" class="form-control" placeholder="Quintity">
                                </div>

                                <div class="form-group">
                                    <img src="{{asset('img/product/' . $product->product_image)}}" width="100%" alt="">
                                    <label for="">Product Image<sup class="text-danger">*</sup></label>
                                    <input type="file" name="product_image" id="input-file-now" class="dropify" >
                                    <br>
                                    <br>
                                   
                                    @error('product_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                    
                               
                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" value="Product update">
                                </div>
                                
                                <!-- /.row -->
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</section>
@endsection


@push('js')
    

    <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
<script>
    // CK editro
    CKEDITOR.replace( 'description' );

</script>


<script src="{{asset('assets/taginput/tagsinput.js')}}"></script>




@endpush

