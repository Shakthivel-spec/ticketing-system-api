<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Reply;

class ReplyController extends Controller
{
    /**
     * Add reply to a ticket (User / Admin)
     */
    public function store(Request $request, $ticketId)
    {
        // 1. Validate request
        $request->validate([
            'message' => 'required|string',
        ]);

        // 2. Check ticket exists
        $ticket = Ticket::find($ticketId);

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket not found'
            ], 404);
        }

        // 3. Create reply
        $reply = Reply::create([
            'ticket_id' => $ticket->id,
            'user_id'   => $request->user()->id,
            'message'   => $request->message,
        ]);

        // 4. Response
        return response()->json([
            'success' => true,
            'message' => 'Reply added successfully',
            'data'    => $reply
        ], 201);
    }

    /**
     * List replies of a ticket
     */
    public function list($ticketId)
    {
        // 1. Check ticket exists
        $ticket = Ticket::find($ticketId);

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket not found'
            ], 404);
        }

        // 2. Fetch replies
        $replies = Reply::where('ticket_id', $ticketId)
            ->with('user:id,name,email')
            ->orderBy('id', 'asc')
            ->get();

        // 3. Response
        return response()->json([
            'success' => true,
            'data' => $replies
        ]);
    }
}
