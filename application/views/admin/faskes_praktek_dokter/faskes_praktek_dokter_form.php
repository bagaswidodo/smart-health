<link href="<?php echo base_url(); ?>/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>/assets/plugins/select2/js/select2.min.js"></script>

<!-- timepicker -->
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/plugins/jquery-timepicker/jquery.timepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/plugins/jquery-timepicker/jquery.timepicker.css" />

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
          Tambahkan Fasilitas Keshatan
        </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Tambahkan Layanan Kesehatan Baru</h3>

        </div>
        <div class="box-body">

          <form action="<?php echo $action; ?>" method="post">
              <?php
                  //jika aksi update<?php
                  $day = array(
                  1=>'Senin',
                  2=>'Selasa',
                  3=>'Rabu',
                  4=>'Kamis',
                  5=>'Jumat',
                  6=>'Sabtu');

                  if($aksi == "ubah")
                  {
                    echo '<h1>'.$nama_dokter.'</h1><small>'.$nama_faskes.'</small>';
                    echo '<h3>Jadwal Praktek Hari : '. $day[$hari].'</h3>';
                    echo form_hidden('hari', $hari);
                  }else{

               ?>
                <!-- hari select2  -->
                 <div class="form-group">
                    <label for="int">hari <?php echo form_error('hari') ?></label>
                    <select class="form-control" name="hari" id="hari" >
                      <?php
                      foreach($day as $k => $v)
                      {
                        echo '<option value='.$k.'>'.$v .'</option>';
                      }
                      ?>
                    </select>
                </div>
                <?php } ?>
                <!-- end hari select2 -->
                <!-- pagi input -->
                <div class="form-group">
                    <div class="col-sm-5">
                      <label for="time">Jam Mulai <?php echo form_error('jam_buka') ?></label>
                      <input type="text" class="form-control" name="jam_buka" id="jam_buka"
                      placeholder="jam_buka" value="<?php echo $jam_buka; ?>" />
                    </div>
                    <div class="col-sm-5">
                      <label for="time">Jam Selesai <?php echo form_error('jam_tutup') ?></label>
                      <input type="text" class="form-control" name="jam_tutup"
                      id="jam_tutup" placeholder="Jam Selesai Praktek"
                      value="<?php echo $jam_tutup; ?>" />
                    </div>
                  </div>
                <!-- end pagi -->

                <div class="row">
                </div>



              <?php
              $faskes = $this->uri->segment(3);
              $dokter = $this->uri->segment(4);

              if($faskes != NULL && $dokter != NULL)
              {
                $id_faskes = $faskes;
                $id_dokter = $dokter;
              }
              ?>
  	    <div class="form-group">
                  <!-- <label for="int">id_faskes <?php echo form_error('id_faskes') ?></label> -->
                  <input type="text" class="form-control" name="id_faskes" id="id_faskes" placeholder="id_faskes" value="<?php echo $id_faskes; ?>" />
              </div>
  	    <div class="form-group">
                  <!-- <label for="int">id_dokter <?php echo form_error('id_dokter') ?></label> -->
                  <input type="text" class="form-control" name="id_dokter" id="id_dokter" placeholder="id_dokter" value="<?php echo $id_dokter; ?>" />
              </div>
  	    <input type="hidden" name="" value="<?php //echo $; ?>" />
  	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
  	    <!-- <a href="<?php echo site_url('faskes_praktek_dokter') ?>" class="btn btn-default">Cancel</button> -->
  	</form>

        </div>
      </div>
      </section>

  </div><!-- container -->
</div>
<script>
$('#hari').select2({
  placeholder: "Pilih Hari Buka",
//  allowClear: true
});


//jam buka faskes
  $('#jam_buka').timepicker({
      'minTime': '5:00am',
      'maxTime': '11:30pm',
    'timeFormat': 'H:i',
      'showDuration': true
  }).on('selectTime', function(){
      $('#jam_tutup').timepicker({
        'minTime': $('#jam_buka').val(),
        'maxTime': '11:30pm',
        'timeFormat': 'H:i',
        'showDuration': true
      }).on('selectTime', function(){
      });
   });
</script>
