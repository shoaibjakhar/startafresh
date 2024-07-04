<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreditorOffice;
use App\Models\CreditorGroups;

class CreditorOfficeController extends Controller
{

    public function index() {

        $creditor_offices = CreditorOffice::all();

        return view('creditor.offices.index', [
            'creditor_offices' => $creditor_offices
        ]);

    }

    public function create() {

        $creditorGroups = CreditorGroups::all();

        return view('creditor.offices.create', [
            'creditorGroups' => $creditorGroups
        ]);

    }

    public function store(Request $request) {

        $request->validate([
            'office_name' => 'required|max:255',
            'group_key' => 'required|max:255',
            'addresses' => 'max:255',
            'town_city' => 'max:255',
            'postcode' => 'max:255',
            'primary_phone' => 'max:255',
            'primary_email' => 'max:255',
            'contact_forename' => 'max:255',
            'contact_surname' => 'max:255',
            'contact_mobile' => 'max:255',
            'contact_email' => 'max:255',
            'account_number' => 'max:255',
            'sort_code_number' => 'max:255',
        ]);

        $creditor_office = CreditorOffice::create([

            'office_name' =>$request->office_name,
            'group_key' =>$request->group_key,
            'addresses' => json_encode($request->addresses),
            'town_city' =>$request->town_city,
            'postcode' =>$request->postcode,
            'primary_phone' =>$request->primary_phone,
            'primary_email' =>$request->primary_email,
            'contact_forename' =>$request->contact_forename,
            'contact_surname' =>$request->contact_surname,
            'contact_mobile' =>$request->contact_mobile,
            'contact_email' =>$request->contact_email,
            'account_number' =>$request->account_number,
            'sort_code_number' =>$request->sort_code_number,
        ]);

        return redirect('creditor_offices')->with('success', "Office Created Successfully!");
    }

    function edit($creditorOfficeId){
        $creditorOffice = CreditorOffice::find($creditorOfficeId);
        $creditorGroups = CreditorGroups::all();

        return view('creditor.offices.edit', compact('creditorOffice','creditorGroups'));
    }

    public function update(Request $request, $creditorOfficeId) {

        $request->validate([
            'office_name' => 'required|max:255',
            'group_key' => 'required|max:255',
            'addresses' => 'max:255',
            'town_city' => 'max:255',
            'postcode' => 'max:255',
            'primary_phone' => 'max:255',
            'primary_email' => 'max:255',
            'contact_forename' => 'max:255',
            'contact_surname' => 'max:255',
            'contact_mobile' => 'max:255',
            'contact_email' => 'max:255',
            'account_number' => 'max:255',
            'sort_code_number' => 'max:255',
        ]);

        $creditor_office = CreditorOffice::find($creditorOfficeId)->update([

            'office_name' =>$request->office_name,
            'group_key' =>$request->group_key,
            // 'addresses' => json_encode($request->addresses),
            'town_city' =>$request->town_city,
            'postcode' =>$request->postcode,
            'primary_phone' =>$request->primary_phone,
            'primary_email' =>$request->primary_email,
            'contact_forename' =>$request->contact_forename,
            'contact_surname' =>$request->contact_surname,
            'contact_mobile' =>$request->contact_mobile,
            'contact_email' =>$request->contact_email,
            'account_number' =>$request->account_number,
            'sort_code_number' =>$request->sort_code_number,
        ]);

        return redirect('creditor_offices')->with('success', "Office Updated Successfully!");
    }

    function destroy($creditorOfficeId){
        $creditorOffice = CreditorOffice::find($creditorOfficeId);

        if(!empty($creditorOffice)){
            $creditorOffice->delete();

            return redirect()->back()->with('success', "Office Deleted Successfully!");
        }

        return redirect()->back()->with('success', "Office Not Found!");
    }

    function show($creditorOfficeId){
        $creditorOffice = CreditorOffice::find($creditorOfficeId);

        return view('creditor.offices.show', compact('creditorOffice'));
    }
}
