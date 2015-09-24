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
        Daftar Dokter
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
          <h3 class="box-title">Daftar Dokter <?php echo $nama_faskes; ?>
            <?php //$id_faskes = $this->uri->segment(3); ?></h3>
        </div>
        <div class="box-body">
            <?php echo anchor(site_url('dokter/create/' . $id_faskes ), 'Create', 'class="btn btn-primary"'); ?>
            <table class="table table-bordered table-striped" id="mytable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>nama_dokter</th>
                        <th>alamat</th>
                        <th>nomor_telpon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                 <tbody>
                <?php
                $start = 0;
                foreach ($dokter_data as $dokter)
                {
                    ?>
                    <tr>
                      <td><?php echo ++$start ?></td>
                      <td><?php echo $dokter->nama_dokter ?></td>
                      <td><?php echo $dokter->alamat ?></td>
                      <td><?php echo $dokter->nomor_telpon ?></td>
                      <td>
                    <?php
                    echo anchor(site_url('faskes_praktek_dokter/jadwal_dokter/'. $dokter->id_faskes . '/' . $dokter->id_dokter),'<button class="btn btn-success"><i class="fa fa-calendar"></i>Jadwal Praktek</button>');
                    //echo ' | ';
                    //echo anchor(site_url('dokter/read/'.$dokter->id_dokter),'Read');
                  //  echo ' | ';
                    echo anchor(site_url('dokter/update/'.$id_faskes . '/' . $dokter->id_dokter),' <button class="btn btn-default"><i class="fa fa-pencil"></i>Update</button>');
                  //  echo ' | ';
                    echo anchor(site_url('dokter/delete/'.$id_faskes . '/' .$dokter->id_dokter),' <button class="btn btn-danger"><i class="fa fa-trash"></i>Delete</button>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                    ?>
                      </td>
                     </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
      </div>
    </section>

  </div>
</div>


        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#mytable").dataTable();
            });
        </script>
