<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function addClient(Request $request)
    {
        $validDate = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'date' => 'required',
            'status' => 'required'
        ]);

        User::create($validDate);


        return response() -> json([
            'name' => 'okey',
        ]);
    }

    public function getClient() {
        $client = User::all();

        return response() -> json($client);
    }

    public function updateClient(Request $request, $id) {

        $client = User::find($id);
        $client ->update($request->all());
        return response()->json($client);

    }

    public function delClient($id) {
        $client = User::find($id);
        $client -> delete();
        return response() -> json([
            "status" => 200
        ]);
    }
}
