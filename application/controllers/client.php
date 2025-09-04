<?php

class Client extends Controller {

	private $table      = "tprojectclients";
	private $primaryKey = "autono";
	private $model      = "Client_model"; # please write with no space
	private $menu       = "Reference";
	private $title      = "Client";
	private $curl       = BASE_URL."client/";
	

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
		$template            = $this->loadView('client_view');
		$template->set('data', $data);
		$template->render();
	}

	function get()
	{
		$request    = $_REQUEST;
		$columns = array(
			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'nama',  'dt' => 1 ),
			array( 'db' => 'keterangan',   'dt' => 2 )
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
		$template            = $this->loadView('client_add');
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
		$template            = $this->loadView('client_edit');
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
		$this->redirect('client');
	}

	public function update($x)
	{
		$data               = array();
		$id                 = $this->base64url_decode($x);
		$model              = $this->loadModel($this->model);
		$data['nama']       = htmlspecialchars($_REQUEST['nama']) ;
		$data['keterangan'] = htmlspecialchars($_REQUEST['keterangan']) ;
		
		$result             = $model->mupdate($this->table, $data, $this->primaryKey, $id, $this->title);
		$this->redirect('client');
	}

	public function delete($x)
	{
		$id                 = $this->base64url_decode($x);
		$model              = $this->loadModel($this->model);
		$result             = $model->mdelete($this->table, $this->primaryKey, $id, $this->title);
		return $result;
	}
    
}