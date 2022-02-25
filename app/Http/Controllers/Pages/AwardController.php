<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Award;
use App\Models\Regiment;
use App\Models\Company;

class AwardController extends Controller
{
    public function index()
    {
        $data = array();
        $awards = Award::all()->toArray();
        $regiments = Regiment::all()->toArray();
        $companies = Company::all()->toArray();


        $id = 0;
        foreach($awards as $award){
            $data[$id]['id'] = $award['id'];
            $data[$id]['title'] = $award['title'];
            $data[$id]['regID'] = $award['regiment_id'];
            if($award['regiment_id'] == 0){
                $data[$id]['regName'] = null;
            } else {
                $data[$id]['regName'] = $regiments[$award['regiment_id'] - 1]['name'];
            }

            $data[$id]['compID'] = $award['company_id'];
            if($award['company_id'] == 0){
                $data[$id]['compName'] = null;
            } else {
                $data[$id]['compName'] = $companies[$award['company_id'] - 1]['letter'];
            }

            $id++;
        }

        return view('pages.awardsList')->with('data', $data);
    }

    public function specific(Request $request, $awardID)
    {
        $data = array();
        $award = Award::find($awardID);        
        
        $regiments = Regiment::all()->toArray();
        $companies = Company::all()->toArray();


        if($award === null){
            return redirect()->route('listAwards');
        } else {
            $data['id'] = $award['id'];
            $data['title'] = $award['title'];
            $data['regID'] = $award['regiment_id'];
            if($award['regiment_id'] == 0){
                $data['regName'] = null;
            } else {
                $data['regName'] = $regiments[$award['regiment_id'] - 1]['name'];
            }

            $data['compID'] = $award['company_id'];
            if($award['company_id'] == 0){
                $data['compName'] = null;
            } else {
                $data['compName'] = $companies[$award['company_id'] - 1]['letter'];
            }
            $data['criteria'] = $award['awardCriteria'];

        }


        return view('unit.award')->with('data', $data);
    }
}
