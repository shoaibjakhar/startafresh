<x-app-layout>
	
    <div class="pagetitle">
      <h1>Expenditure Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('clients') }}">Clients</a></li>
          <li class="breadcrumb-item active">Expenditure Details</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Expenditure Details</h5>
              @if(session('success'))
              <x-alerts.success>
                  {{ session('success') }}
                </x-alerts.success>
              @endif
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>SR#</th>
                    <th>Expenditure Type</th>
                    <th>Amount</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($user->clientExpenditures as $key => $clientExpenditure)
                  	<tr>
                      <td>{{ $key+1 }}</td>
                      <td>
                         {{ $clientExpenditure->expenditure_type_key }}
                      </td>
                      <td>
                         {{ $clientExpenditure->amount }}
                      </td>
                      <td>
                        <x-buttons.delete :href="url('expenditure/'. $clientExpenditure->id .'/delete')">
                          {{ __("Delete") }}
                        </x-buttons.delete>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

            </div>
          </div>

        </div>
      </div>
    </section>

  
</x-app-layout>