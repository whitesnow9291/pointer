<?php namespace App\Http\Controllers;

use App\Models\Admins;

class MaptilerController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Maptiler Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "maptiler's wizard screen". 
	| Of course, you are free to change or remove the controller as you wish.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	
	public function __construct()
	{
		session_start ();
		$this->middleware('auth');
		
	}

	/**
	 * Show the first step of the Map Tiler wizard screen to the user.
	 *
	 * @return Response
	 */
	
	public function index() {
		return view('maptiler.index');
	}
	
}
