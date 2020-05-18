@extends('layouts.app')

@section('ticket_form', 'active')
@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">
            <form class="form-horizontal" method="POST">

                {{-- for invalid input --}}
                @foreach($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                {{-- for security, csrf, provided by laravel --}}
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                {{--sent from ticket controller if the data saved successfully.--}}
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <fieldset>
                    <legend>@yield('ticketTitle', 'Submit a new ticket')</legend>
                    <div class="form-group">
                        <label for="title" class="col-lg-2 control-label">Title</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title" @yield('titleText')>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-lg-2 control-label">Content</label>
                        <div class="col-lg-10">
                            <textarea type="text" class="form-control" id="content" name="content" placeholder="Content">@yield('ticketContent')</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-3 col-lg-offset-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="status" id="status" @yield('statusPending')>
                                <label class="form-check-label" for="status">
                                    \t Answered?
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">@yield('okButton', 'Submit')</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection