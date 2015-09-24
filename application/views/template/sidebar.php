<!-- Left side column. contains the logo and sidebar -->
			<aside class="main-sidebar">

				<!-- sidebar: style can be found in sidebar.less -->
				<section class="sidebar">
					<!-- search form (Optional) -->
					<form action="#" method="get" class="sidebar-form">
						<div class="input-group">
							<input type="text" name="q" class="form-control" placeholder="Search..."/>
							<span class="input-group-btn">
								<button type='submit' name='search' id='search-btn' class="btn btn-flat">
									<i class="fa fa-compass"></i>
								</button>
								<button type='submit' name='search' id='search-btn' class="btn btn-flat">
									<i class="fa fa-search"></i>
								</button> </span>
						</div>
					</form>
					<!-- /.search form -->

					<!-- Sidebar Menu -->
					<ul class="sidebar-menu">
						<li class="header">
							Navigasi
						</li>
						<!-- Optionally, you can add icons to the links -->
						<!-- <li class="active">
							<a href="#"><i class='fa fa-link'></i> <span>Rumah Sakit</span></a>
						</li> -->
						<?php
							foreach ($tipe as $v) {
						?>
						<li>
							<a href="#" onclick="filter(<?php echo $v->id_tipe; ?>)">
								<i class='fa fa-link'></i> 
								<span><?php echo $v->deskripsi; ?></span>
							</a>
						</li>
						<?php } ?>
						<script type="text/javascript">
						function filter(id_tipe){
							console.log($('#jarak').val() + "," + id_tipe);
							var jarak = $('#jarak').val();
							var id_tipe = id_tipe;
							var latlng = "<?php echo $this->uri->segment(3); ?>";
	          				var alamat = "<?php echo base_url('benchmark_rest'); ?>/haversine_open_close/"+latlng +"/"+jarak+"/"+id_tipe;
							getNearby(alamat);
						}
						</script>
							
						
						<li class="treeview">
							<a href="#"><i class='fa fa-link'></i> <span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
							<ul class="treeview-menu">
								<li>
									<a href="#">Link in level 2</a>
								</li>
								<li>
									<a href="#">Link in level 2</a>
								</li>
							</ul>
						</li>
					</ul><!-- /.sidebar-menu -->
				</section>
				<!-- /.sidebar -->
			</aside>