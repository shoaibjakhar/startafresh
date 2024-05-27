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
            'current_debt' => 'required',
        ]);

        $client_debt = ClientDebt::create([
            'user_id' => $request->user_id,
            'creditor_office_id' => $request->creditor_office_id,
            'debt_reference' => $request->debt_reference,
            'current_debt' => $request->current_debt,
            'notes' => $request->notes,
        ]);

        return redirect('clients')->with('success', "Client Debt Created Successfully!");

    }

    public function show(User $user) {

        $user->load('clientDebts.creditorOffice');        

        return view('clients.debt.show', [
            'user' => $user
        ]);

    }
}
