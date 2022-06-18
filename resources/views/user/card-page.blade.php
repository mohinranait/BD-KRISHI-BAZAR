
@extends('welcome.layouts.welcomeMaster')

@push('css')
<style>
   .table thead .item-th{
        border-bottom:1px solid #ddd;
        border-top:none;
   }
    

    .item-delete-form{
        display: inline;
        position: absolute;
        top: 9px;
        left: 12px;
    }
    .item-delete-form button{
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        text-align: center;
        line-height: 20px;
        font-size: 9px;
        font-weight: bold;
        box-shadow: 0px 1px 2px #4e4b4b;
    }
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

    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="card-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="item-th text-uppercase">Product</th>
                            <th class="item-th text-center text-uppercase">Price</th>
                            <th class="item-th text-center text-uppercase">Quantity</th>
                            <th class="item-th text-right text-uppercase">Subtotal</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach( $products as $item)
                        <tr class="card-row">
                            <td>
                            <form action="{{route('card.item.delete' , $item->id)}}" method="POST" class="item-delete-form">
                                @csrf 
                                <button type="submit">X</button>
                            </form>
                                <div class="card-item d-flex align-items-center">
                                    <img src="{{asset('img/product/' . $item->product->product_image)}}"  alt="">
                                    <a href="#">{{$item->product->product_name}}</a>
                                </div>
                            </td>
                            <td>
                                
                                <p class="text-center">$ {{$item->unite_price}}</p>
                                
                            </td>
                            <td>
                                
                                <p class="text-center"> {{$item->product_qty}}</p>
                               
                            </td>
                            <td>
                                
                                <p class="text-right item-total-price">$  {{$item->unite_price * $item->product_qty }}</p>
                                
                            </td>
                        </tr>
                        @endforeach

                      
                    </tbody>
                   
                </table>
                <!-- count products -->
                @if( $products->count() == 0 )
                <div class="alert alert-info">
                    Go to Shop, and click add to card
                </div>
                @endif
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-summary">
                <h3 class="px-3 card-sumary-title">Card Totals</h3>
                <table class="table">
                    <tbody>
                        <tr class="table-header" style="border-bottom:1px solid #ddd">
                            <td class="table-td text-bold">Subtotal</td>
                            <td class="table-td text-right">$ {{ App\Model\Card::totalPrice() }}</td>
                            
                        </tr>
                        <tr colspan="2">
                        
                            <td class="shipping-border" style="border-top:none;">
                            
                                <h4>Shipping</h4>
                                <div class=" form-group-custom-control">
                                    <div class="custom-control custom-radio">
                                        <input type="radio">
                                        <label for="" class="label-text">Local pickup</label>
                                    </div>
                                </div>
                                <div class=" form-group-custom-control">
                                    <div class="custom-control custom-radio">
                                        <input type="radio">
                                        <label for="" class="label-text">Local pickup</label>
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
                    <a href="{{route('checkout')}}" class="btn btn-dark btn-lg w-100">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
    
    

@endsection

@push('js')


@endpush
