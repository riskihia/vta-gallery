<?php

class Users extends Controller {

	private $table      = "tuser";
	private $primaryKey = "autono";
	private $model      = "Users_model"; # please write with no space
	private $menu       = "Utility";
	private $title      = "User Manager";
	private $curl       = BASE_URL."users/";
	

	public function __construct()
    {
        $session = $this->loadHelper('Session_helper');
        if(!$session->get('username')){
        	$this->redirect('auth/login');
        }
    }
	
	function index()
	{
		$data                = array();
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['curl']		 = $this->curl;
		$template            = $this->loadView('users_view');
		$template->set('data', $data);
		$template->render();
	}

	function get()
	{
		$request    = $_REQUEST;
		$columns = array(
			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'user_id',  'dt' => 1 ),
			array( 'db' => 'user_fullname',   'dt' => 2 ),
			array( 'db' => 'jabatanVal',   'dt' => 3 ),
			array( 'db' => 'user_grupVal',   'dt' => 4 ),
			array( 'db' => 'foto',   'dt' => 5, 'formatter' => function( $d, $row ) { return base64_encode($d); } )
		);

		$model   = $this->loadModel($this->model);
		$result  = $model->mget($request, $this->table, $this->primaryKey, $columns);

		return json_encode($result);
	}

	function check()
	{
		$request    = $_REQUEST['term'];

		$model   = $this->loadModel($this->model);
		$result  = $model->getvalue("SELECT COUNT(user_id) as j FROM tuser WHERE user_id = '$request' ");

		return json_encode($result);
	}

	public function add()
	{
		$model               = $this->loadModel($this->model);
		$data                = array();
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['action']      = 'Add';
		$data['curl']		 = $this->curl;
		$data['groups']      = $model->query("SELECT autono, group_name FROM tusergroup");
		$data['position']    = $model->query("SELECT autono, nama_jabatan FROM torganizationstructure");
		$template            = $this->loadView('users_add');
		$template->set('data', $data);
		$template->render();
	}

	public function edit($x)
	{
		$id                  = $this->base64url_decode($x);
		$model               = $this->loadModel($this->model);
		$data                = array();
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['action']      = 'Edit';
		$data['encode']      = $x;
		$data['curl']		 = $this->curl;
		$data['groups']      = $model->query("SELECT autono, group_name FROM tusergroup");
		$data['position']    = $model->query("SELECT autono, nama_jabatan FROM torganizationstructure");
		$data['aadata']      = $model->get($this->table, $this->primaryKey, $id);
		$template            = $this->loadView('users_edit');
		$template->set('data', $data);
		$template->render();
	}

	public function save()
	{
		global $config;

		$data                  = array();
		$model                 = $this->loadModel($this->model);
		$data['user_id']       = htmlspecialchars($_REQUEST['user_id']) ;
		$data['user_fullname'] = htmlspecialchars($_REQUEST['user_fullname']) ;
		$data['jabatan']       = htmlspecialchars($_REQUEST['position']) ;
		$data['user_grup']     = htmlspecialchars($_REQUEST['user_grup']) ;
		$data['user_password'] = sha1(md5(htmlspecialchars($_REQUEST['user_password']).$config['key'])) ;
		$data['jabatanVal']    = $model->getval('torganizationstructure', 'nama_jabatan', 'autono', $data['jabatan']) ;
		$data['user_grupVal']  = $model->getval('tusergroup', 'group_name', 'autono', $data['user_grup']);
		// $data['tempat_lahir']  = htmlspecialchars($_REQUEST['tempat_lahir']) ;
		$data['tgl_lahir']     = htmlspecialchars($_REQUEST['tgl_lahir']) ;

		$result1               = $model->show_office();
        $parent                = $model->show_parent($data['jabatan']);

        while ($row = $model->fetch_object($parent)) {
            $datax[$row->parent_id][] = $row;
        }

        while ($row = $model->fetch_object($result1)) {
            $datax[$row->parent_id][] = $row;
        }
        
        $groups = $this->get_office($datax, $data['jabatan']);

		$data['list_office']   = array_values(array_unique($groups, SORT_REGULAR));

		$result                = $model->msave($this->table, $data, $this->title);
		$this->redirect('users');
	}

	public function update($x)
	{
		global $config;

		$data                  = array();
		$id                    = $this->base64url_decode($x);
		$model                 = $this->loadModel($this->model);
		$data['user_id']       = htmlspecialchars($_REQUEST['user_id']) ;
		$data['user_fullname'] = htmlspecialchars($_REQUEST['user_fullname']) ;
		$data['jabatan']       = htmlspecialchars($_REQUEST['position']) ;
		$data['user_grup']     = htmlspecialchars($_REQUEST['user_grup']) ;
		if(!empty($_REQUEST['user_password'])){
			$data['user_password'] = sha1(md5($model->escapeString($_REQUEST['user_password']).$config['key'])) ;
		}	
		$data['jabatanVal']    = $model->getval('torganizationstructure', 'nama_jabatan', 'autono', $data['jabatan']) ;
		$data['user_grupVal']  = $model->getval('tusergroup', 'group_name', 'autono', $data['user_grup']) ;
		$data['tempat_lahir']  = htmlspecialchars($_REQUEST['tempat_lahir']) ;
		// $data['tgl_lahir']     = htmlspecialchars($_REQUEST['tgl_lahir']) ;

		$result1               = $model->show_office();
        $parent                = $model->show_parent($data['jabatan']);

        while ($row = $model->fetch_object($parent)) {
            $datax[$row->parent_id][] = $row;
        }

        while ($row = $model->fetch_object($result1)) {
            $datax[$row->parent_id][] = $row;
        }
        
        $groups                = $this->get_office($datax, $data['jabatan']);

		$data['list_office']   = $groups;
		
		$result                = $model->mupdate($this->table, $data, $this->primaryKey, $id, $this->title);
		$this->redirect('users');
	}

	public function delete($x)
	{
		$id                 = $this->base64url_decode($x);
		$model              = $this->loadModel($this->model);
		$result             = $model->mdelete($this->table, $this->primaryKey, $id, $this->title);
		return $result;
	}

	public function get_office($data, $parent) 
    {
        static $i = 1;
        $datas = array();
        if (isset($data[$parent])) {
            foreach ($data[$parent] as $v) {
                $child = $this->get_office($data, $v->id);
                $row   = $v->id;
                
                if ($child) {         
                   $row =  $child;
                }
                array_push($datas,$row);
            }

            $uniq = array_values(array_unique($datas, SORT_REGULAR));
           return join(',',$uniq);
        } else {
            return false;
        }
    }

	
    
}