<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking extends CI_Controller {

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

			$username = $this->session->username;
			$getNm_Plg = $this->ModelDaftar->getNm_Plg($username);
			$nama = $this->session->nm_plg;
			$pesan = $this->UserModel->getKodePesan();
			$point = $this->M_Customer->getPoint($username);
			$data = [
				'point' => $point,
				'getNm_Plg'=> $getNm_Plg,
				'id_pesan' => $pesan,
				'nama' => $nama
			];

			$this->load->view('master/header',$data);
			$this->load->view('view_tracking');
			$this->load->view('master/footer');
		}
	}

	public function daftar()
	{
		$this->load->view('master/header');
		$this->load->view('view_daftar');
		$this->load->view('master/footer');
	}

	public function cari()
	{
		$username = $this->session->username;
		$nama = $this->session->nm_plg;
		$getNm_Plg = $this->ModelDaftar->getNm_Plg($username);
		$id_transaksi = $this->input->get('no_transaksi');
		$pesan = $this->UserModel->getKodePesan();
		$cari = $this->M_Customer->getTracking($id_transaksi,$username);
		$point = $this->M_Customer->getPoint($username);

		$status = $cari;
		$data = [
			'getNm_Plg' => $getNm_Plg,
			'id_pesan' => $pesan,
			'nama' => $nama,
			'id_transaksi' => $cari,
			'point' => $point
		];

		if($status == null) {
			$notFound = "Data Tidak Ditemukan";
			$data2 = [
				'id_pesan' => $pesan,
				'getNm_Plg' => $getNm_Plg,
				'nama' => $nama,
				'id_pesan' => $pesan,
				'id_transaksi' => $cari,
				'point' => $point,
				'notFound'=> $notFound
			];

			$this->load->view('master/header',$data2);
			$this->load->view('view_tracking',$data2);
			$this->load->view('master/footer');
		} else {
			$this->load->view('master/header',$data);
			$this->load->view('view_tracking',$data);
			$this->load->view('master/footer');
		}
	}

	public function konfirmasi($konfirmasi)
	{
		$nama = $this->session->nm_plg;
		$pesan = $this->UserModel->getKodePesan();
		$status = 2;

		$update = [
			'status' => $status
		];

		$username = $this->session->username;
		$getNm_Plg = $this->ModelDaftar->getNm_Plg($username);
		$result = $this->M_Customer->status($konfirmasi,$update);
		$cari = $this->M_Customer->getTracking($konfirmasi,$username);
		$point = $this->M_Customer->getPoint($username);

		$data = [
			'id_pesan' => $pesan,
			'getNm_Plg' => $getNm_Plg,
			'nama'=> $nama,
			'id_transaksi' => $cari,
			'point' => $point
		];

		$this->load->view('master/header',$data);
		$this->load->view('view_tracking',$data);
		$this->load->view('master/footer');
	}





}