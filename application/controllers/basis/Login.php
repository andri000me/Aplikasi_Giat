<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_Login');
		$this->load->model('ModelAdmin');
	}


	public function index()
	{
		$this->load->view('view_login');
	}

	public function admin()
	{
		$this->load->view('admin/loginadmin');
	}

	public function auth()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$checkUsername = $this->ModelAdmin->readUsername($username,$password);

		if($checkUsername==NULL){

			echo "<script type='text/javascript'>
               alert ('Maaf Username Dan Password Anda Salah !');
               window.location.replace('admin');
      			</script>";

		}else{
			$newdata = array(
				'username'  => $checkUsername->username,
				'nm_plg'  => $checkUsername->nm_plg
			  );
			//set seassion
			$this->session->set_userdata($newdata);
			$this->session->set_userdata('status_admin','status_admin');
			redirect('admin');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('admin');
	}


	public function authCustomer()
	{
		$username = $this->input->post('email');
		$password = $this->input->post('password');

		$checkUsername = $this->M_Login->readUsername2($username,$password);

		if($checkUsername==NULL){

			echo "<script type='text/javascript'>
               alert ('Maaf Email Dan Password Anda Salah !');
               window.location.replace('index');
      			</script>";

		}else{
			$newdata = array(
				'username'  => $checkUsername->username,
				'nm_plg'  => $checkUsername->nm_plg,
				'email' => $checkUsername->email
			  );
			//set seassion
			$this->session->set_userdata($newdata);
			redirect('Home');
		}
	}

	public function logoutCustomer()
	{
		$this->session->sess_destroy();
		redirect('Home');
	}


}
