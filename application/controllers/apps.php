<?php

class Apps extends Controller {

	private $table      = "tprojectapps";
	private $primaryKey = "autono";
	private $model      = "Apps_model"; # please write with no space
	private $menu       = "Utilitas";
	private $title      = "Apps";
	private $curl       = BASE_URL."apps/";
	private $surl       = 1;

	public function __construct()
    {
        $session = $this->loadHelper('Session_helper');
        //$model   =  $this->loadModel($this->model);
        
        if(!$session->get('username')){
        	$this->redirect('auth/login');
        } 
    }
	
	function index()
	{
		$data                = array();
		$model 				 = $this->loadModel($this->model);
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['curl']		 = $this->curl;
		//$data['menu']		 = $model->generate_menu_list(0);
		$template            = $this->loadView('app_view');
		$template->set('data', $data);
		$template->render();
	}

	function get()
	{
		$request    = $_REQUEST;
		$columns = array(
			array( 'db' => 'autono', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'nama',  'dt' => 1 ),
			array( 'db' => 'projectsVal',  'dt' => 2 ),
			array( 'db' => 'clientsVal',  'dt' => 3 ),
			array( 'db' => 'keterangan',   'dt' => 4 ),
			array( 'db' => 'created_on',   'dt' => 5 )
		);

		$data   = $this->loadModel($this->model);
		$result = $data->mget($request, $this->table, $this->primaryKey, $columns);

		$row = json_encode($result);
		return $row;
	}

	function gettable($id)
	{
		$request    = $_REQUEST;
		$uri        = $this->loadHelper('Url_helper');
		$menu_id    = $this->base64url_decode($id);
		$kode_apps  = $this->base64url_decode($uri->segment(2));
		$columns = array(
			array( 'db' => 'column_id', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'column_name',  'dt' => 1 ),
			array( 'db' => 'data_type',  'dt' => 2 ),
			array( 'db' => 'length_data',  'dt' => 3 ),
			array( 'db' => 'column_id',  'dt' => 4 ),
			array( 'db' => 'input_type',  'dt' => 5 )
		);

		$data   = $this->loadModel($this->model);
		$result = $data->mgettable($request, "app_generate_column", "column_id", $columns, $menu_id, $menu_id);

		// $row = json_encode($result);
		// return $row;
		return json_encode($result,JSON_NUMERIC_CHECK);
	}

	function gettabledetail($id)
	{
		$request    = $_REQUEST;
		$uri        = $this->loadHelper('Url_helper');
		$menu_id    = $this->base64url_decode($id);
		$columns = array(
			array( 'db' => 'column_id', 'dt' => 0, 'formatter' => function( $d, $row ) { return $this->base64url_encode($d); } ),
			array( 'db' => 'column_name',  'dt' => 1 ),
			array( 'db' => 'data_type',  'dt' => 2 ),
			array( 'db' => 'length_data',  'dt' => 3 ),
			array( 'db' => 'column_id',  'dt' => 4 ),
			array( 'db' => 'input_type',  'dt' => 5 )
		);

		$data   = $this->loadModel($this->model);
		$result = $data->mgettable($request, "app_generate_column_detail", "column_id", $columns, $menu_id);

		// $row = json_encode($result);
		// return $row;

		return json_encode($result,JSON_NUMERIC_CHECK);
	}

	function gettableimport($id)
	{
		$data          = array();
		$model         = $this->loadModel($this->model);
		$menu_id       = $this->base64url_decode($id);
		$data['modul'] = $model->getmenuimport("tmenu", "menu_id", $menu_id);

		return json_encode($data);
	}

	function getcolumn()
	{
		$data               = array();
		$model              = $this->loadModel($this->model);
		$column_id          = 0;
		$data['modul']      = $model->getcolumnedit("app_generate_column", "column_id", $column_id);
		$data['data_type']  = $model->data_type_edit($column_id, "app_generate_column");
		$data['input_type'] = $model->input_type_edit($column_id, "app_generate_column");

		return json_encode($data);
	}

	function getcolumnedit($id)
	{
		$data               = array();
		$model              = $this->loadModel($this->model);
		$column_id          = $this->base64url_decode($id);
		$data['modul']      = $model->getcolumnedit("app_generate_column", "column_id", $column_id);
		$data['data_type']  = $model->data_type_edit($column_id,"app_generate_column");
		$data['input_type'] = $model->input_type_edit($column_id, "app_generate_column");

		return json_encode($data);
	}

	function getcolumneditdetail($id)
	{
		$data               = array();
		$model              = $this->loadModel($this->model);
		$column_id          = $this->base64url_decode($id);
		$data['modul']      = $model->getcolumnedit("app_generate_column_detail", "column_id", $column_id);
		$data['data_type']  = $model->data_type_edit($column_id, "app_generate_column_detail");
		$data['input_type'] = $model->input_type_edit($column_id, "app_generate_column_detail");

		return json_encode($data);
	}

	function getalltables($id)
	{
		global $config;
		$data          = array();
		$model         = $this->loadModel($this->model);
		$menu_id       = $this->base64url_decode($id);
		$data['modul'] = $model->getmenuimport("tmenu", "menu_id", $menu_id);
		$data['table'] = $model->showtables($config['db_name'], $menu_id);

		return json_encode($data);
	}

	function getallcolumns($id)
	{
		$data           = array();
		$model          = $this->loadModel($this->model);
		$menu_id        = $this->base64url_decode($id);
		$data['column'] = $model->showcolumns($id);

		return json_encode($data);
	}

	public function savetablereport($x)

	{

		$data                  = array();	
		$id                    = $this->base64url_decode($x);		
		$model                 = $this->loadModel($this->model);		
		$data['menu_id']       = $model->escapeString($_REQUEST['menu_id_report']) ;
		$data['table_name']    = $model->escapeString($_REQUEST['from_table']) ;

		$jcolumn               = count($_REQUEST['columns']);
		$menu_id               = $data['menu_id'];
		$reset_table           = $model->execute("DELETE FROM app_generate_table_report WHERE menu_id = $menu_id");
		$result                = $model->msave("app_generate_table_report", $data, "Add table report");


		$reset_columns   = $model->execute("DELETE FROM app_generate_column_report WHERE menu_id = $menu_id");
		

		for ($i=0; $i < $jcolumn ; $i++) { 
			$column['menu_id']         = $menu_id;
			$column['column_name']     = $model->escapeString($_REQUEST['columns'][$i]);
			$columnresult              = $model->msave("app_generate_column_report", $column, "Insert column name");
		}

		// $this->redirect('apps/menu_designer/'.$x);	

		$this->redirect('apps/generate_report/'.$x.'/'.$menu_id.'/');	

	}

	public function treemenu($id)
	{
		$model  = $this->loadModel($this->model);
		$app       = $model->getinstance("tprojectapps", "autono", $this->base64url_decode($id));

		$result = $model->show_menus( $_SESSION['groupid'] );

	    while ($row = $model->fetch_object($result)) {
	        $data[$row->parent_id][] = $row;
	    }
	       
	    $menu = $this->get_menu($data);
	    echo (json_encode($menu));
	}

