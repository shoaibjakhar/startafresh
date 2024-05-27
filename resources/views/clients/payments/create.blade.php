<x-app-layout>
  
    <div class="pagetitle">
      <h1>Create Payment From Client</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('clients') }}">Clients</a></li>
          <li class="breadcrumb-item">Create Payment From Client</li>
          <li class="breadcrumb-item active">Create</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title float-right">
                <x-buttons.warning :href="url('clients')">{{ __("Back") }}</x-button.warning>
              </h5>
              <h5 class="card-title">Client Information</h5>

              <form action="{{ url('saveClientPayment') }}" method="POST" class="row g-3 needs-validation" novalidate>

                <input type="hidden" name="application_id" value="{{ $application->id }}">
                <input type="hidden" name="client_id" value="{{ $application->user->id }}">
                
                @csrf
                
                <div class="col-md-4">
                  <x-input-label for="userName"> {{ __("Forename") }}</x-input-label>
                  <x-text-input 
                    type="text" 
                    name="name" 
                    id="userName" 
                    :value="old('name', $application->user->name)" 
                    required
                    disabled
                  />
                  
                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                  
                  <x-input-error class="mt-2" :messages="$errors->get('name')" />

                </div>

                <div class="col-md-4">
                  <x-input-label for="surName"> {{ __("Surname") }}</x-input-label>
                  <x-text-input 
                    type="text" 
                    name="surname" 
                    id="surName" 
                    :value="old('surname', $application->user->clientDetails->surname)" 
                    required 
                    disabled
                  />
                  
                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                  
                  <x-input-error class="mt-2" :messages="$errors->get('surname')" />

                </div>

                <div class="col-md-4">

                  <x-input-label for="amount"> {{ __("Amount") }}</x-input-label>
                  <x-text-input 
                    type="number" 
                    step="0.01"
                    name="amount" 
                    id="amount" 
                    :value="old('amount', '')" 
                    required 
                  />
                  
                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                  
                  <x-input-error class="mt-2" :messages="$errors->get('amount')" />

                </div>

                <div class="col-md-4">
                  <label for="creditorOffice" class="form-label">Creditor Office</label>
                  <select name="creditor_office_id" class="form-select" id="" required>
                    <option selected disabled value="">Choose...</option>
                    @foreach($creditorOffices as $creditorOffice)
                    <option value="{{ $creditorOffice->id }}">{{ $creditorOffice->office_name }}</option>
                    @endforeach
                  </select>
                  <x-input-error class="mt-2" :messages="$errors->get('creditor_office_id')" />
                </div>

                <div class="col-md-4">

                  <x-input-label for="transactionID"> {{ __("Transaction ID") }} {{ __("(optional)") }}</x-input-label>
                  <x-text-input 
                    type="text" 
                    name="transaction_id" 
                    id="transactionID" 
                    :value="old('transaction_id', '')" 
                  />
                  
                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                  
                  <x-input-error class="mt-2" :messages="$errors->get('transaction_id')" />

                </div>
                

                <div class="col-md-4">
                  <x-input-label for="paymentDate"> {{ __("Payment Date") }}</x-input-label>
                  <x-text-input 
                    type="date" 
                    name="payment_date" 
                    id="paymentDate" 
                    :value="old('payment_date', date('Y-m-d'))" 
                    required 
                  />
                  
                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                  
                  <x-input-error class="mt-2" :messages="$errors->get('payment_date')" />

                </div>

                <div class="col-12">
                  <x-primary-button>{{ __('Save') }}</x-primary-button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </section>

  
  
</x-app-layout>