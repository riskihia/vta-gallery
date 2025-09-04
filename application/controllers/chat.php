<?php



class Chat extends Controller {


	private $primaryKey = "autono";

	private $menu       = "Utilitas";

	private $title      = "Chat";

	private $curl       = BASE_URL."chat";

	
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

		$template            = $this->loadView('chat_view');

		$template->set('data', $data);

		$template->render();

	}


    

}