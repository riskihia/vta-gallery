<?php

class Users_profil_model extends Model {

	public function mget($request, $table, $primaryKey, $columns)
	{
		$result = $this->simple($request, $table, $primaryKey, $columns);
		return $result;
	}

	public function get($table)
	{
		$result = $this->query("SELECT * FROM $table WHERE user_id = '".$_SESSION['userid']."'");
		return $result;
	}

	function getphoto(){
		$result = $this->query("SELECT foto, cover FROM tuser WHERE user_id = '".$_SESSION['userid']."'");
        return $result;
	}

	function getgroups(){
		$result = $this->query("SELECT autono, group_name FROM tusergroup");
        return $result;
	}

	function getposition(){
		$result = $this->query("SELECT autono, nama_jabatan FROM torganizationstructure");
        return $result;
	}

	public function msave($table, $data = array(), $title)
	{
		$result = $this->sqlinsert($table, $data, $title);
		return $result;
	}

	public function savefile($data = array())
	{
		$result = $this->sqlinsert('vt_files', $data, 'Foto profil');
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

    public function checkuser($username, $password, $security_key)
	{
		$pass = $this->passencrpyts($password,$security_key);
		$result = $this->query("SELECT * FROM tuser WHERE user_id = '". $username ."' AND user_password = '$pass'");
		return $result;
	}

	public function passencrpyts($pass, $key)
	{
		$pass = sha1(md5($pass.$key));

		return $pass;
	}


}
