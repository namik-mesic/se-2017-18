<div class="col-md-2 custom-add">



<div class="buttons">

    <form action="/advertise/delete/{{$ad->id}}" method="POST">
        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="DELETE">

        <button type="submit" href="/advertise/delete/{{$ad->id}}" style="float: right">
            <img class="icon" src="{{ asset('images/iks.png') }}" alt="Delete">
            <span class="fa fa-remove"></span>
        </button>
    </form>
    <a href="advertise/edit/{{$ad->id}}" class="edit-btn" style="float:right">
        <button>
        <i class="fa fa-edit" aria-hidden="true"></i>
       <img class="icon" src="{{ asset('images/edit.png') }}" alt="Edit"></button>
    </a>

</div>

    <a href="{{"http://" . $ad->url}}">
        <img class="picture" src="{{ asset('images/Advertisement/' . $ad->image) }}"
         alt=""></a>


    <h4><a href="{{"http://" . $ad->url}}">{{$ad->titles}}</a></h4>
    <div>
        {{$ad->description}}
    </div>



</div>