<?php

class Tes extends Controller {

	private $table      = "tes_table";
	private $primaryKey = "autono";
	private $model      = "Tes_model";
	private $menu       = "Front Office";
	private $title      = "Tes";
	private $curl       = BASE_URL."tes";
	

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
		$data['curl']	     = $this->curl;
		$template            = $this->loadView('tes_view');
		$template->set('data', $data);
		$template->render();
	}

	public function detail($x)
	{
		$data                = array();
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['curl']	     = $this->curl;
		$data['encode']      = $x;
		$template            = $this->loadView('tes_view');
		$template->set('data', $data);
		$template->render();
	}

	function get($x = null)
	{
		$request    = $_REQUEST;
		$id         = $this->base64url_decode($x);
		$columns = array(
			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'coba',  'dt' => 1 ),array( 'db' => 'nama',  'dt' => 2 ),
		);

		$model   = $this->loadModel($this->model);
		if($x){
			$result  = $model->mget_detail($request, $this->table, $this->primaryKey, $columns, $id);
		} else {
			$result  = $model->mget($request, $this->table, $this->primaryKey, $columns);
		}

		return json_encode($result);
	}

	public function add($x = null)
	{
		$model               = $this->loadModel($this->model);
		$data                = array();
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['action']      = 'Add';
		$data['curl']	     = $this->curl;
		$data['encode']	     = $x;
		$template            = $this->loadView('tes_add');
		$template->set('data', $data);
		$template->render();
	}

	public function edit($x)
	{
		$id                  = $this->base64url_decode($x);
		$model               = $this->loadModel($this->model);
		$uri                 = $this->loadHelper('Url_helper');
		$data                = array();
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['action']      = 'Edit';
		$data['encode']      = $x;
		$data['curl']	     = $this->curl;
		$data['child']       = $uri->segment(5);
		$data['aadata']      = $model->get($this->table, $this->primaryKey, $id);
		$template            = $this->loadView('tes_edit');
		$template->set('data', $data);
		$template->render();
	}

	public function save($x = null)
	{
		$data                 = array();
		$model                = $this->loadModel($this->model);
		$data['parent_id']    = $this->base64url_decode($x) ;
		$data['coba'] = htmlspecialchars($_REQUEST['coba']) ;
		$data['nama'] = htmlspecialchars($_REQUEST['nama']) ;

		$data['autocode']     = $model->autocode($this->table, "TS-");	
		$result               = $model->msave($this->table, $data, $this->title);
		if($x){
			$this->redirect('tes/detail/'.$x);
		} else {
			$this->redirect('tes');
		}
	}

	public function update($x)
	{
		$data               = array();
		$id                 = $this->base64url_decode($x);
		$model              = $this->loadModel($this->model);
		$uri                = $this->loadHelper('Url_helper');
		$child              = $uri->segment(5);
		$data['coba'] = htmlspecialchars($_REQUEST['coba']) ;
		$data['nama'] = htmlspecialchars($_REQUEST['nama']) ;
	
		$result             = $model->mupdate($this->table, $data, $this->primaryKey, $id, $this->title);
		if($child){
			$this->redirect('tes/detail/'.$child);
		} else {
			$this->redirect('tes');
		}
	}

	public function delete($x)
	{
		$id                 = $this->base64url_decode($x);
		$model              = $this->loadModel($this->model);
		$result             = $model->mdelete($this->table, $this->primaryKey, $id, $this->title);
		return $result;
	}
    
}