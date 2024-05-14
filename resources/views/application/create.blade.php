<x-app-layout>
  
    <div class="pagetitle">
      <h1>Create Application</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('applications') }}">Application</a></li>
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
                <x-buttons.warning :href="url('applications')">{{ __("Back") }}</x-button.warning>
              </h5>
              <h5 class="card-title">Create</h5>

              <form action="{{ url('applications') }}" method="POST" class="row g-3 needs-validation" novalidate>
                
                @csrf

                <div class="col-md-4">
                  <label for="UserName" class="form-label">Client</label>
                  
                  <select name="user_id" class="form-select" id="" required>
                    <option selected disabled value="">Choose...</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                  </select>

                  <x-input-error class="mt-2" :messages="$errors->get('user_id')" />
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