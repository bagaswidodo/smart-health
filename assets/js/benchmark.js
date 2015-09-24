//autocomplete script
$(this).ready( function() {
	$("#lokasi").autocomplete({
			minLength: 1,
			source:
		function(req, add){
  			$.ajax({
        		url: alamat + "lokasi/json",
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

// mustache


var resultTemplate = $('#result-template').html();    	
var $result = $('#result');
function fillDetail(nearby)
{
	$result.append(Mustache.render(resultTemplate, nearby));
}


//ajax request get nearby faskes
function getNearbyAll(map, path,lat, lng, distance, tipe)
{
				var distance = typeof distance !== 'undefined' ? distance : 1;
				var tipe = typeof tipe !== 'undefined' ? tipe : '';
          		var restUrl = path + "/" +lat + "," + lng + distance + "/" + tipe;
          		console.log("URL REST: "  + restUrl);
          		$result.html("");
         		$.ajax({
		              type:'GET',
		              url: restUrl,
		              success:function(users)
		              {
		              		
		              		var locations =  JSON.parse(users);
		                    $.each(locations, function(i, location){
		                    	console.log(location.data.data.length);
		                    	fillDetail(location);
		                     });//end each

		              },
		              error:function(){
		                  alert('oops something wrong');
		              },

		         });

}

var nearbyTemplate = $('#nearby-template').html();
var $nearby = $('#nearby');
function addLocation(nearby)
{
	$nearby.append(Mustache.render(nearbyTemplate, nearby));
}

function getNearby(map, path,lat,lng,distance, tipe)
{
				var distance = typeof distance !== 'undefined' ? distance : 1;
				var tipe = typeof tipe !== 'undefined' ? tipe : '';
          		var restUrl = path+ "/" +lat + "," + lng + "/"+ distance + "/" + tipe;
          		console.log("URL REST: "  + restUrl);
         		$.ajax({
		              type:'GET',
		              url: restUrl,
		              success:function(users)
		              {
		              		
		              		var locations =  JSON.parse(users);
		              		$('#query_time').html(locations['waktu']);
		              		$("#total_faskes").html(locations['data'].length);
		              		$("#dist").html(locations['distance']);

				            //write to  nearby faskes
				            $nearby.html("");
		                    $.each(locations['data'], function(i, location){
		                    	//console.log(location);
		                    	addLocation(location);

		                        // addLocation(location);	
		                        //console.log('show marker');
		                        //console.log(location.latitude,location.longitude,location.nama_faskes);	                    
		                    	//show the marker
		        //            	// for offline please comment this for online please uncomment
		                    	var marker = new google.maps.Marker({
                                   position: new google.maps.LatLng(parseFloat(location.latitude),
                                   		parseFloat(location.longitude)),
                                   map: map,
                                   title: location.nama_faskes
                               });//end marker

								google.maps.event.addListener(marker, "click", function () {
					               // alert(this.title);
					                infowindow.setContent(this.title);
					                infowindow.open(map, this);
					            });//end evt listener
		                     });//end each

		              },
		              error:function(){
		                  alert('oops something wrong');
		              },

		         });

}


//mendapatkan rute
function cek(latOrigin,longOrigin)
{
	var akhir = document.getElementById("latlng").value;
	var awal = latOrigin + "," + longOrigin;
	console.log(awal + "=>" + akhir);
	//alert(awal);
	routing(awal,akhir);
}

//melakukan filter radius
function filterRadius()
{

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

