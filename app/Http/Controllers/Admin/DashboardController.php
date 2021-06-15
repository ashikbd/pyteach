<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Students;
use App\Parents;
use App\Student;
use App\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
      $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = [];

	  //return Auth::user()->id;
      $data['total_topics'] = Topic::count();
        $data['total_students'] = Student::count();
        $data['total_parents'] = Parents::count();
      return view('admin/dashboard', $data);

    }


    public function user_home(){
        $data = array();

      return view('dashboard/user_home');
    }

}
