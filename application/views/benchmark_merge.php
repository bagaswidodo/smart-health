<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<!-- autocomplete style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css'); ?>/jquery-ui.min.css" type="text/css" media="all" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootswatch.min.css'); ?>">
	    <!-- end autocomplete style -->
    <script src="<?php echo base_url('assets/js'); ?>/jquery-1.11.2.min.js" type="text/javascript"></script>
</head>
<body>
 	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<!-- when responsive -->
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" 
					data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
					aria-expanded="false">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand">Benchmark</a>
				</div>
			

				<!-- fullscreen -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="#" class="active">Benchmark</a></li>
						<li><a href="#" class="active">Open Close Benchmark</a></li>
						
						
					</ul>
				</div>
				<!-- end fullscreen -->
		</div>		
	</nav>
 	
	<div class="row"><br><br></div>

	<div id="container" class="container">
	<h1><?php echo $title; ?></h1>
	<div id="body">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default" >
				  <div class="panel-heading">Lokasi</div>
				  <div class="panel-body">
				    	Lokasi anda : <?php echo form_input('lokasi','','id=lokasi'); ?>
						<button id="temukan_geo" class="btn btn-default">Temukan By Geolocation</button>
						<button id="temukan" class="btn btn-default">Temukan </button>
				  </div>
				</div>
			</div>
		</div>
		<div class="row">
			<!-- geolocation result -->
			<div class="col-md-6">
				<div class="panel panel-default">
				  <div class="panel-heading">Akurasi Geolocation</div>
				  <div class="panel-body">
				  <h3>Akurasi Geolocation</h3>
				    	Lokasi anda : <span id="terpilih"></span><br>
						Akurasi HTML 5 Geolocation : <span id="geo_accuracy"></span><br>
						lokasi anda : <input type="text" id="latlng" value="-7.324965417312912,110.50479793548584"><br>
				  </div>
				</div>
			</div>
			<!-- end geolocation result -->
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Hasil Pencarian</div>
					<div class="panel-body">
						<h3>Hasil pencarian</h3>
						<div id="result">
						<template id="result-template">
					  	<a href="#" class="list-group-item">
				        	<h4 class="list-group-item-heading">{{method}}</h4>
		   					<p class="list-group-item-text">{{lokasi}} <strong><small>{{distance}}</small></strong></p>
		   					<p class="list-group-item-text">{{waktu}}</p>
		   					<button class="btn btn-info" onclick="detailData('{{method}}')">{{data.data.length}}</button>
	   					</a>
	   					</template>
	   					</div>
					</div>

				</div>
			</div>
			
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading"> Peta</div>
					<div class="panel-body">
						<div id="map_canvas" style="height:280px;width:90%;">
							Map Here
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Detail Lokasi <span id="rumus"></span></div>
					<div class="panel-body">
						<!-- listgroup -->
							<div class="list-group">
									<!-- btngroup -->
									<div class="row">
										<div class="col-md-4">Jarak :</div>
										<div class="col-md-6">
											<div class="btn-group" role="group">
												<button type="button" id="btn1" distance="1" class="btn btn-default">1 km</button>
												<button type="button" id="btn2" distance="2" class="btn btn-default">2 km</button>
												<button type="button" id="btn3" distance="3" class="btn btn-default">3 km</button>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-4">Layanan Kesehatan</div>
										<div class="col-md-6">
											<div class="btn-group" role="group">
												<?php //var_dump($tipe); 
												foreach ($tipe as $v) {
													echo '<button type="button" onclick="filterFaskes('.$v->id_tipe.')" class="btn btn-default">'.$v->deskripsi.'</button>';
												}
												?>									
											</div>
										</div>
									</div>
							
									
									<!-- btngroup -->
							  		<div class="nearby"  id="nearby" style="height:300px;overflow-y:scroll;">
							  				<template id="nearby-template">
									        <!-- <li data-id="{{id}}"> -->
									        	<a href="#" class="list-group-item">
									        	<h4 class="list-group-item-heading">{{nama_faskes}}</h4>
									        	<small>{{ jarak }}</small>
							   					<p class="list-group-item-text">content
							   					<br>Alamat
							   					<br>Telpon
							   					</p>
							   					<button class="btn btn-default" onclick="cek({{latitude}},{{longitude}})">Rute</button>
									            <!-- <strong>Nama</strong>:<span class="noedit nama"></span> -->
									            <!-- <input class="nama edit form-control"> -->
									            <!-- </a> -->
									       </template>
								</div>
							</div>
						<!-- end listgroup -->

						
					</div>
					<!-- end panel body -->
					<div class="panel-footer">
						Jumlah Lokasi ditemukan : <span id="total_faskes">0</span> Fasilitas Kesehatan. dalam radius <span id="dist">0</span> KM <br />
						Query Execution Time   : <span id="query_time">0.000</span><Br />
						Page rendered  : <strong>{elapsed_time}</strong> <Br />
						Memory Usage   : <strong>{memory_usage}</strong>

					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Rute</div>
					<div class="panel-body" style="height:300px;overflow-y:scroll;">
						Travel Time : <span id="travel_time"></span>
						Estimated Arrive :  <span id="arrive_time"></span>
						<div id="panel"></div>
						
					</div>
					
				 </div> <!--end panel -->
			</div>
			
		</div>
		</script>
	

		</div>
		<!-- end body -->
	 <hr>
	 <?php //echo $waktu; ?>

	 <footer>
	 	
	 </footer>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds.  | <strong>{memory_usage}</strong>
		<?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>
