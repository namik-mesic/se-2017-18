@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/chat/selectize.bootstrap3.css') }}" rel="stylesheet">
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
                <div class="add-button">
                    <button id="add-group" class="btn btn-success btn-add-conversation">Add group</button>
                </div>
            </div>
            <div id="conversations" class="col-md-3 no-padding white-background line-right flex-col">
                <div class="search-conversation">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for conversations..">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
                <div class="conversations-list">
                    <div class="loader">
                        <div class="timer"></div>
                    </div>
                </div>
                <div class="add-button">
                    <button id="add-conversation" class="btn btn-success btn-add-conversation" data-toggle="modal" data-target="#addConversationModal">Create conversation</button>
                </div>
            </div>
            <div id="chat-window" class="col-md-6 no-padding white-background">
            </div>
        </div>
    </div>

    @include('chat.dialogs')
@endsection

@section('scripts')
    <script src="{{ asset('js/selectize.min.js') }}"></script>
    <script src="{{ asset('js/chat.js') }}"></script>
@endsection