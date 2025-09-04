<?php

class Pencarian_lengkap extends Controller {

	private $table       = "tbl_dokumen";
	private $model       = "Pencarian_model"; # please write with no space
	private $title       = "Pencarian Lengkap";
	private $menu        = "Pencarian";
	private $curl        = BASE_URL."pencarian_lengkap";

	public function __construct()
    {
        $session = $this->loadHelper('Session_helper');
        if(!$session->get('username')){
        	$this->redirect('auth/login');
        }
    }
	
	function index()
	{
		$data                  = array();
		$model                 = $this->loadModel($this->model);
		$data['q']             = ( isset( $_GET['q'] ) ) ? $_GET['q'] : '';
		$data['page']          = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
		$data['limit']         = 10;
		$input['keywords']     = str_replace('+',  ' ', $data['q']);
		$query                 = "SELECT autono, autocode, nama_kegiatan, lokasi, no_card, narasi, tanggal, fotografer, kamera, total FROM tbl_dokumen LEFT JOIN (SELECT parent_id,COUNT(views) AS total FROM ref_views GROUP BY parent_id) AS ref_views ON tbl_dokumen.`autono` = ref_views.`parent_id` WHERE nama_kegiatan LIKE '%".$data['q']."%' OR narasi LIKE '%".$data['q']."%'";	
		$resTotalLength        = $model->query("SELECT COUNT(FOUND_ROWS()) FROM  `tbl_dokumen`");
		$data['total']         = $resTotalLength[0][0];
		$data['breadcrumb1']   = $this->menu;
		$data['title']         = $this->title;
		$data['kondisi']	 = $model->get_kondisi();
		$data['media']	     = $model->get_media();
		$data['kategori']      = $model->get_kategori();
		$data['personel']       = $model->get_personel();
		$data['provinsi']	 = $model->get_provinsi();
		$data['history']       = $model->get_history();
		$data['curl']          = $this->curl;
		$data['pencarian']     = $model->pagination($query, $data['limit'], $data['page']);
		$data['number_paging'] = $model->createLinks($data['q'],$data['pencarian']['total'],$data['pencarian']['limit'], $data['pencarian']['page']);
		if(!empty($input['keywords'])){ $model->msave("ref_keywords", $input, 'Keywords'); }
		$template            = $this->loadView('pencarian_lengkap');
		$template->set('data', $data);
		$template->render();
	}


