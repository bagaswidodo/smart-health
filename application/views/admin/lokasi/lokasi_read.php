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
        <h2 style="margin-top:0px">Tb_lokasi Read</h2>
        <table class="table">
	         <tr>
             <td>nama</td>
             <td><?php echo $nama; ?></td>
           </tr>
	        <tr>
            <td>lokasi</td>
            <td><?php echo $lokasi; ?>  <?php echo anchor('lihat_map','liat_map'); ?></td>
          </tr>
	         <tr>
             <td></td>
             <td><a href="<?php echo site_url('lokasi') ?>" class="btn btn-default">Cancel</button>
          </td>
      </tr>
	</table>
    </body>
  
</html>
