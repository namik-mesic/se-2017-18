@extends('layouts.app')
<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                @include('offer.sidebar')
            </div>
            <div class="col-md-8">
                <div class="custom-add">
                    <h1 class="custom-h1">
                        Restaurant offer @if(isset($tag))  - {{ $tag->name }} @endif
                    </h1>
                    <hr class="custom-red-colors">
                    <a href="/offer/create" class="btn btn-primary a-btn-slide-text">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        <span><strong>Add a meal</strong></span>
                    </a>
                    <div class="form-group" style="float: right">
                        <label for="">Sort by:</label>
                        <select name="sort" id="sort">
                            <option value=""></option>
                            <option value="1">Price asc</option>
                            <option value="2">Price dsc</option>
                            <option value="3">Relevance</option>
                        </select>
                    </div>
                </div>
                <div class="row row-flex custom-offer">
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
            <div class="col-md-2">
                @include('offer.cart')
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        $(document).ready(function () {
            $( "#sort" ).change(function() {
                var url = "/sort/"+$('#sort').val();
                $(location).attr('href',url);
            });
        });
    </script>
@endsection
