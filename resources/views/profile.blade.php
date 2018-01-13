@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading">Friends</div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ action('PostController@store') }}" method="POST">
                        {{ csrf_field() }}
                            <label for="text">
                                Create New Post
                            </label>
                            <textarea class="form-control" rows="5" name="text" ></textarea>
                            {{--<input class="form-control" required name="text" id="text">--}}
                            <button class="btn btn-info btn-sml pull-right">
                                Post
                            </button>
                    </form>

                    <table class="table table-condensed table-striped">
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>
                                    {{ $post->text }}
                                </td>
                                <td>
                                    <form action="{{ action('PostController@like') }}" method="POST">
                                        {{ csrf_field() }}
                                        <button class="btn btn-info btn-sml pull-right">
                                            Like
                                        </button>
                                    </form>
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
