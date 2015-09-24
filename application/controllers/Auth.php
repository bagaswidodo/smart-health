<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function  index()
    {
    		if ( $this->session->userdata('logged_in')=="") {
    			$this->login();
    		}else {
    		  redirect('admin');
    		}


    }
    public function login()
    {
        $this->load->view('admin/login');
    }


  public function cek()
  {
      $this->load->library('form_validation');
      $data = array(
          'username' => $this->input->post('username', TRUE),
           'password' => $this->input->post('password', TRUE)
      );


      $this->form_validation->set_rules('username', 'Username', 'required',
        array(
          'required' => 'Anda belum mengisi Username %s.'
        ));
      $this->form_validation->set_rules('password', 'Password', 'required',
        array('required' => 'Anda belum mengisi password %s.')
      );

      if ($this->form_validation->run() == FALSE)
      {

        $this->load->view('admin/login');

      }
      else
      {
          $this->load->model('User_model','user'); // load model_user

          $data = array(
            'username'=>  $this->input->post('username'),
            'password' =>  $this->input->post('password')
          );

          $hasil = $this->user->get_by_username($data);

          if ($hasil->num_rows() == 1) {
                $sess_data['logged_in'] = TRUE;
                $sess_data['uid'] = $hasil->row()->id_user;
                $sess_data['nama'] = $hasil->row()->nama_user;
                $this->session->set_userdata($sess_data);
                redirect('admin/');

          }
          else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Login Gagal, Akun Tidak terdaftar</div>');
            redirect('auth/login');
          }
      }
  }

  
  public function logout()
  {

        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('uid');
          $this->session->unset_userdata('nama');
        session_destroy();
        redirect('admin');
        //$this->load->view('index');

  }
  //end auth
}
