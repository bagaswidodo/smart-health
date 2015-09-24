<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faskes_tipe extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('faskes_tipe_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $faskes_tipe = $this->faskes_tipe_model->get_all();

        $data = array(
            'faskes_tipe_data' => $faskes_tipe
        );

        $this->load->view('admin/faskes_tipe/faskes_tipe_list', $data);
    }

    public function tipe_json()
    {
      $q = $this->input->get('q');
      $faskes_tipe = $this->faskes_tipe_model->get_by_keyword($q);

      /*
      $data = array(
          'faskes_tipe_data' => $faskes_tipe
      );
      */
      foreach ($faskes_tipe as $v) {
          $data[] = array('id' => $v->id_tipe, 'text' => $v->deskripsi);
      }

      //print_r($data);
      echo json_encode($data);
    }

    public function read($id)
    {
        $row = $this->faskes_tipe_model->get_by_id($id);
        if ($row) {
            $data = array(
                		'id_tipe' => $row->id_tipe,
                		'deskripsi' => $row->deskripsi,
	                 );
            $this->load->view('admin/faskes_tipe/faskes_tipe_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('faskes_tipe'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('faskes_tipe/create_action'),
      	    'id_tipe' => set_value('id_tipe'),
      	    'deskripsi' => set_value('deskripsi'),
	         );
        $this->load->view('admin/faskes_tipe/faskes_tipe_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		              'deskripsi' => $this->input->post('deskripsi',TRUE),
	               );

            $this->faskes_tipe_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('faskes_tipe'));
        }
    }

    public function update($id)
    {
        $row = $this->faskes_tipe_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('faskes_tipe/update_action'),
          		    'id_tipe' => set_value('id_tipe', $row->id_tipe),
          		'deskripsi' => set_value('deskripsi', $row->deskripsi),
	           );
            $this->load->view('admin/faskes_tipe/faskes_tipe_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('faskes_tipe'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_tipe', TRUE));
        } else {
            $data = array(
		              'deskripsi' => $this->input->post('deskripsi',TRUE),
	               );

            $this->faskes_tipe_model->update($this->input->post('id_tipe', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('faskes_tipe'));
        }
    }

    public function delete($id)
    {
        $row = $this->faskes_tipe_model->get_by_id($id);

        if ($row) {
            $this->faskes_tipe_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('faskes_tipe'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('faskes_tipe'));
        }
    }

    function _rules()
    {
    	$this->form_validation->set_rules('deskripsi', ' ', 'trim|required');

    	$this->form_validation->set_rules('id_tipe', 'id_tipe', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Faskes_tipe.php */
/* Location: ./application/controllers/Faskes_tipe.php */
