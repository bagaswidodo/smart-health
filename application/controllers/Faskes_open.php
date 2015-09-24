<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faskes_open extends CI_Controller
{
  public $id_user;
  public $nama;

    function __construct()
    {
        parent::__construct();
        $this->load->model('faskes_open_model');
        $this->load->library('form_validation');

        //cek session_
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
        $faskes_open = $this->faskes_open_model->get_all();

        $data = array(
            'faskes_open_data' => $faskes_open,
            'title' => 'Jadwal Praktek'
        );

        $this->load->view('admin/faskes_open/faskes_open_list', $data);
    }

    public function jadwal()
    {
        $id_faskes = $this->uri->segment(3);

        $faskes_open = $this->faskes_open_model->get_jadwal($id_faskes);

        $data = array(
            'faskes_open_data' => $faskes_open,
            'title' => 'Jadwal Praktek'
        );

        $this->kepala();


        $this->load->view('admin/faskes_open/faskes_open_list', $data);
        //$this->load->view('admin/content');
        $this->load->view('admin/footer');


    }

    public function read($id)
    {
        $data = array(
            'id_faskes' => $this->uri->segment(3),
            'hari' => $this->uri->segment(4)
        );

        $row = $this->faskes_open_model->get_by_id($data);
        if ($row) {
            $data = array(
          		'id_faskes' => $row->id_faskes,
          		'hari' => $row->hari,
          		'jam_buka' => $row->jam_buka,
          		'jam_tutup' => $row->jam_tutup,
          		'jam_mulai_istirahat' => $row->jam_mulai_istirahat,
          		'jam_selesai_istirahat' => $row->jam_selesai_istirahat,
	    );
            $this->load->view('admin/faskes_open/faskes_open_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('faskes_open'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('faskes_open/create_action'),
      	    'id_faskes' => set_value('id_faskes', $this->uri->segment(3)),//unsecured
      	    'hari' => set_value('hari'),
      	    'jam_buka' => set_value('jam_buka'),
      	    'jam_tutup' => set_value('jam_tutup'),
      	    'jam_mulai_istirahat' => set_value('jam_mulai_istirahat'),
      	    'jam_selesai_istirahat' => set_value('jam_selesai_istirahat'),
            'aksi' => 'Tambahkan'
	         );


          $this->kepala();
           $this->load->view('admin/faskes_open/faskes_open_form', $data);
           //$this->load->view('admin/faskes_open/faskes_open_list', $data);
           //$this->load->view('admin/content');
           $this->load->view('admin/footer');

      //  $this->load->view('admin/faskes_open/faskes_open_form', $data);
    }

    public function create_action()
    {

     $cek = $this->input->post('sore',TRUE);


      if($cek)
     {
      $this->_rules();
      }else {
          $this->form_validation->set_rules('id_faskes', ' ', 'trim|required|numeric');
        	$this->form_validation->set_rules('hari', ' ', 'trim|required|numeric|callback_hari');
       	  $this->form_validation->set_rules('jam_buka', ' ', 'trim|required|callback_buka_istirahat');
       	  $this->form_validation->set_rules('jam_mulai_istirahat', ' ', 'trim|required|callback_buka_istirahat');

        	$this->form_validation->set_rules('', '', 'trim');
        	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
      }


        //$this->_rules();
        //
          if ($this->form_validation->run() == FALSE) {
              $this->create();
          } else {




             $data = array(
             		'id_faskes' => $this->input->post('id_faskes',TRUE),
             		'hari' => $this->input->post('hari',TRUE),
             		'jam_buka' => date("H:i:s", strtotime($this->input->post('jam_buka',TRUE))),
             		'jam_tutup' => date("H:i:s", strtotime($this->input->post('jam_tutup',TRUE))),
	              );

                if($cek)
                {

                  $data['jam_mulai_istirahat'] =  date("H:i:s", strtotime($this->input->post('jam_mulai_istirahat',TRUE)));
               		$data['jam_selesai_istirahat']= date("H:i:s", strtotime($this->input->post('jam_selesai_istirahat',TRUE)));

                }else {
                  $data['jam_tutup'] = date("H:i:s", strtotime($this->input->post('jam_mulai_istirahat',TRUE)));
                }
                //print_r($data);

             $this->faskes_open_model->insert($data);
             $this->session->set_flashdata('message', 'Create Record Success');
             redirect(site_url('faskes_open/jadwal/' . $data['id_faskes']));
       }
    }

    public function update($param)
    {


        if(count($param) == 2)
        {
          $cari = array(
              'id_faskes' => $param['id_faskes'],
               'hari' =>$param['hari']
           );


        } else {
           $cari = array(
              'id_faskes' => $this->uri->segment(3),
              'hari' =>$this->uri->segment(4)
           );
        }

        $row = $this->faskes_open_model->get_by_id($cari);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('faskes_open/update_action'),
            		'id_faskes' => set_value('id_faskes', $row->id_faskes),
                'nama_faskes'=> $row->nama_faskes,
            		'hari' => set_value('hari', $row->hari),
            		'jam_buka' => set_value('jam_buka', $row->jam_buka),
            		'jam_tutup' => set_value('jam_tutup', $row->jam_tutup),
            		'jam_mulai_istirahat' => set_value('jam_mulai_istirahat', $row->jam_mulai_istirahat),
            		'jam_selesai_istirahat' => set_value('jam_selesai_istirahat', $row->jam_selesai_istirahat),
                'aksi'=>'ubah'
	             );

               if(($row->jam_mulai_istirahat == "00:00:00" && $row->jam_selesai_istirahat == "00:00:00") ||
               ($row->jam_mulai_istirahat == NULL && $row->jam_selesai_istirahat == NULL))
               {
                 $data['jam_mulai_istirahat'] = set_value('jam_tutup', $row->jam_tutup);
                 $data['jam_tutup'] = set_value('jam_tutup', '');
                 $data['jam_selesai_istirahat'] = set_value('jam_selesai_istirahat', '');
               }

              $this->kepala();
              $this->load->view('admin/faskes_open/faskes_open_form', $data);
              $this->load->view('admin/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('faskes_open/jadwal/' . $data['id_faskes']));
        }
    }

    public function update_action()
    {

        $cek = $this->input->post('sore',TRUE);
        if($cek)
        {
          //$this->_rules();
          $this->form_validation->set_rules('jam_buka', ' ', 'trim|required|callback_buka_istirahat');
          $this->form_validation->set_rules('jam_tutup', ' ', 'trim|required|callback_istirahat_tutup');
          $this->form_validation->set_rules('jam_mulai_istirahat', ' ', 'trim|required|callback_buka_istirahat');
          $this->form_validation->set_rules('jam_selesai_istirahat', ' ', 'trim|required|callback_istirahat_tutup');

          $this->form_validation->set_rules('', '', 'trim');
          $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        }else {
          //$this->_rules();
          $this->form_validation->set_rules('jam_buka', ' ', 'trim|required|callback_buka_istirahat');
          $this->form_validation->set_rules('jam_mulai_istirahat', ' ', 'trim|required|callback_buka_istirahat');

          $this->form_validation->set_rules('', '', 'trim');
          $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        }



        if ($this->form_validation->run() == FALSE) {
        //  redirect('admin');
          //  $this->update($this->input->post('', TRUE));
          $param = array(
            'id_faskes' => $this->input->post('id_faskes',TRUE),
            'hari' => $this->input->post('hari',TRUE),
          );
          $this->update($param);
        } else {

            $data = array(
            		'id_faskes' => $this->input->post('id_faskes',TRUE),
            		'hari' => $this->input->post('hari',TRUE)
	             );

               if($cek)
               {
                 $data['jam_buka'] = $this->input->post('jam_buka',TRUE);
             		 $data['jam_tutup'] = $this->input->post('jam_tutup',TRUE);
             		 $data['jam_mulai_istirahat'] = $this->input->post('jam_mulai_istirahat',TRUE);
             		 $data['jam_selesai_istirahat'] = $this->input->post('jam_selesai_istirahat',TRUE);
              }else{
                $data['jam_buka'] = $this->input->post('jam_buka',TRUE);
                $data['jam_tutup'] = $this->input->post('jam_mulai_istirahat',TRUE);
                $data['jam_mulai_istirahat'] = $this->input->post('jam_tutup',TRUE);
                $data['jam_selesai_istirahat'] = $this->input->post('jam_selesai_istirahat',TRUE);
              }


               $finder = array(
                  'id_faskes' => $this->input->post('id_faskes',TRUE),
             		  'hari' => $this->input->post('hari',TRUE)
               );
            $this->faskes_open_model->update($finder, $data);
            $this->session->set_flashdata('message', 'Update Record Success');

            redirect(site_url('faskes_open/jadwal/' . $data['id_faskes']));
        }
    }

    public function delete($id)
    {
        $data = array(
            'id_faskes' => $this->uri->segment(3),
            'hari' => $this->uri->segment(4)
        );
        $row = $this->faskes_open_model->get_by_id($data);

        if ($row) {
            $this->faskes_open_model->delete($data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('faskes_open/jadwal/' . $data['id_faskes']));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('faskes_open/jadwal/' . $data['id_faskes']));
        }
    }

    function _rules()
    {
    	$this->form_validation->set_rules('id_faskes', ' ', 'trim|required|numeric');
    	$this->form_validation->set_rules('hari', ' ', 'trim|required|numeric|callback_hari');
    	$this->form_validation->set_rules('jam_buka', ' ', 'trim|required|callback_buka_istirahat');
    	$this->form_validation->set_rules('jam_tutup', ' ', 'trim|required|callback_istirahat_tutup');
    	$this->form_validation->set_rules('jam_mulai_istirahat', ' ', 'trim|required|callback_buka_istirahat');
    	$this->form_validation->set_rules('jam_selesai_istirahat', ' ', 'trim|required|callback_istirahat_tutup');

    	$this->form_validation->set_rules('', '', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function buka_istirahat()
    {
      $jam_buka = new DateTime($this->input->post('jam_buka'));
      //$jam_tutup = new DateTime($this->input->post('jam_tutup'));
      $jam_mulai_istirahat = new DateTime($this->input->post('jam_mulai_istirahat'));

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
          'id_faskes' => $this->input->post('id_faskes'),
          'hari' => $this->input->post('hari')
      );

      //cek apakah hari yang di inputkan faskes dah ada
      if ($this->faskes_open_model->getByData($data)->num_rows() >0 ) {
        $this->form_validation->set_message('hari', 'Anda sudah menginputkan Hari kerja Faskes ini');
                       return FALSE;

      }
      else {

                         return TRUE;
      }
    }
}

/* End of file Faskes_open.php */
/* Location: ./application/controllers/Faskes_open.php */
