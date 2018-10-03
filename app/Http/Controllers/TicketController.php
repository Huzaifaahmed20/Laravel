<?php

namespace App\Http\Controllers;

use App\Ticket;
// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class TicketController extends Controller
{
    public $successStatus = 200;

    /**
     * Store a newlyticket
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);
        $input = $request->all();
        $newTicket = Ticket::create($input);
        return response()->json(['success' => $newTicket], $this->successStatus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // $tickets = DB::table('tickets')->select()->get(); //select all
        $tickets = DB::table('tickets')->select('title', 'description')->get(); //select specified column
        return response()->json(['succcess' => $tickets], $this->successStatus);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @param  string  $id
     */
    public function update(Request $request, $id)
    {
        $title = $request->input('title');
        $description = $request->input('description');
        $newTicket = DB::table('tickets')->where('id', $id)->update(['title' => $title, 'description' => $description]); //it will give the success : 1
        // $updatedTicket =  DB::table('tickets')->where('id', $id)->get(); //it will give the updated ticket
        return response()->json(['success' => $newTicket], $this->successStatus);
    }

   
    public function delete(Request $request, $id) {
        
        DB::table('tickets')->where('id', $id)->delete();
        return response()->json(['success' => 'Ticket deleted successfully'], $this->successStatus);
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
