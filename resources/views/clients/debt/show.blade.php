<x-app-layout>
	
    <div class="pagetitle">
      <h1>Debt Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('clients') }}">Clients</a></li>
          <li class="breadcrumb-item active">Debt Details</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Debt Details</h5>
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
                    <th>Client Email</th>
                    <th>Creditor Office</th>
                    <th>Debt Reference</th>
                    <th>Balance</th>
                    <th>Total Paid</th>
                    <th>Current Debt</th>
                    <th>Offer</th>
                    <th>Acceptance Status</th>
                    <th>Notes</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($user->clientDebts as $key => $clientDebt)
                  	<tr>
                      <td>{{ $key+1 }}</td>
                      <td>
                         {{ $user->name }}
                      </td>

                      <td>
                         {{ $user->email }}
                      </td>

                      <td>
                         {{ $clientDebt->creditorOffice->office_name }}
                      </td>

                      <td>
                         {{ $clientDebt->debt_reference }}
                      </td>

                      <td>
                         {{ $clientDebt->balance }}
                      </td>

                      <td>
                         {{ $clientDebt->total_paid }}
                      </td>

                      <td>
                         {{ $clientDebt->current_debt }}
                      </td>

                      <td>
                         {{ $clientDebt->offer }}
                      </td>

                      <td>
                         {{ $clientDebt->acceptance_status }}
                      </td>

                      <td>
                         {!! $clientDebt->notes !!}
                      </td>
                      <td>
                        <x-buttons.delete :href="url('income/'. $clientDebt->id .'/delete')">
                          {{ __("Delete") }}
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