	public function get_menu($data, $parent = 0) 
    {
      static $i = 1;
      $datas = array();
      if (isset($data[$parent])) {
        foreach ($data[$parent] as $v) {
			$child               = $this->get_menu($data, $v->id);
			$row['key']          = $this->base64url_encode($v->id);
			$row['title']        = $v->title;
			$row['expanded']     = false;
			$row['folder']       = true;
			$row['extraClasses'] = "#";
			$row['tooltip']      = $v->parent_id;
			$row['enabled']      = $v->enabled;
			$row['linkto']       = $v->linkto;
			$row['menu_icon']    = $v->menu_icon;
			$row['menuid']       = $v->id;
			$row['menuname']     = $v->menu_name;
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

	public function create_app()
	{
		$data                = array();
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['action']      = 'Add';
		$data['curl']        = $this->curl;
		$model               = $this->loadModel($this->model);
		$data['project']     = $model->projects();
		$data['apps_type']   = $model->apps_type();
		$data['team']        = $model->team();
		$template            = $this->loadView('app_add');
		$template->set('data', $data);
		$template->render();
	}

	public function development($x, $success = 0)
	{
		$uri                 = $this->loadHelper('Url_helper');
		$id                  = $this->base64url_decode($x);
		$model               = $this->loadModel($this->model);
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = "Development Area";
		$data['action']      = 'Show';
		$data['curl']        = $this->curl;
		$data['encode']      = $x;
		$data['success']     = $success;
		$data['app']         = $model->getinstance($this->table, $this->primaryKey, $id);
		$template            = $this->loadView('app_dev');
		$template->set('data', $data);
		$template->render();
	}

	function treesample()
	{

		$model               = $this->loadModel($this->model);
		$result = $model->execute("SELECT * FROM tmenu ");

		while($row = $model->fetch_array($result))
		{
		 $sub_data["id"] = $row["id"];
		 $sub_data["menu_name"] = $row["menu_name"];
		 $sub_data["menu_desc"] = $row["menu_desc"];
		 $sub_data["parent_id"] = $row["parent_id"];
		 $data[] = $sub_data;
		}

		foreach($data as $key => &$value)
		{
		 $output[$value["id"]] = &$value;
		}

		foreach($data as $key => &$value)
		{
		 if($value["parent_id"] && isset($output[$value["parent_id"]]))
		 {
		  $output[$value["parent_id"]]["nodes"][] = &$value;
		 }
		}

		foreach($data as $key => &$value)
		{
		 if($value["parent_id"] && isset($output[$value["parent_id"]]))
		 {
		  unset($data[$key]);
		 }
		}
		echo json_encode($data);
		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
	}



	public function menu_designer($x)
	{
		$uri                 = $this->loadHelper('Url_helper');
		$id                  = $this->base64url_decode($x);
		$model               = $this->loadModel($this->model);
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['action']      = 'Show';
		$data['curl']        = $this->curl;
		$data['encode']      = $x;
		$data['app']         = $model->getinstance($this->table, $this->primaryKey, $id);
		$template            = $this->loadView('app_menudsgn');
		// $template            = $this->loadView('developer');
		$template->set('data', $data);
		$template->render();
	}

	public function assign_modul($x)
	{
		$uri                 = $this->loadHelper('Url_helper');
		$id                  = $this->base64url_decode($x);
		$model               = $this->loadModel($this->model);
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['action']      = 'Show';
		$data['curl']        = $this->curl;
		$data['encode']      = $x;
		$data['app']         = $model->getinstance($this->table, $this->primaryKey, $id);
		$data['team']        = $model->team($id);
		$template            = $this->loadView('app_assign_modul');
		$template->set('data', $data);
		$template->render();
	}

	public function addparent($id)
	{
		$uri                 = $this->loadHelper('Url_helper');
		$data                = array();
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['action']      = 'Add Parent';
		$data['curl']        = $this->curl;
		$data['project']     = $id;
		$template            = $this->loadView('app_menudsgn_parent_add');
		$template->set('data', $data);
		$template->render();
	}

	public function addchild($x, $y)
	{
		$uri                 = $this->loadHelper('Url_helper');
		$model               = $this->loadModel($this->model);
		$data                = array();
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['action']      = 'Add Child';
		$data['curl']        = $this->curl;
		$data['project']     = $x;
		$data['encode']      = $y;
		$id                  = $this->base64url_decode($y);
		$data['modul']       = $model->getinstance("tmenu", "menu_id", $id);
		$template            = $this->loadView('app_menudsgn_child_add');
		$template->set('data', $data);
		$template->render();
	}

	public function editmenu($x, $y)
	{
		$uri                 = $this->loadHelper('Url_helper');
		$model               = $this->loadModel($this->model);
		$app_id              = $this->base64url_decode($x);
		$id                  = $this->base64url_decode($y);
		$data['curl']        = $this->curl;
		$data                = array();
		
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['action']      = 'Edit Menu';
		$data['curl']        = $this->curl;
		$data['project']     = $x;
		$data['encode']      = $y;
		$data['app']         = $model->getinstance($this->table, $this->primaryKey, $app_id);
		$data['icons']       = $model->query("SELECT a.menu_icon, a.`icons`, IF(b.menu_icon IS NULL, '', 'selected') AS pselct FROM icons  a  LEFT JOIN ( SELECT  menu_id, menu_icon FROM tmenu WHERE menu_id = $id) b ON b.`menu_icon` = a.`menu_icon` ");
		$data['modul']       = $model->getinstance("tmenu", "menu_id", $id);
		$parent              = $model->getval("tmenu", "parent_id", "menu_id", $id);
		$data['parent']      = $model->getinstance("tmenu", "menu_id", $parent);

		if($parent == 0){
			$template            = $this->loadView('app_menudsgn_parent_edit');
		} else {
			$template            = $this->loadView('app_menudsgn_child_edit');
		}
		
		$template->set('data', $data);
		$template->render();
	}

	public function table_define($x, $y)
	{
		$uri                    = $this->loadHelper('Url_helper');
		$model                  = $this->loadModel($this->model);
		$data                   = array();
		$data['breadcrumb1']    = $this->menu;
		$data['title']          = $this->title;
		$data['action']         = 'Table Structure';
		$data['curl']           = $this->curl;
		$data['project']        = $x;
		$data['encode']         = $y;
		$id                     = $this->base64url_decode($y);
		$app_id                 = $this->base64url_decode($x);
		$table                  = $model->getinstance("app_generate_table", "menu_id", $id);
		$data['app']            = $model->getinstance($this->table, $this->primaryKey, $app_id);
		$data['table_name']     = $table['table_name'];
		$data['table_autocode'] = $table['autocode'];
		$data['modul']          = $model->getinstance("tmenu", "menu_id", $id);
		$data['data_type']      = $model->data_type();
		$data['input_type']     = $model->input_type();
		$template               = $this->loadView('app_menudsgn_table_define');
		$template->set('data', $data);
		$template->render();
	}


	public function generate($x, $y, $i = 0)
	{
		//$uri           = $this->loadHelper('Url_helper');
		global $config;
		$id_project    = $this->base64url_decode($x);
		$id_menu       = $this->base64url_decode($y);
		$model         = $this->loadModel($this->model);
		$project       = $model->getinstance("tprojectapps", "autono", $id_project); 
		$menu          = $model->getinstance("tmenu", "menu_id", $id_menu);
		$parent        = $model->getinstance("tmenu", "menu_id", $menu['parent_id']);
		$db            = $model->getinstance("app_db_config", "code_apps", $project['autocode']);
		$table         = $model->getinstance("app_generate_table", "menu_id", $id_menu);
		$column        = $model->getreport("app_generate_column", "menu_id", $id_menu, 'column_id');
		$column_detail = $model->getreport("app_generate_column_detail", "menu_id", $id_menu, 'column_id');
		
		$dst           = ROOT_DIR; 

		if($menu['parent_id'] == 0){

			$file_name     = strtolower(preg_replace("([^\w\s\d\-_~,;:\[\]\(\).]|[\.]{2,})", '', str_replace(" ", "_", $menu['menu_name']))); 

			// $file_name     = strtolower(preg_replace("([^\w\s\d\-_~,;:\[\]\(\).]|[\.]{2,})", '', str_replace(" ", "_", $menu['menu_name'].$menu['parent_id']))); 

		} else {
			$file_name          = strtolower(preg_replace("([^\w\s\d\-_~,;:\[\]\(\).]|[\.]{2,})", '', str_replace(" ", "_", $menu['menu_name']))); 
			// $file_name     = strtolower(preg_replace("([^\w\s\d\-_~,;:\[\]\(\).]|[\.]{2,})", '', str_replace(" ", "_", $parent['menu_name'].' '.$menu['menu_name'].$menu['parent_id'])));
			
		}

		//echo $file_name; exit;
		

		// Start generate controller
		$controller_script  = $model->tempscript('controller'); 
		$controller_dir     = ROOT_DIR."/application/controllers/";
		$controller         = fopen($controller_dir.$file_name.".php", "w") or die("Unable to open file controller!");
		$controller_content = $controller_script;
		$controller_content = str_replace("#class#", ucfirst($file_name), $controller_content);
		$controller_content = str_replace("#table#", $table['table_name'], $controller_content);
		$controller_content = str_replace("#autocode#", $table['autocode'], $controller_content);
		$controller_content = str_replace("#model#", ucfirst($file_name), $controller_content);
		$controller_content = str_replace("#menu#", $parent['menu_name'], $controller_content);
		$controller_content = str_replace("#title#", $menu['menu_name'], $controller_content);
		$controller_content = str_replace("#url#", $file_name, $controller_content);
		$jcol               = count($column);

		$arrcol     = '';
		$arrcolumns = '';
		$headerview = '';
		$dataview   = '';
		$dataadd    = '';
		$dataedit   = '';

		$i = 1;
		foreach ($column as $key => $col) {
			$arrcol .= "array( 'db' => '".$col['column_name']."',  'dt' => ".$i++." ),";
			if($col['input_type'] == 'file'){
				$arrcolumns .= "\t\t".'$data['."'".$col['column_name']."'".'] = !empty($_FILES['."'".$col['column_name']."'".']['."'name'".'][0]) ?  1 : 0 ;'."\n";		

				$arrfile  .= '$files1	= array();
		$files1['."'dir'".'] 			 = "'.str_replace(" ", "_", strtolower($menu['menu_name'])).'";
		$files1['."'subdir'".'] 		 = trim($_SESSION['."'username'".']);
		if(!empty($_FILES['."'".$col['column_name']."'".']['."'name'".'][0])) {
		    $file_ary1 = $model->reArrayFiles($_FILES['."'".$col['column_name']."'".']);
		    foreach ($file_ary1 as $file1) {
				$files1['."'kode_parent'".'] = $data['."'autocode'".'];
				$files1['."'parent_id'".']   = $result['."'id'".'];;
            	$files1['."'nama_file'".']   = $file1['."'name'".'];
				$files1['."'tipe_file'".']   = $file1['."'type'".'];
				$files1['."'ukuran'".']      = $file1['."'size'".'];
				$files1['."'ftable'".']      = $this->table;
				$files1['."'structured'".']  = 1;

				if(!empty($file1['."'name'".'])){ $model->savefile($files1); } 
				# Update field dokumen
				$f1                 = array();
				$f1['."'".$col['column_name']."'".'] = 1;
				$row1               = $model->mupdate($this->table,$f1, $this->primaryKey, $id, $this->title);
			    }
		}
		# Upload file
		if(isset($_FILES['."'".$col['column_name']."'".'])){ $model->uploads($files1['."'dir'".'], $_FILES['."'".$col['column_name']."'".'], "", $files1['."'subdir'".']); }';
				$dataview .= "\t\t\t\t\t\t"."{ 
	                ".'"data"'.": null,
	                ".'"width"'.": 80,
	                ".'"sortable"'.": false,
	                ".'"className"'.": ".'"center text-nowrap"'.",
	                ".'"render"'.": function ( data, type, row, meta ) {
	                       if(row[".($i-1)."] == 1 ){
	                        return ".'"<a href=\"#\" onClick=\"showfiles(1,'."'".'"+row[0]+"'."'".','."'".'"+row[3]+"'."'".')\" class=\"btn-sx\" data-toggle=\"modal\" data-target=\"#modal_form\" title=\"View Dokumen\"><i class=\"icon-images2 grey\"></i></a> "'.";
	                          
	                       } else {
	                          return '';
	                       }  
	                   }
	            },"."\n";
						
			} else {
				$arrcolumns .= "\t\t".'$data['."'".$col['column_name']."'".'] = htmlspecialchars($_REQUEST['."'".$col['column_name']."'".']) ;'."\n";
				$dataview   .= "\t\t\t\t\t\t"."{".'"data"'.": ".($i-1).",width:'auto'},"."\n";
			}


					
			$headerview .= "\t\t\t\t\t\t\t\t\t"."<th class=\"text-center\">".ucfirst(str_replace('_', ' ', $col['column_name']))."</th>"."\n";
			

			

			if($col['input_type'] == 'date'){

				$dataadd  .= "\t\t\t\t\t\t"."<div class=\"form-group\">
                            <label class=\"control-label col-lg-2\">".ucfirst(str_replace('_', ' ', $col['column_name']))."</label>
                            <div class=\"col-lg-4\">
                            <div class=\"input-group\">
                             <span class=\"input-group-addon\"><i class=\"icon-calendar\"></i></span>
                             <input type=\"".$col['input_type']."\" class=\"form-control\" name=\"".$col['column_name']."\" value=\"\">
                            </div>
                            </div>
                          </div>\n";
                $dataedit  .= "\t\t\t\t\t\t"."<div class=\"form-group\">
                            <label class=\"control-label col-lg-2\">".ucfirst(str_replace('_', ' ', $col['column_name']))."</label>
                            <div class=\"col-lg-4\">
                            <div class=\"input-group\">
                             <span class=\"input-group-addon\"><i class=\"icon-calendar\"></i></span>
                             <input type=\"".$col['input_type']."\" class=\"form-control\" name=\"".$col['column_name']."\" value=\"<?php echo ".'$value['."'".$col['column_name']."'".']'." ?>\">
                            </div>
                          </div>
                          </div>\n";

			} elseif ($col['input_type'] == 'textarea'){
				$dataadd  .= "\t\t\t\t\t\t"."<div class=\"form-group\">
                            <label class=\"control-label col-lg-2\">".ucfirst(str_replace('_', ' ', $col['column_name']))."</label>
                            <div class=\"col-lg-10\">
                             <textarea rows=\"5\" cols=\"5\" class=\"form-control\" placeholder=\"\" name=\"".$col['column_name']."\" ></textarea>
                            </div>
                          </div>\n";

                $dataedit  .= "\t\t\t\t\t\t"."<div class=\"form-group\">
                            <label class=\"control-label col-lg-2\">".ucfirst(str_replace('_', ' ', $col['column_name']))."</label>
                            <div class=\"col-lg-10\">
                             <textarea rows=\"5\" cols=\"5\" class=\"form-control\" placeholder=\"\" name=\"".$col['column_name']."\" ><?php echo ".'$value['."'".$col['column_name']."'".']'." ?></textarea>
                            </div>
                          </div>\n";

            } elseif (($col['input_type'] == 'file')){

            	$dataadd  .= "\t\t\t\t\t\t"."<div class=\"form-group\">
                            <label class=\"control-label col-lg-2\">".ucfirst(str_replace('_', ' ', $col['column_name']))."</label>
                            <div class=\"col-lg-10\">
                             <input type=\"".$col['input_type']."\" class=\"file-input\" multiple=\"multiple\" name=\"".$col['column_name']."[]\" data-show-upload=\"false\" data-show-caption=\"true\" data-show-preview=\"true\" accept=\"*\">
                            </div>
                          </div>\n";

                $dataedit  .= "\t\t\t\t\t\t"."<div class=\"form-group\">
                            <label class=\"control-label col-lg-2\">".ucfirst(str_replace('_', ' ', $col['column_name']))."</label>
                            <div class=\"col-lg-10\">
                             <input type=\"".$col['input_type']."\" class=\"file-input\" multiple=\"multiple\" name=\"".$col['column_name']."[]\" data-show-upload=\"false\" data-show-caption=\"true\" data-show-preview=\"true\" accept=\"*\">
                            </div>
                          </div>\n";

			} else {
				$dataadd  .= "\t\t\t\t\t\t"."<div class=\"form-group\">
                            <label class=\"control-label col-lg-2\">".ucfirst(str_replace('_', ' ', $col['column_name']))."</label>
                            <div class=\"col-lg-10\">
                             <input type=\"".$col['input_type']."\" class=\"form-control\" name=\"".$col['column_name']."\" >
                            </div>
                          </div>\n";

                $dataedit  .= "\t\t\t\t\t\t"."<div class=\"form-group\">
                            <label class=\"control-label col-lg-2\">".ucfirst(str_replace('_', ' ', $col['column_name']))."</label>
                            <div class=\"col-lg-10\">
                             <input type=\"".$col['input_type']."\" class=\"form-control\" name=\"".$col['column_name']."\" value=\"<?php echo ".'$value['."'".$col['column_name']."'".']'." ?>\" >
                            </div>
                          </div>\n";
			}

			


            
		}
		$headerview .= "\t\t\t\t\t\t\t\t\t"."<th class=\"text-center\">Actions</th>"."\n";

		if(count($column_detail) > 0) {
			$headerview .= "\t\t\t\t\t\t\t\t\t"."<th class=\"text-center\">Details</th>"."\n";
		}
		
		$controller_content = str_replace("#columns_table#", $arrcol, $controller_content);
		$controller_content = str_replace("#columns#", $arrcolumns, $controller_content);
		$controller_content = str_replace("#filesupload#", $arrfile, $controller_content);
		
		fwrite($controller, $controller_content);
		fclose($controller);


		// Start generate model
		$models_script  = $model->tempscript('model'); 
		$models_dir     = $dst."/application/models/";
		$models         = fopen($models_dir.$file_name."_model.php", "w") or die("Unable to open file model!");
		$models_content = $models_script;
		$models_content = str_replace("#class#", ucfirst($file_name), $models_content);
		fwrite($models, $models_content);
		fclose($models);



		// Start generate view
		$view_script  = $model->tempscript('view'); 
		$view_dir     = $dst."/application/views/";
		$view         = fopen($view_dir.$file_name."_view.php", "w") or die("Unable to open file view!");
		$view_content = $view_script;
		$btn_detail   = '';
		$view_content = str_replace("#headerview#", $headerview, $view_content);
		$view_content = str_replace("#dataview#", $dataview, $view_content);
		$view_content = str_replace("#btndetail#", $btn_detail, $view_content);
		if(count($column_detail) > 0) {
			$action_detail = "           ,{
			                \"data\": null,
			                \"width\": 50,
			                \"sortable\": false,
			                \"className\": \"center\",
			                \"render\": function ( data, type, row, meta ) {
			                     return '<a href=\"<?php echo ".'$data['."'curl'".']'."  ?>_detail/detail/'+row[0]+'\" class=\"btn-sx cyan\" data-popup=\"tooltip\" data-original-title=\"Top tooltip\"><i class=\"icon-folder5\"></i></a>  ';
			                 }
			            }";
			$view_content = str_replace("//detail", $action_detail, $view_content);
		}
		fwrite($view, $view_content);
		fclose($view);


		// Start generate Add
		$add_script  = $model->tempscript('add'); 
		$add_dir     = $dst."/application/views/";
		$add         = fopen($add_dir.$file_name."_add.php", "w") or die("Unable to open file add!");
		$add_content = $add_script;
		$add_content = str_replace("#formadd#", $dataadd, $add_content);
		fwrite($add, $add_content);
		fclose($add);


		// Start generate Edit
		$edit_script  = $model->tempscript('edit'); 
		$edit_dir     = $dst."/application/views/";
		$edit         = fopen($edit_dir.$file_name."_edit.php", "w") or die("Unable to open file edit!");
		$edit_content = $edit_script;
		$edit_content = str_replace("#formedit#", $dataedit, $edit_content);
		fwrite($edit, $edit_content);
		fclose($edit);

		// Create table
		$tableName   = $table['table_name'];
		$drop        = $model->execute("DROP TABLE IF EXISTS ".$config['db_name'].".`$tableName`;");
		$tableCreate = "CREATE TABLE ".$config['db_name'].".`$tableName` (".PHP_EOL;
		$tableCreate .= '`autono` int(11) NOT NULL AUTO_INCREMENT,'.PHP_EOL;
		$tableCreate .= '`parent_id` int(11) NOT NULL DEFAULT '."'".'0'."'".','.PHP_EOL;
		$tableCreate .= '`autocode` varchar(100) DEFAULT NULL,'.PHP_EOL;
		foreach ($column as $key => $value) {
			if($value['data_type'] != "text"){ $d = '('; $b = ')'; } else { $d = ''; $b = ''; }
			$tableCreate .= "`".$value['column_name']."` ".$value['data_type']."$d".$value['length_data']."$b "."NOT NULL ".$value['auto_increament'].",".PHP_EOL;
		}
		$tableCreate .= '`approve` int(11) NOT NULL DEFAULT '."'".'1'."'".','.PHP_EOL;
		$tableCreate .= '`level_id` int(11) NOT NULL DEFAULT '."'".'0'."'".','.PHP_EOL;
		$tableCreate .= '`level_name` varchar(100) DEFAULT NULL,'.PHP_EOL;
		$tableCreate .= '`location_id` int(10) NOT NULL DEFAULT '."'".'0'."'".','.PHP_EOL;
		$tableCreate .= '`location_name` varchar(200) DEFAULT NULL,'.PHP_EOL;
		$tableCreate .= '`created_on` timestamp DEFAULT CURRENT_TIMESTAMP,'.PHP_EOL;
		$tableCreate .= '`created_by` varchar(200) DEFAULT NULL,'.PHP_EOL;
		$tableCreate .= '`modified_on` datetime DEFAULT NULL,'.PHP_EOL;
		$tableCreate .= '`modified_by` varchar(200) DEFAULT NULL,'.PHP_EOL;

		$tableCreate .= "PRIMARY KEY (`autono`)".PHP_EOL;
		$tableCreate .= ") ENGINE=InnoDB DEFAULT CHARSET=latin1;";
		$result       = $model->execute($tableCreate);

		// Create detail

		//echo count($column_detail); exit;
		if(count($column_detail) > 0){
					$id_project         = $this->base64url_decode($x);
					$id_menu            = $this->base64url_decode($y);
					$file_name          = strtolower(preg_replace("([^\w\s\d\-_~,;:\[\]\(\).]|[\.]{2,})", '', str_replace(" ", "_", $menu['menu_name']))).'_detail'; 
					$parent_name        = strtolower(preg_replace("([^\w\s\d\-_~,;:\[\]\(\).]|[\.]{2,})", '', str_replace(" ", "_", $menu['menu_name'])));
					$controller_content = "";
					
					// Start generate controller
					$controller_script  = $model->tempscript('controller'); 
					$controller_dir     = ROOT_DIR."/application/controllers/";
					$controller         = fopen($controller_dir.$file_name.".php", "w") or die("Unable to open file controller detail!");
					$controller_content = $controller_script;
					$controller_content = str_replace("#class#", ucfirst($file_name), $controller_content);
					$controller_content = str_replace("#table#", $table['table_name'].'_detail', $controller_content);
					$controller_content = str_replace("#autocode#", $table['autocode'], $controller_content);
					$controller_content = str_replace("#model#", ucfirst($file_name), $controller_content);
					$controller_content = str_replace("#menu#", $parent['menu_name'], $controller_content);
					$controller_content = str_replace("#title#", $menu['menu_name']. ' Detail', $controller_content);
					$controller_content = str_replace("#url#", $file_name, $controller_content);
					
					$arrcol_detail      = '';
					$arrcolumns_detail  = '';
					$headerview_detail  = '';
					$dataview_detail    = '';
					$dataadd_detail     = '';
					$dataedit_detail    = '';

					$j = 1;
					foreach ($column_detail as $key => $coldet) {
						$arrcol_detail .= "array( 'db' => '".$coldet['column_name']."',  'dt' => ".$j++." ),";
						$arrcolumns_detail .= "\t\t".'$data['."'".$coldet['column_name']."'".'] = htmlspecialchars($_REQUEST['."'".$coldet['column_name']."'".']) ;'."\n";
						$headerview_detail .= "\t\t\t\t\t\t\t\t\t\t\t\t\t"."<th class=\"text-center\">".ucfirst(str_replace('_', ' ', $coldet['column_name']))."</th>"."\n";
						$dataview_detail .= "\t\t\t\t\t\t"."{".'"data"'.": ".($j-1).",width:'auto'},"."\n";
						$dataadd_detail  .= "<div class=\"form-group\">
			                            <label class=\"control-label col-lg-2\">".ucfirst(str_replace('_', ' ', $coldet['column_name']))."</label>
			                            <div class=\"col-lg-10\">
			                             <input type=\"".$coldet['input_type']."\" class=\"form-control\" name=\"".$coldet['column_name']."\" >
			                            </div>
			                          </div>";
			            $dataedit_detail  .= "<div class=\"form-group\">
			                            <label class=\"control-label col-lg-2\">".ucfirst(str_replace('_', ' ', $coldet['column_name']))."</label>
			                            <div class=\"col-lg-10\">
			                             <input type=\"".$coldet['input_type']."\" class=\"form-control\" name=\"".$coldet['column_name']."\" value=\"<?php echo ".'$value['."'".$coldet['column_name']."'".']'." ?>\" >
			                            </div>
			                          </div>";
					}
					$headerview_detail .= "\t\t\t\t\t\t\t\t\t\t\t\t\t"."<th class=\"text-center\">Actions</th>"."\n";
					$controller_content = str_replace("#columns_table#", $arrcol_detail, $controller_content);
					$controller_content = str_replace("#columns#", $arrcolumns_detail, $controller_content);
					
					fwrite($controller, $controller_content);
					fclose($controller);


					// Start generate model
					$models_script  = $model->tempscript('model'); 
					$models_dir     = $dst."/application/models/";
					$models         = fopen($models_dir.$file_name."_model.php", "w") or die("Unable to open file model detail!");
					$models_content = $models_script;
					$models_content = str_replace("#class#", ucfirst($file_name), $models_content);
					fwrite($models, $models_content);
					fclose($models);



					// Start generate view
					$view_script  = $model->tempscript('view'); 
					$view_dir     = $dst."/application/views/";
					$view         = fopen($view_dir.$file_name."_view.php", "w") or die("Unable to open file view!");
					$btn_detail   = "<a href=\"<?php echo BASE_URL ?>".$parent_name."\" class=\"btn btn-danger btn-sx\"><i class=\"icon-circle-left2 position-left\"></i> Cancel</a>";
					$view_content = $view_script;
					$view_content = str_replace("#headerview#", $headerview_detail, $view_content);
					$view_content = str_replace("#dataview#", $dataview_detail, $view_content);
					$view_content = str_replace("#btndetail#", $btn_detail, $view_content);
					fwrite($view, $view_content);
					fclose($view);


					// Start generate Add
					$add_script  = $model->tempscript('add'); 
					$add_dir     = $dst."/application/views/";
					$add         = fopen($add_dir.$file_name."_add.php", "w") or die("Unable to open file add!");
					$add_content = $add_script;
					$add_content = str_replace("#formadd#", $dataadd_detail, $add_content);
					fwrite($add, $add_content);
					fclose($add);


					// Start generate Edit
					$edit_script  = $model->tempscript('edit'); 
					$edit_dir     = $dst."/application/views/";
					$edit         = fopen($edit_dir.$file_name."_edit.php", "w") or die("Unable to open file edit!");
					$edit_content = $edit_script;
					$edit_content = str_replace("#formedit#", $dataedit_detail, $edit_content);
					fwrite($edit, $edit_content);
					fclose($edit);

					// Create table
					$tableNameDetail   = $table['table_name'].'_detail';
					$drop        = $model->execute("DROP TABLE IF EXISTS ".$config['db_name'].".`$tableNameDetail`;");
					$tableCreate = "CREATE TABLE ".$config['db_name'].".`$tableNameDetail` (".PHP_EOL;
					$tableCreate .= '`autono` int(11) NOT NULL AUTO_INCREMENT,'.PHP_EOL;
					$tableCreate .= '`parent_id` int(11) NOT NULL DEFAULT '."'".'0'."'".','.PHP_EOL;
					$tableCreate .= '`autocode` varchar(100) DEFAULT NULL,'.PHP_EOL;
					foreach ($column_detail as $key => $value) {
						if($value['data_type'] != "text"){ $d = '('; $b = ')'; } else { $d = ''; $b = ''; }
						$tableCreate .= "`".$value['column_name']."` ".$value['data_type']."$d".$value['length_data']."$b "."DEFAULT NULL ".$value['auto_increament'].",".PHP_EOL;
					}
					$tableCreate .= '`approve` int(11) NOT NULL DEFAULT '."'".'1'."'".','.PHP_EOL;
					$tableCreate .= '`level_id` int(11) NOT NULL DEFAULT '."'".'0'."'".','.PHP_EOL;
					$tableCreate .= '`level_name` varchar(100) DEFAULT NULL,'.PHP_EOL;
					$tableCreate .= '`location_id` int(10) NOT NULL DEFAULT '."'".'0'."'".','.PHP_EOL;
					$tableCreate .= '`location_name` varchar(200) DEFAULT NULL,'.PHP_EOL;
					$tableCreate .= '`created_on` timestamp DEFAULT CURRENT_TIMESTAMP,'.PHP_EOL;
					$tableCreate .= '`created_by` varchar(200) DEFAULT NULL,'.PHP_EOL;
					$tableCreate .= '`modified_on` datetime DEFAULT NULL,'.PHP_EOL;
					$tableCreate .= '`modified_by` varchar(200) DEFAULT NULL,'.PHP_EOL;

					$tableCreate .= "PRIMARY KEY (`autono`)".PHP_EOL;
					$tableCreate .= ") ENGINE=InnoDB DEFAULT CHARSET=latin1;";
					$resultdetail       = $model->execute($tableCreate);
		}
		// Create table detail End
		if($i == 0){
			return $result;
		} else {
			$this->redirect('apps/menu_designer/'.$x);
		}
		
		
	}


