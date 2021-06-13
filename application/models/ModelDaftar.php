<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelDaftar extends CI_Model {

    public function __construct(){
		parent::__construct();
	}

  public function InsertData($data){
    $checkinsert = false;
		try{
			$this->db->insert('pelanggan',$data);
			$checkinsert = true;
		}catch (Exception $ex) {
			$checkinsert = false;
		}
		return $checkinsert;
  }

  function get_id($username)
  {
    $this->db->where('login', $username);
    $this->db->select("*");
    $this->db->from("username");
    return $this->db->get();
  }

  public function getIdPlg()
  {
    $q = $this->db->query("select MAX(RIGHT(id_plg,3)) as kd_max from pelanggan");
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
    return "PL".$kd;
  }

  public function getAllPelanggan($username)
  {
    $result = $this->db->query("SELECT * from pelanggan where username ='".$username."'");
    return $result->result();
  }

  public function getNm_Plg($username)
  {
    $result = $this->db->query("SELECT nm_plg from login where username ='".$username."'");
    return $result->result();
  }

  public function UpdateData($id,$data)
  {
    $this->db->where('username',$id);
    $this->db->update('login',$data);
  }

  public function UpdatePelanggan($id,$data)
  {
    $this->db->where('username',$id);
    $this->db->update('pelanggan',$data);
  }

  public function getReport($username,$id_pesan)
  {
    $result = $this->db->query("SELECT * FROM pesan,detil_pesan,login,barang,pelanggan WHERE barang.id_brg = detil_pesan.id_brg and pelanggan.username = login.username and pesan.id_pesan = detil_pesan.id_pesan AND login.username = '".$username."' and detil_pesan.id_pesan ='".$id_pesan."'");
    return $result->result();
  }

}
