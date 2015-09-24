<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faskes_praktek_dokter extends CI_Controller
{
  public $id_user;
  public $nama;
    function __construct()
    {
        parent::__construct();
        $this->load->model('faskes_praktek_dokter_model');
        $this->load->library('form_validation');

        if ( $this->session->userdata('logged_in')=="") {
    			redirect('auth/login');
    		}
        $this->id_user = $this->session->userdata('uid');
        $this->nama 	 = $this->session->userdata('nama');
    }

    public function kepala()
    {
      $this->load->view('admin/head');
      $this->load->view('admin/header',array('nama'=>$this->nama));
    }

    public function index()
    {
        $faskes_praktek_dokter = $this->faskes_praktek_dokter_model->get_all();

        $data = array(
            'faskes_praktek_dokter_data' => $faskes_praktek_dokter
        );

        $this->load->view('admin/faskes_praktek_dokter/faskes_praktek_dokter_list', $data);
    }

    public function jadwal_dokter()
    {
        $finder = array(
            'id_faskes' => $this->uri->segment(3),
            'id_dokter' => $this->uri->segment(4)
        );

        $this->load->model('Faskes_Model', 'faskes');
        $this->load->model('Faskes_dokter_model','dokter');



        $faskes_praktek_dokter = $this->faskes_praktek_dokter_model->get_jadwal($finder);
        $data = array(
            'faskes_praktek_dokter_data' => $faskes_praktek_dokter,
            'nama_faskes' => $this->faskes->get_name($finder['id_faskes'])->nama_faskes,
            'nama_dokter' => $this->dokter->get_by_id($finder)->nama_dokter
        );


        $this->kepala();
        $this->load->view('admin/faskes_praktek_dokter/faskes_praktek_dokter_list', $data);
        $this->load->view('admin/footer');
    }


    public function read($id)
    {
        $row = $this->faskes_praktek_dokter_model->get_by_id($id);
        if ($row) {
            $data = array(
        		'hari' => $row->hari,
        		'jam_buka' => $row->jam_buka,
        		'jam_tutup' => $row->jam_tutup,
        		'jam_mulai_istirahat' => $row->jam_mulai_istirahat,
        		'jam_selesai_istirahat' => $row->jam_selesai_istirahat,
        		'id_faskes' => $row->id_faskes,
        		'id_dokter' => $row->id_dokter,
	         );
            $this->load->view('tb_faskes_praktek_dokter_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('faskes_praktek_dokter'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('faskes_praktek_dokter/create_action'),
      	    'hari' => set_value('hari'),
      	    'jam_buka' => set_value('jam_buka'),
      	    'jam_tutup' => set_value('jam_tutup'),
      	    'jam_mulai_istirahat' => set_value('jam_mulai_istirahat'),
      	    'jam_selesai_istirahat' => set_value('jam_selesai_istirahat'),
      	    'id_faskes' => set_value('id_faskes'),
      	    'id_dokter' => set_value('id_dokter'),
            'aksi'=>'tambahkan'
	         );

           $this->kepala();
           $this->load->view('admin/faskes_praktek_dokter/faskes_praktek_dokter_form', $data);
           $this->load->view('admin/footer');

    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
            		'hari' => $this->input->post('hari',TRUE),
            		'jam_buka' => $this->input->post('jam_buka',TRUE),
            		'jam_tutup' => $this->input->post('jam_tutup',TRUE),
            		'jam_mulai_istirahat' => $this->input->post('jam_mulai_istirahat',TRUE),
            		'jam_selesai_istirahat' => $this->input->post('jam_selesai_istirahat',TRUE),
            		'id_faskes' => $this->input->post('id_faskes',TRUE),
            		'id_dokter' => $this->input->post('id_dokter',TRUE),
        	    );

            $this->faskes_praktek_dokter_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('faskes_praktek_dokter/jadwal_dokter/' . $data['id_faskes'] . '/' . $data['id_dokter']));
        }
    }

    public function update($finder)
    {

        if(count($finder) > 1){

          $data = array(
              'id_faskes' => $finder['id_faskes'],
              'id_dokter' => $finder['id_dokter'],
              'hari'=> $finder['hari']
          );
        }else{

            $data = array(
                'id_faskes' => $this->uri->segment(3),
                'id_dokter' => $this->uri->segment(4),
                'hari'=> $this->uri->segment(5)
            );
        }
        $row = $this->faskes_praktek_dokter_model->get_by_id($data);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('faskes_praktek_dokter/update_action'),
            		'hari' => set_value('hari', $row->hari),
            		'jam_buka' => set_value('jam_buka', $row->jam_buka),
            		'jam_tutup' => set_value('jam_tutup', $row->jam_tutup),
            		// 'jam_mulai_istirahat' => set_value('jam_mulai_istirahat', $row->jam_mulai_istirahat),
            		// 'jam_selesai_istirahat' => set_value('jam_selesai_istirahat', $row->jam_selesai_istirahat),
            		'id_faskes' => set_value('id_faskes', $row->id_faskes),
                'nama_faskes'=>$row->nama_faskes,
                'nama_dokter'=>$row->nama_dokter,
            		'id_dokter' => set_value('id_dokter', $row->id_dokter),
                'aksi'=>'ubah'
	             );


               $this->kepala();
               $this->load->view('admin/faskes_praktek_dokter/faskes_praktek_dokter_form', $data);
               $this->load->view('admin/footer');
            //$this->load->view('admin/faskes_praktek_dokter/faskes_praktek_dokter_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            //redirect(site_url('faskes_praktek_dokter'));
        }
    }

    public function update_action()
    {
        //$this->_rules();


        $this->form_validation->set_rules('jam_buka', ' ', 'trim|required|callback_buka_istirahat');
      	$this->form_validation->set_rules('jam_tutup', ' ', 'trim|required|callback_buka_istirahat');
      	// $this->form_validation->set_rules('jam_mulai_istirahat', ' ', 'trim|required|callback_buka_istirahat');
      	// $this->form_validation->set_rules('jam_selesai_istirahat', ' ', 'trim|required|callback_istirahat_tutup');
      	$this->form_validation->set_rules('id_faskes', ' ', 'trim|required|numeric');
      	$this->form_validation->set_rules('id_dokter', ' ', 'trim|required|numeric');

      	$this->form_validation->set_rules('', '', 'trim');
      	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');



        if ($this->form_validation->run() == FALSE) {
            $finder = array(
              'hari' => $this->input->post('hari',TRUE),
              'id_faskes' => $this->input->post('id_faskes',TRUE),
          		'id_dokter' => $this->input->post('id_dokter',TRUE)
            );


          //  $this->update($this->input->post('', TRUE));
          $this->update($finder);
        } else {
            $data = array(
          		//'hari' => $this->input->post('hari',TRUE),
          		'jam_buka' => $this->input->post('jam_buka',TRUE),
          		'jam_tutup' => $this->input->post('jam_tutup',TRUE),
          		'jam_mulai_istirahat' => $this->input->post('jam_mulai_istirahat',TRUE),
          		'jam_selesai_istirahat' => $this->input->post('jam_selesai_istirahat',TRUE),
          		'id_faskes' => $this->input->post('id_faskes',TRUE),
          		'id_dokter' => $this->input->post('id_dokter',TRUE),
	           );

             $where = array(
               'id_faskes' => $this->input->post('id_faskes',TRUE),
               'id_dokter' => $this->input->post('id_dokter',TRUE),
               'hari' => $this->input->post('hari',TRUE),
            );
            $this->faskes_praktek_dokter_model->update($where, $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('faskes_praktek_dokter/jadwal_dokter/' . $data['id_faskes'] . '/' . $data['id_dokter']));
        }
    }

    public function delete($id)
    {
        //$row = $this->faskes_praktek_dokter_model->get_by_id($id);
        $data= array(
          'id_faskes' => $this->uri->segment(3),
          'id_dokter' => $this->uri->segment(4),
          'hari' => $this->uri->segment(5)
       );
       $row = $this->faskes_praktek_dokter_model->get_by_id($data);

        if ($row) {
            $this->faskes_praktek_dokter_model->delete($data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('faskes_praktek_dokter/jadwal_dokter/' . $data['id_faskes'] . '/' . $data['id_dokter']));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
          redirect(site_url('faskes_praktek_dokter/jadwal_dokter/' . $data['id_faskes'] . '/' . $data['id_dokter']));
        }
    }

    function _rules()
    {
      	$this->form_validation->set_rules('hari', ' ', 'trim|required|numeric|callback_hari');
        $this->form_validation->set_rules('jam_buka', ' ', 'trim|required|callback_buka_istirahat');
      	$this->form_validation->set_rules('jam_tutup', ' ', 'trim|required|callback_buka_istirahat');
      	// $this->form_validation->set_rules('jam_mulai_istirahat', ' ', 'trim|required|callback_buka_istirahat');
      	// $this->form_validation->set_rules('jam_selesai_istirahat', ' ', 'trim|required|callback_istirahat_tutup');
      	$this->form_validation->set_rules('id_faskes', ' ', 'trim|required|numeric');
      	$this->form_validation->set_rules('id_dokter', ' ', 'trim|required|numeric');

      	$this->form_validation->set_rules('', '', 'trim');
      	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function buka_istirahat()
    {
      $jam_buka = new DateTime($this->input->post('jam_buka'));
      //$jam_tutup = new DateTime($this->input->post('jam_tutup'));
      $jam_mulai_istirahat = new DateTime($this->input->post('jam_tutup'));

      if(($jam_buka < $jam_mulai_istirahat) ==FALSE)
      {
        $this->form_validation->set_message('buka_istirahat', 'Jam kerja yang anda inputkan tidak valid');
                       return FALSE;
      }  else {

                         return TRUE;
      }
    }

    public function istirahat_tutup()
    {
      //jam_buka = new DateTime($this->input->post('jam_mulai_istirahat'));
      $jam_selesai_istirahat = new DateTime($this->input->post('jam_selesai_istirahat'));
      $jam_tutup = new DateTime($this->input->post('jam_tutup'));

      if(($jam_selesai_istirahat < $jam_tutup) ==FALSE)
      {
        $this->form_validation->set_message('istirahat_tutup', 'Jam kerja yang anda inputkan tidak valid');
                       return FALSE;
      }
      else {

                         return TRUE;
      }
    }

    public function hari()
    {
      $data = array(
          'id_dokter' => $this->input->post('id_dokter'),
          'id_faskes' => $this->input->post('id_faskes'),
          'hari' => $this->input->post('hari')
      );

      //cek apakah hari yang di inputkan faskes dah ada
      if ($this->faskes_praktek_dokter_model->cek_hari($data)->num_rows() >0 ) {
        $this->form_validation->set_message('hari', 'Anda sudah menginputkan Hari kerja dokter ini');
                       return FALSE;

      }
      else {

                         return TRUE;
      }
    }
}

/* End of file Faskes_praktek_dokter.php */
/* Location: ./application/controllers/Faskes_praktek_dokter.php */
