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

        return view('processing.rank')->with('perms', $perms);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'max:255'],
            'abrv' => ['required', 'max:25'],
            'level' => ['required', 'integer'],
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
        $data = Rank::find($rankID);
        $perms = Permission::all()->toArray();

        return view('editing.rank')->with('data', $data)->with('perms', $perms);
    }

    public function update(Request $request, $rankID)
    {
        
        $this->validate($request, [
            'title' => ['required', 'max:255'],
            'abrv' => ['required', 'max:25'],
            'level' => ['required', 'integer'],
        ]);

        $rank = Rank::find($rankID);

        $rank->grade = $request->title;
        $rank->abrv = $request->abrv;
        $rank->level = $request->level;

        $rank->save();

        return redirect()->route('specificRank', ['rankID' => $rankID]);
    }
}
