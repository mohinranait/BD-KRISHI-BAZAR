<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="{{ asset('img/logo.png') }}" alt="AdminLTE Logo"
                class="img-fluid" style="width: 60px" style="opacity: .8">
            <span class="brand-text font-weight-light">Bd Krishi Bazar
            </span>
            <!-- <br>
            <p style="font-size: 10px;">কৃষি খাদ্য, কৃষি পণ্য ও গৃহপালিত <br>শু-পাখি কেনা-বেচার অনলাইন হাট।</p> -->
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Contact</a>
                </li>

                <li>
                    @auth

                    <a style="text-align: left;font-size: 18px;background: lightgray;" href="{{ url('/logout') }}"
                   onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> Logout
               </a>

               <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                   {{ csrf_field() }}
               </form>

               @if(Auth::user()->isAdmin())
               <li class="nav-item">
                <a href="{{route('admin.dashboard')}}" class="nav-link">Admin Panel</a>
            </li>
            @endif

            <li class="nav-item">
                <a href="{{route('user.dashboard')}}" class="nav-link">User Dashboard</a>
            </li>



               @else
               <a href="{{url('/register')}}" class="nav-link">Register</a>
               <li class="nav-item">
                    <a href="{{ url('/login') }}" class="nav-link">Login</a>
                </li>
               @endauth
                </li>
                {{-- <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="#" class="dropdown-item">Some action </a></li>
                        <li><a href="#" class="dropdown-item">Some other action</a></li>

                        <li class="dropdown-divider"></li>


                        <li class="dropdown-submenu dropdown-hover">
                            <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"
                                class="dropdown-item dropdown-toggle">Hover for action</a>
                            <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                <li>
                                    <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                                </li>


                                <li class="dropdown-submenu">
                                    <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"
                                        class="dropdown-item dropdown-toggle">level 2</a>
                                    <ul aria-labelledby="dropdownSubMenu3"
                                        class="dropdown-menu border-0 shadow">
                                        <li><a href="#" class="dropdown-item">3rd level</a></li>
                                        <li><a href="#" class="dropdown-item">3rd level</a></li>
                                    </ul>
                                </li>


                                <li><a href="#" class="dropdown-item">level 2</a></li>
                                <li><a href="#" class="dropdown-item">level 2</a></li>
                            </ul>
                        </li>

                    </ul>
                </li> --}}

                <li class="nav-item">
                    <a href="{{ route('blogs') }}" class="nav-link">Blog</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('terms') }}">T&C</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('frontend.shop.create') }}">Shop</a></li>
                <li class="nav-item card-icon" ><a class="nav-link" href="{{route('card.page')}}"><i class="fas fa-shopping-cart"><span class="card-count badge badge-danger">{{ App\Model\Card::cardItemCount() }}</span></i></a></li>
            </ul>

            <!-- SEARCH FORM -->
            {{-- <form class="form-inline ml-0 ml-md-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form> --}}
        </div>

        <!-- Right navbar links -->
        <!-- <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

            <li class="nav-item">
                <a href="{{ route('user.ads') }}" class="nav-link btn btn-warning">POST YOUR ADS</a>
            </li>

        </ul> -->
    </div>
</nav>

@push('js')
<script>
      $(document).ready(function() {






$('#load_district1').change(function() {
    if ($(this).val() != '') {
        var select = $(this).attr("id");
        var value = $(this).val();
        var dependent = $(this).data('dependent');
        var _token = $('input[name="_token"]').val();

        $.ajax({
            url: "{{ route('load_thana.fetch') }}",
            method: "POST",
            data: {
                select: select,
                value: value,
                _token: _token,
                dependent: dependent
            },

            success: function(response) {
                if (response.success) {
                    $(".load_thana1").empty().append($('<option>', {
                        value: '',
                        text: 'Select Thana'
                    }));

                    $.each(response.datas, function(i, item) {
                        $('.load_thana1').append($('<option>', {
                            value: item.id,
                            text: item.name
                        }));
                    });
                }
            }

        })
    }
});

$('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

});
</script>

@endpush
