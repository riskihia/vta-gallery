<?php

class Rekap_model extends Model {

	public function mget($request, $table, $primaryKey, $columns, $query)

	{
		$result = $this->laporan_datatable($request, $table, $primaryKey, $columns, $query);

		return $result;

	}

	public function mget_upload($request, $table, $primaryKey, $columns, $query, $field, $x)

	{
		$result = $this->laporan($request, $table, $primaryKey, $columns, $query, $field, $x);

		return $result;

	}

	public function mget_jenis($request, $table, $primaryKey, $columns, $query, $field, $x)

	{
		$result = $this->laporan($request, $table, $primaryKey, $columns, $query, $field, $x);

		return $result;

	}

	public function mget_kategori($request, $table, $primaryKey, $columns, $query, $field, $x)

	{
		$result = $this->laporan($request, $table, $primaryKey, $columns, $query, $field, $x);

		return $result;

	}

	public function mget_kondisi($request, $table, $primaryKey, $columns, $query, $field, $x)

	{
		$result = $this->laporan($request, $table, $primaryKey, $columns, $query, $field, $x);

		return $result;

	}

	public function mget_keywords($request, $table, $primaryKey, $columns, $query, $field, $x)

	{
		$result = $this->laporan_keywords($request, $table, $primaryKey, $columns, $query, $field, $x);

		return $result;

	}

	public function getjenis()

	{

		$result = $this->query("SELECT autocode, nama_media FROM ref_media ORDER BY nama_media ASC");

		return $result;

	}

	public function getsatker()

	{

		$result = $this->query("SELECT autocode, nama_satker FROM ref_satker ORDER BY nama_satker ASC");

		return $result;

	}

	public function getoperator()

	{

		$result = $this->query("SELECT created_by, created_by as nama_operator FROM tbl_dokumen GROUP BY created_by ORDER BY created_by ASC");

		return $result;

	}

	public function get_provinsi()
    {
        $items = array();
        $provinsi = $this->execute("SELECT kd_prov, provinsi FROM tbl_wilayah GROUP BY kd_prov ORDER BY kd_prov ASC");
        while ($row = $this->fetch_assoc($provinsi)) {
            $data['kd_prov']   = $row['kd_prov'];
            $data['provinsi']  = $row['provinsi'];
            $data['kabupaten'] = array();

            $kota              = $this->execute("SELECT kode, kd_kab, kabupaten FROM tbl_wilayah WHERE kd_prov = '".$row ['kd_prov']."' GROUP BY kd_kab ORDER BY kabupaten ASC");
            while ($rows = $this->fetch_assoc($kota)) {
                array_push($data['kabupaten'], $rows);
            }
            array_push($items, $data);
        }

        return $items;
    }

	public function getwilayah()

	{

		$result = $this->query("SELECT kode, provinsi FROM tbl_wilayah GROUP BY provinsi ORDER BY provinsi ASC ");

		return $result;

	}

	public function getkondisi()

	{

		$result = $this->query("SELECT autocode, nama_kondisi FROM ref_kondisi ORDER BY nama_kondisi ASC");

		return $result;

	}

	public function getkategori()

	{

		$result = $this->query("SELECT autocode, nama_kategori FROM ref_kategori ORDER BY nama_kategori ASC");

		return $result;

	}

	public function laporan( $request, $table, $primaryKey, $columns, $query, $field, $x)

	{

		$bindings = array();	
		$db       = $this->connection;
		$limit    = self::limit( $request, $columns );
		$order    = self::order( $request, $columns );
		$where    = self::filters( $request, $columns, $bindings );
		if($x == 'all'){
			$sWhere   = "WHERE $field != '' ";
		} else {
			$sWhere   = "WHERE $field = '".$x."'";
		}

		$data = $this->query(
			"$query
			 $sWhere
			 $where
			 $order
			 $limit"
		);


		$resFilterLength = $this->query(
			"SELECT COUNT(*)
			 FROM   ($query $sWhere $where) AS t1"
		);


		$recordsFiltered = $resFilterLength[0][0];

		$resTotalLength = $this->query(
			"SELECT COUNT(*)
			 FROM   ($query $sWhere)  AS t1"
		);

		$recordsTotal = $resTotalLength[0][0];

		return array(
			"draw"            => isset ( $request['draw'] ) ? intval( $request['draw'] ) : 0,
			"recordsTotal"    => intval( $recordsTotal ),
			"recordsFiltered" => intval( $recordsFiltered ),
			"data"            => self::data_output( $columns, $data )
		);
	}

	public function laporan_keywords( $request, $table, $primaryKey, $columns, $query, $field, $x)

	{

		$bindings = array();	
		$db       = $this->connection;
		$limit    = self::limit( $request, $columns );
		$order    = self::order( $request, $columns );
		$where    = self::filters( $request, $columns, $bindings );
		if($x == 'all'){
			$sWhere   = "WHERE $field LIKE '%%' ";
		} else {
			$sWhere   = "WHERE $field LIKE '%".$x."%'";
		}

		$data = $this->query(
			"$query
			 $sWhere
			 $where
			 GROUP BY keywords
			 $order
			 $limit"
		);


		$resFilterLength = $this->query(
			"SELECT COUNT(*)
			 FROM   ($query $sWhere $where GROUP BY keywords) AS t1"
		);


		$recordsFiltered = $resFilterLength[0][0];

		$resTotalLength = $this->query(
			"SELECT COUNT(*)
			 FROM   ($query $sWhere GROUP BY keywords)  AS t1"
		);

		$recordsTotal = $resTotalLength[0][0];

		return array(
			"draw"            => isset ( $request['draw'] ) ? intval( $request['draw'] ) : 0,
			"recordsTotal"    => intval( $recordsTotal ),
			"recordsFiltered" => intval( $recordsFiltered ),
			"data"            => self::data_output( $columns, $data )
		);
	}


	public function laporan_datatable ( $request, $table, $primaryKey, $columns, $query)

	{

		$bindings = array();
		
		$db       = $this->connection;
		$limit    = self::limit( $request, $columns );
		$order    = self::order( $request, $columns );
		$where    = self::filter( $request, $columns, $bindings );

		$data = $this->query(
			"$query
			 $where
			 $order
			 $limit"
		);


		$resFilterLength = $this->query(
			"SELECT COUNT(*)
			 FROM   ($query) AS t1
			 $where"
		);


		$recordsFiltered = $resFilterLength[0][0];

		$resTotalLength = $this->query(
			"SELECT COUNT(*)
			 FROM   ($query)  AS t1
			 $where"
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
			$where = ' AND '.$where;
		}

		return $where;

	}


}
