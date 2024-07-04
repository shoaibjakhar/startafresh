<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ExpenditureType;
use App\Models\ClientExpenditure;
use Illuminate\Support\Facades\DB;

class ExpenditureController extends Controller
{
    public function create(User $user)
    {

        $expenditureTypes = ExpenditureType::all();
        return view('clients.expenditure.create', [
            'user' => $user,
            'expenditureTypes' => $expenditureTypes
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'userId' => 'required',
            'expenditure_type_key' => 'required|max:255',
            'amount' => 'required',
        ]);

        $expenditure = DB::table('client_expenditures')->insert([
            'user_id' => $request->userId,
            'expenditure_type_key' => $request->expenditure_type_key,
            'amount' => $request->amount,
        ]);

        return redirect('/clients')->with('status', "Expenditure Created Successfully!");

    }

    public function edit(User $user)
    {

        $expenditureTypes = ExpenditureType::all();

        return view('clients.expenditure.edit', [
            'user' => $user,
            'expenditureTypes' => $expenditureTypes,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'userId' => 'required',
            'expenditureType' => 'required|max:255',
            'amount' => 'required',
        ]);

        foreach($request->ids as $key => $expenditureId){
            $client_expenditure = ClientExpenditure::find($expenditureId);

            $client_expenditure->expenditure_type_key = $request->expenditureType[$key];
            $client_expenditure->amount = $request->amount[$key];
            $client_expenditure->update();
        }

        return redirect('expenditure/'.$request->userId.'/show')->with('status', "Expenditure Updated Successfully!");
    }

    public function show(User $user) {

        return view('clients.expenditure.show', [
            'user' => $user
        ]);

    }

    public function destroy($clientExpenditureId) {

        $clientExpenditure = ClientExpenditure::findOrFail($clientExpenditureId);
        $clientExpenditure->delete();

        return redirect()->back()->with('success', "Client Expenditure Deleted Successfully!");

    }
}
