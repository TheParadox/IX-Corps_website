<?php

namespace App\Http\Controllers\Nominations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Award;
use App\Models\User;
use App\Models\NominateAward;

class NominateAwardsFormController extends Controller
{
    public function index()
    {
        $awards = Award::all()->toArray();

        return view('nominations.nominateAward')->with('data', $awards);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nominee' => ['required', 'max:255'],
            'award' => ['required'],
            'reason' => ['required'],
        ]);

        $nominee = User::where('name', $request->nominee)->first();
        if($nominee === null){
            return redirect()->back()->withInput()->withErrors(['nominee' => 'User doesn\'t exist!']);
        }

        $nominator = User::find(auth()->user()->id);

        NominateAward::create([
            'regiment' => $nominee->regiment_id,
            'company' => $nominee->company_id,
            'nominee' => $nominee->id,
            'award' => $request->award,
            'reason' => $request->reason,
            'approved' => 0,
            'approvedBy' => 0,
            'approvedReason' => null,
            'nominator' => auth()->user()->id,
            'requiredApprovalPermission' => 4,
        ]);

        return redirect()->route('awardNominationsList');

    }

    public function edit(Request $request, $nominationID)
    {
        
    }

    public function update(Request $request, $nominationID)
    {
        
    }
}
