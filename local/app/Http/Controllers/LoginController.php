<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

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
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function login(Request $request)
	{
		// Get the input fields from the form into an array
		return "this is login controller";
		$remember = $request->input('remember');
		if ($remember!="on"){
			$remember="off";
		}
		$format = '%Y-%m-%d %H:%M:%S';
		$login_at = strftime($format);
		$admin_name=$request->input('name');
		$password=$request->input('password');
		$credentials = array(
				'manager_name'		=> $admin_name,
				'password'			=> $password,
				'remember'			=> $remember,
		);
		
		$rules = array(
				'manager_name'		=> 'required|min:3|max:255',
				'password'			=> 'required|min:6|max:128',
				'remember'			=> 'required|min:1|max:128',
		);
		// Make the validator
 		$validation = Validator::make($credentials,$rules);
		if ( $validation -> fails() )
		{ 
			 return redirect('login')->withErrors($validation->messages());
		} 
		$password=md5($password);
	    $count = User::whereRaw('name = ? and password = ?', [$admin_name,$password])->get();
		
		if (count($count)>0){
			Session::put('user_id', $count[0]['id']);
	    	Session::put('user_name', $count[0]['user_name']);
	    	return redirect('customer/index');
	    	
	    }else{
	    	return redirect('login')->withErrors(["you are not registered user!"]);
	    }
	}
	public function register(Request $request)
	{
		
		// Get the input fields from the form into an array
		$agree = $request->input('user_agreement');
		if ($agree!="on"){
			$agree="";
		}
		$format = '%Y-%m-%d %H:%M:%S';
		$strf = strftime($format);
		$created=$strf;
		$updated=$strf;
		$new_user = array(
				'admin_name'		=> $request->input('name'),
				'admin_kananame'  => $request->input('kananame'),
				'email'  => $request->input('email'),
				'password'	=> $request->input('password'),
				'confirm_password'	=> $request->input('password_confirmation'),
				'confirmation_code'		=> "ok",
				'user_aggreement'		=>$agree,
				'last_login'			=> $created,
				'remember_token'		=>"off",
		);
		$rules = array(
				'admin_name'		=> 'required|min:1|max:255',
				'admin_kananame'  => 'required|min:1|max:255',
				'email'  			=> 'required|email|max:128',
				'password'			=> 'required|min:1|max:128|same:confirm_password',
				'confirm_password'  => 'required|min:1|max:128',
				'confirmation_code'	=> 'required|min:1|max:128',
				'user_aggreement'	=> 'required',
				'last_login'		=> 'required|min:1|max:128',
				'remember_token'	=> 'required|min:1|max:128',
		);
		
		// Make the validator
		$validation = Validator::make($new_user, $rules);
		if ( $validation -> fails() )
		{ 
			return redirect('register')->withErrors($validation->messages());
		}
	    $new_user['password'] = Hash::make($new_user['password']);
	    $user=new User($new_user);
	    $user->save();
	    return view('auth/login');
	}
}
