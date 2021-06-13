<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class InputModel extends CI_Model {

    public function __construct(){
		parent::__construct();
		}
		
		////////////////////////////////// INPUT CUSTOMER ////////////////////////////////////////
		// autoNumberCustomer
		public function getKdCustomer()
   	{
	  $q = $this->db->query("select MAX(RIGHT(kd_customer,3)) as kd_max from daftar_customer");
      $kd = "";
      if($q->num_rows() > 0)
      {
        foreach ($q->result() as $k) {
       	  $tmp = ((int)$k->kd_max)+1;
       	  $kd = sprintf("%03s",$tmp);
        }
      } else
       	{
       		$kd = "001";
       	}
      return "KC".$kd;
	}
    // inputDataCustomer
		public function inputCustomer($data){
			$checkinsert = false;
			try{
				$this->db->insert('daftar_customer',$data);
				$checkinsert = true;
			}catch (Exception $ex) {
				$checkinsert = false;
			}
			return $checkinsert;
		}

		////////////////////////////// INPUT DATA KARYAWAN //////////////////////////////////////
		// autoNumberKaryawan
		public function getKdKaryawan()
   	{
	  $q = $this->db->query("select MAX(RIGHT(kd_karyawan,3)) as kd_max from daftar_karyawan");
      $kd = "";
      if($q->num_rows() > 0)
      {
        foreach ($q->result() as $k) {
       	  $tmp = ((int)$k->kd_max)+1;
       	  $kd = sprintf("%03s",$tmp);
        }
      } else
       	{
       		$kd = "001";
       	}
      return "KK".$kd;
		}

		// autoNumberUser
		public function getKdUser()
		{
 		$q = $this->db->query("select MAX(RIGHT(id_user,3)) as kd_max from user");
	 		$kd = "";
	 		if($q->num_rows() > 0)
	 		{
		 		foreach ($q->result() as $k) {
					$tmp = ((int)$k->kd_max)+1;
					$kd = sprintf("%03s",$tmp);
		 	}
	 		} else
				{
					$kd = "001";
				}
	 		return "US".$kd;
		}

		// inputDataKaryawan
		public function inputKaryawan($data){
			$checkinsert = false;
			try{
				$this->db->insert('daftar_karyawan',$data);
				$checkinsert = true;
			}catch (Exception $ex) {
				$checkinsert = false;
			}
			return $checkinsert;
		}

		public function inputAbsenManual($data){
			$checkinsert = false;
			try{
				$this->db->insert('jadwal_kerja',$data);
				$checkinsert = true;
			}catch (Exception $ex) {
				$checkinsert = false;
			}
			return $checkinsert;
		}

		// inputDataUser
		public function inputUser($data){
			$checkinsert = false;
			try{
				$this->db->insert('user',$data);
				$checkinsert = true;
			}catch (Exception $ex) {
				$checkinsert = false;
			}
			return $checkinsert;
		}

		////////////////////////////// INPUT DATA BARANG /////////////////////////////////////
		// autoNumberBarang
		public function getKdBarang()
		{
 		$q = $this->db->query("select MAX(RIGHT(kd_barang,3)) as kd_max from barang");
	 		$kd = "";
	 		if($q->num_rows() > 0)
	 		{
		 		foreach ($q->result() as $k) {
					$tmp = ((int)$k->kd_max)+1;
					$kd = sprintf("%03s",$tmp);
		 	}
	 		} else
				{
					$kd = "001";
				}
	 		return "KB".$kd;
		}

		// inputDataBarang
		public function inputBarang($data){
			$checkinsert = false;
			try{
				$this->db->insert('barang',$data);
				$checkinsert = true;
			}catch (Exception $ex) {
				$checkinsert = false;
			}
			return $checkinsert;
		}

		// ambilSemuaDataKaryawan (untuk dropwown)
		public function getAllKaryawan()
  	{
		$result = $this->db->get('daftar_karyawan');
		return $result->result();
		}

		// autoNumberJadwalKerja
		public function getKdJadwalKerja()
		{
 			$result = $this->db->query("select MAX(RIGHT(kd_jadwal_kerja,3)) as kd_max from jadwal_kerja");
		  return $result->result();
		}
	
		// inputJadwalKerja
		public function inputJadwalKerja($data){
			return $this->db->insert_batch('jadwal_kerja', $data);
		}

		///////////////////////// INPUT JADWAL UKUR ///////////////////////////////////////////////
		// ambilSemuaDataCustomer (untuk dropdown)
		public function getAllCustomer()
  	{
		$result = $this->db->get('daftar_customer');
		return $result->result();
		}

			// autoNumberJadwalUkur
			public function getKdJadwalUkur()
			{
			 $q = $this->db->query("select MAX(RIGHT(kd_jadwal_ukur,3)) as kd_max from jadwal_ukur");
				 $kd = "";
				 if($q->num_rows() > 0)
				 {
					 foreach ($q->result() as $k) {
						$tmp = ((int)$k->kd_max)+1;
						$kd = sprintf("%03s",$tmp);
				 }
				 } else
					{
						$kd = "001";
					}
				 return "KU".$kd;
			}

			// inputJadwalUkur
			public function inputJadwalUkur($data){
				$checkinsert = false;
				try{
					$this->db->insert('jadwal_ukur',$data);
					$checkinsert = true;
				}catch (Exception $ex) {
					$checkinsert = false;
				}
				return $checkinsert;
			}

				// autoNumberTripOjek
				public function getKdPerjalanan()
				{
				 $q = $this->db->query("select MAX(RIGHT(kd_perjalanan,3)) as kd_max from trip_ojek");
					 $kd = "";
					 if($q->num_rows() > 0)
					 {
						 foreach ($q->result() as $k) {
							$tmp = ((int)$k->kd_max)+1;
							$kd = sprintf("%03s",$tmp);
					 }
					 } else
						{
							$kd = "001";
						}
					 return "KP".$kd;
				}

				// inputTripOjek
			public function inputTripOjek($data){
				$checkinsert = false;
				try{
					$this->db->insert('trip_ojek',$data);
					$checkinsert = true;
				}catch (Exception $ex) {
					$checkinsert = false;
				}
				return $checkinsert;
			}

			public function getAllBarang()
  		{
				$result = $this->db->get('barang');
				return $result->result();
			}

				// autoNumberPenjualan
				public function getKdPenjualan()
				{
				 $q = $this->db->query("select MAX(RIGHT(kd_penjualan,3)) as kd_max from penjualan");
					 $kd = "";
					 if($q->num_rows() > 0)
					 {
						 foreach ($q->result() as $k) {
							$tmp = ((int)$k->kd_max)+1;
							$kd = sprintf("%03s",$tmp);
					 }
					 } else
						{
							$kd = "001";
						}
					 return "KI".$kd;
				}

					// inputPenjualan
			public function inputPenjualan($data){
				$checkinsert = false;
				try{
					$this->db->insert('penjualan',$data);
					$checkinsert = true;
				}catch (Exception $ex) {
					$checkinsert = false;
				}
				return $checkinsert;
			}

			// autoNumberSurvey
			public function getKdSurvey()
			{
			 $q = $this->db->query("select MAX(RIGHT(kd_survey,3)) as kd_max from hasil_survey");
				 $kd = "";
				 if($q->num_rows() > 0)
				 {
					 foreach ($q->result() as $k) {
						$tmp = ((int)$k->kd_max)+1;
						$kd = sprintf("%03s",$tmp);
				 }
				 } else
					{
						$kd = "001";
					}
				 return "KS".$kd;
			}

					// inputHasilSurvey
					public function inputHasilSurvey($data){
						$checkinsert = false;
						try{
							$this->db->insert('hasil_survey',$data);
							$checkinsert = true;
						}catch (Exception $ex) {
							$checkinsert = false;
						}
						return $checkinsert;
					}

					//update status jadwal ukur
					public function updateStatusUkur()
					{
						$this->db->where('kd_jadwal_ukur',$ku);
								$this->db->update('jadwal_ukur',$data1);
					}

			public function getTripOjek()
			{
				$this->db->select('*');
					$this->db->from('trip_ojek');     
					$this->db->join('daftar_karyawan','trip_ojek.karyawankd_karyawan = daftar_karyawan.kd_karyawan');
					// $this->db->where('barang.id_kategori',$id);       
					$query = $this->db->get()->result();
					return $query;
			}

			public function getJadwalKerja()
			{
				$this->db->select('*');
					$this->db->from('jadwal_kerja');     
					$this->db->join('daftar_karyawan','jadwal_kerja.karyawankd_karyawan = daftar_karyawan.kd_karyawan');
					// $this->db->where('jadwal_kerja.keterangan','tidak hadir');       
					$query = $this->db->get()->result();
					return $query;
			}

			public function getJadwalUkur()
			{
				$this->db->select('*');
					$this->db->from('jadwal_ukur');     
					$this->db->join('daftar_customer','jadwal_ukur.customerkd_customer = daftar_customer.kd_customer');
					$this->db->join('daftar_karyawan','jadwal_ukur.karyawankd_karyawan = daftar_karyawan.kd_karyawan');    
					$query = $this->db->get()->result();
					return $query;
			}

			public function getAbsensi()
			{
				$this->db->select('*');
					$this->db->from('jadwal_kerja');     
					$this->db->join('daftar_karyawan','jadwal_kerja.karyawankd_karyawan = daftar_karyawan.kd_karyawan');
					$this->db->where('jadwal_kerja.keterangan','belum diisi'); 
					$this->db->where('jam_kerja !=','LIBUR');       
					$query = $this->db->get()->result();
					return $query;
			}

			public function getDataAbsensi()
			{

				$result = $this->db->query("SELECT GROUP_CONCAT(ket_manual SEPARATOR '<br>') AS ket_manual,karyawankd_karyawan,COUNT(IF(keterangan = 'hadir',1,null)) AS total_masuk,COUNT(IF(keterangan = 'alfa',1,null)) AS total_tidakmasuk,COUNT(IF(keterangan = 'izin',1,null)) AS total_izin,
				COUNT(IF(keterangan = 'sakit',1,null)) AS total_sakit,GROUP_CONCAT(kd_jadwal_kerja SEPARATOR '<br>') AS kd_jadwal_kerja,
				nama,GROUP_CONCAT(tgl SEPARATOR '<br>') AS tgl,GROUP_CONCAT(jam_kerja SEPARATOR '<br>') AS jam_kerja,
				GROUP_CONCAT(keterangan SEPARATOR '<br>') AS keterangan FROM jadwal_kerja 
				INNER JOIN daftar_karyawan ON jadwal_kerja.karyawankd_karyawan = daftar_karyawan.kd_karyawan 
				WHERE keterangan != 'belum diisi'
				GROUP BY karyawankd_karyawan ORDER BY tgl");
				
				return $result->result();
			}

			public function getTotalTrip()
			{

				$result = $this->db->query("SELECT SUM(harga) AS total FROM trip_ojek");
				
				return $result->result();
			}

			public function editAbsen($ka,$data)
			{
						$this->db->where('kd_jadwal_kerja',$ka);
						$this->db->update('jadwal_kerja',$data);
			}

			public function editJadwalKerja($ka,$data)
			{
						$this->db->where('kd_jadwal_kerja',$ka);
						$this->db->update('jadwal_kerja',$data);
			}

			public function editBarang($kb,$data)
			{
						$this->db->where('kd_barang',$kb);
						$this->db->update('barang',$data);
			}

			public function editCustomer($kb,$data)
			{
						$this->db->where('kd_customer',$kb);
						$this->db->update('daftar_customer',$data);
			}

			public function editApprovePenjualan($kp,$data)
			{
						$this->db->where('customerkd_customer',$kp);
						$this->db->update('penjualan',$data);
			}
			
			public function editApproveHasilSurvey($ks,$data)
			{
						$this->db->where('ukurkd_jadwal_ukur',$ks);
						$this->db->update('hasil_survey',$data);
			}

			public function getTablePenjualan()
			{
				$result = $this->db->query("SELECT keterangan_approve,customerkd_customer,nama_customer,kd_penjualan,GROUP_CONCAT(jumlah_barang SEPARATOR '<br>') AS jumlah_barang,GROUP_CONCAT(nama_barang SEPARATOR '<br>') AS nama_barang,
				GROUP_CONCAT(harga_barang SEPARATOR '<br>') AS harga_barang,GROUP_CONCAT(total SEPARATOR '<br>') as totalHarga,SUM(total) as totalAll FROM penjualan 
				INNER JOIN daftar_customer INNER JOIN barang ON penjualan.barangkd_barang = barang.kd_barang 
				AND penjualan.customerkd_customer = daftar_customer.kd_customer WHERE keterangan_approve ='approved' GROUP BY customerkd_customer ORDER BY kd_penjualan");
				
				return $result->result();
			}

			public function getTableSurvey()
			{
				$result = $this->db->query("SELECT keterangan_approve,ukurkd_jadwal_ukur,nama_customer,alamat_customer,nama,no_tlp_customer,kd_jadwal_ukur,GROUP_CONCAT(jumlah SEPARATOR '<br>') AS jumlah_barang,GROUP_CONCAT(ukuran SEPARATOR '<br>') AS ukuran,GROUP_CONCAT(nama_brg SEPARATOR '<br>') AS nama_barang,
				GROUP_CONCAT(harga_import SEPARATOR '<br>') AS harga_import,GROUP_CONCAT(sub_total_import SEPARATOR '<br>') as sub_total_import,GROUP_CONCAT(harga_lokal SEPARATOR '<br>') as harga_lokal,GROUP_CONCAT(sub_total_lokal SEPARATOR '<br>') as sub_total_lokal,
				SUM(sub_total_lokal) as total_lokal,SUM(sub_total_import) as total_import FROM hasil_survey 
				INNER JOIN jadwal_ukur INNER JOIN daftar_customer INNER JOIN daftar_karyawan ON hasil_survey.ukurkd_jadwal_ukur = jadwal_ukur.kd_jadwal_ukur 
				AND jadwal_ukur.customerkd_customer = daftar_customer.kd_customer AND jadwal_ukur.karyawankd_karyawan = daftar_karyawan.kd_karyawan WHERE keterangan_approve='approved' GROUP BY ukurkd_jadwal_ukur ORDER BY kd_survey");
				
				return $result->result();
			}

			public function getTablePenjualanApprove()
			{
				$result = $this->db->query("SELECT keterangan_approve,customerkd_customer,nama_customer,kd_penjualan,GROUP_CONCAT(jumlah_barang SEPARATOR '<br>') AS jumlah_barang,GROUP_CONCAT(nama_barang SEPARATOR '<br>') AS nama_barang,
				GROUP_CONCAT(harga_barang SEPARATOR '<br>') AS harga_barang,GROUP_CONCAT(total SEPARATOR '<br>') as totalHarga,SUM(total) as totalAll FROM penjualan 
				INNER JOIN daftar_customer INNER JOIN barang ON penjualan.barangkd_barang = barang.kd_barang 
				AND penjualan.customerkd_customer = daftar_customer.kd_customer WHERE keterangan_approve ='not yet approve' GROUP BY customerkd_customer ORDER BY kd_penjualan");
				
				return $result->result();
			}

			public function getTableSurveyApprove()
			{
				$result = $this->db->query("SELECT keterangan_approve,ukurkd_jadwal_ukur,nama_customer,alamat_customer,nama,no_tlp_customer,kd_jadwal_ukur,GROUP_CONCAT(jumlah SEPARATOR '<br>') AS jumlah_barang,GROUP_CONCAT(ukuran SEPARATOR '<br>') AS ukuran,GROUP_CONCAT(nama_brg SEPARATOR '<br>') AS nama_barang,
				GROUP_CONCAT(harga_import SEPARATOR '<br>') AS harga_import,GROUP_CONCAT(sub_total_import SEPARATOR '<br>') as sub_total_import,GROUP_CONCAT(harga_lokal SEPARATOR '<br>') as harga_lokal,GROUP_CONCAT(sub_total_lokal SEPARATOR '<br>') as sub_total_lokal,
				SUM(sub_total_lokal) as total_lokal,SUM(sub_total_import) as total_import FROM hasil_survey 
				INNER JOIN jadwal_ukur INNER JOIN daftar_customer INNER JOIN daftar_karyawan ON hasil_survey.ukurkd_jadwal_ukur = jadwal_ukur.kd_jadwal_ukur 
				AND jadwal_ukur.customerkd_customer = daftar_customer.kd_customer AND jadwal_ukur.karyawankd_karyawan = daftar_karyawan.kd_karyawan WHERE keterangan_approve='not yet approve' GROUP BY ukurkd_jadwal_ukur ORDER BY kd_survey");
				
				return $result->result();
			}

			public function getSurvey($ks)
			{
				$result = $this->db->query("SELECT ukurkd_jadwal_ukur,nama_customer,alamat_customer,nama,no_tlp_customer,kd_jadwal_ukur,jumlah,ukuran,nama_brg,
				harga_import,sub_total_import,harga_lokal ,sub_total_lokal
				FROM hasil_survey 
				INNER JOIN jadwal_ukur INNER JOIN daftar_customer INNER JOIN daftar_karyawan ON hasil_survey.ukurkd_jadwal_ukur = jadwal_ukur.kd_jadwal_ukur 
				AND jadwal_ukur.customerkd_customer = daftar_customer.kd_customer AND jadwal_ukur.karyawankd_karyawan = daftar_karyawan.kd_karyawan WHERE ukurkd_jadwal_ukur = '$ks'");
				
				return $result->result();
			}

			public function deleteKdBarang($kd_barang){
				$this->db->where('kd_barang', $kd_barang);
				$this->db->delete('barang');
			}

			public function deleteKdPenjualan($kd_barang){
				$this->db->where('barangkd_barang', $kd_barang);
				$this->db->delete('penjualan');
			}

			public function deleteKdJadwalKerja($kd_jadwal_kerja){
				$this->db->where('kd_jadwal_kerja', $kd_jadwal_kerja);
				$this->db->delete('jadwal_kerja');
			}

			public function deleteKdJadwalUkur($kd_jadwal_ukur){
				$this->db->where('kd_jadwal_ukur', $kd_jadwal_ukur);
				$this->db->delete('jadwal_ukur');
			}

			public function deleteUkurSurvey($kd_jadwal_ukur){
				$this->db->where('ukurkd_jadwal_ukur', $kd_jadwal_ukur);
				$this->db->delete('hasil_survey');
			}

			public function deleteDataPenjualan($kdcustomer){
				$this->db->where('customerkd_customer', $kdcustomer);
				$this->db->delete('penjualan');
			}

			public function deleteDataSurvey($kdukur){
				$this->db->where('ukurkd_jadwal_ukur', $kdukur);
				$this->db->delete('hasil_survey');
			}

			public function deleteOjek($kdjalan){
				$this->db->where('kd_perjalanan', $kdjalan);
				$this->db->delete('trip_ojek');
			}

			public function deleteAbsensi($kdabsen){
				$this->db->where('karyawankd_karyawan', $kdabsen);
				$this->db->delete('jadwal_kerja');
			}

			public function deleteJadwalKerja(){

				$result = $this->db->query("DELETE FROM jadwal_kerja");
				return $result;
			}

			public function deleteJadwalUkur(){

				$result = $this->db->query("DELETE FROM jadwal_ukur");
				return $result;
			}

			public function deleteSemuaSurvey(){

				$result = $this->db->query("DELETE FROM hasil_survey");
				return $result;
			}

			public function deleteAllTrip(){

				$result = $this->db->query("DELETE FROM trip_ojek");
				return $result;
			}

			public function deleteAllBarang(){

				$result = $this->db->query("DELETE FROM barang");
				return $result;
			}

			public function deleteAllPenjualan(){

				$result = $this->db->query("DELETE FROM penjualan");
				return $result;
			}

}
