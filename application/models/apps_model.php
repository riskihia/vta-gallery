<?php

class Apps_model extends Model {

	public function mget($request, $table, $primaryKey, $columns)
	{
		$result = $this->simple($request, $table, $primaryKey, $columns);
		return $result;
	}

	public function mgettable($request, $table, $primaryKey, $columns, $id)
	{
		$result = $this->simpletable($request, $table, $primaryKey, $columns, $id);
		return $result;
	}

	public function get($table, $primaryKey, $id)
	{
		$result = $this->query("SELECT * FROM $table WHERE $primaryKey = '$id' ORDER BY $primaryKey");
		return $result;
	}

	public function getreport($table, $primaryKey, $id, $order = null)
	{
		$result = $this->query("SELECT * FROM $table WHERE $primaryKey = '$id' ORDER BY $order");
		return $result;
	}

	public function getinstance($table, $primaryKey, $id)
	{
		$result = $this->getvalue("SELECT * FROM $table WHERE $primaryKey = '$id'");
		return $result;
	}

	public function getmenuimport($table, $primaryKey, $id)
	{
		$result = $this->getvalue("SELECT a.*, b.table_name, b.autocode FROM $table a LEFT JOIN ( SELECT * FROM app_generate_table WHERE $primaryKey = $id ) AS b ON a.`$primaryKey` = b.`$primaryKey` WHERE a.`$primaryKey` = $id");
		return $result;
	}

 	public function getcolumnedit($table, $primaryKey, $id)
	{
		$result = $this->getvalue("SELECT * FROM $table a  WHERE a.`$primaryKey` = $id");
		return $result;
	}

	public function data_type_edit($id, $table)

	{
		$result = $this->query("SELECT type_id, type_name, IF(b.`data_type` IS NOT NULL, 'selected', '') AS pselect FROM app_generate_data_type a LEFT JOIN ( SELECT data_type, input_type FROM $table WHERE column_id = $id ) AS b ON a.`type_name` = b.data_type");
		return $result;
	}

	public function input_type_edit($id, $table)

	{
		$result = $this->query("SELECT input_id, input_name, IF(b.input_type IS NOT NULL, 'selected', '') AS pselect FROM app_generate_input_type a LEFT JOIN ( SELECT data_type, input_type FROM $table WHERE column_id = $id ) AS b ON a.`input_name` = b.input_type");
		return $result;
	}

