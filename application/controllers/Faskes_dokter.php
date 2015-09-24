<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faskes_dokter extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('faskes_dokter_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $faskes_dokter = $this->faskes_dokter_model->get_all();
        //print_r($faskes_dokter);
        $data = array(
            'faskes_dokter_data' => $faskes_dokter
        );

        $this->load->view('admin/faskes_dokter/faskes_dokter_list', $data);
    }

    public function read($id)
    {
        $data = array(
            'id_dokter' => $this->uri->segment(3),
            'id_faskes' => $this->uri->segment(4),
        );

        $row = $this->faskes_dokter_model->get_by_id($data);
        if ($row) {
              $data = array(
		              'id_dokter' => $row->id_dokter,
		              'id_faskes' => $row->id_faskes,
                  'nama_dokter' => $row->nama_dokter,
                  'nama_faskes' => $row->nama_faskes
	               );
            $this->load->view('admin/faskes_dokter/faskes_dokter_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('faskes_dokter'));
        }
    }

    public function create()
    {
          $data = array(
            'button' => 'Create',
            'action' => site_url('faskes_dokter/create_action'),
	          //'id_dokter' => set_value('id_dokter'),
	        //  'id_faskes' => set_value('id_faskes'),
            'id_dokter' => '',
            'id_faskes' => '',
            'jam_buka' => '',
            'jam_tutup' => '',
            'jam_mulai_istirahat' => '',
            'jam_selesai_istirahat' => '',
	         );
        $this->load->view('admin/faskes_dokter/faskes_dokter_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_dokter' => $this->input->post('id_dokter'),
                'id_faskes' => $this->input->post('id_faskes'),
                'jam_buka' => date("H:i:s", strtotime($this->input->post('jam_buka',TRUE))),
                'jam_tutup' => date("H:i:s", strtotime($this->input->post('jam_tutup',TRUE))),
                'jam_mulai_istirahat' => date("H:i:s", strtotime($this->input->post('jam_mulai_istirahat',TRUE))),
                'jam_selesai_istirahat' => date("H:i:s", strtotime($this->input->post('jam_selesai_istirahat',TRUE))),
	           );

            $this->faskes_dokter_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('faskes_dokter'));
        }
    }

    public function update($id)
    {
        $data = array(
            'id_dokter' => $this->uri->segment(3),
            'id_faskes' => $this->uri->segment(4),
        );

        $row = $this->faskes_dokter_model->get_by_id($data);
      //  $row = $this->faskes_dokter_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('faskes_dokter/update_action'),
		            'id_dokter' => set_value('id_dokter', $row->id_dokter),
		            'id_faskes' => set_value('id_faskes', $row->id_faskes),
                'nama_faskes' => $row->nama_faskes
	             );
            $this->load->view('admin/faskes_dokter/faskes_dokter_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('faskes_dokter'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_dokter', TRUE));
        } else {
            $data = array(
              'id_dokter' => $this->input->post('id_dokter', TRUE),
              'id_faskes' => $this->input->post('id_faskes', TRUE),

	           );

            $this->faskes_dokter_model->update($this->input->post('id_faskes', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('faskes_dokter'));
        }
    }

    public function delete($id)
    {
      $data = array(
          'id_dokter' => $this->uri->segment(3),
          'id_faskes' => $this->uri->segment(4),
      );
        $row = $this->faskes_dokter_model->get_by_id($data);

        if ($row) {
            $this->faskes_dokter_model->delete($data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('faskes_dokter'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('faskes_dokter'));
        }
    }

    function _rules()
    {

    	$this->form_validation->set_rules('id_dokter', 'id_dokter', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Faskes_dokter.php */
/* Location: ./application/controllers/Faskes_dokter.php */
