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
                    <!-- <th>Action</th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>{{ $application->id }}</td>
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
                        
                        <li>
                          {{ $clientDebt->creditorOffice->office_name }} : {{ $clientDebt->current_debt }}
                          @if(!empty($clientDebt->creditorOffice->ccjAmounts->amount) && $application->id == $clientDebt->creditorOffice->ccjAmounts->application_id)
                            
                            | Payments To Creditor : {{ $clientDebt->creditorOffice->ccjAmounts->amount }} 
                            
                            |CCJ: {{ $clientDebt->creditorOffice->ccjAmounts->amount ?? '0' }}

                          @else
                          
                            | Payments To Creditor : {{ ($clientDebt->current_debt/$total_clientDebt_for_mdi) * $MDI }} 
                          
                          @endif

                          
                          | <a href="#" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#cjjModel{{$clientDebt->creditorOffice->id}}">Add CCJ</a> 

                          <div class="modal fade" id="cjjModel{{$clientDebt->creditorOffice->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form action="{{ url('add_ccj') }}" method="POST">
                              @csrf
                              <input type="hidden" name="application_id" value="{{ $application->id }}">
                              <input type="hidden" name="creditor_office_id" value="{{ $clientDebt->creditorOffice->id }}">

                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Add CCJ</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <div class="col-md-4">
                                    <x-input-label for="ccjAmount"> {{ __("CCJ Amount") }}</x-input-label>
                                    <x-text-input 
                                      type="number" 
                                      name="amount" 
                                      id="ccjAmount" 
                                      :value="old('ccj', ($application->id == $clientDebt->creditorOffice->ccjAmounts->application_id) ? $clientDebt->creditorOffice->ccjAmounts->amount : '')" 
                                      required 
                                    />
                                    
                                    <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                                    
                                    <x-input-error class="mt-2" :messages="$errors->get('ccj')" />

                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                              </div>
                            </div>
                          </form>
                            </div>

                        </li>
                                 
                        @endforeach
                    </td>

                    <td>
                      <!-- <div class="col-md-4">
                        <label for="acceptanceStatus" class="form-label">Acceptance Status</label>
                        <select name="acceptance_status" class="form-select" id="" required>
                          <option selected disabled value="">Choose...</option>
                          <option value='{{ __("Accepted") }} '>{{ __("Accepted") }}</option>
                          <option value='{{ __("Not Accepted") }} '>{{ __("Not Accepted") }}</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('acceptance_status')" />
                      </div> -->

                <!-- <div class="col-md-4">
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
                </div> -->
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