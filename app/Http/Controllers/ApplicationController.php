<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Application;
use App\Models\CreditorOffice;
use App\Models\Payment;
use Auth;

class ApplicationController extends Controller
{
    public function index() {

        $applications = Application::all();
        return view('application.index', [
            'applications' => $applications
        ]);
    }

    public function create() {
        
        $users = User::Role(['Client'])->get();
        return view('application.create', [
            'users' => $users
        ]);

    }

    public function store(Request $request) {

        $request->validate([
            'user_id' => 'required',
            'notes' => 'required',
        ]);

        $application = Application::create([
            'user_id' => $request->user_id,
            'created_by' => Auth::id(),
            'notes' => $request->notes
        ]);

        return redirect('applications')->with('success', "Application Created Successfully!");

    }

    public function edit(Application $application) {

        dd($application);

    }

    public function mdiAndPaymentsCalcualtions(Application $application)
    {

        $application->load([
            'user.clientDetails',
            'user.clientIncomes',
            'user.clientExpenditures',
            'user.clientDebts',
            'user.clientDebts.creditorOffice'
        ]);


        $total_clientIncome = 0;
        $total_clientExpenditure = 0;
        $total_clientDebt = 0;

        foreach($application->user->clientIncomes as $clientIncome) {
            $total_clientIncome += $clientIncome->amount;
        }


        foreach($application->user->clientExpenditures as $clientExpenditure) {
            $total_clientExpenditure += $clientExpenditure->amount;
        }

        foreach($application->user->clientDebts as $clientDebt) {
            $total_clientDebt += $clientDebt->current_debt;
        }

        $MDI = $total_clientIncome - $total_clientExpenditure;

        $amountt = [625, 375];

        return view('application.payments', [

            'application' => $application,
            'total_clientIncome' => $total_clientIncome,
            'total_clientExpenditure' => $total_clientExpenditure,
            'MDI' => $MDI,
            'total_clientDebt' => $total_clientDebt,
            '$amountt' => $amountt,


        ]);

    }

    public function paymentsFromClient(Application $application)
    {

        $payments = $application->load('payments');

        return view('clients.payments.index', [
            'application' => $application,
            'payments' => $payments
        ]);

        dd($application);

        $application->load([
            'user.clientDetails',
            'user.clientIncomes',
            'user.clientExpenditures',
            'user.clientDebts',
            'user.clientDebts.creditorOffice'
        ]);


        $total_clientIncome = 0;
        $total_clientExpenditure = 0;
        $total_clientDebt = 0;

        foreach($application->user->clientIncomes as $clientIncome) {
            $total_clientIncome += $clientIncome->amount;
        }


        foreach($application->user->clientExpenditures as $clientExpenditure) {
            $total_clientExpenditure += $clientExpenditure->amount;
        }

        foreach($application->user->clientDebts as $clientDebt) {
            $total_clientDebt += $clientDebt->current_debt;
        }

        $MDI = $total_clientIncome - $total_clientExpenditure;

        $amountt = [625, 375];

        return view('application.payments', [

            'application' => $application,
            'total_clientIncome' => $total_clientIncome,
            'total_clientExpenditure' => $total_clientExpenditure,
            'MDI' => $MDI,
            'total_clientDebt' => $total_clientDebt,
            '$amountt' => $amountt,


        ]);

    }

    public function addClientPayment(Application $application)
    {

        $application->load('user.clientDetails');

        $creditorOffices = CreditorOffice::all();

        return view('clients.payments.create', [
            'application' => $application,
            'creditorOffices' => $creditorOffices,
        ]);
        
    }

    public function saveClientPayment(Request $request) {
        
        $request->validate([
            'application_id' => 'required',
            'client_id' => 'required',
            'amount' => 'required',
            'creditor_office_id' => 'required',
            'transaction_id' => 'required',
            'payment_date' => 'required',
        ]);

        Payment::create([
            'application_id' => $request->application_id,
            'client_id' => $request->client_id,
            'amount' => $request->amount,
            'creditor_office_id' => $request->creditor_office_id,
            'transaction_id' => $request->transaction_id,
            'payment_date' => $request->payment_date,
        
        ]);

        return redirect('applications')->with('success', 'Client Payment Created Successfully!');
    }

    public function paymentsFromCreditors(Application $application)
    {

        dd($application);

    }

    

}
