@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="pull-left">
                            Create user
                        </div>

                        <a href="{{ action('UserController@index') }}" class="pull-right btn btn-info btn-sm">
                            User index
                        </a>

                        <div class="clearfix"></div>
                    </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ action('UserController@store') }}" method="POST">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="name">
                                    Name
                                </label>
                                <input class="form-control" required name="name" id="name">
                            </div>

                            <div class="form-group">
                                <label for="email">
                                    Email
                                </label>
                                <input class="form-control" type="email" required name="email" id="email">
                            </div>

                            <div class="form-group">
                                <label for="password">
                                    Password
                                </label>
                                <input class="form-control" type="password" required name="password" id="password">
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
