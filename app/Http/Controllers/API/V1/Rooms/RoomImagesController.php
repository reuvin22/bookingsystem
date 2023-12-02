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
        $roomImages = RoomImages::all();
        return response()->json(['room_images' => $roomImages]);
    }

    public function show($id)
    {
        $image = RoomImages::findOrFail($id);
        return response()->json(['image' => $image]);
    }

    public function store(Request $request)
    {
        $data = $request->json()->all();
        $base64Image = $data['room_images'];
        $roomId = $data['room_id'];
        list(, $base64Data) = explode(',', $base64Image);
        $imageData = base64_decode($base64Data);

        $filename = uniqid().'.'.'png';
        $storage = app('firebase.storage');

        $bucket = $storage->getBucket();

        $object = $bucket->upload($imageData, [
            'name' => "roomImages/{$filename}",
        ]);

        $roomImage = RoomImages::create(['filename' => $filename]);

        return response()->json(['image_url' => $object->signedUrl(), 'room_images' => $roomImage]);
    }

    public function destroy($id)
    {
        $image = RoomImages::findOrFail($id);

        // Delete the image from Firebase Storage
        $storage = app('firebase.storage');
        $storage->getBucket()->object("images/{$image->filename}")->delete();

        // Delete the image record from the database
        $image->delete();

        return response()->json(['message' => 'Image deleted successfully']);
    }
}
