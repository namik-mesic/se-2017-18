@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="pull-left">
                            Create event
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

                        <form action="{{ action('EventController@store') }}" method="POST">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="name">
                                    Name
                                </label>
                                <input class="form-control" required name="name" id="name">
                            </div>

                            <div class="form-group">
                                <label for="description">
                                    Description
                                </label>
                                <input class="form-control" type="email" required name="description" id="description">
                            </div>

                            <div class="form-group">
                                <label for="place">
                                    Place
                                </label>
                                <input class="form-control" type="text" required name="place" id="place">
                            </div>

                            <div class="form-group">
                                <label for="place">
                                    Place
                                </label>
                                <input class="form-control" type="text" required name="place" id="place">
                            </div>

                            <div class="form-group">
                                <label for="date">
                                    Date
                                </label>
                                <input class="form-control" type="text" required name="date" id="date">
                            </div>

                            <div class="form-group">
                                <label for="hour">
                                    Hour
                                </label>
                                <input class="form-control" type="text" required name="hour" id="hour">
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
