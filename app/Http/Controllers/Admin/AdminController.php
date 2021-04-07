<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserRole;
use Validator;
use Auth;
use Session;
use Illuminate\Validation\Rule;
use App\Admin;

class AdminController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth:admin');

    }

    public function index(){

    }

    /**
     * Show user list.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function user_list()
    {

        //$users = User::orderBy('id','ASC')->get();
        $users = User::all();
		    return view('auth.admin.admin-list', ['user_list' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userEdit($id)
    {

        if(Auth::user()->user_type != 1 && Auth::user()->id != $id){
            return redirect('/home');
        }

        $data['user_detail'] = User::where('id',$id)->firstOrFail();

        return view('auth.user-edit', $data);
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $req)
	{
        if(Auth::user()->user_type != 1 && Auth::user()->id != $req->id){
            return redirect('/home');
        }

        $v = Validator::make($req->all(), [
                'password'=>'required_with:password_confirmation|same:password_confirmation|nullable|min:6',
                'password_confirmation'=>'sometimes|required_with:password|nullable|min:6'
            ]);

    	if ($v->fails())
	    {
	        return redirect()->back()->withInput()->withErrors($v->errors());
	    }
	    else{

	    	$user = User::find ( $req->id );

            $user->first_name = $req->first_name;
            $user->last_name = $req->last_name;
            //$user->email = $req->email;

	        if($req->password){
	        	$user->password = bcrypt($req->password);
	        }

	        $user->save ();

            \Session::flash('successMessage',trans('user.user_successfully_updated'));

            return redirect()->route('home');
	    }

	}

  public function user_delete($id){

    $user = User::where("id", $id)->firstOrFail();
    $user->where("id", $id)->delete();


    return redirect('admin/user-list')->with('success', __('User has been successfully deleted'));

}

    protected function destroy($id){

    	if(Auth::user()->id == $id){
    		Session::flash('error_message', 'You can\'t delete your account, contact with another admin!');
    		return redirect('admin/user-list');
    	}
    	else{
            if(Auth::user()->user_type == 1){
                $user = User::where("id", $id)->firstOrFail();
                $user->where("id", $id)->delete();

                \Session::flash('successMessage',"User has been successfully deleted.");
                return redirect('/user-list');
            }
            else{
                return redirect('/user-list');
            }

    	}

	}


    public function admin_list()
    {
      $data['admins'] = Admin::all();
      return view('auth/admin/admin-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_create()
    {
      return view('auth/admin/admin_create');
    }

    public function admin_store(Request $request)
    {
      $v = Validator::make($request->all(), [
                'email' => 'required|email|unique:admin',
                'password'=>'required_with:password_confirmation|same:password_confirmation|nullable|min:6',
                'password_confirmation'=>'sometimes|required_with:password|nullable|min:6'
            ]);

        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        else{
            $admin = new Admin;
            $admin->first_name = $request['first_name'];
            $admin->last_name = $request['last_name'];
            $admin->email = $request['email'];
            $admin->user_type = 1;
            $admin->password = bcrypt($request['password']);

            $admin->save();

            return redirect()->route('admin.list')->with('success', __('common.success_msg'));
        }
    }


}
