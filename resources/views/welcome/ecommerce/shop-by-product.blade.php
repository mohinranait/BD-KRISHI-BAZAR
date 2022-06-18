

@extends('welcome.layouts.welcomeMaster')
@push('css')
<style>
    .banner-content {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-top: 0px !important;
    }
    
</style>

@endpush

@section('content')

    <div class="shop-banner-section mt-5 mb-3" style=" background-image: url('{{asset('img/shop/'. $shop->shop_cover_photo)}}');">
        <div class="shop-overlay"></div>
        <div>
            <div class="row ">
                <div class="col-lg-12 ">
                    <h1 class="text-center py-4 text-white"> {{$shop->shop_name}} </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="d-flex shop-owner-info">
                <img src="{{asset('img/shop/'. $shop->shop_user_profile)}}" alt="">
                <h3> {{$shop->shop_email}}</h3>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="text-righ">
                <h4 class="text-md-right text-sm-left ">Contact Information</h4>
                <p class="text-md-right text-sm-left mb-1"><strong>Phone</strong> : {{$shop->shop_phone}}</p>
                <p class="text-md-right text-sm-left "><strong>Email</strong> : {{$shop->shop_email}}</p>
            </div>
        </div>
    </div>

    <div class="row   mb-5">
        <div class="col-lg-12 mb-4 ">
            <div class="row justify-content-center ">
                <h2 class="p-4 text-center w-100">আপনার প্রডাক্ট খুজন এখানে</h2>
                <div class="col-lg-7">
                    
                        <div id="serach-product-div ">
                            <input type="text" name="searchproduct" class="search-product-input" id="shopproductsearch" placeholder="Find your products" >
                            <button type="submit" class="search-product-btn search-btn"  >Search</button>
                        </div>
                  
                </div>
            </div>
            
           

        </div>

       

        

        @if( $products->count() == 0 )
            <div class="alert alert-info w-100 text-center">
                No product Found <strong>{{$shop->shop_name}}</strong>
            </div>
        @endif
        
    </div>

    <div class="productcard">
        <div class="row   ">

            <!-- product items -->
            @foreach( $products as $item)
            <div class="col-lg-2 col-md-3 col-sm-4 col-6" style="padding:2px">
                <a  class="product-link-color">
                    <div class="produt-item"  >
                        <a href="{{route('products' , $item->slug)}}" class="product-link">
                            <div class="product-header" >
                                <img class="product-img" src="{{asset('img/product/'. $item->product_image )}}" width="100%" alt="">
                            </div>
                            <div class="product-body" >
                                <p class="product-title ">{{$item->product_name}}</p>
                               
                                <p class="product-price d-flex justify-content-around "><span>{{$item->weight}}</span><strong>$ {{ $item->price }} </strong>  </p>
                            </div>
                        </a>
                        <div class="product-footer">
                          
                                
                            <div class=" product-add-form d-flex justify-content-between align-items-center">
                                <form action="{{route('product.decremen')}}" method="POST">
                                    @csrf 
                                    <input type="hidden" name="product_id" value="{{$item->id}}">
                                    <input type="hidden" name="unite_price" value="{{$item->price}}">
                                    <input type="hidden" name="weight" value="{{$item->weight}}">
                                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                                    <input type="hidden" name="product_qty" value="1">
                                    @if( Auth::check())
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    @endif
                                    <button class="proAdBtn decBtn">-</button>
                                </form>                                   
                                <span class="addToCardShow" data-toggle="modal" data-target="#opnModel{{$item->id}}">
                                    @foreach(App\Model\Card::where('product_id', $item->id)->where('ip_address', Request::ip() )->where('order_id',NULL)->where("product_qty","!=", 0)->get() as $show)
                                    {{$show->product_qty}} 
                                    @endforeach
                                add item</span>
                                <form action="{{route('product.incremen')}}" method="POST">
                                    @csrf 
                                    <input type="hidden" name="product_id" value="{{$item->id}}">
                                    <input type="hidden" name="unite_price" value="{{$item->price}}">
                                    <input type="hidden" name="weight" value="{{$item->weight}}">
                                    <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                                    <input type="hidden" name="product_qty" value="1">
                                    @if( Auth::check())
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    @endif
                                    <button class="proAdBtn incBtn">+</button>
                                </form>
                                   
                            </div>
                                
                            
                        </div>
                    </div>
                </a>
                <!-- Modal code start -->
                <div class="modal fade" id="opnModel{{$item->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl  ">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>

                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="product-img-modal">
                                            <img src="{{asset('img/product/'. $item->product_image )}}" width="100%" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="modal-product-content">
                                            <h5 class="modal-title " id="staticBackdropLabel">{{$item->product_name}}</h5>
                                            <p class="text-dark">{!! $item->description !!}</p>
                                            <p class="text-dark"> <strong>Spacification </strong> : {{$item->weight}}</p>
                                            <p class="text-dark"><Strong>Price </Strong>: $ {{ $item->price }}</p>
                                        </div>
                                        <div class=" ">
                                            <div class="row align-items-end">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <form action="">
                                                        <div class="d-flex">
                                                            <strong class="text-dark">Quintity : </strong>
                                                            <span class="carBtnModal productDicrement">-</span>
                                                            <input type="text" name="" class="carBtnModal  qty" disabled value="1">
                                                            
                                                            <span  class="carBtnModal productIncrement" maxlength="10">+</span>
                                                        </div>
                                                            
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
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal code end -->
            </div>
            @endforeach
        

        </div>
    </div>
    

    <!-- This input value is current shop page id -->
  <input type="hidden" name='pageid' id="pageid" value="{{$shop->id}}">


@endsection


@push('js')


<script>
     // Search product this shop
    $(document).ready(function(){
        $("#shopproductsearch").on('keyup', function(e){
            e.preventDefault();
            var search_value = $("#shopproductsearch").val();
            var id = $("#pageid").val();
            console.log(id);
            $.ajax({
                url: "/realtime-shop-search-by-product/"+id,
                method:"GET",
                data:{search_value:search_value},
                success:function(res){
                    $('.productcard').html(res);
                    if( res.status == "nothing"){
                        $('.productcard').html("<div class=' alert alert-info text-center'>"+ 'No Product found' + " </div>")
                    }
                }
            })
        })
    })
</script>

<script>
    var productQty = document.querySelector(".qty");
    var value = productQty.getAttribute("value");

    
    let productIncrement = document.querySelector(".productIncrement");
    let productDicrement = document.querySelector(".productDicrement");

    productIncrement.addEventListener('click', function(){
        
        if( value < 10 ){ 
            let val = value++
            let attriute = productQty;
            attriute.setAttribute("value" , value);
        }else{
            productIncrement.classList.add('cur')
        }
        
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