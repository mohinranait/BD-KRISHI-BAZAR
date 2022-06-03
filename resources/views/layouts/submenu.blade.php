<!--<div class="row py-4 d-flex justify-content-center">-->
<!--    <div class="col-md-3 bg-primary text-center mr-1 mb-3">-->
<!--        <a href="{{ route('allAds') }}">-->
<!--            <h3>All ADs</h3>-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="col-md-4 bg-primary text-center mr-1 mb-3">-->
<!--        <h3>Sell by Bdkb</h3>-->
<!--    </div>-->

<!--    <div class="col-md-4 btn bg-primary text-center mr-1 mb-3">-->
<!--        <form action="{{ route('addSearch') }}" method="POST">-->
<!--            @csrf-->
<!--                <div class="row">-->
<!--                    <div class="col-9">-->
<!--                        <input type="text" placeholder="Product title" name="title" class="form-control">-->

<!--                    </div>-->
<!--                    <div class="col-2">-->
<!--                        <button type="submit" class="btn btn-secondary">Search</button>-->
<!--                    </div>-->
<!--                </div>-->

<!--        </form>-->
<!--    </div>-->
<!--</div>-->

<!--<div class="row pb-3">-->
<!--    <div class="col-12">-->
<!--            <a href="" class="btn btn-info mr-2"  data-toggle="modal" data-target="#exampleModal">Area Search</a>-->

<!--    </div>-->
<!--</div>-->


<div class="row py-4 d-flex justify-content-center">
    <div class="col-lg-3  d-flex align-items-center justify-content-center mr-1">
    <a href="" class="btn btn-warning my-2 mr-2 w-100"  data-toggle="modal" data-target="#exampleModal">Area Search</a>
    </div>
    <div class="col-lg-4 py-2  text-center mr-1">
        <form action="{{ route('addSearch') }}" method="POST">
            @csrf
                <div class="row">
                    <div class="col-9">
                        <input type="text" placeholder="Product title" name="title" class="form-control">

                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-secondary">Search</button>
                    </div>
                </div>

        </form>
    </div>

    <div class="col-lg-2  d-flex align-items-center justify-content-center submenymobile1" >
        <div class="dropdown">
            <button class="post-add-btn btn-block text-center dropdown-toggle " style="border: 0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               All Categories
            </button>
            {{-- <a class="btn btn-secondary btn-block" href="">{{ $cat->title }}</a> --}}

            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                @foreach ($p_cat as $category)
                <a class="dropdown-item" href="{{ route('catAds', $category->id) }}">{{ $category->title }}</a>

                @endforeach
                @foreach ($cat as $category)
                <a class="dropdown-item" href="{{ route('catAds', $category->id) }}">{{ $category->title }}</a>

                @endforeach

            </div>
          </div>
    </div>
    <div class="col-lg-2  d-flex align-items-center justify-content-center mr-1 submenymobile1" >
        <a href="{{route('allAds')}}" class="post-add-btn w-100 text-center">ALL ADS</a>
    </div>



    <div class="col-md-4 submenymobile pt-2" >
        <div class="row">
            <div class="col-6">
                <a href="{{ route('user.ads') }}" class="btn btn-success btn-block" >POST ADS</a>
            </div>
            <div class="col-6 text-right">
                <a href="{{route('allAds')}}" class="btn btn-danger btn-block">ALL ADS</a>

            </div>
        </div>
    </div>


</div>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Choose Your Area</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
              <div class="col-12">
                  <form action="{{ route('areaSearch') }}" method="GET">
                      @csrf
                      <div class="form-group">
                        <select name="district" id="load_district1"
                        class="form-control dynamic load_district1 "
                        data-url="{{ route('load_thana.fetch') }}" data-dependent="load_thana1" required>
                        <option value="" selected>Select District</option>
                        @foreach ($districts as $district)

                                <option value="{{ $district->id }}">{{ $district->name }}</option>

                        @endforeach
                    </select>
                      </div>

                      <div class="form-group">
                        <select name="thana" id="load_thana1" class="form-control dynamic load_thana1" required>
                            <option>Select Thana</option>

                        </select>
                      </div>
                      <div class="form-group">
                          <button class="btn btn-info" type="submit">Search</button>
                      </div>
                  </form>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@push('js')
<script>
      $(document).ready(function() {






$('#load_district1').change(function() {
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
                    $(".load_thana1").empty().append($('<option>', {
                        value: '',
                        text: 'Select Thana'
                    }));

                    $.each(response.datas, function(i, item) {
                        $('.load_thana1').append($('<option>', {
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
</script>

@endpush
