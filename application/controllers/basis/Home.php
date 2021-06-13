<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		// $this->load->model('BarangModel');
		$this->load->helper('form');
		$this->load->library('upload');
	}

	public function index()
	{
		// $nama = $this->session->nm_plg;
		// $username = $this->session->username;

		// $point = $this->M_Customer->getPoint($username);
		// $kdpesan = $this->UserModel->getKodePesan();
		// $semuaKategori = $this->BarangModel->getAllKategori();
		// $getNm_Plg = $this->ModelDaftar->getNm_Plg($username);
		// $best =$this->BarangModel->bestseller();
		
		// $data = [
		// 	'getNm_Plg' => $getNm_Plg,
		// 	'point' => $point,
		// 	'best' => $best,
		// 	'id_pesan' => $kdpesan,
		// 	'dataKategori' => $semuaKategori,
		// 	'nama' => $nama
		// ];
		
		// $this->load->view('master/header',$data);
		// $this->load->view('index',$data);
		// $this->load->view('view_iklan');
		$this->load->view('index');
	}

	public function daftar()
	{	
		$nama = $this->session->nm_plg;
		$kdpesan = $this->UserModel->getKodePesan();
		$username = $this->session->username;
		$getNm_Plg = $this->ModelDaftar->getNm_Plg($username);
		$nama = $this->session->nm_plg;
		$data = [
			'id_pesan' => $kdpesan,
			'nama' => $nama,
			'getNm_Plg' => $getNm_Plg
		];
		$this->load->view('master/header',$data);
		$this->load->view('view_daftar');
		$this->load->view('master/footer');
	}

	public function tracking()
	{
		$this->load->view('view_tracking');
	}

	public function about()
	{
		$this->load->view('master/header');
		$this->load->view('view_bayar');
		$this->load->view('master/footer');
	}

	function search(){

		$nama = $this->session->nm_plg;
		$kdpesan = $this->UserModel->getKodePesan();
		$username = $this->session->username;
		$getNm_Plg = $this->ModelDaftar->getNm_Plg($username);
		$point = $this->M_Customer->getPoint($username);

		$data = [
			'id_pesan' => $kdpesan,
			'nama' => $nama,
			'point' => $point,
			'getNm_Plg' => $getNm_Plg
		];

		$title=$this->input->get('title');
		$data['dataBarang']=$this->BarangModel->search_blog($title);
		$data['id_pesan'] = $this->UserModel->getKodePesan();

		$semuaKategori = $this->BarangModel->getAllKategori();
		$data['dataKategori'] = $semuaKategori;
	
		
		$this->load->view('master/header', $data);
        $this->load->view('view_about',$data);
        $this->load->view('master/footer');
	}
}
