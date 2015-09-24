<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/img/favicon.png">

    <title>FLATTY - Free Bootstrap 3 Landing Page</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>/assets/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/landing_page/css/main.css" rel="stylesheet">

    <!-- Fonts from Google Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>




    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><b>S-HEALTH</b></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo base_url('admin/'); ?>">Sudah Mendaftar?</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

	<div id="headerwrap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<h1>Temukan Layanan Kesehatan Sekitar Anda dalam detik</h1>
					<?php echo form_open('health/find', array('class' => 'form-inline', 'role' => 'form')); ?>
					<!--<form class="form-inline" role="form">-->
					  <div class="form-group">
					    <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi Saya {dropdown}">
					   <input class="form-control" type="hidden" id="koordinat"></input>
            </div>
					  <?php
					//echo anchor('welcome/locations','<button type="submit" class="btn btn-warning btn-lg">Temukan</button>');
					  ?>
					  <button type="button" class="btn btn-warning btn-lg" id="temukan">Temukan</button>
					  <button type="button" class="btn btn-warning btn-lg" id="temukan_geo">Temukan Geo</button>
					</form>
				</div><!-- /col-lg-6 -->
				<div class="col-lg-6">
					<img class="img-responsive" src="<?php echo base_url(); ?>assets/landing_page/img/ipad-hand.png" alt="">
				</div><!-- /col-lg-6 -->

			</div><!-- /row -->
		</div><!-- /container -->
	</div><!-- /headerwrap -->





	<div class="container">
		<hr />
		<p class="pull-right"><small>Created by BlackTie.co - Attribution License 3.0 - Engine By 672011199.
			<?php echo anchor('', 'About') . " | " . anchor('#', 'How To') . " | " .anchor('#','API') ?></small></p>
	</div><!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.11.2.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.min.js'); ?>"></script>
  <link rel="stylesheet" href="<?php echo base_url('assets/css'); ?>/jquery-ui.min.css" type="text/css" media="all" />

    <script type='text/javascript'>
    $(this).ready( function() {
      $("#lokasi").autocomplete({
          minLength: 1,
          source:
          function(req, add){
              $.ajax({
              url: "<?php echo base_url(); ?>lokasi/json",
                dataType: 'json',
                type: 'POST',
                data: req,
                success:

                function(data){
                  
                    if(data.response ==true){
                      add(data.message);
                      
                    }
                },
                });
          },
         select:
          function(event, ui) {
            $("#koordinat").val( ui.item.id );
          },
      });
    });

    var path = "<?php echo base_url('welcome/locations/'); ?>";
    

    $('#temukan').click(function(){
        
        var koordinat = $('#koordinat').val();
        window.location = path + "/" + koordinat;
        
    });

    $('#temukan_geo').click(function(){
        var koordinat = $('#koordinat').val();
        window.location = path + "/" + koordinat;
    });

  </script>
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
