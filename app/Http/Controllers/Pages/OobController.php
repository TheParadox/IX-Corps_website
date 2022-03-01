<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Regiment;
use App\Models\Company;


class OobController extends Controller
{
    public function index()
    {

        $regiments = Regiment::all()->toArray();

        $companies = Company::all()->toArray();

        $oob = array();
        $r = 0;
        foreach($regiments as $reg){
            if($reg !== null){
                $oob[$r]['id'] = $reg['id'];
                $oob[$r]['name'] = $reg['name'];
                $oob[$r]['colors'] = $reg['regimentalColors'];
                $oob[$r]['type'] = $reg['type'];
                $oob[$r]['descriptor'] = $reg['descriptor'];
                $oob[$r]['strength'] = 0;
                $oob[$r]['companies'] = array();

                $c = 0;
                foreach($companies as $comp){
                    if(($comp['regiment_id'] == $reg['id']) ){
                        $oob[$r]['companies'][$c]['id'] = $comp['id'];
                        $oob[$r]['companies'][$c]['name'] = $comp['letter'];
                        $oob[$r]['companies'][$c]['strength'] = (
                            count(json_decode($comp['sgts'], true)['sgts']) + 
                            count(json_decode($comp['cpls'], true)['cpls']) + 
                            count(json_decode($comp['troops'], true)['troops'])
                        );
                        $oob[$r]['strength'] += $oob[$r]['companies'][$c]['strength'];
                        $oob[$r]['companies'][$c]['active'] = $comp['isActive'];
                        $c++;
                    }
                }
                $r++;
            }
        }


        return view('pages.oob')->with('oob', $oob);
    }
}
