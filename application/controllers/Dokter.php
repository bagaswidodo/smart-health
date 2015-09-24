<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dokter extends CI_Controller
{

  public $id_user;
	public $nama;
	public function __construct()
	{
		parent::__construct();
		if ( $this->session->userdata('logged_in')=="") {
			redirect('auth/login');
		}
    $this->load->model('model_dokter');
    $this->load->library('form_validation');

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
        $dokter = $this->model_dokter->get_all();

        $data = array(
            'dokter_data' => $dokter
        );

        $this->load->view('admin/dokter/dokter_list', $data);
    }

    public function dokter_faskes()
    {
        $id_faskes = $this->uri->segment(3);

        $this->load->model('Faskes_model', 'faskes');


        $dokter = $this->model_dokter->get_dokter_faskes($id_faskes);

        $data = array(
            'dokter_data' => $dokter,
            'nama_faskes' =>$this->faskes->get_name($id_faskes)->nama_faskes,
            'id_faskes' => $id_faskes
        );

      $this->kepala();
      //  $this->load->view('admin/faskes/faskes_list', $data);
        $this->load->view('admin/dokter/dokter_list', $data);
        //$this->load->view('admin/content');
        $this->load->view('admin/footer');
        //$this->load->view('admin/dokter/dokter_list', $data);
    }

    public function json()
    {
        $dokter = $this->model_dokter->search_name($this->input->get('q'));

        foreach ($dokter as $v) {

              $data[] = array('id' => $v->id_dokter, 'text' => $v->nama_dokter);

        }

        echo json_encode($data);
    }

    public function read($id)
    {
        $row = $this->model_dokter->get_by_id($id);
        if ($row) {
            $data = array(
          		'id_dokter' => $row->id_dokter,
          		'nama_dokter' => $row->nama_dokter,
          		'alamat' => $row->alamat,
          		'nomor_telpon' => $row->nomor_telpon,
        	    );
            $this->load->view('admin/dokter/dokter_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dokter'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('dokter/create_action'),
      	    'id_dokter' => set_value('id_dokter'),
            'id_faskes' => set_value('id_faskes'),
      	    'nama_dokter' => set_value('nama_dokter'),
      	    'alamat' => set_value('alamat'),
      	    'nomor_telpon' => set_value('nomor_telpon'),
            'aksi'=>'tambahkan'
	         );

           $this->kepala();
           $this->load->view('admin/dokter/dokter_form', $data);
           //$this->load->view('admin/content');
           $this->load->view('admin/footer');

    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                  'id_faskes' => $this->input->post('id_faskes',TRUE),
              		'nama_dokter' => $this->input->post('nama_dokter',TRUE),
              		'alamat' => $this->input->post('alamat',TRUE),
              		'nomor_telpon' => $this->input->post('nomor_telpon',TRUE),
	               );

            $this->model_dokter->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('dokter/dokter_faskes/' . $data['id_faskes']));
        }
    }

    public function update($finder)
    {
      //solve this

        if(count($finder)>1)
        {
          $data = array(
            'id_faskes' => $finder['id_faskes'],
            'id_dokter' => $finder['id_dokter']
          );

        }else{
          $data = array(
              'id_faskes' => $this->uri->segment(3),
              'id_dokter' => $this->uri->segment(4)
          );
        }


        $row = $this->model_dokter->get_by_id($data);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('dokter/update_action'),
            		'id_dokter' => set_value('id_dokter', $row->id_dokter),
                'id_faskes' => set_value('id_faskes',$row->id_faskes),
            		'nama_dokter' => set_value('nama_dokter', $row->nama_dokter),
            		'alamat' => set_value('alamat', $row->alamat),
            		'nomor_telpon' => set_value('nomor_telpon', $row->nomor_telpon),
                'aksi'=>'ubah'
	             );
          //  $this->load->view('admin/dokter/dokter_form', $data);
          $this->kepala();
          $this->load->view('admin/dokter/dokter_form', $data);
          $this->load->view('admin/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dokter/dokter_faskes/' . $data['id_faskes']));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $finder = array(
                'id_faskes' => $this->input->post('id_faskes', TRUE),
                'id_dokter' => $this->input->post('id_dokter', TRUE),
            );
            $this->update($finder);
        } else {
            $data = array(
              'id_faskes' => $this->input->post('id_faskes', TRUE),
          		'nama_dokter' => $this->input->post('nama_dokter',TRUE),
          		'alamat' => $this->input->post('alamat',TRUE),
          		'nomor_telpon' => $this->input->post('nomor_telpon',TRUE),
	             );

            $this->model_dokter->update($this->input->post('id_dokter', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
          redirect(site_url('dokter/dokter_faskes/' . $data['id_faskes']));
        }
    }

    public function delete($id)
    {
      $data = array(
          'id_faskes' => $this->uri->segment(3),
          'id_dokter' => $this->uri->segment(4)
      );
        $row = $this->model_dokter->get_by_id($data);

        if ($row) {
            $this->model_dokter->delete($data);
            $this->session->set_flashdata('message', 'Delete Record Success');
          //  redirect(site_url('dokter'));
          redirect(site_url('dokter/dokter_faskes/' . $data['id_faskes']));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
          //  redirect(site_url('dokter'));
          redirect(site_url('dokter/dokter_faskes/' . $data['id_faskes']));
        }
    }

    function _rules()
    {
      	$this->form_validation->set_rules('nama_dokter', ' ', 'trim|required');
      	$this->form_validation->set_rules('alamat', ' ', 'trim|required');
      	$this->form_validation->set_rules('nomor_telpon', ' ', 'trim|required');

      	$this->form_validation->set_rules('id_dokter', 'id_dokter', 'trim');
      	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Dokter.php */
/* Location: ./application/controllers/Dokter.php */
