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
		$data['kategori']      = $model->get_kategori();
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
		$data['page']          = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
		$data['limit']         = 10;
		$query                 = "SELECT autono, autocode, nama_kegiatan, lokasi, no_card, narasi, tanggal, fotografer, kamera, total FROM tbl_dokumen LEFT JOIN (SELECT parent_id,COUNT(views) AS total FROM ref_views GROUP BY parent_id) AS ref_views ON tbl_dokumen.`autono` = ref_views.`parent_id` WHERE nama_kegiatan LIKE '%".$data['q']."%' OR narasi LIKE '%".$data['q']."%'";	
		$resTotalLength        = $model->query("SELECT COUNT(FOUND_ROWS()) FROM  `tbl_dokumen`");
		$data['total']         = $resTotalLength[0][0];
		$input['keywords']     = str_replace('+',  ' ', $data['q']);
		$data['breadcrumb1']   = $this->menu;
		$data['title']         = $this->title;
		$data['kategori']      = $model->get_kategori();
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