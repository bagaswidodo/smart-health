<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1> Jadwal Praktek  </h1>
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

		<!-- Your Page Content Here -->
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Jadwal Praktek {nama}</h3>

			</div><!-- /.box-header -->
			<div class="box-body">
				<form role="form">
					<div class="box-body">
						<div class="form-group">
							<label>Nama Fasilitas Kesehatan</label>
							<input type="text" disabled class="form-control" placeholder="Nama Faskes. . . ">
						</div>
						<div class="form-group">
							<label>Jadwal Praktek</label>
						</div>
						<?php
						$hari = array("Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
						foreach ($hari as $v) {
						?>
						<div class="form-group row">
							<label class="col-sm-1 control-label" for="inputEmail3"><?php echo $v; ?></label>
							<div class="col-sm-3">
								toggle buton
							</div>
							<div class="col-sm-4">
								slider kerja 
							</div>
							<div class="col-sm-8">
								slider jeda 
							</div>
						</div>
						<?php } ?>
					</div><!-- /.box-body -->

					<div class="box-footer">
						<button class="btn btn-primary" type="submit">
							Submit
						</button>
					</div>
				</form>
			</div><!-- ./box-body -->

		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
