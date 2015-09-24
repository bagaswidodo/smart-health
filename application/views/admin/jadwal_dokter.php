<!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              Smart Health
              <small>Administration</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="#">Layout</a></li>
              <li class="active">Top Navigation</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Jadwal Praktek {nama RS / KLINIK }</h3>
              </div>
              <div class="box-body">
              	
              	
              	<?php echo anchor('admin/tambah_jadwal_dokter','<button class="btn btn-success"><i class="fa fa-plus"></i>Tambahkan Jam Praktek</button>'); ?>
                <Br /><br /><table border="0" cellspacing="5" cellpadding="5" class="table table-hover table-striped table-bordered">
                    <tr>
                    	<th><input type="checkbox"></th>
                    	<th>No</th>
                    	<th>Nama Dokter</th>
                    	<th>Hari</th>
                    	<th>Jam Praktek</th>
                    	<th>Aksi</th>
                    </tr>
                    <?php
                    $dokter = array("dr. Herp, Sp. OG", "dr. gareng");
                    $hari =array("Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
                    
					$jadwal = array("dr. herp" => $hari,"dr. derp" => $hari);
					
					foreach($dokter as $d){
						echo ' <tr><td colspan=6>' . $d. '</td></tr>';
						$i = 0;
						foreach($hari as $h ){
						?>
						<tr>
                    	<td><input type="checkbox"></td>
                    	<td><?php echo $i+1; ?></td>
                    	<td><?php //echo $dokter[i]; ?> dr. xyz</td>
                    	<td><?php echo $h; ?></td>
                    	<td>00:00 - 00:00 <br /><small>Jeda 00:00 - 00:00</small></td>
    
                    	<td>
                    		<?php echo anchor('admin/edit_faskes', '<button class="btn btn-info"><i class="fa fa-pencil"></i>Ubah</button>'); ?>
                    		<?php echo anchor('admin/edit_faskes', '<button class="btn btn-danger"><i class="fa fa-pencil"></i>Hapus</button>'); ?>
                    		
                    		
                    	</td>
                    </tr>
                    <?php  
                      $i++;} 
				
					}
						
                    ?>
                    
                </table>
                 
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->