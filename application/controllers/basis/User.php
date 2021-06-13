	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
			$this->load->model('UserModel');
			$this->load->model('ModelDaftar');
			$this->load->model('M_Customer');
	}

	public function index()
	{
		redirect('Home');
	}
 

	public function InsertDaftar()
	{

		$this->form_validation->set_rules('username','Username','required|max_length[20]|is_unique[login.username]');
		$this->form_validation->set_rules('nm_plg','Nama','required|max_length[50]');
		$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[login.email]');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('password2','Konfirmasi Password','required|matches[password]');
		 
		if($this->form_validation->run() != true){
			$username = $this->session->username;
			$getNm_Plg = $this->ModelDaftar->getNm_Plg($username);
			$id_pesan = $this->UserModel->getKodePesan();
			$nama = $this->session->nm_plg;
			$data = [
				'id_pesan' => $id_pesan,
				'getNm_Plg' => $getNm_Plg,
				'nama' => $nama
			];
			$this->load->view('master/header',$data);
			$this->load->view('view_daftar');
			$this->load->view('master/footer');
		}else{

			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$nama = $this->input->post('nm_plg');
			$email = $this->input->post('email');

			$data = array(
			'username' =>$username,
			'password'=> md5($password),
			'nm_plg'=>$nama,
			'email' => $email

			);

			$result = $this->UserModel->InsertDaftar($data);

			$newdata = array(
				'username'  => $checkUsername->username,
				'name'  => $checkUsername->nama,
				'email'  => $checkUsername->email
			  );

			$this->session->set_userdata($newdata);
			$data = NULL;
				if($result){
					$this->session->set_flashdata('pesan','Data Berhasil Disimpan, Silahkan Login Untuk Masuk');
					redirect('Home/daftar');
				}else{
					$this->session->set_flashdata('pesanGagal','Data Tidak Berhasil Disimpan');
					redirect('Home/daftar');
				}
		}
	}

	//////////////////////proses masuk ke cart///////////////////////
	function add_to_cart(){ //fungsi Add To Cart
		$data = array(
			'id' => $this->input->post('id_brg'), 
			'name' => $this->input->post('nm_brg'), 
			'price' => $this->input->post('harga'), 
			'qty' => $this->input->post('quantity'), 
		);

		$this->cart->insert($data);
		echo $this->show_cart(); //tampilkan cart setelah added
	}

	function load_item(){
		echo $this->cart->total_items();
	}

	function show_cart(){ //Fungsi untuk menampilkan Cart

		$output = '';
		$no = 0;
		
	//	print_r($this->cart->contents()); die();
		foreach ($this->cart->contents() as $items) {
			$no++;
			$output .= 
			'
				<tr>
					<td>'.$items['name'].'</td>
					<td>'.number_format($items['price']).'</td>
					<td>'.$items['qty'].'</td>
					<td>'.number_format($items['subtotal']).'</td>
					<td><button onClick="refreshPage()" type="button" id="'.$items['rowid'].'" class="hapus_cart btn btn-danger btn-xs">Batal</button></td>
				</tr>
			';
		}
		$output .= '
			<tr>
				<th colspan="3">Total</th>
				<th colspan="2">'.'Rp '.number_format($this->cart->total()).'</th>
			</tr>
		';
		return $output;
	}

	function load_cart(){ //load data cart
		echo $this->show_cart();
	}

	function hapus_cart(){ //fungsi untuk menghapus item cart
		$data = array(
			'rowid' => $this->input->post('row_id'), 
			'qty' => 0, 
		);
		$this->cart->update($data);
		echo $this->show_cart();
	}

	function pesan_cart(){ //fungsi untuk memesan item via cart
		
		$nama = $this->session->username;
		if($nama == null)
		{
			redirect('Login');
		} else {
			
			$pelanggan = $this->UserModel->getTablePelanggan($nama);
			if($pelanggan == null)
			{
			 echo "<script type='text/javascript'>
                    alert ('Data Anda Belum Lengkap, Silahkan Lengkapi Terlebih Dahulu !');
                    window.location.replace('http://localhost/panenpangan/DaftarLengkap');
                    </script>";   

			} else {
		$id_pesan = $this->input->post('id_pesan');
		
		$cart = $this->cart->contents();
		foreach($cart as $item){
		
		$id_pesan++;
	 	$tgl=date('Y-m-d');

		  $data = array(
			'id_pesan'=> $id_pesan,
			'id_brg' => $item['id'],
			'qty' => $item['qty'],
			'harga_total' => $item['subtotal'],
			'poin' => 0,
			'status' => "Dalam Perjalanan",
			'status_bayar' => "Belum Bayar"
		  );
		  $result = $this->UserModel->detilpesan($data);

		  $data = array(
			'id_pesan'=> $id_pesan,
			'tgl_pesan' => $tgl,
			'username' => $nama
			);        
	
		 $result2 = $this->UserModel->pesan($data);

			}
	  $this->cart->destroy();
	  redirect('User/invoice');
			}
		}
	}

	/////////////////////pesan barang///////////////////////////////////
	public function pesan($id, $harga) {

		$nama = $this->session->username;
		$username = $this->session->username;

		if($nama == null)
		{
			echo "<script type='text/javascript'>
                    alert ('Anda Harus Login Terlebih Dahulu');
                    window.location.href='http://localhost/panenpangan/Login';
                    </script>";
		} else {

			$pelanggan = $this->UserModel->getTablePelanggan($nama);
			if($pelanggan == null)
			{
			 echo "<script type='text/javascript'>
                    alert ('Data Anda Belum Lengkap, Silahkan Lengkapi Terlebih Dahulu !');
                    window.location.replace('http://localhost/panenpangan/DaftarLengkap');
                    </script>";   

			} else {
				$tgl=date('Y-m-d');

		        $qty = $this->input->post('qty');
				$id_pesan = $this->input->post('id_pesan');
				$point = $this->M_Customer->getPoint($username);
				$data['point'] = $point;

				if($qty <= 0)
				{
					echo "<script type='text/javascript'>
                    alert ('Anda Memesan Dibawah QTY !');
                    window.location.replace('http://localhost/panenpangan/C_DaftarBarang/');
                    </script>"; 
				} else {
					$hargatotal = $harga*$qty;
				foreach($point as $data):
					if($data->poin >= 100 && $hargatotal >= 50000){
						$harga = $harga*$qty-50000;
						$result3 = $this->M_Customer->update($username);
					}else{
						$harga = $hargatotal;
					}
				endforeach;
		            $data = array(
		                'id_pesan'=> $id_pesan,
		                'id_brg' => $id,
		                'qty' => $qty,
		                'harga_total' => $harga,
		                'poin' => 0,
		                'status' => "Dalam Perjalanan",
		                'status_bayar' => "Belum Bayar"
		                );
		      
		        $result = $this->UserModel->detilpesan($data);
			 
			 	$data = array(
				'id_pesan'=> $id_pesan,
				'tgl_pesan' => $tgl,
				'username' => $nama
				);        

				$result2 = $this->UserModel->pesan($data);
		        
		        $data = NULL;
		        if($result && $result2){
		                    echo "<script type='text/javascript'>
		                    alert ('Sending Request !');
		                    window.location.redirect('User/invoice');
		                    </script>";
		                    redirect('User/invoice');
		        }else{
		                    echo "<script type='text/javascript'>
		                    alert ('Sending Failed, silahkan Login dulu !');
		                    window.location.replace('index');
		                    </script>";       
		                    redirect('Home');
		        	}
				}
			}
		}
	}

	public function invoice(){

		$nama = $this->session->nm_plg;
		$username = $this->session->username;
		$point = $this->M_Customer->getPoint($username);
		$getNm_Plg = $this->ModelDaftar->getNm_Plg($username);
		$invoice = $this->UserModel->invoice($username);
		$kwitansi = $this->UserModel->kwitansi($username);
		
		$data['point'] = $point;
		$data['idpesan'] = $invoice;
		$data['kwitansi'] = $kwitansi;
		$data['nama'] = $nama;
		$data['getNm_Plg'] = $getNm_Plg;
		$data['id_pesan'] = $this->UserModel->getKodePesan();

		$this->load->view('master/header',$data);
        $this->load->view('view_bayar',$data);
        $this->load->view('master/footer');			

	}

	public function bayar($id){

		$username = $this->session->username;
		$invoice = $this->UserModel->invoiceEmail($username,$id);

		$encrypted_id = md5($id);

		$this->load->library('email');
		$config = array();
	    $config['charset'] = 'utf-8';
	    $config['useragent'] = 'Codeigniter';
	    $config['protocol']= "smtp";
	    $config['mailtype']= "html";
	    $config['smtp_host']= "ssl://smtp.gmail.com";
	    $config['smtp_port']= "465";
	    $config['smtp_timeout']= "400";
	    $config['smtp_user']= "verifikasi802@gmail.com";
	    $config['smtp_pass']= "admin123@"; 
	    $config['crlf']="\r\n";  
	    $config['newline']="\r\n"; 
	    $config['wordwrap'] = TRUE;

	    $this->email->initialize($config);
	    //konfigurasi pengiriman
	    $this->email->from($config['smtp_user']);
	    $this->email->to("zackyburhani99@gmail.com");
	    $this->email->subject("Pemesanan Barang");

	    foreach ($invoice as $data) {
	    	$this->email->message(
		     "<b>Pemesanan Barang !!</b><br><br>".
		     "<table>".
			     "<tr>".
			     	"<td>"."Kode Pesan"."</td>".
			     	"<td>".": "."</td>".
			     	"<td>".$data->id_pesan."</td>".
			     "</tr>".
			     "<tr>".
			     	"<td>"."Nama Pembeli"."</td>".
			     	"<td>".": "."</td>".
			     	"<td>".$data->nm_plg."</td>".
			     "</tr>".
			     "<tr>".
			     	"<td>"."Alamat"."</td>".
			     	"<td>".": "."</td>".
			     	"<td>".$data->alamat."</td>".
			     "</tr>".
			     "<tr>".
			     	"<td>"."No. Telp"."</td>".
			     	"<td>".": "."</td>".
			     	"<td>".$data->no_telp."</td>".
			     "</tr>".
			     "<tr>".
			     	"<td>"."Kode Pos"."</td>".
			     	"<td>".": "."</td>".
			     	"<td>".$data->kodepos."</td>".
			     "</tr>".
			     "<tr>".
			     	"<td>"."Barang"."</td>".
			     	"<td>".": "."</td>".
			     	"<td>".$data->nm_brg."</td>".
			     "</tr>".
			     "<tr>".
			     	"<td>"."QTY"."</td>".
			     	"<td>".": "."</td>".
			     	"<td>".$data->qty."</td>".
			     "</tr>".
			     "<tr>".
			     	"<td>"."Harga"."</td>".
			     	"<td>".": "."</td>".
			     	"<td>"."Rp. ".$data->harga."</td>".
			     "</tr>".
			     "<tr>".
			     	"<td>"."Ongkir"."</td>".
			     	"<td>".": "."</td>".
			     	"<td>"."Rp. ".$data->ongkir."</td>".
			     "</tr>".
			     "<tr>".
			     	"<td>"."<b>Harga Total"."<b></td>".
			     	"<td>"."<b>: </b>"."</td>".
			     	"<td>"."<b>Rp. ".$total = $data->harga+$data->ongkir.".00"."</b></td>".
			     "</tr>".
		     "</table>".

		     "<br><br>".

		     "<table>".
			     "<tr>".
			     	"<td>"."Nama Petani"."</td>".
			     	"<td>".": "."</td>".
			     	"<td>".$data->nm_petani."</td>".
			     "</tr>".
			     "<tr>".
			     	"<td>"."ID Petani"."</td>".
			     	"<td>".": "."</td>".
			     	"<td>".$data->id_petani."</td>".
			     "</tr>".
		     "</table>".

		     "<br>"."<i>Silahkan Klik Link Berikut Untuk Verifikasi Pembayaran : </i><br><br>".
		     
		      site_url('User/verification/'.$encrypted_id)
		    );		
	    }
	    
	    if($this->email->send())
	    {
	        echo "<script type='text/javascript'>
                    alert ('Silahkan Lakukan Pembayaran ke Nomor Rekening : 1673617283727182 !');
                    window.location.href='http://localhost/panenpangan/User/invoice';
					</script>";
					//redirect('User/invoice');
	    }else
	    {
	        echo "<script type='text/javascript'>
                    alert ('Gagal Melakukan Permintaan Bayar !');
					window.location.href='http://localhost/panenpangan/User/invoice';
                    </script>";
	    }
	  
	    echo "<br><br><a href='".site_url("Home")."'>Kembali ke Home</a>";
	}

	public function verification($key)
	{
		$this->load->helper('url');
		$this->load->model('UserModel');
		$this->UserModel->changeBayar($key);
		$this->UserModel->changePoin($key);
		echo "<script type='text/javascript'>
                    alert ('Status Bayar Telah Dikonfirmasi');
                    window.location.href='http://localhost/panenpangan';
					</script>";
	}

	public function hapus($id_pesan)
	{	
		$this->UserModel->deleteDetilPesan($id_pesan);
		$this->UserModel->deletePesan($id_pesan);
		$this->session->set_flashdata('pesan','Data Berhasil Dihapus');
		redirect('User/invoice');
	}

}
