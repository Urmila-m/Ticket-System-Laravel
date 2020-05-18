@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <h4>Have fun using this ticket management app</h4>
            <img src="{{asset('images/home_page_image.jpg')}}" style="width:100%; height: auto">
        </div>
    </div>
</div>
@endsection
