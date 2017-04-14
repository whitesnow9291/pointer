<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Pointer extends Model {

	protected $table = "pointer";
	protected $fillable = ['id','group_id','pointer_age','pointer_period','category_id','pointer_name','pointer_kananame','pointer_address','pointer_longitude','pointer_latitude','pointer_curaddress','pointer_comment','pointer_extra','pointer_show'];
	public function getPointer($pointer_id)
    {
        $res = DB::table($this->table)->join('category','pointer.category_id','=','category.id')
        ->select('pointer.id','pointer.pointer_name','pointer.pointer_address','pointer.pointer_curaddress','pointer.pointer_show','category.id as category_id','category.category_name','pointer.pointer_longitude','pointer.pointer_latitude','pointer.pointer_longlatdisp','category.pointer_color')
        ->whereRaw("pointer.id=".$pointer_id)->get();
        return $res;
    }
	public function buildQuery($condition,$per_page,$page)
	{    
		$category=$condition['category'];
		$pointer_name=$condition['pointer_name'];
        $age_sql='';
        $show_sql='';
        if (isset($condition['pointer_age'])){ 
            $pointer_age=$condition['pointer_age'];
            $age_sql="pointer_age =".$pointer_age[0];         
            for($i=1;$i<count($pointer_age);$i++)
            $age_sql= $age_sql." or pointer_age = ".$pointer_age[$i];
            $age_sql=" and (".$age_sql.") ";          
        }                               
		if (isset($condition['pointer_show'])){
            $pointer_show=$condition['pointer_show'];                                      
            $show_sql="pointer_show =".$pointer_show[0];                        
            for($i=1;$i<count($pointer_show);$i++)
            $show_sql= $show_sql." or pointer_show = ".$pointer_show[$i];
            $show_sql=" and (".$show_sql.") ";                         
        }     
                              
		$pointer_comment=$condition['pointer_comment'];
		$sortby=$condition['sortby'];
		$sortcolumn=$condition['sortcolumn'];
		$cur_page=$page;
		if ($category<1) {
			$category='';
		}
        
        $where_sql="pointer_name like '%".$pointer_name."%' and pointer_comment like '%".$pointer_comment."%' and category_id like '%".$category."%' ".$age_sql.$show_sql;
		$res = DB::table($this->table)->join('category','pointer.category_id','=','category.id')
		->select('pointer.id','pointer.pointer_name','pointer.pointer_address','pointer.pointer_curaddress','pointer.pointer_show','category.id as category_id','category.category_name','pointer.pointer_longitude','pointer.pointer_latitude','pointer.pointer_longlatdisp','category.pointer_color')
        ->whereRaw($where_sql) ->orderBy($sortcolumn,$sortby); 
		if (ceil($res->count()/$per_page)<$page)
		$cur_page=1;
		$skip=($cur_page-1)*$per_page;
        if ($cur_page==0){
		    $result=array('total_count'=>$res->count(),'data'=>$res->get(),'per_page'=>$per_page);
        }else{      
            $result=array('total_count'=>$res->count(),'data'=>$res->skip($skip)->take($per_page)->get(),'per_page'=>$per_page);
        }
		return $result;
	}
	
}