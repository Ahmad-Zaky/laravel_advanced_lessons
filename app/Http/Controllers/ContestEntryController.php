<?php

namespace App\Http\Controllers;

use App\Events\NewCustomerEntryReceivedEvent;
use App\Models\ContestEntry;
use Illuminate\Http\Request;

class ContestEntryController extends Controller
{
    public function index(Request $request) 
    {
        $contests = ContestEntry::latest()->get();

        return view('contests.index', compact('contests'));
    }

    public function store(Request $request) 
    {
        
        $request->validate([
            'email' => 'required|email'
        ]);
        
        $contestEntry = ContestEntry::create(['email' => $request->email]);

        // Fire Event to send Email
        NewCustomerEntryReceivedEvent::dispatch($contestEntry);
        
        return redirect()->route('contests.index');
    }
}
