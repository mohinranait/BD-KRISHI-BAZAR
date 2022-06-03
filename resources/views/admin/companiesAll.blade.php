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
              All Companies
            </h3>
          </div>
          <div class="card-body">




<div class="table-responsive">
          

          <table class="table table-hover">



            <thead>
              <tr>
                <th>SL</th>
                <th></th>
                <th>Title</th>
                <th>Login Code (Main Website)</th>
                {{-- <th>Password</th> --}}
                {{-- <th>Login Type</th> --}}
                <th>Last Login</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody> 

              <?php $i = 1; ?>

              <?php $i = (($companiesAll->currentPage() - 1) * $companiesAll->perPage() + 1); ?>

            @foreach($companiesAll as $company)        


            <tr>

            	<td>{{ $i }}</td>
            	<td>
            		<div class="widget-user-image">
                <img width="60" class="img-circle elevation-2" src="{{ asset($company->logo()) }}" alt="User Avatar">
              </div>
            	</td>
            	<td>{{ $company->title }}</td>
            	<td>{{ $company->login_code }}</td>
            	{{-- <td>{{ $company->login_password }}</td> --}}
            	{{-- <td>{{ $company->login_type }}</td> --}}
            	<td>{{ $company->loggedin_at }}</td>
            	<td>{{ $company->mobile }}</td>
            	<td>{{ $company->email }}</td>
            	<td>{{ $company->status }}</td>

            	<td>

            		

            	<div class="btn-group btn-group-xs mb-1">
  

  <a class="btn btn-primary btn-xs" href="{{ route('admin.companyEdit', $company) }}"> &nbsp; Edit &nbsp; </a>
  <a class="btn btn-primary btn-xs" href="{{ route('admin.companyDetails', $company) }}">Details</a>
  </div>

  <div class="btn-group btn-group-xs">

  <a class="btn btn-primary btn-xs" href="{{ route('admin.companyProducts', $company) }}">Devices</a>
  <a onclick="return confirm('Do you really want to delete this company?');" class="btn btn-danger btn-xs" href="{{ route('admin.companyDelete', $company) }}">Delete</a>
  {{-- <a class="btn btn-primary btn-xs" href="{{ route('admin.companyChangeStatus', $company) }}">Change Status</a> --}}

</div>
            		

            	</td>
              
            </tr>

            <?php $i++; ?>

            @endforeach 
            </tbody>

          </table>

          {{ $companiesAll->render() }}

        </div>



</div>
</div>
</div>
</div>


  
  </section>
@endsection


@push('js')

@endpush

