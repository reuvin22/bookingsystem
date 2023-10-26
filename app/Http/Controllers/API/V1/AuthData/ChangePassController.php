<?php

namespace App\Http\Controllers\API\V1\AuthData;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePassController extends Controller
{
    public function changePass(Request $request, $id)
    {
        $pass = User::findorFail($id);
        $data = $request->json()->all();

        $validate = Validator::make($data, [
            'password' => 'nullable|string|min:8'
        ]);
        if($validate->fails()){
            return response()->json([
                'status' => 400,
                'message' => $validate->errors()
            ], 400);
        }

        $update = $pass->update([
            'password' => Hash::make($data['password'])]
        );

        return !$update ? [
            'status' => 400,
            'message' => 'Failed to Update Data'
        ]: [
            'status' => 200,
            'message' => 'Data Updated Successfully',
        ];
    }
}
