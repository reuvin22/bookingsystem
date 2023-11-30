<?php

namespace App\Http\Controllers\API\V1\Rooms;

use App\Models\Room;
use App\Models\RoomImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Room\RoomImagesRequest;

class RoomImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response(RoomImages::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomImagesRequest $request)
    {
        $data = $request->validated();

        $roomImage = collect($data['roomImages'])->map(function($images){
            return RoomImages::create($images);
        });

        return response()->json([
            'status' => 200,
            'message' => 'Data Inserted Successfully',
            'data' => $roomImage
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomImages $roomImages)
    {
        return $roomImages;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomImagesRequest $request, RoomImages $roomImages)
    {
        $roomImages->update($request->validated());
        return response()->json([
            'status' => 200,
            'message' => 'Data Updated Successfully',
            'data' => $roomImages
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomImages $roomImages)
    {
        $roomImages->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data Deleted Successfully'
        ], 200);
    }
}
