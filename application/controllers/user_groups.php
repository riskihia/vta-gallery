<?php

class User_groups extends Controller {

	private $table      = "tusergroup";
	private $dtable     = "tusermenu";
	private $primaryKey = "autono";
	private $model      = "User_groups_model"; # please write with no space
	private $menu       = "Utility";
	private $title      = "User Groups";
	private $curl       = BASE_URL."user_groups/";
	

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
		$template            = $this->loadView('user_groups_view');
		$template->set('data', $data);
		$template->render();
	}

	function get()
	{
		$request    = $_REQUEST;
		$columns = array(
			array( 'db' => 'autono',   'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'user_id',     'dt' => 1 ),
			array( 'db' => 'user_fullname',  'dt' => 2 ),
			array( 'db' => 'jabatanVal',        'dt' => 3 ),
			array( 'db' => 'user_grupVal',         'dt' => 4 )
		);

		$model   = $this->loadModel($this->model);
		$result  = $model->mget($request, $this->table, $this->primaryKey, $columns);

		return json_encode($result);
	}

	public function add()
	{
		$model               = $this->loadModel($this->model);
		$data                = array();
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['action']      = 'Add';
		$data['curl']		 = $this->curl;
		$template            = $this->loadView('user_groups_add');
		$template->set('data', $data);
		$template->render();
	}

	public function addchild($x)
	{
		$model               = $this->loadModel($this->model);
		$id                  = $this->base64url_decode($x);
		$data                = array();
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['action']      = 'Add';
		$data['curl']		 = $this->curl;
		$data['groups']      = $model->get_groups($id);
		$template            = $this->loadView('user_groups_addchild');
		$template->set('data', $data);
		$template->render();
	}

	public function edit($x)
	{
		$model               = $this->loadModel($this->model);
		$id                  = $this->base64url_decode($x);
		$parent_id           = $model->getval($this->table, 'parent_id', 'autono', $id);
		$data                = array();
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['action']      = 'Edit';
		$data['encode']      = $x;
		$data['curl']		 = $this->curl;
		$data['groups']      = $model->get_groups($parent_id);
		$data['aadata']      = $model->get($this->table, $this->primaryKey, $id);
		$template            = $this->loadView('user_groups_edit');
		$template->set('data', $data);
		$template->render();
	}

	public function editchild($x)
	{
		$id                  = $this->base64url_decode($x);
		$model               = $this->loadModel($this->model);
		$data                = array();
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['action']      = 'Edit';
		$data['encode']      = $x;
		$data['curl']		 = $this->curl;
		$data['groups']      = $model->get_groups($id);
		$data['aadata']      = $model->get($this->table, $this->primaryKey, $id);
		$template            = $this->loadView('user_groups_editchild');
		$template->set('data', $data);
		$template->render();
	}

	public function menu_privilege($x)
	{
		$model               = $this->loadModel($this->model);
		$id                  = $this->base64url_decode($x);
		$data                = array();
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['action']      = 'Menu Privilege';
		$data['encode']      = $x;
		$data['curl']		 = $this->curl;
		$data['groups']      = $model->get_groups($id, true);
		$data['aadata']      = $model->get($this->table, $this->primaryKey, $id);
		$template            = $this->loadView('user_groups_menudprivilege');
		$template->set('data', $data);
		$template->render();
	}

	public function save()
	{
		$data                  = array();
		$model                 = $this->loadModel($this->model);
		$data['group_name']    = htmlspecialchars($_REQUEST['group_name']) ;
		$data['description']   = htmlspecialchars($_REQUEST['description']) ;
		$data['parent_id']     = 0 ;
		$result                = $model->msave($this->table, $data, $this->title);
		$this->redirect('user_groups');
	}

	public function savechild()
	{
		$data                  = array();
		$model                 = $this->loadModel($this->model);
		$data['group_name']    = htmlspecialchars($_REQUEST['group_name']) ;
		$data['description']   = htmlspecialchars($_REQUEST['description']) ;
		$data['parent_id']     = htmlspecialchars($_REQUEST['parent_id']) ; 
		$result                = $model->msave($this->table, $data, $this->title);
		$this->redirect('user_groups');
	}

	public function update($x)
	{
		$data                  = array();
		$id                    = $this->base64url_decode($x);
		$model                 = $this->loadModel($this->model);
		$data['group_name']    = htmlspecialchars($_REQUEST['group_name']) ;
		$data['description']   = htmlspecialchars($_REQUEST['description']) ;
		$data['parent_id']     = isset($_REQUEST['parent_id']) ? htmlspecialchars($_REQUEST['parent_id']) : 0 ; 
		$result                = $model->mupdate($this->table, $data, $this->primaryKey, $id, $this->title);
		$this->redirect('user_groups');
	}

	public function updatechild($x)
	{
		$data                  = array();
		$id                    = $this->base64url_decode($x);
		$model                 = $this->loadModel($this->model);
		$data['group_name']    = htmlspecialchars($_REQUEST['group_name']) ;
		$data['description']   = htmlspecialchars($_REQUEST['description']) ;
		$data['parent_id']     = htmlspecialchars($_REQUEST['parent_id']) ; 
		
		$result                = $model->mupdate($this->table, $data, $this->primaryKey, $id, $this->title);
		$this->redirect('user_groups');
	}

	public function delete($x)
	{
		$id                 = $this->base64url_decode($x);
		$model              = $this->loadModel($this->model);
		$result             = $model->mdelete($this->table, $this->primaryKey, $id, $this->title);
		return $result;
	}

	public function treemenu($id)
	{
		global $config;

		$model  = $this->loadModel($this->model);

		$group_id = $this->base64url_decode($id);
		
		$result = $model->show_menu_admin($group_id);

	    while ($row = $model->fetch_object($result)) {
	        $data[$row->parent_id][] = $row;
	    }
	       
	    $menu = $this->get_menutree($data);
	    echo (json_encode($menu));
	}

	public function get_menutree($data, $parent = 0) 
    {
      static $i = 1;
      $datas = array();
      if (isset($data[$parent])) {
        foreach ($data[$parent] as $v) {
			$child               = $this->get_groups($data, $v->id);
			$row['key']          = $this->base64url_encode($v->id);
			$row['title']        = $v->title;
			$row['parent_id']    = (int) $v->parent_id;
			$row['expanded']     = false;
			$row['selected']     = boolval( $v->permission_a );
			$row['folder']       = false;
			$row['extraClasses'] = "";
			$row['tooltip']      = $v->description;
			$row['children']     = array();
          if ($child) {          
            $row['children']     =  $child;
          }
          array_push($datas,$row);
        }
        return $datas;
      } else {
        return false;
      }
    }


	public function tree($id)
	{
		global $config;

		$model  = $this->loadModel($this->model);
		
		$result = $model->show_groups();

	    while ($row = $model->fetch_object($result)) {
	        $data[$row->parent_id][] = $row;
	    }
	       
	    $groups = $this->get_groups($data);
	    echo (json_encode($groups));
	}

	public function get_groups($data, $parent = 0) 
    {
      static $i = 1;
      $datas = array();
      if (isset($data[$parent])) {
        foreach ($data[$parent] as $v) {
			$child               = $this->get_groups($data, $v->id);
			$row['key']          = $this->base64url_encode($v->id);
			$row['title']        = $v->title;
			$row['parent_id']    = (int) $v->parent_id;
			$row['selected']     = boolval( $v->permission_a );
			$row['expanded']     = true;
			$row['folder']       = false;
			$row['extraClasses'] = "";
			$row['tooltip']      = $v->description;
			$row['children']     = array();
          if ($child) {          
            $row['children']     =  $child;
          }
          array_push($datas,$row);
        }
        return $datas;
      } else {
        return false;
      }
    }

    public function postdata($x)
	{
		$model      = $this->loadModel($this->model);
		$datas      = $_REQUEST['menuarr'];
		$group_id   = $this->base64url_decode($x);
		$group_name = $model->getval('tusergroup', 'group_name', 'autono', $group_id);
		$reset      = $model->execute("DELETE FROM $this->dtable WHERE group_id = $group_id");
		$j          = count($datas);

		for ($i=0; $i < $j; $i++) { 
			$data['group_id']   = $group_id;
			$data['group_name'] = $group_name;
			$data['menu_id']    = $this->base64url_decode($datas[$i]['key']);
			if($datas[$i]['selected'] == true){
				$data['permission_a'] = 1;
			} else {
				$data['permission_a'] = 0;
			}
			
			$result                   = $model->execute("INSERT INTO $this->dtable (`group_id`, `group_name`, `menu_id`, `permission_a`) VALUES ('".$data['group_id']."','".$data['group_name']."', '".$data['menu_id']."', '".$data['permission_a']."')");
		}
		
		echo json_encode($result);
	}

	
    
}