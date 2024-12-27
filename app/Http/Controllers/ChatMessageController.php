<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Http\Controllers\Controller;
use App\Models\ChatUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function chat()
    {
        $users = [];
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return view('message.mainChat', compact('users'));
    }

    public function chatWith(User $user)
    {
        // dd($user);
        $toUser = $user;
        $users = [];
        $users = User::where('id', '!=', Auth::user()->id)->get();
        $chatUser = ChatUser::where(function ($query) use ($user) {
            $query->where('sender_id', auth()->id())
                ->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', auth()->id());
        })->first();

        if (is_null($chatUser)) {
            $chatUser = ChatUser::create([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $user->id
            ]);
        }

        $messages = ChatMessage::where('chat_user_id', $chatUser->id)->orderBy('created_at', 'asc')->get();
        return view('message.chatWithUser', compact('messages', 'users', 'chatUser', 'toUser'));
    }

    public function chatToUser(Request $request, ChatUser $chatUser)
    {
        // dd($chatUser, $request->all());
        $request->validate([
            'message' => 'required'
        ]);

        $chatMessage = ChatMessage::create([
            'chat_user_id' => $chatUser->id,
            'sender_id' => auth()->user()->id,
            'message' => $request->message
        ]);
        // dd($chatMessage);
        return back();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ChatMessage $chatMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChatMessage $chatMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChatMessage $chatMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChatMessage $chatMessage)
    {
        //
    }
}
