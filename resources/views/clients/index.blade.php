<x-app-layout>
	
    <div class="pagetitle">
      <h1>Clients</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Clients</a></li>
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
				      <x-buttons.add :href="url('clients/create')">Add Client</x-buttons.add>
              </h5>
              <h5 class="card-title">Clients</h5>
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
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                	@foreach($clients as $key => $client)
	                  <tr>
	                    <td>{{ $key+1 }}</td>
	                    <td>{{ $client->name }}</td>
                      <td>{{ $client->email }}</td>
	                    <td>

                        @can('edit client')
                          <x-buttons.edit :href="url('clients/'. $client->id .'/edit')">
                            {{ __("Edit") }}
                          </x-buttons.edit>
                        @endcan

                        @can('delete client')
                          <x-buttons.delete :href="url('clients/'. $client->id .'/delete')">
                            {{ __("Delete") }}
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