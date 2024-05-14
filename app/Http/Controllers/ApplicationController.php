<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Application;
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
}
