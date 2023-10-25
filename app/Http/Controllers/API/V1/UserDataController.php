<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserData;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return ($users->isEmpty()) ? [
            'status' => 200,
            'message' => 'No Record Found!'
        ] : [
            'status' => 200,
            'data' => $users
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();

        $validation = Validator::make($data, [
            'email' => 'required|string',
            'password' => 'required|string|min:8'
        ]);

        $userData = User::create([
            'email' => $data['email'],
            'password' => $data['password']
        ]);

        return $userData ? [
            'status' => 200,
            'message' => 'Data Inserted Successfully',
            'data' => $userData
        ] : [
            'status' => 400,
            'message' => 'Data Insert Failed'
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
