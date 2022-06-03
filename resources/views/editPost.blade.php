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
                            <form action="{{ route('user.updatPost',$post) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" value="{{ $post->title }}" class="form-control" name="title" required>
                                </div>

                                <div class="form-group">
                                    <label for="">Decripton</label>
                                    <input type="text" value="{{ $post->description }}" class="form-control" name="description" required>
                                </div>

                                <div class="form-group">
                                    <label for="">Price</label>
                                    <input type="text" class="form-control" value="{{ $post->price }}" name="price" required>
                                </div>

                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input type="file" class="form-control" name="image" >
                                </div>
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <input type="number" class="form-control" value="{{ $post->phone }}" name="phone" required>
                                </div>

                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select name="category" id="category" class="form-control" required>
                                        <option value="">Select....</option>
                                        <option selected value="{{ $post->category }}">{{ $post->cat->title }}</option>
                                        @foreach ($category as $cat )
                                        <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Sub Category</label>
                                    <select name="sub_category" id="subCategory" class="form-control" required>
                                        <option value="">Select </option>
                                        <option selected value="{{ $post->sub_category }}">{{ $post->subCat->title }}</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="village" class="form-label">District*</label>
                                    <select name="district" id="load_district"
                                    class="form-control dynamic load_district "
                                    data-url="{{ route('load_thana.fetch') }}" data-dependent="load_thana" required>
                                    <option value="">Select District</option>
                                    <option selected value="{{ $post->district }}">{{ $post->pdistrict->name }}</option>

                                    @foreach ($districts as $district)

                                            <option value="{{ $district->id }}">{{ $district->name }}</option>

                                    @endforeach
                                </select>
                                </div>
                                <div class="form-group">
                                    <label for="village" class="form-label">Thana*</label>
                                    <select name="thana" id="load_thana" class="form-control dynamic load_thana" required>
                                        <option>Select Thana</option>
                                        <option selected value="{{ $post->thana }}">{{ $post->pthana->name }}</option>


                                    </select>
                                </div>


                                <div class="table-responsive">
                                    <h5>Extra Imagess</h5>
                                    <table class="table table-bordered" id="dynamicTableImage">
                                        <span class="text-right">
                                        </span>
                                        <tr>
                                            <td><input type="file" name="addmore2[0]" class="form-control" /></td><td><button type="button" class="btn" style="background:#007BFF; color:white" id="add2">add more</button></td>
                                            <span class="galleryyy2"></span>

                                        </tr>
                                    </table>
                                </div>

                                <button type="submit" class="btn btn-success">Submit</button>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    <div class="row d-flex justify-content-center">
                        @foreach ($post->images as $img)
                        {{-- {{ dd($img) }} --}}
                            <div class="col-md-2">
                                <img src="{{ asset('storage/subject/file/extra/'.$img->image) }}" class="img-fluid" style="height: 100px" alt=""> <br>
                                <a href="{{ route('imgDelete', $img) }}" class="btn btn-danger" onclick="return confirm('Confirm?')">Delete</a>
                            </div>
                        @endforeach
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
