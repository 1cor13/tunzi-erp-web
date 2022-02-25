<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Client;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $data)
    {
        $data->employees = Employee::latest()->get();
        $data->clients = Client::latest()->get();

        if ($data->view_type == 'trashed') {
            $data->tickets = Ticket::onlyTrashed()->latest()->get();
        }
        elseif ($data->view_type == 'with-trashed') {
            $data->tickets = Ticket::withTrashed()->latest()->get();
        }
        else {
            $data->tickets = Ticket::latest()->get();
        }
        return view('system.companies.tickets.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        return view('system.companies.tickets.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'ticket_id' => 'required',
            'ticket_subject' => 'required',
            'priority' => 'required',
            'status' => 'required',
            'ticket_description' => 'required',
            'image'  => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);  

        $path = $request->file('image')->store('public/images');

        $ticket = new Ticket; 

        $ticket->ticket_id = $request->get('ticket_id');
        $ticket->ticket_subject = $request->get('ticket_subject');
        $ticket->priority = $request->get('priority');
        $ticket->status = $request->get('status');
        $ticket->ticket_description = $request->get('ticket_description');
        $ticket->image = $path;
        $ticket->save();      

        return back()->with('success', 'Ticket Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Request $data)
    {
        return view('system.companies.tickets.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::find($id);
        return view('system.companies.tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'ticket_id' => 'required',
            'ticket_subject' => 'required',
            'priority' => 'required',
            'status' => 'required',
            'ticket_description' => 'required',
        ]);        

        $ticket = Ticket::find($id);

        if($request->hasFile('image')){
            $request->validate([
              'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $path = $request->file('image')->store('public/images');
            $ticket->image = $path;
        }

        $ticket->ticket_id = $request->get('ticket_id');
        $ticket->ticket_subject = $request->get('ticket_subject');
        $ticket->priority = $request->get('priority');
        $ticket->status = $request->get('status');
        $ticket->ticket_description = $request->get('ticket_description');
        $ticket->save();    

        return back()->with('success', 'Ticket updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        $ticket->delete();        

        return back()->with('success', 'Ticket Deleted!');
    }
}
