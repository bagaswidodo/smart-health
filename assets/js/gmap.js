//init map
var map;
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

//temukan geo clicked
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
					
					//var path = "<?php echo $this->uri->segment(2); ?>";
					
					getNearbyAll(map,restUrl,lat,lng);
				}, function() {
						handleLocationError(true, infoWindow, map.getCenter());
				});
			} else {
				// Browser doesn't support Geolocation
				 handleLocationError(false, infoWindow, map.getCenter());
			}
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
	//var path = "<?php echo $this->uri->segment(2); ?>";
	//ambil_marker(map,restUrl);
	getNearbyAll(map,restUrl,lat,lng);
});
