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
    public function index(Request $request)
    {
        $offers = Offer::query()->paginate(15, $request->get(''));

        if (isset($request->offerquery)) {
            $offers = DB::table('offers')->where('meal', 'like', '%' . $request->offerquery . '%')->paginate(15);
        }

        $tags = Tag::selectRaw('name')->get();
        $categories = Offer::select('category')->distinct()->get();

        return view('offer.index', compact('offers', 'tags', 'categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $offer = new Offer;
        $categories = Offer::select('category')->distinct()->get();

        return view('offer.create', compact(
            'offer', 'categories'
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
        $offer->category = request('category');

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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function tagsShow(Request $request)
    {
        /** @var Tag $tag */
        $tag = Tag::query()->find($request->get('tag_id'));

        $offers = $tag->offers()->paginate(15);
        $tags = Tag::query()->get();
        $categories = Offer::query()->select('category')->distinct()->get();

        return view('offer.index', compact('offers', 'tags', 'tag', 'categories'));
    }

    /**
     * @param $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function categoryShow($category)
    {
        $offers = DB::table('offers')->where('category', '=', $category)->paginate(15);
        $tags = Tag::query()->get();
        $categories = Offer::select('category')->distinct()->get();

        return view('offer.index', compact('offers', 'tags', 'categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function searchByPrice (Request $request){

        $offers = DB::table('offers')->whereBetween('cost', [$request->from, $request->to])->paginate(15);
        $tags = Tag::query()->get();
        $categories =Offer::select('category')->distinct()->get();

        return view('offer.index', compact('offers', 'tags', 'categories'));

    }
    public function sort( $request){

        return $request ;
    }
}
