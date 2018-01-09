@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Members</div>
                    <div>
                        <table class="table table-condensed table-striped">
                            <tbody>
                            @foreach($members as $member)
                                <tr>
                                    <td>
                                        <a href="#">{{ route('profile', $member->id) }}</a>
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
                    <div>
                        <button>
                            Upload File
                        </button>
                    </div>
                    <div>
                        <table class="table table-condensed table-striped">
                            <tbody>
                            @foreach($files as $file)
                                <tr>
                                    <td>
                                        <a href="#">{{ $file->file_url }}</a>
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
