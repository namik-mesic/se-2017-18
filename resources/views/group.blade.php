@extends('layouts.groupheader')
<link href="{{ asset('css/groups.css') }}" rel="stylesheet">
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Members</div>
                    <div>
                        <table class="table table-condensed table-striped">
                            <tbody>
                            @foreach($members as $member)
                                <tr>
                                    <td class="group-users">
                                        <a href="{{ route('profile', $member->id) }}">{{$member->name}}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Files</div>
                    <div class="centralize">
                        <button class="button-center">
                            Upload File
                        </button>
                    </div>
                    <div>
                        <table class="table table-condensed table-striped">
                            <tbody>
                            @foreach($files as $file)
                                <tr class="group-box">
                                    <td >
                                        {{ $file->file_url }}

                                    </td>
                                    <td>
                                        <button class="download">
                                            Download
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                </div>
            </div>
        </div>
    </div>
@endsection
