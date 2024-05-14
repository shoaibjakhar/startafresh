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
            'addresses' => 'required|max:255',
            'town_city' => 'required|max:255',
            'postcode' => 'required|max:255',
            'primary_phone' => 'required|max:255',
            'primary_email' => 'required|max:255',
            'contact_forename' => 'required|max:255',
            'contact_surname' => 'required|max:255',
            'contact_mobile' => 'required|max:255',
            'contact_email' => 'required|max:255',
            'account_number' => 'required|max:255',
            'sort_code_number' => 'required|max:255',
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
}
