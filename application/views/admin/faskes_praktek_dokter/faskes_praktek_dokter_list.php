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
          <?php echo anchor('faskes','Fasilitas Kesehatan'); ?>
        </li>
        <li class="active">
        Jadwal Praktek Dokter
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
      <h3 class="box-title">Jadwal Praktek <?php echo $nama_dokter , "(" . $nama_faskes . ")"; ?></h3>
    </div>
    <div class="box-body">
      <?php
      $id_faskes = $this->uri->segment(3);
      $id_dokter= $this->uri->segment(4);

      ?>
        <?php echo anchor(site_url('faskes_praktek_dokter/create/' . $id_faskes .'/' . $id_dokter), 'Create', 'class="btn btn-primary"'); ?>

      <Br /><br />
      <table class="table table-bordered table-striped" id="mytable">
          <thead>
              <tr>
                  <th>No</th>
      <th>Hari</th>
      <th>jam Praktek</th>
      <!-- <th>jam_tutup</th>
      <th>jam_mulai_istirahat</th>
      <th>jam_selesai_istirahat</th> -->
      <!-- <th>id_faskes</th> -->

      <th>Action</th>
              </tr>
          </thead>
    <tbody>
          <?php
          $start = 0;
          $hari = array(
            1 => 'Minggu',
            2 => 'Senin',
            3 => 'Selasa',
            4 => 'Rabu',
            5 => 'Kamis',
            6 => 'Jumat',
            7 => 'Sabtu'
          );
          foreach ($faskes_praktek_dokter_data as $faskes_praktek_dokter)
          {
              ?>
              <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo "<b>" . $hari[$faskes_praktek_dokter->hari] . "</b>"; ?></td>
                <td>
                  <?php
                //  echo $faskes_praktek_dokter->jam_buka



                    // if($faskes_praktek_dokter->jam_mulai_istirahat == "00:00:00" && $faskes_praktek_dokter->jam_selesai_istirahat == "00:00:00")
                    // {
                    // //  echo "<b>" . $hari[$faskes_praktek_dokter->hari] . "</b>";
                       echo "<small>" .date("H:i",strtotime($faskes_praktek_dokter->jam_buka)). " - "
                        . date("H:i",strtotime($faskes_praktek_dokter->jam_tutup))."</small>";
                    // }
                    // else
                    // {
                    //   //echo "<b>" . $hari[$faskes_praktek_dokter->hari] . "</b>";
                    //   echo "<small>" .date("H:i",strtotime($faskes_praktek_dokter->jam_buka)) . " - "
                    //     . date("H:i",strtotime($faskes_praktek_dokter->jam_mulai_istirahat)) ."</small>";
                    //   echo "<Br /><small>" .date("H:i",strtotime($faskes_praktek_dokter->jam_selesai_istirahat)). " - "
                    //     . date("H:i",strtotime($faskes_praktek_dokter->jam_tutup))."</small>";
                    //
                    // }

                  ?>
                </td>
                <!-- <td><?php echo $faskes_praktek_dokter->jam_tutup ?></td>
                <td><?php echo $faskes_praktek_dokter->jam_mulai_istirahat ?></td>
                <td><?php echo $faskes_praktek_dokter->jam_selesai_istirahat ?></td> -->
                <!-- <td><?php echo $faskes_praktek_dokter->id_faskes ?></td> -->

                <td style="text-align:center">
                <?php
                //  echo anchor(site_url('faskes_praktek_dokter/read/'.$faskes_praktek_dokter->id_faskes),'Read');
                //  echo ' | ';
                  echo anchor(site_url('faskes_praktek_dokter/update/'.$faskes_praktek_dokter->id_faskes . '/'
                  . $faskes_praktek_dokter->id_dokter . '/' . $faskes_praktek_dokter->hari),'Update');
                  echo ' | ';
                  echo anchor(site_url('faskes_praktek_dokter/delete/'.$faskes_praktek_dokter->id_faskes . '/'
                  . $faskes_praktek_dokter->id_dokter . '/' . $faskes_praktek_dokter->hari),
                  'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                ?>
                </td>
              </tr>
              <?php
          }
          ?>
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
