<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $tickets = Ticket::where('user_id', Auth::id())->with('category')->latest()->get();
        return view('user.dashboard', compact('tickets'));
    }
}
