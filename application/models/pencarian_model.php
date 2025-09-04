<?php

class Pencarian_model extends Model {

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

	public function get($table, $primaryKey, $id)
	{
		$result = $this->query("SELECT * FROM $table WHERE $primaryKey = '$id'");
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

	public function get_history()
	{
		$result = $this->query("SELECT autono, keywords FROM ref_keywords GROUP BY keywords ORDER BY autono DESC LIMIT 12");
		return $result;
	}

    public function get_kategori()

	{
		$result = $this->query("SELECT autocode, nama_kategori FROM ref_kategori ORDER BY nama_kategori ASC");
		return $result;
	}

	public function get_personel()

	{
		$result = $this->query("SELECT autocode, nama_personel,nrp FROM ref_personel ORDER BY nama_personel ASC");
		return $result;
	}

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

     public function get_media()
    {
    	$result = $this->query("SELECT autocode, nama_media FROM ref_media ORDER BY nama_media ASC");

    	return $result;
    }

    public function get_kondisi()
    {
        $result = $this->query("SELECT autocode, nama_kondisi FROM ref_kondisi ORDER BY nama_kondisi ASC");

        return $result;
    }


}