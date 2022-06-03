@extends('welcome.layouts.welcomeMaster')

@push('css')

@endpush
@php
    use Carbon\Carbon;
@endphp

@section('content')

<div class="container">
    <div class="row py-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    <div class="row d-flex justify-content-center">
                        <div class="col-6">
                            @include('alerts.alerts')
                            <div class="card product-height" style="" >
                       <div class="card-body text-center">
                           <a href="{{ route('adDetails', $userAds) }}"><img src="{{asset('storage/subject/file/'.$userAds->image)}}" class="img-fluid" style="max-height: 100px" alt="{{ $userAds->image }}">
                           </a>
                           <h3><a href="{{ route('adDetails', $userAds) }}" class="btn btn-info">{{Str::words($userAds->title,2) }}</a></h3>
                       </div>
                   </div>

                   <div class="row">
                       <div class="col-12">
                           <a href="{{ route('adsCatPay',['id'=> $userAds, 'title'=>"Top Ads"]) }}">
                               <div class="card">
                                   <div class="card-body bg-success">
                                       Top Category Ads
                                   </div>
                               </div>
                           </a>
                       </div>
                   </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection
@push('js')
<script src="{{asset('assets/jquery.min.js')}}"></script>

<script>
    $(function() {
        // Summernote
        $('#summernote').summernote()

        // CodeMirror
        CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
            mode: "htmlmixed",
            theme: "monokai"
        });
    })




    $(document).ready(function() {
        $('#load_district').change(function() {
            if ($(this).val() != '') {
                var select = $(this).attr("id");
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ route('load_thana.fetch') }}",
                    method: "POST",
                    data: {
                        select: select,
                        value: value,
                        _token: _token,
                        dependent: dependent
                    },

                    success: function(response) {
                        if (response.success) {
                            $(".load_thana").empty().append($('<option>', {
                                value: '',
                                text: 'Select Thana'
                            }));

                            $.each(response.datas, function(i, item) {
                                $('.load_thana').append($('<option>', {
                                    value: item.id,
                                    text: item.name
                                }));
                            });
                        }
                    }

                })
            }
        });

        $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    });



    $(document).ready(function() {
        $('#category').change(function() {
            // alert(1);
            if ($(this).val() != '') {
                var select = $(this).attr("id");
                var value = $(this).val();
                var _token = $('input[name="_token"]').val();
                // alert(value);
                $.ajax({
                    url: "{{ route('subcat.fetch') }}",
                    method: "POST",
                    data: {
                        select: select,
                        value: value,
                        _token: _token,

                    },

                    success: function(response) {
                        if (response.success) {
                            $("#subCategory").empty().append($('<option>', {
                                value: '',
                                text: 'Select Sub-Category'
                            }));

                            $.each(response.datas, function(i, item) {
                                $('#subCategory').append($('<option>', {
                                    value: item.id,
                                    text: item.title
                                }));
                            });
                        }
                    }

                })
            }
        });

        $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    });


</script>

    <script>
      $(document).ready(function () {
        $("#form_show").click(function () {
          $("#form_visibble").show();
        });
      });
    </script>

    <script type="text/javascript">
    var i = 0;

    $("#add2").click(function() {
        ++i;
        $("#dynamicTableImage").append('<tr><td><input type="file" name="addmore2[' +
            i +
            ']" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>'
        );
    });
    $(document).on('click', '.remove-tr', function() {
        $(this).parents('tr').remove();
    });





    // Primary Category select with subCategory select





    </script>
@endpush
