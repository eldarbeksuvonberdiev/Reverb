<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = ['msg', 'chat_user_id', 'sender_id'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function chatUser()
    {
        return $this->belongsTo(ChatMessage::class, 'chat_message_id');
    }
}
