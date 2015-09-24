<!-- Content Wrapper. Contains page content -->
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

					<!-- Your Page Content Here -->
					<div class="row">
						<div class="col-md-10 info-box">
							<!--<h3 class="box-title">Fasilitas Kesehatan Terdekat</h3>-->


							<?php
								$bgColor = array("bg-yellow","bg-green","bg-red","bg-aqua");
								
								foreach ($bgColor as $v) {
									
								
							?>
							<!-- info box -->
							<div class="info-box <?php echo $v; ?>">
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
								</div><!-- /.info-box-content -->
							</div>
							<!-- end info box -->
							<?php } ?>
							<!-- info box -->
							<div class="info-box bg-green">
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
								</div><!-- /.info-box-content -->
							</div>
							<!-- end info box -->

		
						</div>
					</div>

				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->