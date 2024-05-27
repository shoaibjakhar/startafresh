<x-app-layout>
  
    <div class="pagetitle">
      <h1>Payments</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('payments') }}">Payments</a></li>
          <li class="breadcrumb-item active">All</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">

              <h5 class="card-title">Payments</h5>
                @if(session('success'))
                <x-alerts.success>
                  {{ session('success') }}
                </x-alerts.success>
                @endif

              <table class="table datatable">
                <thead>
                  <tr>
                    <th>SR#</th>
                    <th>Application ID</th>
                    <th>Client1</th>
                    <th>Client2</th>
                    <th>Income</th>
                    <th>Expenditure</th>
                    <th>M.D.I.</th>
                    <th>Total Debt</th>
                    <th>Client Debts</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>1</td>
                    <td>{{ $application->user->name}} {{ $application->user->clientDetails->surname}} </td>
                    <td>Alice</td>
                    <td>
                      {{ $total_clientIncome }}
                    </td>
                    <td>
                      {{ $total_clientExpenditure }}
                    </td>
                    <td>{{ $MDI }}</td>
                    <td>{{ $total_clientDebt }}</td>
                    <td>
                       @foreach($application->user->clientDebts as $clientDebt)
                        
                        <li>{{ $clientDebt->creditorOffice->office_name }} : {{ $clientDebt->current_debt }} | Payments To Creditor : {{ ($clientDebt->current_debt/$total_clientDebt) * $MDI }} </li>
                             
                        @endforeach
                    </td>
                    <td>
                      <div class="col-md-4">
                  <label for="acceptanceStatus" class="form-label">Acceptance Status</label>
                  <select name="acceptance_status" class="form-select" id="" required>
                    <option selected disabled value="">Choose...</option>
                    <option value='{{ __("Accepted") }} '>{{ __("Accepted") }}</option>
                    <option value='{{ __("Not Accepted") }} '>{{ __("Not Accepted") }}</option>
                  </select>
                  <x-input-error class="mt-2" :messages="$errors->get('acceptance_status')" />
                </div>

                <div class="col-md-4">
                  <x-input-label for="acceptanceDate"> {{ __("Acceptance Date") }}</x-input-label>
                  <x-text-input 
                    type="date" 
                    name="acceptance_date" 
                    id="acceptanceDate" 
                    value="{{ old('acceptance_date', '') }}" 
                    required 
                  />
                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                  <x-input-error 
                    class="mt-2" 
                    :messages="$errors->get('acceptance_date')" 
                    />
                </div>
                    </td>
                    
                  </tr>
                  
                </tbody>
              </table>

            </div>
          </div>

        </div>
      </div>
    </section>

</x-app-layout>