@extends('layouts.app')

@section('content')
    <div class="col-md-2 custom-add">

        <img class="picture" src="{{ asset('images/Advertisement/' . $ad->image) }}"
              alt="">
        <h4><a href="{{$ad->url}}">{{$ad->titles}}</a></h4>
        <div>
            {{$ad->description}}
        </div>
    </div>
@endsection





