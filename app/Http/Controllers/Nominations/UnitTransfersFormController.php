<?php

namespace App\Http\Controllers\Nominations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Regiment;
use App\Models\Company;
use App\Models\UnitTransfer;

class UnitTransfersFormController extends Controller
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

        return view('nominations.requestTransfer')->with('data', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nominee' => ['required', 'max:255'],
            'unit' => ['required', 'integer'],
            'reason' => ['required'],
        ]);
        
        $nominee = User::where('name', $request->nominee)->first();
        if($nominee === null){
            return redirect()->back()->withInput()->withErrors(['nominee' => 'User doesn\'t exist!']);
        }

        $oldComp = Company::find($nominee->company_id);
        if($oldComp == null){
            $oldComp->id = 0;
            $CO = 0;
        } else {
            $CO = $oldComp->co_id;
        }

        $oldReg = Regiment::find($nominee->regiment_id);
        if($oldReg == null){
            $oldReg->id = 0;
        }

        $newComp = Company::find($request->unit);
        if($newComp == null){
            return redirect()->back()->withInput()->withErrors(['unitError' => 'Either the company doesn\'t exist or was entered improperly!']);
        }

        $newReg = Regiment::find($newComp->regiment_id);
        if($newReg == null){
            return redirect()->back()->withInput()->withErrors(['unitError' => 'Either the regiment doesn\'t exist or was entered improperly!']);
        }

        $transfer = UnitTransfer::create([
            'transferee' => $nominee->id,

            'currentCompany' => $oldComp->id,
            'currentRegiment' => $oldReg->id,
            'currentCO' => $CO,
            'currentApproval' => 0,
            'currentReason' => null,
    
            'nextCompany' => $newComp->id,
            'nextRegiment' => $newReg->id,
            'nextCO' => $newComp->co_id,
            'nextApproval' => 0,
            'nextReason' => null,
    
            'requester' => auth()->user()->id,
            'reason' => $request->reason,
        ]);

        $transfer->save();

    }

    public function edit(Request $request, $nominationID)
    {
        
    }

    public function update(Request $request, $nominationID)
    {
        
    }

}
