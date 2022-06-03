@extends('admin.layouts.adminMaster')

@push('css')

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
                  
              Subject Information Update

                </span> 
            </h3>
              </div>
              <div class="card-body" style="min-height: 200px;">


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Subject') }} ({{ $subject->email }})</div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.subjectUpdate', $subject) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="title" value="{{ old('name') ?: $subject->title }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Feature Image') }}</label>

                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file" value="{{ old('file') }}"  autocomplete="file" autofocus>

                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="active" id="active" checked>

                                    <label class="form-check-label" for="active">
                                        {{ __('Active') }}
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
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

@endpush

