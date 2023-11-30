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
    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required|array', // 'images' should be an array
            'images.*.data' => 'required|string', // Base64-encoded image data
            'images.*.file_name' => 'required|string', // Original file name
        ]);

        $uploadedImages = [];

        foreach ($request->input('images') as $imageData) {
            // Decode the base64 string and create a temporary file
            $base64Data = $imageData['data'];
            $imageContent = base64_decode($base64Data);
            $tempFilePath = tempnam(sys_get_temp_dir(), 'uploaded_image');
            file_put_contents($tempFilePath, $imageContent);

            // Initialize Firebase Firestore
            $firestore = app('firebase.firestore');

            // Generate a unique filename
            $filename = uniqid() . '.' . pathinfo($imageData['file_name'], PATHINFO_EXTENSION);

            // Upload the image to Firebase Storage
            $storagePath = 'RoomImages/' . $filename; // Set the storage path as needed
            $firestore->storage()->get()->upload(
                fopen($tempFilePath, 'r'),
                ['name' => $storagePath]
            );

            // Store metadata in Firestore
            $collection = $firestore->collection('images');
            $document = $collection->add([
                'file_name' => $filename,
                'file_path' => $storagePath,
                'created_at' => FieldValue::serverTimestamp(),
            ]);

            // Generate a public link for the uploaded image
            $publicLink = $firestore->storage()->get()->object($storagePath)->signedUrl(now()->addMinutes(5));

            // Clean up temporary file
            unlink($tempFilePath);

            // Add image information to the response array
            $uploadedImages[] = [
                'original_name' => $imageData['file_name'],
                'public_link' => $publicLink,
            ];
        }

        // Return a response with the uploaded image information
        return response()->json([
            'status' => 200,
            'message' => 'Images uploaded successfully',
            'images' => $uploadedImages,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomImages $roomImages)
    {
        return response()->json([
            'status' => 200,
            'data' => $roomImages
        ], 200);
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
