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
        $data = User::all();

        $users = [];
        foreach($data as $datas){
            $response[] = [
                'id' => $datas->id,
                'email' => $datas->email,
                'fullName' => $datas->fullName
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
            'fullName' => 'required|string'
        ]);
        if($validation->fails()){
            return response()->json([
                'status' => 400,
                'message' => $validation->errors()
            ],400);
        }

        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'fullName' => $data['fullName']
        ]);

        return response()->json([
            'status' => 200,
            'data' => [
                'fullName' => $user->fullName,
                'email' => $user->email
            ]
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::findOrFail($id);
        $response = [
            'id' => $data->id,
            'email' => $data->email,
            'fullName' => $data->fullName
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
            'fullName' => $usersData->fullName
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
