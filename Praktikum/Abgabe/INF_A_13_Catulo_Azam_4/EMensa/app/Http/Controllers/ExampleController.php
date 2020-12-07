<?php

namespace App\Http\Controllers;

use App\Models\Gerichts;
use App\Models\Kategories;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function m4_6a_queryparameter() {
        $name = \request('name');

        return view('examples.m4_6a_queryparameter', [ 'name' => $name]);
    }

    public function m4_6b_kategorie() {
        $kategorien = Kategories::orderBy('name','asc')->get();
        return view('examples.m4_6b_kategorie', ['kategorie' => $kategorien]);
    }

    public function m4_6c_gerichte() {
        $gerichte = Gerichts::select('name')->addSelect('preis_intern')->where('preis_intern', '>', '15')->orderBy('name', 'desc')
            ->get();

       // dump($gerichte->isEmpty());
        return view('examples.m4_6c_gerichte', ['gerichte' => $gerichte ]);
    }
}
