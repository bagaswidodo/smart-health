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
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Daftar Fasilitas Kesehatan</h3>
              </div>
              <div class="box-body">
              	<?php echo anchor('admin/add_faskes','<button class="btn btn-success"><i class="fa fa-plus"></i>Tambahkan Faskes</button>'); ?>
                <Br /><br /><table border="0" cellspacing="5" cellpadding="5" class="table table-hover table-striped table-bordered">
                    <tr>
                      <thead>
                      	<th>No</th>
                      	<th>Nama <br> (Alamat)</th>
                      	<th>Tipe</th>
                      	<th>Foto</th>
                      	<th>Aksi</th>
                      </thead>
                    </tr>
                    <tbody>
                    <?php
                    $nama_faskes = array("RSUD Salatiga", "Klinik Aura Medika", "Dr. Hasto");
					$alamat = array("Jl. Osamaliki", "Jl. Brigjen Katamso", "Jl. Salatiga Kopeng");
					$tipe = array("Rumah Sakit", "Klinik", "Dokter Umum");
					$kd_tipe = array(0,1,2);
					for($i = 0;$i<3;$i++){
                    ?>
                    <tr>
                    	<td><?php echo $i+1; ?></td>
                    	<td><?php echo $nama_faskes[$i] . "<br /><small>" . $alamat[$i] . "</small>"; ?></td>
                    	<td><?php echo $tipe[$i]; ?></td>
                    	<td>no foto</td>
                    	<td>
                    		<?php echo anchor('admin/edit_faskes', '<button class="btn btn-info"><i class="fa fa-pencil"></i>Ubah</button>'); ?>
                    		<?php echo anchor('admin/edit_faskes', '<button class="btn btn-danger"><i class="fa fa-pencil"></i>Hapus</button>'); ?>

                    		<?php
							// 0 => RS, 1 => KLINIK
							$t = $kd_tipe[$i];
							if ($t == 0 || $t == 1) {
							echo anchor('admin/jadwal_dokter', '<button class="btn btn-warning"><i class="fa fa-calendar"></i>Jadwal Praktek Dokter</button>');

							} else {
							echo anchor('admin/jadwal_praktek', '<button class="btn btn-warning"><i class="fa fa-calendar"></i>Jadwal Dokter</button>');
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
