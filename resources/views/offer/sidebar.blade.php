<div class="custom-sidebar">
    <div>
        <h4 class="custom-padding">Advance search</h4>
        <hr>
        <div>
        <form action="/offer/search/" method="get" role="search">
            {!! csrf_field() !!}
            <div class="input-group custom-search">
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon">
                <button type="submit">
                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </button>
            </span>
            </div>
        </form>
        </div>

        <div class="dropdown custom-dropdown">
            <button class="btn custom-dropdown-btn dropdown-toggle" type="button" data-toggle="dropdown">Tags
                <span class="caret"></span></button>
            <ul class="dropdown-menu">
                @foreach($tags as $tag)
                    <li>
                        <a href="/offer/tags/{{ $tag->name }}">{{ $tag->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <br>
        <br>
    <!--<h4>Advance search</h4>
        <hr>
        <h5>Tags: </h5>
        <ul>
            @foreach($tags as $tag)
        <li>
            <a href="/offer/tags/{{ $tag->name }}">{{ $tag->name }}</a>
                </li>
            @endforeach
            </ul>
-->
    </div>
</div>