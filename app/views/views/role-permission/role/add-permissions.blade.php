<x-app-layout>
  
    <div class="pagetitle">
      <h1>Role: {{ $role->name }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Roles</a></li>
          <li class="breadcrumb-item active">Permissions</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title float-right">
                <x-buttons.warning :href="url('roles')">{{ __("Back") }}</x-buttons.warning>
              </h5>
              <h5 class="card-title">Permissions</h5>
              @if(session('status'))
                <x-alerts.success>
                  {{ session('status') }}
                </x-alerts.success>
              @endif
              <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST" class="row g-3" novalidate>
                @csrf
                @method('PUT')

                <div class="col-md-4">
                  @error('permissions')
                  <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                  @foreach($permissions as $permission)
                    <div class="form-check">
                    <input 
                      class="form-check-input" 
                      type="checkbox" 
                      name="permissions[]" 
                      value="{{ $permission->name }}" 
                      id="permissions" 
                      {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                      />
                    <label class="form-check-label" for="permissions">{{ $permission->name }}</label>
                  </div>
                  @endforeach
                </div>
                
                <div class="col-12">
                  <x-primary-button>{{ __("Save") }}</x-primary-button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </section>

  
  
</x-app-layout>