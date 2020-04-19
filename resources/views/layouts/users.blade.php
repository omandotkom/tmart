<div class="container">

  <div class="row">
    <div class="col-lg-3">

      <h1 class="my-4">T-Mart</h1>
      @include('layouts.listsidebar')
    </div>

    <!-- /.col-lg-3 -->

    <div class="col-lg-9">
      <h1 class="my-4">
        <i class="fa fa-users"></i> Users</h1>
      <div class="row my-4">

        <div class="card w-100">
          <div class="card-header">
            Website Users
          </div>
          <div class="card-body">
            <table class="table table-responsive table-sm">
              <thead>
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">All Transaction</th>
                  <th scope="col">Registered at</th>
                </tr>
              </thead>
              <tbody>
                
                  @foreach($users as $user)
                  <tr><td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->orders->count()}}</td>
                  <td>{{$user->created_at}}</td></tr>
                  @endforeach
                
              </tbody>
            </table>
          </div>
        </div>

      </div>
     

      <!-- /.row -->
    </div>
    <!-- /.col-lg-9 -->

  </div>
  <!-- /.row -->

</div>