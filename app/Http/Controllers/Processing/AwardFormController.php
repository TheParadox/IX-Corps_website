<?php

namespace App\Http\Controllers\Processing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Award;
use App\Models\Regiment;
use App\Models\Company;

class AwardFormController extends Controller
{
    public function index()
    {
        $data = array();

        $regiment = Regiment::all()->toArray();
        $company = Company::all()->toArray();

        $id = 0;
        foreach($regiment as $reg){
            $data[$id]['id'] = $reg['id'] . '-0';
            $data[$id++]['name'] = $reg['abrv'] . ' Regimental';

            foreach($company as $comp){
                if(($comp['regiment_id'] == $reg['id']) && ($comp['isActive'])){
                    $data[$id]['id'] = $reg['id'] . '-' . $comp['id'];
                    $data[$id++]['name'] = $reg['abrv'] . ' - ' . $comp['letter'];
                }
            }
        }

        return view('processing.award')->with('data', $data);
    }

    public function store(Request $request)
    {
        
        $this->validate($request, [
            'title' => ['required', 'max:255'],
            'unit' => ['required', 'max:15'],
        ]);

        $units = explode('-', $request->unit);

        $award = Award::create([
            'title' => $request->title,
            'regiment_id' => $units[0],
            'company_id' => $units[1],
            'awardCriteria' => $request->criteria,
        ]);

        return redirect()->route('specificAward', ['award', $award->id]);
    }

    public function edit(Request $request, $awardID)
    {
        $data = array();

        $award = Award::find($awardID);

        $regiment = Regiment::all()->toArray();
        $company = Company::all()->toArray();

        $id = 0;
        foreach($regiment as $reg){
            $data[$id]['id'] = $reg['id'] . '-0';

            if(($reg['id'] == $award->regiment_id) && ($award->company_id == 0) ){
                $data[$id]['selected'] = 'selected';
            } else {
                $data[$id]['selected'] = '';
            }

            $data[$id++]['name'] = $reg['abrv'] . ' Regimental';

            foreach($company as $comp){
                if(($comp['regiment_id'] == $reg['id']) && ($comp['isActive'])){
                    $data[$id]['id'] = $reg['id'] . '-' . $comp['id'];

                    if($award->company_id == $comp['id']){
                        $data[$id]['selected'] = 'selected';
                    } else {
                        $data[$id]['selected'] = '';
                    }

                    $data[$id++]['name'] = $reg['abrv'] . ' - ' . $comp['letter'];
                }
            }
        }

        return view('editing.award')->with('award', $award)->with('data', $data);
    }

    public function update(Request $request, $awardID)
    {
        
        $this->validate($request, [
            'title' => ['required', 'max:255'],
            'unit' => ['required', 'max:15'],
            'criteria' => ['required'],
        ]);

        $units = explode('-', $request->unit);

        $award = Award::find($awardID);

        $award->title = $request->title;
        $award->regiment_id = $units[0];
        $award->company_id = $units[1];
        $award->awardCriteria = $request->criteria;

        $award->save();

        return redirect()->route('specificAward', ['awardID'=> $awardID]);
    }
}
