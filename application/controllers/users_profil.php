<?php

class Users_profil extends Controller {

	private $table      = "tuser";
	private $primaryKey = "autono";
	private $model      = "Users_profil_model";
	private $menu       = "Users";
	private $title      = "Profile";
	private $curl       = BASE_URL."users_profil";
	

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
		$model               = self::loadModel($this->model);
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['curl']		 = $this->curl;
		$data['photo']       = $model->getphoto();
		$data['groups']      = $model->getgroups();
		$data['position']    = $model->getposition();
		$data['aadata']      = $model->get($this->table);
		$template            = $this->loadView('users_profil_view');
		$template->set('data', $data);
		$template->render();
	}

	function account_settings()
	{
		$data                = array();
		$model               = self::loadModel($this->model);
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = "Account Settings";
		$data['curl']		 = $this->curl;
		$data['photo']       = $model->getphoto();
		$data['groups']      = $model->getgroups();
		$data['position']    = $model->getposition();
		$data['aadata']      = $model->get($this->table);
		$template            = $this->loadView('users_profil_account_view');
		$template->set('data', $data);
		$template->render();
	}

	public function updatephoto()
	{
		$data                  = array();
		$model                 = $this->loadModel($this->model);
		$data['foto'] 		   = addslashes(file_get_contents($_FILES['file_photo']['tmp_name']));	
		$data['picname'] 	   = $_FILES['file_photo']['name'];	

		$result                = $model->mupdate($this->table, $data, 'user_id', $_SESSION['userid'], $this->title);
		//if(isset($_FILES['file_photo'])){ 

		$rs = $model->uploadfoto($_FILES['file_photo']);

			//  }
		return json_encode($rs);
	}

	public function updatecover()
	{
		$data                  = array();
		$model                 = $this->loadModel($this->model);
		$data['cover'] 		   = addslashes(file_get_contents($_FILES['file_cover']['tmp_name']));		
		$result                = $model->mupdate($this->table, $data, 'user_id', $_SESSION['userid'], $this->title);

		return json_encode($result);
	}

	public function updateinfo()
	{
		$result                = array();
		$data                  = array();
		$model                 = $this->loadModel($this->model);
		$data['user_fullname'] = htmlspecialchars($_REQUEST['user_fullname']) ;
		$data['jenis_kelamin'] = htmlspecialchars($_REQUEST['jenis_kelamin']) ;
		$data['tempat_lahir']  = htmlspecialchars($_REQUEST['tempat_lahir']) ;
		$data['tgl_lahir']     = htmlspecialchars($_REQUEST['tgl_lahir']) ;
		$data['email']         = htmlspecialchars($_REQUEST['email']) ;
		$data['telp']          = htmlspecialchars($_REQUEST['telp']) ;
		$data['alamat']        = htmlspecialchars($_REQUEST['alamat']) ;		
		$data['kota']          = htmlspecialchars($_REQUEST['kota']) ;
		$data['provinsi']      = htmlspecialchars($_REQUEST['provinsi']) ;
		$data['kode_pos']      = htmlspecialchars($_REQUEST['kode_pos']) ;
		
		if(!empty($data['user_fullname'])){
			$result['status']  = $model->mupdate($this->table, $data, 'user_id', $_SESSION['userid'], 'Update profile');
		} else {
			$update            = false;
			$result['error']   = "Tidak dapat diupdate";
		}

		return json_encode($result);
	}

	public function updateaccount()
	{
		global $config;
		$result                = array();
		$data                  = array();
		$model                 = $this->loadModel($this->model);
		$pass                  = $model->escapeString($_POST['current-password']) ;
		$auth                  = $model->checkuser($_SESSION['userid'], $pass, $config['key']);
		if($auth){
			$new     = $model->escapeString($_POST['new-password']) ;
			$confirm = $model->escapeString($_POST['confirm-password']) ;
			if($new == $confirm){
				$password              = $model->escapeString($_POST['new-password']) ;
				$passuser              = $model->passencrpyts($password,$config['key']);
				$data['user_password'] = $passuser;
				$result['status']      = $model->mupdate($this->table, $data, 'user_id', $_SESSION['userid'], 'Update account');
			} else {
				$result['status']  = false;
				$result['error']   = "Wrong current password";
			}
		}

		return json_encode($result);
	}

    
}