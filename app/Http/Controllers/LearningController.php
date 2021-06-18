<?php

namespace App\Http\Controllers;

use App\Learning;
use App\ProgressLearning;
use App\ProgressPractice;
use App\ProgressQuiz;
use App\Quiz;
use App\QuizAnswer;
use App\Topic;
use Auth;
use Illuminate\Http\Request;

class LearningController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:students');
    }

    public function topics(){
        $data['topics'] = Topic::where('status',1)->get();
        return view('topics', $data);
    }

    public function topic_detail($id){
        $topic = Topic::find($id);
        $data['topic'] = $topic;
        $data['active_section'] = "";
        if($topic->learning->count()){
            $data['active_section'] = "learning";
        }else if($topic->practice->count()){
            $data['active_section'] = "practice";
        }else if($topic->quiz->count()){
            $data['active_section'] = "quiz";
        }

        if(isset($_GET['section']) && $_GET['section']=='quiz'){
            $data['active_section'] = "quiz";
        }

        $pa = ProgressQuiz::where('student_id',Auth::id())->get();
        $answers = array();
        foreach($pa as $ans){
            $answers[$ans->quiz_id] = $ans;
        }

        $data['answers'] = $answers;
        $pll = ProgressLearning::where('student_id',Auth::id())->latest();
        if($pll->count()){
            $data['learning_last_page'] = $pll->first()->learning_id;
        }else{
            $data['learning_last_page'] = null;
        }

        $ppl = ProgressPractice::where('student_id',Auth::id())->latest();
        if($ppl->count()){
            $data['practice_last_page'] = $ppl->first()->practice_id;
        }else{
            $data['practice_last_page'] = null;
        }

        $pql = ProgressQuiz::where('student_id',Auth::id())->latest();
        if($pql->count()){
            $data['quiz_last_page'] = $pql->first()->quiz_id;
        }else{
            $data['quiz_last_page'] = null;
        }
        return view('topic_detail', $data);
    }

    public function submit_quiz(Request $request){
        foreach ($request->options as $id=>$ans){
            $quiz = Quiz::find($id);
            $answer = $quiz->quiz_answer->pluck('answer');
            $total_answer = count($answer);
            $correct_answer = 0;

            foreach($answer as $row){
                if(is_array($ans)){
                    if(in_array($row,$ans)){
                        $correct_answer++;
                    }
                }else{
                    if($ans == $row){
                        $correct_answer++;
                    }
                }
            }

            $quiz_point = $quiz->point;
            $your_point = $quiz->point * ($correct_answer/$total_answer);

            if(is_array($ans)){
                $ans_json = json_encode($ans);
            }else{
                if(!$ans) continue;
                $ans_json = json_encode(array($ans));
            }

            ProgressQuiz::where('student_id',Auth::id())->where('quiz_id',$id)->delete();

            $progress_quiz = new ProgressQuiz();
            $progress_quiz->student_id = Auth::id();
            $progress_quiz->quiz_id = $id;
            $progress_quiz->answers = $ans_json;
            $progress_quiz->point = $your_point;
            $progress_quiz->save();


        }
        echo 'ok';
    }

    public function save_progress(Request $request){
        if($request->type=='learning'){
            ProgressLearning::where('student_id',Auth::id())->where('learning_id',$request->id)->delete();
            $plearning = new ProgressLearning();
            $plearning->student_id = Auth::id();
            $plearning->learning_id = $request->id;
            $plearning->save();
        }elseif($request->type=='practice'){
            ProgressPractice::where('student_id',Auth::id())->where('practice_id',$request->id)->delete();
            $ppractice = new ProgressPractice();
            $ppractice->student_id = Auth::id();
            $ppractice->practice_id = $request->id;
            $ppractice->save();
        }
    }

    public function reset_quiz(Request $request){
        if($request->topic_id){
            $quizes = Topic::find($request->topic_id)->quiz;
            foreach($quizes as $row){
                ProgressQuiz::where('student_id',Auth::id())->where('quiz_id',$row->id)->delete();
            }

            echo 'ok';
        }
    }


}
