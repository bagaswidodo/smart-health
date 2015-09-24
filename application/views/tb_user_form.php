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
        <h2 style="margin-top:0px">Tb_user <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                <label for="varchar">nama_user <?php echo form_error('nama_user') ?></label>
                <input type="text" class="form-control" name="nama_user" id="nama_user" placeholder="nama_user" value="<?php echo $nama_user; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">username <?php echo form_error('username') ?></label>
                <input type="text" class="form-control" name="username" id="username" placeholder="username" value="<?php echo $username; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">password <?php echo form_error('password') ?></label>
                <input type="text" class="form-control" name="password" id="password" placeholder="password" value="<?php echo $password; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">email <?php echo form_error('email') ?></label>
                <input type="text" class="form-control" name="email" id="email" placeholder="email" value="<?php echo $email; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">last_login <?php echo form_error('last_login') ?></label>
                <input type="text" class="form-control" name="last_login" id="last_login" placeholder="last_login" value="<?php echo $last_login; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">api_key <?php echo form_error('api_key') ?></label>
                <input type="text" class="form-control" name="api_key" id="api_key" placeholder="api_key" value="<?php echo $api_key; ?>" />
            </div>
	    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('tb_user') ?>" class="btn btn-default">Cancel</button>
	</form>
    </body>
</html>