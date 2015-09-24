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
      			</ol>
      		</section>



          <!-- Main content -->
          <section class="content">

            <div class="box box-default col-md-10">
              <div class="box-header with-border">
                <h3 class="box-title">Ubah Password</h3>
                <div class="box-body">



                    <?php
                    $msg = $this->session->userdata('message') <> '' ? "<div class='alert alert-info'>".$this->session->userdata('message')."</div>" : '';
                     echo $msg;
                     ?>


                  <?php echo form_open('user/change_password'); ?>
                  <div class="form-group">
                    <label for="password">Password lama</label>
                      <?php echo form_error('password','<div class="alert alert-danger">', '</div>'); ?>
                    <input type="password" name="password" class="form-control"  placeholder="Password. . .">
                  </div>
                      <div class="form-group">
                        <label for="password">Password Baru</label>
                          <?php echo form_error('new_password','<div class="alert alert-danger">', '</div>'); ?>
                        <input type="password" name="new_password" class="form-control"  placeholder="Password. . .">
                      </div>
                      <div class="form-group">
                        <label for="password">Konfirmasi Password</label>
                          <?php echo form_error('c_password','<div class="alert alert-danger">', '</div>'); ?>
                        <input type="password" name="c_password" class="form-control"  placeholder="Konfirmasi Password. . .">
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-info">Daftar</button>
                      </div>
                  <?php echo form_close(); ?>
                </div>
              </div>

            </div>
          </section>
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
