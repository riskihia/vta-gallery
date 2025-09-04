<?php

class Auth extends Controller {

    private $table      = "tuser";
    private $primaryKey = "autono";
    private $model      = "Auth_model"; # please write with no space
    private $menu       = "Utility";
    private $title      = "Auth Login";
    private $curl       = BASE_URL."auth/";

    function index()
    {
        $session = $this->loadHelper('Session_helper');
        if($session->get('username')){
            $this->redirect('./');
        } else {
            $this->redirect('auth/login');
        }
        
    }
    
    function login()
    {
    	$template = $this->loadView('login');
		$template->render();
    }

    // function logout()
    // {
    //     $session  = $this->loadHelper('Session_helper');
    //     $session->set('username', '');
    //     $session->destroy();
    //     $this->redirect('./');
    // }

    // function signin()
    // {
    //     global $config;
    //     $session  = $this->loadHelper('Session_helper');
    //     $auth     = $this->loadModel($this->model);
    //     $username = $auth->escapeString($_POST['username']);
    //     $password = $auth->escapeString($_POST['password']);
    //     $data     = $auth->check($username, $password, $config['key']);
    //     $value    = '';
    //     if($data){
    //         $session->set('username', $data[0][3]);
    //         $session->set('userid', $data[0][2]);
    //         $session->set('groupid', $data[0][5]);
    //         $session->set('groupname', $data[0][6]);
    //         $session->set('level_id', $data[0][7]);
    //         $session->set('level_name', $data[0][8]);
    //         $session->set('location_id', '0');
    //         $session->set('location_name', '-');
    //         $this->redirect('./');
    //     } else {
    //         $value = 'yes';
    //         $template = $this->loadView('login');
    //         $template->set('messages', $value);
    //         $template->render();
    //     }   
    // }

	function logout()
    {
        $session        = $this->loadHelper('Session_helper');
        $auth           = $this->loadModel($this->model);
        $user           = array();
        $user['status'] = 0;
        $result         = $auth->sqlupdate($this->table, $user, 'user_id', $_SESSION['userid'], "User logout");
        $session->set('username', '');
        $session->destroy();
        $this->redirect('./');
    }
	
	function signin()
    {
        global $config;
        $session        = $this->loadHelper('Session_helper');
        $auth           = $this->loadModel($this->model);
        $username       = $auth->escapeString($_POST['username']);
        $password       = $auth->escapeString($_POST['password']);
        $data           = $auth->check($username, $password, $config['key']);      
        $value          = '';
        if($data){
            $user               = array();
            $user['status']     = 1;
            $user['wb_ol_time'] = date('Y-m-d H:i:s');
            $user['ip']         = $_SERVER['REMOTE_ADDR'];
            
            $session->set('id', $data[0][0]);
            $session->set('username', $data[0][2]);
            $session->set('userid', $data[0][2]);
            $session->set('userfullname', $data[0][3]);
            $session->set('groupid', $data[0][5]);
            $session->set('groupname', $data[0][6]);
            $session->set('level_id', $data[0][7]);
            $session->set('level_name', $data[0][8]);
            $session->set('location_id', $data[0][7]);
            $session->set('location_name', $data[0][8]);
            $session->set('list_office', $data[0][10]);
            $result             = $auth->sqlupdate($this->table, $user, 'user_id', $_SESSION['userid'], "User login");
            $log                = $auth->log($config['db_name'], 'User login', 'Login', 'Login Query', 1);
            $this->redirect('./');
        } else {
            $value    = 'yes';
            $template = $this->loadView('login');
            $template->set('messages', $value);
            $template->render();
        }   
    }

    public function change_password()
    {
        $data['breadcrumb1'] = $this->menu;
        $data['title']       = 'Change Password';
        $data['curl']        = $this->curl;
        $template            = $this->loadView('users_changepassword');
        $template->set('data', $data);
        $template->render();
    }

    public function change_password_info()
    {
       global $config;
        $data                     = array();
        $model                    = $this->loadModel($this->model);
        $username                 = $_SESSION['userid'];

        if(isset($_REQUEST['current_password'])) {$data['current_password'] = $model->escapeString($_REQUEST['current_password']); } else { $data['current_password'] =  null; } ;
        if(isset($_REQUEST['new_password'])) { $data['new_password'] =  $model->escapeString($_REQUEST['new_password']); } else { $data['new_password'] =  null; } ;
        if(isset($_REQUEST['confirm_password'])) { $data['confirm_password'] = $model->escapeString($_REQUEST['confirm_password']); } else { $data['confirm_password'] =  null; } ;
        
        if(isset($data['current_password'])){
            $checkpass                = $model->check($username, $data['current_password'], $config['key']);
            if($checkpass){
                if($data['new_password'] == $data['confirm_password']){
                    $ex = $model->execute("UPDATE $this->table SET user_password='".$model->passencrpyt($data['new_password'], $config['key'])."' WHERE user_id = '".$username."'");
                    if($ex){
                        $data['messages'] = "Success..the password was successfully changed :)";
                        $data['tipe']     = "success";
                    }
                } else {
                    $data['messages'] = "Sorry , your password dont match. Please re-enter your new password!";
                    $data['tipe']     = "warning";
                }

            } else {
                $data['messages'] = "Sorry, your current password is wrong!";
                $data['tipe']     = "danger";
            }
        } else {
            $data['messages'] = "Please enter your password";
            $data['tipe']     = "danger";
        }
        

        $data['breadcrumb1'] = $this->menu;
        $data['title']       = 'Change Password';
        $data['curl']        = BASE_URL."auth/change_password";
        $data['userid']      = $_SESSION['userid'];
        $template            = $this->loadView('users_changepassword_status');
        $template->set('data', $data);
        $template->render();
    }
}