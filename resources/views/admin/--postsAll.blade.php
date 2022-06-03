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
              All Posts
            </h3>
          </div>
          <div class="card-body">



<div class="table-responsive">
          

          <table class="table table-hover">


            <thead>
              <tr>
                <th>SL</th>
                <th>Post Title</th>
                <th>Video Source</th>
                <th>Uploaded Video</th>
                <th>Embed Video</th>
                <th>Category</th>
                <th>Class</th>
                <th>Subject</th>
                <th>Document</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody> 


<?php $i = (($postsAll->currentPage() - 1) * $postsAll->perPage() + 1); ?>
              @foreach($postsAll as $post)

            


            <tr>

              <td>{{ $i }}</td>
              <td>{{ $post->title }}</td>
              <td>{{ $post->video_source }}</td>
              <td>
                @if($post->video_source == 'uploaded')

                <video width="150" height="80" controls>
  <source src="{{ asset('storage/post/file/'. $post->video_file_name) }}" type="video/mp4">
  {{-- <source src="movie.ogg" type="video/ogg"> --}}
Your browser does not support the video tag.
</video>

                @endif
              </td>
              <td>
                <!-- @if($post->video_source == 'embed')

                <div style="width:160px;height:80px;">
                  {!! $post->embed_code !!}
                </div>
                
                @endif -->
              </td>

              <td>
                @if($post->category_id)

                {{ $post->category->title }}

                @endif

              </td>
              <td>
                @if($post->class_id)
                {{ $post->class->title }}
                @endif
              </td>
              <td>
                @if($post->subject_id)
                {{ $post->subject->title }}
                @endif
              </td>
              <td>
                @if($post->publish_status)
                {{ $post->publish_status }}
                @endif
              </td>

              <td>
                @if($post->document_file_name)
                <a href="{{asset('storage/post/file/'.$post->document_file_name)}}" download>Download</a>
                @endif
              </td>

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

     

        </div>


</div>
</div>
</div>
</div>


  
  </section>
@endsection


@push('js')

@endpush

