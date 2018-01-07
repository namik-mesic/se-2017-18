@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="pull-left">
                            Events index
                        </div>

                        <a href="{{ action('EventController@create') }}" class="pull-right btn btn-success btn-sm">
                            New event
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
                                    Event name
                                </td>
                                <td>
                                    Event description
                                </td>
                                <td>Place</td>
                                <td>Date</td>
                                <td>Hour</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td>
                                        {{ $event->id }}
                                    </td>
                                    <td>
                                        {{ $event->name }}
                                    </td>
                                    <td>
                                        {{ $event->description }}
                                    </td>
                                    <td>{{ $event->place }}</td>
                                    <td>
                                        {{ $event->date }}
                                    </td>
                                    <td>{{ $event->hour }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-info" href="/event/{{$event->id}}">Show</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="/event/{{$event->id}}/edit">Edit</a>
                                    </td>
                                    <td>
                                        {{ Form::open(array('url' => 'event/' . $event->id)) }}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        {{ Form::submit('Delete', array('class' => 'btn btn-sm btn-warning')) }}
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="/event/{{$event->id}}/invite">Invite</a>
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
