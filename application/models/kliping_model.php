<?php

class Kliping_model extends Model {

	public function mget($request, $table, $primaryKey, $columns)
	{
		$result = $this->simple($request, $table, $primaryKey, $columns);
		return $result;
	}

	public function mget_detail($request, $table, $primaryKey, $columns, $id)
	{
		$result = $this->dt_detail($request, $table, $primaryKey, $columns, $id);
		return $result;
	}

	public function get($table, $primaryKey, $id)
	{
		$result = $this->query("SELECT * FROM $table WHERE $primaryKey = '$id'");
		return $result;
	}

	public function getmedianews()
	{
		$result = $this->query("SELECT autono, nama_klasifikasi as nama_media FROM ref_klasifikasi_media");
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

    public function getkliping($table, $table_detail, $id)
	{
		$result = $this->query("SELECT a.autono, a.nama_kegiatan AS judul_kliping, a.tanggal, link,media, title_news, image_link, image_caption, article_show, article_ori, article_clean, author, date_news FROM $table a LEFT JOIN (SELECT autono, parent_id, link,media, title_news, image_link, image_caption, article_show, article_ori, article_clean, author, date_news FROM $table_detail) AS b ON a.`autono` = b.parent_id WHERE a.autono = $id");
		return $result;
	}

	public function getk($id, $tipe)
	{
		$result = $this->query("SELECT * FROM vt_files WHERE parent_id = $id AND tipe = $tipe ORDER BY ordering");
		return $result;
	}

	public function savefile($data = array())
	{

		$result = $this->sqlinsert('vt_files', $data, 'Kliping');

		return $result;
	}

	public function dt_detail ( $request, $table, $primaryKey, $columns, $id )

	{

		$bindings = array();

		$db = $this->connection;



		$limit = self::limit( $request, $columns );

		$order = self::order( $request, $columns );

		$where = self::filters( $request, $columns, $bindings, true );

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

	public function getfiles($request, $table, $primaryKey, $columns, $id, $tipes)
	{
		
		$result = $this->simple_file_kliping($request, $table, $primaryKey, $columns, $id, $tipes);

		return $result;
	}

	public function deletes_file($id)
    {
        $result = $this->sqldeletefile('vt_files', $id, 'Kliping');
		return $result;
    }

    public function simple_file_kliping ( $request, $table, $primaryKey, $columns, $id, $key = null)

	{

		$bindings = array();

		$db = $this->connection;

		$media = $this->getval("ref_media", 'direktori', 'autocode', $key);

		$limit = self::limit( $request, $columns );

		$order = self::order( $request, $columns );

		$where = self::filter( $request, $columns, $bindings );

		if($key){
			$wh = " AND tipe = $key";
		} else {
			$wh = "";
		}

		$sWhere = "WHERE `$primaryKey` = '$id' $wh";



		$data = $this->query(

			"SELECT `".implode("`, `", $this->pluck($columns, 'db'))."`

			 FROM `$table`

			 $sWhere

			 ORDER BY nama_file ASC

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


}