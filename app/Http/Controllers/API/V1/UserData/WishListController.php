<?php

namespace App\Http\Controllers\API\V1\UserData;

use App\Models\wishList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserData\WishListRequest;

class WishListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response(wishList::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();
        $user = Auth::user();
        $userId = $user->id();

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
    public function show(wishList $wishList)
    {
        return response()->json($wishList);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WishListRequest $request, wishList $wishList)
    {
        $wishList->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Data Updated Successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(wishList $wishList)
    {
        $wishList->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data Deleted Successfully'
        ], 200);
    }
}