	function search()
	{
		$data                  = array();
		$model                 = $this->loadModel($this->model);
		$data['q']             = ( isset( $_GET['q'] ) ) ? $_GET['q'] : '';
		$data['deskripsi']     = ( isset( $_GET['deskripsi'] ) ) ? $_GET['deskripsi'] : '';
		$data['jenis_media']     = ( isset( $_GET['jenis_media'] ) ) ? $_GET['jenis_media'] : '';
		$data['kondisi_media']     = ( isset( $_GET['kondisi_media'] ) ) ? $_GET['kondisi_media'] : '';


		//kategori//
		$jkategori             = count($_REQUEST['kategori']);
		for ($i=0; $i < $jkategori ; $i++) { 
			$category['kd_kategori']     = $model->escapeString($_REQUEST['kategori'][$i]);
			// echo $category['kd_kategori']."<br>";
			if($i == 0)
			{$penghub1 = "AND (";}
			else
			{$penghub1 = " OR ";}
			$qcate .= $penghub1."tbl_dokumen_kategori.kd_kategori = '$category[kd_kategori]'";
			
		}
		if ($jkategori > 0)
		{
		$qcate .= ")";
		}
		// echo $qcate.")";exit;

		//personel//
		$jpersonel             = count($_REQUEST['personel']);
		for ($i=0; $i < $jpersonel ; $i++) { 
			$category['personel']     = $model->escapeString($_REQUEST['personel'][$i]);
			// echo $category['personel']."<br>";
			if($i == 0)
			{$penghub1 = "AND (";}
			else
			{$penghub1 = " OR ";}
			$qpers .= $penghub1."tbl_dokumen_personel.kd_personel = '$category[personel]'";
		}
		if ($jpersonel > 0)
		{
		$qpers .= ")";
		}
		


		//provinsi//
		$jprovinsi             = count($_REQUEST['provinsi']);
		for ($i=0; $i < $jprovinsi ; $i++) { 
			$category['provinsi']     = $model->escapeString($_REQUEST['provinsi'][$i]);
			// echo $category['provinsi']."<br>";
			if($i == 0)
			{$penghub1 = "AND (";}
			else
			{$penghub1 = " OR ";}
			$qprov .= $penghub1."tbl_dokumen_wilayah.kode = '$category[provinsi]'";
		}
		if ($jprovinsi > 0)
		{
		$qprov .= ")";
		}
	

		$data['tanggl']     = ( isset( $_GET['tanggl'] ) ) ? $_GET['tanggl'] : '';
		// exit;


		// echo $data['jenis_media'];exit;







		$data['page']          = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
		$data['limit']         = 10;
		$query                 = "SELECT autono, autocode, nama_kegiatan, lokasi, no_card, narasi, tanggal, fotografer, kamera, total FROM tbl_dokumen 
								  LEFT JOIN (SELECT parent_id,COUNT(views) AS total FROM ref_views GROUP BY parent_id) AS ref_views ON tbl_dokumen.`autono` = ref_views.`parent_id` 
								  LEFT JOIN (SELECT parent_id,kd_kategori FROM tbl_dokumen_kategori GROUP BY parent_id) AS tbl_dokumen_kategori ON tbl_dokumen.`autono` = tbl_dokumen_kategori.`parent_id`
								  LEFT JOIN (SELECT parent_id,kd_personel FROM tbl_dokumen_personel GROUP BY parent_id) AS tbl_dokumen_personel ON tbl_dokumen.`autono` = tbl_dokumen_personel.`parent_id`
								  LEFT JOIN (SELECT parent_id,kode FROM tbl_dokumen_wilayah GROUP BY parent_id) AS tbl_dokumen_wilayah ON tbl_dokumen.`autono` = tbl_dokumen_wilayah.`parent_id` 
								  WHERE nama_kegiatan LIKE '%".$data['q']."%' AND narasi LIKE '%".$data['deskripsi']."%' AND jenis_media LIKE '%".$data['jenis_media']."%' AND kondisi_media LIKE '%".$data['kondisi_media']."%' AND tanggal LIKE '%".$data['tanggl']."%'  $qcate $qpers $qprov";	
		$resTotalLength        = $model->query("SELECT COUNT(FOUND_ROWS()) FROM  `tbl_dokumen` WHERE nama_kegiatan LIKE '%".$data['q']."%' AND narasi LIKE '%".$data['deskripsi']."%' AND jenis_media LIKE '%".$data['jenis_media']."%' AND kondisi_media LIKE '%".$data['kondisi_media']."%'");
		$data['total']         = $resTotalLength[0][0];
		$input['keywords']     = str_replace('+',  ' ', $data['q']);
		$data['breadcrumb1']   = $this->menu;
		$data['title']         = $this->title;
		$data['kondisi']	 = $model->get_kondisi();
		$data['media']	     = $model->get_media();
		$data['kategori']      = $model->get_kategori();
		$data['personel']       = $model->get_personel();
		$data['provinsi']	 = $model->get_provinsi();
		$data['history']       = $model->get_history();
		$data['curl']          = $this->curl;
		$data['pencarian']     = $model->pagination($query, $data['limit'], $data['page']);
		$data['number_paging'] = $model->createLinks($data['q'],$data['pencarian']['total'],$data['pencarian']['limit'], $data['pencarian']['page']);
		if(!empty($input['keywords'])){ $model->msave("ref_keywords", $input, 'Keywords'); }
		$template            = $this->loadView('pencarian_lengkap');
		$template->set('data', $data);
		$template->render();
	}

    
}