	public function generate_report($x, $y, $i = 0)
	{
		//$uri           = $this->loadHelper('Url_helper');
		global $config;
		$id_project    = $this->base64url_decode($x);
		$id_menu       = $y;
		$model         = $this->loadModel($this->model);
		$project       = $model->getinstance("tprojectapps", "autono", $id_project); 
		$menu          = $model->getinstance("tmenu", "menu_id", $id_menu);
		$parent        = $model->getinstance("tmenu", "menu_id", $menu['parent_id']);
		$db            = $model->getinstance("app_db_config", "code_apps", $project['autocode']);
		$table         = $model->getinstance("app_generate_table_report", "menu_id", $id_menu);
		$column        = $model->getreport("app_generate_column_report", "menu_id", $id_menu, "column_id");
		
		$dst           = ROOT_DIR; 

		$file_name     = strtolower(preg_replace("([^\w\s\d\-_~,;:\[\]\(\).]|[\.]{2,})", '', str_replace(" ", "_", $menu['menu_name']))); 


		// Start generate controller
		$controller_script  = $model->tempscript('controller_report'); 
		$controller_dir     = ROOT_DIR."/application/controllers/";
		$controller         = fopen($controller_dir.$file_name.".php", "w") or die("Unable to open file controller!");
		$controller_content = $controller_script;
		$controller_content = str_replace("#class#", ucfirst($file_name), $controller_content);
		$controller_content = str_replace("#table#", $table['table_name'], $controller_content);
		$controller_content = str_replace("#autocode#", $table['autocode'], $controller_content);
		$controller_content = str_replace("#model#", ucfirst($file_name), $controller_content);
		$controller_content = str_replace("#menu#", $parent['menu_name'], $controller_content);
		$controller_content = str_replace("#title#", $menu['menu_name'], $controller_content);
		$controller_content = str_replace("#url#", $file_name, $controller_content);
		$jcol               = count($column);

		$arrcol = '';
		$arrcolumns = '';
		$headerview = '';
		$dataview = '';
		$arrcolreport = '';
		$arrheadreport = '';
		$setwidthreport = '';
		$cellwidth = 300/$jcol;
		$cellheight = 15;
		$colssum = '';

		$i = 1;
		foreach ($column as $key => $col) {
			$arrcol       .= "array( 'db' => '".$col['column_name']."',  'dt' => ".$i++." ),";
			$arrcolumns   .= "\t\t".'$data['."'".$col['column_name']."'".'] = htmlspecialchars($_REQUEST['."'".$col['column_name']."'".']) ;'."\n";
			$headerview   .= "\t\t\t\t\t\t\t\t\t"."<th class=\"text-center\">".ucfirst(str_replace('_', ' ', $col['column_name']))."</th>"."\n";
			//$pdf->Cell(165, 15, 'NAMA KEGIATAN', 'LRT', 0, 'C');

			$colssum .= $cellwidth.',';
			//$pdf->SetWidths(array(20, 165,  40,25,35,35));


			$arrheadreport .= "\t\t".'$pdf->Cell('.$cellwidth.','.$cellheight.','."'".strtoupper($col['column_name'])."'" .','."'LRT'" .','."0".','."'C'".'); '."\n";
			$arrcolreport .= "\t\t\t\t".'$row['."'".$col['column_name']."'".'], '."\n";
			
			$dataview     .= "\t\t\t\t\t\t"."{".'"data"'.": ".($i-1).",width:'auto'},"."\n";
			
		}

		$setwidthreport .= "\t\t".'$pdf->SetWidths(array(20,'.$colssum.')); '."\n";

		
		$controller_content = str_replace("#columns_table#", $arrcol, $controller_content); 
		$controller_content = str_replace("#columns#", $arrcolumns, $controller_content);
		$controller_content = str_replace("#arrheadreport#", $arrheadreport, $controller_content);
		$controller_content = str_replace("#arrcolreport#", $arrcolreport, $controller_content);
		$controller_content = str_replace("#arrsetwidth#", $setwidthreport, $controller_content);
		
		fwrite($controller, $controller_content);
		fclose($controller);


		// Start generate model
		$models_script  = $model->tempscript('model_report'); 
		$models_dir     = $dst."/application/models/";
		$models         = fopen($models_dir.$file_name."_model.php", "w") or die("Unable to open file model!");
		$models_content = $models_script;
		$models_content = str_replace("#class#", ucfirst($file_name), $models_content);
		fwrite($models, $models_content);
		fclose($models);



		// Start generate view
		$view_script  = $model->tempscript('view_report'); 
		$view_dir     = $dst."/application/views/";
		$view         = fopen($view_dir.$file_name."_view.php", "w") or die("Unable to open file view!");
		$view_content = $view_script;
		$btn_detail   = '';
		$view_content = str_replace("#headerview#", $headerview, $view_content);
		$view_content = str_replace("#dataview#", $dataview, $view_content);

		fwrite($view, $view_content);
		fclose($view);


		$this->redirect('apps/menu_designer/'.$x);
			
	}

