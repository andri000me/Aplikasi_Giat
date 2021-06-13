<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_Customer');
		$this->load->model('ModelDaftar');
		$this->load->model('UserModel');
		$this->load->helper('form');
		$this->load->library('upload');
	}


	public function index()
	{
		$nama = $this->session->username;

		if($nama == null)
		{
			echo "<script type='text/javascript'>
                    alert ('Anda Harus Login Terlebih Dahulu');
                    window.location.href='http://localhost/panenpangan/Login';
                    </script>";
		} else {

			$id_pesan = $this->UserModel->getKodePesan();
			$nama = $this->session->nm_plg;
			$username = $this->session->username;
			$getNm_Plg = $this->ModelDaftar->getNm_Plg($username);
			$history = $this->M_Customer->history($username);
			$point = $this->M_Customer->getPoint($username);

			$data = [
				'id_pesan' => $id_pesan,
				'getNm_Plg' => $getNm_Plg,
				'nama'=> $nama,
				'history' => $history,
				'point' => $point
			];

			$this->load->view('master/header',$data);
			$this->load->view('view_history',$data);
			$this->load->view('master/footer');
		}
	}
}