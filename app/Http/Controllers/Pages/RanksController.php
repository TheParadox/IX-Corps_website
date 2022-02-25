<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Rank;

class RanksController extends Controller
{
    public function index()
    {
        $ranks = Rank::all()->sortBy('level')->toArray();

        return view('pages.ranksList')->with('data', $ranks);
    }

    public function specific(Request $request, $rankID)
    {
        $rank = Rank::find($rankID);

        return view('unit.rank')->with('data', $rank);
    }
}
