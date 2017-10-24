@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="pull-left">
                            Create event invitation
                        </div>

                        <a href="{{ action('EventInvitationsController@index') }}" class="pull-right btn btn-info btn-sm">
                            Event invitations index
                        </a>

                        <div class="clearfix"></div>
                    </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ action('EventInvitationsController@store') }}" method="POST">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="eventId">
                                    Event
                                </label>
                                <input class="form-control" type="number" required name="eventId" id="eventId">
                            </div>

                            <div class="form-group">
                                <label for="userId">
                                    User
                                </label>
                                <input class="form-control" type="number" required name="userId" id="userId">
                            </div>

                            <div class="form-group">
                                <label for="response">
                                    Response
                                </label>
                                <input class="form-control" type="text" required name="response" id="response">
                            </div>

                            <button class="btn btn-info btn-lg pull-right">
                                Save
                            </button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