	public function edit($x)
	{
		$id                  = $this->base64url_decode($x);
		$kategori            = $this->loadModel($this->model);
		$data                = array();
		$data['breadcrumb1'] = $this->menu;
		$data['title']       = $this->title;
		$data['curl']        = $this->curl;
		$data['action']      = 'Edit';
		$data['encode']      = $x;
		$data['aadata']      = $kategori->get($this->table, $primaryKey, $id);
		$template            = $this->loadView('app_edit');
		$template->set('data', $data);
		$template->render();
	}

	public function save()
	{
		global $config;
		$app                = array();
		$team               = array();
		$model              = $this->loadModel($this->model);
		$app['autocode']    = $model->autocode($this->table, "PA_");
		$app['nama']        = htmlspecialchars($_REQUEST['app_name']) ;
		$app['projects']    = htmlspecialchars($_REQUEST['project']) ;
		$project            = $model->getvalue("SELECT nama_project, kode_clients, nama_clients FROM tproject WHERE autocode = '".$app['projects']."'");
		$app['projectsVal'] = $project[0] ;
		$app['clients']     = $project[1] ;
		$app['clientsVal']  = $project[2] ;
		$app['appstype']    = htmlspecialchars($_REQUEST['apps_type']) ;
		$app['appsdir']     = strtolower(preg_replace("([^\w\s\d\-_~,;:\[\]\(\).]|[\.]{2,})", '', str_replace(" ", "_", $app['nama'])));
		$app['keterangan']  = htmlspecialchars($_REQUEST['description']) ;
		$result             = $model->msave($this->table, $app, $this->title);
		$jmlteam            = count($_REQUEST['team']);

		for ($i=0; $i < $jmlteam ; $i++) { 
			$team['user_id']         = htmlspecialchars($_REQUEST['team'][$i]);
			$team['kode_apps']       = $app['autocode'];
			$team['tanggal_mulai']   = htmlspecialchars($_REQUEST['tanggal_mulai']) ;
			$team['tanggal_selesai'] = htmlspecialchars($_REQUEST['tanggal_selesai']) ;
			$teamresult              = $model->msave("tprojectteam", $team, $this->title);
		}

		$db['code_apps']    = $app['autocode'];
		$db['db_host']      = $config['db_host'];
		$db['db_name']      = $config['db_name'];
		$db['db_user']      = $config['db_username'];
		$db['db_pass']      = $config['db_password'];
		$db['tbl_prefix']   = htmlspecialchars($_REQUEST['tbl_prefix']);
		$db['security_key'] = htmlspecialchars($_REQUEST['security_key']);
		$dbresult           = $model->msave("app_db_config", $db, $this->title);


		//$xmlapi              = $this->loadLib("xmlapi");
		// //$xmlapi->set_host("vdes.satudata.id");   
		// $xmlapi->set_port( 2083 );   
		// $xmlapi->password_auth('satudata',',#JT)Sd@$r*D');    
		// $xmlapi->set_debug(1);//output actions in the error log 1 for true and 0 false 

		// $cpaneluser="satudata";
		// $databasename= "satudata_tesvdes";
		// $databaseuser="satudata_tesvdes";
		// $databasepass= "password123!@#";

		//create database    
		//$createdb = $xmlapi->api1_query($cpaneluser, "Mysql", "adddb", array($databasename));   
		//create user 
		// $usr = $xmlapi->api1_query($cpaneluser, "Mysqli", "adduser", array($databaseuser, $databasepass));   
		// //add user 
		// $addusr = $xmlapi->api1_query($cpaneluser, "Mysqli", "adduserdb", array("".$cpaneluser."_".$databasename."", "".$cpaneluser."_".$databaseuser."", 'all'));

		// Create Database & Table
		// $dbcreate  = $model->createdb($db['db_name']);
		// $tbl_log   = $model->tbl_log($db['db_name']);
		// $tbl_user  = $model->tbl_user($db['db_name'], $db['security_key']);
		// $tbl_group = $model->tbl_usergroup($db['db_name']);
		// $tbl_org   = $model->tbl_organization($db['db_name']);
		// $tbl_file  = $model->tbl_files($db['db_name']);
		// $tbl_menu  = $model->tbl_menu($db['db_name'], $app['autocode'], $app['nama']);



		$src = ROOT_DIR."scratch"; 
  
		$dst = $_SERVER['DOCUMENT_ROOT']."/".$app['appsdir']; 
		  
		$this->copysource($src, $dst); 
		

		// Start generate config file
		$conf_script  = $model->tempscript('config'); 
		$config_dir   = $dst."/application/config/";
		$conf         = fopen($config_dir."config.php", "w") or die("Unable to open file config!");
		$conf_content = $conf_script;
		$conf_content = str_replace("#app_code#", $app['autocode'], $conf_content);
		$conf_content = str_replace("#app_name#", $app['nama'], $conf_content);
		$conf_content = str_replace("#dir#", $app['appsdir'], $conf_content);
		$conf_content = str_replace("#host#", $db['db_host'], $conf_content);
		$conf_content = str_replace("#db_name#", $db['db_name'], $conf_content);
		$conf_content = str_replace("#db_user#", $db['db_user'], $conf_content);
		$conf_content = str_replace("#db_pass#", $db['db_pass'], $conf_content);
		$conf_content = str_replace("#security_key#", $db['security_key'], $conf_content);
		fwrite($conf, $conf_content);
		fclose($conf);

		// Configuration phpmyadmin
		// $phpmyadmin_script  = $model->tempscript('phpmyadmin'); 
		// $phpmyadmin_dir     = $dst."/application/phpmyadmin/";
		// $phpmyadmin         = fopen($phpmyadmin_dir."config.inc.php", "w") or die("Unable to open file phpmyadmin!");
		// $phpmyadmin_content = $phpmyadmin_script;
		// $phpmyadmin_content = str_replace("#dbname#", $db['db_name'], $phpmyadmin_content);
		// $phpmyadmin_content = str_replace("#user#", $db['db_user'], $phpmyadmin_content);
		// $phpmyadmin_content = str_replace("#password#", $db['db_pass'], $phpmyadmin_content);
		// fwrite($phpmyadmin, $phpmyadmin_content);
		// fclose($phpmyadmin);

		// Icecoder
		$icecoder_script  = $model->tempscript('icecoder'); 
		$icecoder_dir     = $dst."/application/icecoder/data/";
		$icecoder         = fopen($icecoder_dir."config-settings.php", "w") or die("Unable to open file icecoder!".$icecoder_dir);
		$icecoder_content = $icecoder_script;
		$icecoder_content = str_replace("#dir#", $app['appsdir'], $icecoder_content);
		fwrite($icecoder, $icecoder_content);
		fclose($icecoder);

		//$this->redirect('apps/create_app');
		$id               = $this->base64url_encode($result['id']);
		$this->redirect('apps/development/'.$id.'/'.$result['success']);
	}

