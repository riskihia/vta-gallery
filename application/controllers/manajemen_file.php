<?php



class Manajemen_file extends Controller {



	private $table      = "tbl_dokumen";

	private $primaryKey = "autono";

	private $menu       = "Utilitas";

	private $title      = "Manajemen File";

	private $curl       = BASE_URL."manajemen_file";

	



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

		$data['curl']	     = $this->curl;

		$data['encode']	     = $x;

		$template            = $this->loadView('manajemenfile_view');

		$template->set('data', $data);

		$template->render();

	}


    

}