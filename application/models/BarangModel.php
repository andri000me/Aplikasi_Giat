<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BarangModel extends CI_Model {

    public function __construct(){
		parent::__construct();
    }
    

////////////////////START-KATEGORI////////////////////////

	public function getAllKategori()
	{
		$result = $this->db->get('kategori');
		return $result->result();
	}

	public function getSort($id)
	{
		$this->db->select('*');
	    $this->db->from('barang');     
	    $this->db->join('kategori','barang.id_kategori = kategori.id_kategori');
	    $this->db->where('barang.id_kategori',$id);       
	    $query = $this->db->get()->result();
	    return $query;


		// $result = $this->db->query("SELECT * FROM barang,kategori WHERE barang.id_kategori = kategori.id_kategori AND barang.id_kategori = '".$id."'");
		// return $result->result();
	}

	 

	//fungsi ambil ID dari database
	public function get_idKategori($id_Kategori)
	{
		$this->db->select("*");
		$this->db->where('id_kategori', $id_Kategori);
		$this->db->from("kategori");
		return $this->db->get();
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

	public function getBarang()
	{
		$this->db->select('*');
 	  	$this->db->from('barang');
  	 	$this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori', 'left');
 	   	$data = $this->db->get();
    	return $data->result();
	}

////////////////////END-BARANG////////////////////////

/////////// searching//////////////////////
function search_blog($title){
	$this->db->like('nm_brg', $title , 'both');
	$this->db->order_by('id_brg', 'ASC');
	$this->db->limit(10);
	return $this->db->get('barang')->result();
}
	/////////akhir searching///////////////////

/////////best seller///////////
public function bestseller()
{
	$no = rand(3,5);
	return $this->db->query("SELECT * from barang WHERE rating = '".$no."' order by rating desc limit 3")->result();
}

////akhir best seller//////////
}
