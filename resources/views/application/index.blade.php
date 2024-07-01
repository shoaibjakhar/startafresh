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
                    <th>Client Name</th>
                    <th>Client 2 Name</th>
                    <th>Total Debt</th>
                    <th>Offer Amount</th>
                    <th>Total Income</th>
                    <th>Total Paid</th>
                    <th>Balance</th>
                    <th>Notes</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if(!empty($applications))
                	@foreach($applications as $key => $application)
	                  <tr>
	                    <td>{{ $key+1 }}</td>
                      <td>{{ $application->user->name }}</td>
                      <td>{{ $application->user2->name ?? '' }}</td>
                      <td>{{ $application->totalDebt }}</td>
                      <td> - </td>
                      <td>{{ $application->totalIncome }}</td>
                      <td>{{ $application->totalPaidDebt }} 
                        @if($application->totalPaidDebt && $application->totalDebt)
                        ({{
                          ($application->totalPaidDebt/ $application->totalDebt) * 100 }}%)
                        @endif 
                      </td>
                      <td> {{ $application->totalDebt - $application->totalPaidDebt }} 
                        @if($application->totalPaidDebt && $application->totalDebt)
                          ({{ (($application->totalDebt - $application->totalPaidDebt)/$application->totalDebt) * 100 }}%)
                        @endif
                      </td>
                      <td>{{ $application->notes }}</td>
	                    
                      <td>

                      <x-buttons.view 
                        :href="url('mdiAndPaymentsCalcualtions/'. $application->id)"> 
                          {{ __('MDI & Payments Calcualtions') }} 
                      </x-buttons.view>
                      
                      <x-buttons.add
                        :href="url('paymentsFromClient/' . $application->id)" >
                        {{ __('Payments From Client') }}
                      </x-buttons.add>

                      <x-buttons.add
                        :href="url('paymentsToCreditors/' . $application->id)" >
                        {{ __('Payments To Creditors') }}
                      </x-buttons.add>



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