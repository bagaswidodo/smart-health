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
              <li>
              <?php echo anchor('faskes','<i class="fa fa-dashboard"></i> Fasilitas Kesehatan');?>
              </li>
      				<li class="active">
      				<!-- Fasilitas Keshatan -->
              Jam Kerja Fasilitas Kesehatan
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
                <h3 class="box-title"><?php echo $title; ?></h3>
              </div>
              <div class="box-body">
                  <?php
                  $id_faskes = $this->uri->segment(3);
                  $msg = '<div class="alert alert-info">'.$this->session->userdata('message').'</div><Br /><br />';
                  echo $this->session->userdata('message') <> '' ? $msg : '';
                  echo anchor(site_url('faskes_open/create/'.$id_faskes), 'Create', 'class="btn btn-primary"');


                  ?>
                  <br><br>
                <table class="table table-bordered table-striped" id="mytable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Faskes</th>
                             <th>Jadwal</th>
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
                    foreach ($faskes_open_data as $faskes_open)
                    {
                        ?>
                        <tr>
                            <td><?php echo ++$start ?></td>
                            <td><?php echo $faskes_open->nama_faskes ?></td>
                            <td>
                              <?php


                                  echo "<b>" . $hari[$faskes_open->hari] . "</b>";
                                  if(($faskes_open->jam_mulai_istirahat == "00:00:00" && $faskes_open->jam_selesai_istirahat == "00:00:00") ||
                                  ($faskes_open->jam_mulai_istirahat == NULL && $faskes_open->jam_selesai_istirahat == NULL))
                                  {

                                    echo "<Br /><small>" .date("H:i",strtotime($faskes_open->jam_buka)). " - "
                                      . date("H:i",strtotime($faskes_open->jam_tutup))."</small>";
                                  }
                                  else
                                  {
                                    echo "<br /><small>" .date("H:i",strtotime($faskes_open->jam_buka)) . " - "
                                      . date("H:i",strtotime($faskes_open->jam_mulai_istirahat)) ."</small>";
                                    echo "<Br /><small>" .date("H:i",strtotime($faskes_open->jam_selesai_istirahat)). " - "
                                      . date("H:i",strtotime($faskes_open->jam_tutup))."</small>";

                                  }
                              ?>
                            </td>
                  <!-- <td><?php echo $faskes_open->jam_buka ?></td>
                <td><?php echo $faskes_open->jam_tutup ?></td>
                <td><?php echo $faskes_open->jam_mulai_istirahat ?></td>
                <td><?php echo $faskes_open->jam_selesai_istirahat ?></td> -->
                <td style="text-align:center">
              <?php
              echo anchor(site_url('faskes_open/read/' . $faskes_open->id_faskes . '/' . $faskes_open->hari),'Read');
              echo ' | ';
            //  echo anchor(site_url('faskes_open/read/' . $faskes_open->id_faskes . '/' . $faskes_open->hari),'Jadwal Praktek');
            	echo anchor(site_url('faskes_open/update/' . $faskes_open->id_faskes . '/' . $faskes_open->hari),'Update');
              echo ' | ';
              echo anchor(site_url('faskes_open/delete/'. $faskes_open->id_faskes . '/' . $faskes_open->hari),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
              ?>
                </td>
                  </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <!-- end table -->
              </div>
            </div>
          </section>
        </div><!--container -->
      </div><!-- wrapper -->

      <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
      <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
      <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
      <script type="text/javascript">
          $(document).ready(function () {
              $("#mytable").dataTable();
          });
      </script>
