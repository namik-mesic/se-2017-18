<div class="card custom-frame ">

    <form action="/offer/delete/{{$offer->id}}" method="POST">
        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="DELETE">

        <button type="submit" href="/offer/delete/{{$offer->id}}" style="float: right">
            <span class="fa fa-remove"></span>
        </button>
    </form>

    <img src="http://cottonfort.com/wp-content/uploads/2017/06/dummy-cat.png"
         alt="Card image cap"
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
                                        <i class="fa fa-minus">
                                        </i>
                                    </button>
                                     </span>
                    <input placeholder="1" name="quantity[]" value="1" min="1" max="10"
                           class="form-control input-number" style="width: 50px;" type="text">
                    <span class="input-group-btn">
                                    <button type="button" data-type="plus" data-field=""
                                            class="quantity-right-plus btn btn-success btn-number">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                      </span>
                </div>
            </div>
        </div>

        <br>
        <a href="#" class="btn btn-primary">Add to cart</a>

        <a href="offer/edit/{{$offer->id}}" class="btn btn-primary a-btn-slide-text">
            <i class="fa fa-edit" aria-hidden="true"></i>
            <span><strong>Edit</strong></span>
        </a>
    </div>
</div>