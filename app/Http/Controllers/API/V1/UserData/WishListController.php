<?php

namespace App\Http\Controllers\API\V1\UserData;

use App\Models\wishList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return wishList::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();
        $user = Auth::user();
        $userId = $user->id();
        $wishLists = [];

        $wishList = wishList::create([
            'user_id' => $user->id,
            'room_id' => $data['room_id']
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Data Inserted Successfully',
            'data' => $wishList
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(wishList $wishList, $id)
    {
        $wishList = wishList::findorFail($id);

        if(empty($wishList)){
            return response()->json([
                'status' => 200,
                'data' => 'No Record Found'
            ], 200);
        }

        return response()->json([
            'status' => 200,
            'data' => $wishList
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $wishList = wishList::findorFail($id);

        $update = $wishList->update($request->json()->all());
        return response()->json([
            'status' => 200,
            'data' => $wishList
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $wishList = wishList::findorFail($id);
        $delete = $wishList->delete($id);

        return response()->json([
            'status' => 200,
            'message' => 'Data has been deleted'
        ]);
    }
}
