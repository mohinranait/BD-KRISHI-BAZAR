@extends('admin.layouts.adminMaster')

@push('css')
<style>
    .line{
  line-height:1.2em !important;
  height:3.6em !important;
  overflow:hidden !important;
}
</style>
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
              All Posts
            </h3>
          </div>
          <div class="card-body">



<div class="table-responsive">


          <table class="table table-hover">


            <thead>
              <tr>
                <th>SL</th>
                <th>Image</th>
                <th>Post Title</th>
               <td>Description</td>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>


          <?php $i = (($postsAll->currentPage() - 1) * $postsAll->perPage() + 1); ?>
              @foreach($postsAll as $post)




            <tr>

              <td>{{ $i }}</td>
              <td>
                <img src="{{ asset('storage/post/file/feature/'. $post->feature_image) }}" class="img-fluid" alt="{{ $post->feature_image }}">

              </td>
              <td>{{ $post->title }}</td>
              <td><p class="line">{{strip_tags($post->description)}}</p> </td>




              <td>



              <div class="btn-group btn-group-xs">


  <a class="btn btn-primary btn-xs" href="{{ route('admin.postEdit', $post) }}">Edit</a>
  <a class="btn btn-primary btn-xs" href="{{ route('admin.postdelete', $post) }}">Delete</a>


</div>


              </td>

            </tr>

            <?php $i++; ?>

            @endforeach


            </tbody>

          </table>
          {{ $postsAll->links() }}


        </div>


</div>
</div>
</div>
</div>



  </section>
@endsection


@push('js')

@endpush

