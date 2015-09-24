<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Daftar Dokter Faskes</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('faskes_dokter/create'), 'Create', 'class="btn btn-primary"'); ?>
            </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Dokter</th>
                    <th>Nama Fasilitas Kesehatan</th>
		                <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($faskes_dokter_data as $faskes_dokter)
            {
                ?>
                <tr>
		                <td><?php echo ++$start ?></td>
                    <td><?php echo $faskes_dokter->nama_dokter ?></td>
                    <td><?php echo $faskes_dokter->nama_faskes ?></td>

		    <td style="text-align:center">
			<?php
			echo anchor(site_url('faskes_dokter/read/'.$faskes_dokter->id_dokter . '/' . $faskes_dokter->id_faskes),'Read');
			echo ' | ';
      echo anchor(site_url('faskes_dokter/read/'.$faskes_dokter->id_dokter . '/' . $faskes_dokter->id_faskes),'Jadwal Praktek');
			//echo anchor(site_url('faskes_dokter/update/'.$faskes_dokter->id_dokter. '/' . $faskes_dokter->id_faskes),'Update');
			echo ' | ';
			echo anchor(site_url('faskes_dokter/delete/'.$faskes_dokter->id_dokter. '/' . $faskes_dokter->id_faskes),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
			?>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#mytable").dataTable();
            });
        </script>
    </body>
</html>
