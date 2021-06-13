<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelAdmin extends CI_Model {

    public function __construct(){
		parent::__construct();
	}


//////////////////LOGIN////////////////////////////////////////
	public function readUsername($username,$password)
  	{
 	   $result = $this->db->where('UPPER(username)', strtoupper($username))->where('password',$password)->limit(1)->get('admin');
		return $result->row();
	}

	// public function getAllLogin($id)
 //  	{
	// 	$result = $this->db->query("SELECT * FROM admin where status_admin= '".$id."'");
	// 	return $result->result();
	// }
//////////////////LOGIN////////////////////////////////////////


//////////////////START-PETANI/////////////////////////////////

	public function InsertPetani($data)
	{
		$checkinsert = false;
		try{
			$this->db->insert('petani',$data);
			$checkinsert = true;
		}catch (Exception $ex) {
			$checkinsert = false;
		}
		return $checkinsert;
	}

  	public function getAllPetani()
  	{
		$result = $this->db->get('petani');
		return $result->result();
	}


  	//fungsi ambil ID dari database
  	public function get_idPetani($id_petani)
  	{
    	$this->db->select("*");
	    $this->db->where('id_petani', $id_petani);
	    $this->db->from("petani");
	    return $this->db->get();
	}

    //update data, coded by zacky
    public function updatePetani($id_petani,$data)
    {
      $this->db->where('id_petani',$id_petani);
      $this->db->update('petani',$data);
    }

    public function deletePetani($id_petani){
      $this->db->where('id_petani', $id_petani);
      $this->db->delete('petani');
    }

    public function jumlah($table)
  	{
    	$query = $this->db->query("SELECT * FROM $table");
    	return $query->num_rows();
  	}

    public function getKodePetani()
   	{
   		$q = $this->db->query("select MAX(RIGHT(id_petani,3)) as kd_max from petani");
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
   		return "PT".$kd;
   	}

////////////////////END-PETANI////////////////////////


////////////////////START-KATEGORI////////////////////////
	public function InsertKategori($data)
	{
		$checkinsert = false;
		try{
			$this->db->insert('kategori',$data);
			$checkinsert = true;
		}catch (Exception $ex) {
			$checkinsert = false;
		}
		return $checkinsert;
	}

	public function getAllKategori()
	{
		$result = $this->db->get('kategori');
		return $result->result();
	}

	//fungsi ambil ID dari database
	public function get_idKategori($id_Kategori)
	{
		$this->db->select("*");
		$this->db->where('id_kategori', $id_Kategori);
		$this->db->from("kategori");
		return $this->db->get();
	}

	public function updateKategori($data,$where,$table)
	{
		$this->db->where('id_kategori',$where);
	    $query = $this->db->get('kategori');
	    $row = $query->row();

	    unlink("./assets/img/$row->gambar_kategori");

		$this->db->where('id_kategori', $where);
		$this->db->update($table,$data);
	}

	public function updateKategori2($data,$where,$table)
	{
		$this->db->where('id_kategori', $where);
		$this->db->update($table,$data);
	}

	public function delete($id_kategori)
    {

     $this->db->where('id_kategori',$id_kategori);
     $query = $this->db->get('kategori');
     $row = $query->row();

     unlink("./assets/img/$row->gambar_kategori");

     $this->db->delete('kategori', array('id_kategori' => $id_kategori));
	}

  	public function getKodeKategori()
  	{
    	$q = $this->db->query("select MAX(RIGHT(id_kategori,3)) as kd_max from kategori");
	    $kd = "";
	    if($q->num_rows() > 0)
	    {
	      foreach ($q->result() as $k) 
	      {
	        $tmp = ((int)$k->kd_max)+1;
	        $kd = sprintf("%03s",$tmp);
	      }
	    } else
	    {
	      $kd = "001";
	    }
	    return "KT".$kd;
  	}

////////////////////END-KATEGORI////////////////////////



////////////////////START-BARANG////////////////////////

	public function InsertBarang($data)
	{
		$checkinsert = false;
		try{
			$this->db->insert('barang',$data);
			$checkinsert = true;
		}catch (Exception $ex) {
			$checkinsert = false;
		}
		return $checkinsert;
	}

	public function InsertDetilBarang($data)
	{
		$checkinsert = false;
		try{
			$this->db->insert('detil_barang',$data);
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

	//fungsi ambil ID dari database
	function get_idBarang($id_barang)
	{
		$this->db->select("*");
		$this->db->where('id_barang', $id_barang);
		$this->db->from("barang");
		return $this->db->get();
	}

	public function updateBarang($data,$where,$table)
	{
		$this->db->where('id_brg',$where);
	    $query = $this->db->get('barang');
	    $row = $query->row();

	    unlink("./assets/img/$row->gambar_barang");

		$this->db->where('id_brg', $where);
		$this->db->update($table,$data);
	}

	public function updateBarang2($data,$where,$table)
	{
		$this->db->where('id_brg', $where);
		$this->db->update($table,$data);
	}

  	public function getKodeBarang()
   	{
	  $q = $this->db->query("select MAX(RIGHT(id_brg,3)) as kd_max from barang");
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
      return "BR".$kd;
    }

    public function deleteBarang($id_brg)
    {

     $this->db->where('id_brg',$id_brg);
     $query = $this->db->get('barang');
     $row = $query->row();

     unlink("./assets/img/$row->gambar_barang");

     $this->db->delete('barang', array('id_brg' => $id_brg));
	}

	public function deleteDetilBarang($id_barang){
      $this->db->where('id_brg', $id_barang);
      $this->db->delete('detil_barang');
    }


	public function joinBarang()
	{
		$result = $this->db->query("SELECT * FROM petani,detil_barang,barang,kategori WHERE detil_barang.id_brg = barang.id_brg and kategori.id_kategori = barang.id_kategori AND detil_barang.id_petani = petani.id_petani;");
    	return $result->result();
	}

////////////////////END-BARANG////////////////////////
}
