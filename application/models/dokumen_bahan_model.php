<?php



class Dokumen_bahan_model extends Model {



	public function mget($request, $table, $primaryKey, $columns)

	{

		$result = $this->mgetbahan($request, $table, $primaryKey, $columns);

		return $result;

	}

	public function createpaging( $q1, $q2, $total, $limit, $page ) 
    {

        $links      = 12;
     
        $last       = ceil( $total / $limit );
     
        $start      = ( ( $page - $links ) > 0 ) ? $page - $links : 1;
        $end        = ( ( $page + $links ) < $last ) ? $page + $links : $last;
     
        $html       = "<ul class=\"pagination pagination-flat pagination-xs no-margin-bottom\">"; 
     
        $class      = ( $page == 1 ) ? "disabled" : "";
        $html       .= '<li class="' . $class . '"><a href="'.BASE_URL.'dokumen_bahan/infos/?q1=' . $q1 . '&q2='. $q2 .'&page=' . ( $page - 1 ) . '">&laquo;</a></li>';
     
        if ( $start > 1 ) {
            $html   .= '<li><a href="'.BASE_URL.'dokumen_bahan/infos/?q1=' . $q1 . '&page=1">1</a></li>';
            $html   .= '<li class="disabled"><span>...</span></li>';
        }
     
        for ( $i = $start ; $i <= $end; $i++ ) {
            $class  = ( $page == $i ) ? "active" : "";
            $html   .= '<li class="' . $class . '"><a href="'.BASE_URL.'dokumen_bahan/infos/?q1=' . $q1 . '&q2='. $q2 . '&page=' . $i . '">' . $i . '</a></li>';
        }
     
        if ( $end < $last ) {
            $html   .= '<li class="disabled"><span>...</span></li>';
            $html   .= '<li><a href="'.BASE_URL.'dokumen_bahan/infos/?q1=' . $q1 . '&q2='. $q2 . '&page=' . $last . '">' . $last . '</a></li>';
        }
     
        $class      = ( $page == $last ) ? "disabled" : "";
        $html       .= '<li class="' . $class . '"><a href="'.BASE_URL.'dokumen_bahan/infos/?q1=' . $q1 . '&q2='. $q2 . '&page=' . ( $page + 1 ) . '">&raquo;</a></li>';
     
        $html       .= '</ul>';
     
        return $html;
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


     public function get_file_attachment($tgl, $keg)
    {
        $result = $this->query("SELECT * FROM vt_files_storage WHERE tanggal = '$tgl' AND nama_kegiatan LIKE '%".$keg."%'  ORDER BY SUBSTRING_INDEX(nama_file, '.', -1)");

        return $result;
    }

    public function mgetbahan ( $request, $table, $primaryKey, $columns)

    {

        $bindings = array();

        $db = $this->connection;



        $limit = self::limit( $request, $columns );

        $order = self::order( $request, $columns );

        $where = self::filters( $request, $columns, $bindings, true );

        $sWhere = "WHERE tanggal IS NOT NULL";


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

             FROM   `$table` $sWhere " 

        );

       $recordsTotal = $resTotalLength[0][0];
         //$recordsTotal = $this->num_rows($resTotalLength[0][0]);



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

            $where = ' AND '.$where;

        }



        return $where;

    }


}