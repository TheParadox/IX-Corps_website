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
            'email' => null,
            'password' => 'NotYetSet',
    
            'discordName' => $request->discordName,
            'companyToolName' => $request->companyToolName,
            'dateJoined' => $request->joinDate,
            'dateDischarged' => null,
            'reasonForDischarge' => '',
            'isDischarged' => 0,
    
            'isLOA' => 0,
            'startLOA' => null,
            'endLOA' => null,
            'reasonForLOA' => '',
            'loaGranter' => 0,
    
            'regiment_id' => $regID,
            'company_id' => $compID,
            'rank_id' => 1,
    
            'numberDrillsAttended' => 0,
            'numberOfEventsAttended' => 0,
            'lastDrill' => null,
            'lastEvent' => null,
    
            'recruiter_id' => $recID,
            'processor_id' => $procID,
        ]);

        $newUser->save();


        $troops = json_decode($company->troops, true);
        $troops['troops'][] = $newUser->id;
        $company->troops = $troops;
        $company->save();


        /*$newUser = User::create();
        $newUser->name = $request->name;
        $newUser->password = Hash::make($request->password);
        $newUser->adminApproved = false;
        $newUser->approvalAdmin = 0;
        $newUser->adminLevel = 0;*/
        //save the child to the parent...
        //$newUser->userProfile()->save($profile);
        //$newUser->save();

        return redirect()->route('member', ['member' => $newUser->id]);
    }

    public function edit(Request $request, $member)
    {


        return view('');
    }

    public function update(Request $request, $member)
    {

        return redirect()->route('member', ['member' => $member]);
    }
}
