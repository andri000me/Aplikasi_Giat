<?php
Class Laporan extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->library('Pdf');
        $this->load->model('InputModel');
    }

    function cetakJK(){
        $pdf = new FPDF('l','mm','A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'JADWAL KERJA KARYAWAN',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(42,6,'KODE JADWAL KERJA',1,0);
        $pdf->Cell(70,6,'NAMA KARYAWAN',1,0);
        $pdf->Cell(40,6,'TANGGAL KERJA',1,0);
        $pdf->Cell(25,6,'JAM KERJA',1,1);
        $pdf->SetFont('Arial','',10);
        $this->db->select('*');
        $this->db->from('jadwal_kerja');     
        $this->db->join('daftar_karyawan','jadwal_kerja.karyawankd_karyawan = daftar_karyawan.kd_karyawan');      
        $kerja = $this->db->get()->result();
        foreach ($kerja as $row){
            $pdf->Cell(42,6,$row->kd_jadwal_kerja,1,0);
            $pdf->Cell(70,6,$row->nama,1,0);
            $pdf->Cell(40,6,$row->tgl,1,0);
            $pdf->Cell(25,6,$row->jam_kerja,1,1); 
        }
        $pdf->Output();
       
    }
    
    public function cetakJU(){
        $pdf = new FPDF('l','mm','A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'DAFTAR JADWAL UKUR',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(32,6,'KODE JADWAL UKUR',1,0);
        $pdf->Cell(30,6,'NAMA CUSTOMER',1,0);
        $pdf->Cell(27,6,'TANGGAL UKUR',1,0);
        $pdf->Cell(17,6,'JAM UKUR',1,0);
        $pdf->Cell(35,6,'LOKASI',1,0);
        $pdf->Cell(29,6,'NO.TLP CUSTOMER',1,0);
        $pdf->Cell(25,6,'PETUGAS UKUR',1,1);
        $pdf->SetFont('Arial','',8);
        $this->db->select('*');
        $this->db->from('jadwal_ukur');     
        $this->db->join('daftar_customer','jadwal_ukur.customerkd_customer = daftar_customer.kd_customer');
        $this->db->join('daftar_karyawan','jadwal_ukur.karyawankd_karyawan = daftar_karyawan.kd_karyawan');    
        $ukur = $this->db->get()->result();
        foreach ($ukur as $row){
            $pdf->Cell(32,6,$row->kd_jadwal_ukur,1,0);
            $pdf->Cell(30,6,$row->nama_customer,1,0);
            $pdf->Cell(27,6,$row->tgl_ukur,1,0);
            $pdf->Cell(17,6,$row->jam_ukur,1,0);
            $pdf->Cell(35,6,$row->alamat_customer,1,0);
            $pdf->Cell(29,6,$row->no_tlp_customer,1,0);
            $pdf->Cell(25,6,$row->nama,1,1); 
        }
        $pdf->Output();
       
    }

    public function cetakBR(){
        $pdf = new FPDF('l','mm','A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'LAPORAN DAFTAR BARANG',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(25,6,'KODE BARANG',1,0);
        $pdf->Cell(50,6,'NAMA BARANG',1,0);
        $pdf->Cell(25,6,'STOK BARANG',1,0);
        $pdf->Cell(75,6,'KETERANGAN',1,1);
        $pdf->SetFont('Arial','',8);
        $this->db->select('*');
        $this->db->from('barang');     
        $barang = $this->db->get()->result();
        foreach ($barang as $row){
            $pdf->Cell(25,6,$row->kd_barang,1,0);
            $pdf->Cell(50,6,$row->nama_barang,1,0);
            $pdf->Cell(25,6,$row->stok,1,0);
            $pdf->Cell(75,6,$row->keterangan,1,1);
        }
        $pdf->Output();
       
    }

    public function cetakOJ(){
        $pdf = new FPDF('l','mm','A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'LAPORAN OJEK ONLINE',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(30,6,'KODE PERJALANAN',1,0);
        $pdf->Cell(35,6,'NAMA KARYAWAN',1,0);
        $pdf->Cell(35,6,'TITIK AWAL',1,0);
        $pdf->Cell(35,6,'TUJUAN',1,0);
        $pdf->Cell(25,6,'TGL TRIP',1,0);
        $pdf->Cell(31,6,'BIAYA PERJALANAN',1,1);
        $pdf->SetFont('Arial','',8);
        $this->db->select('*');
        $this->db->from('trip_ojek');    
        $this->db->join('daftar_karyawan','trip_ojek.karyawankd_karyawan = daftar_karyawan.kd_karyawan');  
        $barang = $this->db->get()->result();
        foreach ($barang as $row){
            $pdf->Cell(30,6,$row->kd_perjalanan,1,0);
            $pdf->Cell(35,6,$row->nama,1,0);
            $pdf->Cell(35,6,$row->titik_awal,1,0);
            $pdf->Cell(35,6,$row->tujuan,1,0);
            $pdf->Cell(25,6,$row->tgl_trip,1,0);
            $pdf->Cell(31,6,number_format($row->harga),1,1);
        }

        $jumlah = $this->db->query("SELECT harga,SUM(harga) as totalAll FROM trip_ojek INNER JOIN daftar_karyawan ON trip_ojek.karyawankd_karyawan = daftar_karyawan.kd_karyawan")->result();
        
        foreach ($jumlah as $row){
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(150,20,'TOTAL KESELURUHAN',0,0, 'R');
            $pdf->Cell(10,20,': Rp',0,0);
            $pdf->Cell(50,20,number_format($row->totalAll),0,0);
        }

        $pdf->Output();
       
    }

    public function cetakLP($kp){
        $pdf = new FPDF('l','mm','A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'LAPORAN PENJUALAN BARANG',0,1,'C');
        $pdf->SetFont('Arial','B',12);

        $getReport = $this->db->query("SELECT no_tlp_customer,alamat_customer,nama_customer,total,SUM(total) as totalAll FROM penjualan INNER JOIN daftar_customer INNER JOIN barang ON penjualan.barangkd_barang = barang.kd_barang 
        AND penjualan.customerkd_customer = daftar_customer.kd_customer WHERE customerkd_customer = '$kp'")->result();
         
          // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFont('Arial','B',10);
       
        $pdf->Cell(40,30,'Nama Customer',0,0);
            $pdf->Cell(10,30,':',0,0);
            foreach ($getReport as $data){
                $pdf->Cell(10,30,$data->nama_customer,0,1);
            }    
    
            $pdf->Cell(40,-9,'Alamat Customer',0,0);
            $pdf->Cell(10,-9,':',0,0);
            foreach ($getReport as $data2){
                $pdf->Cell(20,-9,$data2->alamat_customer,0,1);
            }
    
            $pdf->Cell(40,30,'No Telepon',0,0);
            $pdf->Cell(10,30,':',0,0);
            foreach ($getReport as $data3){
                $pdf->Cell(20,30,$data3->no_tlp_customer,0,1);
            }

        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(28,6,'KODE PENJUALAN',1,0);
        $pdf->Cell(60,6,'NAMA BARANG',1,0);
        $pdf->Cell(27,6,'JUMLAH BARANG',1,0);
        $pdf->Cell(35,6,'HARGA',1,0);
        $pdf->Cell(40,6,'TOTAL HARGA',1,1);
        $pdf->SetFont('Arial','',8);

        $jual = $this->db->query("SELECT * FROM penjualan INNER JOIN daftar_customer INNER JOIN barang ON penjualan.barangkd_barang = barang.kd_barang 
        AND penjualan.customerkd_customer = daftar_customer.kd_customer WHERE customerkd_customer = '$kp'")->result();
        foreach ($jual as $row){
            $pdf->Cell(28,6,$row->kd_penjualan,1,0);
            $pdf->Cell(60,6,$row->nama_barang,1,0);
            $pdf->Cell(27,6,$row->jumlah_barang,1,0);
            $pdf->Cell(35,6,number_format($row->harga_barang),1,0);
            $pdf->Cell(40,6,number_format($row->total),1,1);
        }

       
        $jumlah = $this->db->query("SELECT total,SUM(total) as totalAll FROM penjualan INNER JOIN daftar_customer INNER JOIN barang ON penjualan.barangkd_barang = barang.kd_barang 
        AND penjualan.customerkd_customer = daftar_customer.kd_customer WHERE customerkd_customer = '$kp'")->result();
        
        foreach ($jumlah as $row){
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(150,20,'TOTAL KESELURUHAN',0,0, 'R');
            $pdf->Cell(10,20,': Rp',0,0);
            $pdf->Cell(50,20,number_format($row->totalAll),0,0);
        }
       

        $pdf->Output();
       
    }

    public function cetakAbsen($ka){
        $pdf = new FPDF('l','mm','A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'LAPORAN ABSENSI KARYAWAN',0,1,'C');
        $pdf->SetFont('Arial','B',12);

        $this->db->select('nama,kd_karyawan,no_tlp,SUM(no_tlp) as telp');
        $this->db->from('jadwal_kerja');     
        $this->db->join('daftar_karyawan','jadwal_kerja.karyawankd_karyawan = daftar_karyawan.kd_karyawan');
        $this->db->where('karyawankd_karyawan',$ka);  
        $getReport = $this->db->get()->result();

          // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFont('Arial','B',10);
       
        $pdf->Cell(40,30,'Nama Karyawan',0,0);
            $pdf->Cell(10,30,':',0,0);
            foreach ($getReport as $data){
                $pdf->Cell(10,30,$data->nama,0,1);
            }    
    
            $pdf->Cell(40,-9,'Kode Karyawan',0,0);
            $pdf->Cell(10,-9,':',0,0);
            foreach ($getReport as $data2){
                $pdf->Cell(20,-9,$data2->kd_karyawan,0,1);
            }
    
            $pdf->Cell(40,30,'No Telepon',0,0);
            $pdf->Cell(10,30,':',0,0);
            foreach ($getReport as $data3){
                $pdf->Cell(20,30,$data3->no_tlp,0,1);
            }

        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(33,6,'KODE JADWAL KERJA',1,0);
        $pdf->Cell(60,6,'TANGGAL KERJA',1,0);
        $pdf->Cell(27,6,'JAM KERJA',1,0);
        $pdf->Cell(35,6,'KETERANGAN',1,1);
        $pdf->SetFont('Arial','',8);

        $jual = $this->db->query("SELECT * FROM jadwal_kerja WHERE karyawankd_karyawan = '$ka'")->result();
        foreach ($jual as $row){
            $pdf->Cell(33,6,$row->kd_jadwal_kerja,1,0);
            $pdf->Cell(60,6,$row->tgl,1,0);
            $pdf->Cell(27,6,$row->jam_kerja,1,0);
            $pdf->Cell(35,6,$row->keterangan,1,1);
        }

       
        $jumlah = $this->db->query("SELECT keterangan,COUNT(IF(keterangan = 'hadir',1,null)) AS total_masuk,COUNT(IF(keterangan = 'tidak hadir',1,null)) AS total_tidakmasuk FROM jadwal_kerja WHERE karyawankd_karyawan = '$ka'")->result();
        
        foreach ($jumlah as $row){
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell 40,20,'Total Masuk',0,0,;
            $pdf->Cell(10,20,':',0,0);
            $pdf->Cell(50,20,$row->total_masuk,0,0);
        }

        foreach ($jumlah as $row){
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(40,20,'TOTAL TIDAK MASUK',0,0,);
            $pdf->Cell(10,20,':',0,0);
            $pdf->Cell(50,20,$row->total_tidakmasuk,0,0);
        }
       

        $pdf->Output();
       
    }

    public function cetakSurvey($ks){
        $pdf = new FPDF('l','mm','A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'LAPORAN HASIL SURVEY',0,1,'C');
        $pdf->SetFont('Arial','B',12);

        $this->db->select('no_tlp,nama,nama_customer,alamat_customer,kd_jadwal_ukur,no_tlp_customer,SUM(no_tlp_customer) as telp');
        $this->db->from('hasil_survey');     
        $this->db->join('jadwal_ukur','hasil_survey.ukurkd_jadwal_ukur = jadwal_ukur.kd_jadwal_ukur');
        $this->db->join('daftar_customer','jadwal_ukur.customerkd_customer = daftar_customer.kd_customer');
        $this->db->join('daftar_karyawan','jadwal_ukur.karyawankd_karyawan = daftar_karyawan.kd_karyawan');
        $this->db->where('ukurkd_jadwal_ukur',$ks);  
        $getReport = $this->db->get()->result();

          // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFont('Arial','B',10);
       
        $pdf->Cell(40,30,'Nama Customer',0,0);
        $pdf->Cell(10,30,':',0,0);
        foreach ($getReport as $data){
            $pdf->Cell(10,30,$data->nama_customer,0,1);
        }    

        $pdf->Cell(40,-9,'Alamat Customer',0,0);
        $pdf->Cell(10,-9,':',0,0);
        foreach ($getReport as $data2){
            $pdf->Cell(20,-9,$data2->alamat_customer,0,1);
        }

        $pdf->Cell(40,30,'No.Telp Customer',0,0);
        $pdf->Cell(10,30,':',0,0);
        foreach ($getReport as $data3){
            $pdf->Cell(20,30,$data3->no_tlp_customer,0,1);
        }

        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(150,-75,'Petugas',0,0,'R');
        $pdf->Cell(10,-75,':',0,0,'R');
        foreach ($getReport as $data3){
            $pdf->Cell(20,-75,$data3->nama,0,1);
        }

        $pdf->Cell(150,85,'No.Telp Petugas',0,0,'R');
        $pdf->Cell(10,86,':',0,0,'R');
        foreach ($getReport as $data3){
            $pdf->Cell(10,85,$data3->no_tlp,0,1);
        }



        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(35,6,'NAMA BARANG',1,0);
        $pdf->Cell(23,6,'UKURAN',1,0);
        $pdf->Cell(15,6,'JUMLAH',1,0);
        $pdf->Cell(25,6,'HARGA LOKAL',1,0);
        $pdf->Cell(35,6,'SUB TOTAL LOKAL',1,0);
        $pdf->Cell(25,6,'HARGA IMPORT',1,0);
        $pdf->Cell(35,6,'SUB TOTAL IMPORT',1,1);
        $pdf->SetFont('Arial','',8);

        $survey = $this->InputModel->getSurvey($ks);
        foreach ($survey as $row){
            $pdf->Cell(35,6,$row->nama_brg,1,0);
            $pdf->Cell(23,6,$row->ukuran,1,0);
            $pdf->Cell(15,6,$row->jumlah,1,0);
            $pdf->Cell(25,6,number_format($row->harga_lokal),1,0);
            $pdf->Cell(35,6,number_format($row->sub_total_lokal),1,0);
            $pdf->Cell(25,6,number_format($row->harga_import),1,0);
            $pdf->Cell(35,6,number_format($row->sub_total_import),1,1);
        }

       
         $jumlah = $this->db->query("SELECT SUM(sub_total_lokal) as total_lokal,SUM(sub_total_import) as total_import FROM hasil_survey WHERE ukurkd_jadwal_ukur = '$ks'")->result();
        
        foreach ($jumlah as $row){
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(70,10,'TOTAL KESELURUHAN HARGA LOKAL',0,0,);
            $pdf->Cell(10,10,': Rp',0,0);
            $pdf->Cell(50,10,number_format($row->total_lokal),0,1);
        }

        foreach ($jumlah as $row){
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(70,10,'TOTAL KESELURUHAN HARGA IMPORT',0,0,);
            $pdf->Cell(10,10,': Rp',0,0);
            $pdf->Cell(50,10,number_format($row->total_import),0,1);
        }
       

        $pdf->Output();
       
    }

    public function uploadPenjualan()
    {
        // Load plugin PHPExcel nya
        include APPPATH.'third_party\PHPExcel\PHPExcel\PHPExcel.php';

        $config['upload_path'] = realpath('excel');
        $config['allowed_types'] = 'xlsx|xls|csv';
        $config['max_size'] = '10000';
        $config['encrypt_name'] = true;
        $config['overwrite'] = true; 

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {

            //upload gagal
            $this->session->set_flashdata('notif', '<div class="alert alert-danger"><b>PROSES IMPORT GAGAL!</b> '.$this->upload->display_errors().'</div>');
            //redirect halaman
            redirect('Dashboard/approvePenjualan');

        } else {

            $data_upload = $this->upload->data();

            $excelreader     = new PHPExcel_Reader_Excel2007();
            $loadexcel         = $excelreader->load('excel/'.$data_upload['file_name']); // Load file yang telah diupload ke folder excel
            $sheet             = $loadexcel->getActiveSheet()->toArray(true, true, true ,true ,true, true, true ,true);

            $data = array();

            $numrow = 1;
            foreach($sheet as $row){
                            if($numrow > 1){
                                array_push($data, array(
                                    'kd_penjualan' => $row['A'],
                                    'jumlah_barang'      => $row['B'],
                                    'harga_barang'      => $row['C'],
                                    'total'      => $row['D'],
                                    'waktu_kirim'      => $row['E'],
                                    'karyawankd_karyawan'      => $row['F'],
                                    'customerkd_customer'      => $row['G'],
                                    'barangkd_barang'      => $row['H'],
                                ));
                    }
                $numrow++;
            }
            $this->db->insert_batch('penjualan', $data);
            //delete file from server
            unlink(realpath('excel/'.$data_upload['file_name']));

            //upload success
            $this->session->set_flashdata('notif', '<div class="alert alert-success"><b>PROSES IMPORT BERHASIL!</b> Data berhasil diimport!</div>');
            //redirect halaman
            redirect('Dashboard/approvePenjualan');

        }
    }

}