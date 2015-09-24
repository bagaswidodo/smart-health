<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faskes extends CI_Controller
{
  public $id_user;
  public $nama;

    function __construct()
    {
        parent::__construct();
        $this->load->model('faskes_model');
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

        //$faskes = $this->faskes_model->get_all();
        $faskes = $this->faskes_model->get_all_logged($this->id_user);

        $data = array(
            'faskes_data' => $faskes
        );

        $this->kepala();
        $this->load->view('admin/faskes/faskes_list', $data);
        //$this->load->view('admin/content');
        $this->load->view('admin/footer');

    }

    public function json()
    {
        $q = $this->input->get('q');
        $faskes = $this->faskes_model->search_by_name($q);

        // $data = array(
        //     'faskes_data' => $faskes
        // );
        foreach ($faskes as $v) {

              $data[] = array('id' => $v->id_faskes, 'text' => $v->nama_faskes);

        }

      //  $this->load->view('admin/faskes/faskes_list', $data);
      echo json_encode($data);
    }


    public function read($id)
    {
        $row = $this->faskes_model->get_by_id($id);
        if ($row) {
                $data = array(
              		'id_faskes' => $row->id_faskes,
              		'nama_faskes' => $row->nama_faskes,
              		'id_tipe' => $row->id_tipe,
              		'alamat' => $row->alamat,
              		'no_telpon' => $row->no_telpon,
              		'foto' => $row->foto,
              		'location' =>  $row->lat . "," . $row->lng,
    	           );
            $this->load->view('admin/faskes/faskes_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('faskes'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('faskes/create_action'),
      	    'id_faskes' => set_value('id_faskes'),
      	    'nama_faskes' => set_value('nama_faskes'),
      	    'id_tipe' => set_value('id_tipe'),
      	    'alamat' => set_value('alamat'),
      	    'no_telpon' => set_value('no_telpon'),
      	    'foto' => set_value('foto'),
      	    'location' => set_value('location'),


	         );

      $this->kepala();
      $this->load->view('admin/faskes/faskes_form', $data);
      //$this->load->view('admin/content');
      $this->load->view('admin/footer');

        //  $this->load->view('admin/faskes/faskes_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $lok = explode(",",$this->input->post('location',TRUE));
            $data = array(
                  		'nama_faskes' => $this->input->post('nama_faskes',TRUE),
                  		'id_tipe' => $this->input->post('id_tipe',TRUE),
                  		'alamat' => $this->input->post('alamat',TRUE),
                  		'no_telpon' => $this->input->post('no_telpon',TRUE),
                  		'foto' => $this->input->post('foto',TRUE),
                      'latitude'=>$lok[0],
                      'longitude'=>$lok[1],
                      //'id_user' => 1 //administrator only
                      'id_user' => $this->id_user, //dynamically
                  		//'location' =>  "GeomFromText('POINT(".$lok[1] . " " .  $lok[0] . ")',0)",
	                );

            $this->faskes_model->insert($data);
          //  $q ="INSERT INTO `tb_faskes` (`nama_faskes`, `id_tipe`, `alamat`, `no_telpon`, `foto`, `location`)
            //VALUES ('$data[nama_faskes]', '$data[id_tipe]', '$data[alamat]', '$data[no_telpon]', '$data[foto]', $data[location])";
          //  $this->db->query($q);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('faskes'));
        }
    }

    public function update($id)
    {
        $row = $this->faskes_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('faskes/update_action'),
            		'id_faskes' => set_value('id_faskes', $row->id_faskes),
            		'nama_faskes' => set_value('nama_faskes', $row->nama_faskes),
            		'id_tipe' => set_value('id_tipe', $row->id_tipe),
            		'alamat' => set_value('alamat', $row->alamat),
            		'no_telpon' => set_value('no_telpon', $row->no_telpon),
            		'foto' => set_value('foto', $row->foto),
            		'location' => set_value('location', $row->latitude . "," . $row->longitude),
	             );

               $this->kepala();
               $this->load->view('admin/faskes/faskes_form', $data);
               //$this->load->view('admin/content');
               $this->load->view('admin/footer');

            //$this->load->view('admin/faskes/faskes_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('faskes'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_faskes', TRUE));
        } else {
            $data = array(
        		'nama_faskes' => $this->input->post('nama_faskes',TRUE),
        		'id_tipe' => $this->input->post('id_tipe',TRUE),
        		'alamat' => $this->input->post('alamat',TRUE),
        		'no_telpon' => $this->input->post('no_telpon',TRUE),
        		'foto' => $this->input->post('foto',TRUE),
        		'location' => $this->input->post('location',TRUE),
        	    );

              $lok = explode(",",$this->input->post('location',TRUE));
              $data = array(
                    		'nama_faskes' => $this->input->post('nama_faskes',TRUE),
                    		'id_tipe' => $this->input->post('id_tipe',TRUE),
                    		'alamat' => $this->input->post('alamat',TRUE),
                    		'no_telpon' => $this->input->post('no_telpon',TRUE),
                    		'foto' => $this->input->post('foto',TRUE),
                        'latitude'=>$lok[0],
                        'longitude'=> $lok[1],
                        //'id_user' => 1, //administrator
                          'id_user' => $this->id_user,
                    		//'location' =>  "GeomFromText('POINT(".$lok[1] . " " .  $lok[0] . ")',0)",
                        'id_faskes' => $this->input->post('id_faskes',TRUE)
  	                );

              //$this->faskes_model->insert($data)
            //  $q ="UPDATE `tb_faskes` SET `nama_faskes` = '$data[nama_faskes]', `id_tipe` = '$data[id_tipe]', `alamat` = '$data[alamat]',
              // `no_telpon` = '$data[no_telpon]',
            //  `foto` ='$data[foto]', `location` =  $data[location] WHERE `id_faskes` = ' $data[id_faskes]'";
            //  $this->db->query($q);

            $this->faskes_model->update($this->input->post('id_faskes', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('faskes'));
        }
    }

    public function delete($id)
    {
        $row = $this->faskes_model->get_by_id($id);

        if ($row) {
            $this->faskes_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('faskes'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('faskes'));
        }
    }

    function _rules()
    {
      	$this->form_validation->set_rules('nama_faskes', ' ', 'trim|required');
      	$this->form_validation->set_rules('id_tipe', ' ', 'trim|required|numeric');
      	$this->form_validation->set_rules('alamat', ' ', 'trim|required');
      	$this->form_validation->set_rules('no_telpon', ' ', 'trim|required|numeric');
      	$this->form_validation->set_rules('foto', ' ', 'trim|required');
      	$this->form_validation->set_rules('location', ' ', 'trim|required');

      	$this->form_validation->set_rules('id_faskes', 'id_faskes', 'trim');
      	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Faskes.php */
/* Location: ./application/controllers/Faskes.php */
