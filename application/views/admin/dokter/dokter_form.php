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
          <!-- <a href="#">Fasilitas Kesehatan</a> -->
          <?php echo anchor('faskes', 'Fasilitas Kesehatan'); ?>
        </li>
        <li class="active">
          Dokter Fasilitas Kesehatan
        </li>
      </ol>
    </section>

    <section class="content">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo $aksi; ?> Dokter Baru</h3>
          <?php
          echo $button;

          $id = $this->uri->segment(3);
          if($id != NULL)
          {
            $id_faskes = $id;
          }
           ?>

        </div>
        <div class="box-body">
          <form action="<?php echo $action; ?>" method="post">
        	    <div class="form-group">
                        <label for="varchar">Nama Dokter <?php echo form_error('nama_dokter') ?></label>
                        <input type="text" class="form-control" name="nama_dokter" id="nama_dokter" placeholder="nama_dokter" value="<?php echo $nama_dokter; ?>" />
                        <!-- solve this -->
                        <?php $id_faskes = (isset($id_faskes)) ? $id_faskes : $this->uri->segment(3); ?>
                        <input type="hidden" class="form-control" name="id_faskes" id="id_faskes" placeholder="nama_faskes" value="<?php echo $id_faskes; ?>" />
                    </div>
        	    <div class="form-group">
                        <label for="varchar">Alamat <?php echo form_error('alamat') ?></label>
                        <input type="text" class="form-control" name="alamat" id="alamat" placeholder="alamat" value="<?php echo $alamat; ?>" />
                    </div>
        	    <div class="form-group">
                        <label for="varchar">Nomor Telpon <?php echo form_error('nomor_telpon') ?></label>
                        <input type="text" class="form-control" name="nomor_telpon" id="nomor_telpon" placeholder="nomor_telpon" value="<?php echo $nomor_telpon; ?>" />
                    </div>
        	    <input type="hidden" name="id_dokter" value="<?php echo $id_dokter; ?>" />
        	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
              <button type="button" class="btn btn-default">Batal</button>
        	    <!-- <a href="<?php echo site_url('dokter') ?>" class="btn btn-default">Cancel</button> -->
        	</form>
        </div>
      </div>
    </section>
   </div><!--content wrappe -->
 </div><!--container -->
