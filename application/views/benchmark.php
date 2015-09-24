<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<!-- autocomplete style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css'); ?>/jquery-ui.min.css" type="text/css" media="all" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
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
						<li class="dropdowm">
							<a href="#" class="dropdown-toggle"  data-toggle="dropdown" role="button"
							aria-haspopup="true" aria-expanded="false">Euclidean <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><?php echo anchor('benchmark/euclidean','Euclidean'); ?></li>
								<li class="divider" role="separator"></li>
								<li><?php echo anchor('benchmark/euclidean_open_close','Euclidean Jam Buka'); ?></li>	
							</ul>
						</li>
						<li class="dropdowm">
							<a href="#" class="dropdown-toggle"  data-toggle="dropdown" role="button"
							aria-haspopup="true" aria-expanded="false">Haversine <span class="caret"></span></a>
							<ul class="dropdown-menu">
							<li><?php echo anchor('benchmark/haversine','Haversine'); ?></li>
							<li class="divider" role="separator"></li>
							<li><?php echo anchor('benchmark/haversine_open_close','Haversine Jam Buka'); ?></li>
							</ul>
						</li>
						<li class="dropdowm">
							<a href="#" class="dropdown-toggle"  data-toggle="dropdown" role="button"
							aria-haspopup="true" aria-expanded="false">Spherical Law of cosine <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><?php echo anchor('benchmark/sphere_cos','Sphere Cos'); ?></li>
								<li class="divider" role="separator"></li>
								<li><?php echo anchor('benchmark/sphere_cos_open_close','Sphere Cos Jam BUka'); ?></li>
							</ul>
						</li>
					</ul>
					<!-- end navbar -->
					<!-- <form class="navbar-form navbar-left" role="search">
					  <div class="form-group">
					    <input type="text" class="form-control" placeholder="Search">
					  </div>
					  <button type="submit" class="btn btn-default">Temukan </button>
					  <button type="submit" class="btn btn-default">Temukan Geolocation </button>
					</form> -->
				</div>
				<!-- end fullscreen -->
		</div>		
	</nav>
 	
	<div class="row"><br><br></div>

	<div id="container" class="container">
	<h1><?php echo $title; ?></h1>
	<div id="body">
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default" >
				  <div class="panel-heading">Lokasi</div>
				  <div class="panel-body">
				    	Lokasi anda : <?php echo form_input('lokasi','','id=lokasi'); ?>
						<button id="temukan_geo" class="btn btn-default">Temukan By Geolocation</button>
						<button id="temukan" class="btn btn-default">Temukan </button>
				  </div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
				  <div class="panel-heading">Hasil</div>
				  <div class="panel-body">
				    	Lokasi anda : <span id="terpilih"></span><br>
						Akurasi HTML 5 Geolocation : <span id="geo_accuracy"></span><br>
						lokasi anda : <input type="text" id="latlng" value="-7.324965417312912,110.50479793548584"><br>
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
					<div class="panel-heading">Lokasi Terdekat</div>
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
												<!-- <button type="button" onclick="filterFaskes(1)" class="btn btn-default">Rumah Sakit</button>
												<button type="button" onclick="filterFaskes(2)" class="btn btn-default">Klinik</button>
												<button type="button" onclick="filterFaskes(3)" class="btn btn-default">Puskesmas</button>
												<button type="button" onclick="filterFaskes(3)" class="btn btn-default">Dokter</button>
												<button type="button" onclick="filterFaskes(3)" class="btn btn-default">Dokter gigi</button>
												<button type="button" onclick="filterFaskes(3)" class="btn btn-default">Bidan</button> -->
									
											</div>
										</div>
									</div>
									<script type="text/javascript">
									function filterFaskes(id_tipe)
									{
										var jarak = $('#dist').html();
										var latlng = $('#latlng').val().split(",");
										var path = "<?php echo $this->uri->segment(2); ?>";
										//console.log(latlng);
	          							var alamat = "<?php echo base_url('benchmark_rest'); ?>/haversine_open_close/"+latlng +"/"+jarak+"/"+id_tipe;
										//getNearby(alamat);
										var map;
										getNearby(map, path, latlng[0],latlng[1],jarak, id_tipe);
									}
									</script>
									
									
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
						Jumlah Lokasi ditemukan : <span id="total_faskes">0</span> dalam radius <span id="dist">0</span> KM <br />
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
				<script type="text/javascript">
				function cek(latOrigin,longOrigin)
				{
					var akhir = document.getElementById("latlng").value;
					var awal = latOrigin + "," + longOrigin;
					console.log(awal + "=>" + akhir);
					//alert(awal);
					routing(awal,akhir);
				}
				</script>
	

		</div>
		<!-- end body -->
	 <hr>
	 <?php echo $waktu; ?>

	 <footer>
	 	
	 </footer>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds.  | <strong>{memory_usage}</strong>
		<?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>
