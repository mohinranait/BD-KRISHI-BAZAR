@extends('admin.layouts.adminMaster')

@push('css')
@endpush

@section('content')
  <section class="content">

  	<br>


  	<div class="row">

      <div class="col-sm-12">

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              All Users
            </h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 text-right">
                <a class="btn btn-primary" href="{{route('admin.newUserCreate')}}">Add new user</a>

              </div>

            </div>

          </div>
          <div class="card-body">
            @include('alerts.alerts')




<div class="table-responsive">


          <table class="table table-hover">


            <thead>
              <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Package</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Status</th>
                <th>Mail</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>

              <?php $i = 1; ?>

              <?php $i = (($usersAll->currentPage() - 1) * $usersAll->perPage() + 1); ?>

            @foreach($usersAll as $user)


            <tr>

            	<td>{{ $i }}</td>
            	<td>{{ $user->name }}</td>
              <td>
                  @if($user->userPackage())
                  {{$user->userPackage()->package_title}}
                  @else
                  No Package
                  @endif
                </td>
            	<td>{{ $user->email }}</td>
            	<td>{{ $user->mobile }}</td>
            	<td>{{ $user->active ? 'Active' : 'Inactive' }}</td>
                <td><a class="btn btn-info" href="{{ route('admin.mail1', $user) }}">Mail 1</a>
                    <a class="btn btn-info" href="{{ route('admin.mail2', $user) }}">Mail 2</a>
                    <a class="btn btn-info" href="{{ route('admin.mail3', $user) }}">Mail 3</a>
                </td>

            	<td>



            	<div class="btn-group btn-group-xs">


  <a class="btn btn-primary btn-xs" href="{{ route('admin.userEdit', $user) }}">Edit</a>
  <a class="btn btn-danger btn-xs" href="{{ route('admin.userDelete', $user) }}" onclick="return confirm('Are you sure?')">Delete</a>



</div>


            	</td>

            </tr>

            <?php $i++; ?>

            @endforeach
            </tbody>

          </table>

          {{ $usersAll->render() }}

        </div>



</div>
</div>
</div>
</div>



  </section>
@endsection


@push('js')

@endpush

