<x-app-layout>
  
    <div class="pagetitle">
      <h1>Create User</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Users</a></li>
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
                <x-buttons.warning :href="url('users')">{{ __("Back") }}</x-button.warning>
              </h5>
              <h5 class="card-title">Create</h5>

              <form action="{{ url('users') }}" method="POST" class="row g-3 needs-validation" novalidate>
                
                @csrf
                
                <div class="col-md-4">
                  <x-input-label for="userName"> {{ __("Name") }}</x-input-label>
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

                  <x-input-label for="userEmail"> {{ __("Email") }}</x-input-label>
                  <x-text-input 
                    type="text" 
                    name="name" 
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
                    type="text" 
                    name="name" 
                    id="userPassword" 
                    :value="old('password', '')" 
                    required 
                  />
                  
                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                  
                  <x-input-error class="mt-2" :messages="$errors->get('password')" />

                </div>

                <div class="col-md-4">
                  <label for="roles" class="form-label">Roles</label>
                  <select name="roles[]" class="form-select" multiple id="" required>
                    <option selected disabled value="">Choose...</option>
                    <option>Choose Role</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                  </select>
                  <x-input-error class="mt-2" :messages="$errors->get('roles')" />
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