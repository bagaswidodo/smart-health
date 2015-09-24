			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1> Tambahkan Fasilitas Kesehatan </h1>
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
							<h3 class="box-title">Fasilitas Kesehatan Baru</h3>

						</div><!-- /.box-header -->
						<div class="box-body">
							<form role="form">
								<div class="box-body">
									<div class="form-group">
										<label>Nama Fasilitas Kesehatan</label>
										<input type="text" class="form-control" placeholder="Nama Faskes. . . ">
									</div>
									<div class="form-group">
										<label>Tipe</label>
										<?php
										$tipe = array(0 => "Rumah Sakit", 1 => "Klinik", 
										2 =>"Dokter Umum", 3 =>"Dokter Spesialis", 4 => "Puskesmas", 5 => "Bidan")
										?>
										<select class="form-control">
											<?php 
											foreach ($tipe as $key => $value) {
												echo "<option value=$key>$value</option>";
											}
											?>
									
											
										</select>
									</div>
									<div class="form-group">
										<label>Alamat</label>
										<input type="text" class="form-control" placeholder="Nama Faskes. . . ">
									</div>
									<div class="form-group">
										<label>Lokasi</label>
										<div class="row">
											<div class="col-xs-3">
												<input type="text" class="form-control col-xs-5" placeholder="Latitude">
											</div>
											<div class="col-xs-3">
												<input type="text" class="form-control col-xs-5" placeholder="Longitude">
											</div>
											<div class="col-xs-2">
												<button class="btn btn-default">Get My Location</button>
											</div>
										</div>
										<div class="row">
											<div>Map Here</div>
										</div>
										
										
									</div>
									
									
									
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
