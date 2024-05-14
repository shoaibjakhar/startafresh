<x-app-layout>

    <div class="pagetitle">
      <h1>Edit Expenditure</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('clients') }}">Clients</a></li>
          <li class="breadcrumb-item">Expenditures</li>
          <li class="breadcrumb-item active">Edit</li>
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

              <h5 class="card-title">Edit</h5>

              <form action="{{ url('expenditure') }}" method="POST" class="row g-3 needs-validation" novalidate>

                @csrf
                @method('PUT')

                <input type="hidden" name="userId" value="{{ $user->id }}">

                @foreach($user->clientExpenditures as $clientExpenditure)
                <div class="row">
                  
                  <div class="col-md-4">
                    <label for="expenditureType" class="form-label">Income Type</label>
                    <select name="expenditureType" class="form-select" id="" required>
                      <option selected disabled value="">Choose...</option>
                      @foreach($expenditureTypes as $expenditureType)

                      <option {{ ($clientExpenditure->expenditure_type_key == $expenditureType->key) ? 'selected' : '' }} value="{{ $expenditureType->key }}">{{ $expenditureType->value }}</option>
                      @endforeach
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('expenditureType')" />
                  </div>


                  <div class="col-md-4">
                    <x-input-label for="Amount"> {{ __("Amount") }}</x-input-label>
                    <x-text-input 
                      type="number" 
                      name="amount" 
                      id="Amount" 
                      value="{{ $clientExpenditure->amount }}" 
                      required 
                      placeholder="0.00" 
                    />
                    <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                    <x-input-error 
                      class="mt-2" 
                      :messages="$errors->get('amount')" 
                      />
                  </div>
                
                </div>
                @endforeach
                
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