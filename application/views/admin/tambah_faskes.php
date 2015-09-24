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
					<?php echo form_open('', array('class' => "form-horizontal")); ?>
					<div class="row">
						<div class="container">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Nama fasilitas Kesehatan <?php echo form_error('nama_faskes') ?></label>
									<div class="col-sm-10">
										<input type="text" placeholder="Nama Fasilitas Kesehatan" name="nama_faskes" id="nama_faskes"
										 class="form-control" value="<?php echo $nama_faskes; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">Nomor Telpon  Fasilitas Kesehatan </label>
									<div class="col-sm-10">
										<input type="email" placeholder="Email" id="inputEmail3" class="form-control" placeholder="(0298) - 123456">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">Alamat fasilitas Kesehatan</label>
									<div class="col-sm-10">
										<textarea class="form-control"></textarea>
									</div>
								</div>
								<div class="row"></div>
								<div class="form-group">
									<label class="control-label">Tipe Fasilitas Kesehatan</label>
									<div class="col-sm-10">
									<select id="id_tipe" name="id_tipe" class="form-control"></select>
									</div>
								</div>
								<div class="form-group">
                      <label for="exampleInputFile">Foto</label>
                      <input type="file" id="exampleInputFile">
                      <p class="help-block">Max file x MB. extensi *.jpg/*.png</p>
                    </div>
							</div>




							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Lokasi</label>
									<div class="row">
										<div class="col-sm-6">
											<input type="text" name="location" id="location" class="form-control" placeholder="Latitude, Longitude">

										</div>
										<div class="col-sm-4">
												<button class="btn btn-info"><i class="fa fa-compass"></i> Temukan Saya</button>
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
								<button type="submit" class="btn btn-info">Tambahkan Fasilitas Kesehatan</button>
								<?php echo anchor('admin/faskes','	<button class="btn btn-danger">Batal</button>');?>
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


			var latLng = new google.maps.LatLng( -7.2669,110.4039  );
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
