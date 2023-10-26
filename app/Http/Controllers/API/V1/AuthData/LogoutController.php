<?php

namespace App\Http\Controllers\API\V1\AuthData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->token()->revoke();

        return response()->json([
            'status' => 200,
            'message' => 'Logout Successfully'
        ], 200);
    }
}
