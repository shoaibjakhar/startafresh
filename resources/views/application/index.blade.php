<x-app-layout>
	
    <div class="pagetitle">
      <h1>Applications</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('applications') }}">Applications</a></li>
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
        				<x-buttons.add :href="url('applications/create')">
                  {{ __("Add Application") }}    
                </x-buttons.add>
              </h5>

              <h5 class="card-title">Applications</h5>
              	@if(session('success'))
                <x-alerts.success>
                  {{ session('success') }}
                </x-alerts.success>
        				@endif

              <table class="table datatable">
                <thead>
                  <tr>
                    <th>SR#</th>
                    <th>Notes</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if(!empty($applications))
                	@foreach($applications as $key => $application)
	                  <tr>
	                    <td>{{ $key+1 }}</td>
                      <td>{{ $application->notes }}</td>
	                    
                      <td>
                      @can('edit application')
                      <x-buttons.edit 
                        :href="url('applications/'. $application->id .'/edit')"> 
                          {{ __('Edit') }} 
                      </x-buttons.edit>
                      @endcan

                      @can('delete application')
                        <x-buttons.delete 
                          :href="url('applications/'. $application->id .'/delete')"> 
                          {{ __('Delete') }}
                        </x-buttons.delete>

	                    </td>
                      @endcan
	                  </tr>
                	@endforeach
                  @endif
                  
                </tbody>
              </table>

            </div>
          </div>

        </div>
      </div>
    </section>

</x-app-layout>