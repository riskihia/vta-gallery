<?php



class Messages extends Controller {



	private $table      = "tbl_download_personel";

	private $primaryKey = "autono";

	private $model      = "Messages_model";

	private $menu       = "Messages";

	private $title      = "Dokumen";

	private $curl       = BASE_URL."messages";

	



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

		$template            = $this->loadView('messages_view');

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

		$template            = $this->loadView('messages_view');

		$template->set('data', $data);

		$template->render();

	}



	function get()

	{

		$request    = $_REQUEST;

		$id         = $this->base64url_decode($x);

		$columns = array(

			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'nama_lengkap',  'dt' => 1 ),
			array( 'db' => 'pangkat',  'dt' => 2 ),
			array( 'db' => 'nrp',  'dt' => 3 ),
			array( 'db' => 'jabatan',  'dt' => 4 ),
			array( 'db' => 'sapprove',  'dt' => 5 ),
			array( 'db' => 'korps',  'dt' => 6 ),
			array( 'db' => 'keperluan',   'dt' => 7 ),
			array( 'db' => 'created_on',   'dt' => 8 ),
			array( 'db' => 'level_id',   'dt' => 9 ),
			array( 'db' => 'created_by',   'dt' => 10 )

		);

		$model   = $this->loadModel($this->model);

		$result  = $model->mget($request, $this->table, $this->primaryKey, $columns);

		return json_encode($result);

	}


	function getfile($x)
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

		$model   = $this->loadModel($this->model);
		$result  = $model->getfiles($request, $sTable, $primaryKey, $columns, $id);

		$row = json_encode($result);

		return $row;
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

		$data['provinsi']	 = $model->get_provinsi();

		$data['kondisi']	 = $model->get_kondisi();

		$data['kategori']	 = $model->get_kategori();

		$data['personel']	 = $model->get_personel();

		$data['satker']	     = $model->get_satker();

		$data['kamera']	     = $model->get_kamera();

		$data['media']	     = $model->get_media();

		$template            = $this->loadView('dokumen_add');

		$template->set('data', $data);

		$template->render();

	}

	public function approved($x)
	{
		$id                    = $this->base64url_decode($x);
		$model                 = $this->loadModel($this->model);

		$update                = $model->approve($id);
	}



	public function edit($x)

	{
		
		$id                    = $this->base64url_decode($x);
		
		$model                 = $this->loadModel($this->model);
		
		$uri                   = $this->loadHelper('Url_helper');
		
		$data                  = array();
		
		$data['breadcrumb1']   = $this->menu;
		
		$data['title']         = $this->title;
		
		$data['action']        = 'Edit';
		
		$data['encode']        = $x;
		
		$data['provinsi']      = $model->get_provinsiedit($id);
		
		$data['kategori']      = $model->get_kategoriedit($id);

		$data['kondisi']	   = $model->get_kondisiedit($id);
		
		$data['media']         = $model->get_mediaedit($id);

		$data['kamera']	       = $model->get_kameraedit($id);
		
		$data['personel']      = $model->get_personeledit($id);
		
		$data['kotama_satker'] = $model->get_satkeredit($id);

		$data['attch']         = $model->get_file_attachment($id);
		
		$data['curl']          = $this->curl;
		
		$data['child']         = $uri->segment(5);
		
		$data['aadata']        = $model->get($this->table, $this->primaryKey, $id);
		
		$template              = $this->loadView('dokumen_edit');

		$template->set('data', $data);

		$template->render();

	}



	public function save($x = null)

	{
		
		$data                  = array();	
		$model                 = $this->loadModel($this->model);
		$data['parent_id']     = $this->base64url_decode($x) ;
		$data['nama_kegiatan'] = $model->escapeString($_REQUEST['nama_kegiatan']) ;
		$data['jenis_media']   = $model->escapeString($_REQUEST['jenis_media']) ;
		$data['kondisi_media'] = $model->escapeString($_REQUEST['kondisi_media']) ;
		$data['no_card']       = $model->escapeString($_REQUEST['no_card']) ;
		$data['fotografer']    = $model->escapeString($_REQUEST['fotografer']) ;
		$data['kamera']        = $model->escapeString($_REQUEST['kamera']) ;
		$data['lokasi']        = $model->escapeString($_REQUEST['lokasi']) ;
		$data['narasi']        = $model->escapeString($_REQUEST['narasi']) ;
		$data['tanggal']       = $model->escapeString($_REQUEST['tanggal']) ;
		$data['complete']      = $model->escapeString($_REQUEST['complete']) ;		
		$data['file_dokumen']  = !empty($_FILES['file_dokumen']['name'][0]) ?  1 : 0;
		$data['autocode']      = $model->autocode($this->table, "DOC-");	

		$jkategori             = count($_REQUEST['kategori']);
		$jlokasi               = count($_REQUEST['provinsi']);
		$jpersonel             = count($_REQUEST['personel']);	
		$jsatker               = count($_REQUEST['kotama_satker']);			
		$media                 = $model->getval("ref_media", 'direktori', 'autocode', $data['jenis_media']);
		$result                = $model->msave($this->table, $data, $this->title);
		$lastid                = $result['id'];

		for ($i=0; $i < $jkategori ; $i++) { 
			$category['parent_id']       = $lastid;
			$category['kd_kategori']     = $model->escapeString($_REQUEST['kategori'][$i]);
			$category['parent_autocode'] = $data['autocode'];
			$categoryresult              = $model->msave("tbl_dokumen_kategori", $category, $this->title);
		}

		for ($t=0; $t < $jlokasi ; $t++) { 
			$location['parent_id']       = $lastid;
			$location['kode']            = $model->escapeString($_REQUEST['provinsi'][$t]);
			$location['parent_autocode'] = $data['autocode'];
			$locationresult              = $model->msave("tbl_dokumen_wilayah", $location, $this->title);
		}

		for ($d=0; $d < $jpersonel ; $d++) { 
			$personel['parent_id']       = $lastid;
			$personel['kd_personel']     = $model->escapeString($_REQUEST['personel'][$d]);
			$personel['parent_autocode'] = $data['autocode'];
			$personelresult              = $model->msave("tbl_dokumen_personel", $personel, $this->title);
		}

		for ($e=0; $e < $jsatker ; $e++) { 
			$satker['parent_id']       = $lastid;
			$satker['kd_satker']       = $model->escapeString($_REQUEST['kotama_satker'][$e]);
			$satker['parent_autocode'] = $data['autocode'];
			$satkerresult              = $model->msave("tbl_dokumen_satker", $satker, $this->title);
		}

		# Insert files
		$files1					 = array();
		$files1['dir'] 			 = "dokumen";
		$files1['subdir'] 		 = $media;
		if(!empty($_FILES['file_dokumen']['name'][0])) {
		    $file_ary1 = $model->reArrayFiles($_FILES['file_dokumen']);
		    foreach ($file_ary1 as $file1) {
				$files1['kode_parent'] = $data['autocode'];
				$files1['parent_id']   = $lastid;
				$files1['nama_file']   = $this->randName($file1['name']);
				$files1['tipe_file']   = $file1['type'];
				$files1['ukuran']      = $file1['size'];
				$files1['ftable']      = $this->table;

				if(!empty($file1['name'])){ $model->savefile($files1); } 
		    }
		}
		# Upload file
		if(isset($_FILES['file_dokumen'])){ $model->uploads('dokumen', $_FILES['file_dokumen'], $data['autocode'], $files1['subdir']); }

		if($x){

			$this->redirect('dokumen/detail/'.$x);

		} else {

			$this->redirect('dokumen');

		}

	}



	public function update($x)

	{

		$data                  = array();
		
		$id                    = $this->base64url_decode($x);
		
		$model                 = $this->loadModel($this->model);
		
		$uri                   = $this->loadHelper('Url_helper');
		
		$child                 = $uri->segment(5);
		
		$autocode              = $model->getval($this->table, 'autocode', 'autono', $id);

		$data['parent_id']     = $this->base64url_decode($x) ;
		$data['nama_kegiatan'] = $model->escapeString($_REQUEST['nama_kegiatan']) ;
		$data['jenis_media']   = $model->escapeString($_REQUEST['jenis_media']) ;
		$data['kondisi_media'] = $model->escapeString($_REQUEST['kondisi_media']) ;
		$data['no_card']       = $model->escapeString($_REQUEST['no_card']) ;
		$data['fotografer']    = $model->escapeString($_REQUEST['fotografer']) ;
		$data['kamera']        = $model->escapeString($_REQUEST['kamera']) ;
		$data['lokasi']        = $model->escapeString($_REQUEST['lokasi']) ;
		$data['narasi']        = $model->escapeString($_REQUEST['narasi']) ;
		$data['tanggal']       = $model->escapeString($_REQUEST['tanggal']) ;	
		$data['complete']      = $model->escapeString($_REQUEST['complete']) ;	

		$jkategori             = count($_REQUEST['kategori']);
		$jlokasi               = count($_REQUEST['provinsi']);
		$jpersonel             = (!empty($_REQUEST['personel']) ?  count($_REQUEST['personel']) : 0);	
		$jsatker               = count($_REQUEST['kotama_satker']);	
		
		$result                = $model->mupdate($this->table, $data, $this->primaryKey, $id, $this->title);

		// Reset dokumen child
		$reset_lokasi   = $model->execute("DELETE FROM tbl_dokumen_wilayah WHERE parent_id = $id");
		$reset_personel = $model->execute("DELETE FROM tbl_dokumen_personel WHERE parent_id = $id");
		$reset_kategori = $model->execute("DELETE FROM tbl_dokumen_kategori WHERE parent_id = $id");
		$reset_satker   = $model->execute("DELETE FROM tbl_dokumen_satker WHERE parent_id = $id");

		for ($i=0; $i < $jkategori ; $i++) { 
			$category['parent_id']       = $id;
			$category['kd_kategori']     = $model->escapeString($_REQUEST['kategori'][$i]);
			$category['parent_autocode'] = $autocode;
			$categoryresult              = $model->msave("tbl_dokumen_kategori", $category, $this->title);
		}

		for ($t=0; $t < $jlokasi ; $t++) { 
			$location['parent_id']       = $id;
			$location['kode']            = $model->escapeString($_REQUEST['provinsi'][$t]);
			$location['parent_autocode'] = $autocode;
			$locationresult              = $model->msave("tbl_dokumen_wilayah", $location, $this->title);
		}

		for ($d=0; $d < $jpersonel ; $d++) { 
			$personel['parent_id']       = $id;
			$personel['kd_personel']     = $model->escapeString($_REQUEST['personel'][$d]);
			$personel['parent_autocode'] = $autocode;
			$personelresult              = $model->msave("tbl_dokumen_personel", $personel, $this->title);
		}

		for ($e=0; $e < $jsatker ; $e++) { 
			$satker['parent_id']       = $id;
			$satker['kd_satker']       = $model->escapeString($_REQUEST['kotama_satker'][$e]);
			$satker['parent_autocode'] = $autocode;
			$satkerresult              = $model->msave("tbl_dokumen_satker", $satker, $this->title);
		}

		# Insert files
		$media                   = $model->getval("ref_media", 'direktori', 'autocode', $data['jenis_media']);
		$files1					 = array();
		$files1['dir'] 			 = "dokumen";
		$files1['subdir'] 		 = $media;
		if(!empty($_FILES['file_dokumen']['name'][0])) {
		    $file_ary1 = $model->reArrayFiles($_FILES['file_dokumen']);
		    foreach ($file_ary1 as $file1) {
				$files1['kode_parent'] = $autocode;
				$files1['parent_id']   = $id;
				$files1['nama_file']   = $this->randName($file1['name']);
				$files1['tipe_file']   = $file1['type'];
				$files1['ukuran']      = $file1['size'];
				$files1['ftable']      = $this->table;

				if(!empty($file1['name'])){ $model->savefile($files1); } 
		    }
		    # Update field dokumen
			$f1                 = array();
			$f1['file_dokumen'] = 1;
			$row1               = $model->mupdate($this->table,$f1, $this->primaryKey, $id, $this->title);
		}

		# Upload file
		if(isset($_FILES['file_dokumen'])){ $model->uploads('dokumen', $_FILES['file_dokumen'], $autocode, $files1['subdir']); }

		if($child){

			$this->redirect('dokumen/detail/'.$child);

		} else {

			$this->redirect('dokumen');

		}

	}

	public function savedownload($x)

	{
		
		$data                    = array();	
		$model                   = $this->loadModel($this->model);
		$data['parent_id']       = $this->base64url_decode($x) ;
		$autocode                = $model->getval($this->table, 'autocode', 'autono', $data['parent_id']);
		$data['parent_autocode'] = $autocode ;
		$data['nama_lengkap']    = $model->escapeString($_REQUEST['nama_lengkap']) ;
		$data['pangkat']         = $model->escapeString($_REQUEST['pangkat']) ;
		$data['nrp']             = $model->escapeString($_REQUEST['nrp']) ;
		$data['jabatan']         = $model->escapeString($_REQUEST['jabatan']) ;
		$data['telp']            = $model->escapeString($_REQUEST['telp']) ;
		$data['korps']           = $model->escapeString($_REQUEST['korps']) ;
		$data['keperluan']       = $model->escapeString($_REQUEST['keperluan']) ;
		$data['autocode']        = $model->autocode("tbl_download_personel", "DW-");	
		$jfile                   = count($_REQUEST['chkfile']);
		$result                  = $model->msave("tbl_download_personel", $data, "Personel download");
		$lastid                  = $result['id'];
		

		for ($i=0; $i < $jfile ; $i++) { 
			$filedown['parent_id']       = $lastid;
			$filedown['idfile']     	 = $model->escapeString($_REQUEST['chkfile'][$i]);
			$filedown['parent_autocode'] = $data['autocode'];
			$filedownresult              = $model->msave("tbl_download_file", $filedown, "File download");
		}

		// function zipFilesDownload($file_names,$archive_file_name,$file_path){
		// $zip = new ZipArchive();

		// if ($zip->open($archive_file_name, ZIPARCHIVE::CREATE )!==TRUE) {
		//   exit("cannot open <$archive_file_name>\n");
		// }

		// foreach($file_names as $files){
		//   $zip->addFile($file_path.$files,$files);
		// }

		// $zip->close();

		$id = $this->base64url_encode($lastid);
		$this->redirect('dokumen/request/'.$id);

	}

	public function request($x)

	{
		
		$id                    = $this->base64url_decode($x);
		
		$model                 = $this->loadModel($this->model);
		
		$uri                   = $this->loadHelper('Url_helper');
		
		$data                  = array();
		
		$data['breadcrumb1']   = $this->menu;
		
		$data['title']         = $this->title;
		
		$data['action']        = 'Request';
		
		$data['encode']        = $x;

		$data['aadata']        = $model->getrequest($id);
		
		$template              = $this->loadView('dokumen_request');

		$template->set('data', $data);

		$template->render();

	}


	public function delete($x)

	{

		$id                 = $this->base64url_decode($x);

		$model              = $this->loadModel($this->model);

		$result             = $model->mdelete($this->table, $this->primaryKey, $id, $this->title);

		return $result;

	}

	public function checkmsg()

	{

		$id                 = $this->base64url_decode($x);

		$model              = $this->loadModel($this->model);

		$result             = $model->check();

		return json_encode($result);

	}


	public function deletefile($x = null)
	{
		$data               = array();
		$id                 = $this->base64url_decode($x);
		$model              = $this->loadModel($this->model);
		$result             = $model->deletes_file($id);
		return $result;
	}

	public function download($key = null)
	{
		if($key){
			$id     = $this->base64url_decode($key);
			$model  = $this->loadModel($this->model);
			$data   = $model->getvalue("SELECT dir, kode_parent, subdir, nama_file FROM vt_files WHERE autono = $id");
			$path   = $data[0]."/".$data[1]."/".$data[2]."/";
			$result = $this->download_file($data[3], $path);

			return $result;
		} else {
			echo "Not found";
		}

	}


	public function info($x)

	{
		
		$id                    = $this->base64url_decode($x);
		
		$model                 = $this->loadModel($this->model);
		
		$uri                   = $this->loadHelper('Url_helper');
		
		$data                  = array();
		
		$data['breadcrumb1']   = $this->menu;
		
		$data['title']         = $this->title;
		
		$data['action']        = 'Info';
		
		$data['encode']        = $x;

		$data['pangkat']       = $model->get_pangkat();

		$data['korps']         = $model->get_korps();

		//$data['attch']         = $model->get_file_attachment($id);

		// $input['parent_id']    = $id;
		// $input['views']        = 1;
		//$model->msave("ref_views", $input, 'Views Count'); 
		
		// $data['provinsi']      = $model->get_provinsiedit($id);
		
		// $data['kategori']      = $model->get_kategoriedit($id);

		// $data['kondisi']	   = $model->get_kondisiedit($id);
		
		// $data['media']         = $model->get_mediaedit($id);

		// $data['kamera']	       = $model->get_kameraedit($id);
		
		$data['personel']      = $model->get_personeledit($id);

		$data['views']         = $model->get_views($id);
		
		// $data['kotama_satker'] = $model->get_satkeredit($id);

		$data['attch']         = $model->get_file_attachment($id);

		if(count($data['attch']) >= 1){
			$data['jdown'] = "";
		} else {
			$data['jdown'] = "disabled";
		}

		//$data['jdown'] = "".count($data['attch']);
		
		$data['curl']          = $this->curl;
		
		// $data['child']         = $uri->segment(5);

		
		
		$data['aadata']        = $model->get_dokumen($this->table, $this->primaryKey, $id);

		
		
		$template              = $this->loadView('dokumen_info');

		$template->set('data', $data);

		$template->render();

	}

    

}