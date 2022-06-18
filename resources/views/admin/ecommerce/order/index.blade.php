@extends('admin.layouts.adminMaster')

@push('css')

<style>
    tr td img{
        width: 80px;
        height:50px
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
                        <a href="{{route('order.create')}}" class="btn btn-dark btn-sm">Add new order</a>
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
                                            <th scope="col">Name</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">P:M:</th>
                                            <th scope="col">TxtID</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1 @endphp
                                        @foreach( $orders as $item)
                                        <tr>
                                            <th scope="row">{{$i}}</th>
                                            <td><a href="#">{{$item->name}}</a></td>
                                           
                                            <td>{{$item->phone}}</td>
                                            <td>&#2547; {{$item->amount}}</td>

                                            
                                            
                                           
                                            <td>
                                               @if($item->is_paid == 2)
                                                @if( $item->payment_method == 1)
                                                        <img src="{{asset('img/BKash-logo.png')}}" style="width:30px;height:30px" alt="">
                                                    @elseif( $item->payment_method == 2)
                                                        <img src="{{asset('img/nagadlogo.jpg')}}" style="width:30px;height:30px" alt="">
                                                        
                                                    @endif
                                               @else
                                                Local Pickup
                                               @endif
                                            </td>
                                            <td><a href="#">{{$item->transaction_id}}</a></td>
                                            <td>
                                                @if( $item->status == 1)
                                                    <span class="badge badge-info">Pending</span>
                                                @elseif($item->status == 2)
                                                    <span class="badge badge-danger">Cancle</span>
                                                @elseif($item->status == 3)
                                                    <span class="badge badge-success">Delevery</span>
                                                @elseif($item->status == 4)
                                                    <span class="badge badge-warning">Hold</span>
                                                @endif
                                            </td>
                                           
                                            <td class="action">
                                                <div>
                                                    <a href="{{route('order.edit' , $item->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                                    <a href="{{route('order.show', $item->id )}}" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#proDel{{$item->id}}"><i class="fa fa-trash"></i></a>

                                                </div>
                                                
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

   


</script>



@endpush

