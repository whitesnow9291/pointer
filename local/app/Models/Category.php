<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Category extends Model {
	
	protected $table = "category";
	protected $fillable = ['category_name','pointer_color'];
	
	public function buildQuery($condition)
	{
		$queryBuilder = $this->query();
		if (!empty($condition['category_name'])) {
			$queryBuilder = $queryBuilder->where('category_name', 'like', '%' . $condition['category_name'] . '%');
		}
		return $queryBuilder;
	}
}