<div class="left-sidebar-group">
    <div class="account-title">
        <h3>My Dashboard</h3>
    </div>
    <li><a href="{{route('user.myPost')}}"><i class="fas fa-ad"></i> My Ads</a></li>
    <li><a href="{{route('user.product')}}"><i class="fas fa-list-alt"></i> Product list</a></li>
    @if(App\Model\ShopInformation::where('shop_user_id', Auth::id())->count() == 1)
    @foreach (App\Model\ShopInformation::where('shop_user_id', Auth::user()->id )->get() as $shops )
    <li><a href="{{route('user.product.add' , $shops->id)}}"><i class="fas fa-shopping-cart"></i> Add product</a></li>
    <li><a href="{{route('frontend.shop.edit' , $shops->slug)}}"><i class="fa fa-edit"></i> Shop Customize</a></li>
    @endforeach

    @else 
    <li><a href="{route('frontend.shop.create')}"><i class="far fa-credit-card"></i> New Shop</a></li>
    @endif
    <li><a href="#"><i class="far fa-credit-card"></i> Payment method</a></li>

    <li><a href="#"><i class="fas fa-cog"></i> Setting</a></li>
    
    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    <li><a href="{{ url('/logout') }}"  onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Sign out</a></li>
</div>

