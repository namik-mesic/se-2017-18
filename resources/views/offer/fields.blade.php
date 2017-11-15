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

<div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" id="exampleInputFile">
</div>

<button type="submit" class="btn btn-primary">
    Submit
</button>