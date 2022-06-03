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
              All Sliders
            </h3>
          </div>
          <div class="card-body">
             <form action="{{ route('admin.sliderPost') }}" method="POST" enctype="multipart/form-data">
                 @csrf
                <div class="row">
                    <div class="col-md-10">
                        <input type="file" class="form-control" name="image" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-info btn-block">Submit</button>
                    </div>

                </div>
             </form>
          </div>
          <div class="card-body">



<div class="table-responsive">


          <table class="table table-hover">


            <thead>
              <tr>
                <th>SL</th>
                <th>Image</th>
                <th>Status</th>

                <th>Action</th>
              </tr>
            </thead>

            <tbody>

              <?php $i = 1; ?>


            @foreach($sliders as $slide)

<!-- {{$slide}} -->
            <tr>

              <td>{{ $i }}</td>
              <td>
                @if( $slide->file )
                <img src="{{asset('storage/slider/' . $slide->file)}}" style="width:40px;" alt="">
                @else
                @endif
              </td>
              <td>{{ $slide->status ? 'Active' : 'Inactive' }}</td>

              <td>



              <div class="btn-group btn-group-xs">

  <a class="btn btn-primary btn-xs" href="{{ route('admin.sliderdelete', $slide->id)}}">Delete</a>
  <a href="{{ route('admin.updateStatus', $slide) }}" class="btn btn-warning">{{ $slide->status ? 'Inactive' : 'Active' }}</a>


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

