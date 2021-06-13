<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LihatKategori extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('BarangModel');
		$this->load->helper('form');
		$this->load->library('upload');
	}

	public function index()
	{

		$getBarang = $this->BarangModel->getBarang();
		$semuaBarang = $this->BarangModel->getAllBarang();
		$semuaKategori = $this->BarangModel->getAllKategori();
		$data['getBarang'] = $getBarang;
		$data['dataKategori'] = $semuaKategori;
		$data['dataBarang'] = $semuaBarang;
		$data['id_brg'] = $this->BarangModel->getKodeBarang();

		$barang =$this->session->barang;
		$data['barang'] = $barang;

			$this->load->view('view_kategori',$data);

		}
}