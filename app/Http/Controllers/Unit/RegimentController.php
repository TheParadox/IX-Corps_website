<?php

namespace App\Http\Controllers\Unit;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\User;
use App\Models\Rank;
use App\Models\Regiment;
use App\Models\Company;


class RegimentController extends Controller
{
    public function index(Request $request, $regimentID)
    {
        $data = Regiment::findOrFail($regimentID);

        $regStrength = 0;
        $co = User::find($data->co_id);
        if($co === null){
            $data->co_name = null;
        } else {
            $data->co_name = $ranks[$co->rank_id - 1]['abrv'] .'. '. $co->name;
            //$regStrength++;
        }

        $xo = User::find($data->xo_id);
        if($xo === null){
            $data->xo_name = null;
        } else {
            $data->xo_name = $ranks[$xo->rank_id - 1]['abrv'] .'. '. $xo->name;
            //$regStrength++;
        }

        $sgtmaj = User::find($data->sgtMaj_id);
        if($sgtmaj === null){
            $data->sgtMaj_name = null;
        } else {
            $data->sgtMaj_name = $ranks[$sgtmaj->rank_id - 1]['abrv'] .'. '. $sgtmaj->name;
        }

        $adv = json_decode($data->advisors, true);
        $comp = json_decode($data->companies, true);

        $t = 0;
        $advisors = null;
        for($i = 0; $i < count($adv['adv']); $i++){

            $advUser = User::find($adv['adv'][$i]);
            if($advUser !== null){
                $advisors[$t]['id'] = $adv['adv'][$i];
                $advisors[$t]['name'] = $advUser->name;
                $t++;
                //$regStrength++;
            }
        }

        $t = 0;
        $companies = null;
        for($i = 0; $i < count($comp['comp']); $i++){

            $compMod = Company::find($comp['comp'][$i]);
            if($compMod !== null && $compMod->isActive == 1){
                $companies[$t]['id'] = $comp['comp'][$i];
                $companies[$t]['name'] = $compMod->letter;
                $rifles = json_decode($compMod->troops, true);
                $companies[$t]['troops'] = count($rifles['troops']);
                $regStrength += count($rifles['troops']);
            }
        }


        //'companies',

        return view('unit.regiment')->with('data', $data)->with('advisors', $advisors)->with('companies', $companies)->with('strength', $regStrength);
    }

}
