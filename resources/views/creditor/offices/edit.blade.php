<x-app-layout>

    <div class="pagetitle">
      <h1>Edit Creditor Office</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('creditor_offices') }}">Creditor Offices</a></li>
          <li class="breadcrumb-item">Creditor Offices</li>
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
                <x-buttons.warning :href="url('clients')">{{ __("Back") }}</x-button.warning>
              </h5>
              <h5 class="card-title">Creditor Office Information</h5>

              <form action="{{ URL::to('creditor_offices/'.$creditorOffice->id.'/update') }}" method="POST" class="row g-3 needs-validation" novalidate>

                @csrf

                <div class="col-md-4">
                  <x-input-label for="officeName"> {{ __("Office Name") }}</x-input-label>
                  <x-text-input
                    type="text"
                    name="office_name"
                    id="officeName"
                    :value="$creditorOffice->office_name ?? old('office_name')"
                    required
                  />

                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>

                  <x-input-error class="mt-2" :messages="$errors->get('office_name')" />

                </div>

                <div class="col-md-4">
                  <label for="creditorGroup" class="form-label">Creditor Group</label>
                  <select name="group_key" class="form-select" id="" required>
                    <option selected disabled value="">Choose...</option>
                    @foreach($creditorGroups as $creditorGroup)
                    <option value="{{ $creditorGroup->key }}" @if($creditorOffice->group_key == $creditorGroup->key) selected @endif>{{ $creditorGroup->value }}</option>
                    @endforeach
                  </select>
                  <x-input-error class="mt-2" :messages="$errors->get('group_key')" />
                </div>


                <div class="col-md-4">
                  <x-input-label for="address1"> {{ __("Address 1") }}</x-input-label>
                  <x-text-input
                    type="text"
                    name="addresses[]"
                    id="address1"
                    :value="$creditorOffice->address1 ?? old('address1')"
                  />

                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>

                  <x-input-error class="mt-2" :messages="$errors->get('address1')" />

                </div>

                <div class="col-md-4">
                  <x-input-label for="address2"> {{ __("Address 2") }}</x-input-label>
                  <x-text-input
                    type="text"
                    name="addresses[]"
                    id="address2"
                    :value="$creditorOffice->address1 ?? old('address1', '')"
                  />

                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>

                  <x-input-error class="mt-2" :messages="$errors->get('address2')" />

                </div>

                <div class="col-md-4">
                  <x-input-label for="townCity"> {{ __("City Town") }}</x-input-label>
                  <x-text-input
                    type="text"
                    name="town_city"
                    id="townCity"
                    :value="$creditorOffice->town_city ?? old('town_city')"
                  />

                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>

                  <x-input-error class="mt-2" :messages="$errors->get('town_city')" />

                </div>

                <div class="col-md-4">
                  <x-input-label for="postCode"> {{ __("Post Code") }}</x-input-label>
                  <x-text-input
                    type="text"
                    name="postcode"
                    id="postCode"
                    :value="$creditorOffice->postcode ?? old('postcode')"
                  />

                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>

                  <x-input-error class="mt-2" :messages="$errors->get('postcode')" />

                </div>

                <div class="col-md-4">
                  <x-input-label for="primaryPhone"> {{ __("Primary Phone") }}</x-input-label>
                  <x-text-input
                    type="text"
                    name="primary_phone"
                    id="primaryPhone"
                    :value="$creditorOffice->primary_phone ?? old('primary_phone')"
                  />

                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>

                  <x-input-error class="mt-2" :messages="$errors->get('primary_phone')" />

                </div>

                <div class="col-md-4">

                  <x-input-label for="primaryEmail"> {{ __("Primary Email") }}</x-input-label>
                  <x-text-input
                    type="email"
                    name="primary_email"
                    id="primaryEmail"
                    :value="$creditorOffice->primary_email ?? old('primary_email')"
                  />

                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>

                  <x-input-error class="mt-2" :messages="$errors->get('primary_email')" />

                </div>


                <div class="row">
                  <h5 class="card-title">Contact Information</h5>

                  <div class="col-md-4">
                    <x-input-label for="contactForename"> {{ __("Contact Forename") }}</x-input-label>
                    <x-text-input
                      type="text"
                      name="contact_forename"
                      id="contactForename"
                      :value="$creditorOffice->contact_forename ?? old('contact_forename')"
                    />

                    <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>

                    <x-input-error class="mt-2" :messages="$errors->get('contact_forename')" />

                  </div>

                  <div class="col-md-4">
                    <x-input-label for="contactsurname"> {{ __("Contact Surname") }}</x-input-label>
                    <x-text-input
                      type="text"
                      name="contact_surname"
                      id="contactsurname"
                      :value="$creditorOffice->contact_surname ?? old('contact_surname')"
                    />

                    <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>

                    <x-input-error class="mt-2" :messages="$errors->get('contact_surname')" />

                  </div>

                  <div class="col-md-4">
                    <x-input-label for="contactMobile"> {{ __("Contact Mobile") }}</x-input-label>
                    <x-text-input
                      type="text"
                      name="contact_mobile"
                      id="contactMobile"
                      :value="$creditorOffice->contact_mobile ?? old('contact_mobile')"
                    />

                    <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>

                    <x-input-error class="mt-2" :messages="$errors->get('contact_mobile')" />

                  </div>

                  <div class="col-md-4">

                    <x-input-label for="contactEmail"> {{ __("Contact Email") }}</x-input-label>
                    <x-text-input
                      type="email"
                      name="contact_email"
                      id="contactEmail"
                      :value="$creditorOffice->contact_email ?? old('contact_email')"
                    />

                    <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>

                    <x-input-error class="mt-2" :messages="$errors->get('contact_email')" />

                  </div>
                </div>


                <div class="col-md-4">
                  <x-input-label for="accountNumber"> {{ __("Account Number") }}</x-input-label>
                  <x-text-input
                    type="text"
                    name="account_number"
                    id="accountNumber"
                    :value="$creditorOffice->account_number ?? old('account_number')"
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
                    :value="$creditorOffice->sort_code_number ?? old('sort_code_number')"
                  />

                  <x-input-looks-good>{{ __("Looks good!") }}</x-input-looks-good>

                  <x-input-error class="mt-2" :messages="$errors->get('sort_code_number')" />

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
