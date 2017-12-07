<div class="form-group">
    <label for="meal">Meal</label>
    <input type="text" class="form-control" id="meal" name="meal" value="{{ $offer->meal }}">
</div>

<div class="form-group">
    <label for="ingredients">ingredients</label>
    <textarea id="ingredients" name="ingredients" class="form-control">{{ $offer->ingredients }}</textarea>
</div>

<div class="form-group">
    <div class="input-group">
        <input type="text" class="form-control" id="cost" name="cost" placeholder="Amount" value="{{ $offer->cost }}">
        <div class="input-group-addon">KM</div>
    </div>
</div>

<div class="input-group-btn">
    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
        Action
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
        <a class="dropdown-item" href="#">Something else here</a>
        <div role="separator" class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Separated link</a>
    </div>
</div>

<div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" id="exampleInputFile">
</div>

<button type="submit" class="btn btn-primary">
    Submit
</button>