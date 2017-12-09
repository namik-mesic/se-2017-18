@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="pull-left">
                            Edit {{ $event->name }}
                        </div>

                        <a href="{{ action('EventController@index') }}" class="pull-right btn btn-info btn-sm">
                            Event index
                        </a>

                        <div class="clearfix"></div>
                    </div>

                    <div class="panel-body">

                        <!-- if there are creation errors, they will show here -->
                        {{ HTML::ul($errors->all()) }}

                        {{ Form::model($event, array('route' => array('event.update', $event->id), 'method' => 'PUT')) }}

                        <div class="form-group">
                            {{ Form::label('name', 'Name') }}
                            {{ Form::text('name', null, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('description', 'Description') }}
                            {{ Form::text('description', null, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('place', 'Place') }}
                            {{ Form::text('place', null, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('date', 'Date') }}
                            {{ Form::date('date', null, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('hour', 'Hour') }}
                            {{ Form::text('hour', null, array('class' => 'form-control')) }}
                        </div>

                        {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}

                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
