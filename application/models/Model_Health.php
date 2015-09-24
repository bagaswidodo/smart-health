<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Health extends CI_Model {

	public function __construct() {
		// Call the CI_Model constructor
		parent::__construct();
	}

	public function get_places($q) {
		$this -> db -> select('nama ,x(lokasi) as latitude,y(lokasi) as longitude');
		$this -> db -> like('nama', $q);
		$query = $this -> db -> get('tb_lokasi');
		return $query->result();
	}

}
