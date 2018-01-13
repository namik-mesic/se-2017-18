@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">My profile</div>
                    <div class="panel-body">
                        <h1>Hello, {{ Auth::user()->name }}</h1>

                            <div class="row">
                                <div class="col-md-6">
                                    <img class='custom-profile-photo' src="{{ Auth::user()->avatar->url('thumb') }}" width="15px">
                                    <div class="batoni">
                                        <a href="{{ route('profile-update') }}" class="btn btn-primary">Update profile</a>
                                        <a href="{{ route('profile-delete') }}" class="btn btn-primary">Delete profile</a>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <ul class='custom-list'>
                                        <li class="i">name: {{Auth::user()->name}}</li>
                                        <li class="ii">email: {{Auth::user()->email}}</li>
                                        <li class = "iii"> location: {{Auth::user()->location}}</li>
                                        <li class = "iiii">bio: {{Auth::user()->bio}}</li>
                                    </ul>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Daily notes</h3>
                                    <form action="{{ route('profile-comment.store')  }}" method="POST">
                                        {{ csrf_field() }}
                                        <textarea class="form-control" rows="3" id="comment" name="comment" placeholder="What do I think about.."></textarea>
                                        <button type="submit" class="btn btn-primary">Note it!</button>
                                    </form>
                                    <br>
                                    @if(count($comments) > 0)
                                        @foreach($comments as $comment)
                                            <div class="alert alert-info">
                                                <p>{{ $comment->comment }}</p>
                                                <div class="text-right">
                                                    <form action="{{ route('profile-comment.destroy', ['id' => $comment->id ]) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-danger">-</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="alert alert-info">You did not write any daily notes today.</div>
                                    @endif
                                </div>
                            </div>
                </div></div>
            </div>
        </div>
    </div>
@endsection
