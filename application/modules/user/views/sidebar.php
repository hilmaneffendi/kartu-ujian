<?php
	$query 		= $this->db->get_where('t_member',array('user_id'=>$this->session->userdata('user_id')));
	$rowx 		= $query->row();
	$foto   	= $rowx->foto;    
	$nama   	= $rowx->nama;
	$level 		= $rowx->level;
	$username 	= $rowx->username;
?>
<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="<?php echo base_url();?>dashboard"><img src="<?php echo base_url();?>assets/images/logo_.png" alt=""></a>
			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>
		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li>
					<a class="sidebar-control sidebar-main-toggle hidden-xs">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo base_url();?>assets/foto/<?php echo $foto; ?>" alt="">
						<span><?php echo ucwords($nama); ?></span>
						<i class="caret"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="<?php echo base_url();?>profil"><i class="icon-user-plus"></i> My profile</a></li>
						<li><a href="<?php echo base_url();?>dashboard/logout"><i class="icon-switch2"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<div class="page-container">
		<div class="page-content">
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<a href="javascript:void(0)" class="media-left"><img src="<?php echo base_url();?>assets/foto/<?php echo $foto; ?>" class="img-circle img-sm" alt=""></a>
								<div class="media-body">
									<span class="media-heading text-semibold"><?php echo ucwords($nama); ?></span>
									<div class="text-size-mini text-muted">
									<?php 
										if ($level !=0) {
											echo "Admin";
										}else{
											echo "User";
										}
									?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">
								<li class="navigation-header"><span>Menu</span> <i class="icon-menu" title="Main pages"></i></li>
								<?php 
									if ($level == 1) {
										?>
											<li 
								<?php 
									if ($page == 'dashboard') {
										echo "class = active";
									}else{
										echo "";
									}
								 ?>
								><a href="<?php echo base_url();?>dashboard"><i class="icon-home4"></i> <span> Dashboard</span></a></li>
								<li
								<?php 
									if ($page == 'data_mahasiswa') {
										echo "class = active";
									}else{
										echo "";
									}
								 ?>
								><a href="<?php echo base_url();?>data_mahasiswa"><i class="icon-users"></i> <span> Data Mahasiswa</span></a></li>
								<li
								<?php 
									if ($page == 'list_kartu') {
										echo "class = active";
									}else{
										echo "";
									}
								 ?>
								><a href="<?php echo base_url();?>list_kartu"><i class="icon-list-numbered"></i> <span> List Kartu Ujian</span></a></li>
								<li
								<?php 
									if ($page == 'verifikasi') {
										echo "class = active";
									}else{
										echo "";
									}
								 ?>
								><a href="<?php echo base_url();?>verifikasi"><i class="icon-image-compare"></i> <span> Verifikasi</span></a></li>
										<?php
									}
								 ?>
							</ul>
						</div>
					</div>
				</div>