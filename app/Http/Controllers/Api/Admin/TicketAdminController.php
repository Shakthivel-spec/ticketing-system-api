<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
class TicketAdminController extends Controller
{
    public function index(Request $request)
    {
        // Admin check
        if (!$request->user()->is_admin) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        // IMPORTANT: Get ALL tickets (no user_id filter)
        $tickets = Ticket::with('user:id,name,email')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $tickets
        ]);
    }


    public function updateStatus(Request $request, $id)
    {
        // Admin check
        if (!$request->user()->is_admin) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        // Validate status
        $request->validate([
            'status' => 'required|in:open,in_progress,closed'
        ]);

        // Find ticket
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket not found'
            ], 404);
        }

        // Update status
        $ticket->update([
            'status' => $request->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ticket status updated successfully',
            'data' => $ticket
        ]);
    }
   
}
