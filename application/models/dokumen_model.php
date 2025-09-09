<?php



class Dokumen_model extends Model {



	public function mget($request, $table, $primaryKey, $columns)

	{

		$result = $this->simple($request, $table, $primaryKey, $columns);

		return $result;

	}



	public function mget_detail($request, $table, $primaryKey, $columns, $id)

	{

		$result = $this->simple_detail($request, $table, $primaryKey, $columns, $id);

		return $result;

	}

    public function mget_foto($request, $table, $primaryKey, $columns)

    {

        $result = $this->mgetfoto($request, $table, $primaryKey, $columns);

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

	public function getfiles($request, $table, $primaryKey, $columns, $id, $y)
	{
		
		$result = $this->simple_file($request, $table, $primaryKey, $columns, $id, $y);

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


    public function deletes_file($id)
    {
        $result = $this->sqldeletefile('vt_files', $id, 'Dokumen');
		return $result;
    }

    public function get_kamera()
    {
        
        // $tahun = $this->currentyear($_SESSION['userid']);
        $result = $this->query("SELECT autocode, nama_kamera FROM ref_kamera  ORDER BY nama_kamera ASC");

        return $result;
    }

    public function get_kameraedit($id)
    {
        $result = $this->query("SELECT a.autocode, a.`nama_kamera`, IF(b.autocode IS NULL, '', 'selected') AS pselct FROM ref_kamera  a  LEFT JOIN ( SELECT  autono, autocode, kamera FROM tbl_dokumen WHERE autono = $id) b ON b.`kamera` = a.`autocode` ORDER BY a.nama_kamera ASC");

        return $result;
    }

    public function get_kategori()
    {
    	$result = $this->query("SELECT autocode, nama_kategori FROM ref_kategori ORDER BY nama_kategori ASC LIMIT 50");

    	return $result;
    }

    // public function get_project()
    // {
    //     $result = $this->query("SELECT 
    //         prj.`autocode`,
    //         mp.`nama_project`
    //         FROM prj_penetapan_proyek prj
    //         JOIN m_project mp ON prj.`id_pm` = mp.`autono`
    //         GROUP BY mp.`nama_project`;");

    //     return $result;
    // }
    public function get_project()
    {
        $result = $this->query("SELECT autocode, nama_project FROM m_project 
            GROUP BY nama_project;");

        return $result;
    }

    public function get_team()
    {
        $result = $this->query("SELECT autocode, nm_pegawai FROM m_pegawai WHERE id_jabatan IS NOT NULL AND id_jabatan != 0 ORDER BY id_jabatan ASC;");

        return $result;
    }

    public function get_kondisi()
    {
        $result = $this->query("SELECT autocode, nama_kondisi FROM ref_kondisi ORDER BY nama_kondisi ASC");

        return $result;
    }

    public function get_kondisiedit($id)
    {
        $result = $this->query("SELECT a.autocode, a.`nama_kondisi`, IF(b.autocode IS NULL, '', 'selected') AS pselct FROM ref_kondisi  a  LEFT JOIN ( SELECT  autono, autocode, kondisi_media FROM tbl_dokumen WHERE autono = $id) b ON b.`kondisi_media` = a.`autocode` ORDER BY a.nama_kondisi ASC LIMIT 50");

        return $result;
    }

    public function get_personel()
    {
    	$result = $this->query("SELECT autocode, nama_personel FROM ref_personel ORDER BY nama_personel ASC LIMIT 50");

    	return $result;
    }

    public function get_personeledit($id)
    {
    	$result = $this->query("SELECT a.autocode, a.`nama_personel`, IF(b.kd_personel IS NULL, '', 'selected') AS pselct FROM ref_personel a   LEFT JOIN ( SELECT  parent_id, parent_autocode, kd_personel FROM tbl_dokumen_personel WHERE parent_id = $id) b ON b.`kd_personel` = a.`autocode` LIMIT 50");

    	return $result;
    }

    public function get_fotografer()
    {
        $result = $this->query("SELECT autocode, nama_personel FROM ref_fotografer ORDER BY nama_personel ASC");

        return $result;
    }

    public function get_fotograferedit($id)
    {
        $result = $this->query("SELECT a.autocode, a.`nama_personel`, IF(b.kd_personel IS NULL, '', 'selected') AS pselct FROM ref_fotografer a  LEFT JOIN ( SELECT  parent_id, parent_autocode, kd_personel FROM tbl_dokumen_fotografer WHERE parent_id = $id) b ON b.`kd_personel` = a.`autocode` ORDER BY nama_personel");

        return $result;
    }


    public function get_satker()
    {
    	$result = $this->query("SELECT autocode, nama_satker FROM ref_satker ORDER BY nama_satker ASC LIMIT 50");

    	return $result;
    }

    public function get_satkeredit($id)
    {
    	$result = $this->query("SELECT a.autocode, a.`nama_satker`, IF(b.kd_satker IS NULL, '', 'selected') AS pselct FROM ref_satker  a  LEFT JOIN ( SELECT  parent_id, parent_autocode, kd_satker FROM tbl_dokumen_satker WHERE parent_id = $id) b ON b.`kd_satker` = a.`autocode` LIMIT 50");

    	return $result;
    }

    public function get_kategoriedit($id)
    {
    	$result = $this->query("SELECT a.autocode, a.`nama_kategori`, IF(b.kd_kategori IS NULL, '', 'selected') AS pselct FROM ref_kategori  a LEFT JOIN ( SELECT  parent_id, parent_autocode, kd_kategori FROM tbl_dokumen_kategori WHERE parent_id = $id) b ON b.`kd_kategori` = a.`autocode` LIMIT 50");

    	return $result;
    }

    public function get_teamedit($id)
    {
    	$result = $this->query("SELECT
            a.autocode,
            a.`nm_pegawai`,
            IF (
                b.kd_pegawai IS NULL,
                '',
                'selected'
            ) AS pselct
            FROM
            m_pegawai a
            LEFT JOIN
                (SELECT
                parent_id,
                parent_autocode,
                kd_pegawai
                FROM
                tbl_dokumen_team
                WHERE parent_id = $id) b
                ON b.`kd_pegawai` = a.`autocode`
            WHERE id_jabatan IS NOT NULL AND id_jabatan != 0 ORDER BY id_jabatan ASC");

    	return $result;
    }


    public function get_media()
    {
    	$result = $this->query("SELECT autocode, nama_media FROM ref_media ORDER BY nama_media ASC");

    	return $result;
    }

    public function get_mediaedit($id)
    {
    	$result = $this->query("SELECT a.autocode, a.`nama_media`, IF(b.autocode IS NULL, '', 'selected') AS pselct FROM ref_media  a  LEFT JOIN ( SELECT  autono, autocode, jenis_media FROM tbl_dokumen WHERE autono = $id) b ON b.`jenis_media` = a.`autocode`  ORDER BY a.nama_media ASC");

    	return $result;
    }
    public function get_projectedit($id)
    {
    	$result = $this->query("SELECT
  mp.autocode,
  mp.`nama_project`,
  IF (b.autocode IS NULL, '', 'selected') AS pselct
FROM
  m_project mp 
  LEFT JOIN
    (SELECT
      autono,
      autocode,
      project
    FROM
      tbl_dokumen
    WHERE autono = $id) b
    ON b.`project` = mp.`autocode`
GROUP BY mp.`nama_project`
ORDER BY mp.`nama_project` ASC");

    	return $result;
    }
//     public function get_projectedit($id)
//     {
//     	$result = $this->query("SELECT
//   prj.autocode,
//   mp.`nama_project`,
//   IF (b.autocode IS NULL, '', 'selected') AS pselct
// FROM
//   prj_penetapan_proyek prj JOIN m_project mp ON prj.`id_pm` = mp.`autono`
//   LEFT JOIN
//     (SELECT
//       autono,
//       autocode,
//       project
//     FROM
//       tbl_dokumen
//     WHERE autono = $id) b
//     ON b.`project` = prj.`autocode`
// GROUP BY mp.`nama_project`
// ORDER BY mp.`nama_project` ASC");

//     	return $result;
//     }

    public function get_provinsi()
    {
        $items = array();
        $provinsi = $this->execute("SELECT kd_prov, provinsi FROM tbl_wilayah GROUP BY kd_prov ORDER BY kd_prov ASC");
        while ($row = $this->fetch_assoc($provinsi)) {
            $data['kd_prov'] = $row['kd_prov'];
            $data['provinsi'] = $row['provinsi'];
            $data['kabupaten'] = array();

            $kota = $this->execute("SELECT kode, kd_kab, kabupaten FROM tbl_wilayah WHERE kd_prov = '".$row ['kd_prov']."' GROUP BY kd_kab ORDER BY kabupaten ASC");
            while ($rows = $this->fetch_assoc($kota)) {
                array_push($data['kabupaten'], $rows);
            }
            array_push($items, $data);
        }

        return $items;
    }


    public function get_provinsiedit($id)
    {
        $items = array();
        $provinsi = $this->execute("SELECT kd_prov, provinsi FROM tbl_wilayah GROUP BY kd_prov ORDER BY kd_prov ASC");
        while ($row = $this->fetch_assoc($provinsi)) {
            $data['kd_prov'] = $row['kd_prov'];
            $data['provinsi'] = $row['provinsi'];
            $data['kabupaten'] = array();

            $kota = $this->execute("SELECT a.kode, a.`kabupaten`, IF(b.kode IS NULL, '', 'selected') AS pselct FROM tbl_wilayah  a  LEFT JOIN ( SELECT  autono, parent_id, kode FROM tbl_dokumen_wilayah WHERE parent_id = $id) b ON b.`kode` = a.`kode` WHERE a.`kd_prov` = ".$row['kd_prov']." GROUP BY a.kabupaten ORDER BY a.kabupaten ASC");
            while ($rows = $this->fetch_assoc($kota)) {
                array_push($data['kabupaten'], $rows);
            }
            array_push($items, $data);
        }

        return $items;
    }

     public function get_file_attachment($id)
    {
        $result = $this->query("SELECT * FROM vt_files WHERE parent_id = $id ");

        return $result;
    }

    public function mgetfoto ( $request, $table, $primaryKey, $columns)

    {

        $bindings = array();

        $db = $this->connection;



        $limit = self::limit( $request, $columns );

        $order = self::order( $request, $columns );

        $where = self::filters( $request, $columns, $bindings, true );

        $sWhere = "WHERE nama_file IS NOT NULL";

        $sJoin  = "LEFT JOIN ( SELECT parent_id, nama_file FROM vt_files WHERE tipe_file LIKE '%image%' GROUP BY parent_id) AS vt_files ON tbl_dokumen.`autono` = vt_files.`parent_id` 
        LEFT JOIN
            (SELECT 
            autocode AS autocode_m_project,
            nama_project
            FROM m_project) AS m_project
            ON tbl_dokumen.`project` = m_project.`autocode_m_project`";


        $data = $this->query(

            "SELECT `".implode("`, `", $this->pluck($columns, 'db'))."`

             FROM `$table`

             $sJoin

             $sWhere

             $where

             $order

             $limit"

        );



        $resFilterLength = $this->query(

            "SELECT COUNT(`{$primaryKey}`)

             FROM   `$table` $sJoin

             $sWhere $where"

        );



        $recordsFiltered = $resFilterLength[0][0];



        $resTotalLength = $this->query(

            "SELECT COUNT(`{$primaryKey}`)

             FROM   `$table` $sJoin $sWhere"

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


}