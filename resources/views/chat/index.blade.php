@extends('layouts.app')

@section('styles')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{ asset('css/chat.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="chat" class="container-fluid">
        <div class="row full-height">
            <div class="col-md-3 full-height no-padding">
                <div class="chat-wall border-right">
                    <div class="form-group padding-20 no-margin">
                        <input type="text" class="form-control" id="searchConversations" aria-describedby="emailHelp"
                               placeholder="Search for conversations or friends..">
                    </div>
                    <div id="myConversations">
                        <div class="chat-title">
                            <i class="fa fa-comments-o"></i>
                            Conversations
                        </div>
                        @if(!$conversations->isEmpty())
                            @foreach($conversations as $conversation)
                                <div class="user">
                                    <div class="user-inner">
                                        <div class="imageCenter">
                                            <div class="profileImage">
                                                <img src="{{ asset('images/default_user.jpg') }}" width="50" height="50" alt="" class="img">
                                            </div>
                                        </div>
                                        <div class="conversationData">
                                            <div class="header">
                                                <span class="userText userName">{{ $conversation->users }}</span>
                                                <div>
                                                    <span class="lastMessageTime" title="{{ $conversation->messages->last()->created_at->diffForHumans()  }}">{{ $conversation->messages->last()->created_at->diffForHumans()  }}</span>
                                                </div>
                                            </div>
                                            <div class="message">
                                                <span class="userText lastMessage">{{ $conversation->messages->last()->text  }}</span>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                        @else
                            <p class="no-data">You do not have any conversations yet.</p>
                        @endif
                    </div>
                    <div id="myFriends">
                        <div class="chat-title">
                            <i class="fa fa-users"></i>
                            Friends
                        </div>
                        @if(!$available_users->isEmpty())
                            @foreach($available_users as $user)
                                <div class="user">
                                    <div class="user-inner">
                                        <div class="imageCenter">
                                            <div class="profileImage">
                                                <img src="{{ asset('images/default_user.jpg') }}" width="50" height="50" alt="" class="img">
                                            </div>
                                        </div>
                                        <div class="conversationData">
                                            <div class="header">
                                                <span class="userText userName">{{ $user->name }}</span>
                                            </div>
                                            <div class="message">
                                                <span class="userText lastMessage">Active now</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="no-data">Your friend list is empty.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6 full-height no-padding">
                <div class="chat-wall border-right">
                    Chat box
                </div>
            </div>
            <div class="col-md-3 full-height no-padding">
                <div class="chat-wall">
                    User informations
                </div>
            </div>
        </div>
    </div>
@endsection