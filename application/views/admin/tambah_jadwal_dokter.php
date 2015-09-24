<!-- Full Width Column -->
<div class="content-wrapper">
	<div class="container">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1> Smart Health <small>Administration</small></h1>
			<ol class="breadcrumb">
				<li>
					<a href="#"><i class="fa fa-dashboard"></i> Home</a>
				</li>
				<li>
					<a href="#">Layout</a>
				</li>
				<li class="active">
					Top Navigation
				</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">Tambahkan Jadwal Dokter {Nama Dokter}</h3>
				</div>
				<div class="box-body">
					<?php echo form_open('', array('class' => "form-horizontal")); ?>
					<div class="row">
						<div class="container">
					
								<div class="form-group">
									<small>Jika Rumah sakit</small>
									<label class="control-label col-sm-2">Nama fasilitas Keseatan</label>
									<div class="col-sm-8">
										<input disabled type="email" placeholder="Email" id="inputEmail3" class="form-control">
									</div>
								</div>
							<div class="form-group">
									<small>Jika Rumah sakit</small>
									<label class="control-label col-sm-2">Jadwal Praktek</label>
									<div class="col-sm-2">
										<input  type="email" placeholder="Hari {autocomplete}" id="inputEmail3" class="form-control">
									</div>
									<div class="col-sm-2">
										<input  type="email" placeholder="jam mulai" id="inputEmail3" class="form-control">
									</div>
									<div class="col-sm-2">
										<input  type="email" placeholder="jam berakhir" id="inputEmail3" class="form-control">
									</div>
								</div>
							
							<div class="form-group">
									<small>Jika Dokter umum </small>
									<label class="control-label col-sm-2">Jeda Praktek</label>
									<div class="col-sm-2">
										<input  type="email" placeholder="Hari {autocomplete}" id="inputEmail3" class="form-control">
									</div>
									<div class="col-sm-2">
										<input  type="email" placeholder="jam mulai" id="inputEmail3" class="form-control">
									</div>
									<div class="col-sm-2">
										<input  type="email" placeholder="jam berakhir" id="inputEmail3" class="form-control">
									</div>
								</div>
							<div class="row">
								<div class="col-xs-12">
								<button type="submit" class="btn btn-default">Tambahkan Jam Praktek</button>
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