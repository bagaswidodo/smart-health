<!DOCTYPE html>
<html>
<head>
	<title>Node Jalan</title>
</head>
<body>
<div id="map_canvas" style="height:500px;width:90%;">
							Map Here
						</div>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.11.2.min.js'); ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>

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

	 var marker = new google.maps.Marker({
                                   position: homeLatlng,
                                   map: map,
                                   title: "here"
                               });

	 var alamat = "<?php echo base_url('benchmark/nodes_json'); ?>/" ;
   $(function(){
	 $(function(){
       $.ajax({
           type : 'GET',
           url : alamat,
           success: function(locations)
           {
             	var obj =  JSON.parse(locations);
             	totalLocations = obj.length;
             	for (var i = 0; i < totalLocations; i++) 
             	{
               			//console.log(obj[i].grup,obj[i].latitude,obj[i].longitude);
                               var marker = new google.maps.Marker({
                                   position: new google.maps.LatLng(parseFloat(obj[i].longitude),parseFloat(obj[i].latitude)),
                                   map: map,
                                   title: obj[i].grup,
                                   icon : "https://storage.googleapis.com/support-kms-prod/SNP_2752125_en_v0"
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
});

	ambil_marker(map);
});
function ambil_marker(map){
	var alamat = "<?php echo base_url('benchmark/nodes_json'); ?>/" ;
   $(function(){
       $.ajax({
           type : 'GET',
           url : alamat,
           success: function(locations)
           {
             	var obj =  JSON.parse(locations);
             	totalLocations = obj.length;
             	for (var i = 0; i < totalLocations; i++) 
             	{
               			console.log(obj[i].grup,obj[i].latitude,obj[i].longitude);
                               var marker = new google.maps.Marker({
                                   position: new google.maps.LatLng(parseFloat(obj[i].latitude),parseFloat(obj[i].longitude)),
                                   map: map,
                                   title: obj[i].grup
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
</script>
</body>
</html>