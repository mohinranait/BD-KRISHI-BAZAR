
@extends('welcome.layouts.welcomeMaster')

@push('css')
<link href="{{asset('assets/taginput/tagsinput.css')}}" rel="stylesheet" type="text/css">
<style>

    


    .card-summary table tbody .table-header .table-td{
        border-top:none;
    }
    .card-summary{
        margin-bottom: 3.6rem;
        border: 2px solid #e7e7e7;
        background: #fff;
        padding:10px 19px;
    }
    .card-summary .card-sumary-title{
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
    }
    .shipping-border h4, .table-header .tabl-td{
        font-size: 16px;
        font-weight: bold;
    }
    .form-group-custom-control .custom-control.custom-radio .label-text{
        font-weight: 100 !important;
        font-size: 14px;
        color: black;
    }
    .total-title{
        font-size: 15px;
        font-weight: bold;
    }
    .total-amoun{
        font-size: 20px;
        font-weight: bold;
    }
</style>

@endpush


@section('content')

<form action="{{route('order')}}" method="POST" >
    @csrf 


    @if (\Session::has('massage'))
        <div class="alert alert-danger mt-4">
            Please ! {!! \Session::get('massage') !!}  
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row mt-4">
                            
        <div class="col-lg-7">
           
            <h4>Billing Address</h4>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="">First Name</label>
                        @if(Auth::check())
                        <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control" required  placeholder="Name...">
                        @else
                        <input type="text" name="name" class="form-control"  placeholder="Name...">
                        @endif
                        
                    </div>
                </div>
                
               
            </div>
            
    

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Email</label>
                        @if(Auth::check())
                        <input type="text" name="email" value="{{Auth::user()->email}}" class="form-control"  placeholder="Email...">
                        @else
                        <input type="text" name="email"  class="form-control" placeholder="Email">
                        @endif
                        
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Phone</label>
                        @if(Auth::check())
                        <input type="text" name="phone" value="{{Auth::user()->phone}}" class="form-control" required  placeholder="Phone...">
                        @else
                        <input type="text" name="phone"  class="form-control" placeholder="Phone">
                        @endif
                        
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="">Street address</label>
                        <input type="text" name="address"  class="form-control" required placeholder="Street address">
                    </div>
                </div>
            </div>

           <div class="row">
                <div class="col-lg-12">
                    <h5>Shipping</h5>
                    <div class="form-group mb-0" >
                        <!-- Value 2 is Pickup from shop -->
                        <input type="radio" name="is_paid" value="2" id="mobilePaymentInput" required  checked>
                        <label for="">Mobile payment</label>
                    </div>
                    <div class="form-group">
                        <!-- Value 1 is Cash on delivery  -->
                        <input type="radio" name="is_paid" id="cashOnDelevery" required value="1">
                        <label for="">Cash on Delivery</label>
                    </div>
                </div>
           </div>

           
        </div>
        <div class="col-lg-5">
            <div class="card-summary">
                <h3 class="px-3 card-sumary-title">Your product</h3>
                <table class="table">
                    <tbody>
                        <tr class="table-header" style="border-bottom:1px solid #ddd">
                            <td class="table-td text-bold">Product</td>
                        </tr>
                        @foreach($products as $item)
                        <tr colspan="2" style="">
                            <td  style="border-top:none;">
                                <p class="mb-0">{{$item->product->product_name}} x {{$item->product_qty}}</p>
                            </td>
                            <td class="text-right"  style="border-top:none; ">
                                <p class="mb-0">$ {{$item->product_qty * $item->unite_price}}</p>
                            </td>
                        </tr>
                        @endforeach
                       
                       
                        <tr class="table-header " style="border-bottom:1px solid #ddd; margin-top:20px;">
                            <td class="table-td text-bold">Subtotal</td>
                            <td class="table-td text-right text-bold">$ {{ App\Model\Card::totalPrice() }}</td>                      
                        </tr>

                        <tr colspan="2" class="paymetnMethidDiv">
                            <td class="shipping-border" style="border-top:none;">
                                <div class="shipping-div">
                                    <h4>Payment method</h4>
                                    <div class=" form-group-custom-control">
                                        <div class="custom-control custom-radio" >
                                            <input type="radio" name="payment_method" id="bkashInput"  value="1" >
                                            <label for="1" class="label-text" >Bkash</label>
                                            <p class="bkashInfo" id="">Mobile : 01728068200</p>
                                        </div>
                                    </div>
                                    <div class=" form-group-custom-control">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="payment_method" id="nagadInput"   value="2" >
                                            <label for="2" class="label-text">Nagad</label>
                                            <p class="nagadInfo" id="">Nagad : 01728068200</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Transaction ID</label>
                                        <input type="text" name="transaction_id" class="form-control" placeholder="TxtID">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="total-title">Total</td>
                            <td class="total-amoun text-right">$ {{ App\Model\Card::totalPrice() }}</td>
                        </tr>
                    </tbody>
                </table>
                <div>
                    <input type="hidden" name="amount" value="{{ App\Model\Card::totalPrice() }}">
                    <button type="submit" class="btn btn-dark btn-lg text-uppercase w-100">Place order</button>
                </div>
            </div>
        </div>
    </div>

</form>
    
    

@endsection

@push('js')
<script src="{{asset('assets/taginput/tagsinput.js')}}"></script>
<script src="{{asset('js/ecom.js')}}"></script>

   

@endpush
