<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TicketController extends Controller
{
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
        $categories = Category::all();
        return view('tickets.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    //1. Validation of fields
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'category' => 'required|exists:categories,id',
            'priority' => 'required|in:high,medium,low',
            'attachment.*' => 'nullable|file|max:10240', // Max 10MB
        ]);

        //2. Handle File Upload
        $paths = [];

        if ($request->hasFile('attachment')) {
            foreach ($request->file('attachment') as $file) {
                $paths[] = $file->store('commissions', 'public');
            }
        }
        //3. Creating a Ticket
$ticket = $request->user()->tickets()->create([
    'title' => $request->title,
    'message' => $request->message,
    'category_id' => $request->category,
    'priority' => $request->priority,
]);

if ($request->hasFile('attachment')) {
    foreach ($request->file('attachment') as $file) {
        $path = $file->store('tickets', 'public');

        $ticket->attachments()->create([
            'file_path' => $path,
        ]);
    }
}


        return redirect()->route('dashboard')->with('success', 'Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //Authorize that the user can view the ticket
        if($ticket->user_id !== Auth::id()){
            abort(403, 'Unauthorized access to this ticket.');
        }

        //Load conversations related to the ticket
        $ticket->load('replies.user', 'attachments');

        //If the user is authorized, show the ticket details
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
