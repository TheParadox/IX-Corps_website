<?php

namespace App\Http\Controllers\Processing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Regiment;

class RegimentFormController extends Controller
{
    public function index()
    {
        return view('processing.regiment');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'max:255'],
            'abrv' => ['required', 'max:255'],
            'type' => ['required', 'max:255'],
            'descriptor' => ['required', 'max:255'],
            'createdBy' => ['required', 'integer'],
        ]);

        $newRegiment = Regiment::create([
            'name' => $request->name,
            'abrv' => $request->abrv,
            'type' => $request->type,
            'descriptor' => $request->descriptor,
            'co_id' => 0,
            'xo_id' => 0,
            'sgtMaj_id' => 0,
            'advisors' => "{\"adv\":[]}",
            'companies' => "{\"comp\":[]}",
            'regimentalColors' => null,
            'createdBy' => $request->createdBy,
        ]);

        return redirect()->route('regiment', ['regimentID' => $newRegiment->id]);
    }

    public function edit(Request $request, $regimentID)
    {
        $regiment = Regiment::find($regimentID);

        return view('editing.regiment')->with('data', $regiment);
    }

    public function update(Request $request, $regimentID)
    {
        $this->validate($request, [
            'name' => ['required', 'max:255'],
            'abrv' => ['required', 'max:255'],
            'type' => ['required', 'max:255'],
            'descriptor' => ['required', 'max:255'],
        ]);

        $regiment = Regiment::find($regimentID);

        $regiment->name = $request->name;
        $regiment->abrv = $request->abrv;
        $regiment->type = $request->type;
        $regiment->descriptor = $request->descriptor;

        $regiment->save();

        return redirect()->route('regiment', ['regimentID' => $regimentID]);
    }
}
