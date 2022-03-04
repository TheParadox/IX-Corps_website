<?php

namespace App\Http\Controllers\Nominations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\NominateAward;
use App\Models\User;
use App\Models\Rank;
use App\Models\Award;

class AwardNominationsController extends Controller
{
    public function index()
    {
        switch(auth()->user()->permissions) {
            case 3:
                $unitID = auth()->user()->company_id;
                break;
            case 4:
                $unitID = auth()->user()->regiment_id;
                break;
            default:
                $unitID = 0;
                break;
        }

        $nomination = NominateAward::where(['unitID', '=', $unitID], ['approved', '=', 0])->get();
        $ranks = Ranks::all()->toArray();
        //$awards = Award::all()->toArray();

        $data = array();
        $r = 0;
        foreach($nomination as $n){
            $nominee = User::find($n['nominee']);
            $nominator = User::find($n['nominator']);
            $award = Award::find($n['award']);

            $data[$r]['nominationID'] = $n['id'];
            $data[$r]['userID'] = $nominee['id'];
            $data[$r]['username'] = $ranks[ $nominee['rank_id'] - 1 ]['abrv'] . $nominee['name'];
            $data[$r]['awardID'] = $award['id'];
            $data[$r]['awardName'] = $award['name'];
            $data[$r]['nominatorID'] = $nominator['id'];
            $data[$r]['nominatorName'] = $ranks[ $nominator['rank_id'] - 1 ]['abrv'] . $nominator['name'];
            $r++;
        }

        return view('nominations.awardList')->with('data', $data);
    }

    public function specific($nominationID)
    {
        $data = NominateAward::find($nominationID);

        return view('nominations.awardSpecific')->with('data', $data);
    }

    public function reviewed(Request $request, $nominationID)
    {
        
    }
}
