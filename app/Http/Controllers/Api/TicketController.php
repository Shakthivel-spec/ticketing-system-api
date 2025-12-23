<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    // Create ticket
    public function store(Request $request)
    {
        // 1. Validation
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // 2. Create ticket
        $ticket = Ticket::create([
            'user_id'     => $request->user()->id,
            'title'       => $request->title,
            'description' => $request->description,
            'status'      => 'open',
        ]);

        // 3. Response
        return response()->json([
            'success' => true,
            'message' => 'Ticket created successfully',
            'data'    => $ticket
        ], 201);
    }
    // List logged-in user's tickets
    public function myTickets(Request $request)
    {
        $tickets = Ticket::where('user_id', $request->user()->id)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $tickets
        ]);
    }

    // Update ticket (only owner)
    public function update(Request $request, $id)
    {
        $ticket = Ticket::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket not found or access denied'
            ], 404);
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $ticket->update([
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ticket updated successfully',
            'data'    => $ticket
        ]);
    }

    // Close ticket
    public function close(Request $request, $id)
    {
        $ticket = Ticket::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket not found or access denied'
            ], 404);
        }

        $ticket->update([
            'status' => 'closed'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ticket closed successfully',
            'data'    => $ticket
        ]);
    }



}
