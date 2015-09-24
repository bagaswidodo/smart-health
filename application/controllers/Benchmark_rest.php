<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Benchmark_rest extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}


	public function haversine()
	{
		$json=array();
		$pass = explode(",",$this->uri->segment(3));
		$latUser = $pass[0];
		$longUser= $pass[1];
		//$distance = ($this->uri->segment(4) == NULL) ? 1 : $this->uri->segment(4);

		$jarak = $this->uri->segment(4);
		$tipe = $this->uri->segment(5);
		if($jarak == NULL)
		{	$distance = 1;
			$queryBaru = ' having jarak < 1';
		}
		else if($jarak != NULL && $tipe == NULL)
		{
			$distance = $jarak;
			$queryBaru = ' having jarak < '. $jarak;
		}
		else 
		{
			$distance = $jarak;
			// $tipe = $tipe;
			$queryBaru = ' WHERE id_tipe = ' .$tipe. ' having jarak < '. $jarak;
		}


		$this->benchmark->mark('haversine_start');
		$data = $this->db->query('select id_Faskes,nama_faskes,latitude,longitude,id_tipe,
			6371*(2*ASIN(SQRT(POWER(SIN((abs(latitude) - abs('.$latUser.')) * pi()/180 / 2), 2) +
		    COS(abs('.$latUser.') * pi()/180 ) * COS(abs(latitude) * pi()/180)
		* POWER(SIN((longitude - '.$longUser.') *pi()/180 / 2), 2) ))) as jarak 
		from tb_faskes ' . $queryBaru)->result();
		// having jarak < '.$distance.' ORDER BY jarak ASC;')->result();
		$this->benchmark->mark('heversine_end');
		$json['waktu'] = $this->benchmark->elapsed_time('haversine_start', 'haversine_end');
		$json['data'] = $data;
		$json['distance'] = $distance;

		echo json_encode($json);
	}

	public function haversine_open_close()
	{
		$pass = explode(",",$this->uri->segment(3));
		$latUser = $pass[0];
		$longUser= $pass[1];
		$jarak = $this->uri->segment(4);
		$tipe = $this->uri->segment(5);

		if($jarak == NULL)
		{	$distance = 1;
			$queryBaru = ' having jarak < 1';
		}
		else if($jarak != NULL && $tipe == NULL)
		{
			$distance = $jarak;
			$queryBaru = ' having jarak < '. $jarak;
		}
		else 
		{
			$distance = $jarak;
			// $tipe = $tipe;
			$queryBaru = ' AND f.id_tipe = ' .$tipe. ' having jarak < '. $jarak;
		}

			
		$this->benchmark->mark('haversine_start');
	 	$data = $this->db->query('select fo.hari,fo.jam_buka,fo.jam_tutup,f.nama_faskes,f.latitude,f.longitude,f.id_tipe,
	 		 6371*(2*ASIN(SQRT(POWER(SIN((abs(f.latitude) - abs('.$latUser.')) * pi()/180 / 2), 2) +
			 COS(abs('.$latUser.') * pi()/180 ) * COS(abs(f.latitude) * pi()/180)
			 * POWER(SIN((f.longitude - '.$longUser.') *pi()/180 / 2), 2) ))) as jarak from tb_faskes f
			 join tb_faskes_open fo on fo.id_faskes = f.id_faskes

			 where fo.hari = WEEKDAY(now()) AND TIME(NOW()) BETWEEN fo.jam_buka AND fo.jam_tutup
			  AND TIME(NOW()) NOT BETWEEN fo.jam_mulai_istirahat and fo.jam_selesai_istirahat '. $queryBaru)->result();

	 	$this->benchmark->mark('haversine_end');
	 	$json['waktu'] = $this->benchmark->elapsed_time('haversine_start', 'haversine_end');
		$json['data'] = $data;
		$json['distance'] = $distance;
		echo json_encode($json);
	}


	public function euclidean()
	{
		$json = array();
		$pass = explode(",",$this->uri->segment(3));
		$latUser = $pass[0];
		$longUser= $pass[1];
		// $distance = ($this->uri->segment(4) == NULL) ? 1 : $this->uri->segment(4);


		$jarak = $this->uri->segment(4);
		$tipe = $this->uri->segment(5);

		if($jarak == NULL)
		{	$distance = 1;
			$queryBaru = ' having jarak < 1';
		}
		else if($jarak != NULL && $tipe == NULL)
		{
			$distance = $jarak;
			$queryBaru = ' having jarak < '. $jarak;
		}
		else 
		{
			$distance = $jarak;
			// $tipe = $tipe;
			$queryBaru = ' WHERE id_tipe = ' .$tipe. ' having jarak < '. $jarak;
		}


		$this->benchmark->mark('euclidean');
		$data = $this->db->query('select nama_faskes,latitude,longitude,sqrt(power(abs(latitude)-abs('.$latUser.'),2)
			+power(abs(longitude)-abs('.$longUser.'),2))*111.319 as jarak
		from tb_faskes ' . $queryBaru)->result();
		// having jarak < '.$distance.';')->result();
		$this->benchmark->mark('end_euclidean');
		$json['waktu'] = $this->benchmark->elapsed_time('euclidean', 'end_euclidean');
		$json['data'] = $data;
		$json['distance'] = $distance;
		echo json_encode($json);
	}

	public function euclidean_open_close()
	{
		$pass = explode(",",$this->uri->segment(3));
		$latUser = $pass[0];
		$longUser= $pass[1];
		// $distance = ($this->uri->segment(4) == NULL) ? 1 : $this->uri->segment(4);

		$jarak = $this->uri->segment(4);
		$tipe = $this->uri->segment(5);

		if($jarak == NULL)
		{	$distance = 1;
			$queryBaru = ' having jarak < 1';
		}
		else if($jarak != NULL && $tipe == NULL)
		{
			$distance = $jarak;
			$queryBaru = ' having jarak < '. $jarak;
		}
		else 
		{
			$distance = $jarak;
			// $tipe = $tipe;
			$queryBaru = ' AND f.id_tipe = ' .$tipe. ' having jarak < '. $jarak;
		}

		//pytaghoran
		$this->benchmark->mark('euclidean');
		$data = $this->db->query('select fo.hari,fo.jam_buka,fo.jam_tutup,f.nama_faskes,f.latitude,f.longitude,
		sqrt(power(abs(f.latitude)-abs('.$latUser.'),2)+power(abs(f.longitude)-abs('.$longUser.'),2))*111.319 as jarak 
		from tb_faskes f
		join tb_faskes_open fo on fo.id_faskes = f.id_faskes

		where fo.hari = WEEKDAY(now()) AND TIME(NOW()) BETWEEN fo.jam_buka AND fo.jam_tutup
		AND TIME(NOW()) NOT BETWEEN fo.jam_mulai_istirahat and fo.jam_selesai_istirahat ' . $queryBaru)->result();
		// having jarak < '.$distance.'')->result();
		$this->benchmark->mark('end_euclidean');
		$json['waktu'] = $this->benchmark->elapsed_time('euclidean', 'end_euclidean');
		$json['data'] = $data;
		$json['distance'] = $distance;
		echo json_encode($json);
	}

	public function sphere_cos()
	{
		$json = array();
		$pass = explode(",",$this->uri->segment(3));
		$latUser = $pass[0];
		$longUser= $pass[1];
		// $distance = ($this->uri->segment(4) == NULL) ? 1 : $this->uri->segment(4);

		$jarak = $this->uri->segment(4);
		$tipe = $this->uri->segment(5);

		if($jarak == NULL)
		{	$distance = 1;
			$queryBaru = ' having jarak < 1';
		}
		else if($jarak != NULL && $tipe == NULL)
		{
			$distance = $jarak;
			$queryBaru = ' having jarak < '. $jarak;
		}
		else 
		{
			$distance = $jarak;
			// $tipe = $tipe;
			$queryBaru = ' WHERE id_tipe = ' .$tipe. ' having jarak < '. $jarak;
		}


		$this->benchmark->mark('sphere_cos_start');
		$data = $this->db->query('select nama_faskes,latitude,longitude,id_tipe,
		111.045* DEGREES(ACOS(COS(RADIANS('.$latUser.'))
		                 * COS(RADIANS(latitude))
		                 * COS(RADIANS('.$longUser.') - RADIANS(longitude))
		                 + SIN(RADIANS('.$latUser.'))
		                 * SIN(RADIANS(latitude)))) AS jarak
		                 from tb_faskes ' . $queryBaru)->result();
		// having jarak < '.$distance.';')->result();
		$this->benchmark->mark('sphere_cos_end');
		$json['waktu'] = $this->benchmark->elapsed_time('sphere_cos_start', 'sphere_cos_end');
		$json['data'] = $data;
		$json['distance'] = $distance;
		echo json_encode($json);
	}

	public function sphere_cos_open_close()
	{
		$json = array();
		$pass = explode(",",$this->uri->segment(3));
		$latUser = $pass[0];
		$longUser= $pass[1];
		// $distance = ($this->uri->segment(4) == NULL) ? 1 : $this->uri->segment(4);

		//filtering
		$jarak = $this->uri->segment(4);
		$tipe = $this->uri->segment(5);

		if($jarak == NULL)
		{	$distance = 1;
			$queryBaru = ' having jarak < 1';
		}
		else if($jarak != NULL && $tipe == NULL)
		{
			$distance = $jarak;
			$queryBaru = ' having jarak < '. $jarak;
		}
		else 
		{
			$distance = $jarak;
			// $tipe = $tipe;
			$queryBaru = ' AND f.id_tipe = ' .$tipe. ' having jarak < '. $jarak;
		}

		
		$this->benchmark->mark('sphere_cos_start');
		$data =  $this->db->query('select f.nama_faskes,f.latitude,f.longitude,
		111.045* DEGREES(ACOS(COS(RADIANS('.$latUser.'))
		                 * COS(RADIANS(latitude))
		                 * COS(RADIANS('.$longUser.') - RADIANS(longitude))
		                 + SIN(RADIANS('.$latUser.'))
		                 * SIN(RADIANS(latitude)))) AS jarak
		                 from tb_faskes f
		                 JOIN tb_faskes_open fo on fo.id_faskes = f.id_faskes
							  where fo.hari = WEEKDAY(now()) AND TIME(NOW()) BETWEEN fo.jam_buka AND fo.jam_tutup
		 AND TIME(NOW()) NOT BETWEEN fo.jam_mulai_istirahat and fo.jam_selesai_istirahat ' . $queryBaru)->result();
							  // having jarak < '.$distance.';')->result();
		$this->benchmark->mark('sphere_cos_end');
		$json['waktu'] = $this->benchmark->elapsed_time('sphere_cos_start', 'sphere_cos_end');
		$json['data'] = $data;
		$json['distance'] = $distance;
		echo json_encode($json);
		
	}

	public function all()
	{
		// haversine
		$json=array();
		$jsonAll=array();
		$all = array();
		$pass = explode(",",$this->uri->segment(3));
		$latUser = $pass[0];
		$longUser= $pass[1];
		//$distance = ($this->uri->segment(4) == NULL) ? 1 : $this->uri->segment(4);

		$jarak = $this->uri->segment(4);
		$tipe = $this->uri->segment(5);
		if($jarak == NULL)
		{	$distance = 1;
			$queryBaru = ' having jarak < 1';
		}
		else if($jarak != NULL && $tipe == NULL)
		{
			$distance = $jarak;
			$queryBaru = ' having jarak < '. $jarak;
		}
		else 
		{
			$distance = $jarak;
			// $tipe = $tipe;
			$queryBaru = ' WHERE id_tipe = ' .$tipe. ' having jarak < '. $jarak;
		}


		$this->benchmark->mark('haversine_start');
		$data = $this->db->query('select id_Faskes,nama_faskes,latitude,longitude,id_tipe,
			6371*(2*ASIN(SQRT(POWER(SIN((abs(latitude) - abs('.$latUser.')) * pi()/180 / 2), 2) +
		    COS(abs('.$latUser.') * pi()/180 ) * COS(abs(latitude) * pi()/180)
		* POWER(SIN((longitude - '.$longUser.') *pi()/180 / 2), 2) ))) as jarak 
		from tb_faskes ' . $queryBaru)->result();
		// having jarak < '.$distance.' ORDER BY jarak ASC;')->result();
		$this->benchmark->mark('heversine_end');
		$jsonAll['waktu'] = $this->benchmark->elapsed_time('haversine_start', 'haversine_end');
		$json['data'] = $data;
		$jsonAll['distance'] = $distance;
		$jsonAll['method'] = "haversine";
		$jsonAll['data'] = $json;
		array_push($all,$jsonAll);
		// end haversine

		// euclidean
		$this->benchmark->mark('euclidean');
		$data = $this->db->query('select nama_faskes,latitude,longitude,sqrt(power(abs(latitude)-abs('.$latUser.'),2)
			+power(abs(longitude)-abs('.$longUser.'),2))*111.319 as jarak
		from tb_faskes ' . $queryBaru)->result();
		// having jarak < '.$distance.';')->result();
		$this->benchmark->mark('end_euclidean');
		$jsonAll['waktu'] = $this->benchmark->elapsed_time('euclidean', 'end_euclidean');
		$json['data'] = $data;
		$jsonAll['distance'] = $distance;
		$jsonAll['method'] = "euclidean";
		$jsonAll['data'] = $json;
		array_push($all,$jsonAll);
		// end euclidean

		//sphere cos
		$this->benchmark->mark('sphere_cos_start');
		$data = $this->db->query('select nama_faskes,latitude,longitude,id_tipe,
		111.045* DEGREES(ACOS(COS(RADIANS('.$latUser.'))
		                 * COS(RADIANS(latitude))
		                 * COS(RADIANS('.$longUser.') - RADIANS(longitude))
		                 + SIN(RADIANS('.$latUser.'))
		                 * SIN(RADIANS(latitude)))) AS jarak
		                 from tb_faskes ' . $queryBaru)->result();
		// having jarak < '.$distance.';')->result();
		$this->benchmark->mark('sphere_cos_end');
		$jsonAll['waktu'] = $this->benchmark->elapsed_time('sphere_cos_start', 'sphere_cos_end');
		$json['data'] = $data;
		$jsonAll['distance'] = $distance;
		$jsonAll['method'] = "sphere_cos";
		$jsonAll['data'] = $json;
		array_push($all,$jsonAll);
		//end sphere cos

		echo json_encode($all);

	}



}
