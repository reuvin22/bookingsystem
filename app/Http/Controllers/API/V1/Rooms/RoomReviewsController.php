<?php

namespace App\Http\Controllers\API\V1\Rooms;

use App\Models\RoomDetails;
use App\Models\RoomReviews;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Room\RoomReviewsRequest;

class RoomReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response(RoomReviews::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $roomReviews = RoomReviews::create($request->validated());
       return response()->json([
            'status' => 200,
            'message' => 'Data Inserted Successfully',
            'data' => $roomReviews
       ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomReviews $roomReviews)
    {
        return response()->json([
            'status' => 200,
            'data' => $roomReviews
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomReviewsRequest $request, RoomReviews $roomReviews)
    {
        $roomReviews->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Data Updated Successfully',
            'data' => $roomReviews
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomReviews $roomReviews)
    {
        $roomReviews->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data Deleted Successfully'
        ],200);
    }
}
