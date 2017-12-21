<div class="form-group">
    <label for="meal">Meal</label>
    <input type="text" class="form-control" id="meal" name="meal" value="{{ $offer->meal }}">
</div>

<div class="form-group">
    <label for="ingredients">Ingredients</label>
    <textarea id="ingredients" name="ingredients" class="form-control">{{ $offer->ingredients }}</textarea>
</div>

<div class="form-group">
    <label for="Cost">Cost</label>
    <div class="input-group">
        <input type="text" class="form-control" id="cost" name="cost" placeholder="Amount" value="{{ $offer->cost }}">
        <div class="input-group-addon">KM</div>
    </div>
</div>

<div class="form-group">
    <div class="input-group">
        <label for="category">Category</label>
        <input type="text" class="form-control" id="category" name="category" placeholder="Amount" value="{{ $offer->category }}">
    </div>
</div>

<!--<div class="form-group">
    <div class="input-group">
        <label for="tag">Tags</label>
        <input type="text" class="form-control" id="category" name="category" placeholder="Amount" value="{{ $offer->category }}">
    </div>
</div>-->

<div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" id="exampleInputFile">
</div>

<button type="submit" class="btn btn-primary">
    Submit
</button>