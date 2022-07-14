<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpgradeController extends Controller
{
    public function index(Request $request)
    {
        info(json_encode($request));
        dd($request);
    }
}
