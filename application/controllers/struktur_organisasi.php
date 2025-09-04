<?php

class Struktur_organisasi extends Controller {

	private $table      = "torganizationstructure";
	private $primaryKey = "autono";
	private $model      = "Struktur_organisasi_model"; # please write with no space
	private $menu       = "Utilitas";
	private $title      = "Struktur Organisasi";
	private $curl       = BASE_URL."struktur_organisasi/";
	
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
		$template            = $this->loadView('struktur_organisasi_view');
		$template->set('data', $data);
		$template->render();
	}

	function get()
	{
		$request = $_REQUEST;
		$columns = array(
			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'kd_kotama',  'dt' => 1 ),
			array( 'db' => 'nm_kotama',  'dt' => 2 ),
			array( 'db' => 'keterangan',   'dt' => 3 )
		);

		$model  = $this->loadModel($this->model);
		$join   = "";
		$result = $model->mget($request, $this->tableKot, $this->primaryKey, $columns, $join);

		return json_encode($result);
	}

	public function addParent()
	{
		$model               = $this->loadModel($this->model);
		$data                = array();
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['action']      = 'Add';
		$data['curl']        = $this->curl;
		$template            = $this->loadView('struktur_organisasi_addParent');
		$template->set('data', $data);
		$template->render();
	}

	public function addchild($x)
	{
		$uri                 = $this->loadHelper('Url_helper');
		$model               = $this->loadModel($this->model);
		$id                  = $this->base64url_decode($x);
		$data                = array();
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['action']      = 'Add';
		$data['curl']		 = $this->curl;
		$data['korps']       = $model->get_korps();
		$data['pangkat']     = $model->get_pangkat();
		$data['groups']      = $model->get_groups($id);
		$template            = $this->loadView('struktur_organisasi_addChild');
		$template->set('data', $data);
		$template->render();
	}

	public function edit($x)
	{
		$id                  = $this->base64url_decode($x);
		$model               = $this->loadModel($this->model);
		$parent_id           = $model->getval($this->table, 'parent_id', 'autono', $id);
		$data                = array();
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['action']      = 'Edit';
		$data['encode']      = $x;
		$data['curl']        = $this->curl;
		$data['korps']       = $model->get_korps($id);
		$data['pangkat']     = $model->get_pangkat($id);
		$data['groups']      = $model->get_groups($parent_id);
		$data['aadata']      = $model->get($this->table, $this->primaryKey, $id);
		$template            = $this->loadView('struktur_organisasi_edit');
		$template->set('data', $data);
		$template->render();
	}

	public function editchild($x)
	{
		$id                  = $this->base64url_decode($x);
		$model               = $this->loadModel($this->model);
		$data                = array();
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['action']      = 'Edit';
		$data['encode']      = $x;
		$data['curl']		 = $this->curl;
		$data['groups']      = $model->get_groups($id);
		$data['korps']       = $model->get_korps($id);
		$data['pangkat']     = $model->get_pangkat($id);
		$data['aadata']      = $model->get($this->table, $this->primaryKey, $id);
		$template            = $this->loadView('user_groups_editchild');
		$template->set('data', $data);
		$template->render();
	}

	public function save()
	{
		$data                 = array();
		$model                = $this->loadModel($this->model);
		$data['nama_jabatan'] = ucwords(htmlspecialchars($_REQUEST['nama_jabatan'])) ;
		$data['nama_lengkap'] = ucwords(htmlspecialchars($_REQUEST['nama_lengkap'])) ;
		$data['pangkat']      = ucwords(htmlspecialchars($_REQUEST['pangkat'])) ;
		$data['nrp_nip']      = ucwords(htmlspecialchars($_REQUEST['nrp_nip'])) ;
		$data['korps']        = ucwords(htmlspecialchars($_REQUEST['korps'])) ;
		$data['keterangan']   = ucwords(htmlspecialchars($_REQUEST['keterangan'])) ;
		$data['parent_id']    = ucwords(htmlspecialchars($_REQUEST['status'])) ;
		$result               = $model->msave($this->table, $data, $this->title);                                                                                                                                                            
		$this->redirect('struktur_organisasi');
	}

	public function savechild()
	{
		$data                 = array();
		$model                = $this->loadModel($this->model);
		$data['nama_jabatan'] = htmlspecialchars($_REQUEST['nama_jabatan']) ;
		$data['nama_lengkap'] = isset($_REQUEST['nama_lengkap']) ?  ucwords(htmlspecialchars($_REQUEST['nama_lengkap'])) : NULL ;
		$data['pangkat']      = ucwords(htmlspecialchars($_REQUEST['pangkat'])) ;
		$data['nrp_nip']      = ucwords(htmlspecialchars($_REQUEST['nrp_nip'])) ;
		$data['korps']        = ucwords(htmlspecialchars($_REQUEST['korps'])) ;
		$data['keterangan']   = htmlspecialchars($_REQUEST['keterangan']) ;
		$data['parent_id']    = htmlspecialchars($_REQUEST['parent_id']) ; 
		$result               = $model->msave($this->table, $data, $this->title);
		$this->redirect('struktur_organisasi');
	}

	public function updatechild($x)
	{
		$data                 = array();
		$id                   = $this->base64url_decode($x);
		$model                = $this->loadModel($this->model);
		$data['nama_jabatan'] = htmlspecialchars($_REQUEST['nama_jabatan']) ;
		$data['nama_lengkap'] = ucwords(htmlspecialchars($_REQUEST['nama_lengkap'])) ?? NULL ;
		$data['pangkat']      = ucwords(htmlspecialchars($_REQUEST['pangkat'])) ;
		$data['nrp_nip']      = ucwords(htmlspecialchars($_REQUEST['nrp_nip'])) ;
		$data['korps']        = ucwords(htmlspecialchars($_REQUEST['korps'])) ;
		$data['keterangan']   = htmlspecialchars($_REQUEST['keterangan']) ;
		$data['parent_id']    = htmlspecialchars($_REQUEST['parent_id']) ; 
		
		$result               = $model->mupdate($this->table, $data, $this->primaryKey, $id, $this->title);
		$this->redirect('struktur_organisasi');
	}

	public function delete($x)
	{
		$id     = $this->base64url_decode($x);
		$model  = $this->loadModel($this->model);
		$result = $model->mdelete($this->table, $this->primaryKey, $id, $this->title);
		return $result;
	}

	public function showtreeorg($id)
	{
		$data             = array();
		$model            = $this->loadModel($this->model);
		static $all_data  =  array();
		$all_data         =  $model->listarray($all_data, $id);
		
		if(count($all_data) != 0){
			$imp              = implode(",", $all_data);
			$data['dtseries'] = $model->show_series($imp); 
			$data['dtnodes']  = $model->show_nodes($imp, $id);

		} else {
			$data['dtseries'] = array(); 
			$data['dtnodes']  = array();
			
		}

		return json_encode($data,JSON_NUMERIC_CHECK);
	}

	public function tree($id)
	{
		global $config;

		$model  = $this->loadModel($this->model);
		
		$result = $model->show_groups();

		while ($row = $model->fetch_object($result)) {
			$data[$row->parent_id][] = $row;
		}

		$groups = $this->get_groups($data);
		echo (json_encode($groups));
	}

	public function get_groups($data, $parent = 0) 
	{
		static $i = 1;
		$datas = array();
		if (isset($data[$parent])) {
			foreach ($data[$parent] as $v) {
				$child               = $this->get_groups($data, $v->id);
				$row['key']          = $this->base64url_encode($v->id);
				$row['id']           = $v->id;
				$row['title']        = $v->title;
				$row['nama_lengkap'] = $v->nama_lengkap;
				$row['nrp_nip']      = $v->nrp_nip;
				$row['pangkat']      = $v->nm_pangkat;
				$row['korps']        = $v->korps;
				$row['keterangan']   = $v->keterangan;
				$row['parent_id']    = (int) $v->parent_id;
				$row['selected']     = boolval( $v->permission_a );
				$row['expanded']     = false;
				$row['folder']       = false;
				$row['extraClasses'] = "";
				$row['tooltip']      = $v->description;
				$row['children']     = array();
				if ($child) {          
					$row['children']     =  $child;
				}
				array_push($datas,$row);
			}
			return $datas;
		} else {
			return false;
		}
	}

	function gets_kode()
	{
		$id    = $_REQUEST['groups'];
		$model = $this->loadModel($this->model);
		$data  = $model->mget_kode($id);
		echo json_encode($data);
	} 


}