<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\WhatsMaticMessage;

use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
   public function addMessage(Request $request)
   {
    $validatedData = $request->validate([
        'api_key' => 'string|max:255',
        'phone_no' => 'required|array',
        'message' => 'required|string',
        'priority' => 'int',
        'type'=> 'string',
        'data' => 'string',
        'scheduled_at' => 'nullable|date_format:Y-m-d H:i:s', 
    ]);

    
    $messages = [];
    foreach ($validatedData['phone_no'] as $phone_no) {
        $message = WhatsMaticMessage::create([
            'user_id' => auth()->id(),
            'api_key' => $validatedData['api_key'] ?? null,
            'phone_no' => $phone_no,
            'message' => $validatedData['message'],
            'priority' => $validatedData['priority'] ?? null,
            'type' => $validatedData['type'] ?? null,
            'data' => $validatedData['data'] ?? null,
            'status' => 'pending',
            'scheduled_at' => $validatedData['scheduled_at'] ?? null,
        ]);
        $messages[] = $message;
    }

    return response()->json([
        'message' => 'Message(s) added successfully',
        'data' => $messages,
    ], 201);
   }

   public function updateMessage(Request $request)
{
    $id = $request->validate([
        'id' => 'required|int'
    ])['id'];
    

    $message = WhatsMaticMessage::findOrFail($id);

    if ($message->user_id !== auth()->id()) {
        return response()->json([
            'message' => 'Unauthorized',
        ], 403);
    }

    $validatedData = $request->validate([
        'api_key' => 'string|max:255',
        'phone_no' => 'required|string',
        'message' => 'required|string',
        'priority' => 'int',
        'type'=> 'string',
        'data' => 'required|string',
        'scheduled_at' => 'nullable|date_format:Y-m-d H:i:s', 
    ]);

    
    $message->update($validatedData);

    return response()->json([
        'message' => 'Message updated successfully',
        'data' => $message,
    ]);
}

public function deleteMessage(Request $request)
{
    $id = $request->validate([
        'id' => 'required|int'
    ])['id'];
    
    $message = WhatsMaticMessage::findOrFail($id);

    if ($message->user_id !== auth()->id()) {
        return response()->json([
            'message' => 'Unauthorized',
        ], 403);
    }

    $message->delete();

    return response()->json([
        'message' => 'Message deleted successfully',
    ]);
}

public function getAllMessages()
{
    $messages = WhatsMaticMessage::where('user_id', auth()->id())->get();

    return response()->json([
        'message' => 'All messages retrieved successfully',
        'data' => $messages,
    ]);
}

public function getMessageById(Request $request)
{
    $id = $request->validate([
        'id' => 'required|int'
    ])['id'];

    $message = WhatsMaticMessage::where('id', $id)
    ->where('user_id', auth()->id())
    ->firstOrFail();

    return response()->json([
        'message' => 'Message retrieved successfully',
        'data' => $message,
    ]);
}

public function getMessagesByStatus($status)
{
    $messages = WhatsMaticMessage::where('status', $status)
            ->where('user_id', auth()->id())
            ->get();

    return response()->json([
        'message' => 'Messages with status retrieved successfully',
        'data' => $messages,
    ]);
}

public function getMessageCountsByApiKey()
{
    $messageCounts = WhatsMaticMessage::select('api_key', DB::raw('count(*) as total'))
            ->where('user_id', auth()->id())
            ->groupBy('api_key')
            ->pluck('total', 'api_key');

    return response()->json([
        'message' => 'Message counts by API key retrieved successfully',
        'data' => $messageCounts,
    ]);
}

}
