<?php

class Pussenif_import_detail extends Controller {

	private $table      = "tbl_pussenif_detail";
	private $primaryKey = "autono";
	private $model      = "Pussenif_import_detail_model";
	private $menu       = "PUSSENIF";
	private $title      = "pussenif import Detail";
	private $curl       = BASE_URL."pussenif_import_detail";
	

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
		$template            = $this->loadView('pussenif_import_detail_view');
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
		$template            = $this->loadView('pussenif_import_detail_view');
		$template->set('data', $data);
		$template->render();
	}

	function get($x = null)
	{
		$request    = $_REQUEST;
		$id         = $this->base64url_decode($x);
		$columns = array(
			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'tes_child',  'dt' => 1 ),
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
		$template            = $this->loadView('pussenif_import_detail_add');
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
		$template            = $this->loadView('pussenif_import_detail_edit');
		$template->set('data', $data);
		$template->render();
	}

	public function save($x = null)
	{
		$data                 = array();
		$model                = $this->loadModel($this->model);
		$data['parent_id']    = $this->base64url_decode($x) ;
		$data['tes_child'] = htmlspecialchars($_REQUEST['tes_child']) ;

		$data['autocode']     = $model->autocode($this->table, "PS-");	
		$result               = $model->msave($this->table, $data, $this->title);
		if($x){
			$this->redirect('pussenif_import_detail/detail/'.$x);
		} else {
			$this->redirect('pussenif_import_detail');
		}
	}

	public function update($x)
	{
		$data               = array();
		$id                 = $this->base64url_decode($x);
		$model              = $this->loadModel($this->model);
		$uri                = $this->loadHelper('Url_helper');
		$child              = $uri->segment(5);
		$data['tes_child'] = htmlspecialchars($_REQUEST['tes_child']) ;
	
		$result             = $model->mupdate($this->table, $data, $this->primaryKey, $id, $this->title);
		if($child){
			$this->redirect('pussenif_import_detail/detail/'.$child);
		} else {
			$this->redirect('pussenif_import_detail');
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