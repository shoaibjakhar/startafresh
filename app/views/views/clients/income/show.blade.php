<x-app-layout>
	
    <div class="pagetitle">
      <h1>Income Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('clients') }}">Clients</a></li>
          <li class="breadcrumb-item active">Income Details</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Income Details</h5>
              @if(session('success'))
              <x-alerts.success>
                  {{ session('success') }}
                </x-alerts.success>
              @endif
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>SR#</th>
                    <th>Income Type</th>
                    <th>Amount</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($user->clientIncomes as $key => $clientIncome)
                  	<tr>
                      <td>{{ $key+1 }}</td>
                      <td>
                         {{ $clientIncome->income_type_key }}
                      </td>
                      <td>
                         {{ $clientIncome->amount }}
                      </td>
                      <td>
                        <x-buttons.delete :href="url('income/'. $clientIncome->id .'/delete')">
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