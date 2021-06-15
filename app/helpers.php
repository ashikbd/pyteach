<?php

use Illuminate\Support\Facades\Auth;

function get_module_progress($topic_id, $student_id=""){
    if(!$student_id){
        $student_id = Auth::id();
    }

    $topic = \App\Topic::find($topic_id);
    $total_learning_slides = $topic->learning->count();
    $total_practice_slides = $topic->practice->count();
    $total_quiz_slides = $topic->quiz->count();

    $total_slides = $total_learning_slides+$total_practice_slides+$total_quiz_slides;

    $progressed_learning_slides = 0;
    foreach ($topic->learning as $row){
        $progressed_learning_slides += \App\ProgressLearning::where('student_id',$student_id)->where('learning_id',$row->id)->count();
    }

    $progressed_practice_slides = 0;
    foreach ($topic->practice as $row){
        $progressed_practice_slides += \App\ProgressPractice::where('student_id',$student_id)->where('practice_id',$row->id)->count();
    }

    $progressed_quiz_slides = 0;
    foreach ($topic->quiz as $row){
        $progressed_quiz_slides += \App\ProgressQuiz::where('student_id',$student_id)->where('quiz_id',$row->id)->count();
    }

    $total_progress_slides = $progressed_learning_slides + $progressed_practice_slides + $progressed_quiz_slides;

    if($total_slides){
        $total_progress = ($total_progress_slides/$total_slides)*100;
    }else{
        return 0;
    }


    return number_format($total_progress,2);
}


function get_overall_progress($student_id=""){
    if(!$student_id){
        $student_id = Auth::id();
    }

    $topic = \App\Topic::where('status',1)->get();
    $overall_progress = 0;
    foreach($topic as $row){
        $overall_progress += get_module_progress($row->id,$student_id);
    }

    return number_format($overall_progress/$topic->count(),2);
}

function get_module_quiz_progressed_points($topic_id, $student_id=""){
    if(!$student_id){
        $student_id = Auth::id();
    }

    $topic = \App\Topic::find($topic_id);


    $progressed_quiz_point = 0;
    foreach ($topic->quiz as $row){
        $pqp = \App\ProgressQuiz::where('student_id',$student_id)->where('quiz_id',$row->id);
        if($pqp->count()){
            $progressed_quiz_point += $pqp->first()->point;
        }
    }


    return $progressed_quiz_point;
}

function get_module_quiz_total_points($topic_id){

    $topic = \App\Topic::find($topic_id);


    $total_quiz_point = $topic->quiz->sum('point');


    return $total_quiz_point;
}


function get_total_progressed_point($student_id=""){
    if(!$student_id){
        $student_id = Auth::id();
    }

    $topic = \App\Topic::where('status',1)->get();


    $progressed_quiz_point = 0;
    foreach ($topic as $row){
        $progressed_quiz_point += get_module_quiz_progressed_points($row->id,$student_id);
    }

    return round($progressed_quiz_point);
}

function get_total_point(){

    $topic = \App\Topic::where('status',1)->get();


    $total_quiz_point = 0;
    foreach ($topic as $row){
        $total_quiz_point += get_module_quiz_total_points($row->id);
    }

    return round($total_quiz_point);
}
