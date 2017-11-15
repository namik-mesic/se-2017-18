@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="pull-left">
                            User index
                        </div>

                        <a href="{{ action('UserController@create') }}" class="pull-right btn btn-success btn-sm">
                            Create user
                        </a>

                        <div class="clearfix"></div>
                    </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ action('UserController@index') }}" method="GET">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="query">
                                            Query
                                        </label>
                                        <input type="text" id="query" name="query" placeholder="Query" value="{{ Request::get('query') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-success" style="margin-top: 27px">
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </form>

                        @if(!count($users))
                            <div class="alert alert-info">
                                No users have been found
                            </div>
                        @else
                            <table class="table table-condensed table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Ime korisnika
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th style="width: 100px">
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            {{ $user->id }}
                                        </td>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            <a href="{{ action('UserController@edit', $user->id) }}" class="btn btn-xs btn-info">
                                                Edit
                                            </a>

                                            <form action="{{ action('UserController@destroy', $user->id) }}" method="POST" style="display: inline-block">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-xs btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif

                        <div class="text-center">
                            {!! $users->appends(Request::only(['query']))->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
