<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\QuestionUpdated;
use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TicketsController extends Controller
{
    function store(Request $request){
        $ticket = new Tickets();
        $ticket->user_id    = Auth::id();
        $ticket->title      = $request->question;
        $ticket->status     = 1;
        $ticket->save();

        return redirect('/');
    }

    function show($id){
        $ticket = Tickets::find($id);
        return $ticket;
    }

    function update(Request $request,Tickets $ticket){
        $ticket->status = $request->status;
        $ticket->save();

        Mail::to($request->user())->send(new QuestionUpdated($ticket));
        return redirect('/');
    }

}
