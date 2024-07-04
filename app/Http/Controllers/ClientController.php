<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ClientDetail;
use App\Models\QuestionsForClient;
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
            'address' => 'max:255',
            'postcode' => 'max:255',
            'bank_name' => 'max:255',
            'account_number' => 'max:255',
            'sort_code_number' => 'max:255',
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
                'address' => $request->address,
                'postcode' => $request->postcode,
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

    public function edit($clientId) {

        $questions = QuestionsForClient::pluck('value')->toArray();

        $client = ClientDetail::where('user_id', $clientId)->first();
        $answers = json_decode($client->answers_to_securiety_questions, true);

        return view('clients.edit', [
            'client' => $client,
            'questions' => $questions,
            'answers' => $answers,
        ]);
    }

    public function update(Request $request, $clientId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8',
            'dob' => 'required|date',
            'mobile' => 'required|string|max:15',
            'ni_number' => 'required|string|max:15',
            'address' => 'max:15',
            'postcode' => 'max:15',
            'answers_to_securiety_questions.*' => 'string|max:255',
            'bank_name' => 'string|max:255',
            'account_number' => 'string|max:20',
            'sort_code_number' => 'string|max:10',
        ]);

        $user = User::find($clientId);
        $client = ClientDetail::where('user_id', $clientId)->first();
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $client->surname = $request->input('surname');
        $client->dob = $request->input('dob');
        $client->mobile = $request->input('mobile');
        $client->ni_number = $request->input('ni_number');
        $client->address = $request->input('address');
        $client->postcode = $request->input('postcode');

        $questions = DB::table('questions_for_clients')->pluck('value')->toArray();
        $answers = $request->input('answers_to_securiety_questions');
        $combined = array_combine($questions, $answers);
    
        $client->answers_to_securiety_questions = json_encode($combined);

        $client->bank_name = $request->input('bank_name');
        $client->account_number = $request->input('account_number');
        $client->sort_code_number = $request->input('sort_code_number');

        $user->update();
        $client->update();

        return redirect('clients/'.$clientId.'/show')->with('success', 'Client updated successfully.');
    }



    public function show(User $user) {

        return view('clients.show', [
            'user' => $user
        ]);

    }

    public function destroy($clientId) {

        $user = User::find($clientId);
        $client = ClientDetail::where('user_id', $clientId)->first();

        if(!empty($user)){
            $user->delete();
        }

        if(!empty($client)){
            $client->delete();
        }

        return redirect('clients')->with('success', 'Client Deleted successfully.');
    }

}
