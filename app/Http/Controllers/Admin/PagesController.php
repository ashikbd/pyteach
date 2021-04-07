<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Category;
use App\Pages;
use Validator;
use App\Language;
use App\PageDetail;
use File;

class PagesController extends Controller
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
        $data['page_list'] = Pages::all();
        return view('admin.page.page-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['category_list'] = Category::all();
        $data['lang_list'] = Language::all();
        return view('admin.page.page-add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //echo '<pre>'; print_r($request['title']); echo '</pre>';


        $validator = Validator::make($request->all(),
            [
                'category' => 'required',
                'title' => 'required',
                'alias' => 'required',
                'description' => 'required'
            ]
        );

        if($validator->fails()){
            return redirect('admin/pages/create')
                    ->withErrors($validator)
                    ->withInput();
        }

        else{

            $page = new Pages;
            $page->category = $request['category'];
            $page->title = $request['title'];
            $page->alias = $request['alias'];
            $page->description = $request['description'];


             if($request['featured_image']){
                File::move('uploads/_temp/'.$request['featured_image'],'uploads/pages/'.$request['featured_image']);
                $page->featured_image = $request['featured_image'];
             }

            $page->save();


            return redirect('admin/pages')->with('success_message', 'New page successfully added');
        }
    }

    function count_value($item, $key){
        if(count($item)){
            $total_title++;
            return $total_title;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['category_list'] = Category::all();
        $data['page_detail'] = Pages::where('id', $id)->firstOrFail();
        return view('admin.page.page-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'category' => 'required',
                'title' => 'required',
                'alias' => 'required',
                'description' => 'required'
            ]
        );

        if($validator->fails()){
            $data['category_list'] = Category::all();
            $data['page_detail'] = Pages::where('id', $id)->firstOrFail();

            return redirect('pages/'.$id.'/edit')
                    ->withErrors($validator)
                    ->withInput();
        }else{
            $page = Pages::findOrFail($id);

            $page->category = $request['category'];
            $page->title = $request['title'];
            $page->alias = $request['alias'];
            $page->description = $request['description'];

            if($request['featured_image']){
                File::move('uploads/_temp/'.$request['featured_image'],'uploads/pages/'.$request['featured_image']);
                $page->featured_image = $request['featured_image'];
            }

            $page->save();


            return redirect('admin/pages')->with('success_message', 'page successfully updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        Pages::where("id", $request['id'])->delete();
        echo 'success';
    }

    public function upload_featured_img(Request $request){
        upload($request->all(),'myfile');

    }
}
