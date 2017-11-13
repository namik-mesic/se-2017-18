@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="create-offer">
            <h1>Create a new offer</h1>
            <hr class="custom-red-colors">
            <form method="post" action="/offer/" >

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="meal">Meal</label>
                    <input type="text" class="form-control" id="meal" name="meal" required>
                </div>

                <div class="form-group">
                    <label for="ingredients">ingredients</label>
                    <textarea id="ingredients" name="ingredients" class="form-control" required></textarea>
                </div>

                <div class="form-group">

                    <div class="input-group">
                        <input type="text" class="form-control" id="cost" name="cost" placeholder="Amount" required>
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