<!-- javascript -->

<script src="<?php echo base_url('assets/js'); ?>/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js'); ?>/mustache.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
<!-- gmap -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<!-- <script type="text/javascript" src="<?php echo base_url('assets/scripts/gmap.js'); ?> "></script> -->
<script type="text/javascript">
var map;
//init map
google.maps.event.addDomListener(window,'load',function(){
	var homeLatlng = new google.maps.LatLng(-7.324965417312912, 110.50479793548584); 
	
	var myOptions = {
		zoom: 15,
		center: homeLatlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

	 infowindow = new google.maps.InfoWindow({
        content: "loading..."
    });


	//ambil_marker();
});



//google map eventListener ketika tombol temukan di klik
google.maps.event.addDomListener(document.getElementById('temukan'), 'click', function(){
	var val = document.getElementById('latlng').value.split(",");

	var lat = val[0];
	var lng = val[1];

	
	var homeLatlng = new google.maps.LatLng(lat, lng); 
									
	var myOptions = {
		zoom: 15,
		center: homeLatlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

	var infoWindow = new google.maps.InfoWindow({map: map});
	var marker = new google.maps.Marker({
						        position: homeLatlng,
						        map: map,
						        icon : 'http://maps.google.com/mapfiles/kml/shapes/man.png',
						        title: 'loc'
						    });

				infoWindow.setPosition(homeLatlng);
				infoWindow.setContent('Anda Disini');							
				infowindow = new google.maps.InfoWindow({
		        	content: "loading..."
		    	});

	document.getElementById("latlng").value = lat + ","  + lng ;
	document.getElementById("geo_accuracy").innerHTML = "";
	var path = "<?php echo $this->uri->segment(2); ?>";
	ambil_marker(path,lat,lng);
});


google.maps.event.addDomListener(document.getElementById('temukan_geo'),'click',function(){
		var map = new google.maps.Map(document.getElementById('map_canvas'), {
		    center: {lat: -34.397, lng: 150.644},
		    zoom: 15,
		});


		var infoWindow = new google.maps.InfoWindow({map: map});
		var latitude;
		var longitude;

			// Try HTML5 geolocation.
			if (navigator.geolocation) {
			   navigator.geolocation.getCurrentPosition(function(position) {
			   	latitude = position.coords.latitude;
			   	longitude = position.coords.longitude;

			   	var pos = {
						lat: latitude,
			        	lng: longitude
				 };

				var marker = new google.maps.Marker({
						        position: new google.maps.LatLng(latitude,longitude),
						        map: map,
						        icon : 'http://maps.google.com/mapfiles/kml/shapes/man.png',
						        title: 'loc'
						    });

				infoWindow.setPosition(pos);
				infoWindow.setContent('Location found.');
				map.setCenter(pos);
				geocodeLocation(latitude,longitude);
				document.getElementById('geo_accuracy').innerHTML = position.coords.accuracy + " meters";
				document.getElementById("latlng").value = latitude + ","  + longitude ;
				
				var path = "<?php echo $this->uri->segment(2); ?>";
				
				getNearby(map, path,latitude,longitude);
				}, function() {
						handleLocationError(true, infoWindow, map.getCenter());
				});
			} else {
				// Browser doesn't support Geolocation
				 handleLocationError(false, infoWindow, map.getCenter());
			}
});

//fungsi geocoding alamat dari latlong
function geocodeLocation(lat,lng) {
	  var geocoder = new google.maps.Geocoder();
	  var latlng = new google.maps.LatLng(lat, lng);
	  geocoder.geocode({'latLng': latlng}, function(results, status) {

		if (status == google.maps.GeocoderStatus.OK) {
			
		
		  //if (results[1]) {
		    document.getElementById('terpilih').innerHTML = results[0].formatted_address;
		    document.getElementById('lokasi').value = results[0].formatted_address;
		  //} else {
		   // alert('No results found');
		  //}
		} else {
		  alert('Geocoder failed due to: ' + status);
		}
	});
}

 //ajax request get nearby faskes
function getNearby(map, path, lat,lng,distance, tipe)
{
				var distance = typeof distance !== 'undefined' ? distance : 1;
				var tipe = typeof tipe !== 'undefined' ? tipe : '';
          		var alamat = "<?php echo base_url('benchmark_rest'); ?>/" + path + "/" + lat + "," + lng+ "/" + distance + "/" + tipe;
         		$.ajax({
		              type:'GET',
		              url:alamat,
		              success:function(users)
		              {
		              		
		              		var locations =  JSON.parse(users);
		              		$('#query_time').html(locations['waktu']);
		              		$("#total_faskes").html(locations['data'].length);
		              		$("#dist").html(locations['distance']);
		              		
				            $nearby.html("");

				            //write to  nearby faskes
		                    $.each(locations['data'], function(i, location){
		                        addLocation(location);	
		                        //console.log('show marker');
		                        //console.log(location.latitude,location.longitude,location.nama_faskes);	                    
		                    	//show the marker
		        //            	// for offline please comment this for online please uncomment
		      //               	var marker = new google.maps.Marker({
        //                            position: new google.maps.LatLng(parseFloat(location.latitude),
        //                            		parseFloat(location.longitude)),
        //                            map: map,
        //                            title: location.nama_faskes
        //                        });//end marker

								// google.maps.event.addListener(marker, "click", function () {
					   //             // alert(this.title);
					   //              infowindow.setContent(this.title);
					   //              infowindow.open(map, this);
					   //          });//end evt listener
		                     });//end each

		              },
		              error:function(){
		                  alert('oops something wrong');
		              },

		         });

}




// //function mengambil marker ajax
function ambil_marker(path, lat,lng,distance){
	var alamat = "<?php echo base_url('benchmark_rest'); ?>/" + path + "/" + lat + "," + lng ;
   $(function(){
       $.ajax({
           type : 'GET',
           url : alamat,
           success: function(locations)
           {
             	var json =  JSON.parse(locations);
             	var obj = json['data'];
             	totalLocations = obj.length;
             	for (var i = 0; i < totalLocations; i++) 
             	{
               			//console.log(obj[i].latitude,obj[i].longitude);
                               var marker = new google.maps.Marker({
                                   position: new google.maps.LatLng(parseFloat(obj[i].latitude),parseFloat(obj[i].longitude)),
                                   map: map,
                                   title: obj[i].nama_faskes
                               });

								google.maps.event.addListener(marker, "click", function () {
					               // alert(this.title);
					                infowindow.setContent(this.title);
					                infowindow.open(map, this);
					            });
             	}
           },
           error : function()
           {
             	alert('whoops'+ $('#lokasi').val());
           }
       })
   });
}

function routing(awal,tujuan)
{
 var directionsService = new google.maps.DirectionsService();
     var directionsDisplay = new google.maps.DirectionsRenderer();
     //console.log(awal + "=>" + tujuan);
     document.getElementById('panel').innerHTML = "";

     var map = new google.maps.Map(document.getElementById('map_canvas'), {
       zoom:7,
       mapTypeId: google.maps.MapTypeId.ROADMAP
     });

     directionsDisplay.setMap(map);
     directionsDisplay.setPanel(document.getElementById('panel'));

     var request = {

       origin: awal,
       destination: tujuan,
       travelMode: google.maps.DirectionsTravelMode.DRIVING
     };

     directionsService.route(request, function(response, status) {
       if (status == google.maps.DirectionsStatus.OK) {
         directionsDisplay.setDirections(response);

         var point = response.routes[ 0 ].legs[ 0 ];

         //marker start position
         var startPos = new google.maps.Marker({
			  position: point.start_location,
			  map: map,
			  icon: 'http://maps.google.com/mapfiles/kml/shapes/man.png',
			  //title: title
			 });

         //marker end position
        var endPos = new google.maps.Marker({
			  position: point.end_location,
			  map: map,
			  icon: 'http://maps.google.com/mapfiles/kml/pal2/icon13.png',
			  //title: title
		});
        document.getElementById('travel_time').value = point.duration.text;

        var d = new Date();
         	//document.write(d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds() + ":" + d.getMilliseconds());
			//document.write(d.getTime());


        document.getElementById('arrive_time').innerHTML= d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
        //http://stackoverflow.com/questions/1042885/using-google-maps-api-to-get-travel-time-data
       }
     });
}
		

		</script>




			    <!-- end gmap -->
		  <script type="text/javascript">
		  //autocomplete script
	    	$(this).ready( function() {
    			$("#lokasi").autocomplete({
	      			minLength: 1,
	      			source:
	        		function(req, add){
	          			$.ajax({
			        		url: "<?php echo base_url(); ?>lokasi/json",
			          		dataType: 'json',
			          		type: 'POST',
			          		data: req,
			          		success:

			            	function(data){
			            		
			              		if(data.response ==true){
			                 		add(data.message);
			                 		
			              		}
			            	},
	              		});
	         		},
         		 select:
	         	 	function(event, ui) {
	         	 		$("#terpilih").html(ui.item.value + "(" + ui.item.id + ")");

	         	 		$("#latlng").val( ui.item.id );
	         	 		var latlng = ui.item.id;
	         	 		var latlngs = latlng.split(",");

	         	 	},
    			});
	    	});
	
	    </script>

	    <!-- mustache script -->
	    <script type="text/javascript">
	    	var nearbyTemplate = $('#nearby-template').html();
	    	
	    	var $nearby = $('#nearby');
	    	function addLocation(nearby)
          	{

            	$nearby.append(Mustache.render(nearbyTemplate, nearby));
          	}

          	

         	$('#temukan').on('click',function(){
         		//alert('hei');
         		var val = document.getElementById('latlng').value.split(",");

				var lat = val[0];
				var lng = val[1];
				var path = "<?php echo $this->uri->segment(2); ?>";
         		var alamat = "<?php echo base_url('benchmark_rest'); ?>/" + path + "/" + lat + "," + lng;
         		$.ajax({
		              type:'GET',
		              url:alamat,
		              success:function(users)
		              {
		              		
		              		var locations =  JSON.parse(users);
		              		$('#query_time').html(locations['waktu']);
		              		$("#total_faskes").html(locations['data'].length);
		              		$("#dist").html(locations['distance']);
				            $nearby.html("");
		                    $.each(locations['data'], function(i, location){
		                        	addLocation(location);
		                     });
		              },
		              error:function(){
		                  alert('oops something wrong');
		              },

		         });


         	});

         	var lalong = document.getElementById('latlng').value.split(",");
			var latitude = lalong[0];
			var longitude = lalong[1];
			var controler = '<?php echo $this->uri->segment(2); ?>';
         	$('#btn1').click(function(){
         		getNearby(map,controler,latitude,longitude,1);
         	});
         	$('#btn2').click(function(){
         		//console.log($(this).attr('distance'));
         		getNearby(map,controler,latitude,longitude,2);
         	});
         	$('#btn3').click(function(){
         		getNearby(map,controler,latitude,longitude,3);
         	});
         	
	    </script>
	    <!-- end mustache script -->
</body>
</html>
