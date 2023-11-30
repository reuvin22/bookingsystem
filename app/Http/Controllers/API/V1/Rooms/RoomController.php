<?php

namespace App\Http\Controllers\API\V1\Rooms;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomRequest;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $room = Room::paginate(8);
        return response($room, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomRequest $request)
    {
        $room = Room::create($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Data Inserted Successfully',
            'data' => $room
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
       return Room::find($room);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomRequest $request, Room $room)
    {
        $room->update($request->validated);
        return response()->json([
            'status' => 200,
            'message' => 'Data Updated Successfully',
            'data' => $room
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data Deleted Successfully'
        ],200);
    }
}
