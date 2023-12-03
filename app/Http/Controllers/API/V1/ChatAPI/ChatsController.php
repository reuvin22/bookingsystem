<?php

namespace App\Http\Controllers\API\V1\ChatAPI;

use App\Models\User;
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
            'from' => $data['name'],
            'to' => $data['to'],
            'receiver_id' => $data['receiver_id']
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
        $chat = ChatApi::where('user_id', $id)->get();
        return $chat;
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
