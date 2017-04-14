<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Pointer;
//use Psy\Util\String;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller {
    
    /**
     * Menu number (left-side menu)
     *
     * @var int
     */
    public $menuNumber = 2;
    
    /**
     * Session namespace
     * 
     * @var String
     */
    protected $_sessionNS = 'pointer.admin.category.';
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Register middleware for login check
        session_start ();
        $this->middleware('auth');
        
        // Share data
        // view()->share('_menuNumber', $this->menuNumber);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return Response
     */
    public function getIndex(Request $request)
    {
        // ソート項目、ソート順を確認する
        $request->session()->forget($this->_sessionNS . 'condition');
        if ($request->exists('sort')) {
            $oldSort = $request->session()->get($this->_sessionNS . 'sort', '');
            $sortOrder = $request->session()->get($this->_sessionNS . 'sortOrder', '');
            
            $sort = $request->get('sort');
            if ($sort == $oldSort) {
                $sortOrder = ($sortOrder == 'ASC') ? 'DESC' : 'ASC';
            }
            
            // セッションに保存する。
            $request->session()->put($this->_sessionNS . 'sort', $sort);
            $request->session()->put($this->_sessionNS . 'sortOrder', $sortOrder);
        }
        
        // ページ番号を確認する。
        if ($request->exists('page')) {
            $page = $request->get('page');
            $request->session()->put($this->_sessionNS . 'page', $page);
        }
        
        return $this->_showRecords($request);
    }
    
    /**
     * Search records
     * 
     * @param  Request  $request
     * @return Response
     */
    public function postIndex(Request $request)
    {
        // 検索条件をセッションに保存する。
        $condition = $request->get('condition');
        $request->session()->put($this->_sessionNS . 'condition', $condition);
        
        return $this->_showRecords($request);
    }
    
    /**
     * Delete selected records (one or more)
     * 
     * @param  Request  $request
     * @return Response
     */
    public function deleteIndex(Request $request)
    {
        
        // 削除するレコードの番号を確認する。
        $delete_result=null;
        $ids = $request->get('chk');
        $ids = array_keys($ids);  
        // 削除する。
        $isRefresh = $request->get('_isRefresh', false);
        $undeleted_category=array();
        
        if (!empty($ids) && !$isRefresh) { 
            foreach($ids as $key=>$val){
                $count = Pointer::where('category_id', '=', $val)->count();
                // 指定のレコードを削除する。
                if ($count >0){
                   $category_name=Category::find($val,['category_name'])->category_name;
                   array_push($undeleted_category,$category_name);
                    
                }else{
                    Category::destroy([$val]);
                   
                }
            }
                                                                        
            $categories="";
            $len=count($undeleted_category);
            for ($i=0;$i<$len-1;$i++){
               $categories.=$undeleted_category[$i].",  "; 
            }
            if ($len>0)                                                          
            $categories.=$undeleted_category[$len-1];  
            if(empty($undeleted_category)){
               $delete_result=array('result'=>'success'); 
            }else{
               $delete_result=array('result'=>'error','categories'=>$categories); 
            }
            $request->request->set('delete_result',$delete_result);
        }                                
        return $this->_showRecords($request);
    }
    
    /**
     * 一覧にレコードを表示する。
     * 
     * @param Request $request
     * @return Response
     */
    protected function _showRecords($request)
    {
        // 検索条件を確認する。
        $condition = session($this->_sessionNS . 'condition', [
            'category_name' => '',
            'pointer_kind' => '',
        ]);
        
        // ページ情報、ソート情報を確認する。
        $page      = session($this->_sessionNS . 'page', 1); // app('session')->get('key', 'default');
        $sort      = session($this->_sessionNS . 'sort', 'id'); // $request->session()->get('key', 'default');
        $sortOrder = session($this->_sessionNS . 'sortOrder', 'ASC');
 
        if (!$request->exists('page')) {
            // \Illuminate\Pagination\PaginationServiceProvider により[page]パラメータから
            // 現在のページ番号を取得する。
            // 従って、[page]パラメータがない場合にはセッションからのページ番号を設定する。
            $request->request->set('page', 1);
        }
        
        // クエリを構成し、レコードを表示する。
        $CategoryTbl = new Category();
        $queryBuilder = $CategoryTbl->buildQuery($condition);
        $queryBuilder->orderBy($sort, $sortOrder);
        // @todo ページナビゲーションを生成する。
        $perPage = config('app.perPage');
        $records = $queryBuilder->paginate($perPage);
        $records->setPageName('page');
        $records->setPath(url('/category/index'));
                
        if (!$request->exists('delete_result')) {
            return view('category.index')->with([
                'records' => $records,
                'total' => $CategoryTbl->count(),
                'condition' => $condition,
                'sort' => $sort,
                'sortOrder' => $sortOrder,
                ]);
        }else{  
             
            $delete_result=$request->get('delete_result');  
            return view('category.index')->with([
                'records' => $records,
                'total' => $CategoryTbl->count(),
                'condition' => $condition,
                'sort' => $sort,
                'sortOrder' => $sortOrder,
                'delete_result' => $delete_result,
                ]);
        }
        
    }
    
    /**
     * Show the form for creating a new resource.
     * (Empty form)
     *
     * @return Response
     */
    public function getCreate()
    {
        $new = new Category();
        
        return view('category.create', ['record' => $new]);
    }
    
    /**
     * Show the form for creating a new resource.
     * (Back)
     *
     * @param Request $request
     * @return Response
     */
    public function postCreate(Request $request)
    {
        $record = $request->get('data');    
        //return redirect()->back()->withInput($request->all());
        return view('category.create')->with(['record' => $record]);
    }
    
    /**
     * Show the screen for confirmation of input contents
     * 
     * @param Request $request
     * @return Response
     */
    public function postCreateconfirm(CategoryRequest $request)
    {
        $record = $request->get('data');                           
        // 入力チェック : 自動で行われる。
        //$request->validate();
        //$this->validate($request, $rules, $messages);
        
        return view('category.createconfirm', ['record' => $record]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function postCreatefinish(Request $request)
    {
        // 入力内容を受け取る。
        $record = $request->get('data');
        $isRefresh = $request->get('_isRefresh', false);
        $result = false;
        $sessionName = $this->_sessionNS . 'input';
        if (!$isRefresh) {
            // パスワードのHASHを計算して登録する。
            $new = new Category($record);
            $result = $new->save();
            
            // セッションに結果を保存する。
            session()->set($sessionName, $result);
        } else {
            // セッションから以前の処理結果を取得する。
            $result = session($sessionName, $result);
        }
        return view('category.createfinish', [
            'result' => $result
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * (Show)
     *
     * @param Request $request
     * @return Response
     */
    public function getEdit(Request $request)
    {
        // ID 取得
        $id = $request->get('id', 0);
        
        // 運営者情報を取得する。
        $Category = new Category();
        $record = $Category->find($id);
        if (empty($record)) {
            return redirect('/category/index');
        }
        return view('category.edit', ['record' => $record]);
    }

    /**
     * Show the form for editing the specified resource.
     * (Back)
     *
     * @param Request $request
     * @return Response
     */
    public function postEdit(Request $request)
    {
        $record = $request->get('data');
        return view('category.edit', ['record' => $record]);
    }
    
    /**
     * Show the screen for confirmation of changed contents
     * 
     * @param Request $request
     * @return Response
     */
    public function postEditconfirm(CategoryRequest $request)
    {
        $record = $request->get('data');
        
        // 入力チェック : 自動で行われる。
        //$request->validate();
        //$this->validate($request, $rules, $messages);
        
        return view('category.editconfirm', ['record' => $record]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function postEditfinish(Request $request)
    {
        // 入力内容を受け取る。
        $record = $request->get('data');
        $isRefresh = $request->get('_isRefresh', false);
        
        // 不定なデータである場合
        if (empty($record['id'])) {
            return redirect('/category/index');
        }
        
        $result = false;
        $sessionName = $this->_sessionNS . 'input';
        if (!$isRefresh) {
            // レコードを更新する。
            $oldRecord = Category::find($record['id']);
            if (empty($oldRecord)) {
                return redirect('/category/index');
            }
            $result = $oldRecord->update($record);
             
            // セッションに結果を保存する。
            session()->set($sessionName, $result);
        } else {
            // セッションから以前の処理結果を取得する。
            $result = session($sessionName, $result);
        }
        
        return view('category.editfinish', [
            'result' => $result
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request,$id)
    {   
        $count = Pointer::where('category_id', '=', $id)->count();
        // 指定のレコードを削除する。
        if ($count >0){
           $category_name=Category::find($id,['category_name']);         
           $delete_result=array('result'=>'error','categories'=>$category_name->category_name); 
        }else{
            Category::destroy([$id]);
           $delete_result=array('result'=>'success');
        } 
                               
        $request->request->set('delete_result', $delete_result);
        return $this->_showRecords($request);                                         
    }

}
