<?php
Class Laporanpdf extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->library('pdf');
    }
    
    function index(){
        $pdf = new FPDF('l','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'LAPORAN DATA PELANGGAN',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
    
        $pdf->Cell(8,6,'no',1,0);
        $pdf->Cell(50,6,'nik',1,0);
        $pdf->Cell(50,6,'nama',1,0);
        $pdf->Cell(30,6,'tgl lahir',1,0);
        $pdf->Cell(35,6,'jenis kelamin',1,0);
        $pdf->Cell(25,6,'agama',1,0);
        $pdf->Cell(25,6,'pekerjaan',1,0);
        $pdf->Cell(40,6,'no hp',1,0);
        $pdf->SetFont('Arial','',10);
        
         
        $data =  $this->db->get('tb_pelanggan')->result();
        $no= 1;
        
        foreach ($data as $row){
             $pdf->Cell(8,6,$no++,1,0);

            $pdf->Cell(50,6,$row->nik,1,0);
            $pdf->Cell(50,6,$row->nama,1,0);
            $pdf->Cell(30,6,$row->tgl_lahir,1,0);
            $pdf->Cell(35,6,$row->jenis_kelamin,1,0);
            $pdf->Cell(25,6,$row->agama,1,0);
            $pdf->Cell(25,6,$row->pekerjaan,1,0);
            $pdf->Cell(40,6,$row->no_hp,1,1); 
        }
        // window.print();
        /// print_r($data);
        $pdf->Output();
    }
    // public function cetak()
    // {
    //     $data ['tb_pelanggan']= $this->M_pamsimas->cetak_pdf($data)
    //     $this->load
      
    // }
       
}


