<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
    <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="skin-blue layout-top-nav">

    <!-- header -->
    <div class="wrapper">

      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <a href="../../index2.html" class="navbar-brand"><b>App</b>Health</a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">

              </ul>
            </div><!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <li><a href="<?php echo base_url('/'); ?>">Frontend</a></li>
                </ul>
              </div><!-- /.navbar-custom-menu -->
          </div><!-- /.container-fluid -->
        </nav>
      </header>
    <!-- end header -->

    <!-- content -->
    <div class="content-wrapper">
      <div class="container">

        <div class="col-md-3">

        </div>
      <div class="col-md-6">
        <!-- Main content -->
        <section class="content">

          <div class="box box-default col-md-4">
            <div class="box-header with-border">
              <h3 class="box-title">Login Administrator</h3>
              <div class="box-body">

                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                <?php echo form_open('auth/cek'); ?>
                    <div class="form-group">
                      <label for="email">Username</label>
                      <?php echo form_error('username','<div class="alert alert-danger">', '</div>'); ?>
                      <input type="text" name="username" class="form-control" placeholder="Username. . . ">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                        <?php echo form_error('password','<div class="alert alert-danger">', '</div>'); ?>
                      <input type="password" name="password" class="form-control"  placeholder="Password. . .">
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-default">Login</button>
                    </div>
                <?php echo form_close(); ?>
              </div>
            </div>
            <div class="box-body">
              <?php
              echo anchor('user/daftar','Daftar');
              echo "<br>";
              echo anchor('#','Lupa Password');
              ?>
            </div>
          </div>
        </section>
     </div>  <!-- end col md 6 -->

      </div>
    </div>



    <!-- end content -->


    <footer class="main-footer">
            <div class="container">
              <div class="pull-right hidden-xs">
                <b>Version</b> 2.0
              </div>
              <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
            </div><!-- /.container -->
          </footer>
        </div><!-- ./wrapper -->


        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      </body>
    </html>
