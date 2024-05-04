<x-app-layout>
	
    <div class="pagetitle">
      <h1>Users</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Users</a></li>
          <li class="breadcrumb-item active">All</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title float-right">
        				<x-buttons.add :href="url('users/create')">
                  {{ __("Add User") }}    
                </x-buttons.add>
              </h5>

              <h5 class="card-title">Users</h5>
              	@if(session('status'))
                <x-alerts.success>
                  {{ session('status') }}
                </x-alerts.success>
        				@endif

              <table class="table datatable">
                <thead>
                  <tr>
                    <th>SR#</th>
                    <th>Name</th>
                    <th>Email</th>
                    @can('view role')
                    <th>Roles</th>
                    @endcan
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                	@foreach($users as $key => $user)
	                  <tr>
	                    <td>{{ $key+1 }}</td>
	                    <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      
                      @can('view role')
                      <td>
                        @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $rolename)

                          <label class="badge bg-primary mx-1">{{ $rolename }}</label>

                        @endforeach
                        @endif
                      </td>
                      @endcan
	                    <td>
                      
                      @can('edit user')
                      <x-buttons.edit 
                        :href="url('users/'. $user->id .'/edit')"> 
                          {{ __('Edit') }} 
                      </x-buttons.edit>
                      @endcan

                      @can('delete user')
                        <x-buttons.delete 
                          :href="url('users/'. $user->id .'/delete')"> 
                          {{ __('Delete') }}
                        </x-buttons.delete>

	                    </td>
                      @endcan
	                  </tr>
                	@endforeach
                  
                </tbody>
              </table>

            </div>
          </div>

        </div>
      </div>
    </section>

</x-app-layout>