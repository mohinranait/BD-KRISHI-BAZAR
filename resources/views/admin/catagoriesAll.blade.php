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
              All Catagories
            </h3>
          </div>
          <div class="card-body">



<div class="table-responsive">


          <table class="table table-hover">


            <thead>
              <tr>
                <th>SL</th>
                <th>Image</th>
                <th>Name</th>
                <th>Status</th>
                <th>Priority Value</th>
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
              <td>
                @if( $user->image )
                <img src="{{asset('img/category/' . $user->image)}}" style="width:40px;" alt="">
                @else
                @endif
              </td>
              <td>{{ $user->title }}</td>
              <td>{{ $user->active ? 'Active' : 'Inactive' }}</td>
              <td class="btn btn-secondary btn-block" data-toggle="modal" data-target="#userPosition{{ $user->id }}">{{ $user->position }}</td>

              <td>



              <div class="btn-group btn-group-xs">

  <a class="btn btn-primary btn-xs" href="{{ route('admin.catagoryEdit', $user) }}">Edit</a>
  <a class="btn btn-primary btn-xs" href="{{ route('admin.catagorydelete', $user->id)}}">Delete</a>


</div>


              </td>

            </tr>

            <?php $i++; ?>


            <div class="modal fade" id="userPosition{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="userPositionLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="userPositionLabel">Update Position</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="{{ route('catPpPosition', $user) }}" method="POST">
                      @csrf
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="">Priority Value</label>
                          <input type="number" class="form-control" name="position" value="{{ $user->position }}">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

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

