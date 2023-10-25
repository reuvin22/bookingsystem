<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('users')
        ->join('user_data', 'users.id', '=', 'user_data.id')
        ->get();

        $users = [];
        foreach($data as $datas){
            $response[] = [
                'id' => $datas->id,
                'email' => $datas->email,
                'firstName' => $datas->firstName,
                'lastName' => $datas->lastName,
                'address' => $datas->address,
                'birthDate' => $datas->birthDate
            ];
            $users = [
                'status' => 200,
                'data' => $response
            ];
        }

        return response($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();

        $validation = Validator::make($data, [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'address' => 'required|string',
            'birthDate' => 'required|date'
        ]);
        if($validation->fails()){
            return response()->json([
                'status' => 400,
                'message' => $validation->errors()
            ],400);
        }

        $user = User::create([
            'email' => $data['email'],
            'password' => $data['password']
        ]);

        $userData = UserData::create([
            'id' => $user->id,
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'address' => $data['address'],
            'birthDate' => $data['birthDate']
        ]);

        $dataList = [
            'id' => $user->id,
            'email' => $user->email,
            'firstName' => $userData->firstName,
            'lastName' => $userData->lastName,
            'address' => $userData->address,
            'birthDate' => $userData->birthDate
        ];

        return $user && $userData ? [
            'status' => 200,
            'message' => 'Data Inserted Successfully',
            'data' => $dataList
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
        $data = DB::table('users')
        ->join('user_data', 'users.id', '=', 'user_data.id')
        ->where('users.id', $id)
        ->first();

        $response = [
            'id' => $data->id,
            'email' => $data->email,
            'firstName' => $data->firstName,
            'lastName' => $data->lastName,
            'address' => $data->address,
            'birthDate' => $data->birthDate
        ];
        $users = [
            'status' => 200,
            'data' => $response
        ];

        return response($users, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $users = User::findorFail($id);
        $update = $users->update($request->json()->all());
        $usersData = UserData::findorFail($id);
        $updateUserData = $usersData->update($request->json()->all());

        $dataList = [
            'id' => $users->id,
            'email' => $users->email,
            'firstName' => $usersData->firstName,
            'lastName' => $usersData->lastName,
            'address' => $usersData->address,
            'birthDate' => $usersData->birthDate
        ];

        return $update && $updateUserData ? [
            'status' => 200,
            'message' => 'Update Successfully',
            'data' => $dataList
        ]: [
            'status' => 400,
            'message' => 'Update Failed'
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findorFail($id);
        $delete = $user->delete($id);
        $userData = UserData::findorFail($id);
        $deleteUser = $userData->delete($id);

        return $delete && $deleteUser? [
            'status' => 200,
            'message' => 'Deleted Successfully'
        ]: [
            'status' => 400,
            'message' => 'Delete Failed'
        ];
    }
}
