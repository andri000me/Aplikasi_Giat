<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input extends CI_Controller {

	var $gallery_path;
	var $gallery_path_url;

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('InputModel');
		$this->load->helper('form');
		$this->load->library('upload');
    }
    
	
	// input data customer
    public function inputCustomer()
    {
        
        $kd = $this->InputModel->getKdCustomer();
		$nm_customer = $this->input->post('nmCustomer');
		$alamat = $this->input->post('alamat');
		$no_telp = $this->input->post('noTlp');

		$data = array(
            'kd_customer' => $kd,
			'nama_customer' => $nm_customer,
			'alamat_customer' => $alamat,
			'no_tlp_customer' => $no_telp
		);

        $result = $this->InputModel->inputCustomer($data);
        
       redirect('Dashboard/jadwalUkur');
    }
	
	// input data karyawan dan user
	public function Registrasi()
    {
        
		$kd = $this->InputModel->getKdKaryawan();
		$ku = $this->InputModel->getKdUser();
		$nm_karyawan = $this->input->post('nmKaryawan');
		$alamat = $this->input->post('alamat');
		$no_telp = $this->input->post('noTlp');
		$username = $this->input->post('username');
		$pass = $this->input->post('password');
		$level = $this->input->post('level');

		$data = array(
            'kd_karyawan' => $kd,
			'nama' => $nm_karyawan,
			'alamat' => $alamat,
			'no_tlp' => $no_telp
		);

		$data1 = array(
            'id_user' => $ku,
			'username' => $username,
			'password' => $pass,
			'level' => $level,
			'karyawankd_karyawan' => $kd
		);

		$result = $this->InputModel->inputKaryawan($data);
		$result = $this->InputModel->inputUser($data1);
        
        redirect('Dashboard');
    }

	// input data barang
	public function inputBarang()
    {
		$this->load->helper(array('form', 'url')); 
		$nama_file = md5(uniqid(rand(), true));
		$this->load->library('upload');
		$config = [
			'upload_path' => './assets/img/',
			'allowed_types' => 'gif|jpg|png|jpeg|bmp',
			'file_name' => $nama_file
		];

		$this->upload->initialize($config);

		  if(!$this->upload->do_upload('photobrg')){
		      $photo="";
		  }else{
				  
		$photo=$this->upload->file_name;
        $kb = $this->InputModel->getKdBarang();
		$nm_barang = $this->input->post('nmBarang');
		$ukuran = $this->input->post('ukuran');
		$keterangan = $this->input->post('keterangan');
		$stok = $this->input->post('jumlah');
		$tanggal = date("Y-m-d");

		$data = array(
			'kd_barang' => $kb,
			'nama_barang' => $nm_barang,
			'keterangan' => $keterangan,
			'stok' => $stok,
			'tgl_input' =>$tanggal,
			'photo_barang' => $photo
		);

        $result = $this->InputModel->inputBarang($data);
        
		redirect('Dashboard/tableBarang');
		}
	}
	
	// input data jadwal kerja
	public function inputJadwalKerja()
	{
	
		// $kj = $this->InputModel->getKdJadwalKerja();

		// Ambil data yang dikirim dari form
		// $kode = $_POST['kode'];
		$tgl = $_POST['tgl']; // Ambil data nama dan masukkan ke variabel nama
		$jam = $_POST['jam']; // Ambil data telp dan masukkan ke variabel telp
		$kd = $_POST['karyawan']; // Ambil data alamat dan masukkan ke variabel alamat
		$data = array();
		
		$index = 0; // Set index array awal dengan 0
		foreach($kd as $datakj){ // Kita buat perulangan berdasarkan nis sampai data terakhir
			array_push($data, array(
				'karyawankd_karyawan'=>$datakj,
				'tgl'=>$tgl[$index],  // Ambil dan set data nama sesuai index array dari $index
				'jam_kerja'=>$jam[$index],  // Ambil dan set data telepon sesuai index array dari $index
			));
			
			$index++;
		}
		
		$sql = $this->InputModel->inputJadwalKerja($data); // Panggil fungsi save_batch yang ada di model siswa (SiswaModel.php)
		
		// Cek apakah query insert nya sukses atau gagal
		if($sql){ // Jika sukses
			echo "<script>alert('Data berhasil disimpan');window.location = '".base_url('Dashboard/jadwalKerja')."';</script>";
		}else{ // Jika gagal
			echo "<script>alert('Data gagal disimpan');window.location = '".base_url('Dashboard/inputJadwalKerja')."';</script>";
		}
		// redirect('Dashboard/jadwalKerja');
	}

	// input data jadwal ukur
    public function inputJadwalUkur()
    {
		$kc = $this->input->post('customer');
		$ku = $this->InputModel->getKdJadwalUkur();
		$jam = $this->input->post('jam');
		$tgl = $this->input->post('tgl');
		$kd = $this->input->post('karyawan');

		$data = array(
			'kd_jadwal_ukur' => $ku,
			'tgl_ukur' => $tgl,
			'jam_ukur' => $jam,
			'karyawankd_karyawan' => $kd,
			'customerkd_customer' => $kc
			
		);

		$result = $this->InputModel->inputJadwalUkur($data);
		
        redirect('Dashboard/jadwalUkur');
	}

	
    public function absenManual()
    {
		$kj = $this->input->post('kd_jadwal_kerja');
		$kk = $this->input->post('kd_karyawan');
		$jam = $this->input->post('jam');
		$tgl = $this->input->post('tgl');
		$keterangan = $this->input->post('keterangan');

		$data = array(
			'kd_jadwal_kerja' => $kj,
			'tgl' => $tgl,
			'jam_kerja' => $jam,
			'karyawankd_karyawan' => $kk,
			'keterangan' => $keterangan
			
		);

		$result = $this->InputModel->inputAbsenManual($data);
		
        redirect('Dashboard/absensi');
	}
	
	// input data trip ojek
    public function inputTripOjek()
    {
		$this->load->helper(array('form', 'url')); 
		$nama_file = md5(uniqid(rand(), true));
		$this->load->library('upload');
		$config = [
			'upload_path' => './assets/img/',
			'allowed_types' => 'gif|jpg|png|jpeg|bmp',
			'file_name' => $nama_file
		];

		$this->upload->initialize($config);

		  if(!$this->upload->do_upload('photo')){
		      $photo="";
		  }else{
				  
			$photo=$this->upload->file_name;
			$kp = $this->InputModel->getKdPerjalanan();
			$kd = $this->InputModel->getKdKaryawan();
			$start = $this->input->post('start');
			$finish = $this->input->post('tujuan');
			$harga = $this->input->post('harga');
			$tgl = $this->input->post('tgl');
			$kd = $this->input->post('karyawan');

			$data = array(
				'kd_perjalanan' => $kp,
				'tgl_trip' => $tgl,
				'titik_awal' => $start,
				'tujuan' => $finish,
				'harga' => $harga,
				'foto_bukti' => $photo,
				'karyawankd_karyawan' => $kd
			);
			// echo json_encode($data); die();

		$result = $this->InputModel->inputTripOjek($data);
		
		redirect('Dashboard/tableTripOjek');
		}
    }

	// update data absen
    function editAbsen(){
		
		$ka = $this->input->post('kd_jadwal_kerja');
		$keterangan = $this->input->post('keterangan');
		$manual = $this->input->post('manual');

		$data = array(
			'keterangan' => $keterangan,
			'ket_manual' => $manual
		);

		
		$result = $this->InputModel->editAbsen($ka,$data);
		
        redirect('Dashboard/tableAbsen');

	}

	function editApprovePenjualan(){
		
		$kp = $this->input->post('kd_penjualan');
		$keterangan = $this->input->post('keterangan');

		$data = array(
			'keterangan_approve' => $keterangan
		);

		$result = $this->InputModel->editApprovePenjualan($kp,$data);
		
        redirect('Dashboard/tablePenjualan');

	}

	function editApproveHasilSurvey(){
		
		$ks = $this->input->post('kd_survey');
		$keterangan = $this->input->post('keterangan');

		$data = array(
			'keterangan_approve' => $keterangan
		);

		$result = $this->InputModel->editApproveHasilSurvey($ks,$data);
		
        redirect('Dashboard/tableHasilSurvey');

	}
	
	// input data penjualan
    public function inputPenjualan()
    {
		$ki = $this->InputModel->getKdPenjualan();
		$customer = $this->input->post('customer');
		$barang = $this->input->post('barang');
		$jumlah = $this->input->post('jumlah');
		$harga = $this->input->post('harga');
		$waktu = $this->input->post('waktu');
		$karyawan = $this->input->post('karyawan');

		$total = 0;

		$total = $jumlah*$harga;

		$data = array(
			'kd_penjualan' => $ki,
			'jumlah_barang' => $jumlah,
			'harga_barang' => $harga,
			'waktu_kirim' => $waktu,
			'karyawankd_karyawan' => $karyawan,
			'customerkd_customer' => $customer,
			'barangkd_barang' => $barang,
			'total' => $total
		);

		$result = $this->InputModel->inputPenjualan($data);
		
        redirect('Dashboard/approvePenjualan');
	}
	
	// input hasil survey
	public function inputHasilSurvey()
    {
		
		$ks = $this->InputModel->getKdSurvey();
        $kj = $this->input->post('kdUkur');
		$nm_barang = $this->input->post('nmBarang');
		$qty = $this->input->post('qty');
		$ukuran = $this->input->post('ukuran');
		$lokal = $this->input->post('hargaLokal');
		$import = $this->input->post('hargaImport');

		$totalLokal = 0;
		$totalLokal = $qty*$lokal;

		$totalImport = 0;
		$totalImport = $qty*$import;

		$data = array(
			'kd_survey' => $ks,
			'nama_brg' => $nm_barang,
			'ukuran' => $ukuran,
			'jumlah' => $qty,
			'harga_lokal' => $lokal,
			'harga_import' => $import,
			'sub_total_lokal' => $totalLokal,
			'sub_total_import' => $totalImport,
			'ukurkd_jadwal_ukur' => $kj
		);

        $result = $this->InputModel->inputHasilSurvey($data);
        
        redirect('Dashboard/jadwalUkur');
	}

	public function hapusJadwalKerja()
	{	
		$this->InputModel->deleteJadwalKerja();

		redirect('Dashboard/jadwalKerja');
	}

	public function hapusJadwalUkur()
	{	
		$this->InputModel->deleteSemuaSurvey();
		$this->InputModel->deleteJadwalUkur();

		redirect('Dashboard/jadwalUkur');
	}

	public function hapusTripOjek()
	{	
		$this->InputModel->deleteAllTrip();

		redirect('Dashboard/tableTripOjek');
	}

	public function hapusBarang()
	{	
		$this->InputModel->deleteAllPenjualan();
		$this->InputModel->deleteAllBarang();

		redirect('Dashboard/tableBarang');
	}

	// update data absen
    function editJadwalKerja(){
		
		
		$ka = $this->input->post('kd_jadwal_kerja');
		$jam = $this->input->post('jam');
		$tgl = $this->input->post('tgl');

		$data = array(
			'tgl' => $tgl,
			'jam_kerja' => $jam
		);

        $result = $this->InputModel->editJadwalKerja($ka,$data);

		redirect('Dashboard/jadwalKerja');

	}

    function editCustomer(){
		
		
		$kb = $this->input->post('kd_customer');
		$nm = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$telp = $this->input->post('telp');

		$data = array(
			'nama_customer' => $nm,
			'alamat_customer' => $alamat,
			'no_tlp_customer' => $telp
		);

        $result = $this->InputModel->editCustomer($kb,$data);

		redirect('Dashboard/tableCustomer');

	}

	// update barang
    function editBarang(){
		
		
		$kb = $this->input->post('kd_barang');
		$nm_brg = $this->input->post('nama_brg');
		$stok = $this->input->post('stok');
		$keterangan = $this->input->post('keterangan');

		$data = array(
			'nama_barang' => $nm_brg,
			'stok' => $stok,
			'keterangan' => $keterangan
		);

        $result = $this->InputModel->editBarang($kb,$data);

		redirect('Dashboard/tableBarang');

	}

	public function hapusKdBarang($kd_barang)
	{	
		$this->InputModel->deleteKdPenjualan($kd_barang);
		$this->InputModel->deleteKdBarang($kd_barang);
		
		redirect('Dashboard/tableBarang');
	}

	public function hapusKdJadwalKerja($kd_jadwal_kerja)
	{	
		$this->InputModel->deleteKdJadwalKerja($kd_jadwal_kerja);
		
		redirect('Dashboard/jadwalKerja');
	}

	public function hapusKdJadwalUkur($kd_jadwal_ukur)
	{	
		$this->InputModel->deleteUkurSurvey($kd_jadwal_ukur);
		$this->InputModel->deleteKdJadwalUkur($kd_jadwal_ukur);
		
		redirect('Dashboard/jadwalUkur');
	}

	public function hapusDataPenjualan($kdcustomer)
	{	
		$this->InputModel->deleteDataPenjualan($kdcustomer);
		
		redirect('Dashboard/tablePenjualan');
	}

	public function hapusDataSurvey($kdukur)
	{	
		$this->InputModel->deleteDataSurvey($kdukur);
		
		redirect('Dashboard/tableHasilSurvey');
	}

	public function hapusOjek($kdjalan)
	{	
		$this->InputModel->deleteOjek($kdjalan);
		
		redirect('Dashboard/tableTripOjek');
	}

	public function hapusDataAbsensi($kdabsen)
	{	
		$this->InputModel->deleteAbsensi($kdabsen);
		
		redirect('Dashboard/absensi');
	}

	}
