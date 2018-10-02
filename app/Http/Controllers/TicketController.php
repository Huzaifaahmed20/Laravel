<?php

namespace App\Http\Controllers;

use App\Ticket;

class TicketController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        console.log('function running');
        $ticket = new Ticket();
        $data = $this->validate($request, [
            'description' => 'required',
            'title' => 'required',
        ]);

        $mydata = $ticket->saveTicket($data);
        return response()->json(['success' => $mydata], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->user()->id)->get();

        return view('index', compact('tickets'));
    }
}
