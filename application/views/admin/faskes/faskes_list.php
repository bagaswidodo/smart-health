<link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>"/>
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
      				<li class="active">
      				Fasilitas Keshatan
      				</li>
      			</ol>
      		</section>

          <!-- Main content -->
          <section class="content">
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>

            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Daftar Fasilitas Kesehatan</h3>
              </div>
              <div class="box-body">
              	<?php
                echo anchor('faskes/create','<button class="btn btn-success"><i class="fa fa-plus"></i>Tambahkan Faskes</button>');
                 ?>
                <Br /><br />


                <table border="0" cellspacing="5" cellpadding="5" class="table table-hover table-striped table-bordered" id="mytable">
                    <thead>
                    <tr>
                    	<th>No</th>
                    	<th>Nama <br> (Alamat)</th>
                    	<th>Tipe</th>
                    	<th>Foto</th>
                    	<th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                      $start = 0;
                      foreach ($faskes_data as $faskes)
                      {
                    ?>
                    <tr>
                    	<td><?php echo ++$start ?></td>
                    	<td><?php echo $faskes->nama_faskes . "<br /><small>" . $faskes->alamat . "</small>"; ?></td>
                    	<td><?php echo $faskes->id_tipe; ?></td>
                    	<td>no foto</td>
                    	<td>
                        <!-- faskes/read/'.$faskes->id_faskes
                        faskes/update/'.$faskes->id_faskes
                        faskes/delete/'.$faskes->id_faskes -->
                    		<?php echo anchor('faskes/update/'.$faskes->id_faskes, '<button class="btn btn-info"><i class="fa fa-pencil"></i>Ubah</button>'); ?>
                    		<?php echo anchor('faskes/delete/'.$faskes->id_faskes, '<button class="btn btn-danger"><i class="fa fa-pencil"></i>Hapus</button>'); ?>

                    		<?php
            							if ($faskes->id_tipe == 1 || $faskes->id_tipe == 2) {
            							         echo anchor('dokter/dokter_faskes/' . $faskes->id_faskes, '<button class="btn btn-warning"><i class="fa fa-user"></i> Dokter</button>');
            							} else {
            							         echo anchor('faskes_open/jadwal/' . $faskes->id_faskes, '<button class="btn btn-warning"><i class="fa fa-calendar"></i>Jadwal Praktek</button>');
            							}
          							?>

                    	</td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>

              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
              <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
              <script type="text/javascript">
                  $(document).ready(function () {
                      $("#mytable").dataTable();
                  });
              </script>
