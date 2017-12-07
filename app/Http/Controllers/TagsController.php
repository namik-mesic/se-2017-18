<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        // $offers = $tag->offers;
        $offers = $tag->offers()->paginate(15);
        $tags = Tag::selectRaw('name')->get();

        return view('offer.index', compact('offers', 'tags', 'tag'));
    }
}
