@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="pull-left">
                            Details {{$event->name}}
                        </div>

                        <a href="{{ action('EventController@index') }}" class="pull-right btn btn-info btn-sm">
                            Event index
                        </a>

                        <div class="clearfix"></div>
                    </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                            <div class="jumbotron text-right">
                                <div style="float: left;">
                                    <iframe src="https://www.google.com/maps/embed/v1/place?q={{ $event->place }}&zoom=15
      &attribution_source=Google+Maps+Embed+API
      &attribution_web_url=https://developers.google.com/maps/documentation/embed/&key= AIzaSyCpL8ZJ6NVhxPBqb2QOkU3cfCyWBjfQkUQ">
                                    </iframe>
                                </div>
                                <h2>Event {{ $event->name }}</h2>
                                <p>
                                    <strong>Description:</strong> {{ $event->description }}<br>
                                    <strong>Place:</strong> {{ $event->place }}<br>
                                    <strong>Date:</strong> {{ $event->date }}<br>
                                    <strong>Hour:</strong> {{ $event->hour }}
                                </p>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection