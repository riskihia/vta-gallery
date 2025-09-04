<?php

class Pencarian extends Controller {

	private $table       = "tbl_dokumen";
	private $model       = "Pencarian_model"; # please write with no space
	private $title       = "Dokumen";
	private $menu        = "Pencarian";
	private $curl        = BASE_URL."pencarian";

	public function __construct()
    {
        $session = $this->loadHelper('Session_helper');
        if(!$session->get('username')){
        	$this->redirect('auth/login');
        }
    }
	
	function index()
	{
		$model               = $this->loadModel($this->model);
		$data                = array();
		if(isset($_GET['q'])) { $data['q'] = $model->escapeString($_GET['q']); } else { $data['q'] = ''; } ;
		if(isset($_GET['page'])) { $data['page'] = $model->escapeString($_GET['page']); } else { $data['page'] = 1; } ;
		$input['keywords']   = str_replace('+',  ' ', $data['q']);
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['kategori']    = $model->get_kategori();
		$data['history']     = $model->get_history();
		$data['curl']	     = $this->curl;
		$data['limit']	     = 10;
		$data['pencarian']   = $model->get_dokumen($input['keywords'], $data['page'], $data['limit']);
		$template            = $this->loadView('pencarian');
		$template->set('data', $data);
		$template->render();
	}


	function search()
	{
		$model               = $this->loadModel($this->model);
		$data                = array();
		if(isset($_GET['q'])) { $data['q'] = $model->escapeString($_GET['q']); } else { $data['q'] = ''; } ;
		if(isset($_GET['page'])) { $data['page'] = $model->escapeString($_GET['page']); } else { $data['page'] = 1; } ;
		$input['keywords']   = str_replace('+',  ' ', $data['q']);
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['kategori']    = $model->get_kategori();
		$data['history']     = $model->get_history();
		$data['curl']	     = $this->curl;
		$data['limit']	     = 10;
		$data['pencarian']   = $model->get_dokumen($input['keywords'], $data['page'], $data['limit']);
		if(!empty($input['keywords'])){ $model->msave("ref_keywords", $input, 'Keywords'); }
		$template            = $this->loadView('pencarian');
		$template->set('data', $data);
		$template->render();
	}

    
}