

@extends('welcome.layouts.welcomeMaster')

@section('mete')
<meta name="keywords" content="{{ $product->meta_keyword}}">
<meta name="description" content="{{ $product->meta_description}}">
<meta property="og:title" content="{{ $product->meta_title == null ? $product->product_name : $product->meta_title }}">
@endsection

@section('content')


    
    <div class="row my-5">
        <div class="col-lg-5">
            <div class="product-img-modal">
                <img src="{{asset('img/product/'. $product->product_image )}}" width="100%" alt="">
            </div>
        </div>
        <div class="col-lg-7">
            <div class="modal-product-content">
                <h5 class="modal-title " id="staticBackdropLabel">{{$product->product_name}}</h5>
                <p class="text-dark">{!! $product->description !!}</p>
                <p class="text-dark"> <strong>Spacification </strong> : {{ $product->weight }} </p>
                <p class="text-dark"><Strong>Price </Strong>: ${{ $product->price }}</p>
            </div>
            <div class=" ">
                <div class="row align-items-end">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <form action="{{route('product.addto.card')}}" method="POST"  >
                            @csrf 
                            <div class="d-flex">
                                <strong class="text-dark " style="margin-right:15px">Quintity : </strong>
                                <span class="carBtnModal productDicrement productsDicrement">-</span>
                                <input type="text" name="product_qty" class="carBtnModal  qty productQty"  value="1">
                                
                                <span  class="carBtnModal productIncrement productsIncrement" maxlength="10">+</span>
                            </div>
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <input type="hidden" name="unite_price" value="{{$product->price}}">
                                <input type="hidden" name="weight" value="{{$product->weight}}">
                                <input type="hidden" name="shop_id" value="{{$product->shop_id}}">
                                @if( Auth::check())
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                @endif
                            <button type="submit" class=" addToWishCard modalAdToCard w-100"><i class="fas fa-shopping-cart"></i> add to card</button>
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <form action="">
                        <button type="submit" class=" addToWishCard modalAdTowish w-100"><i class="fas fa-heart"></i> Wishlist</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('js')
<script>
    var productQty = document.querySelector(".productQty");
    var value = productQty.getAttribute("value");

    
    let productIncrement = document.querySelector(".productsIncrement");
    let productDicrement = document.querySelector(".productsDicrement");

    productIncrement.addEventListener('click', function(){
        
        if( value < 10 ){ 
            let val = value++
            let attriute = productQty;
            attriute.setAttribute("value" , value);
        }else{
            productIncrement.classList.add('cur')
        }
           
        console.log(value);
        
    })

    productDicrement.addEventListener('click', function(){
        if( value > 1){
            let val = value--;
            let attriute = productQty;
            attriute.setAttribute("value" , value);
        }else{
            productDicrement.classList.add('cur')
        }
        
    })

</script>

@endpush