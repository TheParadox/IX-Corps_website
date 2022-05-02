<?php

namespace App\Http\Controllers\Nominations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NominatePositionsFormController extends Controller
{
    public function index($posID, $unitType, $unitID)
    {
        switch($posID){
            case 0:
                $position = "Enlisted";
                break;
            case 1:
                $position = "Corporal";
                break;
            case 2:
                $position = "Color Corporal";
                break;
            case 3:
                $position = "Sergeant";
                break;
            case 4:
                $position = "Color Sergeant";
                break;
            case 5:
                $position = "1st Sergeat";
                break;
            case 6:
                $position = "Sergeant Major";
                break;
            case 7:
                $position = "Company Commander";
                break;
            case 8:
                $position = "Regimental Executive Officer";
                break;
            case 9:
                $position = "Regimental Commander";
                break;
            default:
                $position = "Error";
                break;
        }

        return view('nominations.nominatePosition')->with('position', $position);
    }

    public function store(Request $request)
    {
        
    }

    public function edit(Request $request, $nominationID)
    {
        
    }

    public function update(Request $request, $nominationID)
    {
        
    }

}
