<x-app-layout>
  
    <div class="pagetitle">
      <h1>Create Client</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('clients') }}">Clients</a></li>
          <li class="breadcrumb-item">Income</li>
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

              <form action="{{ url('clients') }}" method="POST" class="row g-3 needs-validation" novalidate>
                
                @csrf
                
                <div class="col-md-4">
                  <x-input-label for="userName"> {{ __("Forename") }}</x-input-label>
                  <x-text-input 
                    type="text" 
                    name="name" 
                    id="userName" 
                    :value="old('name', '')" 
                    required 
                    autofocus 
                    autocomplete="name" 
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
                    :value="old('surname', '')" 
                    required 
                  />
                  
                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                  
                  <x-input-error class="mt-2" :messages="$errors->get('surname')" />

                </div>

                <div class="col-md-4">

                  <x-input-label for="userEmail"> {{ __("Email") }}</x-input-label>
                  <x-text-input 
                    type="text" 
                    name="email" 
                    id="userEmail" 
                    :value="old('email', '')" 
                    required 
                  />
                  
                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                  
                  <x-input-error class="mt-2" :messages="$errors->get('email')" />

                </div>

                <div class="col-md-4">

                  <x-input-label for="userPassword"> {{ __("Password") }}</x-input-label>
                  <x-text-input 
                    type="password" 
                    name="password" 
                    id="userPassword" 
                    :value="old('password', '')" 
                    required 
                  />
                  
                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                  
                  <x-input-error class="mt-2" :messages="$errors->get('password')" />

                </div>

                <div class="col-md-4">
                  <x-input-label for="dob"> {{ __("Date Of Birth") }}</x-input-label>
                  <x-text-input 
                    type="date" 
                    name="dob" 
                    id="dob" 
                    :value="old('dob', date('Y-m-d'))" 
                    required 
                  />
                  
                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                  
                  <x-input-error class="mt-2" :messages="$errors->get('dob')" />

                </div>

                <div class="col-md-4">
                  <x-input-label for="mobile"> {{ __("Mobile") }}</x-input-label>
                  <x-text-input 
                    type="text" 
                    name="mobile" 
                    id="mobile" 
                    :value="old('mobile', '')" 
                    required 
                  />
                  
                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                  
                  <x-input-error class="mt-2" :messages="$errors->get('mobile')" />

                </div>

                <div class="col-md-4">
                  <x-input-label for="niNumber"> {{ __("Ni Number") }}</x-input-label>
                  <x-text-input 
                    type="text" 
                    name="ni_number" 
                    id="niNumber" 
                    :value="old('ni_number', '')" 
                    required 
                  />
                  
                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                  
                  <x-input-error class="mt-2" :messages="$errors->get('ni_number')" />

                </div>
                <div class="row">
                  <h5 class="card-title">Questions</h5>

                @foreach($questions as $question)

                <div class="col-md-4">
                  <x-input-label for="questions"> {{ __($question->value) }}</x-input-label>
                  <x-text-input 
                    class="form-control" 
                    type="text" 
                    name="answers_to_securiety_questions[{{ $question->value }}]" 
                    id="" 
                    value="" 
                    required 
                  />
                  
                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                  
                  <x-input-error class="mt-2" :messages="$errors->get('answers_to_securiety_questions[{{ $question->key }}]')" />

                </div>

                @endforeach
                </div>
                
                <div class="row">
                  <h5 class="card-title">Bank Details</h5>
                  <div class="col-md-4">
                    <x-input-label for="bankName"> {{ __("Bank Name") }}</x-input-label>
                    <x-text-input 
                      type="text" 
                      name="bank_name" 
                      id="bankName" 
                      :value="old('bank_name', '')" 
                      required 
                    />
                    
                    <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                    
                    <x-input-error class="mt-2" :messages="$errors->get('bank_name')" />

                  </div>

                <div class="col-md-4">
                  <x-input-label for="accountNumber"> {{ __("Account Number") }}</x-input-label>
                  <x-text-input 
                    type="text" 
                    name="account_number" 
                    id="accountNumber" 
                    :value="old('account_number', '')" 
                    required 
                  />
                  
                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                  
                  <x-input-error class="mt-2" :messages="$errors->get('account_number')" />

                </div>

                <div class="col-md-4">
                  <x-input-label for="sortCodeNumber"> {{ __("Sort Code Number") }}</x-input-label>
                  <x-text-input 
                    type="text" 
                    name="sort_code_number" 
                    id="sortCodeNumber" 
                    :value="old('sort_code_number', '')" 
                    required 
                  />
                  
                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                  
                  <x-input-error class="mt-2" :messages="$errors->get('sort_code_number')" />

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