<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'admin_user';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'kananame','email', 'password','confirm_code','logdate'];
	protected $hidden = ['password', 'remember_token'];
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */	
	public function buildQuery($condition)
	{
	    $queryBuilder = $this->query();
	    if (!empty($condition['name'])) {
	        $queryBuilder = $queryBuilder->where('name', 'like', '%' . $condition['name'] . '%');
	    }
	    if (!empty($condition['kananame'])) {
	    	$queryBuilder = $queryBuilder->where('kananame', 'like', '%' . $condition['kananame'] . '%');
	    }
	    if (!empty($condition['email'])) {
	        $queryBuilder = $queryBuilder->where('email', 'like', '%' . $condition['email'] . '%');
	    }
	    
	    return $queryBuilder;
	}
}
