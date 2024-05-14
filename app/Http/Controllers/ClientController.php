<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ClientDetail;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index() {

        $clients = DB::table('users')
            ->join('client_details', 'users.id', '=', 'client_details.user_id')
            ->select('users.*', 'client_details.*')
            ->get();

        return view('clients.index', [
            'clients' => $clients
        ]);
    }

    public function create() {

        $questions = DB::table('questions_for_clients')->get();

        return view('clients.create', ['questions' => $questions]);
    }

    public function store(Request $request) {

        $request->validate([
            'name' => 'required|max:255|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|max:255|min:8',
            'dob' => 'required',
            'mobile' => 'required|max:255|min:10',
            'ni_number' => 'required|max:255',
            'bank_name' => 'required|max:255',
            'account_number' => 'required|max:255',
            'sort_code_number' => 'required|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->email),
        ]);

        $user->syncRoles('Client');

        if($user->id) {

            $client = ClientDetail::create([
                'user_id' => $user->id,
                'surname' => $request->surname,
                'dob' => $request->dob,
                'mobile' => $request->mobile,
                'ni_number' => $request->ni_number,
                'bank_name' => $request->bank_name,
                'account_number' => $request->account_number,
                'sort_code_number' => $request->sort_code_number,
                'answers_to_securiety_questions' => json_encode($request->answers_to_securiety_questions)
            ]);

            return redirect('/clients')->with('status', "Client Created Successfully!");
        
        } else {
            return redirect()->back('error', "User not Created, Error Occured, Try Again!");
        }

    }

    public function edit(ClientDetail $client) {

         $questions = [
            'QUES1' => 'What is the name of your pet?',
            'QUES2' => 'What is your first school name?',
            'QUES3' => 'What is your favourite pet name?',
            'QUES4' => 'What is your favourite color name?'
        ];

        return view('clients.edit', [
            'client' => $client,
            'questions' => $questions,
        ]);

    }

    public function show(User $user) {
        
        return view('clients.show', [
            'user' => $user
        ]);

    }

}
