<?php

namespace App\Http\Controllers\API\V1\AuthData;

use App\Models\User;
use App\Models\ChatApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AuthData\UserRegistrationRequest;
use App\Http\Controllers\API\V1\AuthData\UserRegistration;

class UserRegistration extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRegistrationRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Registration Successfully'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $chat = ChatApi::where('user_id', $id)->get();
        $user = User::find($id);
        return response()->json([
            'status' => 200,
            'user' => new UserResource($user),
            'chats' => $chat
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRegistrationRequest $request, User $user)
    {
        $user->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Data Updated Successfully',
            'data' => $user
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $delete = $user->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data Deleted Successfully'
        ], 200);
    }
}
