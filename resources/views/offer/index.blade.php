@extends('layouts.app')

@section('content')
    <div style="margin: 5% 20% 0 20%">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Meal</th>
                <th>Ingredients</th>
                <th>Cost</th>
            </tr>
            </thead>
            <tbod>
        @foreach($offers as $offer)
                <tr>
                    <th scope="row">{{$offer->id}}</th>
                    <td>{{$offer->meal}}</td>
                    <td>{{$offer->ingredients}}</td>
                    <td>{{$offer->cost}}</td>
                </tr>
        @endforeach
        </tbod>
    </div>
    {{ $offers->links() }}


@endsection