	public function saveparent($id = false)
	{
		$config;

		$data                 = array();
		$model                = $this->loadModel($this->model);
		$uri                  = $this->loadHelper('Url_helper');
		$data['menu_name']    = htmlspecialchars($_REQUEST['menu_name']) ;
		$data['menu_desc']    = htmlspecialchars($_REQUEST['menu_desc']) ;
		$data['parent_app']   = $this->base64url_decode($id);
		$data['parent_id']    = 0 ;
		$project              = $model->getinstance("tprojectapps", "autono", 1); 
		$data['linkto']       = "#";
		$data['menu_icon']    = "" ;
		$data['kode_apps']    = $project['autocode'] ;
		$data['kode_appsVal'] = $project['nama'] ;
		$data['enabled']      = "Y" ;
		$result               = $model->msave("tmenu", $data, $this->title);
		$this->redirect('apps/menu_designer/'.$id);
	}

	public function savechild($x, $y)
	{
		$config;

		$data                 = array();
		$uri                  = $this->loadHelper('Url_helper');
		$model                = $this->loadModel($this->model);		
		$data['menu_name']    = htmlspecialchars($_REQUEST['menu_name']) ;
		$data['menu_desc']    = htmlspecialchars($_REQUEST['menu_desc']) ;
		$data['parent_app']   = 1;
		$data['parent_id']    = htmlspecialchars($_REQUEST['parent_id']) ;
		$parent               = $model->getinstance("tmenu", "menu_id", $data['parent_id']); 
		$data['linkto']       = strtolower(str_replace(" ", "_", $data['menu_name']));// strtolower(str_replace(" ", "_", trim($parent['menu_name'].' '.$data['menu_name'].$data['parent_id']))) ;
		$project              = $model->getinstance("tprojectapps", "autono", $data['parent_app']); 
		$data['menu_icon']    = "" ;
		$data['kode_apps']    = $project['autocode'] ;
		$data['kode_appsVal'] = $project['nama'] ;
		$data['enabled']      = "Y" ;

		$result               = $model->msave("tmenu", $data, $this->title);
		$this->redirect('apps/menu_designer/'.$x);
	}

