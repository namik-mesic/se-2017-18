@extends('layouts.app')
<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
@section('content')

    <div class="container">
        <div class="custom-add">
            <h1>Restaurant offer</h1>
            <hr class="custom-red-colors">
            <a href="/offer/create" class="btn btn-primary a-btn-slide-text">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                <span><strong>Add a meal</strong></span>
            </a>
        </div>
        @include('offer.cart')
        <div class="row row-flex custom-flex">
            <div style="width: 100%">
                @foreach($offers as $offer)
                    <div class="col-md-3 custom-card">
                        @include('offer.box')
                    </div>

                @endforeach
            </div>
            <div style="clear:both"></div>
            <div class="custom-pagination">
                {{ $offers->links() }}
            </div>
        </div>

    </div>

    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>




@endsection
