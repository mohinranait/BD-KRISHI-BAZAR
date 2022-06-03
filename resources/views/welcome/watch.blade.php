@extends('welcome.layouts.welcomeMaster')

@push('css')
@endpush

@section('content')

 
 

<section id="subintro">
    <div class="jumbotron subhead" id="overview">
      <div class="container">
        <div class="row">
          <div class="span8">
            <h3>Easy Way Automation</h3>
            <p>সহজ করে অটোমেশান শিখি</p>
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

@if(Auth::user()->active)      
      <div class="row-fluid"> 

        <div class="span8">


          <h1 style="margin-bottom: -5px;">
            
          {{ $post->title }} 
          </h1>

              <br>

              @if($post->video_source == 'uploaded')

<!--                 <video width="100%" height="400" controls>
  <source src="{{ asset('storage/post/file/'. $post->video_file_name) }}" type="video/mp4">
 
Your browser does not support the video tag.
</video> -->

<video width="95% !important" controls controlsList="nodownload">
  <source src="{{ asset('storage/post/file/'. $post->video_file_name) }}" type="video/mp4">
  <!-- <source src="mov_bbb.ogg" type="video/ogg"> -->
  Your browser does not support HTML video.
</video>



      @elseif($post->video_source == 'embed')

                  {!! $post->embed_code !!}

                @endif

              <br>
            
       


       Category: {{ $post->category->title }}, Class: {{ $post->class->title }}, Subject: {{ $post->subject->title }}
       <br>

       @if($post->document_file_name)
                <a href="{{asset('storage/post/file/'.$post->document_file_name)}}" download>Document Download</a>
                @endif

       <br>
       {!! $post->description !!}   




       <br> 



        </div>



        <div class="span4">
         <aside>

            <h4>Selenium WebDriver</h4>


          <div class="accordion" id="accordion2">


             
   
            @foreach($categories as $cat)


            <div class="accordion-group">
              <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse{{$cat->id}}">
            {{$loop->iteration}}. {{$cat->title}}
            </a>
              </div>
              <div id="collapse{{$cat->id}}" class="accordion-body collapse">
                  @foreach($cat->catSubPosts($post->class_id,$post->subject_id,10) as $post)
                <div style=" background: #ffbb00;" class="accordion-inner">

                  <h4 style="font-size: 16px; color: white !important;">
                   <a style="color: white; text-decoration: none;" href="{{ route('watch',$post) }}">
                
              <p><u>{{ $post->title }}</u></p> 
              <p>{{$post->subject_id ? $post->subject->title : ''}} ({{$post->class_id ? $post->class->title : ''}})</p>

              </a>
           
              @if($post->document_file_name)
              <div style="margin-top: 4px;" class="btn"><a style="text-decoration: none;" href="{{asset('storage/post/file/'.$post->document_file_name)}}" download>Download</a></div>
                
                @endif

                </h4>
                </div>
                  @endforeach
              </div>
            </div>


           


              @endforeach



             
             
          </div>
          </aside>
        </div>

      </div>  


  @else

<h2>You have no permission to watch any video</h2>

@endif        
    </div>
       
  </section>


 
@endsection

@push('js')
<script type="text/javascript">  
</script>
@endpush