<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
Use Illuminate\Support\Str;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketUpdateNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        //shows only the tickets of the logged in user but if an admin shows all tickets

        $tickets = $user->isAdmin ? Ticket::latest()->get() : $user->tickets;

        return view('ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {

        $ticket = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user()->id,
        ]);

        if($request->file('attachment')){

            $ext = $request->file('attachment')->extension();
            $content = file_get_contents($request->file('attachment'));
            $filename = Str::random(25);
            $path = "attachments/$filename.$ext";

            Storage::disk('public')->put($path , $content);

            $ticket->update([
                'attachment' => $path
            ]);
        }

        return redirect()->route('tickets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view("ticket.show", compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        return view('ticket.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $ticket->update($request->except('attachment'));

        if($request->has('status')){

            $ticket->user->notify(new TicketUpdateNotification($ticket));
            
        }

        if($request->file('attachment')){

            Storage::disk('public')->delete($ticket->attachment);

            $ext = $request->file('attachment')->extension();
            $content = file_get_contents($request->file('attachment'));
            $filename = Str::random(25);
            $path = "attachments/$filename.$ext";

            Storage::disk('public')->put($path , $content);

            $ticket->update([
                'attachment' => $path
            ]);
        }


        return redirect()->route('tickets.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index');
    }
}
