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
            case 0:
                return redirect()->route('home');
            case 1:
            case 2:
            case 3:
                $search = ['company', '=', auth()->user()->company_id];
                break;
            case 4:
                $search = ['regiment', '=', auth()->user()->regiment_id];
                break;
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
                $search = [['regiment', '=', 0], ['company', '=', 0]];
                break;
            case 10:
                $search = [];
                break;
        }

        $nominations = NominateAward::where($search, ['approved', '=', 0])->get();
        $ranks = Rank::all()->toArray();

        $data = array();
        $r = 0;
        foreach($nominations as $n){
            $nominee = User::find($n['nominee']);
            $nominator = User::find($n['nominator']);
            $award = Award::find($n['award']);

            $data[$r]['nominationID'] = $n['id'];
            $data[$r]['userID'] = $nominee['id'];
            $data[$r]['username'] = $ranks[ $nominee['rank_id'] - 1 ]['abrv'] . ' ' . $nominee['name'];
            $data[$r]['awardID'] = $award['id'];
            $data[$r]['awardName'] = $award['title'];
            $data[$r]['nominatorID'] = $nominator['id'];
            $data[$r]['nominatorName'] = $ranks[ $nominator['rank_id'] - 1 ]['abrv'] . ' ' . $nominator['name'];
            $r++;
        }

        return view('nominations.awardList')->with('data', $data);
    }

    public function specific($nominationID)
    {
        $data = NominateAward::find($nominationID);
        $ranks = Rank::all()->toArray();
        $award = Award::find($data['award']);

        $nominee = User::find($data['nominee']);
        $nominator = User::find($data['nominator']);
        $signing = User::find($data['approvedBy']);


        $extra = array();

        $extra['nomineeName'] = $ranks[ $nominee['rank_id'] - 1 ]['abrv'] . ' ' . $nominee['name'];
        $extra['nominatorName'] = $ranks[ $nominator['rank_id'] - 1 ]['abrv'] . ' ' . $nominator['name'];
        $extra['awardName'] = $award['title'];
        if($signing === null){
            $extra['approvedBy'] =  null;
        } else {
            $extra['approvedBy'] = $ranks[ $signing['rank_id'] - 1 ]['abrv'] . ' ' . $signing['name'];
        }

        return view('nominations.awardSpecific')->with('data', $data)->with('extra', $extra);
    }

    public function reviewed(Request $request, $nominationID)
    {
        
    }
}
