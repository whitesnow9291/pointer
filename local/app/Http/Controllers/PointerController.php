<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Pointer_photo;
use Illuminate\Queue\Console\RetryCommand;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Pointer;
use Illuminate\Support\Facades\Storage;

class PointerController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| User Controller
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
	protected $_sessionNS = 'pointermanagement.pointer.pointer_table.';
		
	public function __construct()
	{
		session_start ();
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	
	public function index() {
		$category_data = Category::all(); 
        $_SESSION ['user_name'] = Auth::user ()->name;//for image uploading don't erase
        $condition=array("pointer_name" => "",
                             "pointer_age" => "",
                             "pointer_comment" =>"",
                             "category" => "0",
                             "sortby" =>   "asc",
                             "sortcolumn" =>"pointer_name");
        Session::put($this->_sessionNS . 'condition', $condition);
        Session::put($this->_sessionNS . 'current_page', 1);
        $per_page=config('app.pointer_perPage');
        $total_pointer_data=Pointer::all();  
        if ($total_pointer_data->count()>0){
             $data_flag=true;
        }else{
             $first_pointer_image_data = [];
             $data_flag=false;
        }
		return view ( 'mapview.mapview',[   
				'category_data'=>$category_data,
				'pointer'=>$total_pointer_data,
                'data_exist'=>$data_flag,
                'map_bound'=>config('app.map_bound'),
		]);
	}
	
	
	public function pointerSearch(Request $request) {
		$condition = $request->get('condition');
		Session::put($this->_sessionNS . 'condition', $condition);
		$per_page=config('app.pointer_perPage');
		$current_page=0;
		
        $result=$this->searchPointerData($condition,$per_page,$current_page);
        return json_encode($result);
    }
    public function pointerPagination(Request $request) {
    	$current_page = $request->get('page');
    	Session::put($this->_sessionNS . 'current_page', $current_page);
    	$condition=Session::get($this->_sessionNS . 'condition', []);
    	$per_page=config('app.pointer_perPage');
    	
    	$result=$this->searchPointerData($condition,$per_page,$current_page);
    	return json_encode($result);
    }
	public function searchPointerData($condition,$per_page,$page){
		$pointer_table = new Pointer();
        $result = $pointer_table->buildQuery($condition,$per_page,$page);
		return $result;
	}
	public function getPointerDataByAjax(Request $request) {
		$pointer_id=$request->input('pointer_id');
		
		$pointer_data=$this->getPointerData($pointer_id);
		$pointer_image_data=$this->getPointerImageData($pointer_id);
		
		$pointer_array=array('pointer_data'=>$pointer_data,'pointer_image_data'=>$pointer_image_data);
		return $pointer_array;
	}
	public function getPointerData($pointer_id) {
		$data=DB::table('pointer')->where('id', '=', $pointer_id)->get();
		return $data[0];
	}
	public function getPointerImageData($pointer_id) {
		$data=DB::table('pointer_photo')->where('pointer_id', '=', $pointer_id)->orderBy ( 'pointer_photo.id', 'asc' )
		->get();           
        foreach ($data as $key=>$val){
            $filename =$val->photo_name; 
            $exists = Storage::disk('pointer_image')->exists($filename);    
            if ($exists==false)
            $data[$key]->photo_name="no-image.png";
        }
		return $data;
	}
	public function delete(Request $request){
		
		$pointer_id= $request->input ( 'pointer_id' );
		$this->photo_delete($pointer_id);
		Pointer::where('id','=',$pointer_id)->delete();
		$pointer_id=Pointer::first()->id;
		return $pointer_id;
	}
	public function photo_delete($pid){
		$photos=Pointer_photo::where('pointer_id','=',$pid)->lists('photo_name');
		$dir  =  'image/pointer/uploaded_photos';
		$files = scandir($dir);
		$c=0;
		foreach ($photos as $key=>$val){
			if (in_array($val, $files)) {
				unlink ($dir."/".$val);				
			}	
		}
	}
	public function save_pointer_image(Request $request) {
		$photo = $request->input ( 'photo' );
		$content = $request->input ( 'content' );
		$mode = $request->input ( 'mode' );
        
		$pointer_id= $request->input ( 'pointer_id' );
		$pointer_ids_id=$request->input('pointer_group');
		$format = '%Y-%m-%d %H:%M:%S';
		$strf = strftime($format);

		$pointer_new=array(
		"pointer_age" => $request->input ( 'pointer_age' ),
		"pointer_period" => $request->input ( 'pointer_period' ),
		"category_id" => $request->input ( 'pointer_category' ),
		"pointer_name" => $request->input ( 'pointer_name' ),
		"pointer_kananame" => $request->input ( 'pointer_kananame' ),
		"pointer_address"=>	$request->input ( 'pointer_address' ),
		"pointer_longitude" => $request->input ( 'pointer_position_longitude' ),
		"pointer_latitude" => $request->input ( 'pointer_position_latitude' ),
		"pointer_longlatdisp"=>$request->input ('pointer_position_longlatdisp'),
		"pointer_curaddress" => $request->input ( 'pointer_curaddress' ),
		"pointer_comment" => $request->input ( 'pointer_content' ),
		"pointer_extra" => $request->input ( 'pointer_extra' ),
		"pointer_show" => $request->input ( 'pointer_display' )=='show'?1:0,
		"updated_at"=>$strf,
		); 
		$same_count=Pointer::where('pointer_name','=',$pointer_new['pointer_name'])->count();
		if ($mode=="create"){
			if ($same_count>0) return 0;
		}
		if ($mode=="update"){
			if ($same_count>0){
				$origin_name=Pointer::where('id','=',$pointer_id)->lists('pointer_name');
				if ($origin_name[0]!=$pointer_new['pointer_name']){
					return 0;
				}
			}
		}
			if ($mode=="update"){
				if ($pointer_ids_id==-1){
					//$group_ids=DB::table('pointer')->where('id', '=', $pointer_id)->lists('group_id');
					//$group_id=$group_ids[0];
					$group_id = DB::table('group')->insertGetId(
		   			 ['created_at' => $strf, 'updated_at' => $strf]
					);
				}else{
					//$group_ids = DB::table('pointer')->where('id', '=', $pointer_ids_id)->lists('group_id');
					//$group_id=$group_ids[0];
					$group_id=$pointer_ids_id;
				}
				$pointer_new=$pointer_new+ array("group_id"=>$group_id);
				DB::table('pointer')->where('id','=',$pointer_id)->update($pointer_new);
				$affectedRows = Pointer_photo::where ( 'pointer_id', '=', $pointer_id )->delete ();
				$this->photo_delete($pointer_id);		
			}else{
				
				if ($pointer_ids_id==-1){
					$group_id = DB::table('group')->insertGetId(
		   			 ['created_at' => $strf, 'updated_at' => $strf]
					);
				}else{
					//$group_ids = DB::table('pointer')->where('id', '=', $pointer_ids_id)->lists('group_id');
					//$group_id=$group_ids[0];
					$group_id=$pointer_ids_id;
				}
				$pointer_new=$pointer_new+array("group_id"=>$group_id);
				$pointer_new=$pointer_new+ array("created_at"=>$strf);
				$pointer_id=DB::table('pointer')->insertGetId($pointer_new);
			}
				$c=count($photo);
				for($i = 0; $i < $c; $i ++) {
					$new_photo = array(
							'pointer_id'	=>$pointer_id,
							'photo_name'		=>$photo[$i],
							'photo_comment'		=>$content [$i],
							'created_at'			=>$strf,
							'updated_at'			=>$strf
					);
					DB::table('pointer_photo')->insert($new_photo);
				}
        $category_id=$request->input ( 'pointer_category' );
        $color=Category::where('id', '=', $category_id)->get();
        $color=$color[0]->pointer_color;
        $pointer_show=$pointer_new['pointer_show'];
        echo json_encode(array('pointer_id'=>$pointer_id,'color'=>$color,'pointer_show'=>$pointer_show));
	}
}
