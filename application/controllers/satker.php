<?php

class Satker extends Controller {

	private $table      = "ref_satker";
	private $primaryKey = "autono";
	private $model      = "Satker_model"; # please write with no space
	private $menu       = "Reference";
	private $title      = "Satker";
	private $curl       = BASE_URL."satker/";
	

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
		$template            = $this->loadView('satker_view');
		$template->set('data', $data);
		$template->render();
	}

	function get()
	{
		$request    = $_REQUEST;
		$columns = array(
			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'nama_satker',  'dt' => 1 ),
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
		$template            = $this->loadView('satker_add');
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
		$template            = $this->loadView('satker_edit');
		$template->set('data', $data);
		$template->render();
	}

	public function save()
	{
		$data                = array();
		$model               = $this->loadModel($this->model);
		$data['nama_satker'] = htmlspecialchars($_REQUEST['nama_satker']) ;
		$data['keterangan']  = htmlspecialchars($_REQUEST['keterangan']) ;
		$data['autocode']    = $model->autocode($this->table, "SAT-");	
		$result              = $model->msave($this->table, $data, $this->title);
		$this->redirect('satker');
	}

	public function update($x)
	{
		$data                = array();
		$id                  = $this->base64url_decode($x);
		$model               = $this->loadModel($this->model);
		$data['nama_satker'] = htmlspecialchars($_REQUEST['nama_satker']) ;
		$data['keterangan']  = htmlspecialchars($_REQUEST['keterangan']) ;
		
		$result              = $model->mupdate($this->table, $data, $this->primaryKey, $id, $this->title);
		$this->redirect('satker');
	}

	public function delete($x)
	{
		$id                 = $this->base64url_decode($x);
		$model              = $this->loadModel($this->model);
		$result             = $model->mdelete($this->table, $this->primaryKey, $id, $this->title);
		return $result;
	}
    
}