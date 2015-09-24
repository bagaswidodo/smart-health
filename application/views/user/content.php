Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1> Fasilitas Kesehatan <small>Terdekat</small></h1>
		<ol class="breadcrumb">
			<li>
				<a href="#"><i class="fa fa-dashboard"></i> Level</a>
			</li>
			<li class="active">
				Here
			</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- info -->
		<div class="callout callout-success">
			<div class="row">
				<div class="col-md-8">
					Ditemukan sebanyak 
						<strong><span id="jumlah_faskes"><?php echo $jumlah; ?></span></strong>
					Fasilitas Kesehatan pada radius 
						<strong><span id="radius"><?php echo $distance; ?></span></strong> KM  dari lokasi anda
					selama 
						<strong><span id="waktu"><?php echo $waktu; ?></span></strong> detik
				</div>
				<div class="col-md-4 ">
					<?php
					echo form_open('', array('class' => 'pull-right'));
					$options = array('1' => '1 KM', '2' => '2 KM', '3' => '3 KM');

					echo form_dropdown('jarak', $options, '',array('id'=>'jarak'));
					echo form_close();
					?>
				</div>
			</div>
		</div>
		<!-- end info -->

		<!-- Your Page Content Here -->
		<div class="row">

			<div class="col-md-10 info-box" id="faskes">
			<?php
				$bgColor = array(
					1=>"bg-green",
					2=>"bg-green",
					3=>"bg-yellow", 		
					4 =>"bg-aqua",
					5 =>"bg-aqua",
					6 =>"bg-aqua",
					7=>"bg-red");


			?>
				<template id="nearby">
			        <!-- info box -->
					<div class="info-box bg-green">
						<span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
						<div class="info-box-content">
							<span class="info-box-number">{{nama_faskes}}</span>
							<span class="label pull-right">{{jarak}} KM </span>
							<span class="info-box-text">almat</span>
							<div class="progress">
								<div class="progress-bar" style="width: 50%"></div>
							</div>
							<span class="progress-description"> Buka 24 Jam </span>
							
							<button class="btn btn-info">
								<i class="fa fa-arrows"></i>Route
							</button>
							<button class="btn btn-info">
								<i class="fa fa-eye"></i>Detail
							</button>
						</div><!-- /.info-box-content -->
					</div>
					<!-- end info box -->
				</template>
				

				<!--<h3 class="box-title">Fasilitas Kesehatan Terdekat</h3>-->

				<?php
				
				foreach ($faskes as $v) {

				?>
				<!-- info box -->
				<div class="info-box <?php echo $bgColor[$v->id_tipe]; ?>">
					<span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
					<div class="info-box-content">
						<span class="info-box-number"><?php echo $v->nama_faskes; ?></span>
						<span class="label pull-right"><?php echo $v->jarak; ?> KM </span>
						<span class="info-box-text">almat</span>
						<div class="progress">
							<div class="progress-bar" style="width: 50%"></div>
						</div>
						<span class="progress-description"> Buka 24 Jam </span>
						
						<button class="btn btn-info">
							<i class="fa fa-arrows"></i>Route
						</button>
						<button class="btn btn-info">
							<i class="fa fa-eye"></i>Detail
						</button>
					</div><!-- /.info-box-content -->
				</div>
				<!-- end info box -->
				<?php } ?>
				<!-- info box -->
				<!-- <div class="info-box bg-green">
					<span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
					<div class="info-box-content">
						<span class="info-box-number">Rumah Sakit Umum Daerah Salatiga</span>
						<span class="label pull-right">10.0 KM</span>
						<span class="info-box-text">Jl. Osamaliki</span>
						<div class="progress">
							<div class="progress-bar" style="width: 50%"></div>
						</div>
						<span class="progress-description"> Buka 24 Jam </span>
						<button class="btn btn-info">
							<i class="fa fa-arrows"></i>Route
						</button>
						<button class="btn btn-info">
							<i class="fa fa-eye"></i>Detail
						</button>
					</div>
				</div> -->
				<!-- end info box -->

			</div>
		</div>
		<!-- end row -->

		<!-- script begin -->
<script src="<?php echo base_url('assets/js'); ?>/mustache.min.js" type="text/javascript"></script>
				<script type="text/javascript">
				//ketika jarak diubah
				$('#jarak').change(function(){
					var distance = $('#jarak').val();
					var latlng = "<?php echo $this->uri->segment(3); ?>";
	          		var alamat = "<?php echo base_url('benchmark_rest'); ?>/haversine_open_close/"+latlng +"/" + distance;
					getNearby(alamat,distance);
					//alert(distance);
				});

				//ketika XMLHttpRequest done !
				var nearbyTemplate = $('#nearby').html();
				console.log("nearby template : " + nearbyTemplate);
		    	var $nearby = $('#faskes');
		    	function addLocation(nearby)
	          	{

	            	$nearby.append(Mustache.render(nearbyTemplate, nearby));
	          	}

				 //ajax request get nearby faskes
function getNearby(alamat,distance)
{
				var distance = typeof distance !== 'undefined' ? distance : 1;
         		$.ajax({
		              type:'GET',
		              url:alamat,
		              success:function(users)
		              {
		              		
		              		var locations =  JSON.parse(users);
		               		$('#waktu').html(locations['waktu']);
		              		$("#jumlah_faskes").html(locations['data'].length);
		               		$("#radius").html(locations['distance']);
		              		
				            // $nearby.html("");
				            $('#faskes').html("");
				            console.log(locations['data'].length);
				            //write to  nearby faskes
		                    $.each(locations['data'], function(i, location){
		                        addLocation(location);	
		                        //console.log(location);
		                     });//end each

		              },
		              error:function(){
		                  alert('oops something wrong');
		              },

		         });

}
				</script>
		<!-- end script -->

	</section><!-- /.content -->
</div><!-- /.content-wrapper