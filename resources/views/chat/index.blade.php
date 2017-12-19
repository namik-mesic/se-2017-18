@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/chat/chat.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="chat" class="container-fluid full-width full-height full-height-no-navbar">
        <div class="row row-flex row-flex-wrap full-height">
            <div id="my-panel" class="col-md-3 no-padding blue-background flex-col">
                <div class="top-icons row-flex flex-start">
                    <div class="top-icon">
                        <span class="icon-adjustments" data-toggle="tooltip" data-placement="bottom" title="Chat settings"></span>
                    </div>
                    <div class="top-icon text-right">
                        <span class="icon-expand" data-toggle="tooltip" data-placement="bottom" title="Hide sidebar"></span>
                    </div>
                </div>
                <div class="user-data row-flex flex-start flex-col">
                    <div class="user-image-frame user-image-big">
                        <div class="user-image">
                            <div class="user-image-hover">
                                <span class="icon-tools" data-toggle="tooltip" data-placement="bottom" title="Change image"></span>
                            </div>
                        </div>
                    </div>
                    <div class="user-name text-center">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="user-email text-center">
                        {{ Auth::user()->email }}
                    </div>
                </div>
                <div class="user-message-types row-flex flex-start flex-col">
                    <div class="type-list active">
                        <span class="icon-chat mr15"></span> Conversation groups
                        <div class="type-list-items">
                            <div class="type-list-item row-flex flex-center">
                                <div class="type-circle friends"></div>
                                <div class="type-name">Friends</div>
                                <div class="type-new-messages friends">
                                    25
                                </div>
                            </div>
                            <div class="type-list-item">Work</div>
                            <div class="type-list-item">Important</div>
                            <div class="type-list-item">Spam</div>
                            <div class="type-list-item">Blocked</div>
                        </div>
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
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/chat.js') }}"></script>
@endsection