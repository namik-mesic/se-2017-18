@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="create-offer">
            <h1>Edit </h1>
            <hr class="custom-red-colors">
            <form method="post" action="/offer/update/{{$offer->id}}">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="meal">Meal</label>
                    <input type="text" class="form-control" id="meal" name="meal" required value="{{$offer->meal}}">
                </div>

                <div class="form-group">
                    <label for="ingredients">ingredients</label>
                    <textarea id="ingredients" name="ingredients" class="form-control" required>{{$offer->ingredients}}</textarea>
                </div>

                <div class="form-group">

                    <div class="input-group">
                        <input type="text" class="form-control" id="cost" name="cost" required vlaue="{{$offer->cost}}">
                        <div class="input-group-addon">KM</div>
                    </div>

                </div>

                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <input type="file" id="exampleInputFile">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection