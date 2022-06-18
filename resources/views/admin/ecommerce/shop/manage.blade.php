@extends('admin.layouts.adminMaster')

@push('css')

<style>
    tr td img{
        width: 80px;
    }
    .action{
        width:145px;
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

            <div class="card ">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">All ShopStore</h3>
                        <div class="" style="width:60%">
                            <input type="text" name="search"  class="form-control" id="realSearch" placeholder="Search shop...">
                        </div>
                        <a href="{{route('shop.create')}}" class="btn btn-dark btn-sm">Add new Shop</a>
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
                                            <th scope="col">Shop Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Shop Logo</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1 @endphp
                                        @foreach( $shopInformations as $item)
                                        <tr>
                                            <th scope="row">{{$i}}</th>
                                            <td><a href="#">{{$item->shop_name}}</a></td>
                                            <td>{{$item->shop_email}}</td>
                                            <td>{{$item->shop_phone}}</td>
                                            <td>
                                                <img src="{{asset('img/shop/' . $item->shop_logo)}}"  alt="">
                                            </td>
                                            <td>
                                                @if( $item->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">In-Active</span>
                                                @endif
                                            </td>
                                            <td class="action">
                                                <div>
                                                    <a href="{{route('shop.edit' , $item->id)}}" class="btn btn-primary btn-sm">EDIT</a>
                                                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#shopDel{{$item->id}}">DELETE</a>
                                                </div>
                                                <!-- Delete modal start -->
                                                <div class="modal fade" id="shopDel{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Delete <strong>{{$item->shop_name}}</strong> </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="d-flex justify-content-center">
                                                                    <button type="button" class="btn btn-secondary mx-3" data-dismiss="modal">Close</button>
                                                                    <form action="{{route('shop.delete' , $item->id)}}" method="POST">
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
</section>
@endsection


@push('js')


<script>

   

    $(document).ready(function(){
        $("#realSearch").on('keyup', function(e){
            e.preventDefault();
            var search_string = $("#realSearch").val();
            $.ajax({
                url: "{{route('realtimeShop')}}",
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

