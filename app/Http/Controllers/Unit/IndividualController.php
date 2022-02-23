<?php

namespace App\Http\Controllers\Unit;

use App\Models\User;
use App\Models\Regiment;
use App\Models\Company;
use App\Models\Rank;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndividualController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request, $member)
    {
        //$data = DB::table('users')->where('id', $member)->first();
        $data = User::findOrFail($member);

        if($data->isDischarged){
            $data->status = 'Discharged';
        } else if($data->isLOA) {
            $data->status = 'LOA';
        } else {
            $data->status = 'Active';
        }


        $regiment = Regiment::find($data->regiment_id);
        if($regiment === null) {
            $data->regiment_name = "Not Assigned a Regiment";
        } else {
            $data->regiment_name = $regiment->name;
        }

        $company = Company::find($data->company_id);
        if($company === null){
            $data->company_name = "Not Assigned a Company";
        } else {
            $data->company_name = $company->letter;
        }

        $rank = Rank::find($data->rank_id);
        if($rank === null){
            $data->rank = "Does not have a rank";
        } else {
            $data->rank = $rank->grade;
        }
        //use DateTime - can use date_diff... if needed...

        $today = Carbon::now()->format('Y-m-d');
        $joined = Carbon::createFromFormat('Y-m-d', $data->dateJoined);
        //$data->tis = date_diff($joined, $today);
        $data->tis = Carbon::parse($data->dateJoined)->longAbsoluteDiffForHumans();


        return view('unit.individual')->with('data', $data);
    }
}
