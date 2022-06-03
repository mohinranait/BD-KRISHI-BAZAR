<div class="table-responsive">
          

          <table class="table table-hover">


            <thead>
              <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody> 

              <?php $i = 1; ?>

              <?php $i = (($usersAll->currentPage() - 1) * $usersAll->perPage() + 1); ?>

            @foreach($usersAll as $user)        


            <tr>

              <td>{{ $i }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->mobile }}</td>
              <td>{{ $user->active ? 'Active' : 'Inactive' }}</td>

              <td>

                

              <div class="btn-group btn-group-xs">
  

  <a class="btn btn-primary btn-xs" href="{{ route('admin.userEdit', $user) }}">Edit</a>
  <a class="btn btn-primary btn-xs" href="{{ route('admin.userCompanies', $user) }}">Company</a>


</div>
                

              </td>
              
            </tr>

            <?php $i++; ?>

            @endforeach 
            </tbody>

          </table>

          {{ $usersAll->render() }}

        </div>