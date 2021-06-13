<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
        $this->load->model('InputModel');
        $this->load->model('M_Login');
		$this->load->helper('form');
        $this->load->library('upload');
	}

	public function index()
	{

		$this->load->view('index');

    }

    public function auth()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$checkUsername = $this->M_Login->readUsername($username,$password);

		if($checkUsername==NULL){

			echo "<script type='text/javascript'>
               alert ('Maaf Username Dan Password Anda Salah !');
               window.location.replace('login');
      			</script>";

		}else{
			$newdata = array(
				'username'  => $checkUsername->username,
                'nama'  => $checkUsername->nama,
                'jabatan' => $checkUsername->jabatan
				
			  );
			//set seassion
            $this->session->set_userdata($newdata);

			redirect('Dashboard/index');
		}
	}

    function logOut(){
        $this->session->sess_destroy();
        redirect('Dashboard/login');
    }

    public function login()
	{
        $this->load->view('login');
    }

    public function inputKaryawan()
    {
        $username = $this->session->username;
		if($username == null)
		{
			$this->session->sess_destroy();
			redirect('Dashboard/login');
		} else {
        $this->load->view('inputKaryawan');
        }
    }

    public function inputBarang()
    {
        $username = $this->session->username;
		if($username == null)
		{
			$this->session->sess_destroy();
			redirect('Dashboard/login');
		} else {
        $this->load->view('inputBarang');
        }
    }

    public function inputJadwalKerja()
    {
        $username = $this->session->username;
		if($username == null)
		{
			$this->session->sess_destroy();
			redirect('Dashboard/login');
		} else {
        $semuaKaryawan = $this->InputModel->getAllKaryawan();
        $data['dataKaryawan'] = $semuaKaryawan;
        
		$kj = $this->InputModel->getKdJadwalKerja();
        $data['dataJK'] = $kj;

        $this->load->view('inputJadwalKerja',$data);
        }
    }

    public function inputJadwalUkur()
    {
        $username = $this->session->username;
		if($username == null)
		{
			$this->session->sess_destroy();
			redirect('Dashboard/login');
		} else {
        $semuaCustomer = $this->InputModel->getAllCustomer();
        $data['dataCustomer'] = $semuaCustomer;
        $semuaKaryawan = $this->InputModel->getAllKaryawan();
        $data['dataKaryawan'] = $semuaKaryawan;

        $this->load->view('inputJadwalUkur',$data);
        }
    }

    public function inputCustomer()
    {
        $username = $this->session->username;
		if($username == null)
		{
			$this->session->sess_destroy();
			redirect('Dashboard/login');
		} else {
        $this->load->view('inputCustomer');
        }
    }

    // public function tes()
    // {
    //     $this->load->view('tes');
    // }

    public function inputTripOjek()
    {
        $username = $this->session->username;
		if($username == null)
		{
			$this->session->sess_destroy();
			redirect('Dashboard/login');
		} else {
        $semuaKaryawan = $this->InputModel->getAllKaryawan();
        $data['dataKaryawan'] = $semuaKaryawan;

        $this->load->view('inputTripOjek',$data);
        }
    }

    public function inputPenjualan()
    {
        $username = $this->session->username;
		if($username == null)
		{
			$this->session->sess_destroy();
			redirect('Dashboard/login');
		} else {
        $semuaKaryawan = $this->InputModel->getAllKaryawan();
        $data['dataKaryawan'] = $semuaKaryawan;
        $semuaCustomer = $this->InputModel->getAllCustomer();
        $data['dataCustomer'] = $semuaCustomer;
        $semuaBarang = $this->InputModel->getAllBarang();
        $data['dataBarang'] = $semuaBarang;

        $this->load->view('inputPenjualan',$data);
        }
    }

    public function tableBarang()
    {
        $username = $this->session->username;
		if($username == null)
		{
			$this->session->sess_destroy();
			redirect('Dashboard/login');
		} else {
        $semuaBarang = $this->InputModel->getAllBarang();
        $data['dataBarang'] = $semuaBarang;

        $this->load->view('tableBarang',$data);
        }
    }

    public function tableTripOjek()
    {
        $username = $this->session->username;
		if($username == null)
		{
			$this->session->sess_destroy();
			redirect('Dashboard/login');
		} else {
        $semuaTrip = $this->InputModel->getTripOjek();
        $data['dataTrip'] = $semuaTrip;

        $totalTrip = $this->InputModel->getTotalTrip();
        $data['dataTotal'] = $totalTrip;

        $this->load->view('tableOjek',$data);
        }
    }

    public function tableAbsen()
    {
        $username = $this->session->username;
		if($username == null)
		{
			$this->session->sess_destroy();
			redirect('Dashboard/login');
		} else {
        $semuaAbsen = $this->InputModel->getAbsensi();
        $data['dataAbsen'] = $semuaAbsen;
        $semuaKaryawan = $this->InputModel->getAllKaryawan();
        $data['dataKaryawan'] = $semuaKaryawan;

        $this->load->view('tableAbsen',$data);
        }
    }

    public function absensi()
    {
        $username = $this->session->username;
		if($username == null)
		{
			$this->session->sess_destroy();
			redirect('Dashboard/login');
		} else {
        $semuaAbsen = $this->InputModel->getDataAbsensi();
        $data['dataAbsen'] = $semuaAbsen;

        $this->load->view('Absensi',$data);
        }
    }

    public function jadwalKerja()
    {
        $username = $this->session->username;
		if($username == null)
		{
			$this->session->sess_destroy();
			redirect('Dashboard/login');
		} else {
        $semuaJadwalKerja = $this->InputModel->getJadwalKerja();
        $data['dataJadwalKerja'] = $semuaJadwalKerja;
        $semuaKaryawan = $this->InputModel->getAllKaryawan();
        $data['dataKaryawan'] = $semuaKaryawan;

        $this->load->view('JadwalKerja',$data);
        }
    }

    public function jadwalUkur()
    {
        $username = $this->session->username;
		if($username == null)
		{
			$this->session->sess_destroy();
			redirect('Dashboard/login');
		} else {
        $semuaJadwalUkur = $this->InputModel->getJadwalUkur();
        $data['dataJadwalUkur'] = $semuaJadwalUkur;

        $this->load->view('jadwalUkur',$data);
        }
    }

    public function tablePenjualan()
    {
        $username = $this->session->username;
		if($username == null)
		{
			$this->session->sess_destroy();
			redirect('Dashboard/login');
		} else {
        $semuaPenjualan = $this->InputModel->getTablePenjualan();
        $data['dataPenjualan'] = $semuaPenjualan;

        $this->load->view('tablePenjualan',$data);
        }
    }

    public function tableHasilSurvey()
    {
        $username = $this->session->username;
		if($username == null)
		{
			$this->session->sess_destroy();
			redirect('Dashboard/login');
		} else {
        $semuaSurvey = $this->InputModel->getTableSurvey();
        $data['dataSurvey'] = $semuaSurvey;

        $this->load->view('tableHasilSurvey',$data);
        }
    }

    public function approvePenjualan()
    {
        $username = $this->session->username;
		if($username == null)
		{
			$this->session->sess_destroy();
			redirect('Dashboard/login');
		} else {
        $semuaPenjualan = $this->InputModel->getTablePenjualanApprove();
        $data['dataPenjualan'] = $semuaPenjualan;

        $this->load->view('approvePenjualan',$data);
        }
    }

    public function tableCustomer()
    {
        $username = $this->session->username;
		if($username == null)
		{
			$this->session->sess_destroy();
			redirect('Dashboard/login');
		} else {
        $semuaCustomer = $this->InputModel->getAllCustomer();
        $data['dataCustomer'] = $semuaCustomer;

        $this->load->view('dataCustomer',$data);
        }
    }

    public function approveHasilSurvey()
    {
        $username = $this->session->username;
		if($username == null)
		{
			$this->session->sess_destroy();
			redirect('Dashboard/login');
		} else {
        $semuaSurvey = $this->InputModel->getTableSurveyApprove();
        $data['dataSurvey'] = $semuaSurvey;

        $this->load->view('approveHasilSurvey',$data);
        }
    }

	}
