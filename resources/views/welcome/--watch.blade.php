@extends('welcome.layouts.welcomeMaster')

@push('css')
@endpush

@section('content')

 


<section id="subintro">
    <div class="jumbotron subhead" id="overview">
      <div class="container">
        <div class="row">
          <div class="span8">
            <h3> Learn with sajib</h3>
            <p>Disputationi comprehensam nam ut eam id accusata explicari minim splendide duo ea dicant.</p>
          </div>
          <div class="span4">
            <div class="input-append">
              <form class="form-search">
                <input type="text" class="input-medium search-query">
                <button type="submit" class="btn btn-inverse">Search</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="maincontent">
    <div class="container">
      <div class="row">
        <div class="span8">
          
          
          

          		
          			
          		{{ $post->title }} 

          		<br>

          		@if($post->video_source == 'uploaded')

                <video width="80%" height="700" controls>
  <source src="{{ asset('storage/post/file/'. $post->video_file_name) }}" type="video/mp4">
  {{-- <source src="movie.ogg" type="video/ogg"> --}}
Your browser does not support the video tag.
</video>


			@elseif($post->video_source == 'embed')

                  {!! $post->embed_code !!}

                @endif

          		<br>
          	
       


       Category: {{ $post->category->title }}, Class: {{ $post->class->title }}, Subject: {{ $post->subject->title }}
       <br>
       {!! $post->description !!}   


       <br> 

        </div>
        <div class="span4">
          <aside>

            Related Videos 
            <br>

            @foreach($relatedPosts as $post)

            <a href="{{ route('watch',$post) }}">
                
              {{ $post->title }} 
              </a>

              <br>

<a href="{{ route('watch',$post) }}">
              @if($post->video_source == 'uploaded')

                <video width="100%" height="100" controls>
  <source src="{{ asset('storage/post/file/'. $post->video_file_name) }}" type="video/mp4">
  {{-- <source src="movie.ogg" type="video/ogg"> --}}
Your browser does not support the video tag.
</video>


      @elseif($post->video_source == 'embed')

                  {!! $post->embed_code !!}

                @endif

 </a>
              <br> <br>

            @endforeach
            

          </aside>
        </div>
        
      </div>
    </div>
  </section>


 
@endsection

@push('js')
<script type="text/javascript">  
</script>
@endpush