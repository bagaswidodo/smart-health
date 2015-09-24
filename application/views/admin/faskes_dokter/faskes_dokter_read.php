<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Dokter {<?php echo $nama_dokter; ?>} Faskes {<?php echo $nama_faskes; ?>}</h2>

        <table class="table">
	    <tr><td></td><td>
        <a href="<?php echo site_url('faskes_dokter') ?>" class="btn btn-default">Cancel</a>
        <button class="btn btn-info">Tambahkan Jadwal Praktek</button>
      </td></tr>
	</table>
    </body>
</html>
