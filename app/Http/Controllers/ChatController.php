<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\Message as MessageEvent;

class ChatController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'chat_id' => 'required|exists:chats,id',
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string|max:255',
        ]);

        $message = Message::create([
            'chat_id' => $validated['chat_id'],
            'user_id' => $validated['user_id'],
            'content' => $validated['content'],
        ]);

        event(new MessageEvent($validated['user_id'], $validated['content'], $validated['chat_id']));

        return response()->json(['message' => 'Mensagem enviada com sucesso', 'data' => $message], 201);
    }

    public function index($chat_id)
    {
        $messages = Message::where('chat_id', $chat_id)->get();

        return response()->json(['messages' => $messages]);
    }
}