<!-- script section -->
<script src="<?php echo base_url('assets/js'); ?>/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js'); ?>/mustache.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>

<!-- gmap -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script src="<?php echo base_url('assets/js'); ?>/benchmark.js" type="text/javascript"></script>
<script type="text/javascript">
var alamat = "<?php echo base_url();?>";	
var latlng = $("#latlng").val();
var lat = latlng.split(",")[0] ;
var lng = latlng.split(",")[1];
var rest = "<?php echo base_url('benchmark_rest'); ?>";
//var restUrl = "<?php echo base_url('benchmark_rest'); ?>/all/" + lat + "," + lng;
var restUrl = "<?php echo base_url('benchmark_rest'); ?>/all";
var map;
// + distance + "/" + tipe;
/*
getNearbyAll(map,url,distance,type)
*/
getNearbyAll(map,restUrl);

function detailData(method)
{
	var restUrl = rest +"/"+method;
	$('#rumus').html(method);
	console.log(restUrl);
	var latlng = $("#latlng").val();
	var lat = latlng.split(",")[0] ;
	var lng = latlng.split(",")[1];
	getNearby(map, restUrl,lat,lng);
}

//melakukan filter faskes
function filterFaskes(id_tipe)
{
	var jarak = $('#dist').html();
	var lat = $('#latlng').val().split(",")[0];
	var lng = $('#latlng').val().split(",")[1];
	var rumus = $('#rumus').html();
	var controler = rest + "/" + rumus;
	//var path = "<?php echo $this->uri->segment(2); ?>";
	//console.log(latlng);
	//	var alamat = "<?php echo base_url('benchmark_rest'); ?>/haversine_open_close/"+latlng +"/"+jarak+"/"+id_tipe;
	//getNearby(alamat);
	var map;
	getNearby(map, controler, lat,lng,jarak, id_tipe);
}

$('#btn1').click(function(){
	var rumus = $('#rumus').html();
	var controler = rest + "/" + rumus;
	var lat = $('#latlng').val().split(",")[0];
	var lng = $('#latlng').val().split(",")[1];
	getNearby(map,controler,lat,lng,1);

});
$('#btn2').click(function(){
	var rumus = $('#rumus').html();
	var lat = $('#latlng').val().split(",")[0];
	var lng = $('#latlng').val().split(",")[1];
	var controler = rest + "/" + rumus;
	getNearby(map,controler,lat,lng,2);
});
$('#btn3').click(function(){
	var rumus = $('#rumus').html();
	var lat = $('#latlng').val().split(",")[0];
	var lng = $('#latlng').val().split(",")[1];
	var controler = rest + "/" + rumus;
	getNearby(map,controler,lat,lng,3);
});
</script>
<script src="<?php echo base_url('assets/js'); ?>/gmap.js" type="text/javascript"></script>

</body>
</html>