	public function savetable($x, $y)
	{
		$uri                = $this->loadHelper('Url_helper');
		$model              = $this->loadModel($this->model);
		$data               = array();
		$data['menu_id']    = $this->base64url_decode($y) ;
		$data['table_name'] = htmlspecialchars($_REQUEST['table_name']) ;
		$data['autocode']   = htmlspecialchars($_REQUEST['autocode']) ;
		$menu_id            = $model->getval("app_generate_table", "menu_id", "menu_id", $data['menu_id']);


		if($menu_id == $data['menu_id']){
			$result = $model->mupdate("app_generate_table", $data, "menu_id", $data['menu_id'], $this->title);
		} else {
			$result = $model->msave("app_generate_table", $data, $this->title);
		}
	
		$this->redirect('apps/table_define/'.$x.'/'.$y);
	}


	public function savetableimport($x)
	{
		$model              = $this->loadModel($this->model);
		$data               = array();
		$data['menu_id']    = htmlspecialchars($_REQUEST['menu_id']) ;
		$data['table_name'] = htmlspecialchars($_REQUEST['table_name']) ;
		$data['autocode']   = htmlspecialchars($_REQUEST['autocode']) ;
		$encode             = $this->base64url_encode($data['menu_id']);
		$menu_id            = $model->getval("app_generate_table", "menu_id", "menu_id", $data['menu_id']);

		if($menu_id == $data['menu_id']){
			$result = $model->mupdate("app_generate_table", $data, "menu_id", $data['menu_id'], $this->title);
		} else {
			$result = $model->msave("app_generate_table", $data, $this->title);
		}

		# Insert files
		$files1					 = array();
		$files1['dir'] 			 = "import";
		$files1['subdir'] 		 = "";
		if(!empty($_FILES['file_dokumen']['name'][0])) {
		    $file_ary1 = $model->reArrayFiles($_FILES['file_dokumen']);
		    foreach ($file_ary1 as $file1) {
				$files1['kode_parent'] = $data['autocode'];
				$files1['parent_id']   = $data['menu_id'];
				$files1['nama_file']   = $this->randName($file1['name']);
				$files1['tipe_file']   = $file1['type'];
				$files1['ukuran']      = $file1['size'];
				$files1['ftable']      = $this->table;

				if(!empty($file1['name'])){ $model->savefile($files1); } 
		    }
		}
		# Upload file
		if(isset($_FILES['file_dokumen'])){  $up = $model->uploadimport($files1['dir'], $_FILES['file_dokumen'], $data['menu_id'], $files1['subdir']); }

		$this->redirect('apps/generate/'.$x.'/'.$encode.'/1');

	}

