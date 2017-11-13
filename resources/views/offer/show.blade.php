@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Restaurant offer</h1>
        <hr class="custom-red-colors">
        @include('offer.cart')
        <div class="col-md-3 custom-card ">

            <div class="card custom-frame">

                <a href="#" style="float: right">
                    <span class="glyphicon glyphicon-remove"></span>
                </a>

                <img src="http://cottonfort.com/wp-content/uploads/2017/06/dummy-cat.png" alt="Card image cap"
                     class="card-img-top img-responsive">

                <div class="card-block">
                    <h4 class="card-title card-overflow">
                        <a href="/offer/{{$offer->id}}">
                            {{$offer->id . ' ' . $offer->meal}}
                        </a>
                    </h4>
                    <p class="card-text card-overflow">{{$offer->ingredients}}</p>
                    <br>
                    <p class="card-text price">{{$offer->cost}} KM</p>
                    <br>
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="input-group">
                                    <span class="input-group-btn">
                                    <button type="button" data-type="minus" data-field=""
                                            class="quantity-left-minus btn btn-danger btn-number">
                                        <span class="glyphicon glyphicon-minus">
                                        </span>
                                    </button>
                                     </span>
                                <input placeholder="1" name="quantity[]" value="1" min="1" max="10"
                                       class="form-control input-number" style="width: 50px;" type="text">
                                <span class="input-group-btn">
                                    <button type="button" data-type="plus" data-field=""
                                            class="quantity-right-plus btn btn-success btn-number">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                      </span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <a href="#" class="btn btn-primary">Add to cart</a>

                    <a href="offer/update" class="btn btn-primary a-btn-slide-text">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        <span><strong>Update</strong></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
@endsection