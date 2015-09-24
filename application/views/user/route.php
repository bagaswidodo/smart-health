<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1> Rute <br />&lt;&lt; Menu samping di ganti atau di hide )</h1>
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
<!--
		<div class="callout callout-success">

			<h4>Rute Ditemukan !</h4>
			<p>
				Rute dari {location awal decoded geojson} ke {lokasi tujuan decoded geojson}
				dalam {elapsed time} detik
			</p>

		</div>-->

		<!-- end info -->

		<!-- Your Page Content Here -->
		<div class="row">
			<section class="col-lg-7">
				<!-- map here -->
				<div class="box box-solid bg-light-blue-gradient">
					<div class="box-header">
						

						<i class="fa fa-map-marker"></i>
						<h3 class="box-title"> Peta </h3>
					</div>
					<div class="box-body">
						<div style="height: 250px; width: 100%;" id="world-map"></div>
					</div><!-- /.box-body-->
					<div class="box-footer no-border">
						<div class="row">
							<div class="col-xs-12">
								<p style="color:black">
									Rute dari <b>{location awal decoded geojson}</b> ke <b>{lokasi tujuan decoded geojson}</b>
									dalam <b>{elapsed time}</b> detik
								</p>
							</div>

						</div><!-- /.row -->
					</div>
				</div>
				<!-- end map -->

			</section>
			<section class="col-lg-5">
				<div class="box box-success">
					<div class="box-header">Rute</div>
					<div class="box-body">
						Rute bla bla
						<ul>
							<li>dfd</li>
						</ul>
					</div>
				</div>
			</section>
		</div>

	</section><!-- /.content -->
</div><!-- /.content-wrapper -->