	public function savecolumn($x, $y)
	{
		$uri                 = $this->loadHelper('Url_helper');
		$model               = $this->loadModel($this->model);
		$data                = array();
		$rows                = array();
		$data['menu_id']  	 = $this->base64url_decode($y) ;
		$data['column_name'] = str_replace(" ", "_", htmlspecialchars(trim($_REQUEST['column_name']))) ;
		$data['data_type']   = htmlspecialchars($_REQUEST['data_type']) ;
		$data['length_data'] = htmlspecialchars($_REQUEST['length_data']) ;
		$data['input_type']  = htmlspecialchars($_REQUEST['input_type']) ;

		if(!empty($_REQUEST['column_id'])){
			$result          = $model->mupdate("app_generate_column", $data, "column_id", $_REQUEST['column_id'], $this->title);
		} else {
			$result          = $model->msave("app_generate_column", $data, $this->title);
		}
		

		// cek table
		$menu_id            = $model->getval("app_generate_table", "menu_id", "menu_id", $data['menu_id']);
		$rows['menu_id']    = $data['menu_id'] ;
		$rows['table_name'] = htmlspecialchars($_REQUEST['table_name']) ;
		$rows['autocode']   = htmlspecialchars($_REQUEST['autocode']) ;

		if($menu_id <> $data['menu_id']){
			$resulttab = $model->msave("app_generate_table", $rows, $this->title);
			// $resulttab = $model->mupdate("app_generate_table", $rows, "menu_id", $rows['menu_id'], $this->title);
		} 

		
		
		$this->redirect('apps/table_define/'.$x.'/'.$y);
	}

