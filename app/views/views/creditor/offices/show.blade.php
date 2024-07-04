<x-app-layout>
    <div class="pagetitle">
        <h1>Offices</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('creditor_offices') }}">Offices</a></li>
                <li class="breadcrumb-item active">Show</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Show Office</h5>
                        @if(session('status'))
                            <x-alerts.success>
                                {{ session('status') }}
                            </x-alerts.success>
                        @endif

                        <div style="overflow-x: auto;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Office Name</th>
                                        <th>Creditor Group</th>
                                        <th>Addresses</th>
                                        <th>Town City</th>
                                        <th>Post Code</th>
                                        <th>Primary Phone</th>
                                        <th>Primary Email</th>
                                        <th>Web</th>
                                        <th>Contact Full Name</th>
                                        <th>Contact Mobile</th>
                                        <th>Contact Email</th>
                                        <th>Fair Share</th>
                                        <th>Account Number</th>
                                        <th>Sort Code Number</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            {{-- <td>{{ $key+1 }}</td> --}}
                                            <td>{{ $creditorOffice->office_name }}</td>
                                            <td>{{ $creditorOffice->office_name }}</td>
                                            <td>{{ $creditorOffice->office_name }}</td>
                                            <td>{{ $creditorOffice->town_city }}</td>
                                            <td>{{ $creditorOffice->postcode }}</td>
                                            <td>{{ $creditorOffice->primary_phone }}</td>
                                            <td>{{ $creditorOffice->primary_email }}</td>
                                            <td>{{ $creditorOffice->web }}</td>
                                            <td>{{ $creditorOffice->contact_forename }} {{ $creditorOffice->contact_surname }}</td>
                                            <td>{{ $creditorOffice->contact_mobile }}</td>
                                            <td>{{ $creditorOffice->contact_email }}</td>
                                            <td>{{ $creditorOffice->fair_share }}</td>
                                            <td>{{ $creditorOffice->account_number }}</td>
                                            <td>{{ $creditorOffice->sort_code_number }}</td>
                                            <td>{{ $creditorOffice->created_at }}</td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
