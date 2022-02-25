<?php

namespace App\Http\Controllers\Unit;

use App\Models\Regiment;
use App\Models\Company;
use App\Models\User;
use App\Models\Rank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request, $companyID)
    {
        $ranks = Rank::all()->toArray();

        $data = Company::findOrFail($companyID);

        $regiment = Regiment::find($data->regiment_id);

        $compStrength = 0;
        $co = User::find($data->co_id);
        if($co === null){
            $data->co_name = null;
        } else {
            $data->co_name = $ranks[$co->rank_id - 1]['abrv'] .'. '. $co->name;
            //$regStrength++;
        }

        $firstSgt = User::find($data->firstSgt_id);
        if($firstSgt === null){
            $data->firstSgt = null;
        } else {
            $data->firstSgt_name = $ranks[$firstSgt->rank_id - 1]['abrv'] .'. '. $firstSgt->name;
            //$regStrength++;
        }

        $sgtsJson = json_decode($data->sgts, true);
        $cplsJson = json_decode($data->cpls, true);
        $troopsJson = json_decode($data->troops, true);
        $sgts = array();
        $cpls = array();
        $troops = array();


        $t = 0;
        for($i = 0; $i < count($sgtsJson['sgts']); $i++){

            $sgtUser = User::find($sgtsJson['sgts'][$i]);
            if($sgtUser !== null){
                $sgts[$t]['id'] = $sgtsJson['sgts'][$i];
                $sgts[$t]['name'] = $ranks[$sgtUser->rank_id - 1]['abrv'] .'. '. $sgtUser->name;
                $t++;
                //$regStrength++;
            }
        }

        $t = 0;
        for($i = 0; $i < count($cplsJson['cpls']); $i++){

            $cplsUser = User::find($cplsJson['cpls'][$i]);
            if($cplsUser !== null){
                $cpls[$t]['id'] = $cplsJson['cpls'][$i];
                $cpls[$t]['name'] = $ranks[$cplsUser->rank_id - 1]['abrv'] .'. '. $cplsUser->name;
                $t++;
                //$regStrength++;
            }
        }

        $t = 0;
        for($i = 0; $i < count($troopsJson['troops']); $i++){

            $troopUser = User::find($troopsJson['troops'][$i]);
            if($troopUser !== null){
                $troops[$t]['id'] = $troopsJson['troops'][$i];
                $troops[$t]['name'] = $ranks[$troopUser->rank_id - 1]['abrv'] .'. '. $troopUser->name;
                $t++;
                //$regStrength++;
            }
        }
        //'companies',

        return view('unit.company')->with('data', $data)->with('sgts', $sgts)->with('cpls', $cpls)->with('troops', $troops)->with('regiment', $regiment);
    }
}
