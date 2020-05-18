@extends('ticket_form')

@section('ticketTitle', 'Edit Ticket')

@section('titleText')
    value = {!! $ticket->title !!}
@endsection

@section('ticketContent'){!! $ticket->content !!}
@endsection

@section('statusPending')
    @if($ticket->status)
        checked
    @endif
@endsection


@section('okButton', 'Update')