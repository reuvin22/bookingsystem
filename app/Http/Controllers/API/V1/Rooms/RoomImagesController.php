<?php

namespace App\Http\Controllers\API\V1\Rooms;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $room = RoomImages::all();
        return response($room, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();

        $validation = Validator::make($data, [
            'room_images' => 'nullable|string',
            'room_id' => 'nullable|integer'
        ]);
        if($validation->fails()){
            return response()->json([
                'status' => 400,
                'message' => $validation->errors()
            ], 400);
        }

        $room = RoomImages::create([
            'room_id' => $data['room_id'],
            'room_images' => $data['room_images']
        ]);

        return $room ? [
            'status' => 200,
            'message' => 'Data Inserted Successfully',
            'data' => $room
        ]: [
            'status' => 400,
            'message' => 'Data Insert Failed',
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = RoomImages::findorFail($id);

        $data = [
            'id' => $user->id,
            'room_id' => $user->room_id,
            'room_images' => $user->room_images
        ];
        return (empty($data)) ? [
            'status' => 200,
            'message' => 'No Record Found'
        ]: [
            'status' => 200,
            'data' => $user
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $room = RoomImages::findorFail($id);
        $update = $room->update($request->json()->all());

        return $update ? [
            'status' => 200,
            'message' => 'Data Updated Successfully',
            'data' => $room
        ]: [
            'status' => 400,
            'message' => 'Data Update Failed'
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = RoomImages::findorFail($id);
        $delete = $room->delete($id);

        return $delete ? [
            'status' => 200,
            'message' => 'Deleted Successfully'
        ]: [
            'status' => 400,
            'message' => 'Delete Data Failed'
        ];
    }
}
