<x-app-layout>

    <div class="pagetitle">
      <h1>Client Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('clients') }}">Clients</a></li>
          <li class="breadcrumb-item active">Client Details</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Client Details</h5>
              @if(session('success'))
              <x-alerts.success>
                  {{ session('success') }}
                </x-alerts.success>
              @endif
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Full Name</th>
                    <th>DOB</th>
                    <th>NI Number</th>
                    <th>Address</th>
                    <th>Post Code</th>
                    <th>Bank Name</th>
                    <th>Account Number</th>
                    <th>Sort Code Number</th>
                    <th>Answers to Security Questions</th>
                  </tr>
                </thead>
                <tbody>
                  	<tr>
                      <td>{{ $user->name }} {{ $user->clientDetails->surname }}</td>
                      <td>{{ $user->clientDetails->dob }} </td>
                      <td>{{ $user->clientDetails->ni_number }} </td>
                      <td>{{ $user->clientDetails->address }} </td>
                      <td>{{ $user->clientDetails->postcode }} </td>
                      <td>{{ $user->clientDetails->bank_name }} </td>
                      <td>{{ $user->clientDetails->account_number }} </td>
                      <td>{{ $user->clientDetails->sort_code_number }} </td>

                      @if($user->clientDetails->answers_to_securiety_questions)
                        <?php
                          $answers_to_securiety_questions = json_decode($user->clientDetails->answers_to_securiety_questions);
                        ?>
                      @endif

                      <td>
                        @foreach($answers_to_securiety_questions as $key => $answers_to_securiety_question)

                          <li>{{ $key }} {{ $answers_to_securiety_question }}</li>

                        @endforeach
                      </td>
                      
                    </tr>
                </tbody>
              </table>

            </div>
          </div>

        </div>
      </div>
    </section>


</x-app-layout>
