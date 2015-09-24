<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
{
  public $id_user;
  public $nama;
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');

        if ( $this->session->userdata('logged_in')=="") {
    			redirect('auth/login');
    		}

    		  $this->id_user = $this->session->userdata('uid');
    			$this->nama 	 = $this->session->userdata('nama');
    }

    public function index()
    {
        $tb_user = $this->tb_user_model->get_all();

        $data = array(
            'tb_user_data' => $tb_user
        );

        $this->load->view('tb_user_list', $data);
    }

    public function daftar()
    {
        $data = array(
            'nama' => set_value('nama'),
            'email' => set_value('email'),
            'username'=> set_value('username')
        );
        $this->load->view('admin/daftar',$data);
    }

    public function action_daftar()
    {
        $this->load->library('form_validation');
        $data = array(
            'username' => $this->input->post('username', TRUE),
            'password' => $this->input->post('password', TRUE)
        );

        //rules
        $this->form_validation->set_rules('nama', 'Nama', 'required|min_length[5]',
          array(
            'required' => 'Anda belum mengisi nama %s.'
          ));
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_user.username]',
          array(
            'required' => 'Anda belum mengisi Username %s.',
            'is_unique' => 'Username telah terdaftar'
          ));
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]',
          array(
            'required' => 'Anda belum mengisi password %s.'
        ));
        $this->form_validation->set_rules('c_password','Konfirmasi Password', 'required|matches[password]', array(
            'required'=>'Anda belum mengisi konfirmasi password',
            'matches' => 'Password konfirmasi tidak cocok dengan password yang di inputkan'
        ));
        $this->form_validation->set_rules('email','Email','required|valid_email',array(
          'required' => 'Anda belum mengisi email',
          'valid_email' => 'Email yang anda inputkan tidak valid'
        ));

        if ($this->form_validation->run() == FALSE)
        {

          $this->daftar();
        }
        else
        {
            $data = array(
                    'nama_user' => $this->input->post('nama',TRUE),
                    'username' => $this->input->post('username',TRUE),
                    'password' => $this->input->post('password',TRUE),
                    'email' => $this->input->post('email',TRUE)
                  );

            $this->User_model->insert($data);
            $this->session->set_flashdata('message', 'Silahkan Login');
            redirect(site_url('admin/'));
        }
    }


    public function read($id)
    {
        $row = $this->tb_user_model->get_by_id($id);
        if ($row) {
            $data = array(
                		'id_user' => $row->id_user,
                		'nama_user' => $row->nama_user,
                		'username' => $row->username,
                		'password' => $row->password,
                		'email' => $row->email,
                		'last_login' => $row->last_login,
                		'api_key' => $row->api_key,
	                   );
            $this->load->view('tb_user_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tb_user'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tb_user/create_action'),
      	    'id_user' => set_value('id_user'),
      	    'nama_user' => set_value('nama_user'),
      	    'username' => set_value('username'),
      	    'password' => set_value('password'),
      	    'email' => set_value('email'),
      	    'last_login' => set_value('last_login'),
      	    'api_key' => set_value('api_key'),
	         );
        $this->load->view('tb_user_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                		'nama_user' => $this->input->post('nama_user',TRUE),
                		'username' => $this->input->post('username',TRUE),
                		'password' => $this->input->post('password',TRUE),
                		'email' => $this->input->post('email',TRUE),
                		'last_login' => $this->input->post('last_login',TRUE),
                		'api_key' => $this->input->post('api_key',TRUE),
	                );

            $this->tb_user_model->insert($data);
            $this->session->set_flashdata('message', 'Silahkan Login');
            redirect(site_url('admin/'));
        }
    }

    public function update($id)
    {
        $row = $this->tb_user_model->get_by_id($id);

        if ($row) {
            $data = array(
                  'button' => 'Update',
                  'action' => site_url('tb_user/update_action'),
              		'id_user' => set_value('id_user', $row->id_user),
              		'nama_user' => set_value('nama_user', $row->nama_user),
              		'username' => set_value('username', $row->username),
              		'password' => set_value('password', $row->password),
              		'email' => set_value('email', $row->email),
              		'last_login' => set_value('last_login', $row->last_login),
              		'api_key' => set_value('api_key', $row->api_key),
	             );
            $this->load->view('tb_user_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tb_user'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_user', TRUE));
        } else {
            $data = array(
              		'nama_user' => $this->input->post('nama_user',TRUE),
              		'username' => $this->input->post('username',TRUE),
              		'password' => $this->input->post('password',TRUE),
              		'email' => $this->input->post('email',TRUE),
              		'last_login' => $this->input->post('last_login',TRUE),
              		'api_key' => $this->input->post('api_key',TRUE),
	               );

            $this->tb_user_model->update($this->input->post('id_user', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tb_user'));
        }
    }

    public function delete($id)
    {
        $row = $this->tb_user_model->get_by_id($id);

        if ($row) {
            $this->tb_user_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tb_user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tb_user'));
        }
    }


    public function account_setting()
  	{
  		$this->load->view('admin/head');
  		$this->load->view('admin/header', array('nama'=>$this->nama));

  		$this->load->model('User_model','user');
  		$data = $this->user->get_by_id($this->id_user);

  		$this->load->view('admin/account_setting',$data);
  		$this->load->view('admin/footer');
  	}

    function change_password()
    {
      $this->form_validation->set_rules('password', 'Password', 'required',
        array(
          'required' => 'Anda belum mengisi password %s.'
      ));
      $this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[6]',
        array(
          'required' => 'Anda belum mengisi password %s.'
      ));
      $this->form_validation->set_rules('c_password','Konfirmasi Password', 'required|matches[new_password]', array(
          'required'=>'Anda belum mengisi konfirmasi password',
          'matches' => 'Password konfirmasi tidak cocok dengan password yang di inputkan'
      ));

      if ($this->form_validation->run() == FALSE)
      {
        $this->account_setting();
      }
      else
      {
          $data = array(
              'id_user' => $this->id_user,
              'password' => $this->input->post('password')
          );

          if($this->User_model->get_password($data)->num_rows() > 0)
          {
              $this->User_model->update($this->id_user,array('password'=>$this->input->post('new_password')));
              $this->session->set_flashdata('message', 'Password berhasil di ubah, silahkan logout kemudian login');
              redirect('user/account_setting');
          }
          else
          {
              $this->session->set_flashdata('message', 'Password lama tidak cocok dengan password yang anda inputkan');
              redirect('user/account_setting');
          }
      }
    }

    function _rules()
    {
      	$this->form_validation->set_rules('nama_user', ' ', 'trim|required');
      	$this->form_validation->set_rules('username', ' ', 'trim|required');
      	$this->form_validation->set_rules('password', ' ', 'trim|required');
      	$this->form_validation->set_rules('email', ' ', 'trim|required');
      	$this->form_validation->set_rules('last_login', ' ', 'trim|required');
      	$this->form_validation->set_rules('api_key', ' ', 'trim|required');

      	$this->form_validation->set_rules('id_user', 'id_user', 'trim');
      	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Tb_user.php */
/* Location: ./application/controllers/Tb_user.php */
