@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('post', auth()->user()->id) }}" method="POST">
                        {{ csrf_field() }}
                            <div>
                                <label for="text">
                                    Create New Post
                                </label>
                                <button class="btn btn-default pull-right">
                                    Post
                                </button>
                            </div>
                            <textarea class="form-control" rows="5" name="text" ></textarea>

                    </form>

                    {{--<table class="table table-condensed table-striped">--}}
                        {{--<tbody>--}}
                        {{--@foreach($posts as $post)--}}
                            {{--<tr>--}}
                                {{--<td>--}}
                                    {{--<a href="{{ route('profile', $post->user['id']) }}">{{ $post->user['name'] }}</a>--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--{{ $post->text }}--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--<form action="{{ action('PostController@like') }}" method="POST">--}}
                                        {{--{{ csrf_field() }}--}}
                                        {{--<button class="btn btn-info btn-sml pull-right">--}}
                                            {{--Like--}}
                                        {{--</button>--}}
                                    {{--</form>--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
                        {{--</tbody>--}}
                    {{--</table>--}}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
