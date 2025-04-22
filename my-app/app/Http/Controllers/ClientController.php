<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

    public function updateClient(Request $request, $id)
    {
        $client = User::findOrFail($id);
    
        $data = array_filter(
            $request->only(['name', 'email', 'phone', 'date', 'status']),
            fn($value) => !is_null($value)
        );
    
        if (empty($data)) {
            return response()->json(['message' => 'Нет данных для обновления'], 422);
        }
    
        $client->update($data);
    
        return response()->json($client);
    }
    

    public function delClient($id) {
        $client = User::find($id);
        $client -> delete();
        return response() -> json([
            "status" => 200
        ]);
    }


    public function exportUsers()
{
    return Excel::download(new UsersExport, 'users.xlsx');
}
}
