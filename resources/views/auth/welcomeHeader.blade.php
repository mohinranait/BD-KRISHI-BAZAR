  <header>
    <!-- Navbar
    ================================================== -->
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <!-- logo -->
          <a class="brand logo" href="{{url('/home')}}">
            <!-- <img src="{{asset('sf/assets/img/logo.png')}}" alt="" /> -->
            <h1>Tech heron file</h1>
          </a>
          <!-- end logo -->

          <!-- top menu -->
          <div>
            <nav>
              <ul class="nav topnav">
                <li class="dropdown success active">
                  <a href="{{url('/home')}}"><i class="icon-home icon-white"></i> Home</a>

                </li>

                <li class="dropdown demo">
                    <a href="#"><i class="icon-leaf icon-white"></i> Demo</a>
                    <ul class="dropdown-menu">

                        @foreach($subjts as $sub)

                      <li><a href="{{route('welcome.demoPage', $sub)}}">{{$sub->title}}</a></li>

                      @endforeach

                      <li><a href="https://www.youtube.com/watch?v=RTPYcj3_fSQ">Demo Video</a></li>

                    </ul>
                  </li>


                @if (Auth::user())
                    
                  <li class="dropdown danger">
                    <a href="#"><i class="icon-leaf icon-white"></i> Font</a>
                    <ul class="dropdown-menu">

                      
                      <li><a href="https://youtu.be/soBgShUKEUA">PC Font install</a></li>
                      <li><a href="https://youtu.be/6KeSLW0K0vE">Mobile font install</a></li>

                    </ul>
                  </li>
                @endif
                <!-- <li class="dropdown warning">
                  @auth
                  <a href="#"><i class="icon-camera icon-white"></i> Web</a>
                  <ul class="dropdown-menu">
                    <li class="dropdown"><a href="/java/page">Java</a>
                    </li>

                    <li class="dropdown"><a href="/ewa">Data Center</a>
                    </li>

                    <li class="dropdown"><a href="/embassy">Embassy</a>
                    </li>

                    <li class="dropdown"><a href="/visa">Visa Center</a>
                    </li>

                    <li class="dropdown"><a href="/ewa">Basic Java</a>
                      <ul class="dropdown-menu sub-menu">
                        <li><a href="">Page 1</a></li>
                        <li><a href="">Page 2</a></li>
                        <li><a href="">Page 3</a></li>
                      </ul>
                    </li>

                    <li class="dropdown"><a href="#">Selenium</a>
                      <ul class="dropdown-menu sub-menu">
                        <li><a href="">Page 1</a></li>
                        <li><a href="">Page 2</a></li>
                        <li><a href="">Page 3</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"><a href="#">Cucumber</a>
                      <ul class="dropdown-menu sub-menu">
                        <li><a href="">Page 1</a></li>
                        <li><a href="">Page 2</a></li>
                        <li><a href="">Page 3</a></li>
                      </ul>
                    </li>

                    <li class="dropdown"><a href="#">TestNG</a>
                      <ul class="dropdown-menu sub-menu">
                        <li><a href="">Page 1</a></li>
                        <li><a href="">Page 2</a></li>
                        <li><a href="">Page 3</a></li>
                      </ul>
                    </li>

                  </ul>
                  @endif
                </li> -->
                <li class="inverse">
                  <a href="https://www.facebook.com/techheronfile"><i class="icon-envelope icon-white"></i> Contact</a>
                </li>

                <li class="inverse">

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
<li class="primary">
  <a href="{{route('admin.dashboard')}}">Admin Panel</a>
</li>
@endif

                  @else
                  <li style="background-color: #f8b601;"><a style="color: white;" href="{{url('/login')}}">Login</a></li>
                  <li style="background-color: #009cea;" ><a style="color: white;" href="{{url('/register')}}">Registration</a></li>


                  @endauth
                </li>




              </ul>



            </nav>
          </div>
          <!-- end menu -->
        </div>
      </div>
    </div>
  </header>
