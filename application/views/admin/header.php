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
            <li class="active"><a href="#"><span class="fa fa-dashboard"></span> Dashboard <span class="sr-only">(current)</span></a></li>
            <li><?php echo anchor('faskes','<span class="fa fa-bed"></span> Fasilitas Kesehatan'); ?></li>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="fa fa-user"></span><?php echo ucfirst($nama); ?> <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#"> <span class="fa fa-calendar-o"></span> History</a></li>
                  <li><a href="<?php echo base_url('user/account_setting'); ?>"><span class="fa fa-cog"></span> Ubah Password</a></li>
                  <li class="divider"></li>
                  <li><a href="<?php echo base_url('auth/logout'); ?>"><span class="fa fa-sign-out"></span> Keluar</a></li>
                </ul>
            </ul>
          </div><!-- /.navbar-custom-menu -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>
