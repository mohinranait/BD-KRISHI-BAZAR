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
                        <h3 class="card-title">Update order information</h3>
                        
                        <a href="{{route('order.index')}}" class="btn btn-dark btn-sm">Order list</a>
                    </div>
                </div>
                
                <div class="card-body">
                    <form action="{{route('order.update', $order->id)}}" method="POST">
                        @csrf 
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Full Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $order->name }}" placeholder="Full nmae">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" name="email" class="form-control" value="{{ $order->email }}" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $order->phone }}" placeholder="Phone">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" name="address" class="form-control" value="{{ $order->address }}" placeholder="Address">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group mb-0">
                                    <h5>Shipping</h5>
                                    <input type="radio" name="is_paid" @if( $order->is_paid == 2 ) checked @endif value="2">
                                    <label for="">Mobile payment</label>
                                    
                                </div>
                                <div class="form-group">
                                    
                                    <input type="radio" name="is_paid" @if( $order->is_paid == 1 ) checked @endif value="1">
                                    <label for="">Locak pickup</label>
                                    
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-0">
                                    <h5>Payment method</h5>
                                    <input type="radio" name="payment_method" @if( $order->payment_method == 1 ) checked @endif value="1">
                                    <label for="">Bkash</label>
                                    
                                </div>
                                <div class="form-group">
                                    
                                    <input type="radio" name="payment_method" @if( $order->payment_method == 2 ) checked @endif value="2">
                                    <label for="">Nagad</label>
                                    
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mb-0">
                                    <h5>Customer & admin comunication box</h5>
                                    <textarea name="masseg" class="form-control" id="" cols="30" placeholder="Massege" rows="3"></textarea>
                                    
                                </div>
                                
                            </div>
                           
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">TxtID</label>
                                    <input type="text" name="transaction_id" class="form-control" value="{{ $order->transaction_id }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Total Amount</label>
                                    <input type="text" name="amount" class="form-control" value="{{ $order->amount }}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control" id="">
                                        <option value="">Select Status</option>
                                        <option value="1" @if($order->status == 1) selected @endif>Pending</option>
                                        <option value="2" @if($order->status == 2) selected @endif>Cancle</option>
                                        <option value="3" @if($order->status == 3) selected @endif>Delivery</option>
                                        <option value="4" @if($order->status == 4) selected @endif>Hole</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 text-right">
                                <input type="submit" class="btn btn-success" value="Update Order">
                            </div>
                        </div>
                    </form>

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

