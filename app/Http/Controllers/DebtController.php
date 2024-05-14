<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CreditorOffice;
use App\Models\ClientDebt;

class DebtController extends Controller
{
    
    public function create(User $user) {

        $creditorOffices = CreditorOffice::all();

        return view('clients.debt.create', [
            'user' => $user,
            'creditorOffices' => $creditorOffices
        ]);

    }

    public function store(Request $request) {

        $request->validate([
            'user_id' => 'required',
            'creditor_office_id' => 'required',
            'debt_reference' => 'max:255',
            'balance' => 'required',
            'total_paid' => 'required',
            'current_debt' => 'required',
            'offer' => 'required',
        ]);

        $client_debt = ClientDebt::create([
            'user_id' => $request->user_id,
            'creditor_office_id' => $request->creditor_office_id,
            'debt_reference' => $request->debt_reference,
            'balance' => $request->balance,
            'total_paid' => $request->total_paid,
            'current_debt' => $request->current_debt,
            'offer' => $request->offer,
            'acceptance_status' => $request->acceptance_status,
            'acceptance_date' => $request->acceptance_date,
            'notes' => $request->notes,
        ]);

        return redirect('clients')->with('success', "Client Debt Created Successfully!");

    }

    public function show(User $user) {

        return view('clients.debt.show', [
            'user' => $user
        ]);

    }
}
