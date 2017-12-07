@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-xs-5 col-md-6">
            <h1>Edit </h1>
            <hr class="custom-red-colors">
            <form method="post" action="/offer/update/{{$offer->id}}">

                {{ csrf_field() }}

                @include('offer.fields')
            </form>

            @include('offer/validate');

        </div>

    </div>

@endsection