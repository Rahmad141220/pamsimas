<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_login extends CI_Controller {

    public function index()
    {
        if($this->session->userdata('logged_in')==TRUE){
            redirect('controller');
        }
        else {
               $this->load->view('Login');
        }
    }
    function verifikasi()
    {
        $username=$this->input->post('username');
        $password=md5($this->input->post('username'));
        $check_data=$this->M_pamsimas->check_account($username,$password);
        if ($check_data->num_rows()>0)
        {
            $data=$check_data->result_array();
            $nama=$data[0]['nama'];
            $level=$data[0] ['level'];
            $username=$data[0]['username'];

            $ses_data = array(
                'username' =>$username,
                'nama' =>$nama,
                'level' => $level,
                'logged_in' =>TRUE
            );
            $this->session->set_userdata($ses_data);
            if ($level=='admin') {
                
            redirect('controller/dashbord');
            }elseif ($level=='user') {
                
                redirect('c_user');
                
            }
            
        }else{
            $this->session->set_flashdata('error', 'maaf password yang anda masukan salah');
            
            redirect('C_login');
            
        
        }
    }
    public function buat_akun()
    {
        $data=array (
        'nama' =>'admin',
        'username' =>'admin',
        'password' =>md5('admin'),
    );
    $this->M_pamsimas->create_data('tb_admin',$data);
    echo'berahasil';
    
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('C_login');
    
    }
    function registrasi_user()
		{	
		$this->load->view('Registrasi');
		}
}
?>