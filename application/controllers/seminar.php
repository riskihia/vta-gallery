<?php



class Seminar extends Controller {



	private $table      = "ref_kategori";

	private $primaryKey = "autono";

	private $model      = "Kategori_model";

	private $menu       = "Binfung";

	private $title      = "Seminar dan Pelatihan";

	private $curl       = BASE_URL."kategori";

	



	public function __construct()

    {

        $session = $this->loadHelper('Session_helper');

        if(!$session->get('username')){

        	$this->redirect('auth/login');

        }

    }

	

	function index($x = null)

	{

		$data                = array();

		$data['breadcrumb1'] = $this->menu;

		$data['title']       = $this->title;

		$data['curl']	     = $this->curl;

		$data['encode']	     = $x;

		$template            = $this->loadView('seminar_view');

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

		$template            = $this->loadView('kategori_view');

		$template->set('data', $data);

		$template->render();

	}



	function get($x = null)

	{

		$request    = $_REQUEST;

		$id         = $this->base64url_decode($x);

		$columns = array(

			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),

			array( 'db' => 'nama_kategori',  'dt' => 1 ),array( 'db' => 'keterangan',  'dt' => 2 ),

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

		$template            = $this->loadView('kategori_add');

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

		$template            = $this->loadView('kategori_edit');

		$template->set('data', $data);

		$template->render();

	}



	public function save($x = null)

	{

		$data                 = array();

		$model                = $this->loadModel($this->model);


		$data['nama_kategori'] = htmlspecialchars($_REQUEST['nama_kategori']) ;
		$data['keterangan'] = htmlspecialchars($_REQUEST['keterangan']) ;


		$data['autocode']     = $model->autocode($this->table, "CAT-");	

		$result               = $model->msave($this->table, $data, $this->title);

		if($x){

			$this->redirect('kategori/detail/'.$x);

		} else {

			$this->redirect('kategori');

		}

	}



	public function update($x)

	{

		$data               = array();

		$id                 = $this->base64url_decode($x);

		$model              = $this->loadModel($this->model);

		$uri                = $this->loadHelper('Url_helper');

		$child              = $uri->segment(5);

		$data['nama_kategori'] = htmlspecialchars($_REQUEST['nama_kategori']) ;
		$data['keterangan'] = htmlspecialchars($_REQUEST['keterangan']) ;
	

		$result             = $model->mupdate($this->table, $data, $this->primaryKey, $id, $this->title);
		if($child){

			$this->redirect('kategori/detail/'.$child);

		} else {

			$this->redirect('kategori');

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