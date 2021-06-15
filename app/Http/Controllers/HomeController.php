<?php

namespace App\Http\Controllers;
use App\Student;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$data = array();
        return view('home',$data);
    }

    public function view_certificate($id){
        if($id){
            $data = array();
            $std = @Student::find($id);
            if($std){
                $data['student'] = $std;
                $data['certificate'] = $std->certificate;
                return view('certificate', $data);
            }else{
                echo "Sorry, certificate doesn't exist!";
            }

        }
    }

}
