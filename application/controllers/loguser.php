<?php

class Loguser extends Controller {

	private $table      = "tuser";
	private $primaryKey = "user_id";
	private $model      = "Loguser_model"; # please write with no space
	private $menu       = "Utilitas";
	private $title      = "Log User";
	private $curl       = BASE_URL."loguser/";
	

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
		$data['curl']		 = $this->curl;
		$template            = $this->loadView('loguser_view');
		$template->set('data', $data);
		$template->render();
	}

	function get()
	{
    	$model   = $this->loadModel($this->model);	
    	$request    = $_REQUEST;
		$columns = array(
			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'user_fullname',  'dt' => 1 ),
			array( 'db' => 'wb_ol_time',   'dt' => 2 ),
			array( 'db' => 'ip',   'dt' => 3 ),
			array( 'db' => 'status',   'dt' => 4 , 'formatter' => function( $d, $row ) { return (int) $d; } ),
            array( 'db' => 'foto',   'dt' => 5 , 'formatter' => function( $d, $row ) { return base64_encode($d); } ),
            array( 'db' => 'user_grupVal',   'dt' => 6 )
		);

		$result  = $model->mget($request, $this->table, $this->primaryKey, $columns);

		return json_encode($result);
	}
    
}