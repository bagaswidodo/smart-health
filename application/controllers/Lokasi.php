<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lokasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('lokasi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $lokasi = $this->lokasi_model->get_all();


        $data = array(
            'lokasi_data' => $lokasi
        );

        $this->load->view('admin/lokasi/lokasi_list', $data);
    }

    public function json()
    {
         $lokasi = $this->lokasi_model->get_by_column(array('nama'=>$this->input->post('term')));
         $data['response'] = false;
         
          if(!empty($lokasi))
          {  
             $data['response'] = true;
             $data['message'] = array();
             foreach ($lokasi->result() as $row) {
                 $data['message'][] = array(
                                         'id'=>$row->latitude . "," . $row->longitude,
                                         'value' => $row->nama,
                                         ''
                                      );  //Add a row to array
             }
           }
         if('IS_AJAX')
         {
             echo json_encode($data); //echo json string if ajax request
         }
         else
         {
             //$this->load->view('autocomplete/index',$data); //Load html view of search results
             echo "whoops";
         }
    }

    public function read($id)
    {
        $row = $this->lokasi_model->get_by_id($id);
        if ($row) {
            $data = array(
		              'id' => $row->id,
		              'nama' => $row->nama,
		              'lokasi' => $row->lat . "," . $row->lng,
	               );

            $this->load->view('admin/lokasi/lokasi_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('lokasi'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('lokasi/create_action'),
      	    'id' => set_value('id'),
      	    'nama' => set_value('nama'),
      	    'lokasi' => '',
	      );
       $this->load->view('admin/lokasi/lokasi_form', $data);
    //  $this->load->view('admin/lokasi/maps',$data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $lok = explode(",", $this->input->post('lokasi',TRUE));
            $d = array(
		            'nama' => $this->input->post('nama',TRUE),
		            'lokasi' => "GeomFromText('POINT(".$lok[1] . " " .  $lok[0] . ")',0)",
	    );

      $q = "INSERT INTO tb_lokasi (nama, lokasi) VALUES ('$d[nama]',$d[lokasi])";

      $this->db->query($q);
          //  $this->lokasi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('lokasi'));
        }
    }

    public function update($id)
    {
        $row = $this->lokasi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('lokasi/update_action'),
		            'id' => set_value('id', $row->id),
		            'nama' => set_value('nama', $row->nama),
		            'lokasi' => set_value('lokasi', $row->lat . "," . $row->lng),
	    );
            //$this->load->view('tb_lokasi_form', $data);
            $this->load->view('admin/lokasi/lokasi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('lokasi'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
          $lok = explode(",",$this->input->post('lokasi',true));
              $d = array(
                'nama' => $this->input->post('nama',TRUE),
                'lokasi' => "GeomFromText('POINT(".$lok[1] . " " .  $lok[0] . ")',0)",
                'id' => $this->input->post('id', TRUE)
              );

              $q = "UPDATE tb_lokasi  SET nama='$d[nama]', lokasi=$d[lokasi] WHERE id = $d[id]";
              $this->db->query($q);
            $this->session->set_flashdata('message', 'Update Record Success');
           redirect(site_url('lokasi'));
        }
    }

    public function delete($id)
    {
        $row = $this->lokasi_model->get_by_id($id);

        if ($row) {
            $this->lokasi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('lokasi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('lokasi'));
        }
    }

    function _rules()
    {
    	$this->form_validation->set_rules('nama', ' ', 'trim|required');
    	$this->form_validation->set_rules('lokasi', ' ', 'trim|required');

    	$this->form_validation->set_rules('id', 'id', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Lokasi.php */
/* Location: ./application/controllers/Lokasi.php */
