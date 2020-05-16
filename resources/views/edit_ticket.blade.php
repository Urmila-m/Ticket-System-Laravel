@extends('ticket_form')

@section('ticketTitle', 'Edit Ticket')

@section('titleText')
    value = {!! $ticket->title !!}
@endsection

@section('ticketContent'){!! $ticket->content !!}
@endsection

@section('okButton', 'Update')