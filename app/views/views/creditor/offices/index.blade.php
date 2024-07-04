<x-app-layout>
    <div class="pagetitle">
        <h1>Offices</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('creditor_offices') }}">Offices</a></li>
                <li class="breadcrumb-item active">All</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title float-right">
                            <x-buttons.add :href="url('creditor_offices/create')">Add Office</x-buttons.add>
                        </h5>
                        <h5 class="card-title">Offices</h5>
                        @if(session('status'))
                            <x-alerts.success>
                                {{ session('status') }}
                            </x-alerts.success>
                        @endif

                        <div style="overflow-x: auto;">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>SR#</th>
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($creditor_offices as $key => $creditor_office)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $creditor_office->office_name }}</td>
                                            <td>{{ $creditor_office->office_name }}</td>
                                            <td>{{ $creditor_office->office_name }}</td>
                                            <td>{{ $creditor_office->town_city }}</td>
                                            <td>{{ $creditor_office->postcode }}</td>
                                            <td>{{ $creditor_office->primary_phone }}</td>
                                            <td>{{ $creditor_office->primary_email }}</td>
                                            <td>{{ $creditor_office->web }}</td>
                                            <td>{{ $creditor_office->contact_forename }} {{ $creditor_office->contact_surname }}</td>
                                            <td>{{ $creditor_office->contact_mobile }}</td>
                                            <td>{{ $creditor_office->contact_email }}</td>
                                            <td>{{ $creditor_office->fair_share }}</td>
                                            <td>{{ $creditor_office->account_number }}</td>
                                            <td>{{ $creditor_office->sort_code_number }}</td>
                                            <td>{{ $creditor_office->created_at }}</td>
                                            <td>
                                                <x-buttons.view :href="url('creditor_offices/'. $creditor_office->id .'/show')">
                                                    {{ __("View") }}
                                                </x-buttons.view>
                                                @can('edit client')
                                                    <x-buttons.edit :href="url('creditor_offices/'. $creditor_office->id .'/edit')">
                                                        {{ __("Edit") }}
                                                    </x-buttons.edit>
                                                @endcan
                                                @can('delete client')
                                                    <x-buttons.delete :href="url('creditor_offices/'. $creditor_office->id .'/delete')">
                                                        {{ __("Delete") }}
                                                    </x-buttons.delete>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
