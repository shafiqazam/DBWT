<?php
require_once('../models/kategorie.php');

class ExampleController
{
    public function m4_6a_queryparameter(RequestData $rd) {
        var_dump($rd);
        return view('m4_6a_queryparameter', ['name' => $rd['name']] );
    }
}