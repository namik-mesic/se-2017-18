@extends('layouts.app')

<script

        src="https://code.jquery.com/jquery-3.2.1.min.js"

        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="

        crossorigin="anonymous"></script>

@section('content')

    <div class="container-fluid">


        <div class=“row">
            <a href="/advertise/create" class="btn btn-primary a-btn-slide-text">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                <span><strong>Add an Advertisement</strong></span>
            </a>


            <div class="col-md-8">



                <div class="row row-flex custom-advert">



                    <div style="width: 100%">



                        @foreach($ads as $ad)

                            <div class="col-md-2 custom-card">

                                @include('advertise.adBox')

                            </div>



                        @endforeach



                    </div>

                    <div style="clear:both"></div>

                    <div class="custom-pagination">

                        {{ $ads->links() }}

                    </div>

                </div>

            </div>



        </div>

    </div>




    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

    <script src="{{ asset('js/custom.js') }}"></script>



@endsection