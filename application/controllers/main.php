<?php

class Main extends Controller {

	public function __construct()
    {
        $session = $this->loadHelper('Session_helper');

        if(!$session->get('username')){

        	$this->redirect('auth/login');

        }
    }
	
	function index()
	{
		$model               = $this->loadModel('Frontoffice_model');

		$data                = array();

		//$data['direktori']   = scandir(ROOT_DIR."static/files/bahan/dokumen/");
		$data['breadcrumb1'] = 'Dashboard';
		$data['title']       = 'Main';
		$data['graf']        = $model->graf();
        $data['subgraf']     = $model->subgraf();
        $data['bulan']       = $model->get_bulan(date('m'));
		$template            = $this->loadView('dashboard_view');
		$template->set('data', $data);
		$template->render();
	}


	function recursive_read($directory, $entries_array = array()) {
	    if(is_dir($directory)) {
	        $handle = opendir($directory);
	        while(FALSE !== ($entry = readdir($handle))) {
	            if($entry == '.' || $entry == '..') {
	                continue;
	            }
	            $Entry = $directory . '/' . $entry;
	            if(is_dir($Entry)) {
	                $entries_array = $this->recursive_read($Entry, $entries_array);
	            } else {
	                $entries_array[] = $Entry;
	            }
	        }
	        closedir($handle);
	    }
	    return $entries_array;
	}

	function getdir($tahun, $bulan)
	{
		$model               = $this->loadModel('Frontoffice_model');
    
    	if($bulan){
        	$data['direktori']   = ROOT_DIR."static/files/bahan/".$tahun."/".$bulan;
        	$dt = $this->recursive_read($data['direktori']);

        	foreach ($dt as $key => $value) {
           	 	$value = $model->escapeString($value);
            	$q = $model->execute("INSERT INTO vt_files_storage (dir) VALUES ('".$value."')");
        	}
        
        	$rs = $model->execute("UPDATE vt_files_storage SET tanggal =  SUBSTRING_INDEX((SUBSTRING_INDEX(dir, '/', 10)), '/', -1), nama_kegiatan =  SUBSTRING_INDEX((SUBSTRING_INDEX(dir, '/', 11)), '/', -1) , nama_file =  SUBSTRING_INDEX(dir, '/', -1)   WHERE nama_kegiatan IS NULL AND dir LIKE '%".$bulan."%'");
			
        	if($rs){
            	// $res = $model->execute("TRUNCATE tbl_dokumen_storage");
            	$ins = $model->execute("INSERT INTO tbl_dokumen_storage (parent_id, nama_kegiatan, tanggal, dir) SELECT `autono`, `nama_kegiatan`, `tanggal`, `dir` FROM `vt_files_storage` WHERE tanggal IS NOT NULL AND tanggal LIKE '%".$bulan."%' GROUP BY nama_kegiatan, tanggal");
            	echo "Sukses insert ".$bulan." ". $tahun;
            }
       		
        } else {
        
        	echo "Masukkan bulan";
        	
        }

		

	}

	function setyear()
	{
		$model  = $this->loadModel('Dashboard_model');
		$tahun  = (int) $model->escapeString($_POST['stahun']);
		$userid = $_SESSION['userid'];
		
		$rs     = $model->execute("UPDATE tuser SET tahunaudit = '$tahun'  WHERE user_id = '$userid'");

		return $rs;
			
	}

    
}

?>
