<link href="<?php echo base_url(); ?>/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>/assets/plugins/select2/js/select2.min.js"></script>

        <!-- Full Width Column -->
        <div class="content-wrapper">
        	<div class="container">
        		<!-- Content Header (Page header) -->
        		<section class="content-header">
        			<h1> Smart Health <small>Administration</small></h1>
        			<ol class="breadcrumb">
        				<li>
        					<?php echo anchor('admin','<i class="fa fa-dashboard"></i> Awal');?>
        				</li>
        				<li>
        					<!-- <a href="#">Fasilitas Kesehatan</a> -->
        					<?php echo anchor('admin/faskes', 'Fasilitas Kesehatan'); ?>
        				</li>
        				<li class="active">
        					Tambahkan Fasilitas Keshatan
        				</li>
        			</ol>
        		</section>

            <!-- Main content -->
        		<section class="content">
        			<div class="box box-default">
        				<div class="box-header with-border">
        					<h3 class="box-title">Tambahkan Layanan Kesehatan Baru</h3>

        				</div>
        				<div class="box-body">
        					<?php echo form_open($action, array('class' => "form-horizontal", 'method' => 'post')); ?>
        					<div class="row">
        						<div class="container">
        							<div class="col-md-6">
        								<div class="form-group">
                          <label class="control-label">Nama fasilitas Kesehatan <?php echo form_error('nama_faskes') ?></label>
        									<div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_faskes" id="nama_faskes" placeholder="nama_faskes"
                             value="<?php echo $nama_faskes; ?>" placeholder="Nama Fasilitas Kesehatan" />
        									</div>
        								</div>
        								<div class="form-group">
        									  <label for="int">Nomor Telpon Fasilitas Kesehatan <?php echo form_error('no_telpon') ?></label>
        									<div class="col-sm-10">
                            <input type="text" class="form-control" name="no_telpon" id="no_telpon"
                            placeholder="Nomor Telpon. Contoh (0298) - 123 456" value="<?php echo $no_telpon; ?>" />
        									</div>
        								</div>
        								<div class="form-group">
                           <label for="varchar">Alamat Fasilitas Kesehatan <?php echo form_error('alamat') ?></label>
        									<div class="col-sm-10">
        										<textarea class="form-control" name="alamat" id="alamat"><?php echo $alamat; ?></textarea>
        									</div>
        								</div>
        								<div class="row"></div>
        								<div class="form-group">
        									<label class="control-label">Tipe Fasilitas Kesehatan <?php echo form_error('id_tipe') ?></label>
        									<div class="col-sm-10">
        										<select class="form-control" name="id_tipe" id="id_tipe">        										</select>
        									</div>
        								</div>
        								<div class="form-group">
                              <label for="varchar">Foto <?php echo form_error('foto') ?></label>
                            <div class="col-sm-10">  <input type="text" name="foto" id="foto" class="form-control" ></div>
                              <!-- <input type="file" name="foto" id="foto">
                              <p class="help-block">Max file x MB. extensi *.jpg/*.png</p>-->
                            </div>
        							</div>
        							<div class="col-md-6">
        								<div class="form-group">
        								<label for="point">Lokasi di Peta <abbr>{Tip}</abbr><?php echo form_error('location') ?></label>
        									<div class="row">
        										<div class="col-sm-6">
        											<input type="text" name="location" id="location" class="form-control"
                              placeholder="Latitude, Longitude" value="<?php echo $location; ?>">
        										</div>
        										<div class="col-sm-4">
        												<button type="button" class="btn btn-info" onclick="findMe()">
                                  <i class="fa fa-compass"></i> Temukan Saya</button>
        										</div>
        									</div>
        								</div>
        								<div class="form-group">
        										<div id="map" style="height:280px;width:90%;">here</div>
        								</div>

        								<div class="form-group">
        									<br /><input type="checkbox" >Melayani BPJS
        								</div>
        							</div>
        							<div class="row">
        								<div class="col-xs-12 pull-right">
                          <input type="hidden" name="id_faskes" value="<?php echo $id_faskes; ?>" />
        								<button type="submit" class="btn btn-info"><?php echo empty($id_faskes) ? 'Tambahkan' : 'Ubah' ; ?> Fasilitas Kesehatan</button>
        								<?php echo anchor('faskes','	<button class="btn btn-danger" type="button">Batal</button>');?>
        								</div>
        							</div>
        						</div>
        					</div>
        					<?php echo form_close(); ?>
        				</div><!-- /.box-body -->
        			</div><!-- /.box -->
        		</section><!-- /.content -->
        	</div><!-- /.container -->
        </div><!-- /.content-wrapper -->

        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
        	<script>
        		var map;
        		function initialize() {


        			var latLng = new google.maps.LatLng( <?php echo empty($location) ? '-7.2669,110.4039' : $location; ?>  );
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
        			document.getElementById('location').value = lat + "," + lng;
        		}
        </script>
        <script>
          $( "#id_tipe" ).select2({
            ajax: {
              //http://localhost/~salatiga-health/v1/faskes_tipe/tipe_json
              url: "<?php echo base_url(); ?>faskes_tipe/tipe_json",
              dataType: 'json',
              delay: 250,
              data: function (params) {
                return {
                  q: params.term
                };
              },
              processResults: function (data) {
                return {
                  results: data
                };
              },
              cache: true
            },
            minimumInputLength: 2,

          });
          </script>
          <script>
          function findMe()
          {
            if (navigator.geolocation) {
            	  navigator.geolocation.getCurrentPosition(success);
            	} else {
            	  error('Geo Location is not supported');
            	}
          }

          function success(position)
          {
                var coords = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

                var options = {
                  zoom: 15,
                  center: coords,
                  mapTypeControl: false,
                  navigationControlOptions: {
                  	style: google.maps.NavigationControlStyle.SMALL
                  },
                  mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                var map = new google.maps.Map(document.getElementById("map"), options);

                var marker = new google.maps.Marker({
                    position: coords,
                    map: map,
                    title:"You are here!",
                    draggable:true
                });
                document.getElementById('location').value = position.coords.latitude.toFixed(4) + "," + position.coords.longitude.toFixed(4);

                google.maps.event.addListener(marker, 'dragend', function(evt){
          			//	document.getElementById('current').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(4) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
          				setInput(evt);
          			//  alert(evt);
          			});

          			google.maps.event.addListener(marker, 'dragstart', function(evt){
          				//document.getElementById('current').innerHTML = '<p>Currently dragging marker...</p>';
          			});
          }
          </script>
