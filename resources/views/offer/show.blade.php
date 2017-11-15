@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Restaurant offer</h1>
        <hr class="custom-red-colors">
        @include('offer.cart')
        <div class="col-md-3 custom-card ">
            @include('offer.box')
        </div>
    </div>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
@endsection