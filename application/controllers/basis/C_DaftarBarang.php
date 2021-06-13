<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_DaftarBarang extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
        $this->load->model('BarangModel');
		$this->load->model('UserModel');
		$this->load->model('ModelDaftar');
		$this->load->helper('form');
		$this->load->library('upload');
		error_reporting(0);
	}

	public function index()
	{

		$getBarang = $this->BarangModel->getBarang();
		$semuaBarang = $this->BarangModel->getAllBarang();
		$semuaKategori = $this->BarangModel->getAllKategori();
		$username = $this->session->username;
		$getNm_Plg = $this->ModelDaftar->getNm_Plg($username);
		$data['getBarang'] = $getBarang;
		$data['dataKategori'] = $semuaKategori;
		$data['dataBarang'] = $semuaBarang;
		$data['getNm_Plg'] = $getNm_Plg;
		$data['id_brg'] = $this->BarangModel->getKodeBarang();

        $this->load->view('master/header');
        $this->load->view('view_about',$data);
        $this->load->view('master/footer');
        
    }
        
    public function sort($id)
    {
    	$nama = $this->session->nm_plg;
    	$username = $this->session->username;
		$getNm_Plg = $this->ModelDaftar->getNm_Plg($username);

		$semuaKategori = $this->BarangModel->getAllKategori();
		$data['dataKategori'] = $semuaKategori;
		$data['dataBarang'] = $this->BarangModel->getSort($id);
        $data['nama'] = $nama;
        $data['getNm_Plg'] = $getNm_Plg;
        $data['id_pesan'] = $this->UserModel->getKodePesan();

        $this->load->view('master/header',$data);
       	$this->load->view('view_about',$data);
       	$this->load->view('master/footer');
	}
	///////////searching////////////////////
	function get_autocomplete(){
		if (isset($_GET['term'])) {
		  	$result = $this->BarangModel->search_blog($_GET['term']);
		   	if (count($result) > 0) {
		    foreach ($result as $row)
		     	$arr_result[] = array(
					'label'	=> $row->nm_brg,
				);
		     	echo json_encode($arr_result);
		   	}
		}
	}
    ///////////searching////////////////////
}