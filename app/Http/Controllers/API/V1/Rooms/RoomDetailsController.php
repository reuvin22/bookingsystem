<?php

namespace App\Http\Controllers\API\V1\Rooms;

use App\Models\Room;
use App\Models\RoomDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Room\RoomDetailsRequest;

class RoomDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response(RoomDetails::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomDetailsRequest $request)
    {
        $roomDetails = RoomDetails::create($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Data Inserted Successfully',
            'data' => $roomDetails
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomDetails $roomDetails)
    {
        return response()->json([
            'status' => 200,
            'data' => $roomDetails
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomDetails $roomDetails, RoomDetailsRequest $request)
    {
       $roomDetails->update($request->validated());
       return response()->json([
        'status' => 200,
        'message' => 'Data Updated Successfully',
        'data' => $roomDetails
       ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomDetails $roomDetails)
    {
        $roomDetails->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data Deleted Successfully'
        ], 200);
    }
}
