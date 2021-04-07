<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Students extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:students');
    }

    public function dashboard(){
        $data = array();
        return view('student_dashboard', $data);
    }
}
