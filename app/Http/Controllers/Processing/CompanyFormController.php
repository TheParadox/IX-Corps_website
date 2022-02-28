<?php

namespace App\Http\Controllers\Processing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Regiment;
use App\Models\Company;

class CompanyFormController extends Controller
{
    public function index()
    {
        $regiments = Regiment::all()->toArray();

        $data = array();
        $r = 0;
        foreach($regiments as $reg){
            if($reg !== null){
                $data[$r]['id'] = $reg['id'];
                $data[$r]['name'] = $reg['name'];
                $data[$r]['abrv'] = $reg['abrv'];

                $r++;
            }
        }

        return view('processing.company')->with('data', $data);
    }

    public function store(Request $request)
    {
        //dd($request);

        $this->validate($request, [
            'regiment' => ['required', 'integer'],
            'letter' => ['required', 'max:255'],
            'createdBy' => ['required', 'integer'],
        ]);
        //, 'date_format:Y-n-j'


        $regiment = Regiment::find($request->regiment);
        if($regiment === null){
            //dd($regiment);
            $regID = 0;
        } else {
            //dd($regiment);
            $regID = $regiment->id;
        }

        $newCompany = Company::create([
            'regiment_id' => $regID,
            'letter' => $request->letter,
            'co_id' => 0,
            'firstSgt_id' => 0,
            'sgts' => "{\"sgts\":[]}",
            'cpls' => "{\"cpls\":[]}",
            'troops' => "{\"troops\":[]}",
            'isActive' => 1,
            'createdBy' => $request->createdBy,
        ]);

        //$newCompany->save();

        $companies = json_decode($regiment->companies, true);
        $companies['comp'][] = $newCompany->id;
        $regiment->companies = $companies;
        $regiment->save();


        return redirect()->route('company', ['companyID' => $newCompany->id]);
    }

    public function edit(Request $request, $companyID)
    {
        
    }

    public function update(Request $request, $companyID)
    {
        
    }

}
