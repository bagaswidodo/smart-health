<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dokter_faskes extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('dokter_faskes_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $dokter_faskes = $this->dokter_faskes_model->get_all();

        $data = array(
            'dokter_faskes_data' => $dokter_faskes
        );

        $this->load->view('tb_dokter_list', $data);
    }

    public function read($id)
    {
        $row = $this->dokter_faskes_model->get_by_id($id);
        if ($row) {
            $data = array(
              		'id_dokter' => $row->id_dokter,
              		'nama_dokter' => $row->nama_dokter,
              		'alamat' => $row->alamat,
              		'nomor_telpon' => $row->nomor_telpon,
	               );
            $this->load->view('tb_dokter_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dokter_faskes'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('dokter_faskes/create_action'),
      	    'id_dokter' => set_value('id_dokter'),
      	    'nama_dokter' => set_value('nama_dokter'),
      	    'alamat' => set_value('alamat'),
      	    'nomor_telpon' => set_value('nomor_telpon'),
	         );
        $this->load->view('tb_dokter_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
              		'nama_dokter' => $this->input->post('nama_dokter',TRUE),
              		'alamat' => $this->input->post('alamat',TRUE),
              		'nomor_telpon' => $this->input->post('nomor_telpon',TRUE),
	                 );

            $this->dokter_faskes_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('dokter_faskes'));
        }
    }

    public function update($id)
    {
        $row = $this->dokter_faskes_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('dokter_faskes/update_action'),
            		'id_dokter' => set_value('id_dokter', $row->id_dokter),
            		'nama_dokter' => set_value('nama_dokter', $row->nama_dokter),
            		'alamat' => set_value('alamat', $row->alamat),
            		'nomor_telpon' => set_value('nomor_telpon', $row->nomor_telpon),
	             );
            $this->load->view('tb_dokter_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dokter_faskes'));
        }
    }

    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_dokter', TRUE));
        } else {
              $data = array(
          		'nama_dokter' => $this->input->post('nama_dokter',TRUE),
          		'alamat' => $this->input->post('alamat',TRUE),
          		'nomor_telpon' => $this->input->post('nomor_telpon',TRUE),
      	    );

            $this->dokter_faskes_model->update($this->input->post('id_dokter', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('dokter_faskes'));
        }
    }

    public function delete($id)
    {
        $row = $this->dokter_faskes_model->get_by_id($id);

        if ($row) {
            $this->dokter_faskes_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('dokter_faskes'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dokter_faskes'));
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

/* End of file Dokter_faskes.php */
/* Location: ./application/controllers/Dokter_faskes.php */
