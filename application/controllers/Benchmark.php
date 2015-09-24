<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Benchmark extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Faskes_tipe_model','tipe');
	}

	public function benchmark()
	{
		$data['title'] = "Benchmark Formula";
		$data['tipe'] = $this->tipe->get_all();
		$this->load->view('benchmark_merge', $data);
	}


	public function index()
	{
		// $data= array(
		// 		'title' => 'Benchmark Page !',
		// 		'result' => '',
		// 		'waktu' => ''
		// );
		// $this->load->view('benchmark', $data);
		redirect('benchmark/euclidean');
		//$this->euclidean();
	}

	public function nodes()
	{
		$this->load->view('nodes');
	}

	public function nodes_json()
	{
		$data = $this->db->get('node_jalan')->result();
		echo json_encode($data);
	}

	public function haversine()
	{
		$data['title'] = "Haversine Formula benchmark";
		$this->benchmark->mark('haversin');
		$data['result'] = $this->db->query('select id_Faskes,nama_faskes,6371*(2*ASIN(SQRT(POWER(SIN((abs(latitude) - abs(-7.33026)) * pi()/180 / 2), 2) +
		COS(abs(-7.33026) * pi()/180 ) * COS(abs(latitude) * pi()/180)
		* POWER(SIN((longitude - 110.5) *pi()/180 / 2), 2) ))) as jarak from tb_faskes having jarak < 1;');
		$this->benchmark->mark('end_haversin');
		$data['waktu']= $this->benchmark->elapsed_time('haversin', 'end_haversin');
		$data['tipe'] = $this->tipe->get_all();
		$this->load->view('benchmark',$data);
	}

	public function haversine_open_close()
	{
		$data['title']= "Haversine dengan Jam Buka";
		$this->benchmark->mark('mulai');
	  //haversine nearby
	 	$data['result'] = $this->db->query('select fo.hari,fo.jam_buka,fo.jam_tutup,f.nama_faskes,6371*(2*ASIN(SQRT(POWER(SIN((abs(f.latitude) - abs(-7.33026)) * pi()/180 / 2), 2) +
	 COS(abs(-7.33026) * pi()/180 ) * COS(abs(f.latitude) * pi()/180)
	 * POWER(SIN((f.longitude - 110.5) *pi()/180 / 2), 2) ))) as jarak from tb_faskes f
	 join tb_faskes_open fo on fo.id_faskes = f.id_faskes

	 where fo.hari = WEEKDAY(now()) AND TIME(NOW()) BETWEEN fo.jam_buka AND fo.jam_tutup
	  AND TIME(NOW()) NOT BETWEEN fo.jam_mulai_istirahat and fo.jam_selesai_istirahat
	  having jarak < 1');
	  $this->benchmark->mark('selesai');
		$data['waktu'] = $this->benchmark->elapsed_time('mulai','selesai');
		$data['tipe'] = $this->tipe->get_all();
		$this->load->view('benchmark',$data);
	}


	public function euclidean()
	{
		$data['title']="Euclidean Distance";
		$this->benchmark->mark('euclidean');
		$data['result'] = $this->db->query('select nama_faskes,latitude,longitude,sqrt(power(abs(latitude)-abs(-7.33026),2)+power(abs(longitude)-abs(110.5),2))*111.319 as jarak
		from tb_faskes having jarak < 1;');
		$this->benchmark->mark('end_euclidean');
		$data['waktu'] = $this->benchmark->elapsed_time('euclidean', 'end_euclidean');
		$data['tipe'] = $this->tipe->get_all();
		$this->load->view('benchmark',$data);
	}

	public function euclidean_json()
	{
		$pass = explode(",",$this->uri->segment(3));
		$latUser = $pass[0];
		$longUser= $pass[1];
		$data = $this->db->query('select nama_faskes,latitude,longitude,sqrt(power(abs(latitude)-abs('.$latUser.'),2)
			+power(abs(longitude)-abs('.$longUser.'),2))*111.319 as jarak
		from tb_faskes having jarak < 1;')->result();
		echo json_encode($data);
	}

	public function euclidean_open_close()
	{
		//pytaghoran
		$data['title']="Euclidean Distance nearby open";
		$this->benchmark->mark('mulai');
		$data['result'] = $this->db->query('select fo.hari,fo.jam_buka,fo.jam_tutup,f.nama_faskes,
		sqrt(power(abs(f.latitude)-abs(-7.33026),2)+power(abs(f.longitude)-abs(110.5),2))*111.319 as jarak from tb_faskes f
		join tb_faskes_open fo on fo.id_faskes = f.id_faskes

		where fo.hari = WEEKDAY(now()) AND TIME(NOW()) BETWEEN fo.jam_buka AND fo.jam_tutup
		AND TIME(NOW()) NOT BETWEEN fo.jam_mulai_istirahat and fo.jam_selesai_istirahat
		having jarak < 1');
		$this->benchmark->mark('selesai');
		$data['waktu'] = $this->benchmark->elapsed_time('mulai', 'selesai');
		$data['tipe'] = $this->tipe->get_all();
		$this->load->view('benchmark',$data);
	}

	public function sphere_cos()
	{
		$data['title']="Spherical cos Distance";
		$this->benchmark->mark('sphercos');
		$data['result'] = $this->db->query('select nama_faskes,
		111.045* DEGREES(ACOS(COS(RADIANS(-7.33026))
		                 * COS(RADIANS(latitude))
		                 * COS(RADIANS(110.5) - RADIANS(longitude))
		                 + SIN(RADIANS(-7.33026))
		                 * SIN(RADIANS(latitude)))) AS jarak
		                 from tb_faskes having jarak < 1;');

		$this->benchmark->mark('end_sphercos');
		$data['waktu']= $this->benchmark->elapsed_time('sphercos', 'end_sphercos');
		$data['tipe'] = $this->tipe->get_all();
		$this->load->view('benchmark',$data);
	}

	public function sphere_cos_open_close()
	{
		$data['title']="Spherical Cos Open Close";
		$this->benchmark->mark('mulai');
		$data['result'] =  $this->db->query('select nama_faskes,
		111.045* DEGREES(ACOS(COS(RADIANS(-7.33026))
		                 * COS(RADIANS(latitude))
		                 * COS(RADIANS(110.5) - RADIANS(longitude))
		                 + SIN(RADIANS(-7.33026))
		                 * SIN(RADIANS(latitude)))) AS jarak

		                 from tb_faskes f
		                 JOIN tb_faskes_open fo on fo.id_faskes = f.id_faskes
							  where fo.hari = WEEKDAY(now()) AND TIME(NOW()) BETWEEN fo.jam_buka AND fo.jam_tutup
		 AND TIME(NOW()) NOT BETWEEN fo.jam_mulai_istirahat and fo.jam_selesai_istirahat
							  having jarak < 1;');
		$this->benchmark->mark('selesai');
		$data['tipe'] = $this->tipe->get_all();
		$data['waktu'] = $this->benchmark->elapsed_time('mulai','selesai');
		$this->load->view('benchmark',$data);
	}



}
