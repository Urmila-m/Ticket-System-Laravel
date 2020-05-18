@extends('layouts.app')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">
            <div class="content">
                @if(session('status'))
                    <div class="alert alert-success">{!! session('status') !!}</div>
                @endif
                <h2 class="header">{!! $ticket->title !!}</h2>
                <p><strong>Status</strong>:{!! $ticket->status?'Pending':"Answered" !!}</p>
                <p>{!! $ticket->content !!}</p>
                <p style="text-align: right">Created by: {!! $user->name !!}</p>
            </div>
            @if($ticket['user_id']==\Illuminate\Support\Facades\Auth::id())
                <a href="{!! action('TicketsController@edit', $ticket->slug) !!}" class="btn btn-info">Edit</a>
                <a href="{!! action('TicketsController@delete', $ticket->slug) !!}" class="btn btn-danger">Delete</a>
            @endif
        </div>

    @foreach($comments as $comment)
        @php
            $commentedBy = \App\User::where(['id'=>$comment->user_id])->first();
        @endphp
            {{--{{ $commentedBy = \App\User::select('name')->where(['id'=>$comment->user_id])->first() }}  these two methods prints it right here :( --}}
            {{--{!! $commentedBy = \App\User::select('name')->where(['id'=>$comment->user_id])->first() !!}--}}
            <div class="well well bs-component">
            <div class="content">
                {!! $comment->content !!}
            </div>
            <p style="text-align: right">Replied By: {{ $commentedBy = $commentedBy->name }}</p>
        </div>
    @endforeach

        <div class="well well bs-component">
            <form class="form-horizontal" method="post" action="/comment">
                @foreach($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                @if(session('comment_status'))
                    <div class="alert alert-success">
                        {{ session('comment_status') }}
                    </div>
                    @endif
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <input type="hidden" name="post_id" value="{!! $ticket->id !!}">

                <fieldset>
                    <legend>Reply</legend>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <textarea class="form-control" rows="3" id="content" name="commentContent"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 col-lg-offset-2">
                            <button type="reset" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">Post</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection