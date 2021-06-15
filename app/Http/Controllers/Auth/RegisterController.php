<?php

namespace App\Http\Controllers\Auth;

use App\Invitation;
use Mail;
use App\Student;
use App\Parents;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if(isset($data['type']) && $data['type']=='parent'){
            return Validator::make($data, [
                'firstName' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:parent'],
                'password' => ['required', 'string', 'min:6'],
            ]);
        }else{
            return Validator::make($data, [
                'firstName' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:student'],
                'password' => ['required', 'string', 'min:6s'],
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if(isset($data['type']) && $data['type']=='parent'){
            return Parents::create([
                'firstName' => $data['firstName'],
                'lastName' => $data['lastName'],
                'mobile' => isset($data['mobile'])?$data['mobile']:"",
                'email' => $data['email'],
                'status' => 1,
                'password' => Hash::make($data['password']),
            ]);
        }else{

            $id = Student::create([
                'firstName' => $data['firstName'],
                'lastName' => $data['lastName'],
                'dateOfBirth' => date("Y-m-d",strtotime($data['dateOfBirth'])),
                'email' => $data['email'],
                'status' => 1,
                'password' => Hash::make($data['password']),
            ]);

            if($data['parentEmail']){
                $inv = new Invitation();
                $inv->email = $data['parentEmail'];
                $inv->student_id = $id->id;
                $inv->save();
            }

            return $id;
        }

    }

    /**
     * Override default register method from RegistersUsers trait
     *
     * @param array $request
     * @return redirect to $redirectTo
     */
    public function register(Request $request)
    {

        $this->validator($request->all())->validate();

        //add activation_key to the $request array
        //$activation_key = $this->getToken();
        //$request->request->add(['activation_key' => $activation_key]);

        $user = $this->create($request->all());

        $this->guard()->login($user);

        //write a code for send email to a user with activation link

        $data = array('name' => $request['first_name'].' '.$request['last_name'], 'email' => $request['email']);

       /* Mail::send('emails.user_signup_welcome', $data, function($message) use ($data) {
            $message->to($data['email'])
                ->subject('Welcome to PyTeach');
        });*/

        $request->session()->flash('success', __('Your account is created successfully! You are now logged in.'));
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath())->with('success', 'Your account is created successfully!');
    }
}
