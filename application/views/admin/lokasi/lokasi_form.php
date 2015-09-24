<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <style>

      html, body, #map {
        height: 75%;
        width:80%;
        margin: 0;
        padding: 0;
      }


        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Tb_lokasis <?php echo $button ?></h2>

  <div id="map"> Map Will here</div>
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script>
var map;
function initialize() {


	var latLng = new google.maps.LatLng(<?php echo (empty($lokasi))  ?   '-7.2669, 110.4039 ' : $lokasi ; ?>);
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 10,
		center: latLng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});

	var marker = new google.maps.Marker({
		position: latLng,
		title: 'Lokasi',
		map: map,
		draggable: true
	});


	google.maps.event.addListener(marker, 'dragend', function(evt){
	//	document.getElementById('current').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(4) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
		setInput(evt);
  //  alert(evt);
	});

	google.maps.event.addListener(marker, 'dragstart', function(evt){
		//document.getElementById('current').innerHTML = '<p>Currently dragging marker...</p>';
	});
}

google.maps.event.addDomListener(window, 'load', initialize);
function setInput(e)
{
  lat = e.latLng.lat().toFixed(4);
	lng = e.latLng.lng().toFixed(4);
  document.getElementById('lokasi').value = lat + "," + lng;
}



</script>
<form action="<?php echo $action; ?>" method="post">
<div class="form-group">
       <label for="varchar">nama <?php echo form_error('nama') ?></label>
       <input type="text" class="form-control" name="nama" id="nama" placeholder="nama" value="<?php echo $nama; ?>" />
   </div>
<div class="form-group">
       <label for="point">lokasi <?php echo form_error('lokasi') ?></label>
       <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="lokasi" value="<?php echo $lokasi; ?>" />
</div>

<input type="hidden" name="id" value="<?php echo $id; ?>" />
<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
<a href="<?php echo site_url('lokasi') ?>" class="btn btn-default">Cancel</button>
</form>

    </body>
</html>
