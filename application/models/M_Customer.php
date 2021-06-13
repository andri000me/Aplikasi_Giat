<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Customer extends CI_Model {

    public function __construct(){
		parent::__construct(); 
	}


  //insert data, coded by mas galih
	public function InsertUsername($data){

		$checkinsert = false;
		try{
			$this->db->insert('username',$data);
			$checkinsert = true;
		}catch (Exception $ex) {
			$checkinsert = false;
		}
		return $checkinsert;

	}

  //read semua data
	public function readUsername($username,$password){
		$result = $this->db->where('username', $username)->where('password',md5($password))->limit(1)->get('username');
		return $result->result();

	}

  //fungsi ambil ID dari database
  function get_id($user_id)
  {
    $this->db->where('id_user', $user_id);
    $this->db->select("*");
    $this->db->from("username");
    return $this->db->get();
  }

  //fungsi ambil semua namaa username, coded by mas galih
	public function getAllUsername(){
		$result = $this->db->get('username');
		return $result->result();
	}


    function update_data($data,$where,$table)
    {
      $this->db->where($where);
      $this->db->update($table,$data);
    }

    function updatePass($username,$password)
    {
      $this->db->where('username',$username);
      $this->db->update('login',$password);
    }

    public function delete($id_user){
      $this->db->where('id_user', $id_user);
      $this->db->delete('username');
    }


    //kode Transaksi
    public function getKodeTransaksi()
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
      return "TS".$kd;
    }

    public function getTracking($id_pesan,$username)
    { 
      $result = $this->db->query("SELECT * FROM detil_pesan,barang,pesan WHERE pesan.id_pesan = detil_pesan.id_pesan and barang.id_brg = detil_pesan.id_brg and detil_pesan.id_pesan ='".$id_pesan."' and username = '".$username."'");
      return $result->result();
    }

    public function status($konfirmasi,$data)
    {
      $this->db->where('id_pesan',$konfirmasi);
      $this->db->update('detil_pesan',$data);
    }

    public function history($username){

      $result = $this->db->query("SELECT * FROM login,pesan,detil_pesan,barang,pelanggan 
      WHERE pesan.id_pesan = detil_pesan.id_pesan 
      and pelanggan.username = pesan.username
      and login.username = pelanggan.username
      and barang.id_brg = detil_pesan.id_brg 
      and pesan.username ='".$username."'");
      return $result->result();
  }

  public function getEmail($email)
  { 
      $result = $this->db->query("SELECT username FROM login where email = '".$email."'");
      return $result->result();
  }

  function changeActiveState($key)
  {
    $result = $this->db->query("SELECT username FROM login where username = '".$key."'");
      return $result->result();
  }


  public function getPoint($username)
    { 
      $result = $this->db->query("SELECT SUM(poin) as poin FROM detil_pesan,pesan WHERE pesan.id_pesan = detil_pesan.id_pesan and pesan.username = '".$username."'");
      return $result->result();
    }

  //////////////// update point  ////////////////////
  public function update($username)
  {
    $result = $this->db->query("UPDATE pesan, detil_pesan SET detil_pesan.poin='0' WHERE pesan.id_pesan =detil_pesan.id_pesan AND username = '".$username."'");	
    return $result;
  }

}
