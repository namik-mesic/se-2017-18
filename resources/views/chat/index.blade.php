@extends('layouts.app')

@section('styles')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{ asset('css/chat.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="chat" class="container-fluid full-width full-height full-height-no-navbar">
        <div class="row row-flex row-flex-wrap full-height">
            <div id="my-panel" class="col-md-3 no-padding blue-background">
                <div class="top-icons row-flex flex-start">
                    <div class="top-icon">
                        <i class="fa fa-cog"></i>
                    </div>
                    <div class="top-icon text-right">
                        <i class="fa fa-bars"></i>
                    </div>
                </div>
            </div>
            <div id="conversations" class="col-md-3 no-padding white-background line-right">

            </div>
            <div id="chat-window" class="col-md-6 no-padding white-background">
                @if(!$conversations->isEmpty())
                    @foreach($conversations as $conversation)
                        <div class="card" data-conversation="{{ $conversation->id }}">
                            <div class="background-gradient"></div>
                            <div class="chat-images">
                            @foreach($conversation->users as $user)
                                <div class="chat-image">
                                    <img class="card-img-top" src="{{ asset('images/default_user.jpg') }}" alt="{{ $user->name }}">
                                </div>
                            @endforeach
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">
                                    @foreach($conversation->users as $user)
                                        {{ $user->name . ', ' }}
                                    @endforeach
                                </h4>
                                <p class="card-text">{{ $conversation->messages->last()->text }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="no-data">You do not have any conversations yet.</p>
                @endif
            </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/chat.js') }}"></script>
@endsection