<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_user extends CI_Controller {

    public function index()
    {
        $this->load->view('user/head');
        $this->load->view('user/dashbord');
        $this->load->view('user/footer');   
    }
    public function rek()
    {
        $this->load->view('user/head');
        $this->load->view('user/rek');
        $this->load->view('user/footer');   
   

    }
    public function tagihan()
    {
    $this->load->view('user/tagihan');
    
    redirect('c_user/tagihan');
    
    }
    
    public function tagihan_user()
    {
       
    $nik=$this->session->userdata('username');    
       $chekc=$this->M_pamsimas->find_data('tb_meteran','nik',$nik);
       if ($chekc->num_rows()>0) {
          $data['status']='1';
          $data['tagihan']=$chekc->result_array();
       } else {
        $data['status']='0';    
          }

       
        //  print_r($data);
         $this->load->view('user/head');
         $this->load->view('user/tagihan',$data);
         $this->load->view('user/footer');
}
public function upload_bukti_bayar()
{

    $config['upload_path'] = './media/original_media';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['encrypt_name'] = true;
    // load library upload
    // $bukti_bayar => $bukti_bayar; 
    $this->load->library('upload', $config);
    if (!$this->upload->do_upload('bukti_bayar')) {
        $error = $this->upload->display_errors();
        // menampilkan pesan error
        print_r($error);
    } else {
        $result = array('upload_data' => $this->upload->data());
        $config['image_library'] = 'gd2';
        $config['source_image'] = './media/original_media/' . $result['upload_data']['file_name'];
        $config['create_thumb'] = false;
        $config['maintain_ratio'] = false;
     $config['quality'] = '100%';
        $config['width'] = 400;
        $config['height'] = 400;
        $config['new_image'] = './media/thumb_media/' . $result['upload_data']['file_name'];
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
    $id=$this->input->post('id');
    $data=[
        'tgl_bayar'=>date('d-m-Y'),
        'bukti_bayar'=>'/media/thumb_media/' . $result['upload_data']['file_name'],
        'id_tagihan'=>$id,
        'Status'=>'Proses',
    ];
    $data_update=[
        // 'status'=>'Sudah Bayar',
        'tgl_pembayaran'=>date('d-m-Y'),
    ];
    $this->M_pamsimas->update_data('tb_meteran','id',$id,$data_update);
        $this->M_pamsimas->upload_foto($data);
        $this->session->set_flashdata('success', 'Pembayaran Berhasil di Lakukan, mohon tunggu konfirmasi admin');
        redirect('c_user/tagihan_user');
        
    }
   
}
}
?>