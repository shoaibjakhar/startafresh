<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\PaymentsToCreditors;

class PaymentsToCreditorsController extends Controller
{
    public function index(Application $application) {

          return view('clients.payments.to_creditors.index', [
            'application' => $application,
        ]);
    }

    public function create(Application $application) {

        $application->load([
            'user.clientDetails',
            'user.clientDebts',
            'user.clientDebts.creditorOffice',
        ]);

        // dd($application->user->clientDebts);
        


        return view('clients.payments.to_creditors.create', [
            'application' => $application,
        ]);

    }

    public function store(Request $request) {
        
        $request->validate([
            'application_id' => 'required',
            'client_id' => 'required',
            'amount' => 'required',
            'creditor_office_id' => 'required',
            'transaction_id' => 'required',
            'payment_date' => 'required',
        ]);

        PaymentsToCreditors::create([
            'application_id' => $request->application_id,
            'client_id' => $request->client_id,
            'amount' => $request->amount,
            'creditor_office_id' => $request->creditor_office_id,
            'transaction_id' => $request->transaction_id,
            'payment_date' => $request->payment_date,
        
        ]);

        return redirect('applications')->with('success', 'Creditor Payment Created Successfully!');

    }

    public function edit($paymentsToCreditorId) {
        $paymentsToCreditor = PaymentsToCreditors::find($paymentsToCreditorId);

        return view('clients.payments.to_creditors.edit', compact('paymentsToCreditor'));
    }

    public function update(Request $request, $paymentsToCreditorId) {
        $paymentsToCreditor = PaymentsToCreditors::find($paymentsToCreditorId)->update([
            'amount' => $request->amount,
            'transaction_id' => $request->transaction_id,
            'payment_date' => $request->payment_date,
        ]);

        return redirect('paymentsToCreditors/'.$request->application_id)->with('success', 'Client Payment Updated Successfully!');
    }

}
