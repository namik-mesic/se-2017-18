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

                        <a href="{{ action('EventController@create') }}" class="pull-right btn btn-success btn-sm">
                            Create event
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
                                <td>Date and time</td>
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
                                    <td>
                                        {{ $event->date }} {{ $event->hour }}
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
