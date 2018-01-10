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
       {{-- <input list="category" type="text" class="form-control" id="category" name="category" placeholder="Category"
               value="{{ $offer->category }}">--}}
        {{--  <datalist id="category">
             @foreach($category as $category)
               <option value="{{$category->category}}">
               @endforeach
            <option value="dddd"></option>
        </datalist>--}}
        <select name="category" id="category">
            @foreach($categories as $category)
                <option value="{{$category->category}}">{{$category->category}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group input-group">
    <label for="tags">Tags</label>
    <select id="tags">
        <option value=""></option>
    </select>
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
