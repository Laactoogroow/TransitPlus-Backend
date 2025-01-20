<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return response()->json($tickets);
    }

    public function store(Request $request)
    {
        $request->validate([
            'bus_name' => 'required|string|max:255',
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'price' => 'required|numeric',
            'departure_time' => 'required|date',
        ]);

        $ticket = Ticket::create($request->all());

        return response()->json($ticket, 201);
    }

    public function show($id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        return response()->json($ticket);
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        $request->validate([
            'bus_name' => 'string|max:255',
            'origin' => 'string|max:255',
            'destination' => 'string|max:255',
            'price' => 'numeric',
            'departure_time' => 'date',
        ]);

        $ticket->update($request->all());

        return response()->json($ticket);
    }

    public function destroy($id)
    {
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json(['message' => 'Ticket not found'], 404);
        }

        $ticket->delete();

        return response()->json(['message' => 'Ticket deleted']);
    }
}
