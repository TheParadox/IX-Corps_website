<?php

namespace App\Http\Controllers\Processing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $data = Company::find($companyID);

        $reg = array();
        $r = 0;
        $regiments = Regiment::all()->toArray();
        foreach($regiments as $regiment){
            if($regiment !== null){
                $reg[$r]['id'] = $regiment['id'];
                $reg[$r]['name'] = $regiment['name'];
                $reg[$r]['abrv'] = $regiment['abrv'];

                $r++;
            }
        }

        return view('editing.company')->with('data', $data)->with('regiments', $reg);
    }

    public function update(Request $request, $companyID)
    {
        $this->validate($request, [
            'regiment' => ['required', 'integer'],
            'letter' => ['required', 'max:255'],
        ]);
        
        $company = Company::find($companyID);

        self::updateRegiment($company->regiment_id, $request->regiment, $companyID);

        $company->regiment_id = $request->regiment;
        $company->letter = $request->letter;
        if($request->has('isActive')){
            $company->isActive = true;
        } else {
            $company->isActive = false;
        }


        $company->save();

        return redirect()->route('company', ['companyID' => $companyID]);

    }

    private function updateRegiment($oldRegiment, $newRegiment, $companyID)
    {
        $oldReg = Regiment::find($oldRegiment);
        $newReg = Regiment::find($newRegiment);

        $oldJson = json_decode($oldReg->companies, true);
        $newJson = json_decode($newReg->companies, true);

        $indexToRemove = -1;
        for($i = 0; $i < sizeof($oldJson['comp']); $i++){
            if($oldJson['comp'][$i] == $companyID){
                $indexToRemove = $i;
            }
        }
        if($indexToRemove > -1){
            unset($oldJson['comp'][$indexToRemove]);
            
            $oldReg->companies = $oldJson;
            $oldReg->save();
    
            $newJson['comp'][] = (int)$companyID;
            $newReg->companies = $newJson;
            $newReg->save();
    
            DB::table('users')->where('company_id', $companyID)->update(['regiment_id' => $newRegiment]);
        }


    }
}
