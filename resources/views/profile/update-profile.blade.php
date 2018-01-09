@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update profile</div>
                    <div class="panel-body">
                        <form action="{{ action('ProfileController@updateProfile') }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                            </div>
                            <div class="form-group">
                                <label for="location">Location:</label>
                                <input type="text" name="location" class="form-control" value="{{ Auth::user()->location }}">
                            </div>
                            <div class="form-group">
                                <label for="bio">Biography:</label>
                                <input type="text" name="bio" class="form-control" value="{{ Auth::user()->bio }}">
                            </div>
                            <div class="form-group">
                                <input type="file" name="avatar" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-info pull-right">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
