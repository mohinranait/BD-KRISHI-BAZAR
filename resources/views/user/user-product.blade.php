
@extends('welcome.layouts.welcomeMaster')

@push('css')
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

    <div class="row mt-4">
        <div class="col-md-3">
            
            @include('user.parts.leftsidebar')

        </div>
        <div class="col-md-9">
            @if (\Session::has('success'))
                <div class="alert alert-success text-center">
                    {!! \Session::get('success') !!}  
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        <div class="card " style="background-color: #f7f7fb;">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">All ShopStore</h3>
                        <div class="" style="width:60%">
                            <input type="text" name="search"  class="form-control" id="productSearch" placeholder="Search shop...">
                        </div>
                        <a href="" class="btn btn-dark btn-sm">Add new Product</a>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="data-table">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quintity</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1 @endphp
                                        @foreach( App\Model\Product::orderby('product_name','desc')->where('shop_id', $shop->id)->get() as $item)
                                        <tr>
                                            <th scope="row">{{$i}}</th>
                                            <td><a href="#">{{$item->product_name}}</a></td>
                                            <td>
                                                @if( $item->product_image)
                                                    <img src="{{asset('img/product/' . $item->product_image)}}"   alt="">
                                                @else
                                                <img src="#" alt="">
                                                @endif
                                                
                                            </td>
                                            <td>{{$item->price}}</td>
                                            <td>{{$item->quintity}}</td>
                                           
                                            <td>
                                                @if( $item->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">In-Active</span>
                                                @endif
                                            </td>
                                            <td class="action">
                                                <div>
                                                    <a href="{{ route('userproductedit' , $item->slug) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit text-white"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#proDel{{$item->id}}"><i class="fa fa-trash text-white"></i></a>
                                                </div>
                                                <!-- Delete modal start -->
                                                <div class="modal fade" id="proDel{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Delete <strong>{{$item->product_name}}</strong> </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="d-flex justify-content-center">
                                                                    <button type="button" class="btn btn-secondary mx-3" data-dismiss="modal">Close</button>
                                                                    <form action="{{route('user.product.delete' , $item->id)}}" method="POST">
                                                                        @csrf 
                                                                        <button type="submit" class="btn btn-danger">Confirm</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Delete modal end -->
                                            </td>
                                        </tr>
                                        @php $i++ @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>






@endsection

@push('js')

<script>
       $(document).ready(function(){
        $("#productSearch").on('keyup', function(e){
            e.preventDefault();
            var search_string = $("#productSearch").val();
            $.ajax({
                url: "{{route('user.product.search')}}",
                method:"GET",
                data:{search_string:search_string},
                success:function(res){
                    $('.data-table').html(res);
                    if( res.status == "nothing"){
                        $('.data-table').html("<div class=' alert alert-info text-center'>"+ 'No Data found' + " </div>")
                    }
                }
            })
        })
    })
</script>

@endpush
