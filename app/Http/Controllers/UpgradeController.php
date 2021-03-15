<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upgrade;

class UpgradeController extends Controller
{
    //
    public function show()
    {
        $upgrade = Upgrade::all(["id","dollar","idr"])->sort(function ($a,$b)
        {
           return (int)$a->dollar > (int)$b->dollar ? 1: -1;
        });
        return view("setting.upgrade", ["upgrade" => $upgrade]);
    }

    public function create(Request $request)
    {
        $request->validate([
            "value" => "required|integer"
        ]);
        $upgrade = Upgrade::first();
        $newUpgrade = new Upgrade([
            "dollar" => $request->value,
            "idr" => $request->dollar,
        ]);
        $newUpgrade->save();
        return redirect()->back();
    }

    
}
