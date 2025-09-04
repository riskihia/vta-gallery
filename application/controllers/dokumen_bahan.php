<?php



class Dokumen_bahan extends Controller {



	private $table      = "vt_files_storage";

	private $primaryKey = "autono";

	private $model      = "Dokumen_bahan_model";

	private $menu       = "Transaksi";

	private $title      = "Manajemen Storage";

	private $curl       = BASE_URL."dokumen_bahan";

	



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

		$template            = $this->loadView('dokumen_bahan_view');

		$template->set('data', $data);

		$template->render();

	}



	public function detail($x = null)

	{

		$data                = array();

		$data['breadcrumb1'] = $this->menu;

		$data['title']       = $this->title;

		$data['curl']	     = $this->curl;

		$data['encode']      = $x;

		$template            = $this->loadView('dokumen_bahan_view');

		$template->set('data', $data);

		$template->render();

	}



	function get()

	{
		$model   = $this->loadModel($this->model);
		$request    = $_REQUEST;

		$columns = array(

			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'nama_kegiatan',  'dt' => 1 ),
			array( 'db' => 'tanggal',  'dt' => 2 ),
			array( 'db' => 'keterangan',  'dt' => 3 )

		);



		

		$result  = $model->mget($request, 'tbl_dokumen_storage', $this->primaryKey, $columns);




		return json_encode($result);

	}


	function getfile($x, $y)
	{
		$id         = $this->base64url_decode($x);
		$request    = $_REQUEST;
		$primaryKey = "parent_id";
		$sTable     = "vt_files";
		$columns = array(
			array( 'db' => 'autono', 'dt' => 0 ),
			array( 'db' => 'nama_file',  'dt' => 1 ),
			array( 'db' => 'tipe_file',   'dt' => 2 ),
			array( 'db' => 'ukuran',   'dt' => 3 , 'formatter' => function( $d, $row ) { return number_format($d/1024). ' KB'; }),
			array( 'db' => 'keterangan',   'dt' => 4 ),
			array( 'db' => 'kode_parent',   'dt' => 5 ),
			array( 'db' => 'subdir',   'dt' => 6 )
		);

		$model   = $this->loadModel('Dokumen_model');
		$result  = $model->getfiles($request, $sTable, $primaryKey, $columns, $id, $y);

		$row = json_encode($result);

		return $row;
	}



	


	public function infox($tgl, $keg)

	{
		
		$model                 = $this->loadModel($this->model);
		
		$uri                   = $this->loadHelper('Url_helper');
		
		$data                  = array();
		
		$data['breadcrumb1']   = $this->menu;
		
		$data['title']         = $this->title;
		
		$data['action']        = 'Info';

		$tanggal = str_replace("+", " ", $tgl);

		$nama_kegiatan = str_replace("+", " ", $keg);

		$data['attch']         = $model->get_file_attachment($tanggal, $nama_kegiatan);

		$data['curl']          = $this->curl;
		
		$data['kegiatan']        = $nama_kegiatan;

		$data['tanggal']        = $tanggal;

		$template              = $this->loadView('dokumen_bahan_info');

		$template->set('data', $data);

		$template->render();

	}

	function info($tgl, $kegiatan)
	{
		$data                  = array();
		$model                 = $this->loadModel($this->model);
    	$tanggal               = str_replace("+", " ", $tgl);
		$nama_kegiatan         = str_replace("+", " ", $kegiatan);
		$data['page']          = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
		$data['limit']         = 18;
		$query                 = "SELECT * FROM vt_files_storage WHERE tanggal = '$tanggal' AND nama_kegiatan LIKE '%".$nama_kegiatan."%'  ORDER BY SUBSTRING_INDEX(nama_file, '.', -1)";	
		$resTotalLength        = $model->query("SELECT COUNT(FOUND_ROWS()) FROM `vt_files_storage` WHERE tanggal = '$tanggal' AND nama_kegiatan LIKE '%".$nama_kegiatan."%'");
		$data['total']         = $resTotalLength[0][0];
		$data['breadcrumb1']   = $this->menu;
		$data['title']         = $this->title;
		$data['curl']          = $this->curl;
    	$data['kegiatan']        = $nama_kegiatan;
        $data['tanggal']        = $tanggal;
		$data['pencarian']     = $model->pagination($query, $data['limit'], $data['page']);
		$data['number_paging'] = $model->createpaging($tgl, $kegiatan,$data['pencarian']['total'],$data['pencarian']['limit'], $data['pencarian']['page']);
		$template            = $this->loadView('dokumen_bahan_info');
		$template->set('data', $data);
		$template->render();
	}

	function infos()
	{
		$data                  = array();
		$model                 = $this->loadModel($this->model);
    	$tgl = $_GET['q1'];
    	$keg = $_GET['q2'];
    	$tanggal               = str_replace("+", " ", $tgl);
		$nama_kegiatan         = str_replace("+", " ", $keg);
        $data['kegiatan']        = $nama_kegiatan;
        $data['tanggal']        = $tanggal;
		$data['page']          = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
		$data['limit']         = 18;
		$query                 = "SELECT * FROM vt_files_storage WHERE tanggal = '$tanggal' AND nama_kegiatan LIKE '%".$nama_kegiatan."%'  ORDER BY SUBSTRING_INDEX(nama_file, '.', -1)";	
		$resTotalLength        = $model->query("SELECT COUNT(FOUND_ROWS()) FROM  `vt_files_storage` WHERE tanggal = '$tanggal' AND nama_kegiatan LIKE '%".$nama_kegiatan."%'");
		$data['total']         = $resTotalLength[0][0];
		$data['breadcrumb1']   = $this->menu;
		$data['title']         = $this->title;
		$data['curl']          = $this->curl;
		$data['pencarian']     = $model->pagination($query, $data['limit'], $data['page']);
		$data['number_paging'] = $model->createpaging($tgl, $keg, $data['pencarian']['total'],$data['pencarian']['limit'], $data['pencarian']['page']);
		$template            = $this->loadView('dokumen_bahan_info');
		$template->set('data', $data);
		$template->render();
	}

	public function download($key = null)
	{
		if($key){
			// $id     = $this->base64url_decode($key);
			$model  = $this->loadModel($this->model);
			$data   = $model->getvalue("SELECT dir, nama_kegiatan, autono FROM vt_files_storage WHERE autono = $key");
			$path   = $data[0];
			$result = $this->download_file_storage($path);
	//echo $path;exit;
			return $result;
		} else {
			echo "Not found";
		}

	}

	function download_file_storage($pathinfo)
	{
		if(!empty($pathinfo)){
			ignore_user_abort(true);
			set_time_limit(0); 
			$fullPath = $pathinfo;

			if ($fd = fopen ($fullPath, "r")) {
			    $fsize = filesize($fullPath);
			    $path_parts = pathinfo($fullPath);
			    $ext = strtolower($path_parts["extension"]);
			    switch ($ext) {
			        case "pdf":
			        header("Content-type: application/pdf");
			        header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); 
			        break;
			        
			        default;
			        header("Content-type: application/octet-stream");
			        header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
			        break;
			    }
			    header("Content-length: $fsize");
			    header("Cache-control: private"); 
			    while(!feof($fd)) {
			        $buffer = fread($fd, 2048);
			        echo $buffer;
			    }
			}
			fclose ($fd);
			exit;
		} else {
			$this->redirect('errors');
		}
		
	}

    

}