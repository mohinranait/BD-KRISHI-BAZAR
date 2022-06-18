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
                        <h3 class="card-title">Order details</h3>
                        
                        <a href="{{route('order.index')}}" class="btn btn-dark btn-sm">Order list</a>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="order-summery-box">
                                <h4>Personel Information</h4>
                                <p> <span class="summary-span-tag">Name</span> {{$order->name}} </p>
                                <p> <span class="summary-span-tag">Email</span> {{$order->email}} </p>
                                <p> <span class="summary-span-tag">Phone</span> {{$order->phone}} </p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="order-summery-box">
                                <h4>Order Status</h4>
                                <p> 
                                    <span class="summary-span-tag">Payment</span> 
                                    @if( $order->payment_method == 1 )
                                        bkash
                                    @elseif($order->payment_method == 2)
                                        Nagad
                                    @endif
                                 </p>
                                <p> <span class="summary-span-tag">TrxtID</span> {{$order->transaction_id}} </p>
                                <p> <span class="summary-span-tag">Amount</span> &#2547; {{$order->amount}} </p>
                                <p> 
                                    <span class="summary-span-tag">Status</span> 
                                    @if( $order->status == 1)
                                        <span class="badge badge-info">Pending</span>
                                    @elseif($order->status == 2)
                                    <span class="badge badge-danger">Cancle</span>
                                    @elseif($order->status == 3)
                                    <span class="badge badge-success">Delevery</span>
                                    @elseif($order->status == 4)
                                    <span class="badge badge-warning">Hold</span>
                                    @endif
                                </p>
                                <p> <span class="summary-span-tag">Date </span> {{$order->created_at}} </p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="order-summery-box">
                                <h4>Shipping Address</h4>
                                <p> <span class="summary-span-tag">Address</span> {{$order->address}} </p>
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-item-details order-summery-box">
                                <table class="table  table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Shop Name</th>
                                            <th>image</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quintity</th>
                                            <th class="text-center">Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1 @endphp
                                        @foreach( $cards as $item)
                                        <tr>
                                            <th scope="row">{{$i}}</th>
                                            <td>{{$item->shop->shop_name}}</td>
                                            <td>
                                                <img src="{{asset('img/product/'. $item->product->product_image)}}" alt="">
                                            </td>
                                            <td>{{$item->product->product_name}}</td>
                                            <td>&#2547; {{$item->unite_price}}</td>
                                            <td>{{$item->product_qty}} Psc</td>
                                            <td class="text-center"> &#2547; {{ $item->unite_price * $item->product_qty }}</td>
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

