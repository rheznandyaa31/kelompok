<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController
{
    public function index(Request $request){
        return view("activity.index");
    }
}
