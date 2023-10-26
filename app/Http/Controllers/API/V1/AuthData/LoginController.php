<?php

namespace App\Http\Controllers\API\V1\AuthData;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->json()->all();

        $user = User::where('email', $data['email'])->first();

        if(!$user || Hash::check($data['password'], $user->password)){
            return response()->json([
                'status' => 400,
                'message' => 'Unauthorized User'
            ], 400);
        }

        $token = $user->createToken('token')->plainTextToken;

        $userData = DB::table('users')
        ->join('user_data', 'users.id', '=', 'user_data')
        ->get();

        $response = [
            'id' => $userData->id,
            'email' => $userData->email,
            'firstName' => $userData->firstname,
            'lastName' => $userData->lastName,
            'birthDate' => $userData->birthDate,
            'address' => $userData->address,
            'token' => $token
        ];

        return response($response, 200);
    }
}
