@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="pull-left">
                            Edit user - {{ $user->name }}
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

                        <form action="{{ action('UserController@update', $user->id) }}" method="POST">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="name">
                                    Name
                                </label>
                                <input class="form-control" required name="name" value="{{ $user->name }}" id="name">
                            </div>

                            <div class="form-group">
                                <label for="email">
                                    Email
                                </label>
                                <input class="form-control" type="email" required name="email" value="{{ $user->email }}" id="email">
                            </div>

                            <div class="form-group">
                                <label for="password">
                                    Password
                                </label>
                                <input class="form-control" type="password" name="password" id="password">
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