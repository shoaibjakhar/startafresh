<x-app-layout>
	
    <div class="pagetitle">
      <h1>Payments To Creditors</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('clients') }}">Creditors</a></li>
          <li class="breadcrumb-item">Payments To Creditors</li>
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
				      <x-buttons.add :href="url('addCreditorPayment/'. $application->id)">Add Creditor Payment</x-buttons.add>
              </h5>
              <h5 class="card-title">Creditors</h5>
              	@if(session('status'))
                <x-alerts.success>
                  {{ session('status') }}
                </x-alerts.success>
                @endif

              <table class="table datatable">
                <thead>
                  <tr>
                    <th>SR#</th>
                    <th>Client Name</th>
                    <th>Creditor Office</th>
                    <th>Amount Paid</th>
                    <!-- <th>Total Paid</th> -->
                    <!-- <th>Balance</th> -->
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if(!empty($application))
                	@foreach($application->paymentsToCreditors as $key => $payment)
	                  <tr>
	                    <td>{{ $key+1 }}</td>
	                    <td>{{ $application->user->name }} {{ $application->user->clientDetails->surname }}</td>
                      <td>{{ $payment->creditorOffice->office_name }}</td>
                      <td>{{ $payment->amount }}</td>
                      <!-- <td></td> -->
                      <!-- <td></td> -->
                      <td>
                        
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