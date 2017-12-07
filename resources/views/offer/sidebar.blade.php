<div class="custom-sidebar">
    <h4>Advance search</h4>
    <hr>
    <h5>Tags: </h5>
    <ul>
        @foreach($tags as $tag)
            <li>
                <a href="/offer?tag_name={{ $tag->name }}">{{ $tag->name }}</a>
            </li>
            {{--
            <li><a href="/offer/tags/{{$tag->name}}">{{ $tag->name }}</a></li>
            --}}
        @endforeach
    </ul>
</div>