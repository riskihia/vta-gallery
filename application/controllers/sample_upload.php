<?php

class Sample_upload extends Controller {

	private $table      = "sample_upload_tbl";
	private $primaryKey = "autono";
	private $model      = "Sample_upload_model";
	private $menu       = "Front Office";
	private $title      = "sample upload";
	private $curl       = BASE_URL."sample_upload";
	

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
		$template            = $this->loadView('sample_upload_view');
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
		$template            = $this->loadView('sample_upload_view');
		$template->set('data', $data);
		$template->render();
	}

	function get($x = null)
	{
		$request    = $_REQUEST;
		$id         = $this->base64url_decode($x);
		$columns = array(
			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'alamat',  'dt' => 1 ),array( 'db' => 'nama',  'dt' => 2 ),array( 'db' => 'tanggal_lahir',  'dt' => 3 ),array( 'db' => 'keterangan',  'dt' => 4 ),array( 'db' => 'jeniskelamin',  'dt' => 5 ),
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
		$template            = $this->loadView('sample_upload_add');
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
		$template            = $this->loadView('sample_upload_edit');
		$template->set('data', $data);
		$template->render();
	}

	public function save($x = null)
	{
		$data                 = array();
		$model                = $this->loadModel($this->model);
		$data['parent_id']    = $this->base64url_decode($x) ;
		$data['alamat'] = htmlspecialchars($_REQUEST['alamat']) ;
		$data['nama'] = htmlspecialchars($_REQUEST['nama']) ;
		$data['tanggal_lahir'] = htmlspecialchars($_REQUEST['tanggal_lahir']) ;
		$data['keterangan'] = htmlspecialchars($_REQUEST['keterangan']) ;
		$data['jeniskelamin'] = htmlspecialchars($_REQUEST['jeniskelamin']) ;

		$data['autocode']     = $model->autocode($this->table, "SU-");	
		$result               = $model->msave($this->table, $data, $this->title);
		if($x){
			$this->redirect('sample_upload/detail/'.$x);
		} else {
			$this->redirect('sample_upload');
		}
	}

	public function update($x)
	{
		$data               = array();
		$id                 = $this->base64url_decode($x);
		$model              = $this->loadModel($this->model);
		$uri                = $this->loadHelper('Url_helper');
		$child              = $uri->segment(5);
		$data['alamat'] = htmlspecialchars($_REQUEST['alamat']) ;
		$data['nama'] = htmlspecialchars($_REQUEST['nama']) ;
		$data['tanggal_lahir'] = htmlspecialchars($_REQUEST['tanggal_lahir']) ;
		$data['keterangan'] = htmlspecialchars($_REQUEST['keterangan']) ;
		$data['jeniskelamin'] = htmlspecialchars($_REQUEST['jeniskelamin']) ;
	
		$result             = $model->mupdate($this->table, $data, $this->primaryKey, $id, $this->title);
		if($child){
			$this->redirect('sample_upload/detail/'.$child);
		} else {
			$this->redirect('sample_upload');
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