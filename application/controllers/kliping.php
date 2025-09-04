<?php



class Kliping extends Controller {



	private $table        = "tbl_kliping";
	
	private $table_detail = "tbl_kliping_news";
	
	private $primaryKey   = "autono";
	
	private $model        = "Kliping_model";
	
	private $menu         = "Kliping Manajemen";
	
	private $title        = "Kliping";
	
	private $curl         = BASE_URL."kliping";

    // private $ip           = "http://localhost:8008/";

	private $ip           = "http://localhost:8008/";



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

		$template            = $this->loadView('kliping_view');

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
			array( 'db' => 'autocode',   'dt' => 10 , 'formatter' => function( $d, $row ) { return "<code>#".$d."</code>"; } ),
			array( 'db' => 'publish',   'dt' => 11 )
		);



		$model   = $this->loadModel($this->model);

		if($x){

			$result  = $model->mget_detail($request, $this->table, $this->primaryKey, $columns, $id);

		} else {

			$result  = $model->mget($request, $this->table, $this->primaryKey, $columns);

		}



		return json_encode($result);

	}

	function getklipingnews($x)

	{

		$request    = $_REQUEST;

		$id         = $this->base64url_decode($x);

		$columns = array(

			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'title_news',  'dt' => 1 ),
			array( 'db' => 'link',  'dt' => 2 ),
			array( 'db' => 'media',  'dt' => 3 ),
			array( 'db' => 'date_news',  'dt' => 4 ),
			array( 'db' => 'image_link',  'dt' => 5 ),
			array( 'db' => 'image_caption',  'dt' => 6 ),
			array( 'db' => 'article_clean',  'dt' => 7 ),
			array( 'db' => 'id_berita',   'dt' => 8 )
		);

		$model   = $this->loadModel($this->model);

		$result  = $model->mget_detail($request, $this->table_detail, $this->primaryKey, $columns, $id);

		return json_encode($result);

	}

	function getklipingonline($x)

	{

		$request    = $_REQUEST;

		$id         = $this->base64url_decode($x);

		$columns = array(

			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'title_news',  'dt' => 1 ),
			array( 'db' => 'link',  'dt' => 2 ),
			array( 'db' => 'media',  'dt' => 3 ),
			array( 'db' => 'date_news',  'dt' => 4 ),
			array( 'db' => 'image_link',  'dt' => 5 ),
			array( 'db' => 'image_caption',  'dt' => 6 ),
			array( 'db' => 'article_clean',  'dt' => 7 ),
			array( 'db' => 'id_berita',   'dt' => 8 )
		);

		$model   = $this->loadModel($this->model);

		$result  = $model->mget_detail($request, "tbl_kliping_online", $this->primaryKey, $columns, $id);

		return json_encode($result);

	}


	function getfile($x, $tipes)
	{
		$id         = $this->base64url_decode($x);
		$request    = $_REQUEST;
		$primaryKey = "parent_id";
		$sTable     = "vt_files";
		$columns = array(
			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'nama_file',  'dt' => 1 ),
			array( 'db' => 'tipe_file',   'dt' => 2 ),
			array( 'db' => 'ukuran',   'dt' => 3 , 'formatter' => function( $d, $row ) { return number_format($d/1024). ' KB'; }),
			array( 'db' => 'keterangan',   'dt' => 4 ),
			array( 'db' => 'kode_parent',   'dt' => 5 ),
			array( 'db' => 'subdir',   'dt' => 6 )
		);

		$model   = $this->loadModel($this->model);
		$result  = $model->getfiles($request, "vt_files", "parent_id", $columns, $id, $tipes);

		$row = json_encode($result);

		return $row;
	}



	public function add()

	{

		$model               = $this->loadModel($this->model);

		$data                = array();

		$data['breadcrumb1'] = $this->menu;

		$data['title']       = $this->title;

		$data['action']      = 'Add';

		$data['curl']	     = $this->curl;

		$data['api_ip']      = $this->ip;
		
		$data['medianews']   = $model->getmedianews();

		$temp['parent_id']   = 0;

		$ds['created_by']    = $_SESSION['userid'];
		

		//echo $j;exit;
		if($ds['created_by']){
			$row                 = $model->getvalue("SELECT * FROM $this->table WHERE created_by = '".$ds['created_by']."' AND parent_id = 0");
			$j                   = count($row);
			if($row <> 0){
				if($row['parent_id'] <> 0){

					$rs             = $model->getvalue("SELECT * FROM $this->table WHERE autono = ".$row['autono']."");
					$data['nama_kegiatan'] = $rs['nama_kegiatan'];
					$data['encode']	       = $this->base64url_encode($rs['autono']);
					$data['nomor']	       = $rs['autono'];
				} else {
					$rs                    = $model->getvalue("SELECT * FROM $this->table WHERE autono = ".$row['autono']."");
					$data['nama_kegiatan'] = "Silahkan masukkan nama kegiatan";
					$data['encode']	       = $this->base64url_encode($rs['autono']);
					$data['nomor']	       = $rs['autono'];
				}
				
			} else {
				$result          = $model->msave($this->table, $temp, "Temp kliping");
				$data['id']      = $result['id'];
				$rs              = $model->getvalue("SELECT * FROM $this->table WHERE autono = ".$data['id']."");
				$data['nama_kegiatan'] = $rs['nama_kegiatan'];
				$data['encode']	       = $this->base64url_encode($rs['autono']);
			}
			
			
			
			
			
		} 


		// $data['encode']	     = $this->base64url_encode($data['id']);
		// $data['nomor']	     = $data['id'];


		$template            = $this->loadView('kliping_add');

		$template->set('data', $data);

		$template->render();

	}



	public function edit($x)

	{
		
		$id                    = $this->base64url_decode($x);
		
		$model                 = $this->loadModel($this->model);
		
		$data                  = array();
		
		$data['breadcrumb1']   = $this->menu;
		
		$data['title']         = $this->title;
		
		$data['action']        = 'Edit';
		
		$data['encode']        = $x;
		
		$data['api_ip']        = $this->ip;
		
		$data['medianews']     = $model->getmedianews();
		
		$data['curl']          = $this->curl;
		
		$data['aadata']        = $model->get($this->table, $this->primaryKey, $id);
		
		$template              = $this->loadView('kliping_edit');

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


	public function savekliping($x)

	{
		
		$data                  = array();	
		$model                 = $this->loadModel($this->model);
		$data['parent_id']     = $this->base64url_decode($x) ;
		$data['id_berita']     = $model->escapeString($_REQUEST['_id']) ;
		$data['link']          = $model->escapeString($_REQUEST['link']) ;
		$data['media']         = $model->escapeString($_REQUEST['media']) ;
		$data['main_category'] = $model->escapeString($_REQUEST['main_category']) ;
		$data['canal']         = $model->escapeString($_REQUEST['canal']) ;
		$data['category']      = $model->escapeString($_REQUEST['category']) ;
		$data['title_news']    = $model->escapeString($_REQUEST['title']) ;
		$data['date_news']     = $model->escapeString($_REQUEST['date_news']) ;	
		$nama_author           = $model->escapeString($_REQUEST['author']) ;
		$data['image_link']    = $model->escapeString($_REQUEST['image_link']) ;
		$data['image_caption'] = $model->escapeString($_REQUEST['image_caption']) ;
		$data['article_ori']   = $model->escapeString($_REQUEST['article_ori']) ;
		
		$narasi                = utf8_decode(trim($data['article_ori']));
		$narasi                = str_replace(array("\r", "\n"), ' ', $narasi);       	
		$news                  = $exp[0].". ".$exp[1].". ".$exp[2].". ".$exp[3].". ".$exp[4].".";

		$author = str_replace(array("Penulis", "Editor", ':','Reporter'), ' ', $nama_author);

		$data['author']        = $author;
		
		$data['article_clean'] = $model->escapeString($_REQUEST['article_clean']) ;
		$data['article_show']  = $narasi;
		$data['action']        = $model->escapeString($_REQUEST['action']) ;
		$data['v']             = $model->escapeString($_REQUEST['__v']) ;
		$data['autocode']      = $model->autocode($this->table_detail, "NEWS-");	
				
		
		$result                = $model->msave($this->table_detail, $data, $this->title);
		//$lastid                = $result['id'];


		return $result['id'];


	}

	public function saveonline($x)

	{
		
		$data                  = array();	
		$model                 = $this->loadModel($this->model);
		$data['parent_id']     = $this->base64url_decode($x) ;
		$data['id_berita']     = $model->escapeString($_REQUEST['_id']) ;
		$data['link']          = $model->escapeString($_REQUEST['link']) ;
		$data['media']         = $model->escapeString($_REQUEST['media']) ;
		$data['main_category'] = $model->escapeString($_REQUEST['main_category']) ;
		$data['canal']         = $model->escapeString($_REQUEST['canal']) ;
		$data['category']      = $model->escapeString($_REQUEST['category']) ;
		$data['title_news']    = $model->escapeString($_REQUEST['title']) ;
		$data['date_news']     = $model->escapeString($_REQUEST['date_news']) ;	
		$nama_author           = $model->escapeString($_REQUEST['author']) ;
		$data['image_link']    = $model->escapeString($_REQUEST['image_link']) ;
		$data['image_caption'] = $model->escapeString($_REQUEST['image_caption']) ;
		$data['article_ori']   = $model->escapeString($_REQUEST['article_ori']) ;
		
		$narasi                = utf8_decode(trim($data['article_ori']));
		$narasi                = str_replace(array("\r", "\n"), ' ', $narasi);       	
		$news                  = $exp[0].". ".$exp[1].". ".$exp[2].". ".$exp[3].". ".$exp[4].".";

		$author = str_replace(array("Penulis", "Editor", ':','Reporter'), ' ', $nama_author);

		$data['author']        = $author;
		
		$data['article_clean'] = $model->escapeString($_REQUEST['article_clean']) ;
		$data['article_show']  = $narasi;
		$data['action']        = $model->escapeString($_REQUEST['action']) ;
		$data['v']             = $model->escapeString($_REQUEST['__v']) ;
		$data['autocode']      = $model->autocode($this->table_detail, "NEWS-");	
				
		
		$result                = $model->msave("tbl_kliping_online", $data, $this->title);
		//$lastid                = $result['id'];


		return $result['id'];


	}

	public function savecover($x = null)

	{

		$data                  = array();
		
		$id                    = $this->base64url_decode($x);
		
		$model                 = $this->loadModel($this->model);
	
		$autocode              = $model->getval($this->table, 'autocode', 'autono', $id);

		# Insert files
		//$media                   = $model->getval("ref_media", 'direktori', 'autocode', $data['jenis_media']);
		$files1					 = array();
		$files1['dir'] 			 = "kliping";
		$files1['subdir'] 		 = '';
		if(!empty($_FILES['file_cover']['name'][0])) {
		    $file_ary1 = $model->reArrayFiles($_FILES['file_cover']);
		    foreach ($file_ary1 as $file1) {
				$files1['kode_parent'] = $autocode;
				$files1['parent_id']   = $id;
            	$files1['nama_file']   = $file1['name'];
				$files1['tipe_file']   = $file1['type'];
				$files1['ukuran']      = $file1['size'];
				$files1['ftable']      = $this->table;
				$files1['tipe']        = 1; // cover
				$files1['ordering']    = 0; // cover

				if(!empty($file1['name'])){ $model->savefile($files1); } 
		    }
		    # Update field dokumen
			// $f1                 = array();
			// $f1['file_dokumen'] = 1;
			// $row1               = $model->mupdate($this->table,$f1, $this->primaryKey, $id, $this->title);
		}

		# Upload file
		if(isset($_FILES['file_cover'])){ $model->uploads($files1['dir'], $_FILES['file_cover'], $autocode, $files1['subdir']); }


		// $this->redirect('dokumen_video');
		return true;
		

	}


	public function saveelektronik($x = null)

	{

		$data                  = array();
		
		$id                    = $this->base64url_decode($x);
		
		$model                 = $this->loadModel($this->model);
	
		$autocode              = $model->getval($this->table, 'autocode', 'autono', $id);

		# Insert files
		$files1					 = array();
		$files1['dir'] 			 = "kliping";
		$files1['subdir'] 		 = '';
		if(!empty($_FILES['file_doc_elektronik']['name'][0])) {
		    $file_ary1 = $model->reArrayFiles($_FILES['file_doc_elektronik']);
		    foreach ($file_ary1 as $file1) {
				$files1['kode_parent']  = $autocode;
				$files1['parent_id']    = $id;
				$files1['nama_file']    = $file1['name'];
				$files1['tipe_file']    = $file1['type'];
				$files1['ukuran']       = $file1['size'];
				$files1['ftable']       = $this->table;
				$files1['tipe']         = 4; // elektronik
				$files1['ordering']     = 0; // cover
				$files1['judul']        = $model->escapeString($_REQUEST['judul_berita_elektronik']) ;
				$files1['tanggal']      = $model->escapeString($_REQUEST['tanggal']) ;
				$files1['nama_program'] = $model->escapeString($_REQUEST['nama_program']) ;
				$files1['narasi']       = $model->escapeString($_REQUEST['narasi_elektronik']) ;

				if(!empty($file1['name'])){ $model->savefile($files1); } 
		    }
		}

		# Upload file
		if(isset($_FILES['file_doc_elektronik'])){ $model->uploads($files1['dir'], $_FILES['file_doc_elektronik'], $autocode, $files1['subdir']); }

		return true;

	}

	public function savekhusus($x = null)

	{

		$data                  = array();
		
		$id                    = $this->base64url_decode($x);
		
		$model                 = $this->loadModel($this->model);
	
		$autocode              = $model->getval($this->table, 'autocode', 'autono', $id);

		# Insert files
		$files1					 = array();
		$files1['dir'] 			 = "kliping";
		$files1['subdir'] 		 = '';
		if(!empty($_FILES['file_doc_khusus']['name'][0])) {
		    $file_ary1 = $model->reArrayFiles($_FILES['file_doc_khusus']);
		    foreach ($file_ary1 as $file1) {
				$files1['kode_parent']   = $autocode;
				$files1['parent_id']     = $id;
				$files1['nama_file']     = $file1['name'];
				$files1['tipe_file']     = $file1['type'];
				$files1['ukuran']        = $file1['size'];
				$files1['ftable']        = $this->table;
				$files1['tipe']          = 5; // khusus
				$files1['ordering']      = 0; // cover
				$files1['judul']         = $model->escapeString($_REQUEST['judul_berita_khusus']) ;
				$files1['narasi']        = $model->escapeString($_REQUEST['narasi_khusus']) ;
				$files1['linktniad']     = $model->escapeString($_REQUEST['linktniad']) ;
				$files1['linkinstagram'] = $model->escapeString($_REQUEST['linkinstagram']) ;
				$files1['linkfacebook']  = $model->escapeString($_REQUEST['linkfacebook']) ;
				$files1['linktwitter']   = $model->escapeString($_REQUEST['linktwitter']) ;
				
				if(!empty($file1['name'])){ $model->savefile($files1); } 
		    }
		}

		# Upload file
		if(isset($_FILES['file_doc_khusus'])){ $model->uploads($files1['dir'], $_FILES['file_doc_khusus'], $autocode, $files1['subdir']); }

		return true;
		
	}

	public function savemedsos($x = null)

	{

		$data                  = array();
		
		$id                    = $this->base64url_decode($x);
		
		$model                 = $this->loadModel($this->model);
	
		$autocode              = $model->getval($this->table, 'autocode', 'autono', $id);

		# Insert files
		$files1					 = array();
		$files1['dir'] 			 = "kliping";
		$files1['subdir'] 		 = '';
		if(!empty($_FILES['file_doc_medsos']['name'][0])) {
		    $file_ary1 = $model->reArrayFiles($_FILES['file_doc_medsos']);
		    foreach ($file_ary1 as $file1) {
				$files1['kode_parent']   = $autocode;
				$files1['parent_id']     = $id;
				$files1['nama_file']     = $file1['name'];
				$files1['tipe_file']     = $file1['type'];
				$files1['ukuran']        = $file1['size'];
				$files1['ftable']        = $this->table;
				$files1['tipe']          = 6; // medsos
				$files1['ordering']      = 0; // cover
				$files1['judul']         = $model->escapeString($_REQUEST['judul_berita_medsos']) ;
				$files1['narasi']        = $model->escapeString($_REQUEST['narasi_medsos']) ;
				$files1['linkinstagram'] = $model->escapeString($_REQUEST['linkinstagram']) ;
				$files1['linkfacebook']  = $model->escapeString($_REQUEST['linkfacebook']) ;
				$files1['linktwitter']   = $model->escapeString($_REQUEST['linktwitter']) ;
				$files1['linkyoutube']   = $model->escapeString($_REQUEST['linkyoutube']) ;
				$files1['linkvideo']     = $model->escapeString($_REQUEST['linkvideo']) ;
				if(!empty($file1['name'])){ $model->savefile($files1); } 
		    }
		}

		# Upload file
		if(isset($_FILES['file_doc_medsos'])){ $model->uploads($files1['dir'], $_FILES['file_doc_medsos'], $autocode, $files1['subdir']); }

		return true;
		
	}


	public function update($x)

	{

		$data                  = array();
		$id                    = $this->base64url_decode($x);	
		$model                 = $this->loadModel($this->model);

		$data['parent_id']     = $this->base64url_decode($x) ;
		$data['nama_kegiatan'] = $model->escapeString($_REQUEST['nama_kegiatan']) ;
		$data['keterangan']    = $model->escapeString($_REQUEST['keterangan']) ;
		$data['tanggal']       = $model->escapeString($_REQUEST['tanggal']) ;	
		$data['autocode']      = $model->autocode($this->table, "KLIPING-");	

		$result                = $model->mupdate($this->table, $data, $this->primaryKey, $id, $this->title);

		
		$this->redirect('kliping');

		//return $result;

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

	public function deletefile($x = null)
	{
		$data               = array();
		$id                 = $this->base64url_decode($x);
		$model              = $this->loadModel($this->model);
		$result             = $model->deletes_file($id);
		return $result;
	}

	public function delberita($x)

	{

		$id                 = $this->base64url_decode($x);

		$model              = $this->loadModel($this->model);

		$result             = $model->mdelete($this->table_detail, $this->primaryKey, $id, $this->title);

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
		
		$data['personel']      = $model->get_personeledit($id);

		$data['views']         = $model->get_views($id);

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

	public function createimg(){

		//$im         = imagecreatetruecolor(960, 540);
		$text = "Ini adalah tes"; 
		$font = 'http://localhost/dispenad_kliping/static/css/fonts/Roboto-Regular.ttf';
		$pic = './static/files/sample.jpg';
		$im         = imagecreatefromjpeg($pic);
		$white = imagecolorallocate($im, 255, 255, 255);
		$yellow = imagecolorallocate($im, 255, 255, 0);
		$grey = imagecolorallocate($im, 128, 128, 128);
		
		imagefilledrectangle($im, 0, 0, 399, 29, $white);
		imagestring($im, 50, 5, 5,  'A Simple Text String', $grey);
		

		//imagettftext($im, 20, 20, 10, 20, $grey, $font, $text);
		imagejpeg($im, './static/files/simpletext.jpg');


		imagedestroy($im);

		echo '<img src="../static/files/simpletext.jpg">'.$font;

	}

	function print($x = false)
	{
		if($x){
			$model   = $this->loadModel($this->model);
			$uri     = $this->loadHelper('Url_helper');
			$id      = $this->base64url_decode($x);
			$pdf     = $this->loadLibrary('fpdf');
			$data    = $model->getkliping($this->table, $this->table_detail, $id);
			$tanggal = $model->format_tanggal($data[0]['tanggal']);


			// COVER
			$cover   = $model->getk($id, 1);
			$pdf->SetTitle('KLIPING '.$tanggal);
			$pdf->AddPage('L','A4');
			foreach ($cover as $key => $cover) {
				$pdf->Image(BASE_URL.'static/files/bahan/kliping/'.$cover['kode_parent']."/".$cover['nama_file'], 0, 0, 339, 191);
			}
			//$pdf->Image(BASE_URL.'static/images/backgrounds/0-cover.jpg', 0, 0, 339, 191);
			
			// tgl cover kliping 
				$pdf->SetY(165); 
				$pdf->setX(5);
				$pdf->SetTextColor(0,0,0); 
				$pdf->SetFont('Arial','B',14);
				$pdf->SetFillColor(240,255,240);   
			    $pdf->RoundedRect(5, 162, 80, 10, 3.5, 'DF');
				$pdf->Cell(80,5, $tanggal,0,0,'C',false); 

			// Halaman cover media cetak
			$pdf->AddPage('L','A4');
			$pdf->SetMargins(0,0, 0);	
			$pdf->Image(BASE_URL.'static/images/backgrounds/1-media-cetak.jpg', 0, 0, 339, 191);

			if($data[0]['title_news'] != ''){
				foreach ($data as $key => $berita) {
					$narasi = utf8_decode(trim($berita['article_show']));
					$narasi = str_replace("&nbsp;", '', $narasi);
					$narasi = str_replace(array("\r", "\n"), ' ', $narasi);
			       	$news   = strip_tags($narasi);

			       	$exp = explode(".", $news);
			       	
			        $news   = $exp[0].". ".$exp[1].". ".$exp[2].". ".$exp[3].". ".$exp[4].".";

			        $panjang = strlen($news);

			          if (strlen($news) > 800) {
			              $newsCut   = substr($news, 0, 800);
			              $endPoint  = strrpos($newsCut, ' ');
			              $news      = $endPoint? substr($newsCut, 0, $endPoint) : substr($newsCut, 0);
			          }

			        $pdf->AddPage('L','A4');
					$pdf->SetMargins(0,0, 0);	
					$pdf->Image(BASE_URL.'static/images/backgrounds/dispen1.jpg', 0, 0, 339, 191);

			        // judul berita
					$pdf->SetY(10); 
					$pdf->setLeftMargin(10);
					$pdf->SetTextColor(255,255,0); 
					$pdf->SetFont('Arial','B',20);
					$pdf->MultiCell(180, 9, $berita['title_news'] , 1 ,'C' , FALSE);

					// isi berita
					$pdf->SetY(38); 
					$pdf->setLeftMargin(10);
					$pdf->SetTextColor(254,254,254);
					$pdf->SetFont('Arial','',15);
					$pdf->MultiCell(180, 8, $news , 1 ,'J' , FALSE);
					//$pdf->CellFit(180, 200, $news, 0, 1.5, 'J', false, '', false, true);
					
					// logo media
					$pdf->SetY(10);
					$logo = BASE_URL.'static/images/logo/'.$berita['media'].'.png';
					//if(file_exists($logo)){
						$pdf->Image($logo,270,15,50,0,'PNG');
					//}
					

					// image berita
					$pdf->SetY(30);    
					$pdf->SetFillColor(240,255,240);   
					$pdf->RoundedRect(200, 30, 120, 110, 3.5, 'DF');   
					if($berita['image_link']){
						$pdf->Image($berita['image_link'],205,35,110,80,'JPG');
					} else {
						$pdf->Image(BASE_URL.'static/images/no-preview-available.png',205,35,110,80,'PNG');
					}
					

					// Redaksi Teks
					$pdf->SetY(117); 
					$pdf->setLeftMargin(204);
					$pdf->SetTextColor(0,0,0); 
					$pdf->SetFont('Arial','',15);
					$pdf->Cell(20,9, "Red : ",0,0,'L',false); 
					$pdf->setX(218);
					$pdf->Cell(10,9, $berita['author'],0,0,'L',false); 

					$pdf->SetY(125); 
					$pdf->setLeftMargin(204);
					$pdf->Cell(20,9, $model->format_tanggal_jam($berita['date_news']),0,0,'L',false); 

		    		// kotak link
					$pdf->SetFillColor(240,255,240);   
					$pdf->RoundedRect(12, 155, 320, 20, 10, 'DF');   

					// logo http
					$pdf->Image(BASE_URL.'static/images/http3.png',7,145,40,0,'PNG');

					$pdf->SetY(158);
					$pdf->SetTextColor(0,0,0);
					$pdf->SetFont('Arial','U',14);
					$pdf->setX(50);
					$pdf->MultiCell(230, 6, $berita['link'] , 0 ,'C' , FALSE);

					// image tulisan dispenad
					// $pdf->Image(BASE_URL.'static/images/logo/dispenad.png',285,160,40,0,'PNG');
					

					$pdf->Ln();

				}


			}

			// Halaman cover media online
			$pdf->AddPage('L','A4');
			$pdf->SetMargins(0,0, 0);	
			$pdf->Image(BASE_URL.'static/images/backgrounds/2-media-online.jpg', 0, 0, 339, 191);
			$online    = $model->getkliping($this->table, "tbl_kliping_online", $id);
			if($online){
				foreach ($online as $key => $online) {
					$narasi = utf8_decode(trim($online['article_show']));
					$narasi = str_replace("&nbsp;", '', $narasi);
					$narasi = str_replace(array("\r", "\n"), ' ', $narasi);
			       	$news   = strip_tags($narasi);

			       	$exp = explode(".", $news);
			       	
			        $news   = $exp[0].". ".$exp[1].". ".$exp[2].". ".$exp[3].". ".$exp[4].".";

			        $panjang = strlen($news);

			          if (strlen($news) > 800) {
			              $newsCut   = substr($news, 0, 800);
			              $endPoint  = strrpos($newsCut, ' ');
			              $news      = $endPoint? substr($newsCut, 0, $endPoint) : substr($newsCut, 0);
			          }

			        $pdf->AddPage('L','A4');
					$pdf->SetMargins(0,0, 0);	
					$pdf->Image(BASE_URL.'static/images/backgrounds/dispen1.jpg', 0, 0, 339, 191);

			        // judul online
					$pdf->SetY(10); 
					$pdf->setLeftMargin(10);
					$pdf->SetTextColor(255,255,0); 
					$pdf->SetFont('Arial','B',20);
					$pdf->MultiCell(180, 9, $online['title_news'] , 1 ,'C' , FALSE);

					// isi online
					$pdf->SetY(38); 
					$pdf->setLeftMargin(10);
					$pdf->SetTextColor(254,254,254);
					$pdf->SetFont('Arial','',15);
					$pdf->MultiCell(180, 8, $news , 1 ,'J' , FALSE);
					//$pdf->CellFit(180, 200, $news, 0, 1.5, 'J', false, '', false, true);
					
					// logo media
					$pdf->SetY(10);
					$logo = BASE_URL.'static/images/logo/'.$online['media'].'.png';
					//if(file_exists($logo)){
						$pdf->Image($logo,270,15,50,0,'PNG');
					//}
					

					// image online
					$pdf->SetY(30);    
					$pdf->SetFillColor(240,255,240);   
					$pdf->RoundedRect(200, 30, 120, 110, 3.5, 'DF');   
					if($online['image_link']){
						$pdf->Image($online['image_link'],205,35,110,80,'JPG');
					} else {
						$pdf->Image(BASE_URL.'static/images/no-preview-available.png',205,35,110,80,'PNG');
					}
					

					// Redaksi Teks
					$pdf->SetY(117); 
					$pdf->setLeftMargin(204);
					$pdf->SetTextColor(0,0,0); 
					$pdf->SetFont('Arial','',15);
					$pdf->Cell(20,9, "Red : ",0,0,'L',false); 
					$pdf->setX(218);
					$pdf->Cell(10,9, $online['author'],0,0,'L',false); 

					$pdf->SetY(125); 
					$pdf->setLeftMargin(204);
					$pdf->Cell(20,9, $model->format_tanggal_jam($online['date_news']),0,0,'L',false); 

		    		// kotak link
					$pdf->SetFillColor(240,255,240);   
					$pdf->RoundedRect(12, 155, 320, 20, 10, 'DF');   

					// logo http
					$pdf->Image(BASE_URL.'static/images/http3.png',7,145,40,0,'PNG');

					$pdf->SetY(158);
					$pdf->SetTextColor(0,0,0);
					$pdf->SetFont('Arial','U',14);
					$pdf->setX(50);
					$pdf->MultiCell(230, 6, $online['link'] , 0 ,'C' , FALSE);

					// image tulisan dispenad
					// $pdf->Image(BASE_URL.'static/images/logo/dispenad.png',285,160,40,0,'PNG');
					

					$pdf->Ln();

				}


			}

			// Halaman cover media elektronik
			$pdf->AddPage('L','A4');
			$pdf->SetMargins(0,0, 0);	
			$pdf->Image(BASE_URL.'static/images/backgrounds/3-media-elektronik.jpg', 0, 0, 339, 191);
			// ELEKTRONIK
			$elektronik   = $model->getk($id, 4);
			foreach ($elektronik as $key => $elektronik) {
				$pdf->AddPage('L','A4');
					$pdf->SetMargins(0,0, 0);	
					//$pdf->Image(BASE_URL.'static/images/backgrounds/dispen1.jpg', 0, 0, 339, 191);

				// judul berita elektronik
					$pdf->SetY(10); 
					$pdf->setLeftMargin(10);
					$pdf->SetTextColor(255,255,0); 
					$pdf->SetFont('Arial','B',20);
					$pdf->MultiCell(180, 9, $elektronik['judul'] , 1 ,'C' , FALSE);

				// isi berita elektronik
					$pdf->SetY(38); 
					$pdf->setLeftMargin(10);
					$pdf->SetTextColor(254,254,254);
					$pdf->SetFont('Arial','',15);
					$pdf->MultiCell(180, 8, $elektronik['narasi'] , 1 ,'J' , FALSE);

				// image berita elektronik
					$pdf->SetY(30);    
					$pdf->SetFillColor(240,255,240);   
					$pdf->RoundedRect(200, 30, 120, 90, 3.5, 'DF');   
					if($elektronik['nama_file']){
						$pdf->Image(BASE_URL.'static/files/kliping/'.$elektronik['kode_parent']."/".$elektronik['nama_file'],205,35,110,80,'JPG');
					} else {
						$pdf->Image(BASE_URL.'static/images/no-preview-available.png',205,35,110,80,'PNG');
					}

					// nama program
					$pdf->SetY(152);
					$pdf->SetTextColor(254,254,254);
					$pdf->SetFont('Arial','B',16);
					$pdf->setX(10);
					$pdf->MultiCell(200, 6, "Program : ".$elektronik['nama_program'] , 0 ,'L' , FALSE);

					// tanggal program
					$pdf->SetY(160);
					$pdf->SetTextColor(254,254,254);
					$pdf->SetFont('Arial','B',16);
					$pdf->setX(10);
					$pdf->MultiCell(200, 6, $model->format_tanggal($elektronik['tanggal']) , 0 ,'L' , FALSE);

					// garis double 
					$pdf->SetFillColor(240,255,240);
					$pdf->RoundedRect(140, 180, 140, 2, 0, 'DF');
				    $pdf->RoundedRect(0, 183, 280, 2, 0, 'DF');

					// image tulisan dispenad
					//$pdf->Image(BASE_URL.'static/images/logo/dispenad.png',285,175,40,0,'PNG');
			}


			// Halaman cover media khusus
			$pdf->AddPage('L','A4');
			$pdf->SetMargins(0,0, 0);	
			$pdf->Image(BASE_URL.'static/images/backgrounds/4-media-khusus.jpg', 0, 0, 339, 191);
			// ELEKTRONIK
			$khusus   = $model->getk($id, 5);
			foreach ($khusus as $key => $khusus) {
				$pdf->AddPage('L','A4');
					$pdf->SetMargins(0,0, 0);	
					$pdf->Image(BASE_URL.'static/images/backgrounds/dispen1.jpg', 0, 0, 339, 191);

				// judul berita khusus
					$pdf->SetY(10); 
					$pdf->setLeftMargin(10);
					$pdf->SetTextColor(255,255,0); 
					$pdf->SetFont('Arial','B',20);
					$pdf->MultiCell(320, 9, $khusus['judul'] , 1 ,'C' , FALSE);

				// isi berita khusus
					$pdf->SetY(38); 
					$pdf->setLeftMargin(140);
					$pdf->SetTextColor(254,254,254);
					$pdf->SetFont('Arial','',15);
					$pdf->MultiCell(180, 8, $khusus['narasi'] , 1 ,'J' , FALSE);

				// image berita khusus
					$pdf->SetY(30);    
					$pdf->SetFillColor(240,255,240);   
					$pdf->RoundedRect(10, 30, 120, 90, 3.5, 'DF');   
					if($khusus['nama_file']){
						$pdf->Image(BASE_URL.'static/files/kliping/'.$khusus['kode_parent']."/".$khusus['nama_file'],15,35,110,80,'JPG');
					} else {
						$pdf->Image(BASE_URL.'static/images/no-preview-available.png',15,35,110,80,'PNG');
					}

					// background kotak
					$pdf->SetFillColor(240,255,255);
					$pdf->RoundedRect(0, 130, 340, 40, 0, 'DF');
					
					// tni ad	
					$pdf->Image(BASE_URL.'static/images/icons/tniad.png',10,135,15,15,'PNG');
					$pdf->SetY(137);
					$pdf->setX(30);
					$pdf->SetTextColor(0,0,0);
					$pdf->SetFont('Arial','U',14);
					$pdf->MultiCell(130, 6, $khusus['linktniad'] , 0 ,'L' , FALSE);

					// instagram		
					$pdf->Image(BASE_URL.'static/images/icons/instagram.png',12,155,10,10,'PNG');
					$pdf->SetY(155);
					$pdf->setX(30);
					$pdf->SetTextColor(0,0,0);
					$pdf->SetFont('Arial','U',14);
					$pdf->MultiCell(130, 6, $khusus['linkinstagram'] , 0 ,'L' , FALSE);


					// facebook	
					$pdf->Image(BASE_URL.'static/images/icons/facebook.png',175,135,10,10,'PNG');
					$pdf->SetY(137);
					$pdf->setX(190);
					$pdf->SetTextColor(0,0,0);
					$pdf->SetFont('Arial','U',14);
					$pdf->MultiCell(130, 6, $khusus['linkfacebook'] , 0 ,'L' , FALSE);


					// twitter	
					$pdf->Image(BASE_URL.'static/images/icons/twitter.png',175,155,10,10,'PNG');
					$pdf->SetY(155);
					$pdf->setX(190);
					$pdf->SetTextColor(0,0,0);
					$pdf->SetFont('Arial','U',14);
					$pdf->MultiCell(130, 6, $khusus['linktwitter'] , 0 ,'L' , FALSE);

					// garis double 
					$pdf->SetFillColor(240,255,240);
					$pdf->RoundedRect(140, 180, 140, 2, 0, 'DF');
				    $pdf->RoundedRect(0, 183, 280, 2, 0, 'DF');

					// image tulisan dispenad
					//$pdf->Image(BASE_URL.'static/images/logo/dispenad.png',285,175,40,0,'PNG');
			}


			// Halaman cover media medsos
			$pdf->AddPage('L','A4');
			$pdf->SetMargins(0,0, 0);	
			$pdf->Image(BASE_URL.'static/images/backgrounds/5-media-medsos.jpg', 0, 0, 339, 191);
			// ELEKTRONIK
			$medsos   = $model->getk($id, 6);
			foreach ($medsos as $key => $medsos) {
				$pdf->AddPage('L','A4');
					$pdf->SetMargins(0,0, 0);	
					$pdf->Image(BASE_URL.'static/images/backgrounds/dispen1.jpg', 0, 0, 339, 191);

				// judul berita medsos
					$pdf->SetY(10); 
					$pdf->setLeftMargin(10);
					$pdf->SetTextColor(255,255,0); 
					$pdf->SetFont('Arial','B',20);
					$pdf->MultiCell(320, 9, $medsos['judul'] , 1 ,'C' , FALSE);

				// isi berita medsos
					$pdf->SetY(35); 
					$pdf->setLeftMargin(120);
					$pdf->SetTextColor(254,254,254);
					$pdf->SetFont('Arial','',15);
					$pdf->MultiCell(200, 8, $medsos['narasi'] , 1 ,'J' , FALSE);

				// image berita medsos
					$pdf->SetY(30);    
					$pdf->SetFillColor(240,255,240);   
					$pdf->RoundedRect(10, 30, 100, 70, 3.5, 'DF');   
					if($medsos['nama_file']){
						$pdf->Image(BASE_URL.'static/files/kliping/'.$medsos['kode_parent']."/".$medsos['nama_file'],15,35,90,60,'JPG');
					} else {
						$pdf->Image(BASE_URL.'static/images/no-preview-available.png',15,35,110,80,'PNG');
					}

					// background kotak
					$pdf->SetFillColor(240,255,255);
					$pdf->RoundedRect(0, 110, 340, 60, 0, 'DF');
					
					// instagram		
					$pdf->Image(BASE_URL.'static/images/icons/instagram.png',12,115,10,10,'PNG');
					$pdf->SetY(117);
					$pdf->setX(30);
					$pdf->SetTextColor(0,0,0);
					$pdf->SetFont('Arial','U',14);
					$pdf->MultiCell(110, 6, $medsos['linkinstagram'] , 0 ,'L' , FALSE);

					// facebook		
					$pdf->Image(BASE_URL.'static/images/icons/facebook.png',12,135,10,10,'PNG');
					$pdf->SetY(135);
					$pdf->setX(30);
					$pdf->SetTextColor(0,0,0);
					$pdf->SetFont('Arial','U',14);
					$pdf->MultiCell(130, 6, $medsos['linkfacebook'] , 0 ,'L' , FALSE);

					// twitter		
					$pdf->Image(BASE_URL.'static/images/icons/twitter.png',12,155,10,10,'PNG');
					$pdf->SetY(155);
					$pdf->setX(30);
					$pdf->SetTextColor(0,0,0);
					$pdf->SetFont('Arial','U',14);
					$pdf->MultiCell(150, 6, $medsos['linktwitter'] , 0 ,'L' , FALSE);


					// youtube	
					$pdf->Image(BASE_URL.'static/images/icons/youtube.png',175,115,10,10,'PNG');
					$pdf->SetY(117);
					$pdf->setX(190);
					$pdf->SetTextColor(0,0,0);
					$pdf->SetFont('Arial','U',14);
					$pdf->MultiCell(130, 6, $medsos['linkyoutube'] , 0 ,'L' , FALSE);


					// video	
					$pdf->Image(BASE_URL.'static/images/icons/video.png',175,135,10,10,'PNG');
					$pdf->SetY(135);
					$pdf->setX(190);
					$pdf->SetTextColor(0,0,0);
					$pdf->SetFont('Arial','U',14);
					$pdf->MultiCell(130, 6, $medsos['linkvideo'] , 0 ,'L' , FALSE);

					// garis double 
					$pdf->SetFillColor(240,255,240);
					$pdf->RoundedRect(140, 180, 140, 2, 0, 'DF');
				    $pdf->RoundedRect(0, 183, 280, 2, 0, 'DF');

					// image tulisan dispenad
					//$pdf->Image(BASE_URL.'static/images/logo/dispenad.png',285,175,40,0,'PNG');
			}

			$pdf->Output();
		} else {
			$this->redirect('error');
		}

	}

	function printf($x = false)
	{
		if($x){
			$model   = $this->loadModel($this->model);
			$uri     = $this->loadHelper('Url_helper');
			$id      = $this->base64url_decode($x);
			$pdf     = $this->loadLibrary('fpdf');
			$data    = $model->getkliping($this->table, $this->table_detail, $id);
			$tanggal = $model->format_tanggal($data[0]['tanggal']);

			$pdf->SetTitle('KLIPING '.$tanggal);
			$pdf->AddPage('L','A4');
			$pdf->Image(BASE_URL.'static/images/backgrounds/0-cover.jpg', 0, 0, 339, 191);
			
			// tgl cover kliping 
				$pdf->SetY(165); 
				$pdf->setX(5);
				$pdf->SetTextColor(0,0,0); 
				$pdf->SetFont('Arial','B',14);
				$pdf->SetFillColor(240,255,240);   
			    $pdf->RoundedRect(5, 162, 80, 10, 3.5, 'DF');
				$pdf->Cell(80,5, $tanggal,0,0,'C',false); 


			$pdf->AddPage('L','A4');
			$pdf->SetMargins(0,0, 0);	
			$pdf->Image(BASE_URL.'static/images/backgrounds/1-media-cetak.jpg', 0, 0, 339, 191);

			

			$pdf->Output();
		} else {
			$this->redirect('error');
		}

	}

	

    

}