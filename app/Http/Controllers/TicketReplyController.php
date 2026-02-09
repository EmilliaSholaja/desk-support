<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketReplyController extends Controller
{
public function store(Request $request, Ticket $ticket)
{
    // Prevent replies to closed tickets
    if ($ticket->status === 'closed') {
        return back()->withErrors(['message' => 'Cannot reply to a closed ticket.']);
    }

    // Validate input
    $request->validate([
        'body' => 'required|string',
    ]);

    // Create reply
    $ticket->replies()->create([
        'body' => $request->body,   // 👈 must match your DB column
        'user_id' => Auth::id(),
    ]);

    // Update ticket timestamp
    $ticket->touch();

    return back()->with('status', 'Reply added!');
}
}
