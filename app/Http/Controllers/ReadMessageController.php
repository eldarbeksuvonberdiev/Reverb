<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class ReadMessageController extends Controller
{


    public function readMessage(Message $message)
    {
        $message->update(['status' => 2]);
        return redirect()->route('admin.index');
    }
}
