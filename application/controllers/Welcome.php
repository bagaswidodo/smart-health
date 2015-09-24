<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		//$this -> load -> view('welcome_message');
		//$this->adminLTE();



		$this->load->view('landing_page/index');
	}

	public function find_locations()
	{
		$this->load->model('Model_Health','health');
		// tangkap variabel keyword dari URL
		$keyword = $this->uri->segment(3);
		// cari di database
		//$data = $this->db->query("select nama_barang,kode_barang from coba where nama_barang like '%$keyword%' ");
		$data = $this->health->get_places($keyword);
		// format keluaran di dalam array
		foreach($data as $row)
		{
			$arr['query'] = $keyword;
			$arr['suggestions'][] = array(
				'value'	=>$row->nama,
				'data'	=>$row->latitude . ',' . $row->longitude
			);
		}
		// minimal PHP 5.2
		echo json_encode($arr);



	}


	public function locations() {
		$this -> load -> view('template/head');
		$this -> load -> view('template/header');

		$this->load->model('Faskes_tipe_model','tipe');
		$d['tipe'] = $this->tipe->get_all();
		$this -> load -> view('template/sidebar',$d);

		$latlng = $this->uri->segment(3);
		$contents =  @file_get_contents(base_url() . "benchmark_rest/haversine_open_close/" .$latlng);

		$json = json_decode($contents);
		$dt['jumlah'] = count($json->data);
		$dt['faskes'] = $json->data;
		$dt['waktu'] = $json->waktu;
		$dt['distance'] = $json->distance;

		$this -> load -> view('user/content',$dt);
		//change this
		$this -> load -> view('template/footer');
		$this -> load -> view('template/control_sidebar');
		$this -> load -> view('template/footer_asset');
	}

	public function faskes() {
		$this -> load -> view('template/head');
		$this -> load -> view('template/header');
		$this -> load -> view('template/sidebar');
		$this -> load -> view('user/faskes');
		//change this
		$this -> load -> view('template/footer');
		$this -> load -> view('template/control_sidebar');
		$this -> load -> view('template/footer_asset');
	}

	public function detail_faskes() {
		$this -> load -> view('template/head');
		$this -> load -> view('template/header');
		$this -> load -> view('template/sidebar');
		$this -> load -> view('user/detail_faskes');
		//change this
		$this -> load -> view('template/footer');
		$this -> load -> view('template/control_sidebar');
		$this -> load -> view('template/footer_asset');
	}
	public function tambah_faskes() {
		$this -> load -> view('template/head');
		$this -> load -> view('template/header');
		$this -> load -> view('template/sidebar');
		$this -> load -> view('user/tambah_faskes');
		//change this
		$this -> load -> view('template/footer');
		$this -> load -> view('template/control_sidebar');
		$this -> load -> view('template/footer_asset');
	}

	public function jadwal_dokter() {
		$this -> load -> view('template/head');
		$this -> load -> view('template/header');
		$this -> load -> view('template/sidebar');
		$this -> load -> view('user/jadwal_dokter_faskes');
		//change this
		$this -> load -> view('template/footer');
		$this -> load -> view('template/control_sidebar');
		$this -> load -> view('template/footer_asset');
	}

	public function route()
	{
		$this -> load -> view('template/head');
		$this -> load -> view('template/header');
		$this -> load -> view('template/sidebar');
		$this -> load -> view('user/route');
		//change this
		$this -> load -> view('template/footer');
		$this -> load -> view('template/control_sidebar');
		$this -> load -> view('template/footer_asset');
	}

	public function coba()
	{
		$this->load->view('coba');
	}

}
