<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Application;
use App\Models\CreditorOffice;
use App\Models\Payment;
use App\Models\CcjAmounts;
use Auth;

class ApplicationController extends Controller
{
public function index()
    {

        // Eager load the necessary relationships
        $applications = Application::with(['user.clientDebts', 'user.clientIncomes', 'paymentsFromClients'])->get();

        // Compute additional data for each application
        $applications->each(function ($application) {
            $user = $application->user;
            $totalDebt = $user->clientDebts->sum('current_debt');
            $totalIncome = $user->clientIncomes->sum('amount');
            $totalPaidDebt = $application->paymentsFromClients->sum('amount');

            // Attach the computed values to the application
            $application->totalDebt = $totalDebt;
            $application->totalIncome = $totalIncome;
            $application->totalPaidDebt = $totalPaidDebt;
        });

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
            'user_id2' => $request->user_id2 ?? '',
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

            if(!empty($clientDebt->creditorOffice->ccjAmounts->amount) && $application->id == $clientDebt->creditorOffice->ccjAmounts->application_id){

                $ccjAmount += $clientDebt->creditorOffice->ccjAmounts->amount;
                $total_clientDebt_for_mdi -= $clientDebt->current_debt;
            }


        }


        $MDI = $total_clientIncome - $total_clientExpenditure;

        $MDI = $MDI - $ccjAmount;

        $amountt = [625, 375];
// dd([

//             'application' => $application,
//             'total_clientIncome' => $total_clientIncome,
//             'total_clientExpenditure' => $total_clientExpenditure,
//             'MDI' => $MDI,
//             'total_clientDebt' => $total_clientDebt,
//             'total_clientDebt_for_mdi' => $total_clientDebt_for_mdi,
//             '$amountt' => $amountt,


//         ]);
        return view('application.payments', [

            'application' => $application,
            'total_clientIncome' => $total_clientIncome,
            'total_clientExpenditure' => $total_clientExpenditure,
            'MDI' => $MDI,
            'total_clientDebt' => $total_clientDebt,
            'total_clientDebt_for_mdi' => $total_clientDebt_for_mdi,
            '$amountt' => $amountt,


        ]);

    }

    // public function paymentsFromClient(Application $application)
    // {

    //     $payments = $application->load('payments.creditorOffice');

    //     // dd($application);

    //     return view('clients.payments.index', [
    //         'application' => $application,
    //         'payments' => $payments
    //     ]);

    // }    

    // public function addClientPayment(Application $application)
    // {

    //     $application->load([
    //         'user.clientDetails',
    //         'user.clientDebts',
    //         'user.clientDebts.creditorOffice',
    //     ]);

    //     // dd($application->user->clientDebts);
        


    //     return view('clients.payments.create', [
    //         'application' => $application,
    //     ]);
        
    // }

    // public function saveClientPayment(Request $request) {
        
    //     $request->validate([
    //         'application_id' => 'required',
    //         'client_id' => 'required',
    //         'amount' => 'required',
    //         'creditor_office_id' => 'required',
    //         'transaction_id' => 'required',
    //         'payment_date' => 'required',
    //     ]);

    //     Payment::create([
    //         'application_id' => $request->application_id,
    //         'client_id' => $request->client_id,
    //         'amount' => $request->amount,
    //         'creditor_office_id' => $request->creditor_office_id,
    //         'transaction_id' => $request->transaction_id,
    //         'payment_date' => $request->payment_date,
        
    //     ]);

    //     return redirect('applications')->with('success', 'Client Payment Created Successfully!');
    // }

    public function paymentsToCreditors(Application $application)
    {

        // $payments = $application->load('payments.creditorOffice');

        // dd($application);

        return view('clients.payments.to_creditors.index', [
            'application' => $application,
        ]);

    }

    public function add_ccj(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'application_id' => 'required',
            'creditor_office_id' => 'required',
        ]);

        $application = CcjAmounts::create([
            'amount' => $request->amount,
            'application_id' => $request->application_id,
            'creditor_office_id' => $request->creditor_office_id
        ]);
        return redirect()->back()->with('Success', 'CCJ Amount Added Successfully!');
    }

    

}
