<?php

namespace App\Http\Controllers\Nominations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\NominatePosition;
use App\Models\User;
use App\Models\Rank;
use App\Models\Regiment;
use App\Models\Company;


class PositionNominationsController extends Controller
{
    public function index()
    {
        switch(auth()->user()->permissions) {
            case 0:
                return redirect()->route('home');
            case 1:
            case 2:
            case 3:
                $search = ['companyID', '=', auth()->user()->company_id];
                break;
            case 4:
                $search = ['regimentID', '=', auth()->user()->regiment_id];
                break;
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
                $search = [['regimentID', '=', 0], ['companyID', '=', 0]];
                break;
            case 10:
                $search = [];
                break;
        }

        $nominations = NominatePosition::where($search, ['approved', '=', 0])->get();
        $ranks = Rank::all()->toArray();

        $data = array();
        $r = 0;

        foreach($nominations as $n){
            $nominee = User::find($n['nominee']);
            $nominator = User::find($n['nominator']);

            $data[$r]['nominationID'] = $n['id'];
            $data[$r]['userID'] = $nominee['id'];
            $data[$r]['username'] = $ranks[ $nominee['rank_id'] - 1 ]['abrv'] . ' ' . $nominee['name'];
            $data[$r]['position'] = $n['position'];
            $data[$r]['nominatorID'] = $nominator['id'];
            $data[$r]['nominatorName'] = $ranks[ $nominator['rank_id'] - 1 ]['abrv'] . ' ' . $nominator['name'];
            $r++;
        }

        //in progress
        //return view('nominations.awardList')->with('data', $data);
    }

    public function specific(Request $request, $nominationID)
    {
        
    }

    public function reviewed(Request $request, $nominationID)
    {
        
    }
}
