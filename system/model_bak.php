<?php



class Model {



	private $connection;



	public function __construct()

	{

		global $config;

		$this->connection = mysqli_connect($config['db_host'], $config['db_username'], $config['db_password'], $config['db_name']) or die('MySQL Error: '. mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT));

	}



	public function escapeString($string)

	{

		return mysqli_real_escape_string($this->connection, $string);

	}



	public function escapeArray($array)

	{

	    array_walk_recursive($array, create_function('&$v', '$v = mysqli_real_escape_string($v);'));

		return $array;

	}

	

	public function to_bool($val)

	{

	    return !!$val;

	}

	

	public function to_date($val)

	{

	    return date('Y-m-d', $val);

	}

	

	public function to_time($val)

	{

	    return date('H:i:s', $val);

	}

	

	public function to_datetime($val)

	{

	    return date('Y-m-d H:i:s', $val);

	}



	public function fetch_assoc($val)

	{

		return mysqli_fetch_assoc($val);

	}

	public function fetch_object($val)

	{

		return mysqli_fetch_object($val);

	}

	public function num_rows($val)
	{
		return mysqli_num_rows($val);
	}



	public function fetch_array($val)

	{

		return mysqli_fetch_array($val);

	}

	

	public function query($qry)

	{

		$result = $this->execute($qry);

		$resultObjects = array();

		while($row = $this->fetch_array($result)) $resultObjects[] = $row;



		return $resultObjects;

	}

	public function queryimg($qry)

	{

		$result = $this->execute($qry);

		$resultObjects = array();

		while($row = $this->fetch_object($result)) $resultObjects[] = $row;



		return $resultObjects;

	}



	public function count($qry)

	{

		$result = $this->execute($qry);

		$data   = $this->fetch_array($result);

		$count  = $data[0];

		return $count;

	}


	public function getvalue($qry)

	{

		$result = $this->execute($qry);

		$data   = $this->fetch_array($result);

		return $data;

	}


	public function getval($table, $field, $fieldkey, $id)

	{

		$result = $this->execute("SELECT $field FROM $table WHERE $fieldkey = '$id'");

		$data   = $this->fetch_array($result);

		return $data[$field];

	}



	public function execute($qry)

	{
		//$exec = mysqli_query($this->connection, $qry);
		$exec = mysqli_query($this->connection, $qry) or die('MySQL Error: '. mysqli_error($this->connection));

	//	$exec = mysqli_query($this->connection, $qry) or die('MySQL Error: '. $qry . mysqli_errno($this->connection));

		return $exec;

	}



	function insertid()

    {

        $return = mysqli_insert_id($this->connection);

        return $return;

    }



	function autocode($table, $autocode)

    {

        $result  = $this->execute("SELECT autocode, CAST(REPLACE(autocode,'$autocode','') AS UNSIGNED) AS i FROM `$table`  ORDER BY CAST(REPLACE(autocode,'$autocode','') AS UNSIGNED) DESC LIMIT 1");

        $row     = $this->fetch_array($result);

        $n       = $row['i']+1;

        $newcode = $autocode.$n;



        return $newcode;

    }



	public function arr($data)

    {

        $result = "'".str_replace(" , ", " ", implode("', '", $data))."'";

        return $result;

    }

	function getphotos(){
		$result = $this->query("SELECT foto, cover FROM tuser WHERE user_id = '".$_SESSION['userid']."'");
        return $result;
	}



	public function sqlinsert($table, $fields, $menu)

    {

        global $config;



        $fields['approve']       = 1;

		$fields['level_id']      = $_SESSION['level_id'];

		$fields['level_name']    = $_SESSION['level_name'];

		$fields['location_id']   = $_SESSION['location_id'];

		$fields['location_name'] = $_SESSION['location_name'];

		$fields['created_by']    = $_SESSION['username'];

		$fields['created_on']    = date('Y-m-d H:i:s');



        $field     = "`".implode("`, `", array_keys($fields))."`";

        $data      = $this->arr($fields);

        $query     = "INSERT INTO $table ($field) VALUES ($data)";

        $result    = $this->execute($query);

        $id        = $this->insertid();

        $log       = $this->log($config['db_name'], $menu, 'ADD', $query, $id);

        if($result){ $return['success'] = $result; $return['id'] = $id; } else { $return =  $query; }

    	return $return;

    }



    public function sqlupdate($table, $data, $primary, $id, $menu)

    { 

        global $config;

        

		$data['approve']       = 1;

		$data['level_id']      = $_SESSION['level_id'];

		$data['level_name']    = $_SESSION['level_name'];

		$data['location_id']   = $_SESSION['location_id'];

		$data['location_name'] = $_SESSION['location_name'];

		$data['modified_by']   = $_SESSION['username'];

		$data['modified_on']   = date('Y-m-d H:i:s');



        array_walk($data, function(&$value, $key){

        	$value = "`$key` = '$value'";

        });



        $sUpdate = implode(", ", array_values($data));

        $query   = "UPDATE $table SET $sUpdate WHERE $primary = '$id'";

        $result  = $this->execute($query);

        $log     = $this->log($config['db_name'], $menu, 'EDIT', $query, $id);

        return $result;

    }



    public function sqldelete($table, $primary, $id, $menu)

    {

    	global $config;

    	

        $query     = "DELETE FROM $table WHERE $primary IN ('$id')";

        $result    = $this->execute($query);

        $log       = $this->log($config['db_name'], $menu, 'DELETE', $query);

        return $result;

    }



    public function sqldeletefile($table, $id, $label)

    {

        



        $data      = $this->getvalue("SELECT kode_parent, subdir FROM vt_files WHERE autono = $id");

        $i         = $this->count("SELECT COUNT(*) as jml FROM vt_files WHERE kode_parent = '$data[0]' AND subdir = '$data[1]'");

        // Reset file dokumen
        if($i == 1){

        	$reset = $this->execute("UPDATE tbl_dokumen SET file_dokumen = '' WHERE autocode = '$data[0]'");

        }


        // if($i == 1){

        // 	$reset = $this->execute("UPDATE $table SET $data[1] = '' WHERE kode_parent = '$data[0]'");

        // }



        $result = $this->sqldelete("vt_files", "autono", $id, $label);



		return $result;

    }



    function log($db, $menu, $act, $query, $id = null)

    {

       

        $user_id = $_SESSION['username'];

        $ip      = $_SERVER['REMOTE_ADDR'];

        $data    = str_replace("'", " \'", $query);

        $data    = $this->execute("INSERT INTO tlog (log_nama_form,log_date, log_action, log_user, log_ip, log_sql, log_record, log_db) VALUES ('$menu', NOW(), '$act', '$user_id', '$ip', '$data', '$id', '$db')");

        return true;

    }



    public function filter ( $request, $columns, &$bindings )

	{

		$globalSearch = array();

		$columnSearch = array();

		$dtColumns = $this->pluck( $columns, 'dt' );



		if ( isset($request['search']) && $request['search']['value'] != '' ) {

			$str = $request['search']['value'];



			for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {

				$requestColumn = $request['columns'][$i];

				$columnIdx = array_search( $requestColumn['data'], $dtColumns );

				$column = $columns[ $columnIdx ];



				if ( $requestColumn['searchable'] == 'true' ) {

					if(!empty($column['db'])){

						$binding = "'%".$str."%'";

						$globalSearch[] = "`".$column['db']."` LIKE ".$binding;

					}

				}

			}

		}



		// Individual column filtering

		if ( isset( $request['columns'] ) ) {

			for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {

				$requestColumn = $request['columns'][$i];

				$columnIdx = array_search( $requestColumn['data'], $dtColumns );

				$column = $columns[ $columnIdx ];



				$str = $requestColumn['search']['value'];



				if ( $requestColumn['searchable'] == 'true' &&

				 $str != '' ) {

					if(!empty($column['db'])){

						$binding = "'%".$str."%'";

						$columnSearch[] = "`".$column['db']."` LIKE ".$binding;

					}

				}

			}

		}



		$where = '';



		if ( count( $globalSearch ) ) {

			$where = '('.implode(' OR ', $globalSearch).')';

		}



		if ( count( $columnSearch ) ) {

			$where = $where === '' ?

				implode(' AND ', $columnSearch) :

				$where .' AND '. implode(' AND ', $columnSearch);

		}



		if ( $where !== '' ) {

			$where = 'WHERE '.$where;

		}



		return $where;

	}

	public function filters ( $request, $columns, &$bindings )

	{

		$globalSearch = array();

		$columnSearch = array();

		$dtColumns = $this->pluck( $columns, 'dt' );



		if ( isset($request['search']) && $request['search']['value'] != '' ) {

			$str = $request['search']['value'];



			for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {

				$requestColumn = $request['columns'][$i];

				$columnIdx = array_search( $requestColumn['data'], $dtColumns );

				$column = $columns[ $columnIdx ];



				if ( $requestColumn['searchable'] == 'true' ) {

					if(!empty($column['db'])){

						$binding = "'%".$str."%'";

						$globalSearch[] = "`".$column['db']."` LIKE ".$binding;

					}

				}

			}

		}



		// Individual column filtering

		if ( isset( $request['columns'] ) ) {

			for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {

				$requestColumn = $request['columns'][$i];

				$columnIdx = array_search( $requestColumn['data'], $dtColumns );

				$column = $columns[ $columnIdx ];



				$str = $requestColumn['search']['value'];



				if ( $requestColumn['searchable'] == 'true' &&

				 $str != '' ) {

					if(!empty($column['db'])){

						$binding = "'%".$str."%'";

						$columnSearch[] = "`".$column['db']."` LIKE ".$binding;

					}

				}

			}

		}



		$where = '';



		if ( count( $globalSearch ) ) {

			$where = '('.implode(' OR ', $globalSearch).')';

		}



		if ( count( $columnSearch ) ) {

			$where = $where === '' ?

				implode(' AND ', $columnSearch) :

				$where .' AND '. implode(' AND ', $columnSearch);

		}



		if ( $where !== '' ) {

			$where = 'WHERE '.$where;

		}



		return $where;

	}



	public function data_output ( $columns, $data )

	{

		$out = array();



		for ( $i=0, $ien=count($data) ; $i<$ien ; $i++ ) {

			$row = array();



			for ( $j=0, $jen=count($columns) ; $j<$jen ; $j++ ) {

				$column = $columns[$j];



				if ( isset( $column['formatter'] ) ) {

                    if(empty($column['db'])){

                        $row[ $column['dt'] ] = $column['formatter']( $data[$i] );

                    }

                    else{

                        $row[ $column['dt'] ] = $column['formatter']( $data[$i][ $column['db'] ], $data[$i] );

                    }

				}

				else {

                    if(!empty($column['db'])){

                        $row[ $column['dt'] ] = $data[$i][ $columns[$j]['db'] ];

                    }

                    else{

                        $row[ $column['dt'] ] = "";

                    }

				}

			}



			$out[] = $row;

		}



		return $out;

	}



	public function order ( $request, $columns )

	{

		$order = '';



		if ( isset($request['order']) && count($request['order']) ) {

			$orderBy = array();

			$dtColumns = $this->pluck( $columns, 'dt' );



			for ( $i=0, $ien=count($request['order']) ; $i<$ien ; $i++ ) {



				$columnIdx = intval($request['order'][$i]['column']);

				$requestColumn = $request['columns'][$columnIdx];



				$columnIdx = array_search( $requestColumn['data'], $dtColumns );

				$column = $columns[ $columnIdx ];



				if ( $requestColumn['orderable'] == 'true' ) {

					$dir = $request['order'][$i] === 'asc' ?

						'ASC' :

						'DESC';



					$orderBy[] = '`'.$column['db'].'` '.$dir;

				}

			}



			if ( count( $orderBy ) ) {

				$order = 'ORDER BY '.implode(', ', $orderBy);

			}

		}



		return $order;

	}



	public function limit ( $request, $columns )

	{

		$limit = '';



		if ( isset($request['start']) && $request['length'] != -1 ) {

			$limit = "LIMIT ".intval($request['start']).", ".intval($request['length']);

		}



		return $limit;

	}



    public function simple ( $request, $table, $primaryKey, $columns )

	{

		$bindings = array();

		$db = $this->connection;



		$limit = self::limit( $request, $columns );

		$order = self::order( $request, $columns );

		$where = self::filter( $request, $columns, $bindings );



		$data = $this->query(

			"SELECT `".implode("`, `", $this->pluck($columns, 'db'))."`

			 FROM `$table`

			 $where

			 $order

			 $limit"

		);



		$resFilterLength = $this->query(

			"SELECT COUNT(`{$primaryKey}`)

			 FROM   `$table`

			 $where"

		);



		$recordsFiltered = $resFilterLength[0][0];



		$resTotalLength = $this->query(

			"SELECT COUNT(`{$primaryKey}`)

			 FROM   `$table`"

		);

		$recordsTotal = $resTotalLength[0][0];



		return array(

			"draw"            => isset ( $request['draw'] ) ?

				intval( $request['draw'] ) :

				0,

			"recordsTotal"    => intval( $recordsTotal ),

			"recordsFiltered" => intval( $recordsFiltered ),

			"data"            => self::data_output( $columns, $data )

		);

	}



	public function simpletable ( $request, $table, $primaryKey, $columns, $id, $kode = null)

	{

		$bindings = array();

		$db = $this->connection;



		$limit = self::limit( $request, $columns );

		$order = self::order( $request, $columns );

		$where = self::filter( $request, $columns, $bindings );

		$sWhere = "WHERE menu_id = $id";



		$data = $this->query(

			"SELECT `".implode("`, `", $this->pluck($columns, 'db'))."`

			 FROM `$table`

			 $sWhere

			 ORDER BY column_id ASC

			 $limit"

		);



		$resFilterLength = $this->query(

			"SELECT COUNT(`{$primaryKey}`)

			 FROM   `$table`

			 $sWhere"

		);



		$recordsFiltered = $resFilterLength[0][0];



		$resTotalLength = $this->query(

			"SELECT COUNT(`{$primaryKey}`)

			 FROM   `$table` $sWhere"

		);

		$recordsTotal = $resTotalLength[0][0];



		return array(

			"draw"            => isset ( $request['draw'] ) ?

				intval( $request['draw'] ) :

				0,

			"recordsTotal"    => intval( $recordsTotal ),

			"recordsFiltered" => intval( $recordsFiltered ),

			"data"            => self::data_output( $columns, $data )

		);

	}

	public function simple_detail ( $request, $table, $primaryKey, $columns, $id )

	{

		$bindings = array();

		$db = $this->connection;



		$limit = self::limit( $request, $columns );

		$order = self::order( $request, $columns );

		$where = self::filter( $request, $columns, $bindings, true );

		$sWhere = "WHERE parent_id = $id";



		$data = $this->query(

			"SELECT `".implode("`, `", $this->pluck($columns, 'db'))."`

			 FROM `$table`

			 $sWhere

			 $where

			 $order

			 $limit"

		);



		$resFilterLength = $this->query(

			"SELECT COUNT(`{$primaryKey}`)

			 FROM   `$table`

			 $sWhere $where"

		);



		$recordsFiltered = $resFilterLength[0][0];



		$resTotalLength = $this->query(

			"SELECT COUNT(`{$primaryKey}`)

			 FROM   `$table` $sWhere"

		);

		$recordsTotal = $resTotalLength[0][0];



		return array(

			"draw"            => isset ( $request['draw'] ) ?

				intval( $request['draw'] ) :

				0,

			"recordsTotal"    => intval( $recordsTotal ),

			"recordsFiltered" => intval( $recordsFiltered ),

			"data"            => self::data_output( $columns, $data )

		);

	}



	public function simple_file ( $request, $table, $primaryKey, $columns, $id, $key)

	{

		$bindings = array();

		$db = $this->connection;

		$media = $this->getval("ref_media", 'direktori', 'autocode', $key);

		$limit = self::limit( $request, $columns );

		$order = self::order( $request, $columns );

		$where = self::filter( $request, $columns, $bindings );

		$sWhere = "WHERE `$primaryKey` = '$id'";



		$data = $this->query(

			"SELECT `".implode("`, `", $this->pluck($columns, 'db'))."`

			 FROM `$table`

			 $sWhere

			 $order

			 $limit"

		);



		$resFilterLength = $this->query(

			"SELECT COUNT(`{$primaryKey}`)

			 FROM   `$table`

			 $sWhere"

		);



		$recordsFiltered = $resFilterLength[0][0];



		$resTotalLength = $this->query(

			"SELECT COUNT(`{$primaryKey}`)

			 FROM   `$table`

			 $sWhere"

		);

		$recordsTotal = $resTotalLength[0][0];



		return array(

			"draw"            => isset ( $request['draw'] ) ? intval( $request['draw'] ) : 0,

			"recordsTotal"    => intval( $recordsTotal ),

			"recordsFiltered" => intval( $recordsFiltered ),

			"data"            => self::data_output( $columns, $data )

		);

	}


	public function getfile_disjarah ( $request, $table, $primaryKey, $columns, $id, $key, $ftable)

	{

		$bindings = array();

		$db = $this->connection;

		$media = $this->getval("ref_media", 'direktori', 'autocode', $key);

		$limit = self::limit( $request, $columns );

		$order = self::order( $request, $columns );

		$where = self::filter( $request, $columns, $bindings );

		$sWhere = "WHERE `$primaryKey` = '$id' AND `ftable` =  '$ftable'";



		$data = $this->query(

			"SELECT `".implode("`, `", $this->pluck($columns, 'db'))."`

			 FROM `$table`

			 $sWhere

			 $order

			 $limit"

		);



		$resFilterLength = $this->query(

			"SELECT COUNT(`{$primaryKey}`)

			 FROM   `$table`

			 $sWhere"

		);



		$recordsFiltered = $resFilterLength[0][0];



		$resTotalLength = $this->query(

			"SELECT COUNT(`{$primaryKey}`)

			 FROM   `$table`

			 $sWhere"

		);

		$recordsTotal = $resTotalLength[0][0];



		return array(

			"draw"            => isset ( $request['draw'] ) ? intval( $request['draw'] ) : 0,

			"recordsTotal"    => intval( $recordsTotal ),

			"recordsFiltered" => intval( $recordsFiltered ),

			"data"            => self::data_output( $columns, $data )

		);

	}


	public function fatal ( $msg )

	{

		echo json_encode( array( 

			"error" => $msg

		) );



		exit(0);

	}



	public function bind ( &$a, $val, $type )

	{

		$key = ':binding_'.count( $a );



		$a[] = array(

			'key' => $key,

			'val' => $val,

			'type' => $type

		);



		return $key;

	}



	static function pluck ( $a, $prop )

	{

		$out = array();



		for ( $i=0, $len=count($a) ; $i<$len ; $i++ ) {

            if(empty($a[$i][$prop])){

                continue;

			}



			$out[$i] = $a[$i][$prop];

		}



		return $out;

	}



	static function _flatten ( $a, $join = ' AND ' )

	{

		if ( ! $a ) {

			return '';

		}

		else if ( $a && is_array($a) ) {

			return implode( $join, $a );

		}

		return $a;

	}



	function reArrayFiles(&$file_post) {



	    $file_ary = array();

	    $file_count = count($file_post['name']);

	    $file_keys = array_keys($file_post);



	    for ($i=0; $i<$file_count; $i++) {

	        foreach ($file_keys as $key) {

	            $file_ary[$i][$key] = $file_post[$key][$i];

	        }

	    }



	    return $file_ary;

	}



	function randName($name){

		$file     = explode(".", $name);

		$md5      = MD5($file[0]);

		$namefile = $md5.".".$file[1];



		return $namefile;

	}



	function uploads($directory, $filename, $id, $subdir = null, $result = false)

    {

        global $config;



        if ($filename) {

		    $file_ary = $this->reArrayFiles($filename);

		    foreach ($file_ary as $file) {

		    	//$namefile = $this->randName($file["name"]);
            
            	$namefile = $file["name"];

		        $dir         = ROOT_DIR.'static/files/bahan/'.$directory.'/';

		        if($subdir != null){ $subdir = $subdir."/"; } 

		        $storagename = $dir.$id."/".$subdir.$namefile;

		        $storagefile = $dir.$id."/".$subdir;

		        if(!empty($namefile)){

		        	$ext = explode(".", $namefile);
		        	$filename_mp4 = $storagefile."/".$ext[0].".mp4";

		            if(!file_exists($storagefile)){

		                mkdir($storagefile, 0777, true);

		                $html         = fopen($storagefile."index.html", "w") or die("Unable to open file!");

		                $html_content = "<h1>Access forbidden!</h1>";

		                fwrite($html, $html_content);

		                fclose($html);

		                $result = move_uploaded_file($file["tmp_name"],  $storagename);

		                if(strtolower($ext[1]) == "mpg"){
		                	if(!file_exists($filename_mp4)){
		                		//exec("ffmpeg -i ".$storagename." -s 480x320 ".$filename_mp4);
		                		exec("ffmpeg -ss 00:00:20 -i ".$storagename." -vf scale=800:-1 -vframes 1 ".$storagefile."/".$ext[0].".jpg"); 
		                	}
		                }  else {
		                	exec("ffmpeg -ss 00:00:20 -i ".$storagename." -vf scale=800:-1 -vframes 1 ".$storagefile."/".$ext[0].".jpg"); 
		                }

		            } else {

		                $result = move_uploaded_file($file["tmp_name"],  $storagename);

		                if(strtolower($ext[1]) == "mpeg"){
		                	if(!file_exists($filename_mp4)){
		                		//exec("ffmpeg -i ".$storagename." -s 480x320 ".$filename_mp4);
		                		exec("ffmpeg -ss 00:00:20 -i ".$storagename." -vf scale=800:-1 -vframes 1 ".$storagefile."/".$ext[0].".jpg"); 
		                	}
		                } else {
		                	exec("ffmpeg -ss 00:00:20 -i ".$storagename." -vf scale=800:-1 -vframes 1 ".$storagefile."/".$ext[0].".jpg"); 
		                }

		            }

		        } 

		    }

		}



        

        return $result;

    }

    function uploadsliput($tanggal, $filename, $name_keg, $subdir = 'Lain', $result = false)

    { 

        global $config;
		// tahun -> bulan -> tanggal -> kegiatan -> file 
		$date      = explode("-", $tanggal);
		$tahun     = $date[0];
		$bulan     = strtoupper($this->get_bulan($date[1]));
		$tgl       = $this->format_tanggal($tanggal);
		$kegiatan  = 'Sample';
		
		$directory = $tahun."/".$bulan."/".$tgl."/";
        if ($filename) {

		    $file_ary = $this->reArrayFiles($filename);

		    foreach ($file_ary as $file) {
            
            	$namefile = $file["name"];

		        $dir         = ROOT_DIR.'static/files/bahan/'.$directory.'/';

		        if($subdir != null){ $subdir = $subdir."/"; } 

		        $storagename = $dir.$name_keg."/".$subdir.$namefile;

		        $storagefile = $dir.$name_keg."/".$subdir;

		        if(!empty($namefile)){

		        	$ext = explode(".", $namefile);
		        	$filename_mp4 = $storagefile."/".$ext[0].".mp4";

		            if(!file_exists($storagefile)){

		                mkdir($storagefile, 0777, true);

		                $html         = fopen($storagefile."index.html", "w") or die("Unable to open file!");

		                $html_content = "<h1>Access forbidden!</h1>";

		                fwrite($html, $html_content);

		                fclose($html);

		                $result = move_uploaded_file($file["tmp_name"],  $storagename);

		                if(strtolower($ext[1]) == "mpg"){
		                	if(!file_exists($filename_mp4)){
		                		//exec("ffmpeg -i ".$storagename." -s 480x320 ".$filename_mp4);
		                		exec("ffmpeg -ss 00:00:20 -i ".$storagename." -vf scale=800:-1 -vframes 1 ".$storagefile."/".$ext[0].".jpg"); 
		                	}
		                }  else {
		                	exec("ffmpeg -ss 00:00:20 -i ".$storagename." -vf scale=800:-1 -vframes 1 ".$storagefile."/".$ext[0].".jpg"); 
		                }

		            } else {

		                $result = move_uploaded_file($file["tmp_name"],  $storagename);

		                if(strtolower($ext[1]) == "mpeg"){
		                	if(!file_exists($filename_mp4)){
		                		//exec("ffmpeg -i ".$storagename." -s 480x320 ".$filename_mp4);
		                		exec("ffmpeg -ss 00:00:20 -i ".$storagename." -vf scale=800:-1 -vframes 1 ".$storagefile."/".$ext[0].".jpg"); 
		                	}
		                } else {
		                	exec("ffmpeg -ss 00:00:20 -i ".$storagename." -vf scale=800:-1 -vframes 1 ".$storagefile."/".$ext[0].".jpg"); 
		                }

		            }

		        } 

		    }

		}



        

        return $result;

    }


    function uploadfoto($filename, $result = false)

    {

        global $config;

        if ($filename) {
            
            	$namefile    = $filename["name"];

            	$smallnamefile    = "small".$filename["name"];

		        $dir         = ROOT_DIR.'chatsystem/storage/user_image/';

		        $storagename = $dir.$namefile;
		        $storagenamesmall = $dir.$smallnamefile;

		        $storagefile = $dir;

		        if(!empty($namefile)){

		            if(!file_exists($storagefile)){

		                mkdir($storagefile, 0777, true);

		                $html         = fopen($storagefile."index.html", "w") or die("Unable to open file!");

		                $html_content = "<h1>Access forbidden!</h1>";

		                fwrite($html, $html_content);

		                fclose($html);

		                $result = move_uploaded_file($filename["tmp_name"],  $storagename);

		                $rs = copy($storagename,  $storagenamesmall);

		            } else {

		                $result = move_uploaded_file($filename["tmp_name"],  $storagename);
		                $rs = copy($storagename,  $storagenamesmall);

		                $html         = fopen($storagefile."index.html", "w") or die("Unable to open file!");

		                $html_content = "<h1>".$storagenamesmall."</h1>";

		                fwrite($html, $html_content);

		                fclose($html);

		            }

		        } 

		} 

        return $result;

    }



    public function tempscript($id)

	{

		$result = $this->getval("app_generate", "scripts", "types", $id); 

		return $result;

	}





	function parseAndPrintTree($root, $tree) {

     	global $menuItems;

     	$return = array();

	     if(!is_null($tree) && count($tree) > 0) {

	        echo '<ul>';

		        foreach($tree as $child => $parent) {

		          if($parent == $root) {                    

		            unset($tree[$child]);

		            foreach ($menuItems as $row) {

		                if($row['id'] == $child)

		             echo "<li><a href=\"\">Tees</a>";

		            }    

		            $this->parseAndPrintTree($child, $tree);

		            echo '</li>';

		        }

		    }

		    echo '</ul>';

		  }

	}



	function generate_menu_list($parent_id) { 

		

		$result = $this->execute("SELECT * FROM tmenu WHERE parent_id ='$parent_id' order by menu_id "); 

		if (result) 

			{ while ($row = $this->fetch_array($result)) {

				$count = $this->execute("SELECT count(0) as cnt FROM tmenu WHERE parent_id='".$row['menu_id']."'"); $countrow = $this->fetch_array($count);



    				echo '<li><a href="tes"><span class="fa fa-user"></span>'.$row['menu_name '].'</a> ';



		     if($countrow['cnt']>0)

		     {

		        echo '<ul>'; 

		        $this->generate_menu_list($row['menu_id']);  

		        echo '</ul>';

		     }  

		     echo '</li>';

		  } 

		}   

	}





    # Reference Model (combobox)



    public function clients()

	{

		$result = $this->query("SELECT autocode, nama FROM tprojectclients");

		return $result;

	}



	public function apps_type()

	{

		$result = $this->query("SELECT kode, nama FROM tprojectappstype");

		return $result;

	}



	public function data_type()

	{

		$result = $this->query("SELECT type_id, type_name FROM app_generate_data_type");

		return $result;

	}



	public function input_type()

	{

		$result = $this->query("SELECT input_id, input_name FROM app_generate_input_type");

		return $result;

	}



	public function projects()

	{

		$result = $this->query("SELECT autocode, nama_project FROM tproject");

		return $result;

	}



	public function team()

	{

		$result = $this->query("SELECT user_id, user_fullname FROM tuser WHERE user_id <> 'root' ORDER BY user_fullname asc");

		return $result;

	}

	public function show_menu($group_id = null, $activemenu = NULL)
	{
		global $config;
		$kode_apps = $config['app_code'];
		$result    = $this->execute("SELECT a.`menu_id` AS id, a.`menu_name` AS title, a.`parent_id`, a.`linkto` AS url, a.`menu_icon` AS icons, b.`group_id`, IF(b.`permission_a` = 1, true,false) AS permission_a, IF(a.`linkto` = '".$activemenu."', 'active', '') AS sactive  FROM tmenu a LEFT JOIN ( SELECT group_id, menu_id, permission_a FROM tusermenu WHERE group_id = $group_id) AS b ON a.`menu_id` = b.`menu_id` WHERE a.`kode_apps` IN ('0', '$kode_apps') AND group_id = $group_id AND a.`enabled` = 'Y' ORDER BY a.`menu_id`, a.`ordering` ASC");

		return $result;
	}

	public function show_menus($group_id = null)
	{
		global $config;
		$kode_apps = $config['app_code'];
		$result    = $this->execute("SELECT a.`menu_id` AS id, a.`menu_name` AS title, a.`parent_id`, a.`linkto` AS url, a.`menu_icon` AS menu_icon, b.`group_id`, IF(b.`permission_a` = 1, true,false) AS permission_a, enabled, linkto FROM tmenu a LEFT JOIN ( SELECT group_id, menu_id, permission_a FROM tusermenu WHERE group_id = $group_id) AS b ON a.`menu_id` = b.`menu_id` WHERE a.`kode_apps` IN ('0', '$kode_apps') ORDER BY a.`menu_id`, a.`ordering` ASC");

		return $result;
	}


	public function format_tanggal($value)
	{
		$tgl = explode('-', $value);

		$result = $tgl[2].' '.strtoupper($this->get_bulan($tgl[1])).' '.$tgl[0];

		return $result;
	}

	public function format_tanggal_hari($value)
	{
		$tgl = explode('-', $value);

		$hari = $this->nama_hari(date('w', strtotime($value)));

		$result = $hari.", ".$tgl[2].' '.$this->get_bulan($tgl[1]).' '.$tgl[0];

		return $result;
	}

	public function format_tanggal_jam($value)
	{
		$tgl = explode('-', $value);

		$hari = $this->nama_hari(date('w', strtotime($value)));

		$day  = explode(" ", $tgl[2]);

		$result = $hari.", ".$day[0].' '.$this->get_bulan($tgl[1]).' '.$tgl[0].' '.substr($day[1], 0,5);

		return $result;
	}

	function nama_hari($tanggal) {

        switch ($tanggal){
            
            case 0:
                return 'Minggu';
            case 1:
                return 'Senin';
            case 2:
                return 'Selasa';
            case 3:
                return 'Rabu';
            case 4:
                return 'Kamis';
            case 5:
                return 'Jumat';
            case 6:
                return 'Sabtu';
            default:
                return '';
        }
    }

	public function get_bulan($value)
	{
		switch ($value) {
			case '1':
				$bulan = 'Januari';
				break;
			case '2':
				$bulan = 'Februari';
				break;
			case '3':
				$bulan = 'Maret';
				break;
			case '4':
				$bulan = 'April';
				break;
			case '5':
				$bulan = 'Mei';
				break;
			case '6':
				$bulan = 'Juni';
				break;
			case '7':
				$bulan = 'Juli';
				break;
			case '8':
				$bulan = 'Agustus';
				break;
			case '9':
				$bulan = 'September';
				break;
			case '10':
				$bulan = 'Oktober';
				break;
			case '11':
				$bulan = 'November';
				break;
			case '12':
				$bulan = 'Desember';
				break;
			
			default:
				$bulan = '00';
				break;
		}

		return $bulan;
	}


    public function get_menu($data, $parent = 0) 
    {
      static $i = 1;
      $tab = str_repeat("\t\t\t\t", $i);
      if (isset($data[$parent])) {

      	if($parent == 0){
      		$html = "\n$tab<ul class=\"navigation navigation-main navigation-accordion\">";
      	} else {
      		$html = "\n$tab<ul>";
      	}
        
        $i++;
        foreach ($data[$parent] as $v) {
          $child = $this->get_menu($data, $v->id);
          if(!empty($v->sactive)) { $html .= "\n\t$tab<li  class=\"".$v->sactive."\">"; } else { $html .= "\n\t$tab<li>"; }

          $html .= "<a href=\"".BASE_URL.$v->url."\"><i class=\"".$v->icons."\"></i> <span>".$v->title."</span></a>";
          if ($child) {
            $i--;
            $html .= $child;
            $html .= "\n\t$tab";
          }
          $html .= '</li>';
        }
        $html .= "\n$tab</ul>";
        return $html;
      } else {
        return false;
      }
    }

    public function pagination( $query, $limit = 10, $page = 1 ) 

    {
		$rs           = $this->execute( $query );
		$total = $this->num_rows($rs);
	 
	    if ( $limit == '' ) {
	        $query      = $query;
	    } else {
	        $query      = $query . " LIMIT " . ( ( $page - 1 ) * $limit ) . ", $limit";
	    }
	    
	    $rs             = $this->execute( $query );
	 
	    while ( $row = $this->fetch_assoc($rs) ) {
	        $results[]  = $row;
	    }
	 
	    $result['page']   = $page;
	    $result['limit']  = $limit;
	    $result['total']  = $total;
	    $result['aadata'] = $results;
	 
	    return $result;
	}


	public function createLinks( $q, $total, $limit, $page ) 
	{

	    $links      = 7;
	 
	    $last       = ceil( $total / $limit );
	 
	    $start      = ( ( $page - $links ) > 0 ) ? $page - $links : 1;
	    $end        = ( ( $page + $links ) < $last ) ? $page + $links : $last;
	 
	    $html       = "<ul class=\"pagination pagination-flat pagination-xs no-margin-bottom\">"; 
	 
	    $class      = ( $page == 1 ) ? "disabled" : "";
	    $html       .= '<li class="' . $class . '"><a href="'.BASE_URL.'pencarian/search/?q=' . $q . '&page=' . ( $page - 1 ) . '">&laquo;</a></li>';
	 
	    if ( $start > 1 ) {
	        $html   .= '<li><a href="'.BASE_URL.'pencarian/search/?q=' . $q . '&page=1">1</a></li>';
	        $html   .= '<li class="disabled"><span>...</span></li>';
	    }
	 
	    for ( $i = $start ; $i <= $end; $i++ ) {
	        $class  = ( $page == $i ) ? "active" : "";
	        $html   .= '<li class="' . $class . '"><a href="'.BASE_URL.'pencarian/search/?q=' . $q . '&page=' . $i . '">' . $i . '</a></li>';
	    }
	 
	    if ( $end < $last ) {
	        $html   .= '<li class="disabled"><span>...</span></li>';
	        $html   .= '<li><a href="'.BASE_URL.'pencarian/search/?q=' . $q . '&page=' . $last . '">' . $last . '</a></li>';
	    }
	 
	    $class      = ( $page == $last ) ? "disabled" : "";
	    $html       .= '<li class="' . $class . '"><a href="'.BASE_URL.'pencarian/search/?q=' . $q . '&page=' . ( $page + 1 ) . '">&raquo;</a></li>';
	 
	    $html       .= '</ul>';
	 
	    return $html;
	}

	public function createPagingVideo( $q, $total, $limit, $page ) 
	{

	    $links      = 7;
	 
	    $last       = ceil( $total / $limit );
	 
	    $start      = ( ( $page - $links ) > 0 ) ? $page - $links : 1;
	    $end        = ( ( $page + $links ) < $last ) ? $page + $links : $last;
	 
	    $html       = "<ul class=\"pagination pagination-flat pagination-xs no-margin-bottom\">"; 
	 
	    $class      = ( $page == 1 ) ? "disabled" : "";
	    $html       .= '<li class="' . $class . '"><a href="'.BASE_URL.'frontoffice/gallery_video/?q=' . $q . '&page=' . ( $page - 1 ) . '">&laquo;</a></li>';
	 
	    if ( $start > 1 ) {
	        $html   .= '<li><a href="'.BASE_URL.'frontoffice/gallery_video/?q=' . $q . '&page=1">1</a></li>';
	        $html   .= '<li class="disabled"><span>...</span></li>';
	    }
	 
	    for ( $i = $start ; $i <= $end; $i++ ) {
	        $class  = ( $page == $i ) ? "active" : "";
	        $html   .= '<li class="' . $class . '"><a href="'.BASE_URL.'frontoffice/gallery_video/?q=' . $q . '&page=' . $i . '">' . $i . '</a></li>';
	    }
	 
	    if ( $end < $last ) {
	        $html   .= '<li class="disabled"><span>...</span></li>';
	        $html   .= '<li><a href="'.BASE_URL.'frontoffice/gallery_video/?q=' . $q . '&page=' . $last . '">' . $last . '</a></li>';
	    }
	 
	    $class      = ( $page == $last ) ? "disabled" : "";
	    $html       .= '<li class="' . $class . '"><a href="'.BASE_URL.'frontoffice/gallery_video/?q=' . $q . '&page=' . ( $page + 1 ) . '">&raquo;</a></li>';
	 
	    $html       .= '</ul>';
	 
	    return $html;
	}

	public function createPagingFoto( $q, $total, $limit, $page ) 
	{

	    $links      = 7;
	 
	    $last       = ceil( $total / $limit );
	 
	    $start      = ( ( $page - $links ) > 0 ) ? $page - $links : 1;
	    $end        = ( ( $page + $links ) < $last ) ? $page + $links : $last;
	 
	    $html       = "<ul class=\"pagination pagination-flat pagination-xs no-margin-bottom\">"; 
	 
	    $class      = ( $page == 1 ) ? "disabled" : "";
	    $html       .= '<li class="' . $class . '"><a href="'.BASE_URL.'frontoffice/gallery_foto/?q=' . $q . '&page=' . ( $page - 1 ) . '">&laquo;</a></li>';
	 
	    if ( $start > 1 ) {
	        $html   .= '<li><a href="'.BASE_URL.'frontoffice/gallery_foto/?q=' . $q . '&page=1">1</a></li>';
	        $html   .= '<li class="disabled"><span>...</span></li>';
	    }
	 
	    for ( $i = $start ; $i <= $end; $i++ ) {
	        $class  = ( $page == $i ) ? "active" : "";
	        $html   .= '<li class="' . $class . '"><a href="'.BASE_URL.'frontoffice/gallery_foto/?q=' . $q . '&page=' . $i . '">' . $i . '</a></li>';
	    }
	 
	    if ( $end < $last ) {
	        $html   .= '<li class="disabled"><span>...</span></li>';
	        $html   .= '<li><a href="'.BASE_URL.'frontoffice/gallery_foto/?q=' . $q . '&page=' . $last . '">' . $last . '</a></li>';
	    }
	 
	    $class      = ( $page == $last ) ? "disabled" : "";
	    $html       .= '<li class="' . $class . '"><a href="'.BASE_URL.'frontoffice/gallery_foto/?q=' . $q . '&page=' . ( $page + 1 ) . '">&raquo;</a></li>';
	 
	    $html       .= '</ul>';
	 
	    return $html;
	}

	public function createPagingSearch( $q, $total, $limit, $page, $tab = null ) 
	{

	    $links      = 7;
	 
	    $last       = ceil( $total / $limit );
	 
	    $start      = ( ( $page - $links ) > 0 ) ? $page - $links : 1;
	    $end        = ( ( $page + $links ) < $last ) ? $page + $links : $last;
	 
	    $html       = "<ul class=\"pagination pagination-flat pagination-xs no-margin-bottom\">"; 
	 
	    $class      = ( $page == 1 ) ? "disabled" : "";
	    $html       .= '<li class="' . $class . '"><a href="'.BASE_URL.'frontoffice/pencarian/?q=' . $q . '&page=' . ( $page - 1 ) . '&tab='.$tab.'">&laquo;</a></li>';
	 
	    if ( $start > 1 ) {
	        $html   .= '<li><a href="'.BASE_URL.'frontoffice/pencarian/?q=' . $q . '&page=1&tab='.$tab.'">1</a></li>';
	        $html   .= '<li class="disabled"><span>...</span></li>';
	    }
	 
	    for ( $i = $start ; $i <= $end; $i++ ) {
	        $class  = ( $page == $i ) ? "active" : "";
	        $html   .= '<li class="' . $class . '"><a href="'.BASE_URL.'frontoffice/pencarian/?q=' . $q . '&page=' . $i .'&tab='.$tab. '">' . $i . '</a></li>';
	    }
	 
	    if ( $end < $last ) {
	        $html   .= '<li class="disabled"><span>...</span></li>';
	        $html   .= '<li><a href="'.BASE_URL.'frontoffice/pencarian/?q=' . $q . '&page=' . $last . '&tab='.$tab.'">' . $last . '</a></li>';
	    }
	 
	    $class      = ( $page == $last ) ? "disabled" : "";
	    $html       .= '<li class="' . $class . '"><a href="'.BASE_URL.'frontoffice/pencarian/?q=' . $q . '&page=' . ( $page + 1 ) . '&tab='.$tab.'">&raquo;</a></li>';
	 
	    $html       .= '</ul>';
	 
	    return $html;
	}

	public function get_tahunaudit()
    {
    	$result = $this->query("SELECT thang, IF(tahunaudit IS NULL, '', 'selected') AS pselect FROM dja_pagu a  LEFT JOIN ( SELECT tahunaudit FROM tuser WHERE user_id = '".$_SESSION['userid']."' ) AS b ON a.thang = b.tahunaudit GROUP BY thang");

    	return $result;
    }

    public function tahunaudit()
    {
    	$result = $this->getvalue("SELECT tahunaudit FROM tuser WHERE user_id = '".$_SESSION['userid']."'");

    	return $result[0];
    }

    

}

