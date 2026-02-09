<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTicketController extends Controller
{
public function index(Request $request)
{
    $query = Ticket::with('user'); // make sure ticket has user relationship

    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('message', 'like', "%{$search}%")
              ->orWhere('id', $search)
              ->orWhereHas('user', function ($userQuery) use ($search) {
                  $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('id', $search);
              });
        });
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $tickets = $query->latest()->paginate(10)->withQueryString();

    return view('admin.tickets.index', compact('tickets'));
}

public function show(Ticket $ticket)
{
    $ticket->load(['user', 'replies.user']);

    return view('admin.tickets.show', compact('ticket'));
}

    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:open,closed,',
        ]);

        $ticket->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Ticket status updated successfully.');

    }
    public function updatePriority(Request $request, Ticket $ticket)
    {
        $request->validate([
            'priority' => 'required|in:low,medium,high',
        ]);

        $ticket->update(['priority' => $request->priority]);

        return redirect()->back()->with('success', 'Ticket priority updated successfully.');

    }

    public function reply(Request $request, Ticket $ticket)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        $ticket->replies()->create([
            'user_id' => Auth::id(),
            'body' => $request->body,
        ]);

        return redirect()->back()->with('success', 'Reply added successfully.');
    }

}



