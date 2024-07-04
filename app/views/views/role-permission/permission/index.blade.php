<x-app-layout>

    <div class="pagetitle">
      <h1>Permissions</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('permissions') }}">Permissions</a></li>
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
                <x-buttons.add :href="url('permissions/create')">
                  Add Permission
                </x-buttons.add>
              </h5>
              <h5 class="card-title">Permissions</h5>
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
                    <th>Created At</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                	@foreach($permissions as $key => $permission)
	                  <tr>
	                    <td>{{ $key+1 }}</td>
	                    <td>{{ $permission->name }}</td>
                      <td>{{ $permission->created_at }}</td>
	                    <td>
                        <x-buttons.edit 
                          :href="url('permissions/'. $permission->id .'/edit')"> 
                          {{ __('Edit') }}
                        </x-buttons.edit>
                      </td>
                      <td>
                        <x-buttons.delete 
                          :href="url('permissions/'. $permission->id .'/delete')">
                          {{ __('Delete') }}
                        </x-buttons.delete>
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