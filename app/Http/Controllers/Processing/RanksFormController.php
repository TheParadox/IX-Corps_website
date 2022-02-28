<?php

namespace App\Http\Controllers\Processing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Rank;
use App\Models\Permission;

class RanksFormController extends Controller
{
    public function index()
    {
        $perms = Permission::all()->toArray();
        $userPerm = Permission::find(auth()->user()->permissions);

        return view('processing.rank')->with('perms', $perms)->with('userPerm', $userPerm);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'max:255'],
            'abrv' => ['required', 'max:25'],
            'level' => ['required', 'integer'],
            'createdBy' => ['required', 'integer'],
        ]);

        $rank = Rank::create([
            'grade' => $request->title,
            'abrv' => $request->abrv,
            'level' => $request->level,
        ]);

        return redirect()->route('specificRank', ['rankID' => $rank->id]);
    }

    public function edit(Request $request, $rankID)
    {
        
    }

    public function update(Request $request, $rankID)
    {
        
    }
}
