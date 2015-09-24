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
        <h2 style="margin-top:0px">Tb_faskes_open Read</h2>
        <table class="table">
	    <tr><td>id_faskes</td><td><?php echo $id_faskes; ?></td></tr>
	    <tr><td>hari</td><td><?php echo $hari; ?></td></tr>
	    <tr><td>jam_buka</td><td><?php echo $jam_buka; ?></td></tr>
	    <tr><td>jam_tutup</td><td><?php echo $jam_tutup; ?></td></tr>
	    <tr><td>jam_mulai_istirahat</td><td><?php echo $jam_mulai_istirahat; ?></td></tr>
	    <tr><td>jam_selesai_istirahat</td><td><?php echo $jam_selesai_istirahat; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('faskes_open') ?>" class="btn btn-default">Cancel</button></td></tr>
	</table>
    </body>
</html>