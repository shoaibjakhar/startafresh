<x-app-layout>
	
    <div class="pagetitle">
      <h1>Clients</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('clients') }}">Clients</a></li>
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
                    <th>Mobile</th>
                    <th>Debt</th>
                    <th>Income</th>
                    <th>Expenditure</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                	@foreach($clients as $key => $client)
	                  <tr>
	                    <td>{{ $key+1 }}</td>
	                    <td>{{ $client->name }} {{ $client->surname }}</td>
                      <td>{{ $client->email }}</td>
                      <td>{{ $client->mobile }}</td>
                      
                      <td>
                        
                        <x-buttons.add :href="url('debt/' . $client->user_id . '/create')">
                          {{ __("Add") }}
                        </x-buttons.add>

                        <x-buttons.view :href="url('debt/'. $client->user_id .'/show')">
                          {{ __("View") }}
                        </x-buttons.view>

                        {{-- <x-buttons.edit :href="url('debt/'. $client->user_id .'/edit')">
                          {{ __("Edit") }}
                        </x-buttons.edit> --}}

                      </td>

	                    <td>
                        
                        <x-buttons.add :href="url('income/' . $client->user_id . '/create')">
                          {{ __("Add") }}
                        </x-buttons.add>

                        <x-buttons.view :href="url('income/'. $client->user_id .'/show')">
                          {{ __("View") }}
                        </x-buttons.view>

                        <x-buttons.edit :href="url('income/'. $client->user_id .'/edit')">
                          {{ __("Edit") }}
                        </x-buttons.edit>

                      </td>

                        



                      <td>
                        
                          <x-buttons.add :href="url('expenditure/' . $client->user_id . '/create')">
                            {{ __("Add") }}
                          </x-buttons.add>

                          <x-buttons.view :href="url('expenditure/'. $client->user_id .'/show')">
                            {{ __("View") }}
                          </x-buttons.view>

                          <x-buttons.edit :href="url('expenditure/'. $client->user_id .'/edit')">
                            {{ __("Edit") }}
                          </x-buttons.edit>
                      
                      </td>

                      <td>

                        <x-buttons.view :href="url('clients/'. $client->user_id .'/show')">
                          {{ __("View") }}
                        </x-buttons.view>

                        @can('edit client')
                          <x-buttons.edit :href="url('clients/'. $client->user_id .'/edit')">
                            {{ __("Edit") }}
                          </x-buttons.edit>
                        @endcan

                        @can('delete client')
                          <x-buttons.delete :href="url('clients/'. $client->user_id .'/delete')">
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