<?php defined('BASEPATH') OR exit('No direct script access allowed');

class DaftarLengkap extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('ModelDaftar');
		$this->load->model('UserModel');
		$this->load->model('M_Customer');
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
			
		$nama = $this->session->nm_plg;
		$id_pesan = $this->UserModel->getKodePesan();
		$username = $this->session->username;
		$getAllPelanggan = $this->ModelDaftar->getAllPelanggan($username);
		$getNm_Plg = $this->ModelDaftar->getNm_Plg($username);
		$point = $this->M_Customer->getPoint($username);
		$data = [
			'point' => $point,
			'id_pesan' => $id_pesan,
			'nama' => $nama,
			'username' => $username,
			'getAllPelanggan' => $getAllPelanggan,
			'getNm_Plg' => $getNm_Plg
		];
		$this->load->view('master/header',$data);
   		$this->load->view('view_daftar_lengkap');
		$this->load->view('master/footer');
		}
	}

  public function DataLengkap()
  {

	    $idplg = $this->ModelDaftar->getIdPlg();

	    $nm_plg = $this->input->post('nm_plg');
		$no_telp = $this->input->post('no_telp');
		$alamat = $this->input->post('alamat');
		$kodepos = $this->input->post('kodepos');
		$username = $this->input->post('username');

		$data = array(
			'no_telp' =>$no_telp,
			'alamat'=>$alamat,
			'kodepos' => $kodepos,
			'username' => $username,
	      	'id_plg' => $idplg
		);

		$result = $this->ModelDaftar->InsertData($data);
		$namaEntry['nm_plg'] = $nm_plg;
		$result2 = $this->ModelDaftar->UpdateData($username,$namaEntry);

		$data = NULL;
		if ($result){
			$this->session->set_flashdata('pesan','Data Berhasil Disimpan');
			redirect('DaftarLengkap');
		}else{
			$this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Disimpan');
			redirect('DaftarLengkap');
		}		
  }

  public function UpdateDataLengkap()
  {
  		$nm_plg = $this->input->post('nm_plg');
		$no_telp = $this->input->post('no_telp');
		$alamat = $this->input->post('alamat');
		$kodepos = $this->input->post('kodepos');
		$username = $this->input->post('username');

		$data = array(
			'no_telp' =>$no_telp,
			'alamat'=>$alamat,
			'kodepos' => $kodepos,
			'username' => $username,
		);

		$result = $this->ModelDaftar->UpdatePelanggan($username,$data);

		$namaUpdate = [
			'nm_plg' => $nm_plg
		];

		$result2 = $this->ModelDaftar->UpdateData($username,$namaUpdate);

		$data = NULL;
		if (!$result && !$result2){
			$this->session->set_flashdata('pesan','Data Berhasil Diupdate');
			redirect('DaftarLengkap');
		}else{
			$this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Disimpan');
			redirect('DaftarLengkap');
		}
  }


	public function auth()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$checkUsername = $this->ModelAdmin->readUsername($username,$password);

		if($checkUsername==NULL){

			echo "<script type='text/javascript'>
               alert ('Maaf Username Dan Password Anda Salah !');
               window.location.replace('index');
      			</script>";

		}else{
			$newdata = array(
				'username'  => $checkUsername->username,
				'name'  => $checkUsername->nama
			  );
			//set seassion
			$this->session->set_userdata($newdata);
			redirect('Admin');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Admin/Login');
	}
}
