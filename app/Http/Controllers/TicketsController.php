<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketFormRequest;
use App\Mail\TestEmail;
use App\Ticket;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TicketsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $ticket['user_id'] = $request->user()['id'];
        $ticket['status'] = $request->get('status')=='on'?false:true;
        $ticket->save();
        $data = array(
            "id" => $slug
        );

        Mail::to(Auth::user()['email'])->send(new TestEmail($data));
//        Mail::send('email_successful', $data, function($message){
//            $message->from('TicketManagementSystem@gmail.com', 'New Ticket created!!');
//            $message->to(Auth::user()['email'])->subject('Learning Laravel test message');
//        });
        return redirect('/ticket_form')->with('status', 'Your ticket has been created! Its unique id is '.$slug);

    }

    public function index(){
        $tickets = Ticket::all();
        return view('/all_tickets', ['tickets'=>$tickets, 'allOrMy'=>'allTickets']);
    }

    public function myTickets(){
        $tickets = Ticket::where('user_id', Auth::id())->get();
//        error_log($tickets);
        return view('/all_tickets', ['tickets'=>$tickets, 'allOrMy'=>'myTickets']);
    }


    public function show($slug){
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
        $user = User::where('id', $ticket['user_id'])->get()[0];
        error_log($user);
        $comments = $ticket->comments()->get();
        return view('individual_ticket', compact('ticket', 'comments', 'user'));
    }

    public function edit($slug){
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
        return view('edit_ticket', compact('ticket'));
    }

    public function editCompleted($slug, TicketFormRequest $request){
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
        $ticket->title = $request->get('title');
        $ticket->content = $request->get('content');
        $ticket->status = $request->get('status')=='on'?false:true;
        $ticket->save();
        return redirect(action('TicketsController@show', $slug))->with('status', 'The ticket '.$slug." has been updated successfully!");
    }

    public function delete($slug){
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
        $ticket->delete();

        return redirect('/all_tickets')->with('status', 'The ticket '.$slug." deleted successfully!");
    }


}
