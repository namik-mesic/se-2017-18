<div class="custom-sidebar">
    <div>
        <h4 class="custom-padding">Advance search</h4>
        <hr>
        <div>
            <form action="/offer" method="GET" role="search">
                {!! csrf_field() !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="query">
                                Query
                            </label>
                            <input type="text" id="query" name="query" placeholder="query" value="{{Request::get('query')}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success" style="margin-top: 27px">
                            Search
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="custom-dropdown">
            Tags:
            @foreach($tags as $tag)
                <a href="/offer/tags/{{ $tag->name }}">{{ $tag->name }}</a>
                <br>
            @endforeach

        </div>
        <br>
        <hr>
        <div class="custom-dropdown">
            Category:
            @foreach($categories as $category)
                <a href="/offer/categories/{{$category->category}}">{{ $category->category }}</a>
                <br>
            @endforeach
        </div>
        <br>
    </div>
</div>