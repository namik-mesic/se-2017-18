@extends('layouts.app')

@section('styles')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/chat/chat.css') }}" rel="stylesheet">
@endsection

<script>
    /* Glupo al radi xD */
    var AuthUser = {};
    AuthUser.id = {{ Auth::user()->id }};
</script>

@section('content')
    <div id="chat" class="container-fluid full-width full-height full-height-no-navbar">
        <div class="row row-flex row-flex-wrap full-height">
            <div id="my-panel" class="col-md-3 no-padding white-background line-right flex-col">
                <div class="top-icons row-flex flex-start">
                    <div class="top-icon">
                        <span data-toggle="modal" data-target="#chatSettingsModal">
                            <span class="icon-adjustments" data-toggle="tooltip" data-placement="bottom" title="Chat settings"></span>
                        </span>
                    </div>
                    <div class="top-icon text-right">
                        <span id="hideSidebar" class="icon-expand" data-toggle="tooltip" data-placement="bottom" title="Hide sidebar"></span>
                    </div>
                </div>
                <div class="horizontal-divider"></div>
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
                <div class="horizontal-divider"></div>
                <div class="user-message-types row-flex flex-start flex-col">
                    <div class="type-list active">
                        <div class="title">
                            <span class="icon-chat mr15"></span> Conversation groups
                        </div>
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
                <div class="add-button line-right">
                    <button id="add-group" class="btn btn-success btn-add-conversation">Add group</button>
                </div>
            </div>
            <div id="conversations" class="col-md-3 no-padding white-background line-right flex-col">
                <div class="search-conversation">
                    <div id="searchConversationsDIV" class="input-group">
                        <input id="searchConversationQuery" type="text" class="form-control" placeholder="Search conversations by friends name..">
                        <span class="input-group-btn">
                            <button id="searchConversations" class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                    <div id="searchFriendsDIV" class="input-group hideSearch">
                        <input id="searchFriendsQuery" type="text" class="form-control" placeholder="Search friends to start chat..">
                        <span class="input-group-btn">
                            <button id="searchFriends" class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
                <div class="conversations-list">
                </div>
                <div class="add-button line-right">
                    <div class="btn-group text-center" role="group" aria-label="Chat buttons">
                        <button id="getConversations" type="button" class="btn btn-success btn-add-conversation btn-half">Conversations</button>
                        <button id="getFriends" type="button" class="btn btn-success btn-add-conversation btn-half">Friends</button>
                    </div>
                </div>
            </div>
            <div id="chat-window" class="col-md-6 no-padding white-background">
                <div class="chat-no-messages">Choose conversation on the left to <b>start chat</b> with your friends!</div>
                <div class="chat-image"></div>
            </div>
        </div>
    </div>

    @include('chat.dialogs')
@endsection

@section('scripts')
    <script src="{{ asset('js/selectize.min.js') }}"></script>
    <script src="{{ asset('js/chat.js') }}"></script>
@endsection