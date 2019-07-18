<?php

/**
 * 
 */
class Task_user extends CI_Model
{
	public $name;
	public $username;
	public $password;
	public $sex;
	public $status;
	// function __construct()
	// {
	// 	# code...
	// }

	public function numstask(){
		$query = $this->db->get('task');
		return $query->num_rows();
	}

	public function login($data){
		$this->load->library('session');
		$array = array(
			'username' => $data['username'],
			'password' => $data['password']
		 );
		$query = $this->db->get_where('usertask', $array);
		if($query->num_rows() >= 1){
            
			foreach ($query->result() as $row) {
				//insert data
				$this->db->where('userID', $row->userID);
		    	$this->db->update('usertask',  array('status' => 'T'));
		    	//array buat session
				$newdata = array(
			        'userid'	=> $row->userID,
			        'nama'     	=> $row->nama,
			        'access'	=> $row->access
				);
			}
			//buat session
			$this->session->set_userdata($newdata);
			redirect(base_url().'index.php/home/dashboard');
		}else{
			//echo "<script>alert('test');</script>";
			redirect(base_url());
		}
	}

	public function tampil()
	{	
		//$this->db->select('title, content, date');
		if($this->session->userdata('access')== 'root')
		{
			$this->db->select('*');
			$this->db->from('metask');
			$this->db->join('task', 'task.metaskID = metask.metaskID');
			$this->db->join('usertask', 'usertask.userID = metask.userID');
			//$this->db->where('metask.publish', 'T');
			$this->db->group_by('metask.metaskID', 'DESC');
	   }elseif($this->session->userdata('access')== 'admin')
		{
			$this->db->select('*');
			$this->db->from('metask');
			$this->db->join('task', 'task.metaskID = metask.metaskID');
			$this->db->join('usertask', 'usertask.userID = metask.userID');
			$this->db->where('metask.publish', 'T');
			$this->db->group_by('metask.metaskID', 'DESC');
	   }else{
	   	    $this->db->select('*');
			$this->db->from('metask');
			$this->db->join('task', 'task.metaskID = metask.metaskID');
			$this->db->join('usertask', 'usertask.userID = metask.userID');
			$this->db->where('metask.publish', 'T');
			$this->db->where('metask.dikerjakan', $this->session->userdata('userid'));
			$this->db->group_by('metask.metaskID', 'DESC');
	   }
		$query = $this->db->get();

		//$query = $this->db->get('task');
		return $query->result();
	}

	public function tampil_cemua()
	{	
		//$this->db->select('title, content, date');
		if($this->session->userdata('access')== 'root')
		{
			$this->db->select('*');
			$this->db->from('metask');
			$this->db->join('task', 'task.metaskID = metask.metaskID');
			$this->db->join('usertask', 'usertask.userID = metask.userID');
			//$this->db->where('metask.publish', 'T');
			$this->db->group_by('metask.metaskID', 'DESC');
	   }else
		{
			$this->db->select('*');
			$this->db->from('metask');
			$this->db->join('task', 'task.metaskID = metask.metaskID');
			$this->db->join('usertask', 'usertask.userID = metask.userID');
			$this->db->where('metask.publish', 'T');
			$this->db->group_by('metask.metaskID', 'DESC');
	   }
		$query = $this->db->get();

		//$query = $this->db->get('task');
		return $query->result();
	}

	public function tambah($data)
	{
		$array = array(
			'taskID' 	=> $data['taskID'],
			'metaskID' 	=> $data['metaskID'],
			'jenis' 	=> $data['jenis'],
			'nama' 		=> $data['nama'],
			'rincian' 	=> $data['rincian'],
			'start' 	=> $data['start'],
			'finish' 	=> $data['finish'],
			'image' 	=> $data['image']
		);
		$array2 = array(
			'metaskID' 	=> $data['metaskID'],
			'userID'	=> $data['userID']
		);
		$this->db->insert('task', $array);
		$this->db->insert('metask', $array2);
		redirect(base_url().'index.php/home/task');
	}

	public function getID($id){
		$this->db->where('metaskID', $id);
		return $this->db->get('task')->result();
	}

	public function getStatus($id){
		$this->db->select('metask.statustask, metask.metaskID');
		$this->db->from('metask');
		$this->db->where('metask.publish', 'T');
		$this->db->where('metask.metaskID', $id);
		$this->db->group_by('metask.metaskID', 'DESC');
		return $this->db->get()->result();
	}

	public function Detail_getID_M($id){
		$array = array('metaskID' => $id, 'status' => 'M');
		$this->db->where($array);
		return $this->db->get('task')->result();
	}

	public function Detail_getID_P($id){
		$this->db->where( array('metaskID' => $id, 'status' => 'P'));
		return $this->db->get('task')->result();
	}

	public function Detail_getID_S($id){
		$this->db->where( array('metaskID' => $id, 'status' => 'S'));
		return $this->db->get('task')->result();
	}

	public function updat($data){
		$id = $data['taskID'];
		
		$file = $data['image'];
		if(empty($file) && empty($data['start']) && empty($data['finish'])){
			$array = array(
			'jenis'		=> $data['jenis'],
			'nama' 		=> $data['nama'],
			'rincian' 	=> $data['rincian'],
			'status' 	=> $data['status']
		);
		}elseif(empty($file) && empty($data['start'])){
			$array = array(
			'jenis'		=> $data['jenis'],
			'nama' 		=> $data['nama'],
			'rincian' 	=> $data['rincian'],
			'finish' 	=> $data['finish'],
			'status' 	=> $data['status']
		);
		}elseif(empty($file) && empty($data['finish'])){
			$array = array(
			'jenis'		=> $data['jenis'],
			'nama' 		=> $data['nama'],
			'rincian' 	=> $data['rincian'],
			'start' 	=> $data['start'],
			'status' 	=> $data['status']
		);
		}elseif(empty($data['start']) && empty($data['finish'])){
			$array = array(
			'jenis'		=> $data['jenis'],
			'nama' 		=> $data['nama'],
			'rincian' 	=> $data['rincian'],
			'image' 	=> $data['image'],
			'status' 	=> $data['status']
		);
		}elseif(empty($data['start'])){
			$array = array(
			'jenis'		=> $data['jenis'],
			'nama' 		=> $data['nama'],
			'rincian' 	=> $data['rincian'],
			'finish' 	=> $data['finish'],
			'image' 	=> $data['image'],
			'status' 	=> $data['status']
		);
		}elseif(empty($data['finish'])){
			$array = array(
			'jenis'		=> $data['jenis'],
			'nama' 		=> $data['nama'],
			'rincian' 	=> $data['rincian'],
			'start' 	=> $data['start'],
			'image' 	=> $data['image'],
			'status' 	=> $data['status']
		);
		}else{
			$array = array(
			'jenis' 	=> $data['jenis'],
			'nama' 		=> $data['nama'],
			'rincian' 	=> $data['rincian'],
			'start' 	=> $data['start'],
			'finish' 	=> $data['finish'],
			'image' 	=> $data['image'],
			'status' 	=> $data['status']
		);
		}
		
		$this->db->where('taskID', $id);
		$this->db->update('task', $array);
		redirect(base_url().'index.php/home/task');
	}


	public function delet($id)
	{
		$id = $id['taskID'];
		
		$query = $this->db->get_where('task', array('metaskID' => $id ));
		foreach ($query->result() as $key) {
			$path = $key->image;
		}
		unlink($path);
		$this->db->where('metaskID', $id);
		$this->db->delete('metask');

		$this->db->where('metaskID', $id);
		$this->db->delete('task');
	
		redirect(base_url().'index.php/home/task');
	}


}