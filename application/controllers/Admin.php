<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public $id_user;
	public $nama;
	public function __construct()
	{
		parent::__construct();
		if ( $this->session->userdata('logged_in')=="") {
			redirect('auth/login');
		}

		  $this->id_user = $this->session->userdata('uid');
			$this->nama 	 = $this->session->userdata('nama');
	}


	public function index()
	{
		 $data = array('nama' => $this->nama );

		$this->load->view('admin/head');
		$this->load->view('admin/header',$data);
			$this->load->view('admin/dashboard');
		$this->load->view('admin/footer');

	}
	public function faskes()
	{
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/content');
		$this->load->view('admin/footer');
	}

	public function add_faskes()
	{
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/tambah_faskes');
		$this->load->view('admin/footer');
	}
	public function jadwal_praktek()
	{
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/jadwal_praktek');
		$this->load->view('admin/footer');
	}
	public function jadwal_dokter()
	{
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/jadwal_dokter');
		$this->load->view('admin/footer');
	}
	public function tambah_jadwal_dokter()
	{
		$this->load->view('admin/head');
		$this->load->view('admin/header');
		$this->load->view('admin/tambah_jadwal_dokter');
		$this->load->view('admin/footer');
	}


}
