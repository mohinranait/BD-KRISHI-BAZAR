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
              All User Ads
            </h3>
          </div>
          <div class="card-body">
<div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>IMG</th>
                <th>Category</th>
                <th>Sub Category</th>

                <th>Status</th>
                <th>Location</th>
                @isset($aprv)
                <th>Priority Value</th>

                @endisset
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

               @isset($p_ads)
               @foreach($p_ads as $post)
               <tr>
                 <td>{{ $post->title }}</td>
                 <td>{{ $post->description }}</td>
                 <td>{{ $post->price }}</td>

                 <td>
                   @if($post->image)
                   <a href="{{asset('storage/subject/file/'.$post->image)}}" download><img src="{{asset('storage/subject/file/'.$post->image)}}" class="img-fluid" alt=""></a>
                   @endif
                 </td>
                 <td>{{ $post->cat->title }}</td>
                 <td>{{$post->subCat? $post->subCat->title:"" }}</td>
                 <td>{{ $post->active }}</td>
                 <td>{{ $post->district!=null? $post->pdistrict->name:"" }}, {{ $post->thana!=null? $post->pthana->name:"" }}</td>
                 @isset($aprv)

                 {{-- <td>{{ $post->position }}</td> --}}
                 <td class="btn btn-secondary btn-block" data-toggle="modal" data-target="#userPosition{{ $post->id }}">{{ $post->position }}</td>
                 @endisset

                 <td>



                 <div class="btn-group btn-group-xs">


     <a class="btn btn-primary btn-xs" href="{{ route('admin.approveEdit', $post) }}">{{ $post->active?"Decline":"Approve" }}</a>
     <a class="btn btn-primary btn-xs" href="{{ route('admin.adsdelete', $post) }}" onclick="return confirm('Confirm?')">Delete</a>


   </div>


                 </td>

               </tr>

               <div class="modal fade" id="userPosition{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="userPositionLabel" aria-hidden="true">
                   <div class="modal-dialog" role="document">
                     <div class="modal-content">
                       <div class="modal-header">
                         <h5 class="modal-title" id="userPositionLabel">Update Position</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                       </div>
                       <form action="{{ route('postPpPosition', $post) }}" method="POST">
                         @csrf
                         <div class="modal-body">
                           <div class="form-group">
                             <label for="">Priority Value</label>
                             <input type="number" class="form-control" name="position" value="{{ $post->position }}">
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
               @endisset
              @foreach($ads as $post)
            <tr>
              <td>{{ $post->title }}</td>
              <td>{{ $post->description }}</td>
              <td>{{ $post->price }}</td>

              <td>
                @if($post->image)
                <a href="{{asset('storage/subject/file/'.$post->image)}}" download><img src="{{asset('storage/subject/file/'.$post->image)}}" class="img-fluid" alt=""></a>
                @endif
              </td>
              <td>{{ $post->cat->title }}</td>
              <td>{{$post->subCat? $post->subCat->title:"" }}</td>
              <td>{{ $post->active }}</td>
              <td>{{ $post->district!=null? $post->pdistrict->name:"" }}, {{ $post->thana!=null? $post->pthana->name:"" }}</td>
              @isset($aprv)

              {{-- <td>{{ $post->position }}</td> --}}
              <td class="btn btn-secondary btn-block" data-toggle="modal" data-target="#userPosition{{ $post->id }}">{{ $post->position }}</td>
              @endisset

              <td>



              <div class="btn-group btn-group-xs">


  <a class="btn btn-primary btn-xs" href="{{ route('admin.approveEdit', $post) }}">{{ $post->active?"Decline":"Approve" }}</a>
  <a class="btn btn-primary btn-xs" href="{{ route('admin.adsdelete', $post) }}" onclick="return confirm('Confirm?')">Delete</a>


</div>


              </td>

            </tr>

            <div class="modal fade" id="userPosition{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="userPositionLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="userPositionLabel">Update Position</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="{{ route('postPpPosition', $post) }}" method="POST">
                      @csrf
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="">Priority Value</label>
                          <input type="number" class="form-control" name="position" value="{{ $post->position }}">
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


        </div>


</div>
</div>
</div>
</div>



  </section>
@endsection


@push('js')

@endpush

