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
    public function index()
    {
        switch(auth()->user()->permissions) {
            case 0:
                return redirect()->route('home');
            case 1:
            case 2:
            case 3:
                $search = ['currentCompany', '=', auth()->user()->company_id];
                $orSearch = ['nextCompany', '=', auth()->user()->company_id];
                break;
            case 4:
                $search = ['currentRegiment', '=', auth()->user()->regiment_id];
                $orSearch = ['nextRegiment', '=', auth()->user()->regiment_id];
                break;
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
                $search = [['currentRegiment', '=', 0], ['currentCompany', '=', 0]];
                $orSearch = [['nextRegiment', '=', 0], ['nextCompany', '=', 0]];
                break;
            case 10:
                $search = [];
                break;
        }

        $transfers = UnitTransfer::where($search, ['approved', '=', 0])->orWhere($orSearch, ['approved', '=', 0])->get();
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
            $data[$r]['currentRegimentName'] = $currentRegiment['abvr'];
            $data[$r]['currentCompanyID'] =  $currentCompany['id'];
            $data[$r]['currentCompanyName'] = $currentCompany['letter'];

            $data[$r]['nextRegimentID'] =  $nextRegiment['id'];
            $data[$r]['nextRegimentName'] = $nextRegiment['abvr'];
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
        
    }

    public function reviewed(Request $request, $transferID)
    {
        
    }
}
