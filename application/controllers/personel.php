<?php

class Personel extends Controller {

	private $table      = "ref_personel";
	private $primaryKey = "autono";
	private $model      = "Personel_model"; # please write with no space
	private $menu       = "Reference";
	private $title      = "Personel";
	private $curl       = BASE_URL."personel/";
	

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
		$template            = $this->loadView('personel_view');
		$template->set('data', $data);
		$template->render();
	}

	function get()
	{
		$model   = self::loadModel($this->model);	
   		$request    = $_REQUEST;
		$columns = array(
			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'nama_personel',  'dt' => 1 ),
			array( 'db' => 'nrp',   'dt' => 2 ),
			array( 'db' => 'pangkat',  'dt' => 3 ),
			array( 'db' => 'jabatan',   'dt' => 4 ),
			array( 'db' => 'korps',   'dt' => 5 ),
			array( 'db' => 'jenis_kelamin',  'dt' => 6 ),
			array( 'db' => 'tempat_lahir',   'dt' => 7 ),
			array( 'db' => 'tanggal_lahir',  'dt' => 8 ),
			array( 'db' => 'keterangan',   'dt' => 9 )
		);

		
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
		$template            = $this->loadView('personel_add');
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
		$template            = $this->loadView('personel_edit');
		$template->set('data', $data);
		$template->render();
	}

	public function save()
	{
		$data                  = array();
		$model                 = $this->loadModel($this->model);
		$data['nama_personel'] = htmlspecialchars($_REQUEST['nama_personel']) ;
		$data['nrp']           = htmlspecialchars($_REQUEST['nrp']) ;
		$data['pangkat']       = htmlspecialchars($_REQUEST['pangkat']) ;
		$data['jabatan']       = htmlspecialchars($_REQUEST['jabatan']) ;
		$data['korps']         = htmlspecialchars($_REQUEST['korps']) ;
		$data['jenis_kelamin'] = htmlspecialchars($_REQUEST['jenis_kelamin']) ;
		// $data['tempat_lahir']  = htmlspecialchars($_REQUEST['tempat_lahir']) ;
		// $data['tanggal_lahir'] = htmlspecialchars($_REQUEST['tanggal_lahir']) ;
		$data['keterangan']    = htmlspecialchars($_REQUEST['keterangan']) ;
		$data['autocode']      = $model->autocode($this->table, "PC_");	
		$result                = $model->msave($this->table, $data, $this->title);
		$this->redirect('personel');
	}

	public function update($x)
	{
		$data                  = array();
		$id                    = $this->base64url_decode($x);
		$model                 = $this->loadModel($this->model);
		$data['nama_personel'] = htmlspecialchars($_REQUEST['nama_personel']) ;
		$data['nrp']           = htmlspecialchars($_REQUEST['nrp']) ;
		$data['pangkat']       = htmlspecialchars($_REQUEST['pangkat']) ;
		$data['jabatan']       = htmlspecialchars($_REQUEST['jabatan']) ;
		$data['korps']         = htmlspecialchars($_REQUEST['korps']) ;
		$data['jenis_kelamin'] = htmlspecialchars($_REQUEST['jenis_kelamin']) ;
		// $data['tempat_lahir']  = htmlspecialchars($_REQUEST['tempat_lahir']) ;
		// $data['tanggal_lahir'] = htmlspecialchars($_REQUEST['tanggal_lahir']) ;
		$data['keterangan']    = htmlspecialchars($_REQUEST['keterangan']) ;
		
		$result                = $model->mupdate($this->table, $data, $this->primaryKey, $id, $this->title);
		$this->redirect('personel');
	}

	public function delete($x)
	{
		$id                 = $this->base64url_decode($x);
		$model              = $this->loadModel($this->model);
		$result             = $model->mdelete($this->table, $this->primaryKey, $id, $this->title);
		return $result;
	}
    
}