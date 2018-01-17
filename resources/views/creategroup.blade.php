@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Creat a group</h3>
        <form action="/group/store" method="post">
            {{ csrf_field() }}
            @include('fields')
        </form>
    </div>

    @endsection

