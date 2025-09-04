<?php

class Controller {
	
	public function loadModel($name)
	{
		require(APP_DIR .'models/'. strtolower($name) .'.php');

		$model = new $name;
		return $model;
	}
	
	public function loadView($name)
	{
		$view = new View($name);
		return $view;
	}
	
	public function loadPlugin($name)
	{
		require(APP_DIR .'plugins/'. strtolower($name) .'.php');
	}
	
	public function loadHelper($name)
	{
		require(APP_DIR .'helpers/'. strtolower($name) .'.php');
		$helper = new $name;
		return $helper;
	}

	public function loadLibrary($name)
	{
		require(APP_DIR .'lib/'. $name .'.php');
		$library = new $name;
		return $library;
	}

	public function loadExec($name)
	{
		return exec(APP_DIR.'exec/'.$name.'.exe');
	}
	
	public function redirect($loc)
	{
		global $config;
		header('Location: '. $config['base_url'] . $loc);
	}
    
    function base64url_encode($data) 
    {
    	global $config;

    	$url = $data.$config['key'];

	  return rtrim(strtr(base64_encode($url), '+/', '-_'), '=');
	}

	function base64url_decode($data) 
	{
	  global $config;
	  
	  $url = base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));

	  return str_replace($config['key'], '', $url);
	} 

	function randName($name){
		$file     = explode(".", $name);
		$md5      = MD5($file[0]);
		$namefile = $md5.".".$file[1];
		return $namefile;
	}

	function download_file($value, $pathinfo)
	{
		if(!empty($value)){
			ignore_user_abort(true);
			set_time_limit(0); 

			//$path = BASE_URL."static/files/bahan/".$pathinfo; 
			//echo $path;exit;
        	$path = "./static/files/bahan/".$pathinfo; 
			$dl_file = preg_replace("([^\w\s\d\-_~,;:\[\]\(\).]|[\.]{2,})", '', $value); 
			$dl_file = filter_var($dl_file, FILTER_SANITIZE_URL);
			$fullPath = $path.$dl_file;

			if ($fd = fopen ($fullPath, "r")) {
			    $fsize = filesize($fullPath);
			    $path_parts = pathinfo($fullPath);
			    $ext = strtolower($path_parts["extension"]);
			    switch (strtolower($ext)) {
			        case "jpg":
			        header("Content-type: image/jpeg");
			        header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); 
			        break;
			        
			        default;
			        header("Content-type: application/octet-stream");
			        header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
			        break;
			    }
			    header("Content-length: $fsize");
			    header("Cache-control: private"); 
			    while(!feof($fd)) {
			        $buffer = fread($fd, 2048);
			        echo $buffer;
			    }
			} else {
				return false;
			}
			fclose ($fd);
			exit;
		} else {
			$this->redirect('errors');
		}
		
	}

	function download_import($value, $pathinfo)
	{
		if(!empty($value)){
			ignore_user_abort(true);
			set_time_limit(0); 

			//$path = BASE_URL."static/files/bahan/".$pathinfo; 
			//echo $path;exit;
        	$path = "./static/files/bahan/".$pathinfo; 
			$dl_file = preg_replace("([^\w\s\d\-_~,;:\[\]\(\).]|[\.]{2,})", '', $value.'.xlsx'); 
			$dl_file = filter_var($dl_file, FILTER_SANITIZE_URL);
			$fullPath = $path.$dl_file;

			if ($fd = fopen ($fullPath, "r")) {
			    $fsize = filesize($fullPath);
			    $path_parts = pathinfo($fullPath);
			    $ext = strtolower($path_parts["extension"]);
			    switch (strtolower($ext)) {
			        case "xlsx":
			        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
			        header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); 
			        break;
			        
			        default;
			        header("Content-type: application/octet-stream");
			        header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
			        break;
			    }
			    header("Content-length: $fsize");
			    header("Cache-control: private"); 
			    while(!feof($fd)) {
			        $buffer = fread($fd, 2048);
			        echo $buffer;
			    }
			} else {
				return false;
			}
			fclose ($fd);
			exit;
		} else {
			$this->redirect('errors');
		}
		
	}
}