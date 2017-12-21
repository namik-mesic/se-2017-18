<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Offer;

use App\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $offers = Offer::query()->paginate(15);

        $tags = Tag::selectRaw('name')->get();

        return view('offer.index', compact('offers', 'tags'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $offer = new Offer;

        return view('offer.create', compact(
            'offer'
        ));
    }

    /**
     * @param OfferRequest $offerRequest
     * @return RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function store(OfferRequest $offerRequest)
    {
        $offer = new Offer;

        $offer->meal = request('meal');
        $offer->ingredients = request('ingredients');
        $offer->cost = request('cost');
        $offer->category =request('category');

        $offer->save();


        return redirect()->action('OfferController@index');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function edit($id)
    {

        $offer = Offer::find($id);

        return view('offer.edit', compact('offer'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function show($id)
    {
        $offer = Offer::find($id);

        return view('offer.show', compact('offer'));
    }

    /**
     * @param $id
     * @return RedirectResponse
     */

    public function delete($id)
    {

        $offer = Offer::find($id);
        $offer->delete();
        return redirect()->action('OfferController@index');

    }

    /**
     * @param $id
     * @param OfferRequest $request
     * @return RedirectResponse
     */

    public function update($id, OfferRequest $request)
    {
        $offer = Offer::find($id);

        $offer->meal = $request->get('meal');
        $offer->ingredients = $request->get('ingredients');
        $offer->cost = $request->get('cost');
        $offer->category = $request->get('category');

        $offer->save();
        return redirect()->action('OfferController@index');
    }
    public function tagsShow(Tag $tag){
        $offers = $tag->offers()->paginate(15);
        $tags = Tag::selectRaw('name')->get();

        return view('offer.index', compact('offers', 'tags', 'tag'));
    }
    public function scopeSearchByName(Request $request){

      //  $offers = Offer::where('name', 'like', '%'.$request.'%')->paginate(15);
        return 1;
        //return view('offer.index', compact('offers'));
    }
}
