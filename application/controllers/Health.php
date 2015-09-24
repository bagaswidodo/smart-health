<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Health extends CI_Controller {
	public function find() {
		redirect('welcome/locations');
	}

	public function findLocation() {
		$this->load->model('Model_Health');
		$keyword=$this->input->post('keyword');

    $rows=$this->Model_Health->get_places($keyword);

		$json_array = array();
        foreach ($rows as $row)
				{
					$d['data'] = $row->latitude . "," . $row->longitude;
					$d['label'] = $row->nama;
					array_push($json_array,$d);
				}

        echo json_encode($json_array);

	}

}
