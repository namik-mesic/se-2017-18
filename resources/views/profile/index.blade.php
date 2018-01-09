@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">My profile</div>
                    <div class="panel-body">
                        <h1>Hello, {{ Auth::user()->name }}</h1>

                        <img class='custom-profile-photo' src="{{ Auth::user()->avatar->url('thumbnail') }}">
                        <ul>
                            <li class="iiii">name: {{Auth::user()->name}}</li>
                            <li>email: {{Auth::user()->email}}</li>
                            <li>location: {{Auth::user()->location}}</li>
                            <li>bio: {{Auth::user()->bio}}</li>
                        </ul>
                        <a href="{{ route('profile-update') }}" class="btn btn-primary">Update profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
