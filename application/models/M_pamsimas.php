<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_pamsimas extends CI_Model {
    public function Model_simpan($data)
    {
         $this->db->insert('tb_pelanggan',$data);
    }
    public function tampil_data()
    {
        return $this->db->get('tb_pelanggan')->result();
    }
    public function model_hapus($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('tb_pelanggan');
    }
    public function model_edit($id)
    {
        $this->db->where('id',$id);
        return $this->db->get('tb_pelanggan')->row_array();
        
    }
    public function model_edit_simpan($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update('tb_pelanggan',$data);
    }
    public function simpan_user($data)
    {
    $this->db->insert('tb_admin',$data);
}


    // LOGIN
    function check_account($username,$password)
    {
         $this->db->where('username',$username);
         $this->db->where('password', $password);
         return $this->db->get('tb_admin');

    }
    public function tagihan_user($nik)
    {
        $this->db->where('tb_pelanggan',$nik);
        $this->db->where('tb_pelanggan',$nik);
    }
    public function check_tagihan($nik, $tanggal)
    {
        $this->db->from('tb_meteran');
        $this->db->where('nik', $nik);
        $this->db->where('tgl_tagihan', $tanggal);
        return $this->db->get();
    }
    public function update_data($tabel,$id_reference,$id,$data)
    {
        $this->db->where($id_reference,$id );
        $this->db->update($tabel, $data);
    }
    public function create_data($tabel,$data)
    {
        $this->db->insert($tabel,$data);
    }
    public function get_data($tabel,$id_order,$order)
    {
        $this->db->order_by($id_order,$order);
        return $this->db->get($tabel);
    }
    public function get_data_nik($tabel,$id_order)
    {
        $this->db->order_by($id_order);
        return $this->db->get($tabel);
    }
    // public function find_data_nik($tabel,$id_tabel)
    // {
    //     $this->db->where($id_tabel,$id_tabel);
    //     return $this->db->get($tabel);

    // }
    public function tampil_data_meteran()
    {
        return $this->db->get('tb_meteran')->result();
    }
    public function model_hapus_meteran($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('tb_meteran');

    }
  public function model_edit_meteran($id)
    {
    $this->db->where('id',$id);
    return $this->db->get('tb_meteran')->row_array();
    }

    public function model_edit_simpan_meteran($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update('tb_meteran',$data);
    }
    public function laporan_tabel_pelanggan()
    {
        $this->db->where('tb_pelanggan');
            
    }
    public function laporan_tabel_meteran()
    {
        $this->db->where('tb_meteran');
            
    }
    public function hitungan_sisa_tagihan($nik)
    {
        $this->db->where('nik', $nik);
        $this->db->where('status', 'Belum');
     return $this->db->get('tb_meteran');
        
    }
    public function find_data($tabel,$id_tabel,$id)
    {
        $this->db->where($id_tabel,$id);
        return $this->db->get($tabel);      
    }
    public function hitung_bayar($nik)
    {
        $this->db->where('nik', $nik);
        $this->db->where('status','Belum');
        return $this->db->get('tb_meteran');
    } 
    public function bayar($nik,$object)
    {
        $this->db->where('nik', $nik);
        $this->db->where('status', 'Belum');
        $this->db->update('tb_meteran', $object);
    }   
    //coba coba 
    // public function laporan_harian($referensi)
    // {
    //     $this->db->where('tgl_lahir', $referensi);
    //     return $this->db->get('tb_pelanggan');
    // }
//   public function view()
//   {
//     return $this->db->get('tb_pelanggan')->result();
//   }
  
//   public function view_row(){
//     return $this->db->get('tb_pelanggan')->result();
//   }
//   public function laporan_harian($referensi)
//     {
//         $this->db->where('tgl_lahir', $referensi);
//         return $this->db->get('tb_pelanggan');
//     }
    public function hitung_database($tabel)
    {
        return $this->db->get('tb_meteran');
    }
    public function jumlah_bayar()
    {
        $this->db->where('status','Sudah');
        return $this->db->get('tb_meteran');

     }
    public function jumlah_belum_bayar()
    {
        $this->db->where('status','Belum');
        return $this->db->get('tb_meteran');
    }
    public function total_bayar()
    {
        $this->db->select('sum(total_bayar) as jumlah_bayar');
        $this->db->from('tb_meteran');
        $this->db->where('status','Sudah');
        return $this->db->get()->row()->jumlah_bayar;
    }
    public function total_bayar_perbulan()
    {
        $this->db->select('month(total_bayar) as jumlah_bayar');
        $this->db->from('tb_meteran');
        $this->db->where('status','Sudah');
        return $this->db->get()->row()->jumlah_bayar;
    }
    public function konfirmasi()
    {
        return $this->db->get('tb_bayar')->result();
    }
    

    // hitung data
    public function laporan_bulanan($referensi)
    {
        $this->db->where('SUBSTRING(tgl_tagihan,1,7)', $referensi);
        return $this->db->get('tb_meteran');
    }
    public function laporan_tahunan($referensi)
    {
        $this->db->where('SUBSTRING(tgl_tagihan,4,4)', $referensi);
        return $this->db->get('tb_meteran');
    }
    public function riset($nik,$data_update)
    {
        $this->db->where('nik_terlapor', $nik);
        $this->db->update('tb_terlapor', $data_update);
    }
    public function upload_foto($bayar)
    {
        $this->db->insert('tb_bayar',$bayar);

    }

}



    




