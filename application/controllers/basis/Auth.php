<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_Customer');
	}

	public function index()
	{
		$username = $this->session->username;

		if($username != null){
			redirect('Home');
		} 

		$this->load->view('Home');
	}

	public function auth()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$checkUsername = $this->ModelBuku->readUsername($username,$password);

		if($checkUsername==NULL){

			echo "<script type='text/javascript'>
               alert ('Maaf Username Dan Password Anda Salah !');
               window.location.replace('index');
      			</script>";

		}else{
			$newdata = array(
				'username'  => $checkUsername->username,
				'name'  => $checkUsername->nama,
				'email'  => $checkUsername->email
			  );
			//set seassion
			$this->session->set_userdata($newdata);
			redirect('Home');
		}
	}

function logout(){
	$this->session->sess_destroy();
	redirect('Login');
}


}
