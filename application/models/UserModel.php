<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model {

    public function __construct(){
		parent::__construct();
	}

    //method daftar user
    public function InsertDaftar($data){

		$checkinsert = false;
		try{
			$this->db->insert('login',$data);
			$checkinsert = true;
		}catch (Exception $ex) {
			$checkinsert = false;
		}
		return $checkinsert;
  }
	

	//ambil semua data dari table barang
	public function getAllBarang(){
		$result = $this->db->get('barang');
		return $result->result();
    }
    
    // get id kategori dari table barang
    function get_id($idkategori)
    {
        $this->db->where('id_kategori', $idkategori);
        $this->db->select("*");
        $this->db->from("barang");
        return $this->db->get();
	}
	
	// function get_idPesan($id_pesan)
	// {
	// 	$this->db->select("*");
	// 	$this->db->where('id_pesan', $id_pesan);
	// 	$this->db->from("detil_pesan");
	// 	return $this->db->get();
	// }

	public function getKodePesan()
   	{
	  $q = $this->db->query("select MAX(RIGHT(id_pesan,3)) as kd_max from pesan");
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
      return "PS".$kd;
	}

	public function updateQTY()
	{
		$this->db->where('id_brg',$id_pe);
      	$this->db->update('petani',$data);
	}



	////////////pesan//////////////////
	public function detilpesan($data){
		$result = $this->db->insert('detil_pesan', $data);
		return $result;
		}

	public function pesan($data){
		$result = $this->db->insert('pesan', $data);
		return $result;
		}
	
	/////////////akhir pesan//////////////////


	public function getTablePelanggan($username)
    {
      $result = $this->db->query("SELECT * FROM pelanggan where username = '".$username."'");
      return $result->result();
    }

	///////////////////invoice//////////////////

	public function invoice($username){

		$result = $this->db->query("SELECT * FROM login,pesan,detil_pesan,barang,pelanggan 
		WHERE pesan.id_pesan = detil_pesan.id_pesan 
		and pelanggan.username = pesan.username
		and login.username = pelanggan.username
		and barang.id_brg = detil_pesan.id_brg 
		and pesan.username ='".$username."' and status_bayar = 'Belum Bayar'");
		return $result->result();
  
	}

	public function bayarAdmin()
	{
		$result = $this->db->query("SELECT * FROM login,pesan,kategori,detil_pesan,barang,pelanggan,petani
		WHERE pesan.id_pesan = detil_pesan.id_pesan 
		and pelanggan.username = pesan.username
		and login.username = pelanggan.username
		and barang.id_kategori = kategori.id_kategori
		and barang.id_brg = detil_pesan.id_brg and status_bayar != 'Lunas' group by pesan.id_pesan");
		return $result->result();
	}

	public function jumlahBayar()
  	{
    	$query = $this->db->query("SELECT * FROM detil_pesan where status_bayar = 'Belum Bayar'");
    	return $query->num_rows();
  	}

  	public function jumlahHistory()
  	{
    	$query = $this->db->query("SELECT * FROM detil_pesan where status_bayar = 'Lunas'");
    	return $query->num_rows();
  	}

	public function HistorybayarAdmin()
	{
		$result = $this->db->query("SELECT * FROM login,pesan,kategori,detil_pesan,barang,pelanggan,petani
		WHERE pesan.id_pesan = detil_pesan.id_pesan 
		and pelanggan.username = pesan.username
		and login.username = pelanggan.username
		and barang.id_kategori = kategori.id_kategori
		and barang.id_brg = detil_pesan.id_brg and status_bayar = 'Lunas' group by pesan.id_pesan");
		return $result->result();
	}

	public function invoiceEmail($username,$id){

		$result = $this->db->query("SELECT * FROM login,pesan,detil_pesan,barang,pelanggan,petani,detil_barang
		WHERE pesan.id_pesan = detil_pesan.id_pesan 
		and pelanggan.username = pesan.username
		and login.username = pelanggan.username
		and barang.id_brg = detil_pesan.id_brg 
		and detil_barang.id_petani = petani.id_petani
		and pesan.username ='".$username."' and status_bayar = 'Belum Bayar' and pesan.id_pesan = '".$id."'");
		return $result->result();
  
	}
	///////////////akhir invoice/////////////////////

	public function kwitansi($username){
		$result = $this->db->query("SELECT * FROM pesan,detil_pesan,barang WHERE pesan.id_pesan = detil_pesan.id_pesan and detil_pesan.id_brg = barang.id_brg and pesan.username = '".$username."'");
		return $result->result();
	}
	
	
	function changeBayar($key)
	{
		$this->load->database();
	 	$data = array(
			'status_bayar'=>"Lunas"
	 	);

		$this->db->where('md5(id_pesan)', $key);
		$this->db->update('detil_pesan', $data);

		return true;
	}

	function changePoin($key)
	{
		$this->load->database();
	 	$data = array(
			'poin'=>"1"
	 	);

		$this->db->where('md5(id_pesan)', $key);
		$this->db->update('detil_pesan', $data);

		return true;
	}

	//admin
	function changeBayar1($key)
	{
		$this->load->database();
	 	$data = array(
			'status_bayar'=>"Lunas"
	 	);

		$this->db->where('id_pesan', $key);
		$this->db->update('detil_pesan', $data);

		return true;
	}

	//admin
	function changePoin1($key)
	{
		$this->load->database();
	 	$data = array(
			'poin'=>"1"
	 	);

		$this->db->where('id_pesan', $key);
		$this->db->update('detil_pesan', $data);

		return true;
	}

	public function deleteDetilPesan($id_pesan){
      $this->db->where('id_pesan', $id_pesan);
      $this->db->delete('detil_pesan');
    }

    public function deletePesan($id_pesan){
      $this->db->where('id_pesan', $id_pesan);
      $this->db->delete('pesan');
    }

	////////////// laporan ////////////////////////////
	public function beli(){
		return $this->db->query('select a.nm_brg as barang,count(b.id_brg) as jumlah
								 from barang a,detil_pesan b
								 where a.id_brg = b.id_brg
								 group by a.nm_brg
								 order by jumlah desc limit 5')->result();
	 }
}
