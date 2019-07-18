<?php


/**
 * 
 */
class User extends CI_Model
{
	
	// function __construct(argument)
	// {
	// 	# code...
	// }

	function register($data){
		$new = array(
			'userId' => date('Y').uniqid(),
			'nama' => $data['nama'],
			'sex' => $data['sex'],
			'status' => 'F',
			'username' => $data['username'],
			'password' => $data['password']
			 );
		$this->db->insert('usertask', $new);
		redirect(base_url());
	}
}