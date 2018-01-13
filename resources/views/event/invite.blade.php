@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="pull-left">
                            Invite
                        </div>

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
                                    User name
                                </td>

                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invitedUsers as $user)
                                @if($user->id != Auth::user()->id)
                                <tr>
                                    <td>
                                        {{ $user->id }}
                                    </td>
                                    <td>
                                        {{ $user->name }}
                                    </td>

                                    <td>
                                        @if($user->invited == false)
                                        <a class="btn btn-sm btn-info" href="/event/{{$event_id}}/invite/{{$user->id}}">Invite</a>
                                        @else
                                            <span>{{$user->response}}</span>
                                            @endif
                                    </td>

                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
