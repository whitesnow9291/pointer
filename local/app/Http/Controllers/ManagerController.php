<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
//use Psy\Util\String;
use App\Http\Requests\ManagerRequest;

class ManagerController extends Controller {
    
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
    protected $_sessionNS = 'pointer.admin.manager.';
    
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
        $ids = $request->get('chk');
        $ids = array_keys($ids);
        
        // 削除する。
        $isRefresh = $request->get('_isRefresh', false);
        if (!empty($ids) && !$isRefresh) {
            User::destroy($ids);
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
            'name' => '',
        	'kananame'=>'',
            'email' => ''
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
        $managerTbl = new User();
        $queryBuilder = $managerTbl->buildQuery($condition);
        $queryBuilder->orderBy($sort, $sortOrder);
        // @todo ページナビゲーションを生成する。
        $perPage = config('app.perPage');
        $records = $queryBuilder->paginate($perPage);
        $records->setPageName('page');
        $records->setPath(url('/manager/index'));
        return view('manager.index')->with([
            'records' => $records,
            'total' => $managerTbl->count(),
            'condition' => $condition,
            'sort' => $sort,
            'sortOrder' => $sortOrder,
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     * (Empty form)
     *
     * @return Response
     */
    public function getCreate()
    {
        $new = new User();
        
        return view('manager.create', ['record' => $new]);
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
        return view('manager.create')->with(['record' => $record]);
    }
    
    /**
     * Show the screen for confirmation of input contents
     * 
     * @param Request $request
     * @return Response
     */
    public function postCreateconfirm(ManagerRequest $request)
    {
        $record = $request->get('data');
        
        // 入力チェック : 自動で行われる。
        //$request->validate();
        //$this->validate($request, $rules, $messages);
        
        return view('manager.createconfirm', ['record' => $record]);
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
            $new = new User($record);
            $new->password = bcrypt($new->password);
            $result = $new->save();
            
            // セッションに結果を保存する。
            session()->set($sessionName, $result);
        } else {
            // セッションから以前の処理結果を取得する。
            $result = session($sessionName, $result);
        }
        return view('manager.createfinish', [
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
        $user = new User();
        $record = $user->find($id);
        if (empty($record)) {
            return redirect('/manager/index');
        }
        $record->password = '';
        
        return view('manager.edit', ['record' => $record]);
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
        
        return view('manager.edit', ['record' => $record]);
    }
    
    /**
     * Show the screen for confirmation of changed contents
     * 
     * @param Request $request
     * @return Response
     */
    public function postEditconfirm(ManagerRequest $request)
    {
        $record = $request->get('data');
        
        // 入力チェック : 自動で行われる。
        //$request->validate();
        //$this->validate($request, $rules, $messages);
        
        return view('manager.editconfirm', ['record' => $record]);
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
            return redirect('/manager/index');
        }
        
        $result = false;
        $sessionName = $this->_sessionNS . 'input';
        if (!$isRefresh) {
            // レコードを更新する。
            $oldRecord = User::find($record['id']);
            if (empty($oldRecord)) {
                return redirect('/manager/index');
            }
            if (empty($record['password'])) {
                unset($record['password']);
            } else {
                $record['password'] = bcrypt($record['password']);
            }
            $result = $oldRecord->update($record);
             
            // セッションに結果を保存する。
            session()->set($sessionName, $result);
        } else {
            // セッションから以前の処理結果を取得する。
            $result = session($sessionName, $result);
        }
        
        return view('manager.editfinish', [
            'result' => $result
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // 指定のレコードを削除する。
        User::destroy([$id]);
        
        return redirect('/manager/index');
    }

}