	public function showtables($db, $menu_id)
	{
		$result = $this->query("SELECT a.`TABLE_NAME`, IF(b.table_name IS NULL, '', 'selected') AS pselect FROM information_schema.TABLES a
								LEFT JOIN ( SELECT menu_id, table_name FROM $db.`app_generate_table_report` WHERE menu_id = $menu_id ) b ON a.`TABLE_NAME` = b.table_name
									WHERE a.TABLE_SCHEMA = '$db'");
		return $result;
	}

	public function showcolumns($id)
	{
		$result = $this->query("SHOW COLUMNS FROM $id;");
		return $result;
	}

	public function msave($table, $data = array(), $title)
	{
		$result = $this->sqlinsert($table, $data, $title);
		return $result;
	}

	public function mupdate($table, $data = array(), $primaryKey, $id, $title)
	{
		$result = $this->sqlupdate($table, $data, $primaryKey, $id, $title);
		return $result;
	}

	public function mdelete($table, $primaryKey, $id, $title)
    {
        $result = $this->sqldelete($table, $primaryKey, $id, $title);
		return $result;
    }

    public function menu()
    {
    	$result = $this->query("SELECT * FROM tmenu WHERE parent_app = 5");
    }

    public function savefile($data = array())
	{

		$result = $this->sqlinsert('vt_files', $data, 'Import Form');

		return $result;

	}

    function uploadimport($directory, $filename, $id, $subdir = null, $result = false)

    {

        global $config;

        include APP_DIR.'lib/PHPExcel/PHPExcel.php';

        $dt =  array();

        $reset = $this->execute("DELETE FROM app_generate_column WHERE menu_id = $id");

        if ($filename) {

		    $file_ary = $this->reArrayFiles($filename);

		    foreach ($file_ary as $file) {

		    	$namefile = $this->randName($file["name"]);

		        $dir         = ROOT_DIR.'static/files/bahan/'.$directory.'/';

		        if($subdir != null){ $subdir = $subdir."/"; } 

		        $storagename = $dir.$subdir.$namefile;

		        $storagefile = $dir.$subdir;

		        if(!empty($namefile)){

		            if(!file_exists($storagefile)){

		                mkdir($storagefile, 0777, true);

		                $html         = fopen($storagefile."index.html", "w") or die("Unable to open file!");

		                $html_content = "<h1>Access forbidden!</h1>";

		                fwrite($html, $html_content);

		                fclose($html);

		                $result = move_uploaded_file($file["tmp_name"],  $storagename);

		                

		            } else {

		                $result = move_uploaded_file($file["tmp_name"],  $storagename);          

		            }
	            
		            $letters            = array( 0 => 'A', 1 =>'B', 2 =>'C', 3 =>'D', 4 =>'E', 5 =>'F', 6 =>'G', 7 =>'H', 8 =>'I', 9 =>'J', 10 =>'K', 11 =>'L', 12 =>'M', 13 =>'N', 14 =>'O', 15 =>'P', 16 =>'Q', 17 =>'R', 18 =>'S', 19 =>'T', 20 =>'U', 21 =>'V', 22 =>'W', 23 =>'X', 24 =>'Y', 25 =>'Z');
					$excelreader		= new PHPExcel_Reader_Excel2007();
					$loadexcel 			= $excelreader->load($storagename); 
					$sheet 				= $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

					$numrow = 1;
					$it = array();
					foreach($sheet as $row){

						// if($dt['column_name'] == "")
						// 	continue;

						if($numrow <= 1){

							for ($i=0; $i < count($row); $i++) { 
								$dt['column_name'] = strtolower($row[$letters[$i]]);
								$dt['data_type']   = 'varchar';
								$dt['length_data'] = 255;
								$dt['menu_id']     = $id;
								$columninsert      = $this->msave("app_generate_column", $dt, 'Import');
							}

						}

						$numrow++; 
					}


		        } 

		    }

		}

       return true;

    }    

    public function createdb($dbname)
    {
    	$result = $this->execute("CREATE DATABASE /*!32312 IF NOT EXISTS*/`".$dbname."` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;");
    	return $result;
    }

    public function tbl_log($dbname)
    {
    	$this->execute("DROP TABLE IF EXISTS $dbname.`tlog`;") ;
    	$result = $this->execute("CREATE TABLE $dbname.`tlog` (
								  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
								  `log_id_form` varchar(50) NOT NULL,
								  `log_nama_form` varchar(255) DEFAULT NULL,
								  `log_date` datetime NOT NULL,
								  `log_action` varchar(10) NOT NULL,
								  `log_user` varchar(255) NOT NULL,
								  `log_record` varchar(255) NOT NULL,
								  `log_sql` text DEFAULT NULL,
								  `log_db` varchar(50) DEFAULT NULL,
								  `log_ip` varchar(255) NOT NULL,
								  PRIMARY KEY (`log_id`)
								) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
    	return $result;
    }

    public function tbl_user($dbname, $security_key)
    {
    	$this->execute("DROP TABLE IF EXISTS $dbname.`tuser`;") ;
    	$result = $this->execute("CREATE TABLE $dbname.`tuser` (
								  `autono` int(11) NOT NULL AUTO_INCREMENT,
								  `parent_id` int(11) DEFAULT NULL,
								  `user_id` varchar(20) DEFAULT NULL,
								  `user_fullname` varchar(255) DEFAULT NULL,
								  `user_password` varchar(40) DEFAULT NULL,
								  `user_grup` varchar(100) DEFAULT NULL,
								  `user_grupVal` varchar(200) DEFAULT NULL,
								  `jabatan` varchar(255) DEFAULT NULL,
								  `jabatanVal` varchar(255) DEFAULT NULL,
								  `list_office` varchar(100) DEFAULT NULL,
								  `foto` varchar(255) DEFAULT NULL,
								  `tempat_lahir` varchar(255) DEFAULT NULL,
								  `tgl_lahir` date() NOT NULL,
								  `status` char(1) NOT NULL,
								  `approve` int(11) NOT NULL DEFAULT 1,
								  `level_id` int(11) NOT NULL DEFAULT 0,
								  `level_name` varchar(255) DEFAULT NULL,
								  `location_id` int(11) NOT NULL DEFAULT 0,
								  `location_name` varchar(255) DEFAULT NULL,
								  `created_on` datetime DEFAULT NULL,
								  `created_by` varchar(100) DEFAULT NULL,
								  `modified_on` datetime DEFAULT NULL,
								  `modified_by` varchar(100) DEFAULT NULL,
								  `web_online` char(1) NOT NULL,
								  `wb_ol_time` datetime NOT NULL,
								  `audio_online` char(1) NOT NULL,
								  `audio_ol_time` datetime NOT NULL,
								  `ip` int(11) NOT NULL,
								  `last_refresh_time` datetime NOT NULL,
								  `lastactivity` int(11) NOT NULL,
								  PRIMARY KEY (`autono`)
								) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;");

    	$pass = sha1(md5('password'.$security_key));
    	$adduser = $this->execute("insert  into $dbname.`tuser`(`autono`,`parent_id`,`user_id`,`user_fullname`,`user_password`,`user_grup`,`user_grupVal`,`jabatan`,`jabatanVal`,`list_office`,`foto`,`tempat_lahir`,`tgl_lahir`,`status`,`approve`,`level_id`,`level_name`,`location_id`,`location_name`,`created_on`,`created_by`,`modified_on`,`modified_by`,`web_online`,`wb_ol_time`,`audio_online`,`audio_ol_time`,`ip`,`last_refresh_time`,`lastactivity`) values 
									(1,NULL,'root','Administrator','$pass','1','ADMINISTRATOR','1','Komisaris','','23022traxexthedrowrangerbyts.jpg','Jakarta','01/10/2011','',1,1,'ADMINISTRATOR',0,'PUSAT','2014-12-12 14:12:12','root','2014-12-12 14:12:12','root','','0000-00-00 00:00:00','','0000-00-00 00:00:00',0,'0000-00-00 00:00:00',1414406573);");
    	return $result;
    }

    public function tbl_usergroup($dbname)
    {
    	$this->execute("DROP TABLE IF EXISTS $dbname.`tusergroup`;") ;
    	$result = $this->execute("CREATE TABLE $dbname.`tusergroup` (
								  `autono` int(11) NOT NULL AUTO_INCREMENT,
								  `parent_id` int(11) NOT NULL DEFAULT 0,
								  `group_name` varchar(100) DEFAULT NULL,
								  `description` text DEFAULT NULL,
								  `organization_level` varchar(100) DEFAULT NULL,
								  `organization_levelVal` varchar(100) DEFAULT NULL,
								  `ordering` int(11) DEFAULT NULL,
								  `enabled` varchar(1) NOT NULL DEFAULT 'Y',
								  `approve` int(11) DEFAULT NULL,
								  `level_id` int(11) DEFAULT NULL,
								  `created_on` datetime DEFAULT NULL,
								  `created_by` varchar(100) DEFAULT NULL,
								  `modified_on` datetime DEFAULT NULL,
								  `modified_by` varchar(100) DEFAULT NULL,
								  PRIMARY KEY (`autono`)
								) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;");

    	$addgroup = $this->execute("insert  into $dbname.`tusergroup`(`autono`,`parent_id`,`group_name`,`description`,`organization_level`,`organization_levelVal`,`ordering`,`enabled`,`approve`,`level_id`,`created_on`,`created_by`,`modified_on`,`modified_by`) values 
									(1,0,'ADMINISTRATOR','Super Admin','13','Top Management',2,'N',0,0,'2010-06-17 19:32:43','root','2014-12-02 15:15:58','root');");
    	return $result;
    }

    public function tbl_organization($dbname)
    {
    	$this->execute("DROP TABLE IF EXISTS $dbname.`torganizationstructure`;") ;
    	$result = $this->execute("CREATE TABLE $dbname.`torganizationstructure` (
								  `autono` int(11) NOT NULL AUTO_INCREMENT,
								  `parent_id` int(11) NOT NULL DEFAULT 0,
								  `nama_jabatan` varchar(100) DEFAULT NULL,
								  `keterangan` text DEFAULT NULL,
								  `ordering` int(11) DEFAULT NULL,
								  `enabled` varchar(1) NOT NULL DEFAULT 'Y',
								  `approve` int(11) NOT NULL DEFAULT 1,
								  `level_id` int(11) NOT NULL DEFAULT 0,
								  `level_name` varchar(255) DEFAULT NULL,
								  `location_id` int(11) NOT NULL DEFAULT 0,
								  `location_name` varchar(255) DEFAULT NULL,
								  `created_on` datetime DEFAULT NULL,
								  `created_by` varchar(100) DEFAULT NULL,
								  `modified_on` datetime DEFAULT NULL,
								  `modified_by` varchar(100) DEFAULT NULL,
								  PRIMARY KEY (`autono`),
								  UNIQUE KEY `autono` (`autono`),
								  KEY `autono_2` (`autono`)
								) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;");

    	$addorg = $this->execute("insert  into $dbname.`torganizationstructure`(`autono`,`parent_id`,`nama_jabatan`,`keterangan`,`ordering`,`enabled`,`approve`,`level_id`,`level_name`,`location_id`,`location_name`,`created_on`,`created_by`,`modified_on`,`modified_by`) values 
									(1,0,'Komisaris','',1,'Y',1,0,NULL,1,'PUSAT','2015-04-30 00:00:00','root',NULL,NULL),
									(2,1,'Direktur Utama','',2,'Y',1,1,'ADMINISTRATOR',1,'Pusat','2015-04-30 08:57:19','admin',NULL,NULL);");
    	return $result;
    }

    public function tbl_files($dbname)
    {
    	$this->execute("DROP TABLE IF EXISTS $dbname.`vt_files`;") ;
    	$result = $this->execute("CREATE TABLE $dbname.`vt_files` (
								  `autono` int(11) NOT NULL AUTO_INCREMENT,
								  `parent_id` int(11) DEFAULT NULL,
								  `kode_parent` varchar(100) DEFAULT NULL,
								  `nama_file` varchar(255) DEFAULT NULL,
								  `tipe_file` varchar(200) DEFAULT NULL,
								  `ukuran` varchar(200) DEFAULT NULL,
								  `keterangan` varchar(200) DEFAULT NULL,
								  `ftable` varchar(200) DEFAULT NULL,
								  `dir` varchar(200) DEFAULT NULL,
								  `subdir` varchar(255) DEFAULT NULL,
								  `status` int(1) DEFAULT 1,
								  `approve` int(11) NOT NULL DEFAULT 1,
								  `level_id` int(11) NOT NULL DEFAULT 0,
								  `level_name` varchar(255) DEFAULT NULL,
								  `location_id` int(11) NOT NULL DEFAULT 0,
								  `location_name` varchar(255) DEFAULT NULL,
								  `created_on` datetime DEFAULT NULL,
								  `created_by` varchar(100) DEFAULT NULL,
								  `modified_on` datetime DEFAULT NULL,
								  `modified_by` varchar(100) DEFAULT NULL,
								  PRIMARY KEY (`autono`)
								) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

    	return $result;
    }

    public function tbl_menu($dbname, $kd_apps, $nm_apps)
    {
    	$this->execute("DROP TABLE IF EXISTS $dbname.`tmenu`;") ;
    	$result = $this->execute("CREATE TABLE $dbname.`tmenu` (
								  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
								  `parent_app` int(11) DEFAULT NULL,
								  `kode_apps` varchar(200) DEFAULT NULL,
								  `kode_appsVal` varchar(200) DEFAULT NULL,
								  `menu_name` varchar(100) DEFAULT NULL,
								  `menu_desc` varchar(255) DEFAULT NULL,
								  `menu_icon` varchar(255) DEFAULT NULL,
								  `parent_id` int(11) NOT NULL DEFAULT 0,
								  `lang_id` int(11) NOT NULL DEFAULT 0,
								  `target` varchar(20) DEFAULT NULL,
								  `form_id` int(11) DEFAULT NULL,
								  `form_name` varchar(200) DEFAULT NULL,
								  `ordering` int(11) DEFAULT NULL,
								  `enabled` char(1) DEFAULT NULL,
								  `linkto_url` varchar(255) DEFAULT NULL,
								  `menu_image` varchar(100) DEFAULT NULL,
								  `menulink_type` char(1) DEFAULT NULL,
								  `menu_code` varchar(50) DEFAULT NULL,
								  `linkto` varchar(255) NOT NULL DEFAULT '#',
								  `app_id` int(11) DEFAULT NULL,
								  `GUID` varchar(50) DEFAULT NULL,
								  `SYS_TS` timestamp NOT NULL DEFAULT current_timestamp(),
								  `approve` int(2) DEFAULT NULL,
								  `level_id` int(5) DEFAULT NULL,
								  `level_name` varchar(100) DEFAULT NULL,
								  `location_id` int(5) DEFAULT NULL,
								  `location_name` varchar(100) DEFAULT NULL,
								  `created_on` datetime DEFAULT NULL,
								  `created_by` varchar(100) DEFAULT NULL,
								  `modified_on` datetime DEFAULT NULL,
								  `modified_by` varchar(100) DEFAULT NULL,
								  PRIMARY KEY (`menu_id`)
								) ENGINE=InnoDB AUTO_INCREMENT=10758 DEFAULT CHARSET=latin1;");

    	$addorg = $this->execute("insert  into $dbname.`tmenu`(`menu_id`,`parent_app`,`kode_apps`,`kode_appsVal`,`menu_name`,`menu_desc`,`menu_icon`,`parent_id`,`lang_id`,`target`,`form_id`,`form_name`,`ordering`,`enabled`,`linkto_url`,`menu_image`,`menulink_type`,`menu_code`,`linkto`,`app_id`,`GUID`,`SYS_TS`,`approve`,`level_id`,`level_name`,`location_id`,`location_name`,`created_on`,`created_by`,`modified_on`,`modified_by`) values 
								(1,5,'$kd_apps','$nm_apps','User Group','tes','',3364,0,'_self',0,'',0,'Y','','','S','l','script.php?show=script&script=settings/authorization/groups/index.php',3364,'','2016-04-20 09:46:05',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
								(2,5,'$kd_apps','$nm_apps','User Manager','tes','',3364,0,'_self',0,'',1,'Y','','','S','l','script.php?show=script&script=settings/authorization/users/index.php',3364,'','2016-04-20 09:46:05',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
								(3,0,'$kd_apps','$nm_apps','DASHBOARD','tes','',0,0,'mainFrame',0,'',0,'Y','','','S','l','#',0,'','2016-04-20 09:46:05',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
								(4,7,'$kd_apps','$nm_apps','Inbox','-','',3357,0,'_self',0,'',1,'Y','','','S','l','script.php?show=script&script=developer/utilitas/log/index.php',3357,'','2016-04-20 09:46:05',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
								(5,0,'$kd_apps','$nm_apps','UTILITY','tes','',0,0,'mainFrame',0,'',1,'Y','','','S','l','#',0,'0.50278900 1461119027','2016-04-20 09:49:25',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
								(6,5,'$kd_apps','$nm_apps','Ganti Password','tes','',3364,0,'_self',0,'',2,'Y','','','S','l','script.php?show=script&script=settings/authorization/users/changepass.php',3364,'','2016-04-20 09:46:05',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
								(7,5,'$kd_apps','$nm_apps','Design Menu','tes',NULL,3364,0,'_self',0,'',6,'Y',NULL,NULL,'S','l','script.php?show=script&script=developer/utilitas/menu/index.php',3364,NULL,'2018-08-07 09:13:16',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
								(8,0,'$kd_apps','$nm_apps','TRANSAKSI','tes',NULL,0,0,'mainFrame',0,'',3,'Y',NULL,NULL,'S','l','#',0,NULL,'2019-01-04 15:33:56',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
								(9,8,'$kd_apps','$nm_apps','Sample Crud','Generated',NULL,10723,0,'_self',0,'',1,'Y',NULL,NULL,'S','l','script.php?show=script&script=transaksi/sample/crud/index.php',10723,NULL,'2019-01-04 15:37:22',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
								(10,5,'$kd_apps','$nm_apps','Log System','tes',NULL,3364,0,'_self',0,'',5,'Y',NULL,NULL,'S','l','script.php?show=script&script=developer/utilitas/log/index.php',3364,NULL,'2019-01-06 17:24:07',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
								(11,5,'$kd_apps','$nm_apps','Struktur Organisasi','tes',NULL,3364,0,'_self',0,'',3,'Y',NULL,NULL,'S','l','script.php?show=script&script=settings/authorization/organization/index.php',3364,NULL,'2019-01-06 18:42:41',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
								(12,5,'$kd_apps','$nm_apps','Kotama/Satker','tes',NULL,3364,0,'_self',0,'',4,'Y',NULL,NULL,'S','l','script.php?show=script&script=settings/authorization/officesite/index.php',3364,NULL,'2019-01-06 21:24:03',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
								(10757,3,'$kd_apps','$nm_apps','Gis','',NULL,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'#',NULL,NULL,'2020-05-19 05:49:27',1,15,'PROJECT MANAGER',0,'','2020-05-19 00:49:27','Administrator',NULL,NULL);
								");
    	return $result;
    }


}
