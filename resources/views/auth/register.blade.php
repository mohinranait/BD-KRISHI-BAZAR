@extends('welcome.layouts.welcomeMaster')


@section('content')
    <div class="container">
        <div class="row justify-content-center">


            <div class="col col-md-12">


                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row p-3 d-flex justify-content-center">

                        <div class="col-md-6  bg-primary pt-4">

                            <p class="lead"><span class="badge badge-danger"></span><span class="badge badge-primary"></span>

                                আজই রেজিস্ট্রেশন করুন

                           </p>


                            <input id="text" type="mobile" class="form-control @error('mobile') is-invalid @enderror"
                                name="mobile" value="{{ old('mobile') }}" autocomplete="mobile" autofocus
                                placeholder="Mobile Number (Optional)">

                            @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>
                            <br>



                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email"
                                placeholder="Your Email (required)">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="new-password" placeholder="Password (required)">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>




                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required autocomplete="new-password" placeholder="Confirm Password (required)"><br>





                            <button class="col-sm-12 btn btn-lg btn-dark mt-sm-2 mb-sm-2" type="submit"
                                name="submit">Register</button>

                        </div>


                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        if ($('#payment_method').val() == 'Bkash') {
            alert(1;)

            $('.payment').empty().append('<p>htyhtryh</p>');
        }
    </script>
@endpush
