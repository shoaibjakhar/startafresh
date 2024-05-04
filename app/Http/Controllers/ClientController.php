<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index() {

        $clients = [];
        return view('clients.index', [
            'clients' => $clients
        ]);
    }

    public function create() {
        echo "TODO";
    }
}
