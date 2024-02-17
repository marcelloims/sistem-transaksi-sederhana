<?php

class LoginModel extends CI_Model
{
	public function loginAction($email, $password)
	{
		$query = $this->db->where([
			'email' 	=> $email,
			'password'	=> $password
		])->get('users');

		return $query;
	}
}
