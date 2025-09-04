<?php

class Auth_model extends Model {
	
	public function check($username, $password, $security_key)
	{
		$pass = $this->passencrpyt($password,$security_key);
		$result = $this->query("SELECT * FROM tuser WHERE user_id = '". $username ."' AND user_password = '$pass'");
		return $result;
	}

	public function passencrpyt($pass, $key)
	{
		$pass = sha1(md5($pass.$key));
		error_log("pass : " . $pass);
		return $pass;
	}

	public function sign($id)
	{
		echo "Sign in";
	}

}
