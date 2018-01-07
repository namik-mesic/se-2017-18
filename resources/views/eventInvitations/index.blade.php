@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="pull-left">
                            Event invitations
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
                                    Event
                                </td>
                                <td>Response</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($eventInvitations as $invitation)
                                <tr>
                                    <td>
                                        {{ $invitation->name }}
                                    </td>
                                    @if($invitation->response != "")
                                    <td>
                                        {{ $invitation->response }}
                                    </td>
                                    @else
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="/invitations/{{$invitation->id}}&yes">Yes</a>
                                            <a class="btn btn-sm btn-primary" href="/invitations/{{$invitation->id}}&maybe">Maybe</a>
                                            <a class="btn btn-sm btn-primary" href="/invitations/{{$invitation->id}}&no">No</a>

                                        </td>
                                        @endif
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
