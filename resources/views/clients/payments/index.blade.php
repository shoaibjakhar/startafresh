<x-app-layout>
	
    <div class="pagetitle">
      <h1>Payments From Clients</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('clients') }}">Clients</a></li>
          <li class="breadcrumb-item">Payments From Clients</li>
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
				      <x-buttons.add :href="url('addClientPayment/'. $application->id)">Add Client Payment</x-buttons.add>
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
                    <th>Offer Amount</th>
                    <th>All Individual payments</th>
                    <th>Total Debt</th>
                    <th>Total Paid</th>
                    <th>Balance</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if(!empty($application))
                	@foreach($application->payments as $key => $payment)
	                  <tr>
	                    <td>{{ 1 }}</td>
	                    <td>{{ $application->user->name }} {{ $application->user->clientDetails->surname }}</td>
                      <td>{{ 1 }}</td>
                      <td>{{ $payment->creditor_office_id }} : {{ $payment->amount }}</td>
                      <td>{{ 1 }}</td>
                      <td>{{ 1 }}</td>
                      <td>{{ 1 }}</td>
                      
                      <td>
                        
                        <x-buttons.add :href="url('debt/' . '' . '/create')">
                          {{ __("Add") }}
                        </x-buttons.add>

                        <x-buttons.view :href="url('debt/'. '' .'/show')">
                          {{ __("View") }}
                        </x-buttons.view>

                        <x-buttons.edit :href="url('debt/'. '' .'/edit')">
                          {{ __("Edit") }}
                        </x-buttons.edit>

                      </td>
                      
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