<?php

class Logsystem extends Controller {

	private $table      = "tlog";
	private $primaryKey = "log_id";
	private $model      = "Logsystem_model"; # please write with no space
	private $menu       = "Utility";
	private $title      = "Log System";
	private $curl       = BASE_URL."logsystem/";
	

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
		$template            = $this->loadView('logsystem_view');
		$template->set('data', $data);
		$template->render();
	}

	function get()
	{
		$request    = $_REQUEST;
		$columns = array(
			array( 'db' => 'log_id', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'log_nama_form',  'dt' => 1 ),
			array( 'db' => 'log_action',   'dt' => 2 ),
			array( 'db' => 'log_date',   'dt' => 3 ),
			array( 'db' => 'log_user',   'dt' => 4 ),
			array( 'db' => 'log_ip',   'dt' => 5 )
		);

		$model   = $this->loadModel($this->model);
		$result  = $model->mget($request, $this->table, $this->primaryKey, $columns);

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
		$template            = $this->loadView('logsystem_add');
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
		$data['aadata']      = $model->get($this->table, $this->primaryKey, $id);
		$template            = $this->loadView('logsystem_edit');
		$template->set('data', $data);
		$template->render();
	}

	public function save()
	{
		$data                 = array();
		$model                = $this->loadModel($this->model);
		$data['nama']         = htmlspecialchars($_REQUEST['nama']) ;
		$data['keterangan']   = htmlspecialchars($_REQUEST['keterangan']) ;
		$data['autocode']     = $model->autocode($this->table, "PC_");	
		$result               = $model->msave($this->table, $data, $this->title);
		$this->redirect('logsystem');
	}

	public function update($x)
	{
		$data               = array();
		$id                 = $this->base64url_decode($x);
		$model              = $this->loadModel($this->model);
		$data['nama']       = htmlspecialchars($_REQUEST['nama']) ;
		$data['keterangan'] = htmlspecialchars($_REQUEST['keterangan']) ;
		
		$result             = $model->mupdate($this->table, $data, $this->primaryKey, $id, $this->title);
		$this->redirect('logsystem');
	}

	public function delete($x)
	{
		$id                 = $this->base64url_decode($x);
		$model              = $this->loadModel($this->model);
		$result             = $model->mdelete($this->table, $this->primaryKey, $id, $this->title);
		return $result;
	}
    
}