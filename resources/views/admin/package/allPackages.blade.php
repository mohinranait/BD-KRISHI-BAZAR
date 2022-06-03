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

                        <div class="container-fluid">
                            @foreach($packages->chunk(4) as $package4)
                          <div class="row">
                            @foreach($package4 as $package)
                            <div class="col-md-3">
                              <div class="card">
                                <div class="card-header">
                                  <a class="card-title text-dark" href="{{ route('admin.membershipPackageEdit',$package) }}">
                                    <h3 class="card-title">{{$package->package_title}}</h3>
                                  </a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="panel panel-default" style="margin-bottom: 0px;">
                                        <div class="panel-body" style="padding: 5px;">

                                          {{ $package->package_description }} <hr style="margin: 3px;">
                                          <div class="w3-large">
                                            <b>Price: </b> {{ $package->package_amount }} {{ $package->package_currency }} <br>
                                            <b>Duration: </b> {{ $package->package_duration }} Days <br>
                                            <br>
                                            @if($package->image_name)
                                            <div class="pull-right">
                                          <img class="img-circle" width="40" src="{{ asset('img/package/' . $package->image_name) }}" alt="Package">
                                        </div>
                                          @endif

                                          </div>

                                        </div>
                                      </div>
                                </div>
                                <!-- /.card-body -->

                              </div>
                              <!-- /.card -->


                              <!-- /.card -->
                            </div>
                            <!-- /.col -->
                            @endforeach


                          </div>
                          @endforeach


                        </div><!-- /.container-fluid -->




                    </div>
                </div>
            </div>
        </div>



    </section>
@endsection
