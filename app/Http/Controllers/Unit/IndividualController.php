<?php

namespace App\Http\Controllers\Unit;

use App\Models\User;
use App\Models\Regiment;
use App\Models\Company;
use App\Models\Rank;
use App\Models\Permission;
use App\Models\Award;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndividualController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request, $memberID)
    {
        //$data = DB::table('users')->where('id', $member)->first();
        
        /*
        The function handles verifying that all models used are valid. 
        If there are no valid models (i.e., the refered object does not exist), it will set a default value.
        If there is any values we wish to output, we try to set as much of it here.
        That way there is only the absolutly required control and flow statements within the view.
        
        Examples of a required control statement in the view are:
        If the user doesn't have a rank - then maybe we don't want to display the label as there is nothing there
        Or lists, we need to use foreach loops to go through the array as we have no idea how many items might in it.
        -- Of course we could 'set-it' with pagenation, but don't hard code it.
        */
        
        
        $data = User::findOrFail($memberID);

        $perm = Permission::where('level', auth()->user()->permissions)->first();

        //Both isDischarged and isLOA are booleans, convert the meaning to 'english'
        if($data->isDischarged){
            $data->status = 'Discharged';
        } else if($data->isLOA) {
            $data->status = 'LOA';
        } else {
            $data->status = 'Active';
        }

        //Someplace where we still want to show the label as well as output a specific value.
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
        
        //use DateTime - can use date_diff... if needed... For using regular PHP...
        //This is the current method used to determine the 'time since' - i.e., how long has the person been with the group.
        $today = Carbon::now()->format('Y-m-d');
        $joined = Carbon::createFromFormat('Y-m-d', $data->dateJoined);
        //$data->tis = date_diff($joined, $today);
        $data->tis = Carbon::parse($data->dateJoined)->longAbsoluteDiffForHumans();

        //There is going to be alot of awards... There is probably a more efficient/effective way to do it.
        //Potential candidate for optimization.
        $awardsList = Award::all()->toArray();

        $earnedAwards = json_decode($data->awards, true);

        $awards = array();
        $awardIndex = 0;
        foreach($earnedAwards['awards'] as $ea){
            $awards[$awardIndex]['id'] = $ea[0];
            $awards[$awardIndex]['name'] = $awardsList[$ea[0] - 1]['title'];
            $awards[$awardIndex]['nomination'] = $ea[1];
            $awards[$awardIndex]['awarded'] = "1/1/2020"; //get from nomination...
            $awardIndex++;
        }
        return view('unit.individual')->with('data', $data)->with('perm', $perm)->with('awards', $awards);
    }
}
