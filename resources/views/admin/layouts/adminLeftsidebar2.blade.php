
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-2">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link bg-primary">
      {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"> --}}
      <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('cp/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>
 --}}
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-compact" data-widget="treeview" role="menu" data-accordion="true">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item has-treeview {{ session('lsbm') == 'dashboard' ? ' menu-open ' : '' }}">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                {{ __('Dashboard') }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item ">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ session('lsbsm') == 'dashboard' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Dashboard') }}</p>
                </a>
              </li>

             <!--  <li class="nav-item ">
                <a href="{{ route('admin.companiesAll') }}" class="nav-link {{ session('lsbsm') == 'companiesAll' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('All Companies') }}</p>
                </a>
              </li>   -->
<!-- learn with s -->
               <li class="nav-item ">
                <a href="{{ route('admin.newCatagoryCreate') }}" class="nav-link {{ session('lsbsm') == 'newCatagoryCreate' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Add New Category') }}</p>
                </a>
              </li>

              <li class="nav-item ">
                <a href="{{ route('admin.catagoriesAll') }}" class="nav-link {{ session('lsbsm') == 'catagoriesAll' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('All Catagory') }}</p>
                </a>
              </li>


              <li class="nav-item ">
                <a href="{{ route('admin.newSubCatagoryCreate') }}" class="nav-link {{ session('lsbsm') == 'newSubCatagoryCreate' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Add New Sub Category') }}</p>
                </a>
              </li>

              <li class="nav-item ">
                <a href="{{ route('admin.subcatagoriesAll') }}" class="nav-link {{ session('lsbsm') == 'subcatagoriesAll' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('All Sub Catagory') }}</p>
                </a>
              </li>

               {{-- <li class="nav-item ">
                <a href="{{ route('admin.newClassCreate') }}" class="nav-link {{ session('lsbsm') == 'newClassCreate' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Add New Class') }}</p>
                </a>
              </li> --}}

              {{-- <li class="nav-item ">
                <a href="{{ route('admin.classesAll') }}" class="nav-link {{ session('lsbsm') == 'classesAll' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('All Class') }}</p>
                </a>
              </li> --}}

               {{-- <li class="nav-item ">
                <a href="{{ route('admin.newSubjectCreate') }}" class="nav-link {{ session('lsbsm') == 'newSubjectCreate' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Add New Subject') }}</p>
                </a>
              </li> --}}

              {{-- <li class="nav-item ">
                <a href="{{ route('admin.subjectsAll') }}" class="nav-link {{ session('lsbsm') == 'subjectsAll' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('All Subject') }}</p>
                </a>
              </li> --}}

              {{-- <li class="nav-item ">
                <a href="{{ route('admin.newDemoCreate') }}" class="nav-link {{ session('lsbsm') == 'newDemoCreate' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Add New Demo') }}</p>
                </a>
              </li> --}}

              {{-- <li class="nav-item ">
                <a href="{{ route('admin.demoAll') }}" class="nav-link {{ session('lsbsm') == 'demoAll' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('All Demo') }}</p>
                </a>
              </li> --}}



              <!-- <li class="nav-item ">
                <a href="{{ route('admin.companyAddNew') }}" class="nav-link {{ session('lsbsm') == 'companyAddNew' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Create New Company') }}</p>
                </a>
              </li> -->

              <li class="nav-item ">
                <a href="{{ route('admin.usersAll') }}" class="nav-link {{ session('lsbsm') == 'usersAll' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('All Users') }}</p>
                </a>
              </li>

              <li class="nav-item ">
                <a href="{{ route('admin.newUserCreate') }}" class="nav-link {{ session('lsbsm') == 'newUserCreate' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Add New User') }}</p>
                </a>
              </li>
              {{-- <li class="nav-item ">
                <a href="{{ route('admin.allPendingPayments') }}" class="nav-link {{ session('lsbsm') == 'allPendingPayments' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Pending Payments') }}</p>
                </a>
              </li> --}}

              {{-- <li class="nav-item ">
                <a href="{{ route('admin.allNotifications') }}" class="nav-link {{ session('lsbsm') == 'allNotifications' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Notification') }}</p>
                </a>
              </li> --}}

                <li class="nav-item ">
                <a href="{{ route('admin.newPostCreate') }}" class="nav-link {{ session('lsbsm') == 'newPostCreate' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('Add New Post') }}</p>
                </a>
              </li>

              <li class="nav-item ">
                <a href="{{ route('admin.postsAll') }}" class="nav-link {{ session('lsbsm') == 'postsAll' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('All Post') }}</p>
                </a>
              </li>

              <li class="nav-item ">
                <a href="{{ route('admin.allapproveUserAds') }}" class="nav-link {{ session('lsbsm') == 'allapproveUserAds' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('User Ads (Aproved)') }}</p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="{{ route('admin.allpendingUserAds') }}" class="nav-link {{ session('lsbsm') == 'allpendingUserAds' ? ' active ' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ __('User Ads (pending)') }}</p>
                </a>
              </li>

            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
