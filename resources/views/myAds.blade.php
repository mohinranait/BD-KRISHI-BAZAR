@extends('welcome.layouts.welcomeMaster')
@section('content')
<div class="container">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>IMG</th>
                  <th>Category</th>
                  <th>Sub Category</th>

                  <th>Status</th>
                  <th>Location</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($myAds as $post)
              <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->description }}</td>
                <td>{{ $post->price }}</td>

                <td>
                  @if($post->image)
                  <a href="{{asset('storage/subject/file/'.$post->image)}}" download><img src="{{asset('storage/subject/file/'.$post->image)}}" class="img-fluid" alt=""></a>
                  @endif
                </td>
                <td>{{ $post->cat->title }}</td>
                <td>{{$post->subCat? $post->subCat->title:"" }}</td>
                <td>{{ $post->active }}</td>
                <td>{{ $post->district!=null? $post->pdistrict->name:"" }}, {{ $post->thana!=null? $post->pthana->name:"" }}</td>
                <td>



                <div class="btn-group btn-group-xs">


    <a class="btn btn-primary btn-xs" href="{{ route('admin.approveUpdate', $post) }}">Edit</a>
    <a class="btn btn-primary btn-xs" href="{{ route('admin.adsdelete', $post) }}" onclick="return confirm('Confirm?')">Delete</a>


  </div>


                </td>

              </tr>


              @endforeach


              </tbody>

            </table>


          </div>
    </div>
</div>
@endsection
