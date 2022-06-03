

  @php
      use App\Model\Post;
      $posts=Post::latest()->paginate(18);
    //    dd(auth()->user()->pendingPackage());
  @endphp




  @push('css')
  <style>
      footer.footer {
    background: #fff;
}
  </style>

  @endpush
@guest
<footer class="footer">
    <div class="container">
        <div class="row">



         @foreach ($posts as $post )
         <div class="col-md-2">
          <div class="card">
              <div class="w3-card-body text-center">

               <a href=""> <img src="{{asset('storage/post/file/feature/'.$post->feature_image)}}" alt="" class="img-fluid"></a> <br>
               <h6 style="color: black">{{ $post->title }}</h6>
                   <h6 style="color: black">Price: {{ $post->price }} BDT</h6>

                   <div class="row">
                       <div class="col-md-6">
                        <a  href="{{ url('/packeges')}}"
                        class="btn btn-success">Download</a>>
                       </div>
                       <div class="col-md-6">
                        <a href="{{ route('postDetails', $post) }}" class="btn btn-info">View</a>
                    </div>
                   </div>




              </div>
          </div>
          <br>
      </div>

         @endforeach




        </div>
    </div>

    <div class="verybottom" style="max-height: 50px">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p style="padding: 5px;">&copy; Tech Heron - All right reserved</p>
                </div>
                <div class="col-md-6">
                    <div class="text-right">
                        <div class="credits">
                            <!--
                All the links in the footer should remain intact.
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Scaffold
              -->
                             <p style="padding: 5px;"> Designed by <a href="https://webseobd.com/">Web SEO BD</a></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</footer>
@else


    <footer class="footer">
        <div class="container">
            <div class="row">




             @foreach ($posts as $post )
             <div class="col-md-2">
              <div class="card">
                  <div class="w3-card-body text-center">

                   <a href=""> <img src="{{asset('storage/post/file/feature/'.$post->feature_image)}}" alt="" class="img-fluid"></a> <br>
                   <h6 style="color: black">{{ $post->title }}</h6>
                   <h6 style="color: black">Price: {{ $post->price }} BDT</h6>
                 <div class="row">
                     <div class="col-md-6">
                        @auth
                        @if(auth()->user()->isValidate())
                         @if($post->document_file_name==null)
                         <a href="{{ $post->link }}" class="btn btn-success">Download</a>
                         @else
                         <a  href="storage/post/file/{{ $post->document_file_name }}"
                             download="{{ $post->document_file_name }}" class="btn btn-success">Download</a>
                             @endif

                       @else
                       <a  href="{{ url('/packeges')}}"
                           class="btn btn-success">Download</a>
                           @endif

                         @else
                         {{-- <a href="" class="btn btn-success">Download</a> --}}
                        @endauth
                     </div>
                     <div class="col-md-6">
                         <a href="{{ route('postDetails', $post) }}" class="btn btn-info">View</a>
                     </div>
                 </div>



                  </div>
              </div>
              <br>
          </div>

             @endforeach




            </div>
        </div>

        <div class="verybottom" style="max-height: 50px">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p style="padding: 5px;">&copy; Tech Heron - All right reserved</p>
                    </div>
                    <div class="col-md-6">
                        <div class="text-right">
                            <div class="credits">
                                <!--
                    All the links in the footer should remain intact.
                    You can delete the links only if you purchased the pro version.
                    Licensing information: https://bootstrapmade.com/license/
                    Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Scaffold
                  -->
                                 <p style="padding: 5px;"> Designed by <a href="https://webseobd.com/">Web SEO BD</a></p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </footer>

{{-- <div class="row">
    <div class="col-md-12 text-center">
        <h2>You have no permission to see any File</h2>
<h2>Please wait up to 1 hour maximum</h2>
<h3>আপনি পেমেন্ট করার ১ঘন্টা পরেও ফাইল না পেয়ে থাকলে Contact করুন</h3>
<h3><a href="{{ url('/packeges') }}" class="btn btn-success">Buy Package</a></h3>
<h3 style="color: blue;"><a href="https://www.facebook.com/techheronfile">Contact here</a></h3>

    </div>
</div> --}}


@endguest
