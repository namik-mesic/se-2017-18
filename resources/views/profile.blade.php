@extends('layouts.app')

@section('content')
    @if( Auth::user()->isFriend($user->id) || Auth::user()->id == $user->id )
<div class="container">
    @if(Auth::user()->id == $user->id )
        <div class="panel panel-default">
            <div class="panel-heading">Friend requests</div>
        <div class="row">
            <div class="col-md-12">
                <table>
                    <tbody>
                    @foreach($requests as $request)
                        <tr>
                            <td>
                                {{ $request->name }} wants to be your friend
                            </td>
                            <td class="pull-right">
                                <a href="{{ route('friend_accept', $request->id) }}">
                                    <button class="btn btn-primary"  style="margin: 5px">
                                        Accept
                                    </button>
                                </a>
                            </td>
                            <td class="pull-right">
                                <a href="{{ route('friend_ignore', $request->id) }}">
                                    <button class="btn btn-primary"  style="margin: 5px">
                                        Ignore
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
            </div>
    @endif

    <div class="row">

        <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading">Friends</div>

                <table class="table table-condensed table-striped">
                    <tbody>
                    @foreach($friends as $friend)
                        <tr>
                            <td>
                                <a href="{{ route('profile_show', $friend->id) }}">{{ $friend->name }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $user->name }} Posts</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if( $user->id == Auth::user()->id )
                        <form action="{{ route('post_create', Auth::user()->id) }}" method="POST">
                            {{ csrf_field() }}

                            <textarea class="form-control" rows="5" name="text" style="resize:none" placeholder="Create new post.."></textarea>

                            <button class="pull-right col-md-2 btn btn-primary"  style="margin: 5px">
                                Post
                            </button>

                        </form>
                        @endif

                        <table class="table table-condensed table-striped">
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>
                                        <a href="{{ route('profile_show', $post->user_id) }}">{{ $post->name }}</a>
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
</div>
    @else
        @if( !Auth::user()->requestSent($user->id) )
        <div class="container">
            <div class="row">
        <div class="panel panel-default">
            <div class="pull-left">You are not friends with this user</div>

        <a href="{{ route('friend_request', $user->id) }}">
            <button class="btn btn-danger pull-right">
                Add Friend
            </button>
        </a>

</div></div>
            @else
                <div class="container">
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="pull-left">You requested friendship with this user</div>
                        </div>
                    </div>
                @endif
</div>
@endif
@endsection
