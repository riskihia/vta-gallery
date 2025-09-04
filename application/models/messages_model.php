<?php



class Messages_model extends Model {



	public function mget($request, $table, $primaryKey, $columns)

	{

		$result = $this->dtmessages($request, $table, $primaryKey, $columns);

		return $result;

	}



	public function mget_detail($request, $table, $primaryKey, $columns, $id)

	{

		$result = $this->simple_detail($request, $table, $primaryKey, $columns, $id);

		return $result;

	}


	public function get($table, $primaryKey, $id)

	{

		$result = $this->query("SELECT * FROM $table WHERE $primaryKey = '$id'");

		return $result;

	}

    public function get_dokumen($table, $primaryKey, $id)

    {

        $result = $this->getvalue("SELECT autono, autocode, nama_kegiatan, lokasi, no_card, narasi, tanggal, fotografer, kamera, date(created_on) as created_on FROM $table WHERE $primaryKey = '$id'");

        return $result;

    }


    public function get_views($id)

    {

        $result = $this->getvalue("SELECT SUM(views) as vcount FROM ref_views WHERE parent_id = $id");

        return $result;

    }

    public function approve($id)

    {
        
        $query  = "UPDATE tbl_download_personel SET sapprove = 1 WHERE autono = $id";
        $result = $this->execute($query);
        $log    = $this->log('app', 'Download approve', 'Approve', $query, $id);
        
        return $result;

    }

    public function check()

    { 
        if($_SESSION['groupid'] == 1){

            $swhere = "AND level_id <> 0";
        } else {

            $swhere = " AND created_by = '".$_SESSION['userid']."'";
        }
    
    	// if($_SESSION['groupid'] == 1) {
    	// $sWhere = "WHERE level_id <> 0";
    	// } else {
    	// $ses = $_SESSION['username'];
    	// $sWhere = "WHERE created_by = '$ses'";
    	// }


        $result['aadata'] = $this->query("SELECT autono, nama_lengkap, keperluan, jabatan, created_on, date(created_on) as tanggal, time(created_on) as jam FROM tbl_download_personel WHERE sapprove = 0 ".$swhere." ORDER BY created_on DESC LIMIT 0,10 ");
        $result['jmlmsg'] = $this->getvalue("SELECT COUNT(*) as jml FROM tbl_download_personel WHERE sapprove = 0 $swhere " );
        // $result['aadata'] = $this->query("SELECT COUNT(*) AS jml, from_uname, message_content, TIME(message_date) AS message_date FROM `messages` WHERE to_uname = '".$_SESSION['username']."' AND seen = '0' GROUP BY from_uname ");
        // $result['jmlmsg'] = $this->getvalue("SELECT COUNT(*) AS jml FROM `messages` WHERE to_uname = '".$_SESSION['username']."' AND seen = '0'" );

        return $result;

    }

    public function chats()

    { 
        if($_SESSION['groupid'] == 1){

            $swhere = "AND level_id <> 0";
        } else {

            $swhere = " AND created_by = '".$_SESSION['userid']."'";
        }
    

        $result['aadata'] = $this->query("SELECT COUNT(*) AS jml, from_uname, user_fullname, IF(message_type = 'text', message_content, '.: File Image/Document :.') as message_content, TIME(message_date) AS message_date, a.picname FROM `messages` as u LEFT JOIN tuser a ON u.from_uname = a.user_id WHERE to_uname = '".$_SESSION['username']."' AND seen = '0' GROUP BY from_uname ");
        $result['jmlmsg'] = $this->getvalue("SELECT COUNT(*) AS jml FROM `messages` WHERE to_uname = '".$_SESSION['username']."' AND seen = '0'" );

        return $result;

    }



	public function msave($table, $data = array(), $title)

	{

		$result = $this->sqlinsert($table, $data, $title);

		return $result;

	}

	public function savefile($data = array())
	{

		$result = $this->sqlinsert('vt_files', $data, 'Dokumen');

		return $result;

	}

	public function getfiles($request, $table, $primaryKey, $columns, $id)
	{
		
		$result = $this->dtfile($request, $table, $primaryKey, $columns, $id);

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

    public function dtmessages ( $request, $table, $primaryKey, $columns)

    {

        $bindings = array();

        $db = $this->connection;



        $limit = self::limit( $request, $columns );

        $order = self::order( $request, $columns );

        $where = self::filters( $request, $columns, $bindings );

        if($_SESSION['groupid'] == 1) {
            $sWhere = "WHERE level_id <> 0";
        } else {
            $ses = $_SESSION['username'];
            $sWhere = "WHERE created_by = '$ses'";
        }

        



        $data = $this->query(

            "SELECT `".implode("`, `", $this->pluck($columns, 'db'))."`

             FROM `$table`

             $sWhere

             $where

             ORDER BY created_on DESC

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

    public function dtfile ( $request, $table, $primaryKey, $columns, $id)

    {

        $bindings = array();

        $db = $this->connection;

        $limit = self::limit( $request, $columns );

        $order = self::order( $request, $columns );

        $where = self::filter( $request, $columns, $bindings );

        $sJoin = "RIGHT JOIN (SELECT idfile FROM tbl_download_file WHERE parent_id = $id) AS b ON vt_files.`autono` = b.idfile";



        $data = $this->query(

            "SELECT `".implode("`, `", $this->pluck($columns, 'db'))."`

             FROM `$table`

             $sJoin

             $order

             $limit"

        );



        $resFilterLength = $this->query(

            "SELECT COUNT(`{$primaryKey}`)

             FROM   `$table`

             $sJoin"

        );



        $recordsFiltered = $resFilterLength[0][0];



        $resTotalLength = $this->query(

            "SELECT COUNT(`{$primaryKey}`)

             FROM   `$table`

             $sJoin"

        );

        $recordsTotal = $resTotalLength[0][0];



        return array(

            "draw"            => isset ( $request['draw'] ) ? intval( $request['draw'] ) : 0,

            "recordsTotal"    => intval( $recordsTotal ),

            "recordsFiltered" => intval( $recordsFiltered ),

            "data"            => self::data_output( $columns, $data )

        );

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

            $where = 'AND '.$where;

        }



        return $where;

    }


}