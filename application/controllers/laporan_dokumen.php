<?php

class Laporan_dokumen extends Controller {

	private $table       = "tbl_dokumen";
	private $primaryKey  = "autono";
	private $model       = "Laporan_model"; # please write with no space
	private $title       = "Dokumen";
	private $menu        = "Laporan";
	private $curl        = BASE_URL."laporan_dokumen";

	public function __construct()
    {
        $session = $this->loadHelper('Session_helper');
        if(!$session->get('username')){
        	$this->redirect('auth/login');
        }
    }
	
	function index()
	{
		$model   = $this->loadModel($this->model);
		$data                = array();
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['aadata']      = $model->get();
		$data['curl']        = $this->curl;
		$template            = $this->loadView('laporan_dokumen');
		$template->set('data', $data);
		$template->render();
	}


	function get($x = null)

	{

		$request    = $_REQUEST;

		$id         = $this->base64url_decode($x);

		$columns = array(

			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),

			array( 'db' => 'nama_kegiatan',  'dt' => 1 ),

			array( 'db' => 'autocode',  'dt' => 2 ),

			array( 'db' => 'autocode',  'dt' => 3 ),

			array( 'db' => 'autocode',  'dt' => 4 ),

			array( 'db' => 'autocode',  'dt' => 5 ),

			array( 'db' => 'autocode',  'dt' => 6 ),

		);



		$model   = $this->loadModel($this->model);

		$result  = $model->mget($request, $this->table, $this->primaryKey, $columns);

		return json_encode($result);

	}

    
}