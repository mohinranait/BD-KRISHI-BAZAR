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
              All classes
            </h3>
          </div>
          <div class="card-body">



<div class="table-responsive">
          

          <table class="table table-hover">


            <thead>
              <tr>
                <th>SL</th>
                <th></th>
                <th>Name</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody> 

              <?php $i = 1; ?>

              <?php $i = (($classesAll->currentPage() - 1) * $classesAll->perPage() + 1); ?>

            @foreach($classesAll as $user)        

<!-- {{$user}} -->

            <tr>

              <td>{{ $i }}</td>
              <td>
                @if($user->feature_img_name)
                <img width="80" src="{{asset('storage/class/file/'.$user->feature_img_name)}}">
                @endif
              </td>
              <td>{{ $user->title }}</td>
              <td>{{ $user->active ? 'Active' : 'Inactive' }}</td>

              <td>

                

              <div class="btn-group btn-group-xs">
  

  <a class="btn btn-primary btn-xs" href="{{ route('admin.classEdit', $user) }}">Edit</a>
  <a class="btn btn-primary btn-xs" href="{{ route('admin.classdelete', $user) }}">Delete</a>


</div>
                

              </td>
              
            </tr>

            <?php $i++; ?>

            @endforeach 
            </tbody>

          </table>

          {{ $classesAll->render() }}

        </div>


</div>
</div>
</div>
</div>


  
  </section>
@endsection


@push('js')

@endpush

