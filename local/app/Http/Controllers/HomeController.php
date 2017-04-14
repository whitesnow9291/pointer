<?php namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pointer;
use App\Models\Category;
use App\Models\Pointer_photo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller {

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
	public function index()
	{
		return view('home');
	}
    public function pointerSearch(Request $request) {
        $condition = $request->get('condition');      
        $result =  DB::table('pointer')->join('category','pointer.category_id','=','category.id')
        ->select('pointer.id','pointer.pointer_name','pointer.pointer_address','pointer.pointer_curaddress','pointer.pointer_show','category.id as category_id','category.category_name','pointer.pointer_longitude','pointer.pointer_latitude','pointer.pointer_longlatdisp','category.pointer_color')
        ->whereRaw("pointer_show = 1 and (pointer_period like '%".$condition.
        "%' or pointer_name like '%".$condition.
        "%' or pointer_kananame like '%".$condition.
        "%' or pointer_address like '%".$condition.
        "%' or pointer_curaddress like '%".$condition.
        "%' or pointer_extra like '%".$condition."%')"
        )
        ->get();
        return json_encode($result);
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
}
