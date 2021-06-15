<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Invitation;
use App\Student;
use App\StudentParent;
use App\Topic;
use Auth;
use Illuminate\Http\Request;

class Students extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:students');
    }

    public function dashboard(){
        $data = array();
        $data['overall_progress'] = get_overall_progress();
        $data['achieved_points'] = get_total_progressed_point();
        $data['total_points'] = get_total_point();
        return view('student_dashboard', $data);
    }

    public function certificate(){
        $data = array();
        $data['certificate'] = Student::find(Auth::id())->certificate;
        return view('certificate_list', $data);
    }

    public function linked_parents(){
        $data = array();
        $data['invitation'] = Invitation::where('student_id',Auth::id())->where('status',0)->get();
        $data['parents'] = StudentParent::where('student_id',Auth::id())->get();
        return view('linked_parents', $data);
    }

    public function statistics(){
        $data['student_id'] = Auth::id();
        $data['topics'] = Topic::where('status',1)->get();
        $data['overall_progress'] = get_overall_progress();
        $data['achieved_points'] = get_total_progressed_point();
        $data['total_points'] = get_total_point();
        return view('statistics', $data);
    }
}
