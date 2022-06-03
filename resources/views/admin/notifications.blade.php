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

<div class="card">
    <div class="card-body">
        <form action="{{ route('notificationPost') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <input type="file" name="image" class="form-control" name="" id="">
                </div>
                <div class="col-md-5">
                    <input type="text" name="text" class="form-control" name="" id="">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="table-responsive">


          <table class="table table-hover">


            <thead>
              <tr>
                <th>SL</th>
                <th>Image</th>
                <th>Text</th>

                <th>Action</th>
              </tr>
            </thead>

            <tbody>

                @php
                    $i=0;
                @endphp

            @foreach($notifications as $notification)


            <tr>

            	<td>{{ ++$i }}</td>
            	<td><img src="{{ asset('storage/notification/'. $notification->image) }}" class="img-fluid" style="max-width: 100px" alt=""></td>
              <td>
                 {{$notification->text}}
                </td>


            	<td>



            	<div class="btn-group btn-group-xs">

{{--
  <a class="btn btn-primary btn-xs" href="{{ route('admin.userEdit', $notification) }}">Edit</a>
  <a class="btn btn-danger btn-xs" href="{{ route('admin.userEdit', $notification) }}" onclick="return confirm('Are you sure?')">Delete</a> --}}

  <a class="btn btn-danger btn-xs" href="{{ route('admin.NotificationDelete', $notification) }}" onclick="return confirm('Are you sure?')">Delete</a>

</div>


            	</td>

            </tr>

            <?php $i++; ?>

            @endforeach
            </tbody>

          </table>


        </div>



</div>
</div>
</div>
</div>



  </section>
@endsection


@push('js')

@endpush

