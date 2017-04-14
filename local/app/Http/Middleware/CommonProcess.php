<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class CommonProcess {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
	    //$url = $request->
	    //$query = $request->query->has($key)
	    
	    // 1. F5キーによるREFRESH検出
	    $isRefresh = false;
	    $requestTime = $request->get('_requestTime', '');
	    $oldRequestTime = $request->session()->get(SESSION_NAME_ADMIN_PREFIX . 'requestTime', '');
	    if (!empty($requestTime)) {
	        if ($requestTime == $oldRequestTime) {
	            $isRefresh = true;
	        }
	        $request->session()->set(SESSION_NAME_ADMIN_PREFIX . 'requestTime', $requestTime);
	    }
	    $request->request->set('_isRefresh', $isRefresh);
	    
		return $next($request);
	}
	
	/**
	 * Handle after sending response like as storing result to session
	 * 
	 * @param \Illuminate\Http\Request $request
	 * @param \Illuminate\Http\Response $response
	 * @returnn void
	 */
	public function terminate($request, $response)
	{
	    // handle after sending response
	    
	}

}
