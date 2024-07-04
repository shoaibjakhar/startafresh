<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\IncomeType;
use App\Models\ClientIncome;

class IncomeController extends Controller
{
    public function create(User $user) {

        $incomeTypes = IncomeType::all();

        return view('clients.income.create', [
            'user' => $user,
            'incomeTypes' => $incomeTypes
        ]);

    }


    public function store(Request $request) {

        $request->validate([
            'userId' => 'required',
            'income_type_key' => 'required|max:255',
            'amount' => 'required',
        ]);

        $income = DB::table('client_incomes')->insert([
            'user_id' => $request->userId,
            'income_type_key' => $request->income_type_key,
            'amount' => $request->amount,
        ]);

        return redirect('income/'.$request->userId.'/show')->with('status', "Income Created Successfully!");


    }

    public function edit(User $user)
    {

        $incomeTypes = IncomeType::all();

        return view('clients.income.edit', [
            'user' => $user,
            'incomeTypes' => $incomeTypes,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'userId' => 'required',
            'incomeType' => 'required|max:255',
            'amount' => 'required',
        ]);

        foreach($request->ids as $key => $incomeId){
            $client_income = ClientIncome::find($incomeId);

            $client_income->income_type_key = $request->incomeType[$key];
            $client_income->amount = $request->amount[$key];
            $client_income->update();
        }

        return redirect('income/'.$request->userId.'/show')->with('status', "Income Updated Successfully!");
    }

    public function show(User $user) {

        return view('clients.income.show', [
            'user' => $user
        ]);

    }

    public function destroy($clientIncomeId) {

        $clientIncome = ClientIncome::find($clientIncomeId);
        $clientIncome->delete();

        return redirect()->back()->with('success', "Client Income Deleted Successfully!");

    }

}
