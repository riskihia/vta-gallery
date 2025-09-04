<?php

class User_groups_model extends Model {

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

    public function show_groups()
	{

		$result    = $this->execute("SELECT autono as id, group_name as title, parent_id, description FROM tusergroup");

		return $result;
	}

	public function get_groups($id, $status = false)
	{
		if($status){
			$sWhere = "WHERE autono = $id";
		}
		
		$result    = $this->query("SELECT autono, group_name, if(autono = $id, 'selected', '') as pselect FROM tusergroup $sWhere");

		return $result;
	}

	public function show_menu_admin($group_id = null)
	{
		global $config;
		$kode_apps = $config['app_code'];
		$result    = $this->execute("SELECT a.`menu_id` AS id, a.`menu_name` AS title, a.`parent_id`, a.`linkto` AS url, a.`menu_icon` AS icons, b.`group_id`, IF(b.`permission_a` = 1, true,false) AS permission_a FROM tmenu a LEFT JOIN ( SELECT group_id, menu_id, permission_a FROM tusermenu WHERE group_id = $group_id) AS b ON a.`menu_id` = b.`menu_id` WHERE a.`kode_apps` IN ('0', '$kode_apps') ORDER BY a.`menu_id`");

		return $result;
	}


}
