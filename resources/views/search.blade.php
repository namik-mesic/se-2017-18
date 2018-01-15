@extends('layouts.app')



@section('content')
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Users Results</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-condensed table-striped">
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <a href="{{ route('profile', $user['id']) }}">{{ $user['name'] }}</a>
                                    <button class="join">
                                        Add Friend
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Groups Results</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-condensed table-striped">
                        <tbody>
                        @foreach($groups as $group)
                            <tr>
                                <td class="group-box">
                                    <a href="{{ route('group', $group['id']) }}">{{ $group['name'] }}</a>

                                    <button class="join">
                                        Join Group
                                    </button>
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
