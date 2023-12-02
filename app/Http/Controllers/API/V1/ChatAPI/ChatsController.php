<?php

namespace App\Http\Controllers\API\V1\ChatAPI;

use App\Models\ChatApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();

        // $user = Auth::user();
        $chats = ChatApi::create([
            'user_id' => $data['user_id'],
            'chat' => $data['chat'],
            'name' => $data['name']
        ]);

        return response()->json([
            'status' => 200,
            'data' => $chats
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
