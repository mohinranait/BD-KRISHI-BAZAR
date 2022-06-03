@extends('admin.layouts.adminMaster')

@push('css')
@endpush

@section('content')
  <section class="content">

  	<br>


  	<div class="row">

      <div class="col-sm-12">
  @include('alerts.alerts')

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              All SubCatagories
            </h3>
          </div>
          <div class="card-body">



<div class="table-responsive">


          <table class="table table-hover">


            <thead>
              <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Category Name</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>

              <?php $i = 1; ?>

              <?php $i = (($catagoriesAll->currentPage() - 1) * $catagoriesAll->perPage() + 1); ?>

            @foreach($catagoriesAll as $user)

<!-- {{$user}} -->
            <tr>

              <td>{{ $i }}</td>
              <td>{{ $user->title }}</td>
              <td>{{ $user->cat->title }}</td>
              <td>{{ $user->active ? 'Active' : 'Inactive' }}</td>
              <td>
              <div class="btn-group btn-group-xs">
  {{-- <a class="btn btn-primary btn-xs" href="{{ route('admin.catagoryEdit', $user) }}">Edit</a> --}}
  <a class="btn btn-primary btn-xs" href="{{ route('admin.subcatagorydelete', $user->id)}}">Delete</a>
</div>


              </td>

            </tr>

            <?php $i++; ?>

            @endforeach
            </tbody>

          </table>

          {{ $catagoriesAll->render() }}

        </div>


</div>
</div>
</div>
</div>



  </section>
@endsection


@push('js')

@endpush

