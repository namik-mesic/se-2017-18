@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">FEED</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('post_create', Auth::user()->id) }}" method="POST">
                        {{ csrf_field() }}

                        <textarea class="form-control" rows="5" name="text" style="resize:none" placeholder="Create new post.."></textarea>

                        <button class="pull-right col-md-2 btn btn-primary"  style="margin: 5px">
                            Post
                        </button>

                    </form>

                        <table class="table table-condensed table-striped">
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>
                                        <a href="{{ route('profile_show', $post->friend_id) }}">{{ $post->name }}</a>
                                    </td>
                                    <td>
                                        {{ $post->text }}
                                    </td>
                                    <td>
                                        @if( Auth::user()->hasUpvote($post->id) )
                                            <form action="{{ route( 'post_downvote', $post->id ) }}" method="POST">
                                                {{ csrf_field() }}
                                                <button class="btn btn-sml pull-right btn-success">
                                                    Upvoted
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route( 'post_upvote', $post->id ) }}" method="POST">
                                                {{ csrf_field() }}
                                                <button class="btn btn-info btn-sml pull-right">
                                                    Upvote
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $post->upvotes()->count() }} upvotes
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
