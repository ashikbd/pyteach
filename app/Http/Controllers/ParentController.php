<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Invitation;
use App\Parents;
use App\Student;
use App\StudentParent;
use App\Topic;
use Auth;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:parents');
    }

    public function dashboard(){
        $data = array();
        return view('parent_dashboard', $data);
    }

    public function certificate(){
        $data = array();
        $data['certificate'] = Student::find(Auth::id())->certificate;
        return view('certificate_list', $data);
    }

    public function linked_students(){
        $data = array();
        $data['invitation'] = Invitation::where('email',Parents::find(Auth::id())->email)->where('status',0)->get();
        $data['students'] = StudentParent::where('parent_id',Auth::id())->get();
        return view('linked_students', $data);
    }

    public function approve_invitation($id){
        if($id){
            $inv = Invitation::find($id);
            $inv->status = 1;
            $inv->save();

            $std = new StudentParent();
            $std->student_id = $inv->student_id;
            $std->parent_id = Auth::id();
            $std->save();

            return redirect('parents/linked_students')->with('success_message', 'Student account is now linked!');
        }
    }

    public function deny_invitation($id){
        if($id){
            $inv = Invitation::find($id);
            $inv->status = 2;
            $inv->save();

            return redirect('parents/linked_students')->with('success', 'Invitation is denied!');
        }
    }

    public function unlink_student($student_id){
        if($student_id){
            $std = StudentParent::where('student_id',$student_id)->delete();
            return redirect('parents/linked_students')->with('success', 'Student account is unlinked!');
        }
    }

    public function student_certificate($student_id){
        $data = array();
        $data['certificate'] = Student::find($student_id)->certificate;
        return view('certificate_list', $data);
    }

    public function student_statistics($student_id){
        $data['student_id'] = $student_id;
        $data['topics'] = Topic::where('status',1)->get();
        $data['overall_progress'] = get_overall_progress($student_id);
        $data['achieved_points'] = get_total_progressed_point($student_id);
        $data['total_points'] = get_total_point();
        return view('statistics', $data);
    }
}
