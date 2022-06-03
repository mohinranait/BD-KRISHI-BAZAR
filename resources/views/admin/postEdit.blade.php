@extends('admin.layouts.adminMaster')

@push('css')

<!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('cp/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('cp/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- Bootstrap4 Duallistbox -->
<link href="{{ asset('https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css') }}" rel="stylesheet">


<style>
    .note-group-select-from-files {
      display: none;
    }
  </style>

@endpush

@section('content')
  <section class="content">

    <br>

     <div class="row">

      <div class="col-sm-12">

@include('alerts.alerts')





            <div class="card card-widget">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-briefcase text-primary"></i> <span class="badge badge-light">

              Post Information

                </span>
            </h3>
              </div>
              <div class="card-body" style="min-height: 200px;">


                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">{{ __('Create New Post') }}</div>

                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.postUpdate', $post->id) }}">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Post Title') }}</label>

                                            <div class="col-md-10">
                                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $post->title }}" required placeholder="Post Title" autocomplete="title" autofocus>

                                                @error('title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Post Description') }}</label>

                                            <div class="col-md-10">
                                                <textarea class="form-control" id="description" name="description" rows="3">{!! $post->description !!}</textarea>

                                                @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>




                                        <div class="form-group row">
                                            <label for="feature_image" class="col-md-2 col-form-label text-md-right">{{ __('Feature Image') }}</label>

                                            <div class="col-md-10">
                                                <input id="feature_image" type="file" class="form-file-control @error('feature_image') is-invalid @enderror" name="feature_image" value="{{ old('feature_image') }}"  placeholder="Post file">
                                                <img src="{{asset('storage/post/file/feature/'.$post->feature_image)}}" alt="" width="45px">
                                                @error('feature_image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                      
                                        </div>


                                        <div class="form-group row">
                                          <!-- Author Image -->
                                            <label for="author_image" class="col-md-2 col-form-label text-md-right">{{ __('Author Image') }}</label>
                                            <div class="col-md-10">
                                                <input id="author_image" type="file" class="form-file-control @error('author_image') is-invalid @enderror" name="author_image" value="{{ old('author_image') }}"  placeholder="Post file">
                                                <img src="{{asset('storage/post/file/feature/'.$post->author_image)}}" alt="" width="45px">
                                                @error('author_image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                          <!-- Author Name -->
                                            <label for="author_name" class="col-md-2 col-form-label text-md-right">{{ __('Author Name') }}</label>
                                            <div class="col-md-10">
                                                <input id="author_name" type="input" class="form-control @error('author_name') is-invalid @enderror" name="author_name" value="{{ $post->author_name }}" required  placeholder="Author name">
                                                @error('author_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="form-group row mb-0">
                                            <div class="col-md-10 offset-md-2">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Update') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


              </div>
            </div>
          </div>
        </div>



          </div>
      </div>
  </div>
</div>



  </section>
@endsection

@push('js')


<script src="{{ asset('https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.js') }}"></script>

 <!-- Select2 -->
<script src="{{ asset('cp/plugins/select2/js/select2.full.min.js') }}"></script>

<script>

  $(document).ready(function() {
    $('#description').summernote({
  placeholder: 'Write Descriptio of the post...',
  tabsize: 2,
  height: 260,
  dialogsInBody: true
});


    $('.select2').select2({theme: 'bootstrap4'});

  });

  //$(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
  //  CKEDITOR.replace('description');
  //});

  $(document).ready(function () {
  $('.select2-tags').select2({
    minimumInputLength: 1,
    tags:true,
    tokenSeparators: [','],
    ajax: {
      data: function (params) {
        return {
          q: params.term, // search term
          page: params.page
        };
      },
      processResults: function (data, params) {
        params.page = params.page || 1;
        // alert(data[0].s);
        var data = $.map(data, function (obj) {
          obj.id = obj.id || obj.title;
          return obj;
        });
        var data = $.map(data, function (obj) {
          obj.text = obj.text || obj.title;
          return obj;
        });
        return {
          results: data,
          pagination: {
            more: (params.page * 30) < data.total_count
          }
        };
      }
    },
  });

  //////////////////




  $(document).on('click','#btn-feature',function(e){
      e.preventDefault();
      $('#my_feature_img').click();
    });
});


</script>

 <script>
  $(document).ready(function () {
  $('.select2-author').select2({
    minimumInputLength: 1,
    ajax: {
      data: function (params) {
        return {
          q: params.term, // search term
          page: params.page
        };
      },
      processResults: function (data, params) {
        params.page = params.page || 1;
        // alert(data[0].s);
        var data = $.map(data, function (obj) {
          obj.id = obj.id || obj.email;
          obj.text = obj.text || obj.email;
          return obj;
        });
        // var data = $.map(data, function (obj) {
        //   obj.text = obj.text || obj.email;
        //   return obj;
        // });
        return {
          results: data,
          pagination: {
            more: (params.page * 30) < data.total_count
          }
        };
      }
    },
  });
});
</script>
@endpush




