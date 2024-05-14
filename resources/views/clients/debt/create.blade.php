<x-app-layout>

    <div class="pagetitle">
      <h1>Create Debt</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('clients') }}">Debt</a></li>
          <li class="breadcrumb-item">Debt</li>
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
                <x-buttons.warning :href="url('clients')">Back</x-buttons.back>
              </h5>

              <h5 class="card-title">Create</h5>

              <form action="{{ url('debt') }}" method="POST" class="row g-3 needs-validation" novalidate>

                @csrf

                <input type="hidden" name="user_id" value="{{ $user->id }}">

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
                  <x-input-label for="debtReference"> {{ __("Debt Reference") }}</x-input-label>
                  <x-text-input 
                    type="text" 
                    name="debt_reference" 
                    id="debtReference" 
                    value="{{ old('debtReference', '') }}" 
                  />
                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                  <x-input-error 
                    class="mt-2" 
                    :messages="$errors->get('debtReference')" 
                    />
                </div>

                <div class="col-md-4">
                  <x-input-label for="Balance"> {{ __("Balance") }}</x-input-label>
                  <x-text-input 
                    type="number" 
                    name="balance" 
                    id="Balance" 
                    value="{{ old('balance', '') }}" 
                    required 
                    placeholder="0.00" 
                  />
                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                  <x-input-error 
                    class="mt-2" 
                    :messages="$errors->get('balance')" 
                    />
                </div>

                <div class="col-md-4">
                  <x-input-label for="totalPaid"> {{ __("Total Paid") }}</x-input-label>
                  <x-text-input 
                    type="number" 
                    name="total_paid" 
                    id="totalPaid" 
                    value="{{ old('total_paid', '') }}" 
                    required 
                    placeholder="0.00" 
                  />
                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                  <x-input-error 
                    class="mt-2" 
                    :messages="$errors->get('total_paid')" 
                    />
                </div>

                <div class="col-md-4">
                  <x-input-label for="currentDebt"> {{ __("Current Debt") }}</x-input-label>
                  <x-text-input 
                    type="number" 
                    name="current_debt" 
                    id="currentDebt" 
                    value="{{ old('current_debt', '') }}" 
                    required 
                    placeholder="0.00" 
                  />
                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                  <x-input-error 
                    class="mt-2" 
                    :messages="$errors->get('current_debt')" 
                    />
                </div>

                <div class="col-md-4">
                  <x-input-label for="offer"> {{ __("Offer") }}</x-input-label>
                  <x-text-input 
                    type="number" 
                    name="offer" 
                    id="offer" 
                    value="{{ old('offer', '') }}" 
                    required 
                    placeholder="0.00" 
                  />
                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                  <x-input-error 
                    class="mt-2" 
                    :messages="$errors->get('offer')" 
                    />
                </div>


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

                <div class="row">
                <h5 class="card-title">Notes</h5>
                  <div class="col-md-8">
                    <x-input-label for="notes"> {{ __("Notes") }}</x-input-label>
                    <x-textarea 
                      name="notes"
                      cols="" 
                      rows="5"
                      placeholder="Write Notes...">{{ old('notes', '') }}</x-textarea>
                    
                    <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                    
                    <x-input-error class="mt-2" :messages="$errors->get('notes')" />

                  </div>
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