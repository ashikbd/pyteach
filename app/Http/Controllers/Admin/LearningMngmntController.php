<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Learning;
use App\Practice;
use App\Quiz;
use App\QuizAnswer;
use App\QuizOption;
use App\Topic;

use Illuminate\Http\Request;
use Validator;

class LearningMngmntController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['topics'] = Topic::all();
        return view('admin.learning.topic-list', $data);
    }

    public function topic_add(){
        return view('admin.learning.topic-add');
    }

    public function topic_save(Request $request)
    {


        $validator = Validator::make($request->all(),
            [
                'title' => 'required'
            ]
        );

        if($validator->fails()){
            return redirect('admin/learning/topic_add')
                ->withErrors($validator)
                ->withInput();
        }

        else{

            $topic = new Topic;
            $topic->title = $request['title'];

            $topic->description = $request['description']?$request['description']:"";
            $topic->status = 1;

            $topic->save();

            return redirect('admin/learning')->with('success_message', 'New topic successfully added');
        }
    }

    public function topic_edit(){
        return view('admin.learning.topic-add');
    }

    public function topic_learning($id)
    {
        $data['learning'] = Topic::find($id)->learning;
        $data['id'] = $id;
        return view('admin.learning.learning-list', $data);
    }

    public function topic_learning_add($id)
    {
        $data['id'] = $id;
        return view('admin.learning.learning-add', $data);
    }

    public function learning_save(Request $request){
        $validator = Validator::make($request->all(),
            [
                'description' => 'required',
                'topic_id' => 'required'
            ]
        );

        if($validator->fails()){
            return redirect('admin/learning/topic_learning_add/'.$request->topic_id)
                ->withErrors($validator)
                ->withInput();
        }else{
            $lcount = Topic::find($request->topic_id)->learning->count();

            $learning = new Learning;
            $learning->title = $request['title']?$request['title']:"Slide - ".($lcount+1);
            $learning->content = $request['description']?$request['description']:"";
            $learning->status = 1;
            $learning->position = ++$lcount;
            $learning->topic_id = $request->topic_id;
            $learning->save();

            return redirect('admin/learning/topic_learning/'.$request->topic_id)->with('success_message', 'New learning slide successfully added');
        }
    }

    public function topic_learning_delete(Request $request){
        if($request->id){
            Learning::find($request->id)->delete();
            echo 'ok';
        }
    }

    public function topic_learning_edit($id)
    {
        $data['id'] = $id;
        $data['learning'] = Learning::find($id);
        return view('admin.learning.learning-edit', $data);
    }

    public function learning_update(Request $request){
        $validator = Validator::make($request->all(),
            [
                'description' => 'required',
                'id' => 'required'
            ]
        );

        if($validator->fails()){
            return redirect('admin/learning/topic_learning_edit/'.$request->id)
                ->withErrors($validator)
                ->withInput();
        }else{

            $learning = Learning::find($request->id);
            $learning->title = $request['title'];
            $learning->content = $request['description']?$request['description']:"";
            $learning->status = $request['status'];
            $learning->position = $request['position'];
            $learning->save();

            return redirect('admin/learning/topic_learning/'.$learning->topic_id)->with('success_message', 'New learning slide successfully added');
        }
    }

    public function topic_practice($topic_id)
    {
        $data['practice'] = Topic::find($topic_id)->practice;
        $data['topic_id'] = $topic_id;
        return view('admin.learning.practice-list', $data);
    }

    public function topic_practice_add($topic_id)
    {
        $data['topic_id'] = $topic_id;
        return view('admin.learning.practice-add', $data);
    }

    public function topic_practice_edit($id)
    {
        $data['id'] = $id;
        $data['practice'] = Practice::find($id);
        return view('admin.learning.practice-edit', $data);
    }

    public function practice_save(Request $request){
        $validator = Validator::make($request->all(),
            [
                'description' => 'required',
                'topic_id' => 'required'
            ]
        );

        if($validator->fails()){
            return redirect('admin/learning/topic_practice_add/'.$request->topic_id)
                ->withErrors($validator)
                ->withInput();
        }else{
            $pcount = Topic::find($request->topic_id)->practice->count();

            $practice = new Practice;
            $practice->title = $request['title']?$request['title']:"Slide - ".($pcount+1);
            $practice->content = $request['description']?$request['description']:"";
            $practice->js = $request['js']?$request['js']:"";
            $practice->status = 1;
            $practice->position = ++$pcount;
            $practice->topic_id = $request->topic_id;
            $practice->save();

            return redirect('admin/learning/topic_practice/'.$request->topic_id)->with('success_message', 'New practice slide successfully added');
        }
    }

    public function practice_update(Request $request){
        $validator = Validator::make($request->all(),
            [
                'description' => 'required',
                'id' => 'required'
            ]
        );

        if($validator->fails()){
            return redirect('admin/learning/topic_practice_edit/'.$request->id)
                ->withErrors($validator)
                ->withInput();
        }else{
            $practice = Practice::find($request->id);
            $practice->title = $request['title']?$request['title']:"Slide - ".($pcount+1);
            $practice->content = $request['description']?$request['description']:"";
            $practice->js = $request['js']?$request['js']:"";
            $practice->status = $request->status;
            $practice->position = $request->position;
            $practice->save();

            return redirect('admin/learning/topic_practice/'.$practice->topic_id)->with('success_message', 'Practice slide successfully updated!');
        }
    }

    public function topic_quiz($topic_id){
        $data['quiz'] = Topic::find($topic_id)->quiz;
        $data['topic_id'] = $topic_id;
        $data['topic_title'] = Topic::find($topic_id)->title;
        return view('admin.learning.quiz-list', $data);
    }

    public function topic_quiz_add($topic_id)
    {
        $data['topic_id'] = $topic_id;
        return view('admin.learning.quiz-add', $data);
    }

    public function quiz_save(Request $request){
        $validator = Validator::make($request->all(),
            [
                'question' => 'required',
                'topic_id' => 'required'
            ]
        );

        if($validator->fails()){
            return redirect('admin/learning/topic_quiz_add/'.$request->topic_id)
                ->withErrors($validator)
                ->withInput();
        }else{
            $qcount = Topic::find($request->topic_id)->quiz->count();

            $quiz = new Quiz;
            $quiz->question = $request['question'];
            $quiz->type = $request['type'];
            $quiz->point = $request['point'];
            $quiz->status = 1;
            $quiz->position = ++$qcount;
            $quiz->topic_id = $request->topic_id;
            $quiz->save();

            if($request['type']==1){
                $quiz->quiz_answer()->save(new QuizAnswer(['answer'=>$request['type_1_answer']]));
            }elseif($request['type']==2 || $request['type']==3){
                foreach ($request['option'] as $opt){
                    if(!$opt) continue;
                    $quiz->quiz_option()->save(new QuizOption(['option'=>trim($opt)]));
                }

                foreach($request['option_answer'] as $ans){
                    if(!isset($request['option'][$ans-1]) || !$request['option'][$ans-1]) continue;

                    $quiz->quiz_answer()->save(new QuizAnswer(['answer'=>trim($request['option'][$ans-1])]));
                }
            }



            return redirect('admin/learning/topic_quiz/'.$request->topic_id)->with('success_message', 'New quiz successfully added');
        }
    }

    public function topic_quiz_edit($id)
    {
        $quiz = Quiz::find($id);
        $data['id'] = $id;
        $data['quiz'] = $quiz;
        $data['options'] = $quiz->quiz_option;
        $data['answers'] = $quiz->quiz_answer->pluck('answer')->toArray();;

        return view('admin.learning.quiz-edit', $data);
    }

    public function quiz_update(Request $request){
        $validator = Validator::make($request->all(),
            [
                'question' => 'required',
                'id' => 'required'
            ]
        );

        if($validator->fails()){
            return redirect('admin/learning/topic_quiz_edit/'.$request->id)
                ->withErrors($validator)
                ->withInput();
        }else{
            $quiz = Quiz::find($request['id']);
            $quiz->question = $request['question'];
            $quiz->type = $request['type'];
            $quiz->point = $request['point'];
            $quiz->status = $request['status'];
            $quiz->position = $request['position'];
            $quiz->save();

            $quiz->quiz_answer()->delete();
            $quiz->quiz_option()->delete();

            if($request['type']==1){
                $quiz->quiz_answer()->save(new QuizAnswer(['answer'=>$request['type_1_answer']]));
            }elseif($request['type']==2 || $request['type']==3){
                foreach ($request['option'] as $opt){
                    if(!$opt) continue;
                    $quiz->quiz_option()->save(new QuizOption(['option'=>trim($opt)]));
                }

                foreach($request['option_answer'] as $ans){
                    if(!isset($request['option'][$ans-1]) || !$request['option'][$ans-1]) continue;

                    $quiz->quiz_answer()->save(new QuizAnswer(['answer'=>trim($request['option'][$ans-1])]));
                }
            }



            return redirect('admin/learning/topic_quiz_edit/'.$request->id)->with('success_message', 'Quiz successfully updated');
        }
    }

    public function topic_quiz_delete(Request $request){
        if($request->id){
            $quiz = Quiz::find($request->id);
            $topic_id = $quiz->topic_id;
            $quiz->quiz_option()->delete();
            $quiz->quiz_answer()->delete();
            $quiz->delete();
            return redirect('admin/learning/topic_quiz/'.$topic_id)->with('success_message', 'Quiz successfully deleted!');
        }
    }

    public function topic_practice_delete(Request $request){
        if($request->id){
            $p = Practice::find($request->id)->delete();
            return redirect('admin/learning/topic_practice/'.$p->topic_id)->with('success_message', 'Practice successfully deleted!');
        }
    }
}
