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
        <h2 style="margin-top:0px">Tb_faskes_tipe <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                <label for="varchar">deskripsi <?php echo form_error('deskripsi') ?></label>
                <input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="deskripsi" value="<?php echo $deskripsi; ?>" />
            </div>
	    <input type="hidden" name="id_tipe" value="<?php echo $id_tipe; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('faskes_tipe') ?>" class="btn btn-default">Cancel</button>
	</form>
    </body>
</html>