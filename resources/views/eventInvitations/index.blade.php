@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="pull-left">
                            Events index
                        </div>

                        <a href="{{ action('EventInvitationsController@create') }}" class="pull-right btn btn-success btn-sm">
                            Create event invitation
                        </a>

                        <div class="clearfix"></div>
                    </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-condensed table-striped">
                            <thead>
                            <tr>
                                <td>
                                    ID
                                </td>
                                <td>
                                    Event
                                </td>
                                <td>
                                    User
                                </td>
                                <td>Response</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td>
                                        {{ $event->id }}
                                    </td>
                                    <td>
                                        {{ $event->eventId }}
                                    </td>
                                    <td>
                                        {{ $event->userId }}
                                    </td>
                                    <td>
                                        {{ $event->response }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
