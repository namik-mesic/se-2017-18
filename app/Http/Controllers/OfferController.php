<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    public function index () {
        $offers = DB::table('offers')->paginate(15);

        return view('offer.index', ['offers' => $offers]);
    }
}
