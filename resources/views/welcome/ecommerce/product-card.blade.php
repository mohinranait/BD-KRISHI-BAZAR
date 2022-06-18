<div class="row   ">

<!-- product items -->
@foreach( $products as $item)
    <div class="col-lg-2 col-md-3 col-sm-4 col-6" style="padding:2px">
        <a  class="product-link-color">
            <div class="produt-item"  >
                <a href="{{route('products' , $item->id)}}" class="product-link">
                    <div class="product-header" >
                        <img class="product-img" src="{{asset('img/product/'. $item->product_image )}}" width="100%" alt="">
                    </div>
                    <div class="product-body" >
                        <p class="product-title ">{{$item->product_name}}</p>
                        <p class="product-price d-flex justify-content-around "><span>{{$item->weight}}</span><strong>$ {{ $item->price }} </strong>  </p>
                    </div>
                </a>
                <div class="product-footer">
                    <form action="" class="product-add-form">
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="CardBtn" id="proDec">-</button>
                            <span class="addToCardShow" data-toggle="modal" data-target="#opnModel{{$item->id}}">2 <i class="fas fa-shopping-bag"></i></span>
                            <button type="submit" class="CardBtn" id="proInc">+</button>
                        </div>
                    </form>
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