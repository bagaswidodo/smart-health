<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
        <style>
            body{
                padding: 15px;
            }
        </style>
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

               <!-- timepicker -->
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.8.1/jquery.timepicker.min.js"></script>
               <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.8.1/jquery.timepicker.min.css" />

               <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.min.js"></script>
               <link rel="stylesheet" type="text/css" href=" https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/css/bootstrap-datepicker.css" />


    </head>
    <body>
        <h2 style="margin-top:0px">Tambahkan Dokter Faskes <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
        <?php if(!isset($nama_faskes)){ ?>
          <div class="form-group">
                    <label for="int">Nama Faskes <?php echo form_error('id_faskes') ?></label>
                    <select name="id_faskes" id="id_faskes" class="form-control"></select>
          </div>
        <?php
      } else{
          echo "<h1>" .  $nama_faskes . "</h1>";
            echo form_hidden('id_faskesx',$id_faskes);
      }

      ?>
          <div class="form-group">
                    <label for="int">Nama Dokter <?php echo form_error('id_dokter') ?></label>
                    <select name="id_dokter" id="id_dokter" class="form-control"></select>
          </div>
          <div class="form-group">
                    <label for="time">jam_buka <?php echo form_error('jam_buka') ?></label>
                    <input type="text" class="form-control" name="jam_buka" id="jam_buka" placeholder="jam_buka" value="<?php echo $jam_buka; ?>" />
                </div>
          <div class="form-group">
                    <label for="time">jam_tutup <?php echo form_error('jam_tutup') ?></label>
                    <input type="text" class="form-control" name="jam_tutup" id="jam_tutup" placeholder="jam_tutup" value="<?php echo $jam_tutup; ?>" />
                </div>
          <div class="form-group">
                    <label for="time">jam_mulai_istirahat <?php echo form_error('jam_mulai_istirahat') ?></label>
                    <input type="text" class="form-control" name="jam_mulai_istirahat" id="jam_mulai_istirahat" placeholder="jam_mulai_istirahat" value="<?php echo $jam_mulai_istirahat; ?>" />
                </div>
          <div class="form-group">
                    <label for="time">jam_selesai_istirahat <?php echo form_error('jam_selesai_istirahat') ?></label>
                    <input type="text" class="form-control" name="jam_selesai_istirahat" id="jam_selesai_istirahat" placeholder="jam_selesai_istirahat" value="<?php echo $jam_selesai_istirahat; ?>" />
                </div>
	    <!-- <input type="text" name="id_dokter" value="<?php echo $id_dokter; ?>" />
      <input type="text" name="id_faskes" value="<?php echo $id_faskes; ?>" /> -->
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('faskes_dokter') ?>" class="btn btn-default">Cancel</button>
	</form>
  <script>
  $( "#id_faskes" ).select2({
    ajax: {
      //http://localhost/~salatiga-health/v1/faskes_tipe/tipe_json
      url: "<?php echo base_url(); ?>faskes/json",
      dataType: 'json',
      delay: 250,
      data: function (params) {
        return {
          q: params.term
        };
      },
      processResults: function (data) {
        return {
          results: data
        };
      },
      cache: true
    },
    minimumInputLength: 2,

  });


//  faskes
   $( "#id_dokter" ).select2({
      ajax: {
        //http://localhost/~salatiga-health/v1/faskes_tipe/tipe_json
        url: "<?php echo base_url(); ?>dokter/json",
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            q: params.term
          };
        },
        processResults: function (data) {
          return {
            results: data
          };
        },
        cache: true
      },
      minimumInputLength: 2,

    });


    /*-------------- Time Picker ------------------ */
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
      			//	$('#tutup').html($('#durationExample2').val());
      		});
      //	$('#buka').html($('#durationExample').val());
       });

       //break time
        $('#jam_mulai_istirahat').timepicker({
             'minTime': '5:00am',
             'maxTime': '11:30pm',
         	'timeFormat': 'H:i',
             'showDuration': true
         }).on('selectTime', function(){
         		$('#jam_selesai_istirahat').timepicker({
         			'minTime': $('#jam_mulai_istirahat').val(),
         			'maxTime': '11:30pm',
         			'timeFormat': 'H:i',
         			'showDuration': true
         		});
          });
  </script>
    </body>
</html>
