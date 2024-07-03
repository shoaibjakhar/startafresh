<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\PaymentsFromClients;

class PaymentsFromClientsController extends Controller
{
    public function index(Application $application) {

        $payments = $application->load('paymentsFromClients.creditorOffice');

        return view('clients.payments.from_clients.index', [
            'application' => $application,
            'payments' => $payments
        ]);

    }

    public function create(Application $application) {
        
        $application->load([
            'user.clientDetails',
            'user.clientDebts',
            'user.clientDebts.creditorOffice',
        ]);

        return view('clients.payments.from_clients.create', [
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

        PaymentsFromClients::create([
            'application_id' => $request->application_id,
            'client_id' => $request->client_id,
            'amount' => $request->amount,
            'creditor_office_id' => $request->creditor_office_id,
            'transaction_id' => $request->transaction_id,
            'payment_date' => $request->payment_date,
            'ccj' => $request->ccj ?? false,
        
        ]);

        return redirect('applications')->with('success', 'Client Payment Created Successfully!');

    }

    public function edit() {
        
    }

    public function update() {
        
    }

    public function destroy() {
        
    }
    public function getAmount(Request $request) {

        $creditor_office_id = $request->get('creditor_office_id');
        $application_id = $request->get('application_id');

        $application = Application::findOrFail($application_id);

        $application->load([
            'user.clientDetails',
            'user.clientIncomes',
            'user.clientExpenditures',
            'user.clientDebts',
            'user.clientDebts.creditorOffice',
            'user.clientDebts.creditorOffice.CcjAmounts'
        ]);
        $total_clientIncome = 0;
        $total_clientExpenditure = 0;
        $total_clientDebt = 0;
        $ccjAmount = 0;

        foreach($application->user->clientIncomes as $clientIncome) {
            $total_clientIncome += $clientIncome->amount;
        }


        foreach($application->user->clientExpenditures as $clientExpenditure) {
            $total_clientExpenditure += $clientExpenditure->amount;
        }

        foreach($application->user->clientDebts as $clientDebt) {

            $total_clientDebt += $clientDebt->current_debt;
        }

        $total_clientDebt_for_mdi = $total_clientDebt;

        foreach($application->user->clientDebts as $clientDebt) {
// echo $clientDebt->creditorOffice->id . "ccj amount = ";
            if(!empty($clientDebt->creditorOffice->ccjAmounts->amount) && $application->id == $clientDebt->creditorOffice->ccjAmounts->application_id){

                $ccjAmount += $clientDebt->creditorOffice->ccjAmounts->amount;
                $total_clientDebt_for_mdi -= $clientDebt->current_debt;
                $amount = $ccjAmount;
            } else {

                $MDI = $total_clientIncome - $total_clientExpenditure;

        $amount = $MDI - $ccjAmount;

            }


        }


        $MDI = $total_clientIncome - $total_clientExpenditure;

        $MDI = $MDI - $ccjAmount;
        return response()->json(['amount' => $amount]);

        
    }

    public function getAmount1(Request $request)
    {
        $creditor_office_id = $request->get('creditor_office_id');
        $application_id = $request->get('application_id');

        $application = Application::findOrFail($application_id);
        $application->load([
            'user.clientDetails',
            'user.clientDebts',
            'user.clientExpenditures',
            'user.clientDebts.creditorOffice',
            'user.clientDebts.creditorOffice.CcjAmounts',
        ]);

        $user = $application->user;

        $totalDebt = $user->clientDebts->sum('current_debt');
          // Filter the clientDebts to find the debt for the given creditor_office_id
        
        $debt = $application->user->clientDebts->filter(function($clientDebt) use ($creditor_office_id) {
            return $clientDebt->creditor_office_id == $creditor_office_id;
        })->first();

        $totalIncome        = $user->clientIncomes->sum('amount');
        $totalExpenditure   = $user->clientExpenditures->sum('amount');

        $ccjAmount = 0;
        $amount = 0;
        $total_clientDebt_for_mdi = $totalIncome - $totalExpenditure;
        // $total_clientDebt_for_mdi = $totalDebt;
dd($debt);
        if(!empty($debt->creditorOffice->ccjAmounts->amount) && $application->id == $debt->creditorOffice->ccjAmounts->application_id){

            $amount += $debt->creditorOffice->ccjAmounts->amount;
            $total_clientDebt_for_mdi -= $debt->current_debt;

        } else {
            $amount = $debt->current_debt/$totalDebt * $total_clientDebt_for_mdi;
        }
// dd($total_clientDebt_for_mdi);

        
        

        return response()->json(['amount' => $amount]);
    }



}
