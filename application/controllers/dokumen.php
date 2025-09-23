<?php



class Dokumen extends Controller {



	private $table      = "tbl_dokumen";

	private $primaryKey = "autono";

	private $model      = "Dokumen_model";

	private $menu       = "Transaksi";

	private $title      = "Manajemen Data";

	private $curl       = BASE_URL."dokumen";

	



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

		$template            = $this->loadView('dokumen_view');

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

		$template            = $this->loadView('dokumen_view');

		$template->set('data', $data);

		$template->render();

	}



	function get($x = null)

	{

		$request    = $_REQUEST;

		$id         = $this->base64url_decode($x);

		$model      = $this->loadModel($this->model);

		$columns = array(

			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'nama_kegiatan',  'dt' => 1 ),
			array( 'db' => 'lokasi',  'dt' => 2 ),
			array( 'db' => 'jenis_media',  'dt' => 3 ),
			array( 'db' => 'file_dokumen',  'dt' => 4 ),
			array( 'db' => 'tanggal',  'dt' => 5 ),
			array( 'db' => 'narasi',  'dt' => 6 ),
			array( 'db' => 'complete',  'dt' => 7 ),
			array( 'db' => 'created_by',   'dt' => 8 ),
			array( 'db' => 'keterangan',   'dt' => 9 ),
			array( 'db' => 'autocode',  'dt' => 10 ),
			array( 'db' => 'nama_project',  'dt' => 11 )

		);


		if($x){

			$result  = $model->mget_detail($request, $this->table, $this->primaryKey, $columns, $id);

		} else {

			$result  = $model->mget_foto($request, $this->table, $this->primaryKey, $columns);

		}



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
			array( 'db' => 'subdir',   'dt' => 6 ),
        	array( 'db' => 'created_by',   'dt' => 7 ),
        	array( 'db' => 'structured',   'dt' => 8 ),
        	array( 'db' => 'dir',   'dt' => 9 )
		);

		$model   = $this->loadModel($this->model);
		$result  = $model->getfiles($request, $sTable, $primaryKey, $columns, $id, $y);

		$row = json_encode($result);

		return $row;
	}



	public function add($x = null)

	{

		$model               = $this->loadModel($this->model);

		$data                = array();

		$data['breadcrumb1'] = $this->menu;

		$data['title']       = $this->title;

		$data['action']      = 'Upload Data';

		$data['curl']	     = $this->curl;

		$data['encode']	     = $x;

		//$data['provinsi']	 = $model->get_provinsi();
		$data['project']	     = $model->get_project();

		$data['team']	     = $model->get_team();

		$data['kondisi']	 = $model->get_kondisi();

		$data['kategori']	 = $model->get_kategori();
		
		$data['sub_kategori']	 = $model->get_sub_kategori();

		// error_log("sub : " . json_encode($data['sub_kategori']));	
		$data['personel']	 = $model->get_personel();

		$data['fotografer']	 = $model->get_fotografer();

		$data['satker']	     = $model->get_satker();

		$data['kamera']	     = $model->get_kamera();

		$data['media']	     = $model->get_media();

		$template            = $this->loadView('dokumen_add');

		$template->set('data', $data);

		$template->render();

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
		
		// $data['provinsi']      = $model->get_provinsiedit($id);
		
		$data['kategori']      = $model->get_kategoriedit($id);
		
		$data['sub_kategori']      = $model->get_subkategoriedit($id);
		
		$data['team']      = $model->get_teamedit($id);

		$data['kondisi']	   = $model->get_kondisiedit($id);
		
		$data['media']         = $model->get_mediaedit($id);

		$data['project']         = $model->get_projectedit($id);

		$data['kamera']	       = $model->get_kameraedit($id);
		
		$data['personel']      = $model->get_personeledit($id);

		$data['fotografer']    = $model->get_fotograferedit($id);
		
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
		// $data['parent_id']     = $this->base64url_decode($x) ;
    	// $data['parent_id']     = 0 ;
		$data['nama_kegiatan'] = $model->escapeString($_REQUEST['nama_kegiatan']) ;
		$data['project'] = $model->escapeString($_REQUEST['project']) ;
		$data['jenis_media']   = $model->escapeString($_REQUEST['jenis_media']) ;
		$data['kondisi_media'] = $model->escapeString($_REQUEST['kondisi_media']) ;
		$data['no_card']       = $model->escapeString($_REQUEST['no_card']) ;
		$data['kamera']        = $model->escapeString($_REQUEST['kamera']) ;
		$data['lokasi']        = $model->escapeString($_REQUEST['lokasi']) ;
		$data['keterangan']        = $model->escapeString($_REQUEST['keterangan']) ;
		$data['narasi']        = $model->escapeString($_REQUEST['narasi']) ;
		$data['tanggal']       = $model->escapeString($_REQUEST['tanggal']) ;
		$data['complete']      = $model->escapeString($_REQUEST['complete']) ;		
		$data['file_dokumen']  = !empty($_FILES['file_dokumen']['name'][0]) ?  1 : 0;
		$data['autocode']      = $model->autocode($this->table, "DOC-");	

		$jkategori             = count($_REQUEST['kategori']);
		$jsubkategori          = count($_REQUEST['sub_kategori']);
		$jteam             	   = count($_REQUEST['team']);
		$jlokasi               = count($_REQUEST['provinsi']);
		$jpersonel             = count($_REQUEST['personel']);	
		$jfotografer           = count($_REQUEST['fotografer']);	
		$jsatker               = count($_REQUEST['kotama_satker']);			
		$media                 = $model->getval("ref_media", 'direktori', 'autocode', $data['jenis_media']);
		$result                = $model->msave($this->table, $data, $this->title);
		$lastid                = $result['id'];

		for ($i=0; $i < $jteam ; $i++) { 
			$team['parent_id']       = $lastid;
			$team['kd_pegawai']     = $model->escapeString($_REQUEST['team'][$i]);
			$team['parent_autocode'] = $data['autocode'];
			$teamresult              = $model->msave("tbl_dokumen_team", $team, $this->title);
		}

		for ($i=0; $i < $jkategori ; $i++) { 
			$category['parent_id']       = $lastid;
			$category['kd_kategori']     = $model->escapeString($_REQUEST['kategori'][$i]);
			$category['parent_autocode'] = $data['autocode'];
			$categoryresult              = $model->msave("tbl_dokumen_kategori", $category, $this->title);
		}

		for ($i=0; $i < $jsubkategori ; $i++) { 
			$subcategory['parent_id']       = $lastid;
			$subcategory['kd_sub_kategori']     = $model->escapeString($_REQUEST['sub_kategori'][$i]);
			$subcategory['parent_autocode'] = $data['autocode'];
			$subcategoryresult              = $model->msave("tbl_dokumen_sub_kategori", $subcategory, $this->title);
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

		for ($f=0; $f < $jfotografer ; $f++) { 
			$fotografer['parent_id']       = $lastid;
			$fotografer['kd_personel']     = $model->escapeString($_REQUEST['fotografer'][$f]);
			$fotografer['parent_autocode'] = $data['autocode'];
			$fotograferresult              = $model->msave("tbl_dokumen_fotografer", $fotografer, $this->title);
		}

		# Insert files
		$date      = explode("-", $data['tanggal']);
		$tahun     = $date[0];
		$bulan     = strtoupper($model->get_bulan($date[1]));
		$tgl       = $model->format_tanggal($data['tanggal']);
		$kegiatan  = trim($data['nama_kegiatan']);
		$directory = $tahun."/".$bulan."/".$tgl."/".$kegiatan;

		$files1					 = array();
		$files1['dir'] 			 = $directory;
		$files1['subdir'] 		 = trim($_SESSION['username']);
		if(!empty($_FILES['file_dokumen']['name'][0])) {
		    $file_ary1 = $model->reArrayFiles($_FILES['file_dokumen']);
		    foreach ($file_ary1 as $file1) {
				$files1['kode_parent'] = $data['autocode'];
				$files1['parent_id']   = $lastid;
            	$files1['nama_file']   = $file1['name'];
				$files1['tipe_file']   = $file1['type'];
				$files1['ukuran']      = $file1['size'];
				$files1['ftable']      = $this->table;
				$files1['structured']  = 1;

				if(!empty($file1['name'])){ $model->savefile($files1); } 
		    }
		}
		# Upload file
		if(isset($_FILES['file_dokumen'])){ $model->uploadsliput($data['tanggal'], $_FILES['file_dokumen'], trim($data['nama_kegiatan']), $files1['subdir']); }

		if($x){

			$this->redirect('dokumen/detail/'.$x);

		} else {

			$this->redirect('dokumen/add');

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
		$data['project'] = $model->escapeString($_REQUEST['project']) ;
		$data['jenis_media']   = $model->escapeString($_REQUEST['jenis_media']) ;
		$data['kondisi_media'] = $model->escapeString($_REQUEST['kondisi_media']) ;
		$data['no_card']       = $model->escapeString($_REQUEST['no_card']) ;
		$data['kamera']        = $model->escapeString($_REQUEST['kamera']) ;
		$data['lokasi']        = $model->escapeString($_REQUEST['lokasi']) ;
		$data['keterangan']        = $model->escapeString($_REQUEST['keterangan']) ;
		$data['narasi']        = $model->escapeString($_REQUEST['narasi']) ;
		$data['tanggal']       = $model->escapeString($_REQUEST['tanggal']) ;	
		$data['complete']      = $model->escapeString($_REQUEST['complete']) ;	

		$jkategori             = count($_REQUEST['kategori']);
		$jsubkategori          = count($_REQUEST['sub_kategori']);
		$jteam             = count($_REQUEST['team']);
		$jlokasi               = count($_REQUEST['provinsi']);
		$jpersonel             = (!empty($_REQUEST['personel']) ?  count($_REQUEST['personel']) : 0);	
		$jfotografer           = (!empty($_REQUEST['fotografer']) ?  count($_REQUEST['fotografer']) : 0);
		$jsatker               = count($_REQUEST['kotama_satker']);	
		
		$result                = $model->mupdate($this->table, $data, $this->primaryKey, $id, $this->title);

		// Reset dokumen child hanya jika ada datanya
		if ($model->getval("tbl_dokumen_wilayah", "parent_id", "parent_id", $id)) {
			$reset_lokasi = $model->execute("DELETE FROM tbl_dokumen_wilayah WHERE parent_id = $id");
		}
		if ($model->getval("tbl_dokumen_personel", "parent_id", "parent_id", $id)) {
			$reset_personel = $model->execute("DELETE FROM tbl_dokumen_personel WHERE parent_id = $id");
		}
		if ($model->getval("tbl_dokumen_kategori", "parent_id", "parent_id", $id)) {
			$reset_kategori = $model->execute("DELETE FROM tbl_dokumen_kategori WHERE parent_id = $id");
		}
		if ($model->getval("tbl_dokumen_sub_kategori", "parent_id", "parent_id", $id)) {
			$reset_kategori = $model->execute("DELETE FROM tbl_dokumen_sub_kategori WHERE parent_id = $id");
		}
		if ($model->getval("tbl_dokumen_team", "parent_id", "parent_id", $id)) {
			$reset_team = $model->execute("DELETE FROM tbl_dokumen_team WHERE parent_id = $id");
		}
		if ($model->getval("tbl_dokumen_satker", "parent_id", "parent_id", $id)) {
			$reset_satker = $model->execute("DELETE FROM tbl_dokumen_satker WHERE parent_id = $id");
		}

		for ($i=0; $i < $jteam ; $i++) { 
			$team['parent_id']       = $id;
			$team['kd_pegawai']     = $model->escapeString($_REQUEST['team'][$i]);
			$team['parent_autocode'] = $autocode;
			$teamresult              = $model->msave("tbl_dokumen_team", $team, $this->title);
		}
		for ($i=0; $i < $jkategori ; $i++) { 
			$category['parent_id']       = $id;
			$category['kd_kategori']     = $model->escapeString($_REQUEST['kategori'][$i]);
			$category['parent_autocode'] = $autocode;
			$categoryresult              = $model->msave("tbl_dokumen_kategori", $category, $this->title);
		}

		for ($i=0; $i < $jsubkategori ; $i++) { 
			$subcategory['parent_id']       = $id;
			$subcategory['kd_sub_kategori']     = $model->escapeString($_REQUEST['sub_kategori'][$i]);
			$subcategory['parent_autocode'] = $autocode;
			$subcategoryresult              = $model->msave("tbl_dokumen_sub_kategori", $subcategory, $this->title);
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

		for ($f=0; $f < $jfotografer ; $f++) { 
			$fotografer['parent_id']       = $lastid;
			$fotografer['kd_personel']     = $model->escapeString($_REQUEST['fotografer'][$f]);
			$fotografer['parent_autocode'] = $data['autocode'];
			$fotograferresult              = $model->msave("tbl_dokumen_fotografer", $fotografer, $this->title);
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
            	$files1['nama_file']   = $file1['name'];
				//$files1['nama_file']   = $this->randName($file1['name']);
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


	public function delete($x)

	{

		$id                 = $this->base64url_decode($x);

		$model              = $this->loadModel($this->model);

		$result             = $model->mdelete($this->table, $this->primaryKey, $id, $this->title);

		return $result;

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

		$input['parent_id']    = $id;

		$input['views']        = 1;

		$model->msave("ref_views", $input, 'Views Count'); 
		
		// $data['provinsi']      = $model->get_provinsiedit($id);
		
		// $data['kategori']      = $model->get_kategoriedit($id);

		// $data['kondisi']	   = $model->get_kondisiedit($id);
		
		// $data['media']         = $model->get_mediaedit($id);

		// $data['kamera']	       = $model->get_kameraedit($id);
		
		$data['personel']      = $model->get_personeledit($id);

		$data['views']         = $model->get_views($id);
		
		// $data['kotama_satker'] = $model->get_satkeredit($id);

		$data['attch']         = $model->get_file_attachment($id);
		
		$data['curl']          = $this->curl;
		
		// $data['child']         = $uri->segment(5);

		
		
		$data['aadata']        = $model->get_dokumen($this->table, $this->primaryKey, $id);

		
		
		$template              = $this->loadView('dokumen_info');

		$template->set('data', $data);

		$template->render();

	}

	public function uploadfoto($x = null)

	{

		$data                  = array();
		
		$id                    = $this->base64url_decode($x);
		
		$model                 = $this->loadModel($this->model);
	
		$autocode              = $model->getval($this->table, 'autocode', 'autono', $id);

		# Insert files


		$dt        = $model->getval($this->table, 'tanggal', 'autono', $id);
		$date      = explode("-", $dt);
		$tahun     = $date[0];
		$bulan     = strtoupper($model->get_bulan($date[1]));
		$tgl       = $model->format_tanggal($dt);
		$kegiatan  = trim($model->getval($this->table, 'nama_kegiatan', 'autono', $id));
		$directory = $tahun."/".$bulan."/".$tgl."/".$kegiatan;

		//echo $dt; exit;


		$files1					 = array();
		$files1['dir'] 			 = $directory;
		$files1['subdir'] 		 = trim($_SESSION['username']);
		if(!empty($_FILES['file_video']['name'][0])) {
		    $file_ary1 = $model->reArrayFiles($_FILES['file_video']);
		    foreach ($file_ary1 as $file1) {
				$files1['kode_parent'] = $autocode;
				$files1['parent_id']   = $id;
            	$files1['nama_file']   = $file1['name'];
				$files1['structured']  = 1;
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
		if(isset($_FILES['file_video'])){ $model->uploads($files1['dir'], $_FILES['file_video'], "", $files1['subdir']); }


		// $this->redirect('dokumen_video');
		return true;
		

	}

	function createZipArchive($files = array(), $destination = '', $overwrite = false) {

	   if(file_exists($destination) && !$overwrite) { return false; }

	   $validFiles = array();
	   if(is_array($files)) {
	      foreach($files as $file) {
	         if(file_exists($file)) {
	            $validFiles[] = $file;
	         }
	      }
	   }

	   if(count($validFiles)) {
	      $zip = new ZipArchive();
	      if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) == true) {
	         foreach($validFiles as $file) {
	         	$exp = explode("/", $file);
	            $zip->addFile($file, $exp[6]);
	         }
	         $zip->close();
	         return file_exists($destination);
	      }else{
	          return false;
	      }
	   }else{
	      return false;
	   }
	}

	function createZipArchivenew($files = array(), $destination = '', $overwrite = false) {

	   if(file_exists($destination) && !$overwrite) { return false; }

	   $validFiles = array();
	   if(is_array($files)) {
	      foreach($files as $file) {
	         if(file_exists($file)) {
	            $validFiles[] = $file;
	         }
	      }
	   }

	   if(count($validFiles)) {
	      $zip = new ZipArchive();
	      if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) == true) {
	         foreach($validFiles as $file) {
	         	$exp = explode("/", $file);
	            $zip->addFile($file, $exp[8]);
	         }
	         $zip->close();
	         return file_exists($destination);
	      }else{
	          return false;
	      }
	   }else{
	      return false;
	   }
	}

	public function zipdown()
	{
		$model    = $this->loadModel($this->model);
		$autono   = implode(", ", $_REQUEST['files']);
		$datafile =  $model->query("SELECT GROUP_CONCAT(autono SEPARATOR '-') as te, IF(structured = 0, (CONCAT('static/files/bahan/dokumen/bahan/', kode_parent,'/',subdir,'/',nama_file)), (CONCAT('static/files/bahan/', dir,'/',subdir,'/',nama_file))  ) AS direktori  FROM vt_files WHERE autono IN ($autono)");
		
		echo json_encode($datafile);		
	}

	public function zipdownx()
	{
		$uri      = $this->loadHelper('Url_helper');
		$model    = $this->loadModel($this->model);
		$dt = $uri->segment(count(explode('/', trim($_SERVER['REQUEST_URI'], '/'))));
		$autono   = str_replace("-", ",", $dt);
		$zip_name = "foto_download_".time().".zip";
		$datafile =  $model->query("SELECT structured, IF(structured = 0, (CONCAT('static/files/bahan/dokumen/bahan/', kode_parent,'/',subdir,'/',nama_file)), (CONCAT('static/files/bahan/', dir, '/', subdir, '/', nama_file))  ) AS direktori  FROM vt_files WHERE autono IN ($autono)");
		$files    = array();
		foreach ($datafile as $key => $value) {
			array_push($files, $value['direktori']);
		}

		if($datafile[0]['structured'] == 0){
			$result = $this->createZipArchive($files, $zip_name, false);
		} else {
			$result = $this->createZipArchivenew($files, $zip_name, false);
		}
		
		header('Content-Type: application/zip');
		header("Content-Disposition: attachment; filename=$zip_name");
		header("Content-Length: ".filesize($zip_name));
		header("Cache-control: private"); 
		readfile($zip_name);

		unlink($zip_name);
		exit();
	}

    

}