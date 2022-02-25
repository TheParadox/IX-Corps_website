<?php

namespace App\Http\Controllers\Processing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Regiment;
use App\Models\Company;

class MemberFormController extends Controller
{
    public function index()
    {
        
        $regiments = Regiment::all()->toArray();

        $companies = Company::all()->toArray();

        $data = array();
        $r = 0;
        foreach($regiments as $reg){
            if($reg !== null){
                $data[$r]['id'] = $reg['id'];
                $data[$r]['name'] = $reg['name'];
                $data[$r]['abrv'] = $reg['abrv'];
                $data[$r]['companies'] = array();

                $c = 0;
                foreach($companies as $comp){
                    if(($comp['regiment_id'] == $reg['id']) && ($comp['isActive'])){
                        $data[$r]['companies'][$c]['id'] = $comp['id'];
                        $data[$r]['companies'][$c]['name'] = $comp['letter'];
                        $c++;
                    }
                }
                $r++;
            }
        }

        return view('processing.member')->with('data', $data);
    }

    public function store(Request $request)
    {
        //dd($request);

        $this->validate($request, [
            'name' => ['required', 'max:255'],
            'discordName' => ['required', 'max:255'],
            'companyToolName' => ['required', 'max:255'],
            'joinDate' => ['required', 'date'],
            'unit' => ['required', 'integer'],
        ]);
        //, 'date_format:Y-n-j'

        $recruiter = User::find($request->recruiter);
        //$recruiter = User::where('name', $request->recruiter)->first();
        if($recruiter === null){
            $recID = 0;
        } else {
            $recID = $recruiter->id;
        }

        $processor = User::find($request->processor);
        //$processor = User::where('name', $request->processor)->first();
        if($processor === null){
            $procID = 0;
        } else {
            $procID = $processor->id;
        }

        $company = Company::find($request->unit);
        if($company === null){
            $compID = 0;
        } else {
            $compID = $company->id;
        }

        $regiment = Regiment::find($company->regiment_id);
        if($regiment === null){
            $regID = 0;
        } else {
            $regID = $regiment->id;
        }

        $newUser = User::create([
            'name' => $request->name,
    
            'discordName' => $request->discordName,
            'companyToolName' => $request->companyToolName,
            'dateJoined' => $request->joinDate,
    
            'regiment_id' => $regID,
            'company_id' => $compID,
    
            'recruiter_id' => $recID,
            'processor_id' => $procID,
        ]);

        $newUser->save();


        $troops = json_decode($company->troops, true);
        $troops['troops'][] = $newUser->id;
        $company->troops = $troops;
        $company->save();

        return redirect()->route('member', ['memberID' => $newUser->id]);
    }

    public function edit(Request $request, $memberID)
    {
        $member = User::find($memberID);

        return view('editing.member')->with('data', $member);
    }

    public function update(Request $request, $memberID)
    {

        return redirect()->route('member', ['memberID' => $member]);
    }
}
