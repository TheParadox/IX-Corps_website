<?php

namespace App\Http\Controllers\Nominations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\UnitTransfer;
use App\Models\User;
use App\Models\Rank;
use App\Models\Company;
use App\Models\Regiment;


class UnitTransfersController extends Controller
{
    public function index($regiment, $approved)
    {
        switch(auth()->user()->permissions) {
            case 0:
                return redirect()->route('home');
            case 1:
            case 2:
            case 3:
            case 4:
                if($regiment == auth()->user()->company_id) {
                    $search = ['currentCompany', '=', auth()->user()->company_id];
                } else {
                    $search = ['nextCompany', '=', auth()->user()->company_id];
                }
                //break;
                //$search = ['currentRegiment', '=', auth()->user()->regiment_id];
                //$search = ['nextRegiment', '=', auth()->user()->regiment_id];
                break;
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
                $search = [['currentRegiment', '=', 0], ['currentCompany', '=', 0]];
                $search = [['nextRegiment', '=', 0], ['nextCompany', '=', 0]];
                break;
            case 10:
                $search = [];
                break;
        }

        $transfers = UnitTransfer::where($search, ['approved', '=', $approved])->get();
        $ranks = Rank::all()->toArray();

        $data = array();
        $r = 0;

        foreach($transfers as $t){
            $transferee = User::find($t['transferee']);
            $requestor = User::find($t['requester']);

            $currentRegiment = Regiment::find($t['currentRegiment']);
            $currentCompany = Company::find($t['currentCompany']);

            $nextRegiment = Regiment::find($t['nextRegiment']);
            $nextCompany = Company::find($t['nextCompany']);


            $data[$r]['requestID'] = $t['id'];
            $data[$r]['userID'] = $transferee['id'];
            $data[$r]['username'] = $ranks[ $transferee['rank_id'] - 1]['abrv'] . ' ' . $transferee['name'];

            $data[$r]['currentRegimentID'] =  $currentRegiment['id'];
            $data[$r]['currentRegimentName'] = $currentRegiment['abrv'];
            $data[$r]['currentCompanyID'] =  $currentCompany['id'];
            $data[$r]['currentCompanyName'] = $currentCompany['letter'];

            $data[$r]['nextRegimentID'] =  $nextRegiment['id'];
            $data[$r]['nextRegimentName'] = $nextRegiment['abrv'];
            $data[$r]['nextCompanyID'] =  $nextCompany['id'];
            $data[$r]['nextCompanyName'] = $nextCompany['letter'];

            $data[$r]['requesterID'] = $requestor['id'];
            $data[$r]['requesterName'] = $ranks[ $requestor['rank_id'] - 1 ]['abrv'] . ' ' . $requestor['name'];
            $r++;
        }

        return view('nominations.transferList')->with('data', $data);
        
    }

    public function specific(Request $request, $transferID)
    {
        $data = UnitTransfer::find($transferID);
        $ranks = Rank::all()->toArray();

        $nominee = User::find($data['transferee']);
        $nominator = User::find($data['requester']);

        $currentCompany = Company::find($data['currentCompany']);
        $currentRegiment = Regiment::find($data['currentRegiment']);
        $currentSigner = User::find($data['currentCO']);


        $nextCompany = Company::find($data['nextCompany']);
        $nextRegiment = Regiment::find($data['nextRegiment']);
        $nextSigner = User::find($data['nextCO']);
        

        $extra = array();
        $extra['approved'] = 0;
        $extra['approvedReason'] = "";

        $extra['nomineeName'] = $ranks[ $nominee['rank_id'] - 1 ]['abrv'] . ' ' . $nominee['name'];
        $extra['nominatorName'] = $ranks[ $nominator['rank_id'] - 1 ]['abrv'] . ' ' . $nominator['name'];
        if($currentSigner === null){
            $extra['currentSigner'] =  null;
        } else {
            $extra['currentSigner'] = $ranks[ $currentSigner['rank_id'] - 1 ]['abrv'] . ' ' . $currentSigner['name'];
            
            if(auth()->user()->id == $currentSigner['id']){
                $extra['approved'] = $data['currentApproval'];
                $extra['approvedReason'] = $data['currentReason'];
            }
        }
        if($nextSigner === null){
            $extra['nextSigner'] =  null;
        } else {
            $extra['nextSigner'] = $ranks[ $nextSigner['rank_id'] - 1 ]['abrv'] . ' ' . $nextSigner['name'];

            if(auth()->user()->id == $nextSigner['id']){
                $extra['approved'] = $data['nextApproval'];
                $extra['approvedReason'] = $data['nextReason'];
            }
        }


        if($currentCompany === null){
            $extra['currentCompany'] =  null;
        } else {
            $extra['currentCompany'] = $currentCompany['letter'];
        }
        if($currentRegiment === null){
            $extra['currentRegiment'] =  null;
        } else {
            $extra['currentRegiment'] = $currentRegiment['abrv'];
        }

        if($nextCompany === null){
            $extra['nextCompany'] =  null;
        } else {
            $extra['nextCompany'] = $nextCompany['letter'];
        }
        if($nextRegiment === null){
            $extra['nextRegiment'] =  null;
        } else {
            $extra['nextRegiment'] = $nextRegiment['abrv'];
        }

        return view('nominations.transferSpecific')->with('data', $data)->with('extra', $extra);
    }

    public function reviewed(Request $request, $transferID)
    {
        
    }
}
