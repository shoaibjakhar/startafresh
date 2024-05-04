<x-app-layout>
	
    <div class="pagetitle">
      <h1>Roles</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('roles') }}">Roles</a></li>
          <li class="breadcrumb-item active">All</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              @can('create role')
              <h5 class="card-title float-right">
				        <x-buttons.add :href="url('roles/create')">
                  Add Role
                </x-buttons.add>
              </h5>
              @endcan
              <h5 class="card-title">Roles</h5>
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
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                	@foreach($roles as $key => $role)
	                  <tr>
	                    <td>{{ $key+1 }}</td>
	                    <td>{{ $role->name }}</td>
	                    <td>
                        @can('edit permission')
	                    	<x-buttons.add 
                          :href="url('roles/'. $role->id .'/give-permissions')"> 
                          {{ __('Add / Edit Role Permission') }}
                        </x-buttons.add>
                        @endcan
                        
                        @can('edit role')
                        <x-buttons.edit 
                          :href="url('roles/'. $role->id .'/edit')"> 
                          {{ __('Edit') }}
                        </x-buttons.edit>
                        @endcan
                        
                        @can('delete role')
                        <x-buttons.delete 
                          :href="url('roles/'. $role->id .'/delete')"> 
                        {{ __('Delete') }}
                        </x-buttons.delete>
                        @endcan
	                    </td>
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