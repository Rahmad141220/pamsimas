<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controller extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('session');
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('logged_in') !== true) {
            $this->session->set_flashdata('');
            redirect('C_login');
        }
        }

    public function Dashbord()
    {
        $data = array(
            'total_laporan' => $this->M_pamsimas->hitung_database('tb_meteran')->num_rows(),
            'jumlah_belum_bayar' => $this->M_pamsimas->jumlah_belum_bayar()->num_rows(),
            'jumlah_bayar' => $this->M_pamsimas->Jumlah_bayar()->num_rows(),
            'total_bayar' => $this->M_pamsimas->total_bayar(),
            'total_penduduk' => $this->M_pamsimas->hitung_database('tb_meteran')->num_rows(),
        );
        // $data['jumlah']= $this->M_pamsimas->get_data('tb_pelanggan')->num_rows();
        $this->load->view('Head');
        $this->load->view('Dashbord',$data);
        $this->load->view('Footer');
        // /print_r($data);

    }
    public function Chart()
    {
        $this->load->view('Head');
        $this->load->view('Chart');
        $this->load->view('Footer');

    }
    public function V_pelanggan()
    {
        $this->load->view('Head');
        $this->load->view('V_pelanggan');
        $this->load->view('Footer');
    }
    public function V_meteran()
    {
        $this->load->view('head');
        $this->load->view('V_meteran');
        $this->load->view('Footer');
    }
    public function V_tagihan()
    {
        $this->load->view('head');
        $this->load->view('V_tagihan');
        $this->load->view('Footer');
    }
 
    public function simpan_pelanggan()
    {
        $nik=$this->input->post('nik');
        
        $data=array(
            'nik' => $nik,
            'nama' => $this->input->post('nama'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'agama' => $this->input->post('agama'),
            'pekerjaan' => $this->input->post('pekerjaan'),
            'no_hp' => $this->input->post('no_hp'),
            'meter_awal'=>'0'
        );
        $data1=array(
            'nama' => $this->input->post('nama'),
            'username' => $nik,
            'password' => md5 ($nik),
            'level' => 'user',
        );
        // koding check nik
        $check_nik=$this->M_pamsimas->find_data('tb_pelanggan','nik',$nik);

        if ($check_nik->num_rows()>0) {
            $this->session->set_flashdata('error', 'Maaf NIK Tersebut telah terdaftar di sistem, Tiap Nik Hanya dapat mendaftar 1 x');
            redirect('controller/v_pelanggan');
        }
        else {
            $this->session->set_flashdata('success', 'Pelanggan Berhasil di daftarkan');
            // print_r($data);
            $this->M_pamsimas->Model_simpan($data);
            // model user
            $this->M_pamsimas->Simpan_user($data1);
            // echo ('berhasil');
            redirect('controller/v_pelanggan');
        }
       
        
    }
    public function find_nik()
    {
        $nik=$this->input->get('nik');
        // $nik='97';
        $find=$this->M_pamsimas->find_data('tb_pelanggan','nik',$nik);
        if ($find->num_rows()>0) {
            $hasil=$find->row_array();
            $data=[
                'nama'=>$hasil['nama'],
                'tgl_lahir'=>$hasil['tgl_lahir'],
                'jenis_kelamin'=>$hasil['jenis_kelamin'],
                'agama'=>$hasil['agama'],
                'pekerjaan'=>$hasil['pekerjaan'],
                'no_hp'=>$hasil['no_hp'],
                'meter_awal'=>$hasil['meter_awal']
            ];
        }
        echo json_encode($data);
    }
    public function find_data_pembayaran()
    {
        $nik=$this->input->get('nik');
         //$nik='2';
        $find=$this->M_pamsimas->find_data('tb_pelanggan','nik',$nik);
        if ($find->num_rows()>0) {
            $hasil=$find->row_array();
            $total=$this->M_pamsimas->hitung_bayar($nik)->result_array();
            foreach ($total as $value) {
                $jumlah[]=[
                    'total_bayar'=>$value['total_bayar']
                ];
            }
            $sumArray=array();
            foreach ($jumlah as $k => $subArray) {
                foreach ($subArray as  $value) {
                    $sumArray[]+=$value;
                    $total_tagihan=array_sum($sumArray);
                }
            }
            $data=[
                'nama'=>$hasil['nama'],
                'tgl_lahir'=>$hasil['tgl_lahir'],
                'jenis_kelamin'=>$hasil['jenis_kelamin'],
                'agama'=>$hasil['agama'],
                'pekerjaan'=>$hasil['pekerjaan'],
                'no_hp'=>$hasil['no_hp'],
                'total_tagihan'=>$total_tagihan
            ];
        }
        //print_r($total_bayar);
        echo json_encode($data);
    }
    public function bayar_tagihan()
    {
        $nik=$this->input->post('nik');
        $total_tagihan=$this->input->post('total_tagihan');
        $total_bayar=$this->input->post('total_bayar');
          $data_nomor=$this->M_pamsimas->find_data('tb_pelanggan','nik',$nik)->row_array();
          $tanggal=$this->M_pamsimas->find_data('tb_meteran','nik',$nik)->row_array();
          $tangal_potong=substr($tanggal['tgl_tagihan'],0,2);
          $tahun_potong=substr($tanggal['tgl_tagihan'],3,4);
        if ($total_tagihan>$total_bayar) {
            $this->session->set_flashdata('error', 'Total Bayar Tidak Boleh Kurang dari Total Tagihan');
            redirect('controller/input_pembayaran');
        } else {

            $object=[
                'status'=>'Sudah',
                'tgl_pembayaran'=>date('d-m-Y'),
            ];
              $pesan='Bapak/Ibuk' . $data_nomor ['nama'] . ' Pembayaran anda Bulan '.$tangal_potong.' Tahun '.$tahun_potong.' Lunas ';
            $this->send_sms($data_nomor['no_hp'],$pesan);
           $this->M_pamsimas->bayar($nik,$object);
           $this->session->set_flashdata('success', 'Pembayaran Berhasil DI Lakukan');
           redirect('controller/input_pembayaran');
        // print_r($pesan);
        }
    }
    public function V_tabelpelanggan()
    {

        $cari_data= $this->M_pamsimas->get_data('tb_pelanggan','id','DESC');
       if ($cari_data->num_rows()>0) {
           $hasil['status_data']='Ada';
           $get_data=$cari_data->result_array();
        foreach ($get_data as $row) {
            $jumlah_tagihan=$this->M_pamsimas->hitungan_sisa_tagihan($row['nik'])->num_rows();
         $data[]=[
             'id'=>$row['id'],
             'nik'=>$row['nik'],
             'nama'=>$row['nama'],
             'tgl_lahir'=>$row['tgl_lahir'],
             'jenis_kelamin'=>$row['jenis_kelamin'],
             'agama'=>$row['agama'],
             'pekerjaan'=>$row['pekerjaan'],
             'no_hp'=>$row['no_hp'],
             'status_tagihan'=>$jumlah_tagihan
         ];
        }
    }
        else {
            $hasil['status_data']="Tidak Ada";
            $data[]=[
                'id'=>"Tidak Ada Data",
                'nik'=>"tidak ada data",
                'nama'=>"tidak ada data",
                'tgl_lahir'=>"tidak ada data",
                'jenis_kelamin'=>"tidak ada data",
                'agama'=>"tidak ada data",
                'pekerjaan'=>"tidak ada data",
                'no_hp'=>"tidak ada data",
                'status_tagihan'=>"tidak ada data",
            ];
        }
       
        $hasil['tb_pelanggan']=$data;
        // print_r($hasil);
        $this->load->view('head');
        $this->load->view('v_tabelpelanggan',$hasil);
        $this->load->view('footer');
    }
    public function editpelanggan($id)
    {
        $data= $this->M_pamsimas->model_edit($id);
        $this->load->view('head');
        $this->load->view('V_editpelanggan',$data);
        $this->load->view('footer');
        // print_r($data);
    }
    public function hapus_data($id)
    {
        $this->M_pamsimas->model_hapus($id);
        
        redirect('controller/V_tabelpelanggan');
        
    }
    public function edit_simpan($id)
    {
       $data=array(
        'nik' => $this->input->post('nik'),
        'nama' => $this->input->post('nama'),
        'tgl_lahir' => $this->input->post('tgl_lahir'),
        'jenis_kelamin' => $this->input->post('jenis_kelamin'),
        'agama' => $this->input->post('agama'),
        'pekerjaan' => $this->input->post('pekerjaan'),
        'no_hp' => $this->input->post('no_hp'),
    );
    $this->M_pamsimas->model_edit_simpan($id,$data);
    
    redirect('controller/V_tabelpelanggan');
    
    }

    // fungsi tabel meteran

    public function simpan_meteran()
    {
        
        $meteran_awal=$this->input->post('meteran_awal');
        $meteran_akhir=$this->input->post('meteran_akhir');
        $bulan=$this->input->post('bulan');
        $tahun=$this->input->post('tahun');
        $total_bayar=$this->input->post('total_bayar');
        
        $tanggal=$bulan.'-'.$tahun;
        $nik=$this->input->post('nik');
    //    sms 
        $data_nomor=$this->M_pamsimas->find_data('tb_pelanggan','nik',$nik)->row_array();
        if ($meteran_akhir<$meteran_awal) {
            $this->session->set_flashdata('error', 'Rekening Akhir tidak Boleh Kecil dari Rekening Awal');
            redirect('controller/v_meteran');
        } else {
            $check_tagihan=$this->M_pamsimas->check_tagihan($nik,$tanggal);
           if ($check_tagihan->num_rows()>0) {
            $this->session->set_flashdata('error', 'Tagihan Sudah Ada');
            redirect('controller/v_meteran');
           } else {
            $data=array(
                'nik'=>$nik,
                'meteran_awal'=>$meteran_awal,
                'meteran_akhir'=>$meteran_akhir,
                'tgl_tagihan'=>$bulan.'-'.$tahun,
                'total_bayar'=>$total_bayar,
                'status'=>'Belum'   
            );
            $data_update=[
                'meter_awal'=>$meteran_awal+$meteran_akhir,
            ];
            // sms
            $pesan='Bapak/Ibuk '.$data_nomor['nama'].' Tagihan anda bulan '.$tanggal.' adalah '.$total_bayar;
            $this->send_sms($data_nomor['no_hp'],$pesan);
            $this->M_pamsimas->create_data('tb_meteran',$data);
            $this->M_pamsimas->update_data('tb_pelanggan','nik',$nik,$data_update);
            $this->session->set_flashdata('success', 'Tagihan Pelanggan Berhasil di Input');
            
            // print_r($pesan);
            redirect('controller/v_meteran');
           }
           
        }}
        public function terbilang($nilai) {
            if($nilai<0) {
                $hasil = "minus ". trim($this->penyebut($nilai));
            } else {
                $hasil = trim($this->penyebut($nilai));
            }     		
            return $hasil;
        }
        public function penyebut($nilai) {
            $nilai = abs($nilai);
            $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
            $temp = "";
            if ($nilai < 12) {
                $temp = " ". $huruf[$nilai];
            } else if ($nilai <20) {
                $temp =$this->penyebut($nilai - 10). " belas";
            } else if ($nilai < 100) {
                $temp =$this->penyebut($nilai/10)." puluh".$this->penyebut($nilai % 10);
            } else if ($nilai < 200) {
                $temp = " seratus" .$this->penyebut($nilai - 100);
            } else if ($nilai < 1000) {
                $temp =$this->penyebut($nilai/100) . " ratus" .$this->penyebut($nilai % 100);
            } else if ($nilai < 2000) {
                $temp = " seribu" .$this->penyebut($nilai - 1000);
            } else if ($nilai < 1000000) {
                $temp =$this->penyebut($nilai/1000) . " ribu" .$this->penyebut($nilai % 1000);
            } else if ($nilai < 1000000000) {
                $temp =$this->penyebut($nilai/1000000) . " juta" .$this->penyebut($nilai % 1000000);
            } else if ($nilai < 1000000000000) {
                $temp =$this->penyebut($nilai/1000000000) . " milyar" .$this->penyebut(fmod($nilai,1000000000));
            } else if ($nilai < 1000000000000000) {
                $temp =$this->penyebut($nilai/1000000000000) . " trilyun" .$this->penyebut(fmod($nilai,1000000000000));
            }     
            return $temp;
        }
    public function V_tabelmeteran()
    {
        $cari_data= $this->M_pamsimas->get_data('tb_meteran','id','DESC');
        if ($cari_data->num_rows()>0) {
            $hasil['status']='Ada';
            $get_data=$cari_data->result_array();
         foreach ($get_data as $row) {
             $cari_nama=$this->M_pamsimas->find_data('tb_pelanggan','nik',$row['nik'])->row_array();
             $jumlah_tagihan=$this->M_pamsimas->hitungan_sisa_tagihan($row['nik'])->num_rows();
          $data[]=[
              'id'=>$row['id'],
              'nik'=>$row['nik'],
              'nama'=>$cari_nama['nama'],
              'meteran_awal'=>$row[ 'meteran_awal'],
              'meteran_akhir'=>$row['meteran_akhir'],
              'total_bayar'=>''.number_format($row['total_bayar']),            
              'tgl_tagihan'=>$row['tgl_tagihan'],
              'tgl_pembayaran'=>$row['tgl_pembayaran'],
              'status'=>$row['status'],
          ];
         }
     }
         else {
             $hasil['status']="Tidak Ada";
             $data[]=[
                 'id'=>"Tidak Ada Data",
                 'nik'=>"tidak ada data",
                 'nama'=>"tidak ada data",
                 'meteran_awal'=>"tidak ada data",
                 'meteran_akhir'=>"tidak ada data",
                 'total_bayar'=>"tidak ada data",
                 'tgl_tagihan'=>"tidak ada data",
                 'tgl_pembayaran'=>"tidak ada data",
                 'status'=>"tidak ada data",
             ];
         }
         $jumlah=$this->M_pamsimas->total_bayar();
        $hasil['total']=number_format($jumlah);
        $hasil['terbilang']=$this->terbilang($jumlah).' Rupiah';
         $hasil['tb_meteran']=$data;
        //print_r($hasil);
         $this->load->view('head');
         $this->load->view('v_tabelmeteran',$hasil);
         $this->load->view('footer');
     }
    
 
        // print_r($data);
         public function hapus_meteran($id)
    {
        $this->M_pamsimas->model_hapus_meteran($id);
        
        redirect('controller/V_tabelmeteran');
        
    }
    
    public function editmeteran($id)
    {
        $data= $this->M_pamsimas->model_edit_meteran($id);
        $this->load->view('head');
        $this->load->view('V_editmeteran',$data);
        $this->load->view('footer');
       // print_r($data);
    }

   
    public function edit_simpan_meteran($id)
    {
       $data = array(
        'nik' => $this->input->post('nik'),
        'meteran_awal' => $this->input->post('meteran_awal'),
        'meteran_akhir' => $this->input->post('meteran_akhir'),
        'total_bayar' => $this->input->post('total_bayar'),
        'tgl_tagihan' => $this->input->post('tgl_tagihan'),
        'tgl_pembayaran' => $this->input->post('tgl_pembayaran'),

    );
    $this->M_pamsimas->model_edit_simpan_meteran($id,$data);
    
    redirect('controller/V_tabelmeteran');

    }
    public function println()
    {
        $pdf = new FPDF('l','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        $pdf->Image('assets/image/lambang.png',15,10,20);
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(260,7,'DATA PELANGGAN PAMSIMAS BUMNAG SETANGKAI SUNGAI TARAB',0,1,'C');
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(260,9,'Kecamatan Sungai Tarab Kabupaten Tanah Datar',0,9,'C');
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(260,9,'jln. ps.sungai tarab No. 137 sungai tarab Telp (0752)71150, 574421, 71890 Fax. (0752) 7152',0,9,'C');
        $pdf->Cell(260,1,'','',0,1,'C');
    
        $pdf->Cell(190,7,'',0,1,'C');
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(30,8,'DATA PELANGGAN',0,1,'C');
    
        $pdf->Cell(8,6,'No',1,0);
        $pdf->Cell(50,6,'Nik',1,0);
        $pdf->Cell(45,6,'Nama',1,0);
        $pdf->Cell(25,6,'Tanggal Lahir',1,0);
        $pdf->Cell(30,6,'Jenis Kelamin',1,0);
        $pdf->Cell(25,6,'Agama',1,0);
        $pdf->Cell(25,6,'Pekerjaan',1,0);
        $pdf->Cell(30,6,'Nomor Hp',1,0);
        $pdf->Cell(30,6,'Status Tagihan',1,1);
        $pdf->SetFont('Arial','',10);

        

        $cari_data= $this->M_pamsimas->get_data('tb_pelanggan','id','DESC');
       if ($cari_data->num_rows()>0) {
           $hasil['status_data']='Ada';
           $get_data=$cari_data->result_array();
        foreach ($get_data as $row) {
            $jumlah_tagihan=$this->M_pamsimas->hitungan_sisa_tagihan($row['nik'])->num_rows();
            if ($jumlah_tagihan=='0') {
                $status='Lunas';
            } else {
                $status='Jumlah Tagihan'.$jumlah_tagihan;
            }
            
         $data[]=[
             'id'=>$row['id'],
             'nik'=>$row['nik'],
             'nama'=>$row['nama'],
             'tgl_lahir'=>$row['tgl_lahir'],
             'jenis_kelamin'=>$row['jenis_kelamin'],
             'agama'=>$row['agama'],
             'pekerjaan'=>$row['pekerjaan'],
             'no_hp'=>$row['no_hp'],
             'status_tagihan'=>$status
         ];
        }
    }
        else {
            $hasil['status_data']="Tidak Ada";
            $data[]=[
                'id'=>"Tidak Ada Data",
                'nik'=>"tidak ada data",
                'nama'=>"tidak ada data",
                'tgl_lahir'=>"tidak ada data",
                'jenis_kelamin'=>"tidak ada data",
                'agama'=>"tidak ada data",
                'pekerjaan'=>"tidak ada data",
                'no_hp'=>"tidak ada data",
                'status_tagihan'=>"tidak ada data",
            ];
        }
       
        $hasil['tb_pelanggan']=$data;
        $no= 1;
        
        foreach ($data as $row){
            $pdf->Cell(8,6,$no++,1,0);
            $pdf->Cell(50,6,$row['nik'],1,0);
            $pdf->Cell(45,6,$row['nama'],1,0);
            $pdf->Cell(25,6,$row['tgl_lahir'],1,0);
            $pdf->Cell(30,6,$row['jenis_kelamin'],1,0);
            $pdf->Cell(25,6,$row['agama'],1,0);
            $pdf->Cell(25,6,$row['pekerjaan'],1,0);
            $pdf->Cell(30,6,$row['no_hp'],1,0);
            $pdf->Cell(30,6,$row['status_tagihan'],1,1); 
           
           
        }
        // $tgl= date ('d m y');
        $pdf->Cell(475,20,'Bumnag Sungai Tarab,',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        
     

     
        $pdf->Cell(475,20,'Petugas',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        
     
        $pdf->Output();
    }   
        public function cetak_laporan_pelanggan()
       {
             $this->M_pamsimas->laporan_tabel_pelanggan();
             
             redirect('controller/print');       
        }
     
    public function Input_pembayaran()
    {
        $cari_data= $this->M_pamsimas->get_data('tb_meteran','id','DESC');
        // $data_nomor=$this->M_pamsimas->find_data('tb_pelanggan','nik',$nik)->row_array();
     
        if ($cari_data->num_rows()>0) {
            $hasil['status']='Ada';
            $get_data=$cari_data->result_array();
         foreach ($get_data as $row) {
             $cari_nama=$this->M_pamsimas->find_data('tb_pelanggan','nik',$row['nik'])->row_array();
             $jumlah_tagihan=$this->M_pamsimas->hitungan_sisa_tagihan($row['nik'])->num_rows();
          $data[]=[
              'id'=>$row['id'],
              'nik'=>$row['nik'],
              'nama'=>$cari_nama['nama'],
              'meteran_awal'=>$row[ 'meteran_awal'],
              'meteran_akhir'=>$row['meteran_akhir'],
              'total_bayar'=>$row['total_bayar'],
              'tgl_tagihan'=>$row['tgl_tagihan'],
              'tgl_pembayaran'=>$row['tgl_pembayaran'],
              'status'=>$jumlah_tagihan
          ];
         }
     }
         else {
             $hasil['status']="Tidak Ada";
             $data[]=[
                 'id'=>"Tidak Ada Data",
                 'nik'=>"tidak ada data",
                 'nama'=>"tidak ada data",
                 'meteran_awal'=>"tidak ada data",
                 'meteran_akhir'=>"tidak ada data",
                 'total_bayar'=>"tidak ada data",
                 'tgl_tagihan'=>"tidak ada data",
                 'tgl_pembayaran'=>"tidak ada data",
                 'status'=>"tidak ada data",
             ];
         }
        
         $hasil['tb_meteran']=$data;
            // $pesan='Bapak/Ibuk'$data_nomor['nama'].'Tagihan anda bulan '.$tanggal.'adalah'.$total_bayar;
            // $this->send_sms($data_nomor['no_hp'],$pesan);
        //  print_r($hasil);
        $this->load->view('head');
        $this->load->view('input_pembayaran',$hasil);
        $this->load->view('footer');

    }
    public function tes2()
    {
        $angka=1000000;
        echo number_format($angka);
    }
    public function print_meteran_bulan($data)
    {
        
        //  /print_r($data);
         $pdf = new FPDF('l','mm','A4');
         // membuat halaman baru
         $pdf->AddPage();
         // setting jenis font yang akan digunakan
         $pdf->SetFont('Arial','B',16);
         // mencetak string 
         $pdf->Cell(260,7,'LAPORAN DATA METERAN PERBULAN',0,1,'C');
         $pdf->SetFont('Arial','B',12);
         $pdf->Cell(190,7,'',0,1,'C');
         // Memberikan space kebawah agar tidak terlalu rapat
         $pdf->Cell(10,7,'',0,1);
         $pdf->SetFont('Arial','B',10);
     
         $pdf->Cell(8,6,'no',1,0);
         $pdf->Cell(50,6,'nik',1,0);
         $pdf->Cell(45,6,'nama',1,0);
         $pdf->Cell(25,6,'meteran awal',1,0);
         $pdf->Cell(30,6,'meteran akhir',1,0);
         $pdf->Cell(25,6,'total bayar',1,0);
         $pdf->Cell(25,6,'bulan tagihan',1,0);
         $pdf->Cell(30,6,'tgl pembayaran',1,0);
         $pdf->Cell(40,6,'status tagihan',1,1);
         $pdf->SetFont('Arial','',10);
 
         
 
         $cari_data= $this->M_pamsimas->get_data('tb_meteran','id','DESC');
        if ($cari_data->num_rows()>0) {
            $hasil['status_data']='Ada';
            $get_data=$cari_data->result_array();
            $hasil['status_data']=='Tidak ada';
 
         foreach ($data['v_tabelmeteran'] as $row) {
            
             $jumlah_tagihan=$this->M_pamsimas->hitungan_sisa_tagihan($row['nik'])->num_rows();
             if ($jumlah_tagihan=='0') {
                 $status='Lunas';
             } else {
                 $status='Jumlah Tagihan'.$jumlah_tagihan;
             }
             
          $data2[]=[
              'id'=>$row['id'],
              'nik'=>$row['nik'],
            //   'nama'=>$row['nama'],
              'meteran_awal'=>$row['meteran_awal'],
              'meteran_akhir'=>$row['meteran_akhir'],
              'total_bayar'=> number_format($row['total_bayar']),
              'tgl_tagihan'=>$row['tgl_tagihan'],
              'tgl_pembayaran'=>$row['tgl_pembayaran'],
              'status_tagihan'=>$status
          ];
         }
     }
         else {
             $hasil['status_data']="Tidak Ada";
             $data2[]=[
                 'id'=>"Tidak Ada Data",
                 'nik'=>"tidak ada data",
                 'nama'=>"tidak ada data",
                 'meteran_awal'=>"tidak ada data",
                 'meteran_akhir'=>"tidak ada data",
                 'total_bayar'=>"tidak ada data",
                 'tgl_tagihan'=>"tidak ada data",
                 'tgl_pembayaran'=>"tidak ada data",
                 'status_tagihan'=>"tidak ada data",
             ];
         }
        
         $hasil['tb_meteran']=$data2;
         $no= 1;
         
         foreach ($data2 as $row){
             $pdf->Cell(8,6,$no++,1,0);
             $pdf->Cell(50,6,$row['nik'],1,0);
            //  $pdf->Cell(45,6,$row['nama'],1,0);
             $pdf->Cell(25,6,$row['meteran_awal'],1,0);
             $pdf->Cell(30,6,$row['meteran_akhir'],1,0);
             $pdf->Cell(25,6,number_format($row['total_bayar'],2),1,0);
             $pdf->Cell(25,6,$row['tgl_tagihan'],1,0);
             $pdf->Cell(30,6,$row['tgl_pembayaran'],1,0);
             $pdf->Cell(40,6,$row['status_tagihan'],1,1); 
            
            
         }
         // $tgl= date ('d m y');
         $pdf->Cell(475,20,'Batusangkar',0,1,'C');
         $pdf->SetFont('Arial','B',12);
         
      
 
      
         $pdf->Cell(475,20,'Yahdi Almukaram',0,1,'C');
         $pdf->SetFont('Arial','B',12);
         
      
         $pdf->Output();
    }      
    public function print_meteran()
    {
        $pdf = new FPDF('l','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(260,7,'LAPORAN DATA METERAN',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
    
        $pdf->Cell(8,6,'no',1,0);
        $pdf->Cell(50,6,'nik',1,0);
        $pdf->Cell(45,6,'nama',1,0);
        $pdf->Cell(25,6,'meteran awal',1,0);
        $pdf->Cell(30,6,'meteran akhir',1,0);
        $pdf->Cell(25,6,'total bayar',1,0);
        $pdf->Cell(25,6,'tgl tagihan',1,0);
        $pdf->Cell(30,6,'tgl pembayaran',1,0);
        $pdf->Cell(40,6,'status tagihan',1,1);
        $pdf->SetFont('Arial','',10);

        

        $cari_data= $this->M_pamsimas->get_data('tb_meteran','id','DESC');
       if ($cari_data->num_rows()>0) {
           $hasil['status_data']='Ada';
           $get_data=$cari_data->result_array();
        foreach ($get_data as $row) {
            $jumlah_tagihan=$this->M_pamsimas->hitungan_sisa_tagihan($row['nik'])->num_rows();
            if ($jumlah_tagihan=='0') {
                $status='Lunas';
            } else {
                $status='Jumlah Tagihan'.$jumlah_tagihan;
            }
            
         $data[]=[
             'id'=>$row['id'],
             'nik'=>$row['nik'],
             'nama'=>$row['nama'],
             'meteran_awal'=>$row['meteran_awal'],
             'meteran_akhir'=>$row['meteran_akhir'],
             'total_bayar'=>$row['total_bayar'],
             'tgl_tagihan'=>$row['tgl_tagihan'],
             'tgl_pembayaran'=>$row['tgl_pembayaran'],
             'status_tagihan'=>$status
         ];
        }
    }
        else {
            $hasil['status_data']="Tidak Ada";
            $data[]=[
                'id'=>"Tidak Ada Data",
                'nik'=>"tidak ada data",
                'nama'=>"tidak ada data",
                'meteran_awal'=>"tidak ada data",
                'meteran_akhir'=>"tidak ada data",
                'total_bayar'=>"tidak ada data",
                'tgl_tagihan'=>"tidak ada data",
                'tgl_pembayaran'=>"tidak ada data",
                'status_tagihan'=>"tidak ada data",
            ];
        }
       
        $hasil['tb_meteran']=$data;
        $no= 1;
        
        foreach ($data as $row){
            $pdf->Cell(8,6,$no++,1,0);
            $pdf->Cell(50,6,$row['nik'],1,0);
            $pdf->Cell(45,6,$row['nama'],1,0);
            $pdf->Cell(25,6,$row['meteran_awal'],1,0);
            $pdf->Cell(30,6,$row['meteran_akhir'],1,0);
            $pdf->Cell(25,6,$row['total_bayar'],1,0);
            $pdf->Cell(25,6,$row['tgl_tagihan'],1,0);
            $pdf->Cell(30,6,$row['tgl_pembayaran'],1,0);
            $pdf->Cell(40,6,$row['status_tagihan'],1,1); 
           
           
        }
        // $tgl= date ('d m y');
        $pdf->Cell(475,20,'Batusangkar',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        
     

     
        $pdf->Cell(475,20,'Yahdi Almukaram',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        
     
        $pdf->Output();
        // print_r($data);
    }   
    public function cetak_laporan_meteran()
    {
          $this->M_pamsimas->laporan_tabel_meteran();
          
          redirect('controller/print_meteran');       
     }
      public function tes(){
        // $this->load->M_pamsimas('view');
        $data['tb_pelanggan'] = $this->M_pamsimas->view_row();
        $this->load->view('priview', $data);
      }
      public function faktur()
    {
        $pdf = new FPDF('l','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(260,7,'PAMSIMAS BUMNAG SETANGKAI SUNGAI TARAB',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'',0,1,'C');
        $pdf->Cell(260,7,'Faktur Pembayaran Rekening Air',0,1,'C');
        $pdf->Cell(190,7,'',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
    
        $pdf->Cell(8,6,'no',1,0);
        $pdf->Cell(50,6,'Nik',1,0);
        $pdf->Cell(45,6,'Nama',1,0);
        $pdf->Cell(25,6,'Meteran Awal',1,0);
        $pdf->Cell(30,6,'Meteran Akhir',1,0);
        $pdf->Cell(25,6,'Total Bayar',1,0);
        $pdf->Cell(25,6,'Bulan Tagihan',1,0);
        $pdf->Cell(30,6,'',1,0);
        $pdf->Cell(40,6,'status tagihan',1,1);
        $pdf->SetFont('Arial','',10);

        

        $cari_data= $this->M_pamsimas->get_data('tb_pelanggan','id','DESC');
       if ($cari_data->num_rows()>0) {
           $hasil['status_data']='Ada';
           $get_data=$cari_data->result_array();
        foreach ($get_data as $row) {
            $jumlah_tagihan=$this->M_pamsimas->hitungan_sisa_tagihan($row['nik'])->num_rows();
            if ($jumlah_tagihan=='0') {
                $status='Lunas';
            } else {
                $status='Jumlah Tagihan'.$jumlah_tagihan;
            }
            
         $data[]=[
             'id'=>$row['id'],
             'nik'=>$row['nik'],
             'nama'=>$row['nama'],
             'tgl_lahir'=>$row['tgl_lahir'],
             'jenis_kelamin'=>$row['jenis_kelamin'],
             'agama'=>$row['agama'],
             'pekerjaan'=>$row['pekerjaan'],
             'no_hp'=>$row['no_hp'],
             'status_tagihan'=>$status
         ];
        }
    }
        else {
            $hasil['status_data']="Tidak Ada";
            $data[]=[
                'id'=>"Tidak Ada Data",
                'nik'=>"tidak ada data",
                'nama'=>"tidak ada data",
                'tgl_lahir'=>"tidak ada data",
                'jenis_kelamin'=>"tidak ada data",
                'agama'=>"tidak ada data",
                'pekerjaan'=>"tidak ada data",
                'no_hp'=>"tidak ada data",
                'status_tagihan'=>"tidak ada data",
            ];
        }
       
        $hasil['tb_pelanggan']=$data;
        $no= 1;
        
        foreach ($data as $row){
            $pdf->Cell(8,6,$no++,1,0);
            $pdf->Cell(50,6,$row['nik'],1,0);
            $pdf->Cell(45,6,$row['nama'],1,0);
            $pdf->Cell(25,6,$row['tgl_lahir'],1,0);
            $pdf->Cell(30,6,$row['jenis_kelamin'],1,0);
            $pdf->Cell(25,6,$row['agama'],1,0);
            $pdf->Cell(25,6,$row['pekerjaan'],1,0);
            $pdf->Cell(30,6,$row['no_hp'],1,0);
            $pdf->Cell(40,6,$row['status_tagihan'],1,1); 
           
           
        }
        // $tgl= date ('d m y');
        $pdf->Cell(475,20,'Batusangkar',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        
     

     
        $pdf->Cell(475,20,'Petugas',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        
     
        $pdf->Output();
    
    }   
    public function catak_faktur()
    {
          $this->M_pamsimas->laporan_tabel_meteran();
          
          redirect('controller/faktur');       
     }
     // fungsin untuk berpindah ke form buat laporan
  
        public function cari_laporan_harian()
    {
        $tanggal = $this->input->post('tanggal');
        $tidak_ditemukan['0'] = array(
            'no' => 'Tidak ada ',
            'nik' => '',
            'nama_pelanggan' => '',
            'meteran_awal' => '',
            'meteran_akhir' => '',
            'total_bayar' => '',
            'bulan_tagihan' => '',
            'tgl_pembayaran' => '',
            'status_tagihan' => '',
            'status' => '');
        $check = $this->M_pamsimas->laporan_harian($tanggal);
        if ($check->num_rows() > 0) {
            $data['V_tabelmeteran'] = $check->result_array();
        } else {
            $data['laporan_pelayanan'] = $tidak_ditemukan;
        }
        $data['tanggal'] = date('d M Y');
        $data['waktu_laporan'] = $tanggal;
        
        
        // $this->load->view('cetak_laporan', $data);
        //print_r($data);
    }   
//     public function letak($gambar)
//     {
//     $this->image($gambar,10,10,20,25);
// }
    public function cari_laporan_bulanan()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $referensi = $bulan . '-' . $tahun;
        $cari = $this->M_pamsimas->laporan_bulanan($referensi);
        if ($bulan == '01') {
            $print_bulan = 'Januari';
        } elseif ($bulan == '02') {
            $print_bulan = 'Februari';
        } elseif ($bulan == '03') {
            $print_bulan = 'Maret';
        } elseif ($bulan == '04') {
            $print_bulan = 'April';
        } elseif ($bulan == '05') {
            $print_bulan = 'Mei';
        } elseif ($bulan == '06') {         
            $print_bulan = 'Juni';
        } elseif ($bulan == '07') {
            $print_bulan = 'Juli';
        } elseif ($bulan == '08') {
            $print_bulan = 'Agustus';
        } elseif ($bulan == '09') {
            $print_bulan = 'September';
        } elseif ($bulan == '10') {
            $print_bulan = 'Oktober';
        } elseif ($bulan == '11') {
            $print_bulan = 'November';
        } elseif ($bulan == '12') {
            $print_bulan = 'Desember';
        }

        
        $pdf = new FPDF('l','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // gambar
        $pdf->Image('assets/image/lambang.png',15,10,20);

        
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(260,7,'PAMSIMAS BUMNAG SETANGKAI SUNGAI TARAB',0,1,'C');
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(260,9,'Kecamatan Sungai Tarab Kabupaten Tanah Datar',0,9,'C');
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(260,9,'jln. ps. Sungai Tarab Telp (0752)71150, 574421, 71890 Fax. (0752) 7152',0,9,'C');
        $pdf->Cell(260,1,'','LAPORAN METERAN PERBULAN',0,1,'C');
    
        $pdf->Cell(190,7,'',0,1,'C');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(50,8,'LAPORAN METERAN PERBULAN :',0,0,'C');
        
        $pdf->Cell(18,8,$referensi,0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,1,'',0,1);
        $pdf->SetFont('Arial','B',10);
    
        $pdf->Cell(8,6,'No',1,0);
        $pdf->Cell(50,6,'Nik',1,0);
        $pdf->Cell(45,6,'Nama',1,0);
        $pdf->Cell(25,6,'Meteran Awal',1,0);
        $pdf->Cell(30,6,'Meteran Akhir',1,0);
         $pdf->Cell(25,6,'Bulan tagihan',1,0);
        $pdf->Cell(30,6,'Tgl pembayaran',1,0);
        $pdf->Cell(25,6,'Total bayar',1,0);
        $pdf->Cell(30,6,'Status tagihan',1,1);
        $pdf->SetFont('Arial','',10);

        

        $cari_data= $this->M_pamsimas->laporan_bulanan($referensi);
       if ($cari_data->num_rows()>0) {
           $hasil['status_data']='Ada';
           $get_data=$cari_data->result_array();
        foreach ($get_data as $row) {
            $cari_nama=$this->M_pamsimas->find_data('tb_pelanggan','nik',$row['nik'])->row_array();
            $jumlah_tagihan=$this->M_pamsimas->hitungan_sisa_tagihan($row['nik'])->num_rows();
            if ($jumlah_tagihan=='0') {
                $status='Lunas';
            } else {
                $status='Jumlah Tagihan'.$jumlah_tagihan;
            }
            
         $data[]=[
             'id'=>$row['id'],
             'nik'=>$row['nik'],
             'nama'=>$cari_nama['nama'],
             'meteran_awal'=>$row['meteran_awal'],
             'meteran_akhir'=>$row['meteran_akhir'],
             'tgl_tagihan'=>$row['tgl_tagihan'],
             'tgl_pembayaran'=>$row['tgl_pembayaran'],
             'total_bayar'=>'Rp. '.number_format($row['total_bayar']).' ,-',
             'status_tagihan'=>$status
         ];
         $data_jumlah[]=
             $row['total_bayar'];
        
        }
    }
        else {
            $data_jumlah[]=
            ['0'];
            $hasil['status_data']="Tidak Ada";
            $data[]=[
                'id'=>"Tidak Ada Data",
                'nik'=>"tidak ada data",
                'nama'=>"tidak ada data",
                'meteran_awal'=>"tidak ada data",
                'meteran_akhir'=>"tidak ada data",
                'tgl_tagihan'=>"tidak ada data",
                'tgl_pembayaran'=>"tidak ada data",
                'total_bayar'=>"tidak ada data",
                'status_tagihan'=>"tidak ada data",
            ];
        }
       $hasil_jumlah=array_sum($data_jumlah);
       $jadikan_rp='Rp. '. number_format($hasil_jumlah).',-';
        $hasil['tb_meteran']=$data;
        $no= 1;
        
        foreach ($hasil['tb_meteran'] as $row){
            $pdf->Cell(8,6,$no++,1,0);
            $pdf->Cell(50,6,$row['nik'],1,0);
            $pdf->Cell(45,6,$row['nama'],1,0);
            $pdf->Cell(25,6,$row['meteran_awal'],1,0);
            $pdf->Cell(30,6,$row['meteran_akhir'],1,0);
            $pdf->Cell(25,6,$row['tgl_tagihan'],1,0);
            $pdf->Cell(30,6,$row['tgl_pembayaran'],1,0);
            $pdf->Cell(25,6,$row['total_bayar'],1,0);
            $pdf->Cell(30,6,$row['status_tagihan'],1,1);
            // $pdf -> Output('third_party/Image/logo.jpg');
       
        }

        $pdf->Cell(10,2,'',0,1);
        $pdf->Cell(8,6,'',0,0);
        $pdf->Cell(50,6,'',0,0);
        $pdf->Cell(45,6,'',0,0);
        $pdf->Cell(25,6,' ',0,0);
        $pdf->Cell(30,6,' ',0,0);
         $pdf->Cell(25,6,' ',0,0);
        $pdf->Cell(30,6,' Total Transaksi :',1,0);
        $pdf->Cell(25,6, $jadikan_rp,1,0);
        $pdf->Cell(30,6,' ',0,1);
        $pdf->SetFont('Arial','',10);

        
        // $tgl= date ('d m y');
        $pdf->Cell(485,20,'call Sungai Tarab,',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        
     

     
        $pdf->Cell(485,18,'Petugas',0,1,'C');
    
        $pdf->Output();
    } 
      public function cetak_laporan_bulanan()
    {
      
        $this->db->select('sum(total_bayar) as jumlah_bayar');
        // $this->db->from('tb_meteran');
          $this->M_pamsimas->laporan_tabel_meteran();
          redirect('controller/cari_laporan_bulanan');       
     }
     public function tes53()
     {
         $kalimat='Rifki dan Yahdi dan Lutvi';
         echo substr($kalimat,20,5);
         print_r( explode($kalimat,1,10));
     }
    // funsi laporan tahunan
    public function cari_laporan_tahunan()
    {
        // $bulan = $this->input->post('bulan');
        $referensi = $this->input->post('tahun');
        // $referensi = $bulan . '-' . $tahun;
        $cari = $this->M_pamsimas->laporan_tahunan($referensi);

        // $tahun = $this->input->post('tahun');
        // $referensi = $tahun;
        // $cari = $this->M_pamsimas->laporan_tahunan($referensi);

        $pdf = new FPDF('l','mm','A4');
        
        // membuat halaman baru
        $pdf->AddPage();
        $pdf->Image('assets/image/lambang.png',15,10,20);

        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(260,7,'PAMSIMAS BUMNAG SETANGKAI SUNGAI TARAB',0,1,'C');
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(260,9,'Kecamatan Sungai Tarab Kabupaten Tanah Datar',0,9,'C');
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(260,9,'jln. ps.malalo No. 137 Guguak Malalo Telp (0752)71150, 574421, 71890 Fax. (0752) 7152',0,9,'C');
        $pdf->Cell(260,1,'','LAPORAN METERAN PERBULAN',0,1,'C');
    
        $pdf->Cell(190,7,'',0,1,'C');
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(50,8,'LAPORAN METERAN PERTAHUN :',0,0,'C');
        
        $pdf->Cell(18,8,$referensi,0,1,'C');
        
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(190,7,'',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,1,'',0,1);
        $pdf->SetFont('Arial','B',10);
    
        $pdf->Cell(8,6,'No',1,0);
        $pdf->Cell(50,6,'Nik',1,0);
        $pdf->Cell(45,6,'Nama',1,0);
        $pdf->Cell(25,6,'Meteran Awal',1,0);
        $pdf->Cell(28,6,'Meteran_akhir',1,0);

        $pdf->Cell(25,6,'Tgl tagihan',1,0);
        $pdf->Cell(30,6,'Tgl pembayaran',1,0);
        $pdf->Cell(25,6,'Total bayar',1,0);
        $pdf->Cell(30,6,'Status tagihan',1,1);
        $pdf->SetFont('Arial','',10);

        

        $cari_data= $this->M_pamsimas->laporan_tahunan($referensi);
       if ($cari_data->num_rows()>0) {
           $hasil['status_data']='Ada';
           $get_data=$cari_data->result_array();
        foreach ($get_data as $row) {
            $cari_nama=$this->M_pamsimas->find_data('tb_pelanggan','nik',$row['nik'])->row_array();
            $jumlah_tagihan=$this->M_pamsimas->hitungan_sisa_tagihan($row['nik'])->num_rows();
            if ($jumlah_tagihan=='0') {
                $status='Lunas';
            } else {
                $status='Jumlah Tagihan'.$jumlah_tagihan;
            }
            
         $data[]=[
             'id'=>$row['id'],
             'nik'=>$row['nik'],
             'nama'=>$cari_nama['nama'],
             'meteran_awal'=>$row['meteran_awal'],
             'meteran_akhir'=>$row['meteran_akhir'],
             'tgl_tagihan'=>$row['tgl_tagihan'],
             'tgl_pembayaran'=>$row['tgl_pembayaran'],
             'total_bayar'=>'Rp. '.number_format($row['total_bayar']).' ,-',
             'status_tagihan'=>$status
         ];
         $data_jumlah[]=
         $row['total_bayar'];
        }
    }
        else {
            $data_jumlah[]=
            ['0'];
            $hasil['status_data']="Tidak Ada";
            $data[]=[
                'id'=>"Tidak Ada Data",
                'nik'=>"tidak ada data",
                'nama'=>"tidak ada data",
                'meteran_awal'=>"tidak ada data",
                'meteran_akhir'=>"tidak ada data",
                'tgl_tagihan'=>"tidak ada data",
                'tgl_pembayaran'=>"tidak ada data",
                'total_bayar'=>"tidak ada data",
                'status_tagihan'=>"tidak ada data",
            ];
        }
        $hasil_jumlah=array_sum($data_jumlah);
        $jadikan_rp='Rp. '. number_format($hasil_jumlah).',-';
         $hasil['tb_meteran']=$data;
         $no= 1;
       
        // $hasil['tb_meteran']=$data;
        // $no= 1;
        
        foreach ($hasil['tb_meteran'] as $row){
            $pdf->Cell(8,6,$no++,1,0);
            $pdf->Cell(50,6,$row['nik'],1,0);
            $pdf->Cell(45,6,$row['nama'],1,0);
            $pdf->Cell(25,6,$row['meteran_awal'],1,0);
            $pdf->Cell(28,6,$row['meteran_akhir'],1,0);
            $pdf->Cell(25,6,$row['tgl_tagihan'],1,0);
            $pdf->Cell(30,6,$row['tgl_pembayaran'],1,0);
            $pdf->Cell(25,6,$row['total_bayar'],1,0);
            $pdf->Cell(30,6,$row['status_tagihan'],1,1);
        }
        $pdf->Cell(10,2,'',0,1);
        $pdf->Cell(8,6,'',0,0);
        $pdf->Cell(50,6,'',0,0);
        $pdf->Cell(45,6,'',0,0);
        $pdf->Cell(25,6,' ',0,0);
        $pdf->Cell(28,6,'',0,0);
       
        $pdf->Cell(25,6,' ',0,0);
        $pdf->Cell(30,6,'Total Transaksi :',1,0);
        $pdf->Cell(25,6,$jadikan_rp,1,0);
        $pdf->Cell(30,6,' ',0,1);
        $pdf->SetFont('Arial','',10);

      
        // $tgl= date ('d m y');
        $pdf->Cell(480,20,'call Sungai Tarab',0,1,'C');
        $pdf->SetFont('Arial','B',12);    
        $pdf->Cell(480,20,'Petugas',0,1,'C');   
        $pdf->Output();
    } 
      public function cetak_laporan_tahunan()
    {
          $this->M_pamsimas->laporan_tabel_meteran();
          
          redirect('controller/cari_laporan_tahunan');       
     }
     public function status_tagihan_user()
    {
        $this['data']=$this->M_pamsimas->status_tagihan_user('tb_bayar');
        $this->load->view('list_tagihan_user' );
    }
    public function konfirmasi()
    {
        $check_data=$this->M_pamsimas->get_data('tb_bayar','id_bayar','DESC')->result_array();
        foreach ($check_data as $value) {
            $cari_nik=$this->M_pamsimas->find_data('tb_meteran','id',$value['id_tagihan'])->row_array();
            $cari_nama=$this->M_pamsimas->find_data('tb_pelanggan','nik',$cari_nik['nik'])->row_array();
             
         $hasil[]=[
            'id_bayar'=>$value['id_bayar'],
            'tgl_bayar'=>$value['tgl_bayar'],
            'bukti_bayar'=>$value['bukti_bayar'],
            'id_tagihan'=>$value['id_tagihan'],
            'status'=>$value['status'],
            'nama'=>$cari_nama['nama'],
        ];
        }
        $hasil['tb_bayar']=$hasil;
        $this->load->view('head');
        $this->load->view('list_tagihan_user',$hasil);
        $this->load->view('footer');
        // print_r($check_data);
    }
    public function konfirmasi_pembayaran($id,$status)
    {
        $id_meteran=$this->M_pamsimas->find_data('tb_bayar','id_bayar',$id)->row_array();
        $nik=$this->input->post('nik');
        $total_tagihan=$this->input->post('total_tagihan');
        $total_bayar=$this->input->post('total_bayar');
        $data_nomor=$this->M_pamsimas->find_data('tb_pelanggan','nik',$nik)->row_array();
        $tanggal=$this->M_pamsimas->find_data('tb_meteran','nik',$nik)->row_array();
        $tangal_potong=substr($tanggal['tgl_tagihan'],0,2);
        $tahun_potong=substr($tanggal['tgl_tagihan'],3,4);

        if ($status=='Terima') {
            $data_update1=
            [
                'status'=>'Diterima'
            ];
            $data_update2=
            [
                'status'=>'Sudah',
                'tgl_pembayaran'=> date('d-m-Y'),
            ];
            $pesan='Bapak/Ibuk' . $data_nomor ['nama'].' Pembayaran anda Bulan '.$tangal_potong.' Tahun '.$tahun_potong.' Lunas ';
            $this->send_sms($data_nomor['no_hp'],$pesan);
            // print_r($pesan);
            $this->M_pamsimas->update_data('tb_bayar','id_bayar',$id,$data_update1);
            $this->M_pamsimas->update_data('tb_meteran','id',$id_meteran['id_tagihan'],$data_update2);
            $this->session->set_flashdata('success', 'Pembayaran Berhasil Di Terima');
            redirect('controller/konfirmasi');
            
        } else {
            
            $data_update1=
            [
                'status'=>'Ditolak'
            ];
            $data_update2=
            [
                'status'=>'Belum'
            ];
            $this->M_pamsimas->update_data('tb_bayar','id_bayar',$id,$data_update1);
            $this->M_pamsimas->update_data('tb_meteran','nik',$id_meteran['id'],$data_update2);
            $this->session->set_flashdata('success', 'Pembayaran Berhasil DI Terima');
            redirect('controller/konfirmasi');
        }
        
    }
    public function V_konfirmasi()
    {

        $cari_data= $this->M_pamsimas->get_data('tb_bayar','id_bayar','DESC');
       if ($cari_data->num_rows()>0) {
           $hasil['status_data']='Ada';
           $get_data=$cari_data->result_array();
        foreach ($get_data as $row) {
            $jumlah_tagihan=$this->M_pamsimas->hitungan_sisa_tagihan($row['nik'])->num_rows();
         $data[]=[
             'id_bayar'=>$row['id_bayar'],
             'tgl_bayar'=>$row['tgl_bayar'],
             'bukti_bayar'=>$row['bukti_bayar'],
             'id_meteran'=>$row['id_meteran'],
             'nik'=>$row['nik'],
             'status'=>$row['status'],
            //  'status_tagihan'=>$jumlah_tagihan
         ];
        }
    }
        else {
            $hasil['status_data']="Tidak Ada";
            $data[]=[
                'id_bayar'=>"Tidak Ada Data",
                'tgl_bayar'=>"tidak ada data",
                'bukti_bayar'=>"tidak ada data",
                'id_meteran'=>"tidak ada data",
                'nik'=>"tidak ada data",
                'status'=>"tidak ada data",
                 ];
        }
       
        $hasil['tb_pelanggan']=$data;
        // print_r($hasil);
        $this->load->view('head');
        $this->load->view('v_tabelpelanggan',$hasil);
        $this->load->view('footer');
    }
    public function sendMobileSms() {
        $mobileNumber= '082169074845'; /*Separate mobile no with commas */
        $message= 'Total tagihan bulan januari anda adalah 150.000.00'; /* message */
        $senderId= "lutvi1500"; /* Sender ID */
        $serverUrl="msg.msgclub.net";
        $authKey= "53967ae44f61f89b2bb9e2bd05164398"; /* Authentication key (get from sms service provider)*/
        $route="1";
        $this->sendsmsGET($mobileNumber,$senderId,$route,$message,$serverUrl,$authKey);
    }
      public function sendsmsGET($mobileNumber,$senderId,$routeId,$message,$serverUrl,$authKey)
      {
          $route = "default";
          $getData = 'mobileNos='.$mobileNumber.'&message='.urlencode($message).'&senderId='.$senderId.'&routeId='.$routeId;
          /* API URL */
          $url="http://sms241.xyz/sms/smsreguler.php?username=".$senderId."&key=".$authKey."&number=".$mobileNumber."&message=".$message;
          //$url="http://".$serverUrl."/rest/services/sendSMS/sendGroupSms?AUTH_KEY=".$authKey."&".$getData;
          /* init the resource */
          $ch = curl_init();
          curl_setopt_array($ch, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_SSL_VERIFYHOST => 0,
           CURLOPT_SSL_VERIFYPEER => 0
          ));
          /* get response */
          $output = curl_exec($ch);
          /* Print error if any */
          if(curl_errno($ch))
          {
          echo 'error:' . curl_error($ch); 
          }
          curl_close($ch);
          return $output;
      }
      public function hi_tes($nomor,$pesan)
      {
          echo $nomor;
          echo $pesan;
      }
      public function send_sms($nomor,$pesan)
      {
        ob_start();
        // setting 
        $apikey      = '53967ae44f61f89b2bb9e2bd05164398'; // api key 
        $urlendpoint = 'http://sms241.xyz/sms/api_sms_masking_send_json.php'; // url endpoint api 
        $callbackurl = 'http://your_url_for_get_auto_update_status_sms'; // url callback get status sms 
        
        // create header json  
        $senddata = array(
            'apikey' => $apikey,  
            'callbackurl' => $callbackurl, 
            'datapacket'=>array()
        );
        
        // create detail data json 
        // data 1
        $number1=$nomor;
        $message1=$pesan;
        $sendingdatetime1 =""; 
        array_push($senddata['datapacket'],array(
            'number' => trim($number1),
            'message' => urlencode(stripslashes(utf8_encode($message1))),
            'sendingdatetime' => $sendingdatetime1));
            
        // data 2
        // $number2='081xxx';
        // $message2='Message 2';
        // $sendingdatetime2 ="2017-01-01 23:59:59";
        // array_push($senddata['datapacket'],array(
        //     'number' => trim($number2),
        //     'message' => urlencode(stripslashes(utf8_encode($message2))),
        //     'sendingdatetime' => $sendingdatetime2));
            
        // send sms 
        $dt=json_encode($senddata);
        $curlHandle = curl_init($urlendpoint);
        curl_setopt($fcurlHandle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $dt);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($dt))
        );
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 5);
        curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 5);
        $responjson = curl_exec($curlHandle);
        curl_close($curlHandle);
        header('Content-Type: application/json');
        return $responjson;
      }
      public function check_saldo()
      {
        //   $this->load->view('head');
        //   $this->load->view('check_saldo');
        //   $this->load->view('footer');
          $check_saldo=$this->balance();
          $data= json_decode($check_saldo);
          print_r($data->balance_respon[0]);

      } 
      public function balance(){
        ob_start();
        // setting 
        $apikey      = '53967ae44f61f89b2bb9e2bd05164398'; // api key 
        $urlendpoint = 'http://sms241.xyz/sms/api_sms_reguler_balance_json.php'; // url endpoint api
        
        // create header json  
        $senddata = array(
            'apikey' => $apikey
        );
        
        // get balance  
        $data=json_encode($senddata);
        $curlHandle = curl_init($urlendpoint);
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
        );
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 5);
        curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 5);
        $responjson = curl_exec($curlHandle);
        curl_close($curlHandle);
        header('Content-Type: application/json');
        return $responjson;
      }
   
}
    
                
                        
    



     