	public function savecolumndetail($x, $y)
	{
		$uri                 = $this->loadHelper('Url_helper');
		$model               = $this->loadModel($this->model);
		$data                = array();
		$rows                = array();
		$data['menu_id']  	 = $this->base64url_decode($y) ;
		$data['column_name'] = str_replace(" ", "_", htmlspecialchars($_REQUEST['column_name_detail'])) ;
		$data['data_type']   = htmlspecialchars($_REQUEST['data_type_detail']) ;
		$data['length_data'] = htmlspecialchars($_REQUEST['length_data_detail']) ;
		$data['input_type']  = htmlspecialchars($_REQUEST['input_type_detail']) ;

		if(!empty($_REQUEST['column_id_detail'])){
			$result          = $model->mupdate("app_generate_column_detail", $data, "column_id", $_REQUEST['column_id_detail'], $this->title);
		} else {
			$result          = $model->msave("app_generate_column_detail", $data, $this->title);
		}
		//$result              = $model->msave("app_generate_column_detail", $data, $this->title);

		// cek table
		$menu_id            = $model->getval("app_generate_table", "menu_id", "menu_id", $data['menu_id']);
		$rows['menu_id']    = $data['menu_id'] ;
		$rows['table_name'] = htmlspecialchars($_REQUEST['table_name']) ;
		$rows['autocode']   = htmlspecialchars($_REQUEST['autocode']) ;

		if($menu_id <> $data['menu_id']){
			$resulttab = $model->msave("app_generate_table", $rows, $this->title);
			// $resulttab = $model->mupdate("app_generate_table", $rows, "menu_id", $rows['menu_id'], $this->title);
		} 

		
		
		$this->redirect('apps/table_define/'.$x.'/'.$y);
	}

	public function update($x)
	{
		$data                  = array();
		$id                    = $this->base64url_decode($x);
		$model                 = $this->loadModel($this->model);
		$data['kategori']      = htmlspecialchars($_REQUEST['kategori']) ;
		$data['jenis']         = htmlspecialchars($_REQUEST['jenis']) ;
		$data['ordering']      = htmlspecialchars($_REQUEST['ordering']) ;
		$data['tampilkan']     = htmlspecialchars($_REQUEST['tampilkan']) ;
		$data['keterangan']    = htmlspecialchars($_REQUEST['keterangan']);

		$result                = $model->mupdate($this->table, $data, $this->primaryKey, $id, $this->title);
		$this->redirect('apps/crate_app');
		
	}

	public function updatemenu($x, $y)
	{
		$data              = array();
		$model             = $this->loadModel($this->model);
		$uri               = $this->loadHelper('Url_helper');
		$id                = $this->base64url_decode($y);
		$data['menu_name'] = htmlspecialchars($_REQUEST['menu_name']) ;
		$data['menu_desc'] = htmlspecialchars($_REQUEST['menu_desc']) ;
		$data['linkto']    = htmlspecialchars($_REQUEST['linkto']) ;
		$data['menu_icon'] = htmlspecialchars($_REQUEST['menu_icon']) ;
		$data['enabled']   = isset($_REQUEST['enabled']) ?  'Y' : 'N';
		
		$result            = $model->mupdate("tmenu", $data, "menu_id", $id, $this->title);
		$this->redirect('apps/menu_designer/'.$x);
	}

	public function delete($x)
	{
		$id                 = $this->base64url_decode($x);
		$model              = $this->loadModel($this->model);
		$result             = $model->mdelete($this->table, $this->primaryKey, $id, $this->title);
		return $result;
	}

	public function deletemenu($x)
	{
		$id                 = $this->base64url_decode($x);
		$model              = $this->loadModel($this->model);
		$result             = $model->mdelete("tmenu", "menu_id", $id, $this->title);
		return $result;
	}

	public function deletecolumn($x)
	{
		$id                 = $this->base64url_decode($x);
		$model              = $this->loadModel($this->model);
		$result             = $model->mdelete("app_generate_column", "column_id", $id, $this->title);
		return $result;
	}

	public function deletecolumndetail($x)
	{
		$id                 = $this->base64url_decode($x);
		$model              = $this->loadModel($this->model);
		$result             = $model->mdelete("app_generate_column_detail", "column_id", $id, $this->title);
		return $result;
	}


	function createDb($cpanel_theme, $cPanelUser, $cPanelPass, $dbName)
	{
	    $buildRequest = "/frontend/" . $cpanel_theme . "/sql/addb.html?db=" . $dbName;

	    $openSocket = fsockopen('satudata.id', 2082);
	    if (!$openSocket) {
	        return "Socket error";
	        exit();
	    }

	    $authString = $cPanelUser . ":" . $cPanelPass;
	    $authPass = base64_encode($authString);
	    $buildHeaders = "GET " . $buildRequest . "\r\n";
	    $buildHeaders .= "HTTP/1.0\r\n";
	    $buildHeaders .= "Host:satudata.id\r\n";
	    $buildHeaders .= "Authorization: Basic " . $authPass . "\r\n";
	    $buildHeaders .= "\r\n";

	    fputs($openSocket, $buildHeaders);
	    while (!feof($openSocket)) {
	        fgets($openSocket, 128);
	    }
	    fclose($openSocket);
	}


	public function add_db()
	{
		//$xmlapi              = $this->loadLib("xmlapi"); 

		$us = "satudata";
		$ps = ",#JT)Sd@$r*D";

		$database_name = "tesvdes"; //without prefix
		$database_user = $database_name; //database name and database username are both similar, change the value if you want
		$database_pass = ",#JT)Sd@$r*D";
		$cpanel_username = "satudata";
		$cpanel_pass = "my_cpanel_password";
		$cpanel_theme = "paper_lantern"; // change this to "x3" if you don't have paper_lantern yet


		$createdb = $this->createDb($cpanel_theme, $cpanel_username, $cpanel_pass, $database_name);
		// $xmlapi->set_port( 2082 );   
		// $xmlapi->password_auth( $us,$ps);    
		// $xmlapi->set_debug(0);//output actions in the error log 1 for true and 0 false 

		// $cpaneluser="satudata";
		// $databasename= "satudata_tesvdes";
		// $databaseuser="satudata_tesvdes";
		// $databasepass= "password123!@#";

		// //create database    
		// $createdb = $xmlapi->api1_query($cpaneluser, "Mysql", "adddb", array($databasename));   

		 var_dump($createdb);
	}
    
    public function download($i)
	{

		$download = $this->download_import($i, 'import/');

		return $download;
	}

	public function postdata($x)
	{
		$model      = $this->loadModel($this->model);
		$datas      = $_REQUEST['menuarr'];
		$j          = count($datas);

		for ($i=0; $i < $j; $i++) { 
			$data['menu_id']    = $this->base64url_decode($datas[$i]['key']);		
			$result             = $model->execute("DELETE FROM tmenu WHERE menu_id = ".$data['menu_id']."");
		}
		
		echo json_encode($result);
	}
}