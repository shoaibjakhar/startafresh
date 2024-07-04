<x-app-layout>

    <div class="pagetitle">
      <h1>Create Income</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('expenditure') }}">Income</a></li>
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

              <form action="{{ url('income') }}" method="POST" class="row g-3 needs-validation" novalidate>

                @csrf

                <input type="hidden" name="userId" value="{{ $user->id }}">

                <div class="col-md-4">
                  <label for="incomeType" class="form-label">Income Type</label>
                  <select name="income_type_key" class="form-select" id="" required>
                    <option selected disabled value="">Choose...</option>
                    @foreach($incomeTypes as $incomeType)
                    <option value="{{ $incomeType->key }}">{{ $incomeType->value }}</option>
                    @endforeach
                  </select>
                  <x-input-error class="mt-2" :messages="$errors->get('incomeType')" />
                </div>

                <div class="col-md-4">
                  <x-input-label for="Amount"> {{ __("Amount") }}</x-input-label>
                  <x-text-input 
                    type="number" 
                    name="amount" 
                    id="Amount" 
                    value="{{ old('amount', '') }}" 
                    required 
                    placeholder="0.00" 
                  />
                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                  <x-input-error 
                    class="mt-2" 
                    :messages="$errors->get('amount')" 
                    />
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