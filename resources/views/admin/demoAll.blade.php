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
                            All Subjects
                        </h3>
                    </div>
                    <div class="card-body">



                        <div class="table-responsive">


                            <table class="table table-hover">


                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Link</th>
                                        <th>Category</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php $i = 1; ?>

                                    <?php $i = ($demoAll->currentPage() - 1) * $demoAll->perPage() + 1; ?>

                                    @foreach ($demoAll as $user)
                                        <tr>

                                            <td>{{ $i }}</td>
                                            <td>
                                                @if ($user->img)
                                                    <img width="80"
                                                        src="{{ asset('storage/subject/file/' . $user->img) }}">
                                                @endif
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->link }}</td>
                                            <td>{{ $user->category }}</td>
                                            <td>

                                                

                                                <div class="btn-group btn-group-xs">

                                                  <a class="btn btn-warning btn-xs" href="{{ route('admin.demoEdit', $user) }}"
                                                  >Edit</a>
                                                    <a class="btn btn-primary btn-xs"
                                                        href="{{ route('admin.demodelete', $user) }}"
                                                        onclick="return confirm('Are you confirm')">Delete</a>


                                                </div>


                                            </td>

                                        </tr>

                                        <?php $i++; ?>

                                    @endforeach
                                </tbody>

                            </table>

                            {{ $demoAll->render() }}

                        </div>


                    </div>
                </div>
            </div>
        </div>



    </section>
@endsection


@push('js')

@endpush
