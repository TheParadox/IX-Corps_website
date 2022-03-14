<?php

namespace App\Http\Controllers\Nominations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Rank;
use App\Models\Permission;
use App\Models\NominateRank;

class NominateRanksFormController extends Controller
{
    public function index()
    {
        $ranks = Rank::all()->toArray();

        return view('nominations.nominateRank')->with('data', $ranks);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nominee' => ['required', 'max:255'],
            'rank' => ['required'],
            'reason' => ['required'],
        ]);

        $nominee = User::where('name', $request->nominee)->first();
        if($nominee === null){
            return redirect()->back()->withInput()->withErrors(['nominee' => 'User doesn\'t exist!']);
        }

        $nominator = User::find(auth()->user()->id);

        NominateRank::create([

            'nominee' => $nominee->id,

            'regimentID' => $nominee->regiment_id,
            'companyID' => $nominee->company_id,
    
            'rankID' => $request->rank,
            'approved' => 0,
            'approvedBy' => 0,
            'coReason' => null,
    
            'nominator' => auth()->user()->id,
            'reason'=> $request->reason,
            'requiredApprovalPermission' => 4,
        ]);

        return redirect()->route('ranksNominationsList');
    }

    public function edit(Request $request, $nominationID)
    {
        
    }

    public function update(Request $request, $nominationID)
    {
        $nomination = NominateRank::find($nominationID);

        //from approval
        if($request->has('approved')) {
            if($nomination->approved !== $request->approved){
                $nomination->approved = $request->approved;

                if($nomination->approved == 1){

                    $user = User::find($nomination->nominee);

                    $user->rank_id = $nomination->rankID;
                    $rank = Rank::find($nomination->rankID);

                    $permission = Permission::find($rank->level);
                    $user->permissions = $permission->level;

                    $user->save();
                }
            }
        }
        if($request->has('approvedReason')) {
            if($nomination->approvedReason !== $request->approvedReason){
                $nomination->approvedReason = $request->approvedReason;
            }
        }
        if($request->has('approvedBy')) {
            if($nomination->approvedBy !== $request->approvedBy){
                $nomination->approvedBy = $request->approvedBy;
            }
        }

    

        $nomination->save();
    }

}
