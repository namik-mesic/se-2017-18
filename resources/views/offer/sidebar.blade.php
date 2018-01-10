<div class="custom-sidebar">
    <div>
        <h4 class="custom-padding">Advance search</h4>
        <hr>
        <div>
            <form action="/search" method="GET" role="search">
                {!! csrf_field() !!}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="query">
                                Search:
                            </label>
                            <input type="text" id="query" name="offerquery" placeholder="Search..."
                                   value="{{Request::get('query')}}" class="form-control">
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

        <div class="form-group">
            <form action="/searchPrice" method="GET">
                <label for="priceSearch">
                    Search by price:
                </label>
                <br>
                <label>From:</label>
                <input type="number" id="from" name="from" class="form-control" value="" required>
                <br>
                <label>To:</label>
                <input type="number" id="to" name="to" class="form-control" value="" required>
                <button type="submit" class="btn btn-success" style="display: none"></button>
            </form>
        </div>

        <div class="form-group">
            {{-- {{ Form::select('tags', [@foreach ($tags as $tag)]) }}--}}
            <form action="/offer/tags" method="GET" id="tags">
                <label for="tags">Select tags:</label>
                <select class="form-control" name="tag_id" form="tags">
                    <option>Select a tag</option>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
                <input type="submit">
            </form>

        </div>

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
