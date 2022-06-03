@php
use Carbon\Carbon;
@endphp
@auth
                @php

                    $now = Carbon::now();
                    $end_date = auth()->user()->expired_at;
                    $cDate = Carbon::parse($end_date);
                    $active_time = $now->diff($cDate);
                    $me = auth()->user();
                @endphp
            @endauth

            @php
                use App\Model\Post;
                $posts = Post::latest()->paginate(18);
                //    dd(auth()->user()->pendingPackage());
            @endphp


@extends('welcome.layouts.welcomeMaster')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('ads.Pay',[$ads,$title]) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="">Payment Method</label>
                                        </div>
                                        <div class="col-9 form-group">
                                            <select name="payment_method" id="" class="form-control" required>
                                                <option value="">Select...</option>
                                                <option value="Bkash">Bkash</option>
                                                <option value="Nagad">Nagad</option>
                                            </select>
                                        </div>

                                        <div class="col-3">
                                            <label for="">Payment Amount</label>
                                        </div>
                                        <div class="col-9 form-group">
                                            <input type="number" class="form-control" name="pauyment_amount" id="" placeholder="Payment Amount" required>
                                        </div>

                                        <div class="col-3">
                                            <label for="">Transection Number</label>
                                        </div>
                                        <div class="col-9 form-group">
                                            <input type="text" class="form-control" name="trn_no" placeholder="Transection Number" id="" required>
                                        </div>

                                        <div class="col-12 text-right form-group">
                                            <button class="btn btn-info" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>




@endsection
