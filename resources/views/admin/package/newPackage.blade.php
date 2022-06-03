@extends('admin.layouts.adminMaster')
@section('content')
    <section class="content">

        <br>


        <div class="row">

            <div class="col-sm-12">
                @include('alerts.alerts')

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            New Package
                        </h3>
                    </div>
                    <div class="card-body">

                        <form class="form-horizontal" action="{{ route('admin.membershipPackageAddNewPost') }}" method="post">
                            <div class="card-body">
                              <div class="form-group">
                                <label class="control-label col-sm-3" for="title">Package Title:</label>
                                <div class="col-sm-9">
                                  <input type="text" name="title"  required class="form-control" value="{{ old('title') }}" id="title" placeholder="Package Title">
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-sm-3" for="description">Package Description:</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="description" value="{{ old('description') }}" required name="description" placeholder="Package Description">
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-sm-3" for="description">Price/Amount:</label>
                                <div class="col-sm-9">
                                  <input type="number" min="1" required max="10000" step="any" class="form-control" id="price" value="{{ old('price') }}" name="price" placeholder="Package Price/Amount">
                                </div>
                              </div>



                              <div class="form-group">
                                <label class="control-label col-sm-3" for="description">Duration / Days:</label>
                                <div class="col-sm-9">
                                  <input type="number" min="1" required max="10000" step="1" class="form-control" id="duration" value="{{ old('duration') }}" name="duration" placeholder="Package Duration in Day">
                                </div>
                              </div>

                              {{ csrf_field() }}
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                          </form>




                    </div>
                </div>
            </div>
        </div>



    </section>
@endsection
