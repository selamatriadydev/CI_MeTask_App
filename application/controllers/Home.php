<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Task_user');
		$this->load->model('user');
		$this->load->helper(array('form', 'url'));
		
	}

	public function daftar(){
		$this->load->view('daftar');
	}

	public function regx(){
		$post = $this->input->post();
		$data['nama'] = $post['nama'];
		$data['sex'] = $post['sex'];
		$data['username'] = $post['username'];
		$data['password'] = $post['password'];
		$this->user->register($data);
	}
	public function index()
	{
		$this->load->view('login');
	}

	public function loginx(){
		$post = $this->input->post();
		$data['username'] = $post['username'];
		$data['password'] = $post['password'];
		$this->Task_user->login($data);
	}

	public function dashboard()
	{   
		if(empty($this->session->userdata('userid'))){
			redirect(base_url());
		}
		$data['session_userid'] = $this->session->userdata('userid');
	    $datax['session_nama'] = $this->session->userdata('nama');
		$data['tasknums'] = $this->Task_user->numstask();
		$this->load->view('header/head');
		$this->load->view('metask/header', $datax);
		$this->load->view('metask/sidebar');
		$this->load->view('metask/home', $data);
		$this->load->view('footer/footer');
	}

	public function task()
	{   
		$data['data'] = $this->Task_user->tampil();
		$datax['session_nama'] = $this->session->userdata('nama');
		$this->load->view('header/head');
		$this->load->view('metask/header', $datax);
		$this->load->view('metask/sidebar');
		$this->load->view('metask/task', $data);
		$this->load->view('footer/footer');
	}

	public function alltask()
	{   
		$data['data'] = $this->Task_user->tampil_cemua();
		$datax['session_nama'] = $this->session->userdata('nama');
		$this->load->view('header/head');
		$this->load->view('metask/header', $datax);
		$this->load->view('metask/sidebar');
		$this->load->view('metask/all_task', $data);
		$this->load->view('footer/footer');
	}

	public function detail($id)
	{   
		$data['status'] = $this->Task_user->getStatus($id);
		$data['M'] = $this->Task_user->Detail_getID_M($id);
		$data['P'] = $this->Task_user->Detail_getID_P($id);
		$data['S'] = $this->Task_user->Detail_getID_S($id);
		$datax['session_nama'] = $this->session->userdata('nama');
		$this->load->view('header/head');
		$this->load->view('metask/header', $datax);
		$this->load->view('metask/sidebar');
		$this->load->view('metask/detail_task', $data);
		$this->load->view('footer/footer');
	}

	public function add()
	{   //$data['sesion_userid'] = $this->session->userdata('userid');
	    $data = array(
	    	'error' => ' ',
	        'sesion_userid' => $this->session->userdata('userid')
	     );
		$datax['session_nama'] = $this->session->userdata('nama');
		$this->load->view('header/head');
		$this->load->view('metask/header', $datax);
		$this->load->view('metask/sidebar');
		$this->load->view('metask/form_task', $data);
		$this->load->view('footer/footer');
	}

	public function addpost()
	{
		$post = $this->input->post();
		//upload file
		$config['upload_path']          = './gambar/';
        $config['allowed_types']        = 'gif|jpg|png';
        // $config['max_size']             = 100;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $config['file_name'] = "file_".time().uniqid(); //nama file + fungsi time;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('image'))
        {
            $error = array('error' => $this->upload->display_errors());

            $datax['session_nama'] = $this->session->userdata('nama');
			$this->load->view('header/head');
			$this->load->view('metask/header', $datax);
			$this->load->view('metask/sidebar');
			$this->load->view('metask/form_task', $error);
			$this->load->view('footer/footer');
        }
        else
        {
           //$data1 = array('upload_data' => $this->upload->data());

            $data['taskID'] = date('Y').uniqid();
			$data['metaskID'] = date('m').uniqid();
			$data['userID'] = $post['userID'];
			$data['jenis'] = $post['jenis'];
			$data['nama'] = $post['nama'];
			$data['rincian'] = $post['rincian'];
			$data['jenis'] = $post['jenis'];
			$data['start'] = $post['start'];
			$data['finish'] = $post['finish'];
			$data['image'] = $this->upload->data('file_name');
			$this->Task_user->tambah($data);
        }
	}

	public function edit($id)
	{   
		$data = array(
	    	'error' => ' ',
	        'data' =>  $this->Task_user->getID($id)
	     );
		
		$datax['session_nama'] = $this->session->userdata('nama');
		$this->load->view('header/head');
		$this->load->view('metask/header', $datax);
		$this->load->view('metask/sidebar');
		$this->load->view('metask/form_edit_task', $data);
		$this->load->view('footer/footer');
	}

	public function editpost()
	{
		$post = $this->input->post();
		if($_FILES['image']['name'] != ''){
		//upload file
		$config['upload_path']          = './gambar/';
        $config['allowed_types']        = 'gif|jpg|png';
        // $config['max_size']             = 100;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $config['file_name'] = "file_".time().uniqid(); //nama file + fungsi time;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('image'))
        {
            $data = array(
            	'error' => $this->upload->display_errors()
            );
           echo $this->upload->display_errors();
			
        }
        else
        {

            $data['taskID'] = $post['taskID'];
			$data['jenis'] = $post['jenis'];
			$data['nama'] = $post['nama'];
			$data['rincian'] = $post['rincian'];
			$data['jenis'] = $post['jenis'];
			$data['start'] = $post['start'];
			$data['finish'] = $post['finish'];
			$data['image'] = $this->upload->data('file_name');
			$data['status'] = $post['status'];
			$this->Task_user->updat($data);
        }
	}else{
			$data['taskID'] = $post['taskID'];
			$data['jenis'] = $post['jenis'];
			$data['nama'] = $post['nama'];
			$data['rincian'] = $post['rincian'];
			$data['jenis'] = $post['jenis'];
			$data['start'] = $post['start'];
			$data['finish'] = $post['finish'];
			$data['image'] = $_FILES['image']['name'];
			$data['status'] = $post['status'];
			$this->Task_user->updat($data);
	}

		
	}

	public function hapus($id)
	{  
		$data['taskID'] = $id;
		$this->Task_user->delet($data);

	}

	public function error(){
		$datax['session_nama'] = $this->session->userdata('nama');
		$this->load->view('header/head');
		$this->load->view('metask/header', $datax);
		$this->load->view('metask/sidebar');
		$this->load->view('404');
		$this->load->view('footer/footer');
	}

	function logout()
	{
	    $user_data = $this->session->all_userdata();
	        foreach ($user_data as $key => $value) {
	            if ($key != 'session_nama' && $key != 'session_userid' && $key != 'access') {
	                $this->session->unset_userdata($key);
	            }
	        }
	    $this->session->sess_destroy();
	    redirect(base_url());
	}

	function ambil($id){
     
	}
}
