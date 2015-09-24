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
        <h2 style="margin-top:0px">Tb_dokter <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                <label for="varchar">nama_dokter <?php echo form_error('nama_dokter') ?></label>
                <input type="text" class="form-control" name="nama_dokter" id="nama_dokter" placeholder="nama_dokter" value="<?php echo $nama_dokter; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">alamat <?php echo form_error('alamat') ?></label>
                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="alamat" value="<?php echo $alamat; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">nomor_telpon <?php echo form_error('nomor_telpon') ?></label>
                <input type="text" class="form-control" name="nomor_telpon" id="nomor_telpon" placeholder="nomor_telpon" value="<?php echo $nomor_telpon; ?>" />
            </div>
	    <input type="hidden" name="id_dokter" value="<?php echo $id_dokter; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('dokter_faskes') ?>" class="btn btn-default">Cancel</button>
	</form>
    </body>
</html>