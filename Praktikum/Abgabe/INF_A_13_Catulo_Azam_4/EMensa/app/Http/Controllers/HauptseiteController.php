<?php

namespace App\Http\Controllers;

use App\Models\Allergens;
use App\Models\Gerichts;
use App\Models\Gerichts_hat_allergens;
use Illuminate\Http\Request;

class HauptseiteController extends Controller
{
    public function show() {
        $gerichts =  Gerichts::limit(5)->get();
        $allergenscode_gesamt = "";
        // Put allergens in the gericht's array
        foreach ($gerichts as $gericht) {
            $allergens = Gerichts_hat_allergens::groupBy('gericht_id')->select('gericht_id')->selectRaw("GROUP_CONCAT(code) as code")->where('gericht_id' , '=', $gericht->id)->get();
            foreach ($allergens as $allergen) {
                $allergens_code = $allergen->code;
                $allergenscode_gesamt = $allergenscode_gesamt.','.$allergens_code;
                $gericht['allergens'] = $allergens_code;
            }
        }
        $allergens_code_name = array();
        $allergenscode_gesamt = explode(',',$allergenscode_gesamt);
        foreach ($allergenscode_gesamt as $code) {
            $allergens =  Allergens::where('code', '=' , $code)->get();
            foreach ($allergens as $allergen) {
                $allergens_code_name[$code] = $allergen->name;
            }
        }
        //dump($allergens_code_name);

        return view('hauptseite', [
            'gerichts' => $gerichts,
            'allergens_code' => $allergens_code_name
        ]);
    }
}
