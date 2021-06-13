<?php
Class Laporan extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->library('Pdf');
        $this->load->model('UserModel');
        $this->load->model('ModelDaftar');
    }
    
    public function cetak($id_pesan){
        $username = $this->session->username;

        $pdf = new FPDF('l','mm','A5');
        // membuat halaman baru 
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        //cetak gambar
        $pdf->Image('assets/img/img/logo/apple-icon-114x114.png',8,8);
        // mencetak string 
        $pdf->Cell(190,20,'Kwitansi Pembayaran',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(20,30,'Nama',0,0);
        $pdf->Cell(10,30,':',0,0);
        $getReport = $this->ModelDaftar->getReport($username,$id_pesan);
        foreach ($getReport as $data){
            $pdf->Cell(10,30,$data->nm_plg,0,1);
        }    

        $pdf->Cell(20,-9,'Alamat',0,0);
        $pdf->Cell(10,-9,':',0,0);
        foreach ($getReport as $data2){
            $pdf->Cell(20,-9,$data2->alamat,0,1);
        }

        $pdf->Cell(20,30,'No Telepon',0,0);
        $pdf->Cell(10,30,':',0,0);
        foreach ($getReport as $data3){
            $pdf->Cell(20,30,$data3->no_telp,0,1);
        }

        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(150,-75,'ID Pesan',0,0,'R');
        $pdf->Cell(10,-75,':',0,0,'R');
        foreach ($getReport as $data3){
            $pdf->Cell(20,-75,$data3->id_pesan,0,1);
        }

        $pdf->Cell(150,100,'Status Kiriman',0,0,'R');
        $pdf->Cell(10,100,':',0,0,'R');
        foreach ($getReport as $data3){
            $pdf->Cell(10,100,$data3->status,0,1);
        }

        $pdf->Cell(150,-79,'Status Bayar',0,0, 'R');
        $pdf->Cell(10,-79,':',0,0,'R');
        foreach ($getReport as $data3){
            $pdf->Cell(10,-79,$data3->status_bayar,0,0);
        }

        $pdf->SetFont('Arial','',10);
        $pdf->Cell(10,-30,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'No',1,0);
        $pdf->Cell(50,6,'Nama Barang',1,0);
        $pdf->Cell(20,6,'QTY',1,0);
        $pdf->Cell(40,6,'Harga',1,0);
        $pdf->Cell(40,6,'Ongkir',1,0);
        $pdf->Cell(30,6,'Jumlah',1,1);
        $pdf->SetFont('Arial','',10);
        
        $no = 1;
        $kwitansi = $this->ModelDaftar->getReport($username,$id_pesan);
        foreach ($kwitansi as $row){
            $pdf->Cell(10,6,$no++.".",1,0);
            $pdf->Cell(50,6,$row->nm_brg,1,0);
            $pdf->Cell(20,6,$row->qty,1,0);
            $pdf->Cell(40,6,$row->harga,1,0);
            $pdf->Cell(40,6,$row->ongkir,1,0);
            $pdf->Cell(30,6,$total = $row->harga_total+$row->ongkir.".00",1,1);

            $a['total'] = $total;

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(150,20,'TOTAL',0,0, 'R');
            $pdf->Cell(10,20,':',0,0);
            $pdf->Cell(50,20,array_sum($a).".00",0,0);
            $pdf->Output();
        }

            
    }


    public function bacaexcel()
    {
        $file = APPPATH.'wisudamhsw.xls';
        $this->load->library('excel');
     
        $objPHPExcel = PHPExcel_IOFactory::load($file);
     
        // Ambil koleksi cell saja
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
     
        // Copy ke array semua cell nya
        $data = array();
        foreach ($cell_collection as $cell) {
     
            $kolom = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
            $baris = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
            $isi   = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
     
            if ($baris == 1) {
                $header[$kolom] = $isi;
            } else if ($baris >= 1) {
                $data[$baris][$kolom] = $isi;
            }
     
        }
     
        // Untuk keperluan demo, saya tidak pakai view
        print "<table border='1' cellpadding='5'>";
        print "<tr>";
        foreach ($header as $h) {
            print "<td><b>$h</b></td>";
        }
        print "</tr>";
        foreach($data as $bar) {
            print "<tr>";
            foreach ($bar as $kol) {
                print "<td>$kol</td>";
            }
            print "</tr>";
        }
        print "</table>"; 
    }

    public function buatexcel()
    {
        $this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Worksheet1');
        $this->excel->getActiveSheet()->setCellValue('A1', 'Halo CodeIgniter Indonesia');
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setName("Calibri");
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
     
        $filename='wisudawan23.xls'; 
     
        // Header file Excel
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); 
     
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
     
        // Agar output didownload
        $objWriter->save('php://output');
    }


}