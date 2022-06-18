                    @foreach( $shops as $item)
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                        <a href="{{route('ShopByProduct' , $item->slug)}}">
                            <div class="card" >
                                <img src="{{asset('img/shop/' . $item->shop_logo)}}" class="card-img-top" alt="...">
                                <div class="card-body text-center" style="padding:9px 5px">
                                    <h5 class="card-title card-titel-center ">{{ $item->shop_name}}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach