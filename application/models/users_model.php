<?php

class Users_model extends Model {

	public function mget($request, $table, $primaryKey, $columns)
	{
		$result = $this->simple($request, $table, $primaryKey, $columns);
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

    public function show_office()
	{

		$result    = $this->execute("SELECT autono as id, nama_jabatan as title, parent_id, keterangan  FROM torganizationstructure");

		return $result;
	}

	public function show_parent($id)
	{

		$result    = $this->execute("SELECT GROUP_CONCAT(autono) AS id, parent_id FROM torganizationstructure WHERE parent_id = $id");

		return $result;
	}


}
