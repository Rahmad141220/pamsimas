<?php
Class Laporanpdf extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->library('pdf');
    }
    function pdf_laporan_angket_tentor()
    
    {
        $pdf = new FPDF('L','mm','A4'); //L = lanscape P= potrait
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        $ya = 44;
        // mencetak string 
        $pdf->Cell(190,7,'Laporan data pelanggan',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'Angket Semester 2 TA 2017-2018',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(15,6,'id',1,0);
        $pdf->Cell(55,6,'no',1,0);
        $pdf->Cell(40,6,'nik',1,0);
        $pdf->Cell(30,6,'nama',1,0);
        $pdf->Cell(35,6,'jenis_kelamin',1,0);
        $pdf->Cell(80,6,'agama',1,1);
        $pdf->Cell(80,6,'no_hp',1,1);
        $pdf->SetFont('pekerjaan','',10);
       
        $data = $this->db->get('tb_pelanggan')->result();
        foreach ($data as $row){
            $pdf->Cell(15,6,$row->id,1,0);
            $pdf->Cell(55,6,$row->no,1,0);
            $pdf->Cell(40,6,$row->nik,1,0);
            $pdf->Cell(30,6,$row->nama,1,0);
            $pdf->Cell(35,6,$row->jenis_kelamin,1,0);
            $pdf->Cell(35,6,$row->agama,1,0);
            $pdf->Cell(80,6,$row->no_hp,1,1);  
        }
        $pdf->Output();
    }