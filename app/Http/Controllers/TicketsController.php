<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketFormRequest;
use Illuminate\Http\Request;
use App\Ticket;
use Illuminate\Support\Facades\Mail;

class TicketsController extends Controller
{
    public function create(){
        return view('ticket_form');
    }

    public function store(TicketFormRequest $request){
//        return $request->all(); //returns a Json object with token and all the input fields
        $slug = uniqid();
        $ticket = new Ticket(array(
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'slug' => $slug
        ));

        $ticket->save();

        $data = array(
            "id" => $slug
        );
        Mail::send('email_successful', $data, function($message){
            $message->from('urmi.mhrz@gmail.com', 'Learning Laravel');
            $message->to('urmi.mhrz@gmail.com')->subject('Learning Laravel test message');
        });
        return redirect('/ticket_form')->with('status', 'Your ticket has been created! Its unique id is '.$slug);

    }

    public function index(){
        $tickets = Ticket::all();
        return view('/all_tickets')->with('tickets', $tickets);
    }

    public function show($slug){
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
        $comments = $ticket->comments()->get();
        return view('individual_ticket', compact('ticket', 'comments'));
    }

    public function edit($slug){
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
        return view('edit_ticket', compact('ticket'));
    }

    public function editCompleted($slug, TicketFormRequest $request){
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
        $ticket->title = $request->get('title');
        $ticket->content = $request->get('content');

        $ticket->save();

        return redirect(action('TicketsController@show', $slug))->with('status', 'The ticket '.$slug." has been updated successfully!");
    }

    public function delete($slug){
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
        $ticket->delete();

        return redirect('/all_tickets')->with('status', 'The ticket '.$slug." deleted successfully!");
    }


}
