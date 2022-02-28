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

    public function edit($memberID)
    {
        $member = User::find($memberID);

        return view('editing.member')->with('data', $member);
    }

    public function update(Request $request, $memberID)
    {
        $member = User::find($memberID);

        if($request->has('name')){
            if($member->name != $request->name){
                $member->name = $request->name;
            }
        }
        if($request->has('permissions')){
            if($member->permissions != $request->permissions){
                $member->permissions = $request->permissions;
            }
        }


        if($request->has('email')){
            if($member->email != $request->email){
                $member->email = $request->email;
            }
        }
        if($request->has('password')){
            if($member->password != $request->password){
                $member->password = $request->password;
            }
        }

        if($request->has('discordName')){
            if($member->discordName != $request->discordName){
                $member->discordName = $request->discordName;
            }
        }
        if($request->has('companyToolName')){
            if($member->companyToolName != $request->companyToolName){
                $member->companyToolName = $request->companyToolName;
            }
        }

        if($request->has('dateJoined')){
            if($member->dateJoined != $request->dateJoined){
                $member->dateJoined = $request->dateJoined;
            }
        }
        if($request->has('dateDischarged')){
            if($member->dateDischarged != $request->dateDischarged){
                $member->dateDischarged = $request->dateDischarged;
            }
        }
        if($request->has('reasonForDischarge')){
            if($member->reasonForDischarge != $request->reasonForDischarge){
                $member->reasonForDischarge = $request->reasonForDischarge;
            }
        }
        if($request->has('isDischarged')){
            if($member->isDischarged != $request->isDischarged){
                $member->isDischarged = $request->isDischarged;
            }
        }

        if($request->has('isLOA')){
            if($member->isLOA != $request->isLOA){
                $member->isLOA = $request->isLOA;
            }
        }
        if($request->has('startLOA')){
            if($member->startLOA != $request->startLOA){
                $member->startLOA = $request->startLOA;
            }
        }
        if($request->has('endLOA')){
            if($member->endLOA != $request->endLOA){
                $member->endLOA = $request->endLOA;
            }
        }
        if($request->has('reasonForLOA')){
            if($member->reasonForLOA != $request->reasonForLOA){
                $member->reasonForLOA = $request->reasonForLOA;
            }
        }
        if($request->has('loaGranter')){
            if($member->loaGranter != $request->loaGranter){
                $member->loaGranter = $request->loaGranter;
            }
        }


        if($request->has('regiment_id')){
            if($member->regiment_id != $request->regiment_id){
                $member->regiment_id = $request->regiment_id;
            }
        }
        if($request->has('company_id')){
            if($member->company_id != $request->company_id){
                $member->company_id = $request->company_id;
            }
        }
        if($request->has('rank_id')){
            if($member->rank_id != $request->rank_id){
                $member->rank_id = $request->rank_id;
            }
        }

        if($request->has('recruiter_id')){
            if($member->recruiter_id != $request->recruiter_id){
                $member->recruiter_id = $request->recruiter_id;
            }
        }
        if($request->has('processor_id')){
            if($member->processor_id != $request->processor_id){
                $member->processor_id = $request->processor_id;
            }
        }

        $member->save();

        return redirect()->route('member', ['memberID' => $memberID]);
    }
}
