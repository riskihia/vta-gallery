<?php

class Wilayah extends Controller {

	private $table      = "tbl_wilayah";
	private $primaryKey = "autono";
	private $model      = "wilayah_model"; # please write with no space
	private $menu       = "Master Data";
	private $title      = "Wilayah";
	private $curl       = BASE_URL."wilayah/";
	

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
		$template            = $this->loadView('wilayah_view');
		$template->set('data', $data);
		$template->render();
	}

	function get()
	{
		$request    = $_REQUEST;
		$columns = array(
			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'provinsi',  'dt' => 1 ),
			array( 'db' => 'kabupaten',   'dt' => 2 ),
			array( 'db' => 'kecamatan',   'dt' => 3 ),
			array( 'db' => 'desa',   'dt' => 4 )
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
		$template            = $this->loadView('wilayah_add');
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
		$template            = $this->loadView('wilayah_edit');
		$template->set('data', $data);
		$template->render();
	}

	public function save()
	{
		$data                = array();
		$model               = $this->loadModel($this->model);
		// $data['nama_satker'] = htmlspecialchars($_REQUEST['nama_satker']) ;
		$data['kd_prov'] = htmlspecialchars($_REQUEST['kd_prov']) ;
		$data['kd_kab'] = htmlspecialchars($_REQUEST['kd_kab']) ;
		$data['kd_kec'] = htmlspecialchars($_REQUEST['kd_kec']) ;
		$data['kode'] = $_REQUEST['kd_prov'].".".$_REQUEST['kd_kab'].".".$_REQUEST['kd_kec'];
		$data['negara'] = "INDONESIA";
		$data['provinsi'] = htmlspecialchars($_REQUEST['provinsi']) ;
		$data['kabupaten'] = htmlspecialchars($_REQUEST['kabupaten']) ;
		$data['kecamatan'] = htmlspecialchars($_REQUEST['kecamatan']) ;
		$data['desa'] = htmlspecialchars($_REQUEST['desa']) ;
		$data['kor_long'] = htmlspecialchars($_REQUEST['kor_long']) ;
		$data['kor_lat'] = htmlspecialchars($_REQUEST['kor_lat']) ;
		$data['keterangan']  = htmlspecialchars($_REQUEST['keterangan']) ;
		// $data['autocode']    = $model->autocode($this->table, "SAT-");	
		$result              = $model->msave($this->table, $data, $this->title);
		$this->redirect('wilayah');
	}

	public function update($x)
	{
		$data                = array();
		$id                  = $this->base64url_decode($x);
		$model               = $this->loadModel($this->model);
		// $data['nama_satker'] = htmlspecialchars($_REQUEST['nama_satker']) ;
		// $data['keterangan']  = htmlspecialchars($_REQUEST['keterangan']) ;
		$data['kd_prov'] = htmlspecialchars($_REQUEST['kd_prov']) ;
		$data['kd_kab'] = htmlspecialchars($_REQUEST['kd_kab']) ;
		$data['kd_kec'] = htmlspecialchars($_REQUEST['kd_kec']) ;
		$data['kode'] = $_REQUEST['kd_prov'].".".$_REQUEST['kd_kab'].".".$_REQUEST['kd_kec'];
		// $data['negara'] = "INDONESIA";
		$data['provinsi'] = htmlspecialchars($_REQUEST['provinsi']) ;
		$data['kabupaten'] = htmlspecialchars($_REQUEST['kabupaten']) ;
		$data['kecamatan'] = htmlspecialchars($_REQUEST['kecamatan']) ;
		$data['desa'] = htmlspecialchars($_REQUEST['desa']) ;
		$data['kor_long'] = htmlspecialchars($_REQUEST['kor_long']) ;
		$data['kor_lat'] = htmlspecialchars($_REQUEST['kor_lat']) ;
		$data['keterangan']  = htmlspecialchars($_REQUEST['keterangan']) ;
		
		$result              = $model->mupdate($this->table, $data, $this->primaryKey, $id, $this->title);
		$this->redirect('wilayah');
	}

	public function delete($x)
	{
		$id                 = $this->base64url_decode($x);
		$model              = $this->loadModel($this->model);
		$result             = $model->mdelete($this->table, $this->primaryKey, $id, $this->title);
		return $result;
	}
    
}