@extends('layouts.app')

@if($allOrMy=='allTickets')
    @section('all_tickets', 'active')
@else
    @section('my_tickets', 'active')
@endif

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        @if(session('status'))
            <div class="alert alert-success">{!! session('status') !!}</div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Tickets</h2>
            </div>
            @if($tickets->isEmpty())
                <p> There is no ticket. </p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <td>{!! $ticket->id !!}</td>
                                <td>
                                    <a href="{!! action('TicketsController@show', ['slug'=>$ticket->slug]) !!}">{!! $ticket->title !!}</a></td>
                                <td>{!! $ticket->status ? 'Pending' : 'Answered'!!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <script>
        titleClicked()
    </script>
@endsection