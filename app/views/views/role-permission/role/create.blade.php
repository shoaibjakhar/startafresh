<x-app-layout>
  
    <div class="pagetitle">
      <h1>Create Role</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('roles') }}">Role</a></li>
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
                <x-buttons.warning :href="url('roles')">Back</x-buttons.back>                
              </h5>
              <h5 class="card-title">Create</h5>
    
              <form action="{{ url('roles') }}" method="POST" class="row g-3 needs-validation" novalidate>
                @csrf
                <div class="col-md-4">
                  
                  <x-input-label for="roleName"> {{ __("Role Name") }}</x-input-label>
                  <x-text-input 
                    type="text" 
                    name="name" 
                    id="roleName" 
                    :value="old('name', '')" 
                    required 
                    autofocus 
                    autocomplete="name" 
                  />
                  
                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>
                  
                  <x-input-error class="mt-2" :messages="$errors->get('name')" />

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